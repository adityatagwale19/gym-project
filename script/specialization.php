<?php $title = "Specialization";
include "header.php" ?>
  <div class="message"></div>
  <div class="container">
    <div class="admin-content">
      <div class="card">
        <div class="card-header">
          <h2 class="d-inline">Specialization List</h2>
          <a href="add-specialization.php" class="btn btn-info float-right">Add New Specialization</a>
        </div>
        <div class="card-body position-relative">
          <div id="table-data">
            <?php
              $db = new Database();
              $db->select('specialization','*',null,null,"specialization.speci_id DESC",null);
              $result = $db->getResult();
            ?>
            <table class="table-data table table-bordered">
              <thead class="thead-light">
                <tr>
                  <th>S.No</th>
                  <th>Specialization Name</th>
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
                      <td><?php echo $row['speci_name']; ?></td>
                      <td>
                        <ul class="action-list">
                          <li><a href="update-specialization.php?spid=<?php echo $row['speci_id']; ?>" class="btn btn-primary btn-sm"><img src="images/edit.png" alt=""></a></li>
                          <li><a href="#" data-spid=<?php echo $row['speci_id']; ?> class="btn btn-danger btn-sm delete-speci"><img src="images/delete.png" alt=""></a></li>
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
