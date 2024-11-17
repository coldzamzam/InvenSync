<?php

class About extends Controller {
  public function index(){
    $data['judul'] = 'Contact Us';
    $this->view('templates/i-header', $data);
    $this->view('contact/index', $data);
    $this->view('templates/footer');
  }
}

?>