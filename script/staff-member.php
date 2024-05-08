<?php $title = "Staff Member";
include "header.php" ?>
  <div class="container">
    <div class="admin-content">
      <div class="card">
        <div class="card-header">
          <h2 class="d-inline">Staff Member List</h2>
          <a href="add-staff.php" class="btn btn-info float-right">Add Staff Member</a>
        </div>
        <div class="card-body position-relative">
          <div class="message"></div>
          <div id="table-data">
            <?php
              $db = new Database();
              $db->sql("SELECT staff_member.staff_id,staff_member.staff_img,staff_member.staff_fname,staff_member.staff_lname,staff_member.staff_gender,staff_member.staff_birth,staff_member.staff_role,
                        staff_member.staff_speci,staff_member.staff_address,staff_member.staff_city,staff_member.staff_state,staff_member.staff_phone,staff_member.staff_email,
                        GROUP_CONCAT(DISTINCT CONCAT(role.role_name) ORDER BY staff_member.staff_role) AS staff_role FROM staff_member
                        LEFT JOIN role ON FIND_IN_SET(role.role_id,staff_member.staff_role) > 0 GROUP BY staff_member.staff_id ORDER BY staff_member.staff_id DESC");
              $result = $db->getResult();
            ?>
            <table class="table-data table table-bordered">
              <thead class="thead-light">
                <tr>
                  <th>S.No</th>
                  <th>Photo</th>
                  <th>Staff Member Name</th>
                  <th>Role</th>
                  <th>Email</th>
                  <th>Mobile No.</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  if(count($result) > 0){
                    $i = 0;
                    foreach($result as $row){
                      $i++;
                ?>
                    <tr>
                      <td><?php echo $i; ?></td>
                      <td>
                        <?php
                          if($row['staff_img'] != ''){ ?>
                            <img src="images/staff-member/<?php echo $row['staff_img']; ?>" width="40px" height="40px" style="border-radius:50%; object-fit: cover;" alt="">
                        <?php }else{ $img = ($row['staff_gender'] == 'male')?'man.png' : 'woman.png'; ?>
                            <img src="images/staff-member/<?php echo $img; ?>" width="40px" height="40px" style="border-radius:50%; object-fit: cover;" alt="">
                        <?php } ?>
                      </td>
                      <td><?php echo $row['staff_fname'].' '.$row['staff_lname']; ?></td>
                      <td><?php echo $row['staff_role']; ?></td>
                      <td><?php echo $row['staff_email']; ?></td>
                      <td><?php echo $row['staff_phone']; ?></td>
                      <td>
                        <ul class="action-list">
                          <li><a href="view-staff-member.php?stid=<?php echo $row['staff_id']; ?>" class="btn btn-success btn-sm"><img src="images/eye.png" alt=""></a></li>
                          <li><a href="update-staff.php?stid=<?php echo $row['staff_id']; ?>" class="btn btn-primary btn-sm"><img src="images/edit.png" alt=""></a></li>
                          <li><a href="#" data-stid=<?php echo $row['staff_id']; ?> class="btn btn-danger btn-sm delete-staff"><img src="images/delete.png" alt=""></a></li>
                        </ul>
                      </td>
                    </tr>
                  <?php
                      }
                    }
                  ?>
              </tbody>
           </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>

<?php include "footer.php" ?>
