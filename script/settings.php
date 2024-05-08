<?php $title = "Settings";
include "header.php" ?>
  <div class="message"></div>
  <div class="container">
    <div class="admin-content">
      <div class="card">
        <div class="card-header">
          <h2 class="d-inline">Edit Settings</h2>
        </div>
        <div class="card-body position-relative">
          <?php
              $db = new Database();
              $db->select('settings','*',null,null,null,null);
              $result = $db->getResult();
              if($result > 0){
                foreach ($result as $row) {
          ?>
          <form class="yourform" id="update-settings" action="" method="post" enctype="multipart/form-data">
              <div class="form-group">
                  <label>Gym Name</label>
                  <input type="hidden" name="gym_id" value="<?php echo $row['gym_id']; ?>">
                  <input type="text" class="form-control gym_name" placeholder="" name="gym_name" value="<?php echo $row['gym_name']; ?>" required>
              </div>
              <div class="form-group">
                  <label>Gym Logo</label>
                  <input type="file" class="new_logo image" name="new_logo" />
                  <input type="hidden" class="old_logo image" name="old_logo" value="<?php echo $row['gym_logo']; ?>">
                  <img id="image" src="images/gym-logo/<?php echo $row['gym_logo']; ?>" alt="" width="100px"/>
              </div>
              <div class="form-group">
                  <label>Currency Format</label>
                  <input type="text" class="form-control gym_currency" placeholder="" name="gym_currency" value="<?php echo $row['gym_currency']; ?>" required>
              </div>
              <input type="submit"  name="save" class="btn btn-primary float-right" value="Update" required>
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
