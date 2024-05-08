<?php $title = "Staff Member Attendance";
include "header.php" ?>
  <div class="message"></div>
  <div class="container">
    <div class="admin-content">
      <div class="card mb-4">
        <div class="card-header">
          <h2 class="d-inline">Staff Member Attendance</h2>
        </div>
        <div class="card-body">
          <form class="yourform" id="staff-attendance" action="<?php $_SERVER['PHP_SELF']; ?>" method="post" autocomplete="off">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Date</label>
                    <input type="date" class="form-control staff_date" name="current_date" value="<?php echo date('Y-m-d'); ?>" required>
                  </div>
                </div>
              </div>
          </form>
          <div class="staff-attendance">
            <div class="card-header bg-info border mb-4">
              <h5 class="d-inline text-white">Staff Member List</h5>
            </div>
            <table class="staff-table table-data table table-bordered">
              <?php
                $db = new Database();
                $date = $db->escapeString(date('Y-m-d'));

                $db->select('staff_member','staff_member.staff_id,staff_member.staff_img,staff_member.staff_fname,staff_member.staff_lname',null,null,null,null);
                $result = $db->getResult();
                $db->select('staff_attendance','*',null,"att_date='{$date}'",null,null);
                $attendance = $db->getResult();
              ?>
              <thead class="thead-light">
                <tr>
                  <th>Action</th>
                  <th>Photo</th>
                  <th>Staff Member Name</th>
                  <th>Status</th>
                </tr>
              </thead>
              <?php
                if(!empty($result)){
                  $i=0;
                  foreach($result as $key => $value){
                    $i++;
              ?>
              <tbody>
                <tr>
                  <td>
                    <input type="text" name="staff_member[]" class="staff_id" id="staff" value="<?php echo $value['staff_id']; ?>" hidden>
                      <div class="checkbox">
                      <?php
                      if(isset($attendance[$key])){ ?>
                        <?php if($value['staff_id'] == $attendance[$key]['staff_id']){
                          if($attendance[$key]['att_status'] == '1'){ ?>
                            <input type="checkbox" name="staff_att[]" class="staff_att" id="checkbox<?php echo $value['staff_id']; ?>"  checked="">
                          <?php }elseif ($attendance[$key]['att_status'] == '0') { ?>
                            <input type="checkbox" name="staff_att[]" class="staff_att" id="checkbox<?php echo $value['staff_id']; ?>">
                          <?php }else{ ?>
                            <input type="checkbox" name="staff_att[]" class="staff_att" id="checkbox<?php echo $value['staff_id']; ?>" checked="">
                          <?php } ?>
                        <?php } ?>
                      <?php }else{ ?>
                        <input type="checkbox" name="staff_att[]" class="staff_att" id="checkbox<?php echo $value['staff_id']; ?>" checked="">
                      <?php } ?>
                        <label for="checkbox<?php echo $value['staff_id']; ?>"></label>
                      </div>
                  </td>
                  <td>
                    <?php
                      if($value['staff_img'] != ''){ ?>
                        <img src="images/staff-member/<?php echo $value['staff_img']; ?>" width="40px" height="40px" style="border-radius:50%; object-fit: cover;" alt="">
                    <?php }else{ ?>
                        <img src="images/staff-member/staff-member.png" width="40px" height="40px" style="border-radius:50%; object-fit: cover;" alt="">
                    <?php } ?>
                  </td>
                  <td><?php echo $value["staff_fname"].' '.$value["staff_lname"] ?></td>
                  <?php
                  if(isset($attendance[$key])){
                    if($value['staff_id'] == $attendance[$key]['staff_id']){
                      if($attendance[$key]['att_status'] == '1'){ ?>
                        <td>Present</td>
                      <?php }elseif ($attendance[$key]['att_status'] == '0') { ?>
                        <td>Absent</td>
                      <?php }else{ ?>
                        <td>Not Taken</td>
                      <?php } ?>
                    <?php } ?>
                  <?php }else{ ?>
                    <td>Not Taken</td>
                  <?php } ?>
                </tr>
              </tbody>
              <?php
                }
              }
              ?>
            </table>
            <button type="button" class="save-staff-att" name="button">Save</button>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
</div>
</div>


<?php include "footer.php" ?>
