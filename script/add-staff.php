<?php $title = "Add Staff Member";
include "header.php" ?>
  <div class="container">
    <div class="admin-content">
      <div class="card">
        <div class="card-header">
          <h2 class="d-inline">Add Staff Member</h2>
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
            $db = new Database();
            $db->select('role','*',null,null,null,null);
            $result = $db->getResult();
            if(empty($result)){ ?>
              <div class="alert alert-danger">First Add Role</div>
          <?php } ?>
          <?php
            $db->select('specialization','*',null,null,null,null);
            $result1 = $db->getResult();
            if(empty($result1)){ ?>
              <div class="alert alert-danger">First Add Specialization</div>
          <?php } ?>
          <form class="yourform" id="add-staff" action="<?php $_SERVER['PHP_SELF']; ?>" method="post" autocomplete="off">
              <h6 class="border-bottom pb-2 mb-4">Personal Information</h6>
              <div class="form-group">
                  <label>Image</label>
                  <input type="file" class="image" name="staff_image" value="" />
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
                  <label>Assign Role</label>
                  <select class="form-control select2 role" name="role[]" multiple="multiple" style="width:100%;" id="role_list"  required>
                    <option value="" disabled>Select Role</option>
                    <?php
                      if(count($result) > 0){
                        foreach ($result as $row) {
                          echo "<option value='{$row['role_id']}'>{$row['role_name']}</option>";
                        }
                      }
                    ?>
                  </select>
              </div>
              <div class="form-group">
                  <label>Specialization</label>
                  <select class="form-control select2 speci" name="speci[]" multiple="multiple" style="width:100%;" id="speci_list"  required>
                    <option value="" disabled>Select Specialization</option>
                    <?php
                      if(count($result1) > 0){
                        foreach ($result1 as $row1) {
                          echo "<option value='{$row1['speci_id']}'>{$row1['speci_name']}</option>";
                        }
                      }
                    ?>
                  </select>
              </div>
              <h6 class="border-bottom pb-2 mb-3">Contact Information</h6>
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
