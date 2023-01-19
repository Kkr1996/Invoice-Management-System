<style type="text/css">
  .removesubservices{
      margin-block: 12px;
      border: none;
      background: no-repeat;
      color: red;
      cursor: pointer!important;
      text-align: right;
  }
</style>
<div class="content-wrapper">
  <section class="content">
    <div class="card">
      
      <div class="card-header">
           <h1><?=$data['deliveryname']?></h1>
      </div>
       <!-- form start -->
        <div class="card-body">

            <?php $this->load->view('admin/includes/_messages.php') ?>
           <div class="box-tools">
               <a href="<?= base_url('admin/delivery'); ?>" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
            </div>
          <?php echo validation_errors(); ?>
          <?php 
            echo form_open(base_url('admin/delivery/edit/'.$data['id']), 'class="form-horizontal"'); 
          ?>
<div class="row">
    
          <div class="col-12">
                <div class="col-xl-3 col-md-4 col-sm-6" style="padding-left:0;">
                    <div class="form-group">
                    <label>Company Name</label>
                        <select name="company_id" class="form-control" required>
                        <option value="">Select Company</option>
                        <?php
                         if(count($company_list) > 0){
                             foreach($company_list as $keys=>$kvals){
                                 echo '<option value="'.$kvals['company_id'].'" ';
                                 if($kvals['company_id'] == $data['company_id']){
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
    
    
      <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
              <label>Job Name</label>
                    <select name="job_id" class="form-control">
                        <option value="">Select Company</option>
                        <?php
                         if(count($joblist) > 0){
                             foreach($joblist as $keys=>$kvals){
                                 echo '<option value="'.$kvals['jobid'].'" ';
                                 if($kvals['jobid'] == $data['job_id']){
                                     echo "selected";
                                 }
                                 echo '>'.$kvals['name'].'</option>';
                             }
                         }
                        ?>
                    </select>
            </div>
       </div>      
        <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
              <label>Delivery Name</label>
              <input type="text" name="deliveryname" class="form-control" id="deliveryname" placeholder="Delivery Name" value="<?=$data['deliveryname']?>" required>
            </div>
          </div>
          
          <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
              <label>Email Address</label>
              <input type="text" name="email" class="form-control" id="email" placeholder="Email Address" value="<?=$data['email']?>" required>
            </div>
          </div>

          <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
              <label>Delivery Contact Number</label>
              <input type="text" name="mobile" class="form-control" id="mobile" placeholder="Delivery Contact Number" value="<?=$data['mobile']?>" required>
            </div>
          </div>

          <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
              <label>Pick Up Location</label>
              <input type="text" name="pickup" class="form-control" id="pickup" placeholder="Pick Up Location" value="<?=$data['pickup']?>" required>
            </div>
          </div>         

           <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
              <label>Drop Up Location</label>
              <input type="text" name="droplocation" class="form-control" id="droplocation" placeholder="Drop Up Location" value="<?=$data['droplocation']?>" required>
            </div>
          </div>

           <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
              <label>Delivery Details</label>
              <input type="text" name="deiverydetails" class="form-control" id="deiverydetails" placeholder="Delivery Details" value="<?=$data['deiverydetails']?>">
            </div>
          </div>

</div>






        <div class="form-group">
          <div class="col-md-12">
            <input type="submit" name="submit" value="Update" class="btn btn-primary pull-right">
          </div>

        </div>


            <?php echo form_close( ); ?>

        </div>
        <!-- /.card-body -->


    </div>
  </section> 
</div>

