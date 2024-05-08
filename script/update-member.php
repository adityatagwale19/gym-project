<?php $title = "Update Member";
include "header.php" ?>

  <div class="container">
    <div class="admin-content">
      <div class="card">
        <div class="card-header">
          <h2 class="d-inline">Edit Member</h2>
          <a href="member.php" class="btn btn-success float-right">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"/>
            </svg>
            Member List
          </a>
        </div>
        <div class="card-body position-relative">
          <div class="message"></div>
          <?php
            $member_id = $_GET['mid'];
            $db = new Database();
            $db->select('member','*',null,"member_id=$member_id",null,null);
            $result = $db->getResult();
            if(count($result) > 0){
              foreach ($result as $row) {
          ?>
          <form class="yourform" id="update-member" action="" method="post" autocomplete="off">
              <h5 class="border-bottom pb-2 mb-4">Personal Information</h5>
              <div class="form-group">
                <input type="hidden" name="member_id" value="<?php echo $row['member_id']; ?>">
              </div>
              <div class="form-group">
                  <label>Image</label>
                  <input type="file" class="new_logo image" name="new_logo" />
                  <input type="hidden" class="old_logo image" name="old_logo" value="<?php echo $row['member_img']; ?>">
                  <?php if($row['member_img'] != ''){ ?>
                    <img id="image" src="images/member/<?php echo $row['member_img']; ?>" width="50px" />
                  <?php }else{ ?>
                    <img id="image" src="" width="50px" />
                  <?php } ?>
                  
              </div>
              <div class="form-group">
                  <label>First Name</label>
                  <input type="text" class="form-control fname" placeholder="First Name" name="fname" value="<?php echo $row['member_fname']; ?>" required>
              </div>
              <div class="form-group">
                  <label>Last Name</label>
                  <input type="text" class="form-control lname" placeholder="Last Name" name="lname" value="<?php echo $row['member_lname']; ?>" required>
              </div>
              <div class="form-group">
                  <label class="mr-2 mb-0">Gender: </label>
                  <?php
                    if($row['member_gender'] == 'male'){ ?>
                      <label for="" class="mb-0 mr-2">
                        <input type="radio" class="mr-1 gender" name="gender" value="male" checked="">
                        Male
                      </label>
                      <label for="" class="mb-0 mr-2">
                        <input type="radio" class="mr-1 gender" name="gender" value="female">
                        Female
                      </label>
                  <?php }else if($row['member_gender'] == 'female'){ ?>
                      <label for="" class="mb-0 mr-2">
                        <input type="radio" class="mr-1 gender" name="gender" value="male">
                        Male
                      </label>
                      <label for="" class="mb-0">
                        <input type="radio" class="mr-1 gender" name="gender" value="female" checked="">
                        Female
                      </label>
                  <?php } ?>
              </div>
              <div class="form-group">
                  <label>Date Of Birth</label>
                  <input type="date" class="form-control birth" name="birth" value="<?php echo $row['member_birth']; ?>" required>
              </div>
              <div class="form-group">
                  <label>Group</label>
                  <?php
                    $db->select('groups','*',null,null,null,null);
                    $result1 = $db->getResult();
                    $member_group = explode(",",$row['member_group']);
                    if(count($result1) > 0){ ?>
                      <select class="form-control select2 group" name="group[]" multiple="multiple" style="width:100%;" required>
                      <?php foreach($result1 as $row1){
                        if(in_array($row1['group_id'],$member_group)){ ?>
                          <option selected value="<?php echo $row1['group_id']; ?>"><?php echo $row1['group_name']; ?></option>
                      <?php }else{ ?>
                          <option value="<?php echo $row1['group_id']; ?>"><?php echo $row1['group_name']; ?></option>
                      <?php } ?>
                    <?php } ?>
                  </select>
                <?php } ?>
              </div>

              <h5 class="border-bottom pb-2 mb-4">Contact Information</h5>
              <div class="form-group">
                  <label>Address</label>
                  <input type="text" class="form-control address" name="address" value="<?php echo $row['member_address']; ?>" required>
              </div>
              <div class="form-group">
                  <label>City</label>
                  <input type="text" class="form-control city" name="city" value="<?php echo $row['member_city']; ?>" required>
              </div>
              <div class="form-group">
                  <label>State</label>
                  <input type="text" class="form-control state" name="state" value="<?php echo $row['member_state']; ?>" required>
              </div>
              <div class="form-group">
                  <label>Phone</label>
                  <input type="number" class="form-control phone" name="phone" value="<?php echo $row['member_phone']; ?>" required>
              </div>
              <div class="form-group">
                  <label>Email</label>
                  <input type="email" class="form-control email" name="email" value="<?php echo $row['member_email']; ?>" required>
              </div>

              <h5 class="border-bottom pb-2 mb-4">Physical Information</h5>
              <div class="form-group">
                  <label>Weight</label>
                  <input type="text" class="form-control weight" name="weight" placeholder="KG" value="<?php echo $row['member_weight']; ?>">
              </div>
              <div class="form-group">
                  <label>Height</label>
                  <input type="text" class="form-control height" name="height" placeholder="Centimeter" value="<?php echo $row['member_height']; ?>">
              </div>
              <div class="form-group">
                  <label>Chest</label>
                  <input type="text" class="form-control chest" name="chest" placeholder="Inches" value="<?php echo $row['member_chest']; ?>">
              </div>
              <div class="form-group">
                  <label>Waist</label>
                  <input type="text" class="form-control waist" name="waist" placeholder="Inches" value="<?php echo $row['member_waist']; ?>">
              </div>
              <div class="form-group">
                  <label>Thigh</label>
                  <input type="text" class="form-control thigh" name="thigh" placeholder="Inches" value="<?php echo $row['member_thigh']; ?>">
              </div>
              <div class="form-group">
                  <label>Arms</label>
                  <input type="text" class="form-control arms" name="arms" placeholder="Inches" value="<?php echo $row['member_arm']; ?>">
              </div>
              <div class="form-group">
                  <label>Fat</label>
                  <input type="text" class="form-control fat" name="fat" placeholder="Percentage" value="<?php echo $row['member_fat']; ?>">
              </div>
              <h5 class="border-bottom pb-2 mb-4">More Information</h5>
              <div class="form-group">
                  <label>Select Staff Member</label>
                  <?php
                    $db->select('staff_member','staff_member.staff_id,staff_member.staff_fname,staff_member.staff_lname,role.role_name','role ON role.role_id = staff_member.staff_role',null,null,null);
                    $result2 = $db->getResult();
                    $staff_member = explode(",",$row['staff_member']);
                    if(count($result2) > 0){ ?>
                      <select class="form-control select2 staff" name="staff[]" multiple="multiple" style="width:100%;" required>
                      <?php foreach($result2 as $row2){
                        if(in_array($row2['staff_id'],$staff_member)){ ?>
                          <option selected value="<?php echo $row2['staff_id'] ?>"><?php echo $row2['staff_fname'].''.$row2['staff_lname']; ?> (<?php echo $row2['role_name']; ?>)</option>
                        <?php }else{ ?>
                          <option value="<?php echo $row2['staff_id'] ?>"><?php echo $row2['staff_fname'].''.$row2['staff_lname']; ?> (<?php echo $row2['role_name']; ?>)</option>
                        <?php } ?>
                      <?php } ?>
                  </select>
                <?php } ?>
              </div>
              <div class="form-group">
                  <label>Membership</label>
                  <?php
                    $days = 0;
                    $db->select('membership','*',null,null,null,null);
                    $result3 = $db->getResult();
                    if(count($result2) > 0){ ?>
                      <select class="form-control membership_update" name="membership" style="width:100%;" required>
                      <?php foreach($result3 as $row3){
                        if($row['membership'] == $row3['membership_id']){ ?>
                          <?php $days=$row3['membership_period']; ?>
                          <option selected value="<?php echo $row3['membership_id']; ?>"><?php echo $row3['membership_name']; ?></option>
                        <?php }else{ ?>
                          <option value="<?php echo $row3['membership_id']; ?>"><?php echo $row3['membership_name']; ?></option>
                        <?php } ?>
                      <?php } ?>
                  </select>
                <?php } ?>
              </div>
              <div class="form-group">
                  <label>Membership Valid From</label>
                  <div class="row">
                    <div class="col-md-5">
                      <span id="select_days_update" class="d-none"><?php echo $days; ?></span>
                      <input type="date" class="form-control start_date_update" name="start_date" value="<?php echo $row['start_date']; ?>" required>
                    </div>
                    <div class="col-md-2">
                      <h5 class="d-block text-center py-2 mb-0">To</h5>
                    </div>
                    <div class="col-md-5">
                      <input type="date" class="form-control end_date_update bg-secondary text-white" name="end_date" value="<?php echo $row['end_date']; ?>" required>
                    </div>
                  </div>
              </div>
              <input type="submit" name="save" class="btn btn-info float-right" value="Save" required>
          </form>
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


<?php include "footer.php" ?>
