<?php $title = "Update Category";
include "header.php" ?>
  <div class="message"></div>
  <div class="container">
    <div class="admin-content">
      <div class="card">
        <div class="card-header">
          <h2 class="d-inline">Edit Category</h2>
          <a href="category.php" class="btn btn-success float-right">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"/>
            </svg>
            Category List
          </a>
        </div>
        <div class="card-body position-relative">
          <?php
            $cat_id = $_GET['caid'];
            $db = new Database();
            $db->select("category","*",null,"cat_id=$cat_id",null,null);
            $result = $db->getResult();
            if(count($result) > 0){
              foreach ($result as $row) {
          ?>
          <form class="yourform" id="update-category" action="" method="post" autocomplete="off">
              <div class="form-group">
                  <label>Name</label>
                  <input type="hidden" name="cat_id" value="<?php echo $row['cat_id']; ?>" required>
                  <input type="text" class="form-control cat_name" name="cat_name" value="<?php echo $row['cat_name']; ?>" required>
              </div>
              <div class="form-group">
                  <label>Description</label>
                  <textarea name="cat_desc" class="form-control cat_desc" rows="8" cols="80"><?php echo $row['cat_desc']; ?></textarea>
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
