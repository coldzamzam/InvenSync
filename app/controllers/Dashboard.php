<?php

Class Dashboard extends Controller{
  public function logout(){
    if(isset($_POST['logout'])){
      session_unset();
      session_destroy();
      header('Location: ' . BASEURL . '/user/index');
    }
  }
}

?>