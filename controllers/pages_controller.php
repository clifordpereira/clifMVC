<?php
  class PagesController {
    public function index()
    {
      // $this->home();
      require_once('views/pages/list.pages.php');
    }
    public function home() {
      require_once('views/pages/home.php');
    }

    public function error() {
      require_once('views/pages/error.php');
    }
  }
?>