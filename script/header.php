<?php
  include "php_files/config.php";

  if(!file_exists('php_files/database.php')){
    header('location: install');
    die();
  }

  if(!session_id()){ session_start();}

  if(!isset($_SESSION['admin_fullname'])){
    header("location: index.php");
  }

  $db = new Database();
  $db->select('settings','*',null,null,null,null);
  $result = $db->getResult();
  $currency_format = $result[0]['gym_currency'];

?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <?php if(isset($title) && $title != ''){ ?>
    <title><?php echo $title.' > '.$result[0]['gym_name']; ?></title>
  <?php }else{ ?>
    <title><?php echo $result[0]['gym_name']; ?></title>
  <?php } ?>
  <link rel="stylesheet" href="assets/css/bootstrap.css">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <!-- <link rel="stylesheet" href="assets/css/multi.min.css"> -->
  <link rel="stylesheet" href="assets/css/datatables.bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/jquery.dataTables.css">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="wrapper">
      <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header" >
              <?php
                if(!empty($result[0]['company_logo'])){ ?>
                  <a href="dashboard.php" class="navbar-brand"><img src="images/gym-logo/<?php echo $result[0]['gym_logo']; ?>"></a>
              <?php }else{ ?>
                  <h2><a href="dashboard.php" class="navbar-brand p-0"><?php echo $result[0]['gym_name']; ?></a></h2>
              <?php } ?>
            </div>

            <ul class="list-unstyled components">
                <li <?php if(basename($_SERVER['PHP_SELF']) == "dashboard.php") echo 'class="active"'; ?>>
                    <a href="dashboard.php">Dashboard</a>
                </li>
                <li <?php if(basename($_SERVER['PHP_SELF']) == "membership.php" || basename($_SERVER['PHP_SELF']) == "category.php") echo 'class="active"'; ?>>
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                      Membership Type
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill float-right" style="position:relative;top:3px;" viewBox="0 0 16 16">
                        <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                      </svg>
                    </a>
                    <ul class="collapse list-unstyled text-color <?php if(basename($_SERVER['PHP_SELF']) == "membership.php" || basename($_SERVER['PHP_SELF']) == "category.php") echo 'show'; ?>" id="homeSubmenu">
                        <li <?php if(basename($_SERVER['PHP_SELF']) == "membership.php") echo 'class="active"'; ?>>
                            <a href="membership.php">Membership</a>
                        </li>
                        <li <?php if(basename($_SERVER['PHP_SELF']) == "category.php") echo 'class="active"'; ?>>
                            <a href="category.php">Category</a>
                        </li>
                    </ul>
                </li>
                <li <?php if(basename($_SERVER['PHP_SELF']) == "staff-member.php" || basename($_SERVER['PHP_SELF']) == "member.php" || basename($_SERVER['PHP_SELF']) == "role.php" || basename($_SERVER['PHP_SELF']) == "specialization.php") echo 'class="active"'; ?>>
                    <a href="#homeSubmenu1" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                      Member Management
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill float-right" style="position:relative;top:3px;" viewBox="0 0 16 16">
                        <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                      </svg>
                    </a>
                    <ul class="collapse list-unstyled text-color <?php if(basename($_SERVER['PHP_SELF']) == "staff-member.php" || basename($_SERVER['PHP_SELF']) == "member.php" || basename($_SERVER['PHP_SELF']) == "role.php" || basename($_SERVER['PHP_SELF']) == "specialization.php") echo 'show'; ?>" id="homeSubmenu1">
                        <li <?php if(basename($_SERVER['PHP_SELF']) == "staff-member.php") echo 'class="active"'; ?>>
                            <a href="staff-member.php">Staff Member</a>
                        </li>
                        <li <?php if(basename($_SERVER['PHP_SELF']) == "member.php") echo 'class="active"'; ?>>
                            <a href="member.php">Member</a>
                        </li>
                        <li <?php if(basename($_SERVER['PHP_SELF']) == "role.php") echo 'class="active"'; ?>>
                            <a href="role.php">Role</a>
                        </li>
                        <li <?php if(basename($_SERVER['PHP_SELF']) == "specialization.php") echo 'class="active"'; ?>>
                            <a href="specialization.php">Specialization</a>
                        </li>
                    </ul>
                </li>
                <li <?php if(basename($_SERVER['PHP_SELF']) == "group.php") echo 'class="active"'; ?>>
                    <a href="group.php">Group</a>
                </li>
                <li <?php if(basename($_SERVER['PHP_SELF']) == "member-attendance.php" || basename($_SERVER['PHP_SELF']) == "staff-attendance.php") echo 'class="active"'; ?>>
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                      Attendance
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill float-right" style="position:relative;top:3px;" viewBox="0 0 16 16">
                        <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                      </svg>
                    </a>
                    <ul class="collapse list-unstyled text-color <?php if(basename($_SERVER['PHP_SELF']) == "member-attendance.php" || basename($_SERVER['PHP_SELF']) == "staff-attendance.php") echo 'show'; ?>" id="pageSubmenu">
                        <li <?php if(basename($_SERVER['PHP_SELF']) == "member-attendance.php") echo 'class="active"'; ?>>
                            <a href="member-attendance.php">Member Attendance</a>
                        </li>
                        <li <?php if(basename($_SERVER['PHP_SELF']) == "staff-attendance.php") echo 'class="active"'; ?>>
                            <a href="staff-attendance.php">Staff Member Attendance</a>
                        </li>
                    </ul>
                </li>
                <li <?php if(basename($_SERVER['PHP_SELF']) == "attendance-report.php" || basename($_SERVER['PHP_SELF']) == "membership-report.php") echo 'class="active"'; ?>>
                    <a href="#reports" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                      Reports
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill float-right" style="position:relative;top:3px;" viewBox="0 0 16 16">
                        <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                      </svg>
                    </a>
                    <ul class="collapse list-unstyled text-color <?php if(basename($_SERVER['PHP_SELF']) == "attendance-report.php" || basename($_SERVER['PHP_SELF']) == "membership-report.php") echo 'show'; ?>" id="reports">
                        <li <?php if(basename($_SERVER['PHP_SELF']) == "attendance-report.php") echo 'class="active"'; ?>>
                            <a href="attendance-report.php">Attendance Report</a>
                        </li>
                        <li <?php if(basename($_SERVER['PHP_SELF']) == "membership-report.php") echo 'class="active"'; ?>>
                            <a href="membership-report.php">Membership Report</a>
                        </li>
                    </ul>
                </li>
                <li <?php if(basename($_SERVER['PHP_SELF']) == "settings.php") echo 'class="active"'; ?>>
                    <a href="settings.php">Settings</a>
                </li>
            </ul>
        </nav>
        <div class="container-fluid p-0">
          <div class="content">
              <nav class="navbar navbar-expand-lg navbar-light bg-info">
                    <div class="container-fluid">
                        <button type="button" id="sidebarCollapse" class="btn btn-light">
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
                          </svg>
                            <!-- <span>Toggle Sidebar</span> -->
                        </button>
                        <!-- <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <i class="fas fa-align-justify"></i>
                        </button> -->
                        <div class="dropdown" style="padding:12px 0;">
                            <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Hi, <?php echo $_SESSION['admin_fullname']; ?>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                              <a class="dropdown-item" href="profile.php">My Profile</a>
                              <a class="dropdown-item logout" href="#">Log Out</a>
                            </div>
                        </div>
                    </div>

                </nav>
