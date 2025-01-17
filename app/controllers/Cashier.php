<?php
class Cashier extends Controller {
    public function __construct(){
        if ( !isset($_SESSION['is_login']) ) {
          header('Location: ' . BASEURL . '/user/login');
        }
        if ($_SESSION['user_role'] != 'Admin Kasir' && $_SESSION['user_role'] != 'Owner') {
          header('Location: ' . BASEURL . '/dashboard');          
        }
        if($this->model('User_model')->checkDeleted($_SESSION['user_id']) > 0) {
          header('Location: ' . BASEURL . '/dashboard');
        }
      }

    public function index(){
        $data['judul'] = 'Kasir';
        $data['item'] = $this->model('Item_model')->getAllItem();
        $data['totalnotifications'] = $this->model('Item_model')->getStockNotification()['TOTAL_NOTIFICATIONS'];
        $data['notifications'] = $this->model('Item_model')->getTotalStockItem();
        // $data['stok'] = $this->model('Cashier_model')->getAllTotalQuantity();
        if (isset($_SESSION['receipt_id'])) {
          // if ($this->model('Cashier_model')->checkRowSelectedItems() < 1) {
          //   $data['receiptItems'] = [];
          //   $this->model('Cashier_model')->unsetReceipt();
          // } else {
            $data['receiptItems'] = $this->model('Cashier_model')->getAllReceiptItems();
          // }
        } else {
          $data['receiptItems'] = [];
        }
        


        if($this->model('User_model')->checkRowToko() > 0) {
          $this->view('templates/s-header', $data);
          $this->view('cashier/index', $data);
      }
      else {
        header('Location: ' . BASEURL . '/dashboard/toko');
      }    }

    public function getDetailItem() {
      if ( isset($_POST['kodebarang']) ) {
        echo json_encode(
          $this->model('Cashier_model')->getItemByID($_POST['kodebarang'])
        );
      }
    }

    public function addItem() {
      $data = [
          'kodebarang' => $_POST['kodebarang'],
          'quantity' => $_POST['quantity']
      ];
  
      // Pastikan receipt_id dibuat jika belum ada
      if (!isset($_SESSION['receipt_id'])) {
          $maxQuantity = $this->model('Cashier_model')->CheckMaxQuantity($data['kodebarang']);
          if ($data['quantity'] > $maxQuantity) {
            Flasher::setFlash('Error', 'Quantity melebihi stok!', 'Tutup', 'error');
            header('Location: ' . BASEURL . '/cashier');
          } else {
            $this->model('Cashier_model')->createIdReceipt();
            $this->model('Cashier_model')->setReceipt();
            $this->model('Cashier_model')->addItemToReceipt($data['kodebarang'], $data['quantity']);
            $this->model('Cashier_model')->setTotalPrice($_SESSION['receipt_id']);
            header('Location: ' . BASEURL . '/cashier');
            exit();
          }
      } else if (isset($_SESSION['receipt_id'])) {
          $maxQuantity = $this->model('Cashier_model')->CheckMaxQuantity($data['kodebarang']);
          if ($data['quantity'] > $maxQuantity) {
            Flasher::setFlash('Error', 'Quantity melebihi stok!', 'Tutup', 'error');
            header('Location: ' . BASEURL . '/cashier');
          }
          else{
            $this->model('Cashier_model')->addItemToReceipt($data['kodebarang'], $data['quantity']);
            $this->model('Cashier_model')->setTotalPrice($_SESSION['receipt_id']);
            header('Location: ' . BASEURL . '/cashier');
            exit();
          }

      }
      else {
          // Handle error jika receipt_id tidak berhasil dibuat
          throw new Exception('Failed to create receipt ID.');
      }
  }

  public function removeItem() {
    $this->model('Cashier_model')->removeItem($_POST['receipt_item_id']);
    $this->model('Cashier_model')->setTotalPrice($_SESSION['receipt_id']);
    header('Location: ' . BASEURL . '/cashier');
  }

  public function deleteReceiptSession(){
    $this->model('Cashier_model')->unsetReceipt();
    unset($_SESSION['receipt_id']);
  }
  
  public function closeTransaction(){
    // $this->model('Cashier_model')->confirmReceipt();
    unset($_SESSION['receipt_id']);
    header('Location: ' . BASEURL . '/cashier');
  }
}
