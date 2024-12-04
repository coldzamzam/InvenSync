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
        if($this->model('User_model')->checkRowToko() > 0) {
          $this->view('templates/s-header', $data);
          $this->view('cashier/index', $data);
        }
        else {
          $this->view('templates/s-header', $data);
          $this->view('user/toko', $data);
        }
    }

    public function getDetailItem() {
      if ( isset($_POST['namabarang']) ) {
        echo json_encode(
          $this->model('Item_model')->getItemByName($_POST['namabarang'])
        );
      }
    }
}
