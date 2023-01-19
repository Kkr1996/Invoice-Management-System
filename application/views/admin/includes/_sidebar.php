<?php 
$cur_tab = $this->uri->segment(2)==''?'dashboard': $this->uri->segment(2);  
?>  
<style>
.single-item a{
    background-color: #343a40!important;
}
</style>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="<?= base_url('admin'); ?>" class="brand-link">
    <img src="<?= base_url($this->general_settings['favicon']); ?>" alt="Logo" class="brand-image img-circle elevation-3"
         style="opacity: .8">
    <span class="brand-text font-weight-light"><?= $this->general_settings['application_name']; ?></span>
  </a>
  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="<?= base_url()?>assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block"><?= ucwords($this->session->userdata('username')); ?></a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
       <li id="dashboard" class="nav-item has-treeview">
          <a href="<?php echo  base_url();?>admin/dashboard" class="nav-link">
            <i class="nav-icon fa fa-dashboard"></i>
            <p>
              Dashboard            
            </p>
          </a>
        </li> 

         <li id="profile" class="nav-item has-treeview has-treeview">
          <a href="<?php echo  base_url();?>/admin/profile" class="nav-link">
            <i class="nav-icon fa fa-user"></i>
              <p>
                Profile <i class="right fa fa-angle-left"></i>          
              </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?php echo  base_url();?>admin/profile/" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>View Profile</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo  base_url();?>admin/profile/change_pwd" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Change Password</p>
              </a>
            </li>        
          </ul>
              <!-- /sub-menu -->
        </li>
      <li id="users" class="nav-item has-treeview has-treeview menu-open">
        <a href="<?php echo  base_url();?>admin/users" class="nav-link active">
        <i class="nav-icon fa fa-users"></i>
          <p>
             Customers            
            <i class="right fa fa-angle-left"></i>         
          </p>
        </a>
      <!-- sub-menu -->
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="<?php echo base_url();?>admin/users/" class="nav-link">
            <i class="fa fa-circle-o nav-icon"></i>
            <p>Customers List</p>
           </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo base_url();?>admin/users/add" class="nav-link">
            <i class="fa fa-circle-o nav-icon"></i>
            <p>Add New Customer</p>
          </a>
        </li>
      </ul>
      </li>
          

      <li id="supplier" class="nav-item has-treeview has-treeview menu-open">
        <a href="<?php echo  base_url();?>admin/supplier" class="nav-link active">
        <i class="nav-icon fa fa-users"></i>
          <p>
             Supplier/Vendor           
            <i class="right fa fa-angle-left"></i>         
          </p>
        </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="<?php echo base_url();?>admin/supplier/" class="nav-link">
            <i class="fa fa-circle-o nav-icon"></i>
            <p>Supplier/Vendor List</p>
           </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo base_url();?>admin/supplier/add" class="nav-link">
            <i class="fa fa-circle-o nav-icon"></i>
            <p>Add New Supplier/Vendor</p>
          </a>
        </li>
      </ul>
      </li>


      <li id="users" class="nav-item has-treeview has-treeview menu-open">
        <a href="<?php echo  base_url();?>admin/company" class="nav-link active">
        <i class="nav-icon fa fa-users"></i>
          <p>
             Company            
            <i class="right fa fa-angle-left"></i>         
          </p>
        </a>
      <!-- sub-menu -->
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="<?php echo base_url();?>admin/company/" class="nav-link">
            <i class="fa fa-circle-o nav-icon"></i>
            <p>Company List</p>
           </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo base_url();?>admin/company/add" class="nav-link">
            <i class="fa fa-circle-o nav-icon"></i>
            <p>Add New Company</p>
          </a>
        </li>
      </ul>
      </li>


       <!-- <li id="location" class="nav-item has-treeview has-treeview menu-open">
          <a href="<?php echo base_url();?>admin/vendor" class="nav-link">
            <i class="nav-icon fa fa-map-pin"></i>
            <p>
              Vendor              
              <i class="right fa fa-angle-left"></i>           
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?php echo base_url();?>admin/vendor" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Vendor List</p>
              </a>
             </li>
             <li class="nav-item">
              <a href="<?php echo base_url();?>admin/vendor/add" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Add Vendor</p>
              </a>
            </li>      
          </ul>
        </li> -->

        <li id="manifesto" class="nav-item has-treeview has-treeview menu-open">

        <a href="<?php echo base_url();?>admin/manifest" class="nav-link">
          <i class="nav-icon fa fa-map-pin"></i>
          <p>
          Manifest              
            <i class="right fa fa-angle-left"></i>           
          </p>
        </a>
        <!-- sub-menu -->
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="<?php echo base_url();?>admin/manifest" class="nav-link">
              <i class="fa fa-circle-o nav-icon"></i>
              <p>Manifest List</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url();?>admin/manifest/add" class="nav-link">
              <i class="fa fa-circle-o nav-icon"></i>
              <p>Add Manifest</p>
            </a>
          </li>      
        </ul>
        </li>

        <li id="manifesto" class="nav-item has-treeview has-treeview menu-open">

        <a href="<?php echo base_url();?>admin/truckdetails" class="nav-link">
          <i class="nav-icon fa fa-map-pin"></i>
          <p>
          Truck Details              
            <i class="right fa fa-angle-left"></i>           
          </p>
        </a>
        <!-- sub-menu -->
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="<?php echo base_url();?>admin/truckdetails" class="nav-link">
              <i class="fa fa-circle-o nav-icon"></i>
              <p>Truck List</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url();?>admin/truckdetails/add" class="nav-link">
              <i class="fa fa-circle-o nav-icon"></i>
              <p>Truck Add</p>
            </a>
          </li>      
        </ul>
        </li>

         <li id="profile" class="nav-item has-treeview has-treeview">
          <a href="<?php echo  base_url();?>/admin/job" class="nav-link">
            <i class="nav-icon fa fa-user"></i>
              <p>
                Job <i class="right fa fa-angle-left"></i>          
              </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?php echo  base_url();?>admin/job/" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Job List</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo  base_url();?>admin/job/add" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Add Job</p>
              </a>
            </li>        
          </ul>
        </li>

       <li id="profile" class="nav-item has-treeview has-treeview">
          <a href="<?php echo  base_url();?>/admin/invoices" class="nav-link">
            <i class="nav-icon fa fa-user"></i>
              <p>
                 Invoices <i class="right fa fa-angle-left"></i>          
              </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?php echo  base_url();?>admin/invoices/" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Customer Invoices</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo  base_url();?>admin/vendorinvoice" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Vendor Invoices</p>
              </a>
            </li>        
          </ul>
        </li>

<!--
       <li id="profile" class="nav-item has-treeview has-treeview">
          <a href="<?php echo  base_url();?>/admin/vendorinvoice" class="nav-link">
            <i class="nav-icon fa fa-user"></i>
              <p>
               Vendor Invoices <i class="right fa fa-angle-left"></i>          
              </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?php echo  base_url();?>admin/vendorinvoice/" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Invoices List</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo  base_url();?>admin/vendorinvoice/add" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Add Invoices</p>
              </a>
            </li>        
          </ul>
        </li>
-->

         <li id="profile" class="nav-item has-treeview has-treeview">
          <a href="<?php echo  base_url();?>/admin/agents" class="nav-link">
            <i class="nav-icon fa fa-user"></i>
              <p>
                Agent <i class="right fa fa-angle-left"></i>          
              </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?php echo  base_url();?>admin/agents/" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Agent List</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo  base_url();?>admin/agents/add" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Add Agent</p>
              </a>
            </li>        
          </ul>
        </li>

       <li id="profile" class="nav-item has-treeview has-treeview">
          <a href="<?php echo  base_url();?>/admin/customerrates" class="nav-link">
            <i class="nav-icon fa fa-user"></i>
              <p>
                Customer Rates <i class="right fa fa-angle-left"></i>          
              </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?php echo  base_url();?>admin/customerrates/" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>List</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo  base_url();?>admin/customerrates/add" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Add</p>
              </a>
            </li>        
          </ul>
        </li>

       <li id="delivery" class="nav-item has-treeview has-treeview">
          <a href="<?php echo  base_url();?>/admin/delivery" class="nav-link">
            <i class="nav-icon fa fa-user"></i>
              <p>
                Delivery <i class="right fa fa-angle-left"></i>          
              </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?php echo  base_url();?>admin/delivery/" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>List</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo  base_url();?>admin/delivery/add" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Add</p>
              </a>
            </li>        
          </ul>
        </li>







        <li class="nav-item">
            <a href="<?php echo  base_url();?>admin/General_settings" class="nav-link">
            <i class="fa fa-circle-o nav-icon"></i>
            <p>General settings</p>
            </a>        
            <a href="<?php echo  base_url();?>admin/admin_roles" class="nav-link">
            <i class="fa fa-circle-o nav-icon"></i>
            <p>Admin Roles</p>
            </a>
            <a href="<?php echo  base_url();?>admin/admin/add" class="nav-link">
            <i class="fa fa-circle-o nav-icon"></i>
            <p>Add Roles</p>
            </a>
        </li>  

     
      </ul>










    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>

<script>
  $("#<?= $cur_tab ?>").addClass('menu-open');
  $("#<?= $cur_tab ?> > a").addClass('active');
</script>