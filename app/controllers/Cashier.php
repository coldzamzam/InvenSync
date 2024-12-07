<?php
class Cashier extends Controller {
    public function __construct(){
        if ( !isset($_SESSION['is_login']) ) {
          header('Location: ' . BASEURL . '/user/login');
        }
      }

    public function index(){
        $data['judul'] = 'Cashier';
        $data['item'] = $this->model('Item_model')->getAllItem();
        $data['receiptItems']=$this->model('Cashier_model')->getAllReceiptItems();
        $this->view('templates/s-header', $data);
        $this->view('cashier/index', $data);
    }

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
            header('Location: ' . BASEURL . '/cashier');
            exit();
          }
      } else if (isset($_SESSION['receipt_id'])) {
          $maxQuantity = $this->model('Cashier_model')->CheckMaxQuantity($data['kodebarang']);
          var_dump($maxQuantity);
          if ($data['quantity'] > $maxQuantity) {
            Flasher::setFlash('Error', 'Quantity melebihi stok!', 'Tutup', 'error');
            header('Location: ' . BASEURL . '/cashier');
          }
          else{
            $this->model('Cashier_model')->addItemToReceipt($data['kodebarang'], $data['quantity']);
            header('Location: ' . BASEURL . '/cashier');
            exit();
          }

      }
      else {
          // Handle error jika receipt_id tidak berhasil dibuat
          throw new Exception('Failed to create receipt ID.');
      }
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
