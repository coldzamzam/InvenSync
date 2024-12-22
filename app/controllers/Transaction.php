<?php

class Transaction extends Controller
{
    public function __construct()
    {
        if ( !isset($_SESSION['is_login']) ) {
            header('Location: ' . BASEURL . '/user/login');
        }
        if($this->model('User_model')->checkDeleted($_SESSION['user_id']) > 0) {
            header('Location: ' . BASEURL . '/dashboard');
        }
    }
    public function index($page = 1)
    {
        $data['judul'] = 'Riwayat Transaksi';
        $data['totalnotifications'] = $this->model('Item_model')->getStockNotification()['TOTAL_NOTIFICATIONS'];
        $data['notifications'] = $this->model('Item_model')->getTotalStockItem();
    
        // Jumlah transaksi per halaman
        $transactionsPerPage = 3;
    
        // Hitung total transaksi
        $totalTransactions = $this->model('Cashier_model')->getTotalReceiptsCount();
        $totalPages = ceil($totalTransactions / $transactionsPerPage);
        $start = ($page - 1) * $transactionsPerPage;
    
        // Ambil daftar receipt sesuai paginasi
        $receipts = $this->model('Cashier_model')->getPaginatedReceipts($start, $transactionsPerPage);
    
        $data['receiptDetails'] = [];
    
        // Ambil detail tiap receipt
        foreach ($receipts as $receipt) {
            $receipt_id = $receipt['RECEIPT_ID'];
            $details = $this->model('Cashier_model')->getReceiptDetails($receipt_id);
            $data['receiptDetails'][$receipt_id] = [
                'date_added' => $receipt['DATE_ADDED'],
                'total' => $receipt['TOTAL_PRICE'],
                'items' => $details
            ];
        }
    
        // Informasi paginasi
        $data['currentPage'] = $page;
        $data['totalPages'] = $totalPages;
    
        // Kirim data ke view
        if ($this->model('User_model')->checkRowToko() > 0) {
            $this->view('templates/s-header', $data);
            $this->view('transaction/index', $data);
        } else {
            header('Location: ' . BASEURL . '/dashboard/toko');
        }
    }
    


}