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
      if ( isset($_POST['kodebarang']) ) {
        echo json_encode(
          $this->model('Item_model')->getItemByID($_POST['kodebarang'])
        );
      }
    }

    public function addItem() {
      if (isset($_SESSION['receipt_id'])) {
        $this->model('Cashier_model')->addItemToReceipt($_POST['kodebarang'], $_POST['quantity']);
      }
    }

    // public function transaction(){
    //   if (isset($_SESSION['receipt_id'])) {
    //     $data['receipt_id'] = $_SESSION['receipt_id'];
    //     $data[]
    //   }
    // }

  //   public function processTransaction() {
  //     // Get raw POST data from the request
  //     $input = file_get_contents("php://input");
  
  //     // Debugging: Output raw data to ensure it's coming through correctly
  //     var_dump($input);
  //     die();  // Stop script execution to inspect the data
  
  //     // Decode the JSON data to an array
  //     $decodedData = json_decode($input, true);
  //     var_dump($decodedData);
  //     die();
  
  //     // Proceed if barangData exists
  //     if (isset($decodedData['barangData']) && is_array($decodedData['barangData'])) {
  //         $barangData = $decodedData['barangData'];
  //     } else {
  //         echo json_encode(['success' => false, 'error' => 'barangData is missing or invalid']);
  //         return;
  //     }
  
  //     // Process the transaction
  //     $this->model('Cashier_model')->createReceipt($barangData);
  //     echo json_encode(['success' => true, 'message' => 'Transaction processed successfully']);
  // }
  

}
