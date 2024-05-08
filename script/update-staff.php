<?php $title = "Update Staff Member";
include "header.php" ?>
  <div class="container">
    <div class="admin-content">
      <div class="card">
        <div class="card-header">
          <h2 class="d-inline">Edit Staff Member</h2>
          <a href="staff-member.php" class="btn btn-success float-right">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"/>
            </svg>
            Staff Member List
          </a>
        </div>
        <div class="card-body position-relative">
          <div class="message"></div>
          <?php
            $staff_id = $_GET['stid'];
            $db = new Database();
            $db->select('staff_member','*',null,"staff_id=$staff_id",null,null);
            $result = $db->getResult();
            if(count($result) > 0){
              foreach ($result as $row) {
          ?>
          <form class="yourform" id="update-staff" action="" method="post" autocomplete="off">
              <h6 class="border-bottom pb-2 mb-4">Personal Information</h6>
              <div class="form-group">
                <input type="hidden" name="staff_id" value="<?php echo $row['staff_id']; ?>">
              </div>
              <div class="form-group">
                  <label>Image</label>
                  <input type="file" class="new_logo image" name="new_logo" />
                  <input type="hidden" class="old_logo image" name="old_logo" value="<?php echo $row['staff_img']; ?>">
                  <?php if($row['staff_img'] !=''){ ?>
                    <img id="image" src="images/staff-member/<?php echo $row['staff_img']; ?>" width="50px" />
                  <?php }else{ ?>
                    <img id="image" src="" width="50px" />
                  <?php } ?>
              </div>
              <div class="form-group">
                  <label>First Name</label>
                  <input type="text" class="form-control fname" name="fname" value="<?php echo $row['staff_fname']; ?>" required>
              </div>
              <div class="form-group">
                  <label>Last Name</label>
                  <input type="text" class="form-control lname" name="lname" value="<?php echo $row['staff_lname']; ?>" required>
              </div>
              <div class="form-group">
                  <label class="mr-2 mb-0">Gender: </label>
                  <?php
                    if($row['staff_gender'] == 'male'){ ?>
                      <label for="" class="mb-0 mr-2">
                        <input type="radio" class="mr-1 gender" name="gender" value="male" checked="">
                        Male
                      </label>
                      <label for="" class="mb-0 mr-2">
                        <input type="radio" class="mr-1 gender" name="gender" value="female">
                        Female
                      </label>
                  <?php }else if($row['staff_gender'] == 'female'){ ?>
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
                  <input type="date" class="form-control birth" name="birth" value="<?php echo $row['staff_birth']; ?>" required>
              </div>
              <div class="form-group">
                  <label>Assign Role</label>
                  <?php
                    $db->select('role','*',null,null,null,null);
                    $result1 = $db->getResult();
                    $staff_role = explode(",",$row['staff_role']);
                    if(count($result1) > 0){ ?>
                      <select class="form-control select2 role" name="states[]" multiple="multiple" style="width:100%;" id="role_list"  required>
                        <?php foreach ($result1 as $row1) {
                          if(in_array($row1['role_id'],$staff_role)){ ?>
                            <option selected value="<?php echo $row1['role_id'] ?>"><?php echo $row1['role_name']; ?></option>
                          <?php }else{ ?>
                            <option value="<?php echo $row1['role_id'] ?>"><?php echo $row1['role_name']; ?></option>
                          <?php } ?>
                        <?php } ?>
                      </select>
                    <?php } ?>
              </div>
              <div class="form-group">
                  <label>Specialization</label>
                  <?php
                    $db->select('specialization','*',null,null,null,null);
                    $result2 = $db->getResult();
                    $staff_speci = explode(",",$row['staff_speci']);
                    if(count($result2) > 0){ ?>
                      <select class="form-control select2 speci" name="states1[]" multiple="multiple" style="width:100%;" id="speci_list"  required>
                        <?php foreach ($result2 as $row2) {
                          if(in_array($row2['speci_id'],$staff_speci)){ ?>
                            <option selected value="<?php echo $row2['speci_id'] ?>"><?php echo $row2['speci_name']; ?></option>
                          <?php }else{ ?>
                            <option value="<?php echo $row2['speci_id'] ?>"><?php echo $row2['speci_name']; ?></option>
                          <?php } ?>
                        <?php } ?>
                      </select>
                    <?php } ?>
              </div>
              <h6 class="border-bottom pb-2 mb-3">Contact Information</h6>
              <div class="form-group">
                  <label>Address</label>
                  <input type="text" class="form-control address" name="address" value="<?php echo $row['staff_address']; ?>" required>
              </div>
              <div class="form-group">
                  <label>City</label>
                  <input type="text" class="form-control city" name="city" value="<?php echo $row['staff_city']; ?>" required>
              </div>
              <div class="form-group">
                  <label>State</label>
                  <input type="text" class="form-control state" name="state" value="<?php echo $row['staff_state']; ?>" required>
              </div>
              <div class="form-group">
                  <label>Phone</label>
                  <input type="number" class="form-control phone" name="phone" value="<?php echo $row['staff_phone']; ?>" required>
              </div>
              <div class="form-group">
                  <label>Email</label>
                  <input type="email" class="form-control email" name="email" value="<?php echo $row['staff_email']; ?>" required>
              </div>
              <input type="submit" name="save" class="btn btn-info float-right" value="Update" required>
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
