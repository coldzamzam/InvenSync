<?php

class Transaction extends Controller
{
    public function __construct()
    {
        if ( !isset($_SESSION['is_login']) ) {
            header('Location: ' . BASEURL . '/user/login');
        }
    }
    public function index() {
        $data['judul'] = 'Riwayat Transaksi';

        // Ambil daftar semua receipt
        $receipts = $this->model('Cashier_model')->getAllReceipts();
        $data['receiptDetails'] = [];

        // Ambil detail tiap receipt
        foreach ($receipts as $receipt) {
            $receipt_id = $receipt['RECEIPT_ID'];
            $details = $this->model('Cashier_model')->getReceiptDetails($receipt_id);
            
            $data['receiptDetails'][$receipt_id] = [
                'date_added' => $receipt['DATE_ADDED'],
                'items' => $details
            ];
        }

        // Kirim data ke view
        $this->view('templates/s-header', $data);
        $this->view('transaction/index', $data);
    }


}