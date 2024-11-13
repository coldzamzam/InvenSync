<?php

class Features extends Controller {
  public function index(){
    $data['judul'] = 'Features';
    $this->view('templates/i-header', $data);
    $this->view('features/index', $data);
    $this->view('templates/footer');
  }

  public function masuk(){
    if ( isset($_POST['ayomasuk']) ){
      header('Location: ' . BASEURL . '/regist');
    }
  }
}

?>