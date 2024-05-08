<?php $title = "Membership Report";
include "header.php" ?>
  <div class="message"></div>
  <div class="container">
    <div class="admin-content">
      <div class="card mb-4">
        <div class="card-header">
          <h2 class="d-inline">Membership Report</h2>
        </div>
        <div class="card-body">
          <div class="membership-report">
            <div class="card-header bg-info border mb-4">
              <h5 class="d-inline text-white">Membership Report List</h5>
            </div>
            <table class="table-data table table-bordered">
              <?php
                $db = new Database();

                $db->sql("SELECT membership.membership_id,membership.membership_name,count(member.membership) AS membership FROM membership
                          LEFT JOIN member ON member.membership=membership.membership_id GROUP BY membership.membership_id");
                $result = $db->getResult();
              ?>
              <thead class="thead-light">
                <tr>
                  <th>S.No</th>
                  <th>Membership Name</th>
                  <th>Total Member</th>
                </tr>
              </thead>
              <?php
                if(!empty($result)){
                  $i=0;
                  foreach($result as $row){
                    $i++;
              ?>
              <tbody>
                <tr>
                  <td><?php echo $i; ?></td>
                  <td><?php echo $row["membership_name"]; ?></td>
                  <td><?php echo $row['membership']; ?></td>
                </tr>
              </tbody>
              <?php
                }
              }
              ?>
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
