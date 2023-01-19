<?php
error_reporting(0);
?>

<!-- PAGE Jquery SCRIPTS -->
<script src="<?= base_url() ?>assets/dist/js/jquery.js"></script>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?= trans('dashboard') ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"><?= trans('home') ?></a></li>
              <li class="breadcrumb-item active"><?= trans('dashboard') ?></li>
            </ol>
          </div><!-- /.col -->
            
            
          <div class="col-12">
                <div class="col-xl-3 col-md-4 col-sm-6" style="padding-left:0;">
                    <div class="form-group">
                    <label>Company Name ( Choose )</label>
                        <select  id ="select_company_id" name="company_id" class="form-control" required>
                        <option value="">Group Company</option>
                        <?php
                         if(count($company_list) > 0){
                             foreach($company_list as $keys=>$kvals){
                                 echo '<option value="'.$kvals['company_id'].'" ';
                                 if($kvals['company_id'] == $company_id_s){
                                     echo "selected";
                                 }
                                 echo '>'.$kvals['company_name'].'</option>';
                             }
                         }
                        ?>
                        </select>
                    </div>
                </div>
        </div>  
            
        </div><!-- /.row -->
          

          
          
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fa fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Customer</span>
                <span class="info-box-number">
                   <?php 
                    echo $customers; 
                   ?>
                  
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
            
            
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-building-o"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Agents</span>
                <span class="info-box-number"><?php 
                    echo $agents; 
                   ?></span>
                </div>
              </div>
          </div>


            
            
          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="ion ion-person-add"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Vendor</span>
                <span class="info-box-number"><?php 
                    echo $vendor; 
                   ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fa fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Job</span>
                <span class="info-box-number"><?php 
                    echo $jobs; 
                   ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
              

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-widget="collapse">
                    <i class="fa fa-minus"></i>
                  </button>
        
                  <button type="button" class="btn btn-tool" data-widget="remove">
                    <i class="fa fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <p class="text-center">
                      <strong>Sales: 1 Jan, 2014 - 30 Jul, 2014</strong>
                    </p>

                  </div>
                  <!-- /.col -->
      
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
              <!-- ./card-body -->
              <div class="card-footer">
                <div class="row">

                  <div class="col-sm-4 col-6">
                    <div class="description-block border-right">
                      <span class="description-percentage text-success"><i class="fa fa-caret-up"></i></span>
                      <h5 class="description-header"><?php echo $customer_total_revenue; ?></h5>
                      <span class="description-text">TOTAL REVENUE CUSTOMER</span>
                    </div>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 col-6">
                    <div class="description-block border-right">
                      <span class="description-percentage text-warning"><i class="fa fa-caret-left"></i></span>
                      <h5 class="description-header"><?php echo $vendor_total_revenue; ?></h5>
                      <span class="description-text">TOTAL COST VENDOR </span>
                    </div>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 col-6">
                    <div class="description-block border-right">
                      <span class="description-percentage text-success"><i class="fa fa-caret-up"></i></span>
                      <h5 class="description-header"><?php echo $profit; ?></h5>
                      <span class="description-text">TOTAL PROFIT</span>
                    </div>

                  </div>
                  <!-- /.col -->
           
                </div>
                <!-- /.row -->
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <div class="col-md-8">
            <!-- MAP & BOX PANE -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Visitors Report</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-widget="collapse">
                    <i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-widget="remove">
                    <i class="fa fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                  <div class="col-md-12">
                    <p class="text-center">
                      <strong>Job Status</strong>
                    </p>

                  </div>
                 <div class="row">
                   <div class="col-xl-6 text-center">
                        <p>Open</p>
                        <p>Processing</p>
                        <p>Close</p>
                    </div>
                    <div  class="col-xl-6 text-center">
                        <p><?php echo $count_status['active'];?></p>
                        <p><?php echo $count_status['processing'];?></p>
                        <p><?php echo $count_status['completed'];?></p>
                    </div>
                  </div> 
           
                   
             
              
              </div>
              <!-- /.card-body -->
            </div>
    
            <!-- TABLE: LATEST ORDERS -->
   
            <!-- /.card -->
          </div>
          <!-- /.col -->

          <div class="col-md-4">
            <!-- Info Boxes Style 2 -->
            <div class="info-box mb-3 bg-warning">
              <span class="info-box-icon"><i class="fa fa-tag"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Customer Rates</span>
                <span class="info-box-number"><?php echo $customerrates; ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            <div class="info-box mb-3 bg-success">
              <span class="info-box-icon"><i class="fa fa-heart-o"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Vendor Invoice</span>
                <span class="info-box-number"><?php echo $vendorinvoice; ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            <div class="info-box mb-3 bg-danger">
              <span class="info-box-icon"><i class="fa fa-cloud-download"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Customer Invoice</span>
                <span class="info-box-number"><?php echo $invoice; ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            <div class="info-box mb-3 bg-info">
              <span class="info-box-icon"><i class="fa fa-comment-o"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Agents</span>
                <span class="info-box-number"><?php echo $agents;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
              
          <div class="info-box mb-3 bg-info">
              <span class="info-box-icon"><i class="fa fa-comment-o"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Delivery</span>
                <span class="info-box-number"><?php echo $delivery;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->

            <div class="card" style="display:none;">
              <div class="card-header">
                <h3 class="card-title">Browser Usage</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-8">
                    <div class="chart-responsive">
                      <canvas id="pieChart" height="150"></canvas>
                    </div>
                    <!-- ./chart-responsive -->
                  </div>
                  <!-- /.col -->
                  <div class="col-md-4">
                    <ul class="chart-legend clearfix">
                      <li><i class="fa fa-circle-o text-danger"></i> Chrome</li>
                      <li><i class="fa fa-circle-o text-success"></i> IE</li>
                      <li><i class="fa fa-circle-o text-warning"></i> FireFox</li>
                      <li><i class="fa fa-circle-o text-info"></i> Safari</li>
                      <li><i class="fa fa-circle-o text-primary"></i> Opera</li>
                      <li><i class="fa fa-circle-o text-secondary"></i> Navigator</li>
                    </ul>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
              <!-- /.card-body -->
              <div class="card-footer bg-white p-0">
                <ul class="nav nav-pills flex-column">
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      United States of America
                      <span class="float-right text-danger">
                        <i class="fa fa-arrow-down text-sm"></i>
                        12%</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      India
                      <span class="float-right text-success">
                        <i class="fa fa-arrow-up text-sm"></i> 4%
                      </span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      China
                      <span class="float-right text-warning">
                        <i class="fa fa-arrow-left text-sm"></i> 0%
                      </span>
                    </a>
                  </li>
                </ul>
              </div>
              <!-- /.footer -->
            </div>
            <!-- /.card -->


          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <!-- PAGE PLUGINS -->

<!--select compmay script -->
<script>
  
     $(document).ready(function(){
        $('#select_company_id').change(function(){
           var company_id=$(this).val();  
            
            
            window.location.href = window.location.protocol + '/invoicev2/admin/dashboard/index/' + company_id;
            
//            $.ajax({
//                    url: "<?= base_url('admin/vendor'); ?>/count_vendors_byid/"+company_id,
//                    cache: false,
//                    type:'GET',
//                    success: function(data){
//                            console.log(data);
//                        }
//                });
        }); 
       
    });
    
</script>


<!-- SparkLine -->
<script src="<?= base_url() ?>assets/plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jVectorMap -->
<script src="<?= base_url() ?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="<?= base_url() ?>assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS 1.0.2 -->
<script src="<?= base_url() ?>assets/plugins/chartjs-old/Chart.min.js"></script>

<!-- PAGE SCRIPTS -->
<script src="<?= base_url() ?>assets/dist/js/pages/dashboard2.js"></script>