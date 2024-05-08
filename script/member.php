<?php $title = "Member";
include "header.php" ?>
  <div class="container">
    <div class="admin-content">
      <div class="card">
        <div class="card-header">
          <h2 class="d-inline">Member List</h2>
          <a href="add-member.php" class="btn btn-info float-right">Add Member</a>
        </div>
        <div class="card-body position-relative">
          <div class="message"></div>
          <div id="table-data">
            <?php
              $db = new Database();
              $db->select('member','*',null,null,"member.member_id DESC",null);
              $result = $db->getResult();
            ?>
            <table class="table-data table table-bordered">
              <thead class="thead-light">
                <tr>
                  <th>S.No</th>
                  <th>Photo</th>
                  <th>Name</th>
                  <th>Join Date</th>
                  <th>Expire Date</th>
                  <th>Phone</th>
                  <th>Email</th>
                  <th style="width:100px;">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  if(count($result) > 0){
                    $i = 0;
                    foreach($result as $row){
                      $i++; ?>
                    <tr>
                      <td><?php echo $i; ?></td>
                      <td>
                        <?php
                          if($row['member_img'] != ''){ ?>
                            <img src="images/member/<?php echo $row['member_img']; ?>" width="40px" height="40px" style="border-radius:50%; object-fit: cover;" alt="">
                        <?php }else{ $img = ($row['member_gender'] == 'male')?'man.png' : 'woman.png'; ?>
                            <img src="images/member/<?php echo $img; ?>" width="40px" height="40px" style="border-radius:50%; object-fit: cover;" alt="">
                        <?php } ?>
                      </td>
                      <td><?php echo $row['member_fname'].' '.$row['member_lname']; ?></td>
                      <td><?php echo date('j M, Y',strtotime($row['start_date'])); ?></td>
                      <td>
                        <?php echo date('j M, Y',strtotime($row['end_date'])); ?>
                        <?php echo ($row['end_date'] < date('Y-m-d'))?'<small>membership expired</small>':''; ?>
                      </td>
                      <td><?php echo $row['member_phone']; ?></td>
                      <td><?php echo $row['member_email']; ?></td>
                      <td>
                        <ul class="action-list">
                          <li><a href="view-member.php?mid=<?php echo $row['member_id']; ?>" class="btn btn-success btn-sm"><img src="images/eye.png" alt=""></a></li>
                          <li><a href="update-member.php?mid=<?php echo $row['member_id']; ?>" class="btn btn-primary btn-sm"><img src="images/edit.png" alt=""></a></li>
                          <li><a href="#" data-mid=<?php echo $row['member_id']; ?> class="btn btn-danger btn-sm delete-member"><img src="images/delete.png" alt=""></a></li>
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
