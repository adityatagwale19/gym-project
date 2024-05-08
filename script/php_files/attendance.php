<?php
  include "config.php";

  //member attendance script
  if(isset($_POST['member-attendance'])){
    if(!isset($_POST['date']) || empty($_POST['date'])){
      echo json_encode(array('error'=>'Date Field is Empty.')); exit;
    }else if(!isset($_POST['group']) || empty($_POST['group'])){
      echo json_encode(array('error'=>'Group Field is Empty.')); exit;
    }else{
        $db = new Database();
        $date = $db->escapeString($_POST['date']);
        $group = $db->escapeString($_POST['group']);

        $db->select('member','member.member_id,member.member_img,member.member_fname,member.member_lname,member.member_gender
        ',null,"member.member_group='{$group}'",null,null);
        $result = $db->getResult();
        $db->select('attendance','*',null,"attendance_date='{$date}'",null,null);
        $attendance = $db->getResult();
        $output = '';
        if(!empty($result)){
          $i=0;
          foreach($result as $key => $value){ $i++;
            $output .= '<tr>
            <td>
              <input type="text" name="member[]" class="member_id" id="member'.$value['member_id'].'" value="'.$value['member_id'].'" hidden>
              <div class="checkbox">';
                if(isset($attendance[$key])){
                  if($value['member_id'] == $attendance[$key]['member_id']){
                    if($attendance[$key]['attendance_status'] == '1'){
                      $output .= '<input type="checkbox" name="att[]" class="att" id="checkbox'.$value['member_id'].'" checked="">';
                    }elseif ($attendance[$key]['attendance_status'] == '0') {
                      $output .= '<input type="checkbox" name="att[]" class="att" id="checkbox'.$value['member_id'].'">';
                    }else{
                      $output .= '<input type="checkbox" name="att[]" class="att" id="checkbox'.$value['member_id'].'" checked="">';
                    }
                  }else{
                    $output .= '<input type="checkbox" name="att[]" class="att" id="checkbox'.$value['member_id'].'" checked="">';
                  }
                }else{
                  $output .= '<input type="checkbox" name="att[]" class="att" id="checkbox'.$value['member_id'].'" checked="">';
                }
                $output .='<label for="checkbox'.$value['member_id'].'"></label>
              </div>
            </td>
            <td>';
                if($value['member_img'] != ''){
                  $output .= '<img src="./images/member/'.$value['member_img'].'" width="40px" height="40px" style="border-radius:50%; object-fit: cover;" alt="">';
                }else{
                  $img = ($value['member_gender'] == 'male')?'man.png' : 'woman.png';
                  $output .= '<img src="./images/member/'.$img.'" width="40px" height="40px" style="border-radius:50%; object-fit: cover;" alt="">';
                }
            $output .= '</td>
            <td>'.$value["member_fname"].' '.$value["member_lname"].'</td>';
            if(isset($attendance[$key])){
              if($value['member_id'] == $attendance[$key]['member_id']){
                if($attendance[$key]['attendance_status'] == '1'){
                  $output .='<td>Present</td>';
                }elseif ($attendance[$key]['attendance_status'] == '0') {
                  $output .='<td>Absent</td>';
                }else{
                  $output .='<td>Not Taken</td>';
                }
              }else{
                $output .='<td>Not Taken</td>';
              }
            }else{
              $output .='<td>Not Taken</td>';
            }

            $output .='</tr>';
          }
        }
        echo $output; exit;
    }
  }

  //attendance insert script
  if(isset($_POST['add_att'])){
    $db = new Database();
    $data = $_POST['add_att'];
    for($i=0;$i<count($data);$i++){
      if($data[$i] != ''){
        $params = [
            'attendance_status' => $db->escapeString($data[$i]),
            'attendance_date' => $db->escapeString(date('Y-m-d')),
            'member_id' => $db->escapeString($i),
        ];
        $db->select('attendance','attendance_id',null,"member_id='{$params['member_id']}' AND attendance_date='{$params['attendance_date']}'",null,null);
        $check = $db->getResult();
        if(empty($check)){
          $db->insert('attendance',$params);
          $result = $db->getResult();
        }else{
          $db->update('attendance',$params,"member_id='{$params['member_id']}' AND attendance_date='{$params['attendance_date']}'");
          $result = $db->getResult();
        }

      }
    }
    echo 1; exit;
  }

  //staff attendance insert script
  if(isset($_POST['add_staff_att'])){
    $db = new Database();
    $data = $_POST['add_staff_att'];

    for($i=0;$i<count($data);$i++){
      if($data[$i] != ''){
        $params = [
            'att_status' => $db->escapeString($data[$i]),
            'att_date' => $db->escapeString($_POST['staff_date']),
            'staff_id' => $db->escapeString($i),
        ];
        $db->select('staff_attendance','att_id',null,"staff_id='{$params['staff_id']}' AND att_date='{$params['att_date']}'",null,null);
        $check = $db->getResult();
        if(empty($check)){
          $db->insert('staff_attendance',$params);
          $result = $db->getResult();
        }else{
          $db->update('staff_attendance',$params,"staff_id='{$params['staff_id']}' AND att_date='{$params['att_date']}'");
          $result = $db->getResult();
        }

      }
    }
    echo 1; exit;
  }


  //staff member attendance script
  if(isset($_POST['current_date'])){

    if(!isset($_POST['current_date']) || empty($_POST['current_date'])){
      echo json_encode(array('error'=>'Date Field is Empty.')); exit;
    }else{
        $db = new Database();
        $date = $db->escapeString($_POST['current_date']);

        $db->select('staff_member','staff_member.staff_id,staff_member.staff_img,staff_member.staff_gender,staff_member.staff_fname,staff_member.staff_lname',null,null,null,null);
        $result = $db->getResult();
        $db->select('staff_attendance','*',null,"att_date='{$date}'",null,null);
        $attendance = $db->getResult();
        $output = '';
        if(!empty($result)){
          $i=0;
          foreach($result as $key => $value){ $i++;
            $output .= '<tr>
            <td>
              <input type="text" name="member[]" class="staff_id" id="member'.$value['staff_id'].'" value="'.$value['staff_id'].'" hidden>
              <div class="checkbox">';
                if(isset($attendance[$key])){
                  if($value['staff_id'] == $attendance[$key]['staff_id']){
                    if($attendance[$key]['att_status'] == '1'){
                      $output .= '<input type="checkbox" name="att[]" class="att" id="checkbox'.$value['staff_id'].'" checked="">';
                    }elseif ($attendance[$key]['att_status'] == '0') {
                      $output .= '<input type="checkbox" name="att[]" class="att" id="checkbox'.$value['staff_id'].'">';
                    }else{
                      $output .= '<input type="checkbox" name="att[]" class="att" id="checkbox'.$value['staff_id'].'" checked="">';
                    }
                  }else{
                    $output .= '<input type="checkbox" name="att[]" class="att" id="checkbox'.$value['staff_id'].'" checked="">';
                  }
                }else{
                  $output .= '<input type="checkbox" name="att[]" class="att" id="checkbox'.$value['staff_id'].'" checked="">';
                }
                $output .='<label for="checkbox'.$value['staff_id'].'"></label>
              </div>
            </td>
            <td>';
                if($value['staff_img'] != ''){
                  $output .= '<img src="./images/staff-member/'.$value['staff_img'].'" width="40px" height="40px" style="border-radius:50%; object-fit: cover;" alt="">';
                }else{
                  $img = ($value['staff_gender'] == 'male')?'man.png' : 'woman.png';
                  $output .= '<img src="./images/staff-member/'.$img.'" width="40px" height="40px" style="border-radius:50%; object-fit: cover;" alt="">';
                }
            $output .= '</td>
            <td>'.$value["staff_fname"].' '.$value["staff_lname"].'</td>';
            if(isset($attendance[$key])){
              if($value['staff_id'] == $attendance[$key]['staff_id']){
                if($attendance[$key]['att_status'] == '1'){
                  $output .='<td>Present</td>';
                }elseif ($attendance[$key]['att_status'] == '0') {
                  $output .='<td>Absent</td>';
                }else{
                  $output .='<td>Not Taken</td>';
                }
              }else{
                $output .='<td>Not Taken</td>';
              }
            }else{
              $output .='<td>Not Taken</td>';
            }

            $output .='</tr>';
          }
        }
        echo $output; exit;
    }
  }


?>
