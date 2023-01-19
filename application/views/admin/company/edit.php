<style type="text/css">
  .tox-tinymce{
    width:auto!important;
  }
  .tox .tox-statusbar{
    display:none!important;
  }
  .tox .tox-promotion{
    display: none;
  }
</style>

<script src='https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.2.0/tinymce.min.js'></script>

<style type="text/css">

  .removesubservices{
      border: none;
      background: no-repeat;
      color: red;
      cursor: pointer!important;
      text-align: right;
  }

</style>

<div class="content-wrapper">

  <section class="content">

      <?php $this->load->view('admin/includes/_messages.php') ?>

    <div class="card">

      

      <div class="card-header">

           <h1><?=$data['company_name']?></h1>

      </div>

       <!-- form start -->

        <div class="card-body">

           <div class="box-tools">

               <a href="<?= base_url('admin/company'); ?>" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Back</a>

            </div>

          <?php echo validation_errors(); ?>

         
   <form method="post" accept-charset="utf-8" action="<?php echo base_url();?>admin/company/edit/<?php echo $data['id'];?>" enctype="multipart/form-data" class="form-horizontal">
    <div class="row">

          <div class="col-xl-3 col-md-4 col-sm-6">

            <div class="form-group">

              <label>Company Name</label>

              <input type="text" name="company_name" class="form-control" id="company_name" placeholder="Company Name" value="<?php echo $data['company_name'];?> " required>

            </div>

          </div>

          

          <div class="col-xl-3 col-md-4 col-sm-6">

            <div class="form-group">

              <label>SST Registeration No.</label>

              <input type="text" name="registeration_no" class="form-control" id="registeration_no" placeholder="SST Registeration No" value="<?php echo $data['registeration_no'];?>" required>

            </div>

          </div>



          <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
              <label>Email</label>
              <input type="text" name="email" class="form-control" id="email" placeholder="Email" value="<?php echo $data['email'];?>" required>
            </div>
          </div>

          <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
              <label>Tel</label>
              <input type="text" name="phone" class="form-control" id="phone" placeholder="Phone" value="<?php echo $data['phone']?> " required>
            </div>
          </div>

          <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
              <label>Fax</label>
              <input type="text" name="fax" class="form-control" id="fax" placeholder="Fax" value="<?php echo $data['fax']?>" required>
            </div>
          </div>
          <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
              <label>Service Tax No</label>
              <input type="text" name="service_tax_no" class="form-control" id="service_tax_no" placeholder="Service Tax No" value="<?php echo $data['service_tax_no']?> " required>
            </div>
          </div>
        <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
              <label>Bank Name</label>
              <input type="text" name="bank_name" class="form-control" id="a_c_no" placeholder="Bank Name" value="<?php echo $data['bank_name'];?> " required>
            </div>
          </div> 
        <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
              <label>Bank Address</label>
              <input type="text" name="bank_address" class="form-control" id="a_c_no" placeholder="Bank Address" value="<?php echo $data['bank_address']?> " required>
            </div>
          </div> 
        <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
              <label>Acc/No.</label>
              <input type="text" name="a_c_no" class="form-control" id="a_c_no" placeholder="Acc/No." value="<?php echo $data['a_c_no']?> " required>
            </div>
          </div>
         <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
              <label>Swift Code</label>
              <input type="text" name="swift_code" class="form-control" id="a_c_no" placeholder="Swift Code" value="<?php echo $data['swift_code']?> " required>
            </div>
          </div>
            <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
              <label>Account Code</label>
              <input type="text" name="company_code" class="form-control" id="company_code" placeholder="Company Code" value="<?php echo $data['company_id']?> " required readonly>
            </div>
          </div>

          <div class="form-group">
                <label class="control-label">Logo</label><br/>
                <input type="file" name="userfile[]" accept=".png, .jpg, .jpeg, .gif, .svg">
                <p><small class="text-success"><?= trans('allowed_types') ?>: gif, jpg, png, jpeg</small></p>
                <?php
                if($data['image']):
                echo '<div class="wrap-image">
                  <img src="'.base_url().'assets/company/'.$data['company_id'].'/'.$data['image'].'" width="200">
                  <input type="hidden" name="company_logo" value="'.$data['image'].'">
                </div>';
                endif;
                ?>
            </div>
            <input type="hidden" name="company_id" value="<?php echo $data['company_id']?>">
          <div class="col-xl-12 col-md-4 col-sm-6">
            <div class="form-group">
              <label>Company Address</label>
              <textarea name="descriptions" style="height:20rem" class="form-control" id="descriptions" placeholder="Company Address"><?php echo $data['descriptions']?></textarea>
            </div>
          </div>
        
          <div class="col-xl-12 col-md-4 col-sm-6">
            <div class="form-group">
              <label>Disclaimer</label>
              <textarea name="disclaimer" class="form-control" id="disclaimer" placeholder="Company Disclaimer" style="height:20rem;width:100%;"><?php echo $data['disclaimer']?></textarea>
            </div>
          </div>





        </div>





</div>













        <div class="form-group">

          <div class="col-md-12">

            <input type="submit" name="submit" value="Update" class="btn btn-primary pull-right">

          </div>



        </div>





              </form>



        </div>

        <!-- /.card-body -->





    </div>

  </section> 

</div>

<script>
tinymce.init({
    selector: 'textarea',
    width: 600,
    height: 300
});
</script>

