<?php $title = "Member";
include "header.php" ?>
  <div class="message"></div>
  <div class="container">
    <div class="admin-content">
      <div class="card">
        <div class="card-header">
          <h2 class="d-inline">View Membership Details</h2>
          <a href="membership.php" class="btn btn-success float-right">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"/>
            </svg>
            Membership List
          </a>
        </div>
        <div class="card-body position-relative">
          <div id="table-data">
            <?php
              $db = new Database();
              $membership_id = $_GET['msid'];
              $db->select('membership','membership.membership_id,membership.membership_name,membership.membership_cat,membership.membership_period,membership.membership_amount,membership.membership_desc,category.cat_id,category.cat_name',
                          "category ON membership.membership_cat=category.cat_id","membership.membership_id='{$membership_id}'",null,null);
              $result = $db->getResult();
              if(count($result) > 0){
                $i = 0;
                foreach($result as $row){
                  $i++;
            ?>
            <div class="row">
              <div class="col-md-6 mb-4">
                <div class="card-header bg-info">
                  <h5 class="d-inline text-white">Membership Information</h5>
                </div>
                  <div class="border p-3">
                  <table width="100%" class="view-member">
                    <tbody>
                            <tr>
                              <td class="label">Membership Name :</td>
                              <td><?php echo $row['membership_name']; ?></td>
                            </tr>
                            <tr>
                              <td class="label">Category :</td>
                              <td><?php echo $row['cat_name']; ?></td>
                            </tr>
                            <tr>
                              <td class="label">Period :</td>
                              <td><?php echo $row['membership_period']; ?> days</td>
                            </tr>
                            <tr>
                              <td class="label">Amount :</td>
                              <td><?php echo $currency_format.$row['membership_amount']; ?></td>
                            </tr>
                            <tr>
                              <td class="label">Description :</td>
                              <td><?php echo $row['membership_desc']; ?></td>
                            </tr>
                    </tbody>
                 </table>
               </div>
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
</div>
</div>
</div>

<?php include "footer.php" ?>
