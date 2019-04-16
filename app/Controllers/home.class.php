<?php
/*
 * M4urici0GM
 * https://github.com/M4urici0GM
 * https://bitbucket.org/m4urici0gm/
*/

use app\Core\Controller;

class home extends Controller{

  public function __construct() {
    $this->setTemplate('_templates/header', '_templates/footer');
  }

  public function index(){
    $this->view('index');
  }

  public function menu() {

    $this->redirect('/sgfnsa/login/view/login.php');

  }

}
