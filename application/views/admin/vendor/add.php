<div class="content-wrapper">
  <section class="content">
    <!-- For Messages -->
    <?php $this->load->view('admin/includes/_messages.php') ?>
    <div class="card">


      <div class="card-header">
           <h1>New Vendor</h1>
      </div>



      <div class="card-body">
         <div class="box-tools">
             <a href="<?= base_url('admin/vendor'); ?>" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
          </div>
        <?php echo validation_errors(); ?>           
        <?php echo form_open(base_url('admin/vendor/add'), 'class="form-horizontal"');  ?>


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
                             echo '<option value="'.$kvals['company_id'].'">'.$kvals['company_name'].'</option>';
                         }
                     }
                    ?>
                    </select>
                </div>
            </div>
        </div>
         <div class="col-xl-3 col-md-4 col-sm-6">
              <div class="form-group">
                <label for="name">Vendor Name</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Username" required>
              </div>
         </div> 
         <div class="col-xl-3 col-md-4 col-sm-6">
          <div class="form-group">
              <label for="name">Email Address</label>
              <input type="text" name="email" class="form-control" id="name" placeholder="Email Address" required>
          </div>
         </div>
         <div class="col-xl-3 col-md-4 col-sm-6">
             <div class="form-group">
              <label for="name">Vendor Contact Number</label>
                <input type="text" name="phone" class="form-control" id="phone" placeholder="Vendor Contact Number">
            </div>
          </div>
<!--         <div class="col-xl-3 col-md-4 col-sm-6">
           <div class="form-group">
              <label for="name">Registeration No.</label>
              <input type="text" name="registeration_no" class="form-control" id="registeration_no" placeholder="Registeration No.">
          </div>
        </div> -->
        <div class="col-xl-3 col-md-4 col-sm-6">
           <div class="form-group">
              <label for="name">Vendor Rate</label>
              <input type="text" name="vendor_rate" class="form-control" id="vendor_rate" placeholder="Vendor Rate">
          </div>
        </div>

        
      <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
            <label>Vendor Currency</label>
            <select name="vendor_currency" class="form-control">
              <option value="MYR">MYR</option>
              <option value="USD">USD</option>
              <option value="Local Currency">Local Currency</option>
            </select>
            </div>
      </div>
    <div class="col-xl-3 col-md-4 col-sm-6">
       <div class="form-group">
            <label for="name">Status</label>
            <select class="form-control" name="status">
                 <option value="1">Active</option>
                 <option value="0">Inactive</option>
            </select>
       </div>
    </div>

       <div class="col-xl-12 col-md-12 col-sm-12">
            <div class="form-group">
                <label for="address">Vendor Address</label>
                <textarea name="address" class="form-control" id="address" placeholder="Vendor Address" style="height:20rem;width:100%;"></textarea>
            </div>
        </div>

</div>

      <div class="col-12">
        <div class="form-group">
            <input type="submit" name="submit" value="Add Vendor" class="btn btn-primary pull-right">
        </div>
      </div>

        <?php echo form_close( ); ?>
      </div>


    </div>
  </section> 
</div>


<script>
  $("#location").addClass('active');
</script>