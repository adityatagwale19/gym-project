<?php
  include "config.php";

  //admin login script
  if(isset($_POST['login'])){
    if(!isset($_POST['name']) || empty($_POST['name'])){
      echo json_encode(array('error'=>'name empty')); exit;
    }elseif (!isset($_POST['pass']) || empty($_POST['pass'])) {
      echo json_encode(array('error'=>'pass empty')); exit;
    }else{

        $db = new Database();
        $username = $db->escapeString($_POST['name']);
        $password = md5($db->escapeString($_POST['pass']));

        $db->select('admin','admin_fullname',null,"admin_username = '$username' AND admin_password = '$password'",null,0);
        $result = $db->getResult();
        if(!empty($result)){
            /* start the session */
            session_start();
            /* set session variable */
            $_SESSION['admin_fullname'] = $result[0]['admin_fullname'];
            echo json_encode(array('success'=>'true')); exit;
        }else{
            echo json_encode(array('error'=>'false')); exit;
        }
    }
  }

  //admin logout script
  if(isset($_POST['logout'])){
    /* start the session */
    session_start();
    /* remove all session variables */
    session_unset();
    /* destroy the session */
    session_destroy();

    echo '1'; exit;
  }

?>
