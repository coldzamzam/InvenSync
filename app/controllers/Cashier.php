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
        $this->view('templates/s-header', $data);
        $this->view('cashier/index', $data);
    }

    public function getDetailItem() {
      if ( isset($_POST['namabarang']) ) {
        echo json_encode(
          $this->model('Item_model')->getItemByName($_POST['namabarang'])
        );
      }
    }
}
