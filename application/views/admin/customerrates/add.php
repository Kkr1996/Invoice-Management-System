
<div class="content-wrapper">
  <section class="content">
    <!-- For Messages -->
    <?php $this->load->view('admin/includes/_messages.php') ?>
    <div class="card">
      <div class="card-header">
           <h1>New Customer Rates</h1>
      </div>
      <div class="card-body">
          <div class="box-tools">
             <a href="<?= base_url('admin/customerrates'); ?>" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
          </div>

        <?php echo validation_errors(); ?>           
        <?php echo form_open(base_url('admin/customerrates/add'), 'class="form-horizontal"');  ?>


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
              <label>Customer Name</label>
              <input type="text" name="name" class="form-control" id="name" placeholder="Name" required>
            </div>
          </div>
          <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
              <label> Customer Id</label>
              <input type="text" name="customer_id" class="form-control" id="customer_id" placeholder="Customer Id">
            </div>
         </div>

          <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
              <label>Invoice id</label>
              <input type="text" name="invoice_id" class="form-control" id="invoice_id" placeholder="Invoice id" required>
            </div>
          </div>
            
         <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
              <label>Job Type</label>
              <select class="select" id="job" name="job_type[]" multiple>
               <?php 
                foreach($job_records as $jkeys=>$vals){
                  echo ' <option value="'.$vals['slug'].'">'.$vals['name'].'</option>';
                }
               ?>
              </select>
            </div>
          </div>
      
         <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
              <label>Vendor</label>
              <select class="select" id="vendor" name="vendor[]" multiple>
               <?php 
                foreach($vrecords as $jkeys=>$vvals){
                  echo '<option value="'.$vvals['staff_id'].'">'.$vvals['name'].'</option>';
                }
               ?>
              </select>
            </div>
          </div>

<!-- 
         <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
              <label>Price</label>
              <input type="text" name="job_price" class="form-control" id="job_price" placeholder="Job Price">
            </div>
         </div> -->


         
      </div>
      <div class="row append_job_price">
 
     
   
    
        </div>


          <div class="form-group">
            <div class="col-md-12">
              <input type="submit" name="submit" value="Add" class="btn btn-primary pull-right">
            </div>
          </div>

        <?php echo form_close( ); ?>
      </div>


    </div>
  </section> 
</div>


<script>

$(function () {
   $("#job").change(function () {
        var selectedText = $(this).find("option:selected").text();
        var selectedValue = $(this).val();


     jQuery.ajax({
         type: "POST",
         url: '<?php echo base_url();?>admin/customerrates/jobrateslist',
         data: {selectservicesid:selectedValue},
         success: function(response)
         {
           jQuery(".append_job_price").html(response);
         }
    });   

       // alert("Selected Text: " + selectedText + " Value: " + selectedValue);


    });
});

$(document).ready(function(){

 $('#job').multiselect({
  nonSelectedText: 'Select Type',
  enableFiltering: true,
  enableCaseInsensitiveFiltering: true,
  buttonWidth:'100%'
 }); 
 $('#vendor').multiselect({
  nonSelectedText: 'Select Type',
  enableFiltering: true,
  enableCaseInsensitiveFiltering: true,
  buttonWidth:'100%'
 });

});

</script>