<?php
include "config.php";

//add group script
if(isset($_POST['create'])){
  if(!isset($_POST['group_name']) || empty($_POST['group_name'])){
    echo json_encode(array('error'=>'Name Field is Empty.'));
  }else{
    if(isset($_POST['group_desc']) && $_POST['group_desc'] != ''){
      $desc = $_POST['group_desc'];
    }else{
      $desc = '';
    }
    $db = new Database();

    $params = [
        'group_name' => $db->escapeString($_POST['group_name']),
        'group_desc' => $db->escapeString($desc)
    ];

    $db->select('groups','group_name',null,"group_name='{$params['group_name']}'",null,null);
    $result = $db->getResult();
    if(!empty($result)){
      echo json_encode(array('error'=>'Group Name is already exist.'));
    }else{
      $db->insert('groups',$params);
      $response = $db->getResult();
      if(!empty($response)){
        echo json_encode(array('success'=>$response));
      }else{
        echo json_encode(array('error'=>'Data not inserted.'));
      }
    }
  }
}

//update group script
  if(isset($_POST['update'])){
    if(!isset($_POST['group_name']) || empty($_POST['group_name'])){
      echo json_encode(array('error'=>'Name Field is Empty.'));
    }else{
      if(isset($_POST['group_desc']) && $_POST['group_desc'] != ''){
        $desc = $_POST['group_desc'];
      }else{
        $desc = '';
      }
      $db = new Database();

      $params = [
        'group_id' => $db->escapeString($_POST['group_id']),
        'group_name' => $db->escapeString($_POST['group_name']),
        'group_desc' => $db->escapeString($desc),
      ];

      $db->select("groups","group_name",null,"group_name='{$params['group_name']}' AND group_id !='{$params['group_name']}'",null,null);
      $result = $db->getResult();
      if(!empty($result)){
        echo json_encode(array('error'=>'Group Name is already exist.'));
      }else{
        $db->update('groups',$params,"group_id='{$params['group_id']}'");
        $response = $db->getResult();
        if(!empty($response)){
          echo json_encode(array('success'=>$response));
        }else{
          echo json_encode(array('error'=>'Data not updated.'));
        }
      }
    }
  }

//delete group script
  if(isset($_POST['group_delete'])){
    $db = new Database();

    $group_id = $db->escapeString($_POST['group_delete']);
    $db->select('member','*',null,"member_group='{$group_id}'",null,null);
    $result = $db->getResult();
    if(!empty($result)){
      echo json_encode(array('error'=>'Can not delete group record this is used in member list.'));
    }else{
      $db->delete('groups',"group_id='{$group_id}'");
      $response = $db->getResult();
      if(!empty($response)){
        echo json_encode(array('success'=>$response)); exit;
      }else{
        echo json_encode(array('error'=>'Data not deleted.')); exit;
      }
    }
  }

?>
