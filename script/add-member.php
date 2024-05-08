<?php $title = "Add Member";
include "header.php" ?>

  <div class="container">
    <div class="admin-content">
      <div class="card">
        <div class="card-header">
          <h2 class="d-inline">Add Member</h2>
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
            $db = new Database();
            $db->select('groups','*',null,null,null,null);
            $result = $db->getResult();
            if(empty($result)){ ?>
              <div class="alert alert-danger">First Add Group</div>
          <?php } ?>
          <?php
            $db->select('staff_member','staff_member.staff_id,staff_member.staff_fname,staff_member.staff_lname,role.role_name','role ON role.role_id = staff_member.staff_role',null,null,null);
            $result1 = $db->getResult();
            if(empty($result1)){ ?>
              <div class="alert alert-danger">First Add Staff Member</div>
          <?php } ?>
          <?php
            $db->select('membership','*',null,null,null,null);
            $result2 = $db->getResult();
            if(empty($result2)){ ?>
              <div class="alert alert-danger">First Add Membership</div>
          <?php } ?>
          <form class="yourform" id="add-member" action="<?php $_SERVER['PHP_SELF']; ?>" method="post" autocomplete="off">
              <h5 class="border-bottom pb-2 mb-4">Personal Information</h5>
              <div class="form-group">
                  <label>Image</label>
                  <input type="file" class="image" name="member_image" value="">
                  <img id="image" src="" width="100px" />
              </div>
              <div class="form-group">
                  <label>First Name</label>
                  <input type="text" class="form-control fname" placeholder="First Name" name="fname" value="" required>
              </div>
              <div class="form-group">
                  <label>Last Name</label>
                  <input type="text" class="form-control lname" placeholder="Last Name" name="lname" value="" required>
              </div>
              <div class="form-group">
                  <label class="mr-2 mb-0">Gender: </label>
                  <label for="" class="mb-0 mr-2">
                    <input type="radio" class="mr-1 gender" name="gender" value="male" checked="">
                    Male
                  </label>
                  <label for="" class="mb-0">
                    <input type="radio" class="mr-1 gender" name="gender" value="female">
                    Female
                  </label>
              </div>
              <div class="form-group">
                  <label>Date Of Birth</label>
                  <input type="date" class="form-control birth" name="birth" value="" required>
              </div>
              <div class="form-group">
                  <label>Group</label>
                  <select class="form-control select2 group" name="group[]" multiple="multiple" style="width:100%;" required>
                    <option value="" disabled>Select Group</option>
                    <?php
                      if(count($result) > 0){
                        foreach ($result as $row) {
                          echo "<option value='{$row['group_id']}'>{$row['group_name']}</option>";
                        }
                      }
                    ?>
                  </select>
              </div>

              <h5 class="border-bottom pb-2 mb-4">Contact Information</h5>
              <div class="form-group">
                  <label>Address</label>
                  <input type="text" class="form-control address" name="address" value="" required>
              </div>
              <div class="form-group">
                  <label>City</label>
                  <input type="text" class="form-control city" name="city" value="" required>
              </div>
              <div class="form-group">
                  <label>State</label>
                  <input type="text" class="form-control state" name="state" value="" required>
              </div>
              <div class="form-group">
                  <label>Phone</label>
                  <input type="number" class="form-control phone" name="phone" value="" required>
              </div>
              <div class="form-group">
                  <label>Email</label>
                  <input type="email" class="form-control email" name="email" value="" required>
              </div>

              <h5 class="border-bottom pb-2 mb-4">Physical Information</h5>
              <div class="form-group">
                  <label>Weight</label>
                  <input type="text" class="form-control weight" name="weight" placeholder="KG" value="">
              </div>
              <div class="form-group">
                  <label>Height</label>
                  <input type="text" class="form-control height" name="height" placeholder="Centimeter" value="">
              </div>
              <div class="form-group">
                  <label>Chest</label>
                  <input type="text" class="form-control chest" name="chest" placeholder="Centimeter" value="">
              </div>
              <div class="form-group">
                  <label>Waist</label>
                  <input type="text" class="form-control waist" name="waist" placeholder="Inches" value="">
              </div>
              <div class="form-group">
                  <label>Thigh</label>
                  <input type="text" class="form-control thigh" name="thigh" placeholder="Inches" value="">
              </div>
              <div class="form-group">
                  <label>Arms</label>
                  <input type="text" class="form-control arms" name="arms" placeholder="Inches" value="">
              </div>
              <div class="form-group">
                  <label>Fat</label>
                  <input type="text" class="form-control fat" name="fat" placeholder="Percentage" value="">
              </div>
              <h5 class="border-bottom pb-2 mb-4">More Information</h5>
              <div class="form-group">
                  <label>Select Staff Member</label>
                  <select class="form-control select2 staff" name="staff[]" multiple="multiple" style="width:100%;" required>
                    <option value="" disabled>Select Staff Member</option>
                    <?php
                      if(count($result1) > 0){
                        foreach ($result1 as $row1) {
                          echo "<option value='{$row1['staff_id']}'>{$row1['staff_fname']} {$row1['staff_lname']} ({$row1['role_name']})</option>";
                        }
                      }
                    ?>
                  </select>
              </div>
              <div class="form-group">
                  <label>Membership</label>
                  <select class="form-control membership" name="membership" style="width:100%;" required>
                    <option value="" selected disabled>Select Membership</option>
                    <?php
                      if(count($result2) > 0){
                        foreach ($result2 as $row2) {
                          echo "<option value='{$row2['membership_id']}'>{$row2['membership_name']}</option>";
                        }
                      }
                    ?>
                  </select>
              </div>
              <div class="form-group">
                  <label>Membership Valid From</label>
                  <div class="row">
                    <div class="col-md-5">
                      <span id="select_days" class="d-none"></span>
                      <input type="date" class="form-control start_date" name="start_date" value="" required>
                    </div>
                    <div class="col-md-2">
                      <h5 class="d-block text-center py-2 mb-0">To</h5>
                    </div>
                    <div class="col-md-5">
                      <input type="date" class="form-control end_date bg-secondary text-white" name="end_date" value="" required>
                    </div>
                  </div>
              </div>
              <input type="submit" name="save" class="btn btn-info float-right" value="Save" required>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>


<?php include "footer.php" ?>
