<?php
  include "config.php";

  //add membership script
  if(isset($_POST['create'])){
    if(!isset($_POST['membership_name']) || empty($_POST['membership_name'])){
      echo json_encode(array('error'=>'Name Field is Empty.'));
    }else if(!isset($_POST['membership_cat']) || empty($_POST['membership_cat'])){
      echo json_encode(array('error'=>'Category Field is Empty.'));
    }else if(!isset($_POST['membership_period']) || empty($_POST['membership_period'])){
      echo json_encode(array('error'=>'Period Field is Empty.'));
    }else if(!isset($_POST['membership_amount']) || empty($_POST['membership_amount'])){
      echo json_encode(array('error'=>'Amount Field is Empty.'));
    }else{
      if(isset($_POST['membership_desc']) && $_POST['membership_desc'] != ''){
        $desc = $_POST['membership_desc'];
      }else{
        $desc = '';
      }
      $db = new Database();

      $params = [
          'membership_name' => $db->escapeString($_POST['membership_name']),
          'membership_cat' => $db->escapeString($_POST['membership_cat']),
          'membership_period' => $db->escapeString($_POST['membership_period']),
          'membership_amount' => $db->escapeString($_POST['membership_amount']),
          'membership_desc' => $db->escapeString($desc)
      ];

      $db->select('membership','membership_name',null,"membership_name='{$params['membership_name']}'",null,null);
      $result = $db->getResult();
      if(!empty($result)){
        echo json_encode(array('error'=>'Membership Name is already exist.'));
      }else{
        $db->insert('membership',$params);
        $response = $db->getResult();
        if(!empty($response)){
          echo json_encode(array('success'=>$response));
        }else{
          echo json_encode(array('error'=>'Data not inserted.'));
        }
      }
    }
  }

  //update membership script
  if(isset($_POST['update'])){
    if(!isset($_POST['membership_name']) || empty($_POST['membership_name'])){
      echo json_encode(array('error'=>'Name Field is Empty.'));
    }else if(!isset($_POST['membership_cat']) || empty($_POST['membership_cat'])){
      echo json_encode(array('error'=>'Category Field is Empty.'));
    }else if(!isset($_POST['membership_period']) || empty($_POST['membership_period'])){
      echo json_encode(array('error'=>'Period Field is Empty.'));
    }else if(!isset($_POST['membership_amount']) || empty($_POST['membership_amount'])){
      echo json_encode(array('error'=>'Amount Field is Empty.'));
    }else{
      if(isset($_POST['membership_desc']) && $_POST['membership_desc'] != ''){
        $desc = $_POST['membership_desc'];
      }else{
        $desc = '';
      }
      $db = new Database();

      $params = [
          'membership_id' => $db->escapeString($_POST['membership_id']),
          'membership_name' => $db->escapeString($_POST['membership_name']),
          'membership_cat' => $db->escapeString($_POST['membership_cat']),
          'membership_period' => $db->escapeString($_POST['membership_period']),
          'membership_amount' => $db->escapeString($_POST['membership_amount']),
          'membership_desc' => $db->escapeString($_POST['membership_desc'])
      ];

      $db->select("membership","membership_name",null,"membership_name='{$params['membership_name']}' AND membership_id !='{$params['membership_id']}'",null,null);
      $result = $db->getResult();
      if(!empty($result)){
        echo json_encode(array('error'=>'Membership Name is already exist.'));
      }else{
        $db->update('membership',$params,"membership_id='{$params['membership_id']}'");
        $response = $db->getResult();
        if(!empty($response)){
          echo json_encode(array('success'=>$response));
        }else{
          echo json_encode(array('error'=>'Data not updated.'));
        }
      }
    }
  }

  //delete membership script
  if(isset($_POST['membership_delete'])){
    $db = new Database();

    $membership_id = $db->escapeString($_POST['membership_delete']);
    $db->select('member','*',null,"membership='{$membership_id}'",null,null);
    $result = $db->getResult();
    if(!empty($result)){
      echo json_encode(array('error'=>'Can not delete membership record this is used in member list.'));
    }else{
      $db->delete('membership',"membership_id='{$membership_id}'");
      $response = $db->getResult();
      if(!empty($response)){
        echo json_encode(array('success'=>$response));
      }else{
        echo json_encode(array('error'=>'Data not deleted.'));
      }
    }
  }

  //selct days script
  if(isset($_POST['select_days'])){
    $db = new Database();

    $select_days = $_POST['select_days'];

    $db->select('membership','membership_period',null,"membership_id=$select_days",null,null);
    $result = $db->getResult();
    print_r($result[0]["membership_period"]); exit;
  }

?>
