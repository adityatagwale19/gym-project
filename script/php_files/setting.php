<?php
  include "config.php";

  //update general_settings script
  if(isset($_POST['update-settings'])){
    //echo 1; exit;
    if(!isset($_POST['gym_id']) || empty($_POST['gym_id'])){
      echo json_encode(array('error'=>'Gym Id is Missing.')); exit;
    }else if(!isset($_POST['gym_currency']) || empty($_POST['gym_currency'])){
      echo json_encode(array('error'=>'Currency Format is Missing.')); exit;
    }else{

        if(!empty($_POST['old_logo']) && empty($_FILES['new_logo']['name'])){
          $file_name = $_POST['old_logo'];
        }else if(!empty($_POST['old_logo']) && !empty($_FILES['new_logo']['name'])){
          $errors = array();
          /* get details of the uploaded file */
          $file_name = $_FILES['new_logo']['name'];
          $file_size = $_FILES['new_logo']['size'];
          $file_tmp = $_FILES['new_logo']['tmp_name'];
          $file_type = $_FILES['new_logo']['type'];
          $file_name = str_replace(array(',',' '),'',$file_name);
          $file_ext = explode('.',$file_name);
          $file_ext = strtolower(end($file_ext));
          $extensions = array("jpeg","jpg","png");
          if(in_array($file_ext,$extensions) === false){
            $errors[]="<div class='alert alert-danger'>extension not allowed, please choose a JPEG or PNG file</div>";
          }
          if($file_size > 2097152){
            $errors[]="<div class='alert alert-danger'>File size must be exactly must 2 MB.</div>";
          }
          if(file_exists('../images/gym-logo/'.$_POST['old_logo'])){
            unlink('../images/gym-logo/'.$_POST['old_logo']);
          }
          $file_name = time().str_replace(array(' ','_'),'-',$file_name);

        }else if(empty($_POST['old_logo']) && !empty($_FILES['new_logo']['name'])){
          $errors = array();
          /* get details of the uploaded file */
          $file_name = $_FILES['new_logo']['name'];
          $file_size = $_FILES['new_logo']['size'];
          $file_tmp = $_FILES['new_logo']['tmp_name'];
          $file_type = $_FILES['new_logo']['type'];
          $file_name = str_replace(array(',',' '),'',$file_name);
          $file_ext = explode('.',$file_name);
          $file_ext = strtolower(end($file_ext));
          $extensions = array("jpeg","jpg","png");
          if(in_array($file_ext,$extensions) === false){
            $errors[]="<div class='alert alert-danger'>extension not allowed, please choose a JPEG or PNG file</div>";
          }
          if($file_size > 2097152){
            $errors[]="<div class='alert alert-danger'>File size must be exactly must 2 MB.</div>";
          }
          if(!empty($errors)){
            echo json_encode($errors); exit;
          }
          $file_name = time().str_replace(array(' ','_'),'-',$file_name);
        }else{
          $file_name = '';
        }

            $db = new Database();

            $params = [
                'gym_name' => $db->escapeString($_POST['gym_name']),
                'gym_logo' => $db->escapeString($file_name),
                'gym_currency' => $db->escapeString($_POST['gym_currency'])
            ];

            $db->update('settings',$params,"gym_id='{$_POST['gym_id']}'");
            $response = $db->getResult();
            if(!empty($response)){

              if(!empty($_FILES['new_logo']['name'])){
                  /* directory in which the uploaded file will be moved */
                move_uploaded_file($file_tmp,"../images/gym-logo/".$file_name);
              }
              echo json_encode(array('success'=>$response[0])); exit;
            }else{
              echo json_encode(array('error'=>'Data not updated.')); exit;
            }
        }
    }


?>
