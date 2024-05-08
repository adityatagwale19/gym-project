<?php $title = "Member";
include "header.php" ?>
  <div class="message"></div>
  <div class="container">
    <div class="admin-content">
      <div class="card">
        <div class="card-header">
          <h2 class="d-inline">View Staff Member Profile</h2>
          <a href="staff-member.php" class="btn btn-success float-right">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"/>
            </svg>
            Staff Member List
          </a>
        </div>
        <div class="card-body position-relative">
          <div id="table-data">
            <?php
              $db = new Database();
              $staff_id = $_GET['stid'];
              $db->select('staff_member','staff_member.staff_id,staff_member.staff_img,staff_member.staff_fname,staff_member.staff_lname,staff_member.staff_gender,staff_member.staff_birth,staff_member.staff_role,
                          staff_member.staff_speci,staff_member.staff_address,staff_member.staff_city,staff_member.staff_state,staff_member.staff_phone,staff_member.staff_email,role.role_id,role.role_name,specialization.speci_id,specialization.speci_name',
                          "role ON staff_member.staff_role=role.role_id LEFT JOIN specialization ON staff_member.staff_speci=specialization.speci_id","staff_member.staff_id='$staff_id'",null,null);
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
                    if($row['staff_img'] != ''){ ?>
                      <img src="images/staff-member/<?php echo $row['staff_img']; ?>" style="margin-bottom:20px;" width="100px" height="100px" alt="">
                  <?php }else{ ?>
                      <img src="images/staff-member/staff-member.png" width="100px" height="100px" style="margin-bottom:20px;" alt="">
                  <?php } ?>
                <table width="100%" class="view-member">
                  <tbody>
                          <tr>
                            <td class="label">Staff Member Name :</td>
                            <td><?php echo $row['staff_fname'].' '.$row['staff_lname']; ?></td>
                          </tr>
                          <tr>
                            <td class="label">Mobile No :</td>
                            <td><?php echo $row['staff_phone']; ?></td>
                          </tr>
                          <tr>
                            <td class="label">Email :</td>
                            <td><?php echo $row['staff_email']; ?></td>
                          </tr>
                          <tr>
                            <td class="label">Date Of Birth :</td>
                            <td><?php echo date('j F,Y',strtotime($row['staff_birth'])); ?></td>
                          </tr>
                          <tr>
                            <td class="label">Gender :</td>
                            <td><?php echo $row['staff_gender']; ?></td>
                          </tr>
                          <tr>
                            <td class="label">Address :</td>
                            <td><?php echo $row['staff_address']; ?></td>
                          </tr>
                          <tr>
                            <td class="label">City :</td>
                            <td><?php echo $row['staff_city']; ?></td>
                          </tr>
                          <tr>
                            <td class="label">State :</td>
                            <td><?php echo $row['staff_state']; ?></td>
                          </tr>
                        </tr>
                  </tbody>
               </table>
             </div>
              </div>
              <div class="offset-md-1 col-md-5" style="height:100%;">
                <div class="card-header bg-info">
                  <h5 class="d-inline text-white">More Information</h5>
                </div>
                <div class="border p-3">
                  <table width="100%" class="view-member">
                    <tbody>
                            <tr>
                              <td class="label">Staff Member Role :</td>
                              <td><?php echo $row['role_name']; ?></td>
                            </tr>
                            <tr>
                              <td class="label">Staff Member Specialization :</td>
                              <td><?php echo $row['speci_name']; ?></td>
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
