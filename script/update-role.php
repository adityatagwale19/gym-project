<?php $title = "Update Role";
include "header.php" ?>
  <div class="message"></div>
  <div class="container">
    <div class="admin-content">
      <div class="card">
        <div class="card-header">
          <h2 class="d-inline">Edit Role</h2>
          <a href="role.php" class="btn btn-success float-right">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"/>
            </svg>
            Role List
          </a>
        </div>
        <div class="card-body position-relative">
          <?php
            $role_id = $_GET['roid'];
            $db = new Database();
            $db->select("role","*",null,"role_id=$role_id",null,null);
            $result = $db->getResult();
            if(count($result) > 0){
              foreach ($result as $row) {
          ?>
          <form class="yourform" id="update-role" action="" method="post" autocomplete="off">
              <div class="form-group">
                  <label>Name</label>
                  <input type="hidden" name="role_id" value="<?php echo $row['role_id']; ?>" required>
                  <input type="text" class="form-control role_name" placeholder="Role Name" name="role_name" value="<?php echo $row['role_name']; ?>" required>
              </div>
              <div class="form-group">
                  <label>Description</label>
                  <textarea name="role_desc" class="form-control role_desc" rows="8" cols="80"><?php echo $row['role_desc']; ?></textarea>
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