<?php $title = "Group";
include "header.php" ?>
  <div class="message"></div>
  <div class="container">
    <div class="admin-content">
      <div class="card">
        <div class="card-header">
          <h2 class="d-inline">Group List</h2>
          <a href="add-group.php" class="btn btn-info float-right">Add New Group</a>
        </div>
        <div class="card-body position-relative">
          <div id="table-data">
            <?php
              $db = new Database();
              // $db->select('groups','*',null,null,"groups.group_id DESC",null);
              $db->sql("SELECT groups.group_id,groups.group_name,count(member.member_group) AS total_member FROM groups
                        LEFT JOIN member ON member.member_group=groups.group_id GROUP BY groups.group_id ORDER BY groups.group_id DESC");
              $result = $db->getResult();
            ?>
            <table class="table-data table table-bordered">
              <thead class="thead-light">
                <tr>
                  <th>S.No</th>
                  <th>Group Name</th>
                  <th>Total Group Members</th>
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
                      <td><?php echo $row['group_name']; ?></td>
                      <td><?php echo $row['total_member'] ?></td>
                      <td>
                        <ul class="action-list">
                          <li><a href="update-group.php?grid=<?php echo $row['group_id']; ?>" class="btn btn-primary btn-sm"><img src="images/edit.png" alt=""></a></li>
                          <li><a href="#" data-grid=<?php echo $row['group_id']; ?> class="btn btn-danger btn-sm delete-group"><img src="images/delete.png" alt=""></a></li>
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
