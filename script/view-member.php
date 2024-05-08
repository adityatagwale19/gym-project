<?php $title = "Member";
include "header.php" ?>
  <div class="message"></div>
  <div class="container">
    <div class="admin-content">
      <div class="card">
        <div class="card-header">
          <h2 class="d-inline">View Member Profile</h2>
          <a href="member.php" class="btn btn-success float-right">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"/>
            </svg>
            Member List
          </a>
        </div>
        <div class="card-body position-relative">
          <div id="table-data">
            <?php
              $db = new Database();
              $member_id = $_GET['mid'];
              $db->select('member','member.member_id,member.member_img,member.member_fname,member.member_lname,member.member_gender,member.member_birth,member.member_group,member.member_address,member.member_city,
                          member.member_state,member.member_phone,member.member_email,member.member_weight,member.member_height,member.member_chest,member.member_waist,member.member_thigh,member.member_arm,member.member_fat,
                          member.staff_member,member.membership,member.start_date,member.end_date,membership.membership_id,membership.membership_name,groups.group_id,groups.group_name,staff_member.staff_id,staff_member.staff_fname,staff_member.staff_lname',
                          "membership ON member.membership=membership.membership_id LEFT JOIN groups ON member.member_group=groups.group_id LEFT JOIN staff_member ON member.staff_member=staff_member.staff_id","member.member_id='{$member_id}'",null,null);
              $result = $db->getResult();
              if(count($result) > 0){
                $i = 0;
                foreach($result as $row){
                  $i++;
            ?>
            <div class="row">
              <div class="col-md-6 mb-4">
                <div class="card-header bg-info">
                  <h5 class="d-inline text-white">Personal Information</h5>
                </div>
                <div class="border p-3">
                  <?php
                    if($row['member_img'] != ''){ ?>
                      <img src="images/member/<?php echo $row['member_img']; ?>" style="margin-bottom:20px;" width="100px" height="100px" alt="">
                  <?php }else{ 
                      $img = ($row['member_gender'] == 'male')?'man.png' : 'woman.png';  ?>
                      <img src="images/member/<?php echo $img; ?>" width="100px" height="100px" style="margin-bottom:20px;" alt="">
                  <?php } ?>
                <table width="100%" class="view-member">
                  <tbody>
                          <tr>
                            <td class="label">Member Name :</td>
                            <td><?php echo $row['member_fname'].' '.$row['member_lname']; ?></td>
                          </tr>
                          <tr>
                            <td class="label">Mobile No :</td>
                            <td><?php echo $row['member_phone']; ?></td>
                          </tr>
                          <tr>
                            <td class="label">Email :</td>
                            <td><?php echo $row['member_email']; ?></td>
                          </tr>
                          <tr>
                            <td class="label">Date Of Birth :</td>
                            <td><?php echo date('j F,Y',strtotime($row['member_birth'])); ?></td>
                          </tr>
                          <tr>
                            <td class="label">Gender :</td>
                            <td><?php echo $row['member_gender']; ?></td>
                          </tr>
                          <tr>
                            <td class="label">Address :</td>
                            <td><?php echo $row['member_address']; ?></td>
                          </tr>
                          <tr>
                            <td class="label">City :</td>
                            <td><?php echo $row['member_city']; ?></td>
                          </tr>
                          <tr>
                            <td class="label">State :</td>
                            <td><?php echo $row['member_state']; ?></td>
                          </tr>
                        </tr>
                  </tbody>
               </table>
             </div>
              </div>
              <div class="offset-md-1 col-md-5" style="height:100%;">
                <div class="card-header bg-info">
                  <h5 class="d-inline text-white">Physical Information</h5>
                </div>
                <div class="border p-3">
                  <table width="100%" class="view-member">
                    <tbody>
                            <tr>
                              <td class="label">Member Weight :</td>
                              <td><?php echo ($row['member_weight'] != '')? $row['member_weight'].' kg' : ''; ?></td>
                            </tr>
                            <tr>
                              <td class="label">Member Height :</td>
                              <td><?php echo ($row['member_height'] != '') ? $row['member_height'].' cm': ''; ?></td>
                            </tr>
                            <tr>
                              <td class="label">Member Chest :</td>
                              <td><?php echo ($row['member_chest'] != '') ? $row['member_chest'].' cm' : ''; ?></td>
                            </tr>
                            <tr>
                              <td class="label">Member Waist :</td>
                              <td><?php echo ($row['member_waist'] != '') ? $row['member_waist'].' Inch' : ''; ?></td>
                            </tr>
                            <tr>
                              <td class="label">Member Thigh :</td>
                              <td><?php echo ($row['member_thigh'] != '') ? $row['member_thigh'].' inch' : ''; ?></td>
                            </tr>
                            <tr>
                              <td class="label">Member Arm :</td>
                              <td><?php echo ($row['member_arm'] != '') ? $row['member_arm'].' Inch' : ''; ?></td>
                            </tr>
                            <tr>
                              <td class="label">Member Fat :</td>
                              <td><?php echo ($row['member_fat'] != '') ? $row['member_fat'].'%' : ''; ?></td>
                            </tr>
                          </tr>
                    </tbody>
                 </table>
                </div>
              </div>
              <div class="col-md-6">
                <div class="card-header bg-info">
                  <h5 class="d-inline text-white">More Information</h5>
                </div>
                <div class="border p-3">
                  <table width="100%" class="view-member">
                    <tbody>
                            <tr>
                              <td class="label">Membership :</td>
                              <td><?php echo $row['membership_name']; ?></td>
                            </tr>
                            <tr>
                              <td class="label">Joining Date :</td>
                              <td><?php echo date('j F,Y',strtotime($row['start_date'])); ?></td>
                            </tr>
                            <tr>
                              <td class="label">Expiring Date :</td>
                              <td><?php echo date('j F,Y',strtotime($row['end_date'])); ?></td>
                            </tr>
                            <tr>
                              <td class="label">Group :</td>
                              <td><?php echo $row['group_name']; ?></td>
                            </tr>
                            <tr>
                              <td class="label">Staff Member :</td>
                              <td><?php echo $row['staff_fname'].' '.$row['staff_lname']; ?></td>
                            </tr>
                          </tr>
                    </tbody>
                 </table>
                </div>
              </div>
            </div>
           <?php
               }
             }
           ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>

<?php include "footer.php" ?>
