<?php
  include "php_files/config.php";

  if(!file_exists('php_files/database.php')){
    header('location: install');
    die();
  }

  if(!session_id()){ session_start(); }
  if(isset($_SESSION['admin_fullname'])){
    header("location: dashboard.php");
  }

  $db = new Database();
  $db->select('settings','*',null,null,null,null);
  $result = $db->getResult();

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title><?php echo $result[0]['gym_name']; ?></title>
  <link rel="stylesheet" href="assets/css/bootstrap.css">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <div id="admin-content" class="mt-5">
  <div class="message"></div>
    <div class="container">
      <div class="row">
        <div class="offset-md-4 col-md-4">
          <div class="login-form">
            <?php if($result[0]['gym_logo'] != ''){ ?>
              <img src="images/gym-logo/<?php echo $result[0]['gym_logo']; ?>" class=" d-block mx-auto mb-2" alt="" width="70px">
            <?php } ?>
            <div class="card">
              <div class="card-header bg-info p-2">
                <h2 class="text-white m-2 text-center"><?php echo $result[0]['gym_name']; ?></h2>
              </div>
              <div class="card-body login-form position-relative">
                <form id="admin_Login" action="" method="POST" autocomplete="off">
                  <div class="form-group">
                      <label>Username</label>
                      <input type="text" class="form-control username" name="username" id="username" placeholder="Username" required>
                  </div>
                  <div class="form-group">
                      <label>Password</label>
                      <input type="password" class="form-control password" name="password" id="password" placeholder="Password" required>
                  </div>
                  <input type="submit" class="btn btn-info float-right" name="login" value="Login">
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="assets/js/jquery.js" charset="utf-8"></script>
  <script src="assets/js/admin.js" charset="utf-8"></script>
</body>
</html>
