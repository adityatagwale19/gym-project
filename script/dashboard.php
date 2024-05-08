<?php $title = "Dashboard";
include "header.php";
?>
<div class="admin-content">
  <div class="container">
    <div id="admin-dashboard">
      <div class="row">
        <div class="col-md-3">
          <?php
            $db = new Database();

            $db->sql("SELECT COUNT(*) AS total_member FROM member");
            $result = $db->getResult();
            if(!empty($result)){
              foreach ($result as $row) {
          ?>
          <div class="card bg-success">
            <div class="card-body text-center" style="padding: 30px 20px;">
              <img src="images/member.png" class="mb-4" alt="" style="width:40%;">
              <p class="card-text mb-3"><?php echo $row['total_member']; ?></p>
              <h5 class="card-title text-white mb-0">Total member</h5>
            </div>
          </div>
          <?php
            }
          }
          ?>
        </div>
        <div class="col-md-3">
          <?php
            $db = new Database();

            $db->sql("SELECT COUNT(*) AS total_staff_member FROM staff_member");
            $result = $db->getResult();
            if(!empty($result)){
              foreach ($result as $row) {
          ?>
          <div class="card bg-secondary">
            <div class="card-body text-center" style="padding: 30px 20px;">
              <img src="images/staff-member.png" class="mb-4" alt="" style="width:40%;">
              <p class="card-text mb-3"><?php echo $row['total_staff_member']; ?></p>
              <h5 class="card-title text-white mb-0">Total Staff Member</h5>
            </div>
          </div>
          <?php
            }
          }
          ?>
        </div>
        <div class="col-md-3">
          <?php
            $db = new Database();

            $db->sql("SELECT COUNT(*) AS total_group FROM groups");
            $result = $db->getResult();
            if(!empty($result)){
              foreach ($result as $row) {
          ?>
          <div class="card bg-dark">
            <div class="card-body text-center" style="padding: 30px 20px;">
              <img src="images/group.png" class="mb-4" alt="" style="width:40%;">
              <p class="card-text mb-3"><?php echo $row['total_group']; ?></p>
              <h5 class="card-title text-white mb-0">Total Group</h5>
            </div>
          </div>
          <?php
            }
          }
          ?>
        </div>
        <div class="col-md-3">
          <?php
            $db = new Database();

            $db->sql("SELECT COUNT(*) AS total_membership FROM membership");
            $result = $db->getResult();
            if(!empty($result)){
              foreach ($result as $row) {
          ?>
          <div class="card bg-danger">
            <div class="card-body text-center" style="padding: 30px 20px;">
              <img src="images/membership.png" class="mb-4" alt="" style="width:40%;">
              <p class="card-text mb-3"><?php echo $row['total_membership']; ?></p>
              <h5 class="card-title text-white mb-0">Total Membership</h5>
            </div>
          </div>
          <?php
            }
          }
          ?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include "footer.php" ?>
