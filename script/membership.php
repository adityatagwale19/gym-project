<?php $title = "Membership";
include "header.php" ?>
  <div class="container">
    <div class="admin-content">
      <div class="card">
        <div class="card-header">
          <h2 class="d-inline">Membership List</h2>
          <a href="add-membership.php" class="btn btn-info float-right">Add New Membership</a>
        </div>
        <div class="card-body position-relative">
          <div class="message"></div>
          <div id="table-data">
            <?php
              $db = new Database();
              $db->select('membership','membership.membership_id,membership.membership_name,membership.membership_cat,membership.membership_period,membership.membership_amount,membership.membership_desc,category.cat_id,category.cat_name',"category ON membership.membership_cat = category.cat_id",null,"membership.membership_id DESC",null);
              $result = $db->getResult();
            ?>
            <table class="table-data table table-bordered">
              <thead class="thead-light">
                <tr>
                  <th>S.No</th>
                  <th>Name</th>
                  <th>Period</th>
                  <th>Category</th>
                  <th>Amount</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  if(count($result) > 0){
                    $i = 0;
                    foreach ($result as $row) {
                      $i++;
                ?>
                    <tr>
                      <td><?php echo $i; ?></td>
                      <td><?php echo $row['membership_name']; ?></td>
                      <td><?php echo $row['membership_period']; ?> days</td>
                      <td><?php echo $row['cat_name']; ?></td>
                      <td><?php echo $currency_format.' '.$row['membership_amount']; ?></td>
                      <td>
                        <ul class="action-list">
                          <li><a href="view-membership.php?msid=<?php echo $row['membership_id']; ?>" class="btn btn-success btn-sm"><img src="images/eye.png" alt=""></a></li>
                          <li><a href="update-membership.php?msid=<?php echo $row['membership_id']; ?>" class="btn btn-primary btn-sm"><img src="images/edit.png" alt=""></a></li>
                          <li><a href="#" data-msid=<?php echo $row['membership_id']; ?> class="btn btn-danger btn-sm delete-membership"><img src="images/delete.png" alt=""></a></li>
                        </ul>
                      </td>
                    </tr>
                    <?php
                        }
                      }
                    ?>
              </tbody>
           </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>

<?php include "footer.php" ?>
