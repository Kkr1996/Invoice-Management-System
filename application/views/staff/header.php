<?php 
error_reporting(0);

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SB Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />

         <link href="<?php echo base_url();?>assets/staffdist/css/styles.css" rel="stylesheet" />
         <link href="<?php echo base_url();?>assets/staffdist/css/staff.css?<?php echo time();?>" rel="stylesheet" />
         <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="<?php echo base_url();?>staff/staffcontroller"><img src="<?php echo base_url('assets/img/call2register-log.png');?>" width="180"></a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group" style="display: none;">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown"> 
                        <li><a href="javascript:void(0)" class="dropdown-item"><?php echo $this->session->userdata('username');?></a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="<?php echo base_url();?>staff/Staffcontroller/logout">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>


        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <a class="nav-link <?php if($_GET['id']== 1){echo "active";}?>"href="<?php echo base_url();?>staff">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Services</div>
                            
                             <a href="<?php echo base_url();?>staff/staffcontroller/users/" class="nav-link">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Customers List
                            </a>
                            <a class="nav-link <?php if($_GET['id']== 2){echo "active";}?>" href="<?php echo base_url();?>staff/staffcontroller/services_query?id=2">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                My Orders
                            </a>
                            <a class="nav-link <?php if($_GET['id']== 3){echo "active";}?>" href="<?php echo base_url();?>staff/staffcontroller/list_contact_query?id=3">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Contacts
                            </a>
                              <a href="<?php echo base_url();?>staff/staffcontroller/help?id=4" class="nav-link <?php if($_GET['id']== 4){echo "active";}?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                  Help            
                              </a>
                            <a href="<?php echo base_url();?>staff/staffcontroller/expertcall?id=5" class="nav-link <?php if($_GET['id']== 5){echo "active";}?>">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Expert Call            
                            </a>
                        </div>
                    </div>
                   
                </nav>
            </div>
