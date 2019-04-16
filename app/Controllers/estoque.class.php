<?php
/*
 * M4urici0GM
 * https://github.com/M4urici0GM
 * https://bitbucket.org/m4urici0gm/
*/

use app\Core\Controller;

class estoque extends Controller {

  function __construct() {
    parent::__construct();
  }

  public function index() {
    if (!$this->session->hasUserData('id_login')) {
      $this->redirect("/sgfnsa/login/view/login.php");
    }

    

  }
}
