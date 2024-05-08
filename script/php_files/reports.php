<?php
  include "config.php";

  if(isset($_POST['attendance-report'])){
    if(!isset($_POST['start_date']) || empty($_POST['start_date'])){
      echo json_encode(array('error'=>'Start Date Field is Empty.')); exit;
    }else if(!isset($_POST['endd_date']) || empty($_POST['endd_date'])){
      echo json_encode(array('error'=>'End Date Field is Empty.')); exit;
    }else{
        $db = new Database();
        $start_date = $db->escapeString($_POST['start_date']);
        $end_date = $db->escapeString($_POST['endd_date']);

        $db->select('member','member.member_id,member.member_img,member.member_gender,member.member_fname,member.member_lname,member.member_group,attendance.attendance_id,attendance.attendance_status,attendance.attendance_date,attendance.member_id,groups.group_id,groups.group_name',"attendance ON attendance.member_id=member.member_id LEFT JOIN groups ON member.member_group=groups.group_id","attendance_date>'{$start_date}' AND attendance_date<='{$end_date}'",null,null);
        $result = $db->getResult();
        // print_r($result); exit;
        $output = '';
        if(!empty($result)){
          $i=0;
          foreach ($result as $row){ $i++;
            $output .= '<tr>
                          <td>'.$i.'</td>
                          <td>';
                            if($row['member_img'] != ''){
                              $output .= '<img src="./images/member/'.$row['member_img'].'" width="40px" height="40px" style="border-radius:50%; object-fit: cover;" alt="">';
                            }else{
                              $img = ($row['member_gender'] == 'male')?'man.png' : 'woman.png';
                              $output .= '<img src="./images/member/'.$img.'" width="40px" height="40px" style="border-radius:50%; object-fit: cover;" alt="">';
                            }
                          $output .='</td>
                          <td>'.$row["member_fname"].' '.$row["member_lname"].'</td>
                          <td>'.$row["group_name"].'</td>';
                          if($row['attendance_date'] == ''){
                              $output .='<td>Null</td>';
                          }else{
                              $output .='<td>'.date('j F,Y',strtotime($row['attendance_date'])).'</td>';
                          }
                          if($row['attendance_status'] == '1'){
                              $output .='<td>Present</td>';
                          }elseif ($row['attendance_status'] == '0') {
                              $output .='<td>Absent</td>';
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
