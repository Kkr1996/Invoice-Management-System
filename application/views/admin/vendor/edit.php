<div class="content-wrapper">
  <section class="content">
    <div class="card">
      <div class="card-header">
           <h1><?=$data['name']?></h1>
      </div>

       <!-- form start -->
        <div class="card-body">

           <div class="box-tools">
               <a href="<?= base_url('admin/vendor'); ?>" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
            </div>
              <?php $this->load->view('admin/includes/_messages.php') ?>
            <?php echo validation_errors(); ?>           
            <?php echo form_open(base_url('admin/vendor/edit/'.$data['id']), 'class="form-horizontal"');  ?>


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
                <label for="name">Vendor Name</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Username" value="<?= $data['name']; ?>" required>
              </div>
         </div> 
         <div class="col-xl-3 col-md-4 col-sm-6">
          <div class="form-group">
              <label for="name">Email Address</label>
              <input type="text" name="email" class="form-control" id="name" placeholder="Email Address" value="<?= $data['email']; ?>" required>
          </div>
         </div>
         <div class="col-xl-3 col-md-4 col-sm-6">
             <div class="form-group">
              <label for="name">Vendor Contact Number</label>
                <input type="text" name="phone" class="form-control" id="phone" placeholder="Vendor Contact Number" value="<?= $data['phone']; ?>">
            </div>
          </div>
<!--         <div class="col-xl-3 col-md-4 col-sm-6">
             <div class="form-group">
                <label for="name">Registeration No.</label>
                <input type="text" name="registeration_no" class="form-control" id="registeration_no" value="<?= $data['registeration_no']; ?>" placeholder="Registeration No.">
            </div>
        </div> -->

    <div class="col-xl-3 col-md-4 col-sm-6">
           <div class="form-group">
              <label for="name">Vendor Rate</label>
              <input type="text" name="vendor_rate" class="form-control" id="vendor_rate" placeholder="Vendor Rate" value="<?= $data['vendor_rate']; ?>">
          </div>
    </div>




       <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
            <label>Vendor Currency</label>
            <select name="vendor_currency" class="form-control">
              <option value="MYR" <?= ($data['vendor_currency'] == "MYR")?'selected': '' ?> >MYR</option>
              <option value="USD" <?= ($data['vendor_currency'] == "USD")?'selected': '' ?>>USD</option>
              <option value="Local Currency" <?= ($data['vendor_currency'] == "Local Currency")?'selected': '' ?>>Local Currency</option>
            </select>
            </div>
          </div>

    <div class="col-xl-3 col-md-4 col-sm-6">
       <div class="form-group">
        <label for="name">Status</label>
          <select class="form-control" name="status">
            <option value="1" <?php if($data['status'] == 1){echo "selected";}?> >Active</option>
            <option value="0" <?php if($data['status'] == 0){echo "selected";}?>>Inactive</option>
          </select>
       </div>
    </div>

    <div class="col-xl-12 col-md-12 col-sm-12">
            <div class="form-group">
                <label for="address">Vendor Address</label>
                <textarea name="address" class="form-control" id="address" placeholder="Vendor Address" style="height:20rem;width:100%;"><?= $data['address']; ?></textarea>
            </div>
        </div>
</div>


<div class="col-12">
    <div class="form-group">
        <input type="submit" name="submit" value="Update Vendor" class="btn btn-primary pull-right">
    </div>
</div>

            <?php echo form_close( ); ?>
        </div>
        <!-- /.card-body -->


    </div>
  </section> 
</div>

<script>
  $("#lcoation").addClass('active');
</script>