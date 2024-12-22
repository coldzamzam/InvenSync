<?php

class Home extends Controller {
  public function index(){
    $data['judul'] = 'Home';
    $this->view('templates/i-header', $data);
    $this->view('home/index', $data);
    // $this->view('templates/footer');
  }

  public function learnmore(){
    $data['judul'] = 'Learn More';
    $this->view('templates/i-header', $data);
    $this->view('home/learnmore', $data);
    // $this->view('templates/footer');
  }
}

?>