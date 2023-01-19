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
    <div class="card">
      
      <div class="card-header">
           <h1><?=$data['name']?></h1>
      </div>
       <!-- form start -->
        <div class="card-body">
           <div class="box-tools">
               <a href="<?= base_url('admin/customerrates'); ?>" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
            </div>
          <?php echo validation_errors(); ?>
          <?php 
            echo form_open(base_url('admin/customerrates/edit/'.$data['id']), 'class="form-horizontal"'); 
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
              <label>Customer Name</label>
              <input type="text" name="name" class="form-control" id="name" placeholder="Name" value="<?= $data['name']; ?>" required>
            </div>
          </div>

         
    
          <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
              <label> Customer Id</label>
              <input type="text" name="customer_id" class="form-control" id="customer_id" placeholder="Customer Id"  value="<?= $data['customer_id']; ?>"> 
            </div>
         </div>
            <div class='col-md-3 col-sm-3 subcategory'>
            <label for="featured_img" class="control-label" style="margin-bottom:10px;">Vendor</label>
             <?php
             $unserialize_subcategory = array();
             if($data['vendor']):
                $unserialize_subcategory = unserialize($data['vendor']);
             endif;
             ?>
                <select class="form-control" name="vendor[]" id="vendor" multiple>
                    <option disabled="disabled">Select Vendor</option>
                    <?php 
                        foreach($vrecords as $fkeys=>$fvalues) 
                        {
                            $checkarray = $fvalues['staff_id'];
                            $checkcondition =  in_array($checkarray,$unserialize_subcategory);
                            echo '<option value="'.$fvalues['slug'].'" ';
                                if($checkcondition == true )
                                {
                                    echo "selected";
                                }
                                echo '>'.$fvalues['name'].'</option>';  
                        }
                    ?>
                </select>
            </div> 

            <div class='col-md-3 col-sm-3 subcategory'>
            <label for="featured_img" class="control-label" style="margin-bottom:10px;">Select Job</label>
             <?php
             $unserialize_subcategory = array();
                if($data['job_type']){
                $unserialize_subcategory = unserialize($data['job_type']);
                    $job_type_array   = unserialize($data['job_type']);
                }else{
                    $unserialize_subcategory = $unserialize_subcategory;
                }
             

             ?>
                <select class="form-control" name="job_type[]" id="job" multiple>
                    <option disabled="disabled">Select Category</option>
                    <?php 
                        foreach($job_records as $fkeys=>$fvalues) 
                        {

                            $checkarray = $fvalues['slug'];
                            $checkcondition =  in_array($checkarray,$unserialize_subcategory);
                            echo '<option value="'.$fvalues['slug'].'" ';
                                if($checkcondition == true )
                                {
                                    echo "selected";
                                }
                                echo '>'.$fvalues['name'].'</option>';  
                        }
                    ?>
                </select>
            </div> 


          <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
              <label>Invoice id</label>
              <input type="text" name="invoice_id" class="form-control" id="invoice_id" placeholder="Invoice id" value="<?= $data['invoice_id']; ?>" required>
            </div>
          </div>

<!-- 
         <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
              <label>Price</label>
              <input type="text" name="job_price" class="form-control" id="job_price" placeholder="Job Price" value="<?= $data['job_price']; ?>">
            </div>
         </div> -->



<!--          <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
              <label>Extra Price</label>
              <input type="text" name="extra_price" class="form-control" id="extra_price" placeholder="Extra Price" value="<?= $data['extra_price']; ?>">
            </div>
         </div> -->
        </div>



        <div class="row append_job_price">
 
            <label for="featured_img" class="control-label" style="margin-bottom:10px;">Selected Job Price</label>
             <?php
                 $unserialize_subcategory = array();
                if($data['job_price']){
                    $unserialize_subcategory = unserialize($data['job_price']);
                }else{
                    $unserialize_subcategory = $unserialize_subcategory;
                }
                foreach($unserialize_subcategory as $jp_keys=>$jp_vals){
                    echo '<div class="col-xl-12 col-md-4 col-sm-6">
                    <div class="form-group">
                    <label>'.$job_type_array[$jp_keys].' (Job Rate)</label>
                    <input type="text" name="job_price[]" class="form-control" id="extra_price" placeholder="Job Price" value="'.$jp_vals.'">
                    </div>
                    </div>';
                }
                

             ?>
    
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