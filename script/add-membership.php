<?php $title = "Add Membership";
include "header.php" ?>
  <div class="container">
    <div class="admin-content">
      <div class="card">
        <div class="card-header">
          <h2 class="d-inline">Add Membership</h2>
          <a href="membership.php" class="btn btn-success float-right">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"/>
            </svg>
            Membership List
          </a>
        </div>
        <div class="card-body position-relative">
          <div class="message"></div>
          <?php
            $db = new Database();
            $db->select('category','*',null,null,null,null);
            $result = $db->getResult();
            if(empty($result)){ ?>
              <div class="alert alert-danger">First Add Categories</div>
          <?php } ?>
          <form class="yourform" id="add-membership" action="<?php $_SERVER['PHP_SELF']; ?>" method="post" autocomplete="off">
              <div class="form-group">
                  <label>Membership Name</label>
                  <input type="text" class="form-control membership_name" placeholder="Membership Name" name="membership_name" value="" required>
              </div>
              <div class="form-group">
                  <label>Membership Category</label>
                  <select class="form-control membership_cat" name="membership_cat" style="width:100%;" required>
                    <option value="" selected disabled>Select Category</option>
                    <?php
                      if(count($result) > 0){
                        foreach ($result as $row) {
                          echo "<option value='{$row['cat_id']}'>{$row['cat_name']}</option>";
                        }
                      }
                    ?>
                  </select>
              </div>
              <div class="form-group">
                  <label>Membership Period</label>
                  <input type="number" class="form-control membership_period" placeholder="No. Of Days" name="membership_period" value="" required>
              </div>
              <div class="form-group">
                  <label>Membership Amount</label>
                  <input type="number" class="form-control membership_amount" placeholder="Membership Amount" name="membership_amount" value="" required>
              </div>
              <div class="form-group">
                  <label>Membership Description</label>
                  <textarea name="membership_desc" class="form-control membership_desc" placeholder="Membership Description" rows="8" cols="80"></textarea>
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
