<?php
  include "config.php";

  //add role script
  if(isset($_POST['create-role'])){
    if(!isset($_POST['role_name']) || empty($_POST['role_name'])){
      echo json_encode(array('error'=>'Role Name Field is Empty.'));
    }else{
      if(isset($_POST['role_desc']) && $_POST['role_desc'] != ''){
        $desc = $_POST['role_desc'];
      }else{
        $desc = '';
      }
      $db = new Database();

      $params = [
          'role_name' => $db->escapeString($_POST['role_name']),
          'role_desc' => $db->escapeString($desc)
      ];

      $db->select('role','role_name',null,"role_name='{$params['role_name']}'",null,null);
      $result = $db->getResult();
      if(!empty($result)){
        echo json_encode(array('error'=>'Role Name is already exist.'));
      }else{
        $db->insert('role',$params);
        $response = $db->getResult();
        if(!empty($response)){
          echo json_encode(array('success'=>$response));
        }else{
          echo json_encode(array('error'=>'Data not inserted.'));
        }
      }
    }
  }

  //update role script
  if(isset($_POST['update-role'])){
    if(!isset($_POST['role_name']) || empty($_POST['role_name'])){
      echo json_encode(array('error'=>'Role Name Field is Empty.'));
    }else{
      if(isset($_POST['role_desc']) && $_POST['role_desc'] != ''){
        $desc = $_POST['role_desc'];
      }else{
        $desc = '';
      }
      $db = new Database();

      $params = [
        'role_id' => $db->escapeString($_POST['role_id']),
        'role_name' => $db->escapeString($_POST['role_name']),
        'role_desc' => $db->escapeString($desc),
      ];

      $db->select("role","role_name",null,"role_name='{$params['role_name']}' AND role_id !='{$params['role_name']}'",null,null);
      $result = $db->getResult();
      if(!empty($result)){
        echo json_encode(array('error'=>'Role Name is already exist.'));
      }else{
        $db->update('role',$params,"role_id='{$params['role_id']}'");
        $response = $db->getResult();
        if(!empty($response)){
          echo json_encode(array('success'=>$response));
        }else{
          echo json_encode(array('error'=>'Data not updated.'));
        }
      }
    }
  }

  //delete role script
  if(isset($_POST['role_delete'])){
    $db = new Database();

    $role_id = $db->escapeString($_POST['role_delete']);
    $db->select('staff_member','*',null,"staff_role='{$role_id}'",null,null);
    $result = $db->getResult();
    if(!empty($result)){
      echo json_encode(array('error'=>'Can not delete role record this is used in staff member list.'));
    }else{
      $db->delete('role',"role_id='{$role_id}'");
      $response = $db->getResult();
      if(!empty($response)){
        echo json_encode(array('success'=>$response)); exit;
      }else{
        echo json_encode(array('error'=>'Data not deleted.')); exit;
      }
    }
  }

  //add specialization script
  if(isset($_POST['create-speci'])){
    if(!isset($_POST['speci_name']) || empty($_POST['speci_name'])){
      echo json_encode(array('error'=>'Specialization Name Field is Empty.'));
    }else{
      if(isset($_POST['speci_desc']) && $_POST['speci_desc'] != ''){
        $desc = $_POST['speci_desc'];
      }else{
        $desc = '';
      }
      $db = new Database();

      $params = [
          'speci_name' => $db->escapeString($_POST['speci_name']),
          'speci_desc' => $db->escapeString($desc)
      ];

      $db->select('specialization','speci_name',null,"speci_name='{$params['speci_name']}'",null,null);
      $result = $db->getResult();
      if(!empty($result)){
        echo json_encode(array('error'=>'Specialization Name is already exist.'));
      }else{
        $db->insert('specialization',$params);
        $response = $db->getResult();
        if(!empty($response)){
          echo json_encode(array('success'=>$response));
        }else{
          echo json_encode(array('error'=>'Data not inserted.'));
        }
      }
    }
  }

  //update specialization script
  if(isset($_POST['update-specialization'])){
    if(!isset($_POST['speci_name']) || empty($_POST['speci_name'])){
      echo json_encode(array('error'=>'Specialization Name Field is Empty.'));
    }else if(!isset($_POST['speci_desc']) || empty($_POST['speci_desc'])){
      echo json_encode(array('error'=>'Specialization Description Field is Empty.'));
    }else{
      if(isset($_POST['speci_desc']) && $_POST['speci_desc'] != ''){
        $desc = $_POST['speci_desc'];
      }else{
        $desc = '';
      }
      $db = new Database();

      $params = [
        'speci_id' => $db->escapeString($_POST['speci_id']),
        'speci_name' => $db->escapeString($_POST['speci_name']),
        'speci_desc' => $db->escapeString($desc),
      ];

      $db->select("specialization","speci_name",null,"speci_name='{$params['speci_name']}' AND speci_id !='{$params['speci_name']}'",null,null);
      $result = $db->getResult();
      if(!empty($result)){
        echo json_encode(array('error'=>'Specialization Name is already exist.'));
      }else{
        $db->update('specialization',$params,"speci_id='{$params['speci_id']}'");
        $response = $db->getResult();
        if(!empty($response)){
          echo json_encode(array('success'=>$response));
        }else{
          echo json_encode(array('error'=>'Data not updated.'));
        }
      }
    }
  }

  //delete specialization script
  if(isset($_POST['speci_delete'])){
    $db = new Database();

    $speci_id = $db->escapeString($_POST['speci_delete']);
    $db->select('staff_member','*',null,"staff_speci='{$speci_id}'",null,null);
    $result = $db->getResult();
    if(!empty($result)){
      echo json_encode(array('error'=>'Can not delete specialization record this is used in staff member list.'));
    }else{
      $db->delete('specialization',"speci_id='{$speci_id}'");
      $response = $db->getResult();
      if(!empty($response)){
        echo json_encode(array('success'=>$response));
      }else{
        echo json_encode(array('error'=>'Data not deleted.'));
      }
    }
  }

  //add staff member script
  if(isset($_POST['create-staff'])){
    if(!isset($_POST['fname']) || empty($_POST['fname'])){
      echo json_encode(array('error'=>'First Name Field is Empty.')); exit;
    }else if(!isset($_POST['lname']) || empty($_POST['lname'])){
      echo json_encode(array('error'=>'Last Name Field is Empty.')); exit;
    }else if(!isset($_POST['gender']) || empty($_POST['gender'])){
      echo json_encode(array('error'=>'Gender Field is Empty.')); exit;
    }else if(!isset($_POST['birth']) || empty($_POST['birth'])){
      echo json_encode(array('error'=>'Birth Date Field is Empty.')); exit;
    }else if(!isset($_POST['role']) || empty($_POST['role'])){
      echo json_encode(array('error'=>'Role Field is Empty.')); exit;
    }else if(!isset($_POST['speci']) || empty($_POST['speci'])){
      echo json_encode(array('error'=>'Specialization Field is Empty.')); exit;
    }else if(!isset($_POST['address']) || empty($_POST['address'])){
      echo json_encode(array('error'=>'Address Field is Empty.')); exit;
    }else if(!isset($_POST['city']) || empty($_POST['city'])){
      echo json_encode(array('error'=>'City Field is Empty.')); exit;
    }else if(!isset($_POST['state']) || empty($_POST['state'])){
      echo json_encode(array('error'=>'State Field is Empty.')); exit;
    }else if(!isset($_POST['phone']) || empty($_POST['phone'])){
      echo json_encode(array('error'=>'Phone Field is Empty.')); exit;
    }else if(!isset($_POST['email']) || empty($_POST['email'])){
      echo json_encode(array('error'=>'Email Field is Empty.')); exit;
    }else{

      if($_FILES['staff_image']['name'] != ''){

        $errors = array();
          /* get details of the uploaded file */
          $file_name = $_FILES['staff_image']['name'];
          $file_size = $_FILES['staff_image']['size'];
          $file_tmp = $_FILES['staff_image']['tmp_name'];
          $file_type = $_FILES['staff_image']['type'];
          $file_name = str_replace(array(',',' '),'',$file_name);
          $file_ext = explode('.',$file_name);
          $file_ext = strtolower(end($file_ext));
          $extensions = array("jpg","jpeg","png");
          if(in_array($file_ext,$extensions) === false){
            $errors[]='<div class="alert alert-danger">extension not allowed, please choose a JPEG or PNG file.</div>';
          }
          if($file_size > 2097152){
            $errors[]='<div class="alert alert-danger">File size must be exactly 2 MB.</div>';
          }
          if(!empty($errors)){
            echo json_encode($errors); exit;
          }

            $file_name = time().str_replace(array(' ','_'), '-', $file_name);

      }else{

          $file_name = '';
      }
          $db = new Database();

          $params = [
            'staff_img' => $db->escapeString($file_name),
            'staff_fname' => $db->escapeString($_POST['fname']),
            'staff_lname' => $db->escapeString($_POST['lname']),
            'staff_gender' => $db->escapeString($_POST['gender']),
            'staff_birth' => $db->escapeString($_POST['birth']),
            'staff_role' => $db->escapeString(implode("," ,$_POST['role'])),
            'staff_speci' => $db->escapeString(implode("," ,$_POST['speci'])),
            'staff_address' => $db->escapeString($_POST['address']),
            'staff_city' => $db->escapeString($_POST['city']),
            'staff_state' => $db->escapeString($_POST['state']),
            'staff_phone' => $db->escapeString($_POST['phone']),
            'staff_email' => $db->escapeString($_POST['email']),
          ];

          $db->select('staff_member','staff_email',null,"staff_email='{$params['staff_email']}'",null,null);
          $exist = $db->getResult();
          if(!empty($exist)){
            echo json_encode(array('error'=>'Staff Member Email is Already Exist.'));
          }else{
            $db->insert('staff_member',$params);
            $response = $db->getResult();
            if(!empty($response)){
              if($_FILES['staff_image']['name'] != ''){
                move_uploaded_file($file_tmp,"../images/staff-member/".$file_name);
              }
              echo json_encode(array('success'=>$response));
            }else{
              echo json_encode(array('error'=>'Data not inserted'));
            }
          }

    }
  }

  //update staff member script
  if(isset($_POST['update-staff'])){
    if(!isset($_POST['fname']) || empty($_POST['fname'])){
      echo json_encode(array('error'=>'First Name Field is Empty.')); exit;
    }else if(!isset($_POST['lname']) || empty($_POST['lname'])){
      echo json_encode(array('error'=>'Last Name Field is Empty.')); exit;
    }else if(!isset($_POST['gender']) || empty($_POST['gender'])){
      echo json_encode(array('error'=>'Gender Field is Empty.')); exit;
    }else if(!isset($_POST['birth']) || empty($_POST['birth'])){
      echo json_encode(array('error'=>'Birth Date Field is Empty.')); exit;
    }else if(!isset($_POST['states']) || empty($_POST['states'])){
      echo json_encode(array('error'=>'Role Field is Empty.')); exit;
    }else if(!isset($_POST['states1']) || empty($_POST['states1'])){
      echo json_encode(array('error'=>'Specialization Field is Empty.')); exit;
    }else if(!isset($_POST['address']) || empty($_POST['address'])){
      echo json_encode(array('error'=>'Address Field is Empty.')); exit;
    }else if(!isset($_POST['city']) || empty($_POST['city'])){
      echo json_encode(array('error'=>'City Field is Empty.')); exit;
    }else if(!isset($_POST['state']) || empty($_POST['state'])){
      echo json_encode(array('error'=>'State Field is Empty.')); exit;
    }else if(!isset($_POST['phone']) || empty($_POST['phone'])){
      echo json_encode(array('error'=>'Phone Field is Empty.')); exit;
    }else if(!isset($_POST['email']) || empty($_POST['email'])){
      echo json_encode(array('error'=>'Email Field is Empty.')); exit;
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
        if(file_exists('../images/staff-member/'.$_POST['old_logo'])){
          unlink('../images/staff-member/'.$_POST['old_logo']);
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
            'staff_img' => $db->escapeString($file_name),
            'staff_fname' => $db->escapeString($_POST['fname']),
            'staff_lname' => $db->escapeString($_POST['lname']),
            'staff_gender' => $db->escapeString($_POST['gender']),
            'staff_birth' => $db->escapeString($_POST['birth']),
            'staff_role' => $db->escapeString(implode("," ,$_POST['states'])),
            'staff_speci' => $db->escapeString(implode("," ,$_POST['states1'])),
            'staff_address' => $db->escapeString($_POST['address']),
            'staff_city' => $db->escapeString($_POST['city']),
            'staff_state' => $db->escapeString($_POST['state']),
            'staff_phone' => $db->escapeString($_POST['phone']),
            'staff_email' => $db->escapeString($_POST['email']),
          ];

          $db->update('staff_member',$params,"staff_id='{$_POST['staff_id']}'");
          $response = $db->getResult();
          if(!empty($response)){

            if(!empty($_FILES['new_logo']['name'])){
                  /* directory in which the uploaded file will be moved */
                move_uploaded_file($file_tmp,"../images/staff-member/".$file_name);
            }
            echo json_encode(array('success'=>$response[0])); exit;
          }else{
            echo json_encode(array('error'=>'Data not updated.')); exit;
          }
      }
    }

  //delete staff member script
  if(isset($_POST['staff_delete'])){
      $db = new Database();

      $staff_id = $db->escapeString($_POST['staff_delete']);
      $db->delete('staff_member',"staff_id='{$staff_id}'");
      $response = $db->getResult();
      if(!empty($response)){
        echo json_encode(array('success'=>$response));
      }else{
        echo json_encode(array('error'=>'Data not deleted.'));
      }

  }


  //add member script
  if(isset($_POST['create-member'])){
    if(!isset($_POST['fname']) || empty($_POST['fname'])){
      echo json_encode(array('error'=>'First Name Field is Empty.')); exit;
    }else if(!isset($_POST['lname']) || empty($_POST['lname'])){
      echo json_encode(array('error'=>'Last Name Field is Empty.')); exit;
    }else if(!isset($_POST['gender']) || empty($_POST['gender'])){
      echo json_encode(array('error'=>'Gender Field is Empty.')); exit;
    }else if(!isset($_POST['birth']) || empty($_POST['birth'])){
      echo json_encode(array('error'=>'Birth Field is Empty.')); exit;
    }else if(!isset($_POST['group']) || empty($_POST['group'])){
      echo json_encode(array('error'=>'Group Field is Empty.')); exit;
    }else if(!isset($_POST['address']) || empty($_POST['address'])){
      echo json_encode(array('error'=>'Address Field is Empty.')); exit;
    }else if(!isset($_POST['city']) || empty($_POST['city'])){
      echo json_encode(array('error'=>'City Field is Empty.')); exit;
    }else if(!isset($_POST['state']) || empty($_POST['state'])){
      echo json_encode(array('error'=>'State Field is Empty.')); exit;
    }else if(!isset($_POST['phone']) || empty($_POST['phone'])){
      echo json_encode(array('error'=>'Phone Field is Empty.')); exit;
    }else if(!isset($_POST['email']) || empty($_POST['email'])){
      echo json_encode(array('error'=>'Email Field is Empty.')); exit;
    }else if(!isset($_POST['staff']) || empty($_POST['staff'])){
      echo json_encode(array('error'=>'Staff Member Name Field is Empty.')); exit;
    }else if(!isset($_POST['membership']) || empty($_POST['membership'])){
      echo json_encode(array('error'=>'Membership Name Field is Empty.')); exit;
    }else if(!isset($_POST['start_date']) || empty($_POST['start_date'])){
      echo json_encode(array('error'=>'Start date Field is Empty.')); exit;
    }else{
      if($_FILES['member_image']['name'] != ''){
        $errors = array();
          /* get details of the uploaded file */
          $file_name = $_FILES['member_image']['name'];
          $file_size = $_FILES['member_image']['size'];
          $file_tmp = $_FILES['member_image']['tmp_name'];
          $file_type = $_FILES['member_image']['type'];
          $file_name = str_replace(array(',',' '),'',$file_name);
          $file_ext = explode('.',$file_name);
          $file_ext = strtolower(end($file_ext));
          $extensions = array("jpg","jpeg","png");
          if(in_array($file_ext,$extensions) === false){
            $errors[]='<div class="alert alert-danger">extension not allowed, please choose a JPEG or PNG file.</div>';
          }
          if($file_size > 2097152){
            $errors[]='<div class="alert alert-danger">File size must be exactly 2 MB.</div>';
          }

          if(!empty($errors)){
            echo json_encode($errors); exit;
          }
            $file_name = time().str_replace(array(' ','_'), '-', $file_name);
      }else{
        $file_name = '';
      }
      $weight = $height = $chest = $waist = $thigh = $arms = $fat = '';
      if(isset($_POST['weight']) && $_POST['weight'] != ''){
        $weight = $_POST['weight'];
      }else if(isset($_POST['height']) && $_POST['height'] != ''){
        $height = $_POST['height'];
      }else if(isset($_POST['chest']) && $_POST['chest'] != ''){
        $chest = $_POST['chest'];
      }else if(isset($_POST['waist']) && $_POST['waist'] != ''){
        $waist = $_POST['waist'];
      }else if(isset($_POST['thigh']) && $_POST['thigh'] != ''){
        $thigh = $_POST['thigh'];
      }else if(isset($_POST['arms']) && $_POST['arms'] != ''){
        $arms = $_POST['arms'];
      }else if(isset($_POST['fat']) && $_POST['fat'] != ''){
        $fat = $_POST['fat'];
      }
        $db = new Database();

        $params = [
          'member_img' => $db->escapeString($file_name),
          'member_fname' => $db->escapeString($_POST['fname']),
          'member_lname' => $db->escapeString($_POST['lname']),
          'member_gender' => $db->escapeString($_POST['gender']),
          'member_birth' => $db->escapeString($_POST['birth']),
          'member_group' => $db->escapeString(implode("," ,$_POST['group'])),
          'member_address' => $db->escapeString($_POST['address']),
          'member_city' => $db->escapeString($_POST['city']),
          'member_state' => $db->escapeString($_POST['state']),
          'member_phone' => $db->escapeString($_POST['phone']),
          'member_email' => $db->escapeString($_POST['email']),
          'member_weight' => $db->escapeString($weight),
          'member_height' => $db->escapeString($height),
          'member_chest' => $db->escapeString($chest),
          'member_waist' => $db->escapeString($waist),
          'member_thigh' => $db->escapeString($thigh),
          'member_arm' => $db->escapeString($arms),
          'member_fat' => $db->escapeString($fat),
          'staff_member' => $db->escapeString(implode("," ,$_POST['staff'])),
          'membership' => $db->escapeString($_POST['membership']),
          'start_date' => $db->escapeString($_POST['start_date']),
          'end_date' => $db->escapeString($_POST['end_date']),
        ];

        $db->select('member','member_email',null,"member_email='{$params['member_email']}'",null,null);
        $exist = $db->getResult();
        if(!empty($exist)){
          echo json_encode(array('error'=>'Member Email is Already Exist.'));
        }else{
          $db->insert('member',$params);
          $response = $db->getResult();
          if(!empty($response)){
            if($_FILES['member_image']['name'] != ''){
              move_uploaded_file($file_tmp,"../images/member/".$file_name);
            }
            echo json_encode(array('success'=>$response));
          }else{
            echo json_encode(array('error'=>'Data not inserted'));
          }
        }
    }
  }

  //update member script
  if(isset($_POST['update-member'])){
    if(!isset($_POST['fname']) || empty($_POST['fname'])){
      echo json_encode(array('error'=>'First Name Field is Empty.')); exit;
    }else if(!isset($_POST['lname']) || empty($_POST['lname'])){
      echo json_encode(array('error'=>'Last Name Field is Empty.')); exit;
    }else if(!isset($_POST['gender']) || empty($_POST['gender'])){
      echo json_encode(array('error'=>'Gender Field is Empty.')); exit;
    }else if(!isset($_POST['birth']) || empty($_POST['birth'])){
      echo json_encode(array('error'=>'Birth Field is Empty.')); exit;
    }else if(!isset($_POST['group']) || empty($_POST['group'])){
      echo json_encode(array('error'=>'Group Field is Empty.')); exit;
    }else if(!isset($_POST['address']) || empty($_POST['address'])){
      echo json_encode(array('error'=>'Address Field is Empty.')); exit;
    }else if(!isset($_POST['city']) || empty($_POST['city'])){
      echo json_encode(array('error'=>'City Field is Empty.')); exit;
    }else if(!isset($_POST['state']) || empty($_POST['state'])){
      echo json_encode(array('error'=>'State Field is Empty.')); exit;
    }else if(!isset($_POST['phone']) || empty($_POST['phone'])){
      echo json_encode(array('error'=>'Phone Field is Empty.')); exit;
    }else if(!isset($_POST['email']) || empty($_POST['email'])){
      echo json_encode(array('error'=>'Email Field is Empty.')); exit;
    }else if(!isset($_POST['staff']) || empty($_POST['staff'])){
      echo json_encode(array('error'=>'Staff Member Name Field is Empty.')); exit;
    }else if(!isset($_POST['membership']) || empty($_POST['membership'])){
      echo json_encode(array('error'=>'Membership Name Field is Empty.')); exit;
    }else if(!isset($_POST['start_date']) || empty($_POST['start_date'])){
      echo json_encode(array('error'=>'Start date Field is Empty.')); exit;
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
        if(file_exists('../images/member/'.$_POST['old_logo'])){
          unlink('../images/member/'.$_POST['old_logo']);
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
          $weight = $height = $chest = $waist = $thigh = $arms = $fat = '';
          if(isset($_POST['weight']) && $_POST['weight'] != ''){
            $weight = $_POST['weight'];
          }else if(isset($_POST['height']) && $_POST['height'] != ''){
            $height = $_POST['height'];
          }else if(isset($_POST['chest']) && $_POST['chest'] != ''){
            $chest = $_POST['chest'];
          }else if(isset($_POST['waist']) && $_POST['waist'] != ''){
            $waist = $_POST['waist'];
          }else if(isset($_POST['thigh']) && $_POST['thigh'] != ''){
            $thigh = $_POST['thigh'];
          }else if(isset($_POST['arms']) && $_POST['arms'] != ''){
            $arms = $_POST['arms'];
          }else if(isset($_POST['fat']) && $_POST['fat'] != ''){
            $fat = $_POST['fat'];
          }
          $db = new Database();

          $params = [
            'member_id' => $db->escapeString($_POST['member_id']),
            'member_img' => $db->escapeString($file_name),
            'member_fname' => $db->escapeString($_POST['fname']),
            'member_lname' => $db->escapeString($_POST['lname']),
            'member_gender' => $db->escapeString($_POST['gender']),
            'member_birth' => $db->escapeString($_POST['birth']),
            'member_group' => $db->escapeString(implode("," ,$_POST['group'])),
            'member_address' => $db->escapeString($_POST['address']),
            'member_city' => $db->escapeString($_POST['city']),
            'member_state' => $db->escapeString($_POST['state']),
            'member_phone' => $db->escapeString($_POST['phone']),
            'member_email' => $db->escapeString($_POST['email']),
            'member_weight' => $db->escapeString($weight),
            'member_height' => $db->escapeString($height),
            'member_chest' => $db->escapeString($chest),
            'member_waist' => $db->escapeString($waist),
            'member_thigh' => $db->escapeString($thigh),
            'member_arm' => $db->escapeString($arms),
            'member_fat' => $db->escapeString($fat),
            'staff_member' => $db->escapeString(implode("," ,$_POST['staff'])),
            'membership' => $db->escapeString($_POST['membership']),
            'start_date' => $db->escapeString($_POST['start_date']),
            'end_date' => $db->escapeString($_POST['end_date']),
          ];

          $db->select('member','member_email',null,"member_email='{$params['member_email']}' AND member_id !='{$params['member_id']}'",null,null);
          $exist = $db->getResult();
          if(!empty($exist)){
            echo json_encode(array('error'=>'Member Email is already exist.'));
          }else{
            $db->update('member',$params,"member_id='{$params['member_id']}'");
            $response = $db->getResult();
            if(!empty($response)){

              if(!empty($_FILES['new_logo']['name'])){
                    /* directory in which the uploaded file will be moved */
                  move_uploaded_file($file_tmp,"../images/member/".$file_name);
              }
              echo json_encode(array('success'=>$response[0])); exit;
            }else{
              echo json_encode(array('error'=>'Data not updated.')); exit;
            }
          }
      }
    }

    //delete member script
    if(isset($_POST['member_delete'])){
      $db = new Database();

      $member_id = $db->escapeString($_POST['member_delete']);
      $db->delete('member',"member_id='{$member_id}'");
      $response = $db->getResult();
      if(!empty($response)){
        echo json_encode(array('success'=>$response));
      }else{
        echo json_encode(array('error'=>'Data not deleted.'));
      }
    }

?>
