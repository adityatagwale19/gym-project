<?php $title = "Member Attendance";
include "header.php" ?>
  <div class="message"></div>
  <div class="container">
    <div class="admin-content">
      <div class="card mb-4">
        <div class="card-header">
          <h2 class="d-inline">Member Attendance</h2>
        </div>
        <div class="card-body position-relative">
          <form class="yourform" id="show-attendance" action="<?php $_SERVER['PHP_SELF']; ?>" method="post" autocomplete="off">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Date</label>
                    <input type="date" class="form-control date" name="date" value="" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Group</label>
                    <select class="form-control group" name="group" style="width:100%;" required>
                      <option selected value="" disabled>Select Group</option>
                      <?php
                        $db = new Database();
                        $db->select('groups','*',null,null,null,null);
                        $result = $db->getResult();
                        if(count($result) > 0){
                          foreach ($result as $row) {
                            echo "<option value='{$row['group_id']}'>{$row['group_name']}</option>";
                          }
                        }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                    <input type="submit" name="save" class="btn btn-info float-right" style="margin-top:31px;" value="Take/View Attendance" required>
                </div>
              </div>
          </form>
        </div>
      </div>

      <div class="member-attendance">
        <div class="card">
          <div class="card-header bg-info">
            <h5 class="d-inline text-white">Member List</h5>
          </div>
          <div class="card-body">
            <table class="member-table table table-bordered">
              <thead class="thead-light">
                <tr>
                  <th>Action</th>
                  <th>Member Photo</th>
                  <th>Member Name</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>

              </tbody>
            </table>

              <button type="button" class="save-att btn btn-dark mt-2" name="button">Save</button>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>


<?php include "footer.php" ?>
