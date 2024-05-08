<?php
  include "config.php";

  //add group script
  if(isset($_POST['create'])){
    if(!isset($_POST['cat_name']) || empty($_POST['cat_name'])){
      echo json_encode(array('error'=>'Name Field is Empty.'));
    }else{
      if(isset($_POST['cat_desc']) && $_POST['cat_desc'] != ''){
        $desc = $_POST['cat_desc'];
      }else{
        $desc = '';
      }
      $db = new Database();

      $params = [
          'cat_name' => $db->escapeString($_POST['cat_name']),
          'cat_desc' => $db->escapeString($desc)
      ];

      $db->select('category','cat_name',null,"cat_name='{$params['cat_name']}'",null,null);
      $result = $db->getResult();
      if(!empty($result)){
        echo json_encode(array('error'=>'Category Name is already exist.'));
      }else{
        $db->insert('category',$params);
        $response = $db->getResult();
        if(!empty($response)){
          echo json_encode(array('success'=>$response));
        }else{
          echo json_encode(array('error'=>'Data not inserted.'));
        }
      }
    }
  }

  //update category script
  if(isset($_POST['update'])){
    if(!isset($_POST['cat_name']) || empty($_POST['cat_name'])){
      echo json_encode(array('error'=>'Name Field is Empty.'));
    }else{
      if(isset($_POST['cat_desc']) && $_POST['cat_desc'] != ''){
        $desc = $_POST['cat_desc'];
      }else{
        $desc = '';
      }
      $db = new Database();

      $params = [
        'cat_id' => $db->escapeString($_POST['cat_id']),
        'cat_name' => $db->escapeString($_POST['cat_name']),
        'cat_desc' => $db->escapeString($desc),
      ];

      $db->select("category","cat_name",null,"cat_name='{$params['cat_name']}' AND cat_id !='{$params['cat_id']}'",null,null);
      $result = $db->getResult();
      if(!empty($result)){
        echo json_encode(array('error'=>'Category Name is already exist.'));
      }else{
        $db->update('category',$params,"cat_id='{$params['cat_id']}'");
        $response = $db->getResult();
        if(!empty($response)){
          echo json_encode(array('success'=>$response));
        }else{
          echo json_encode(array('error'=>'Data not updated.'));
        }
      }
    }
  }

  //delete category script
  if(isset($_POST['cat_delete'])){
    $db = new Database();

    $cat_id = $db->escapeString($_POST['cat_delete']);
    $db->select('membership','*',null,"membership_cat='{$cat_id}'",null,null);
    $result = $db->getResult();
    if(!empty($result)){
      echo json_encode(array('error'=>'Can not delete category record this is used in membership list.'));
    }else{
      $db->delete('category',"cat_id='{$cat_id}'");
      $response = $db->getResult();
      if(!empty($response)){
        echo json_encode(array('success'=>$response)); exit;
      }else{
        echo json_encode(array('error'=>'Data not deleted.')); exit;
      }
    }
  }

?>
