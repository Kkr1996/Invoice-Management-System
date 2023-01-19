<?php
    error_reporting(0);
?>
<script src="<?php echo base_url();?>assets/dist/js/jquery-searchbox.js"></script>
<div class="content-wrapper">
  <section class="content">
    <div class="card">
     <?php $this->load->view('admin/includes/_messages.php') ?>
      <div class="card-header">
           <h1><?=$data['invoice_no']?></h1>
      </div>
     
       <!-- form start -->
        <div class="card-body">
            <div style="display:flex; justify-content:end;">
                <div >
                <a href="<?php echo base_url().'admin/invoices/view/'.$data['invoice_no']; ?>" target="_blank" class="btn btn-sm1">View</a>
                </div>        
                <div>
                <a href="<?= base_url('admin/invoices'); ?>" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
                </div>
            
            </div>
         
          <?php echo validation_errors(); ?>
            
            
  
          <?php 
            echo form_open(base_url('admin/invoices/edit/'.$data['id']), 'class="form-horizontal custom_admin_form custom_admin_edit_form"'); 
          ?>
        <div class="row">
            
          <div class="col-12">
                <div class="col-xl-3 col-md-4 col-sm-6" style="padding-left:0;">
                    <div class="form-group">
                    <label>Company Name</label>
                        <select name="company_id" class="form-control" id="select_company_id" required>
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

<!--
          <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
                <label>Vendor</label>
                <select name="vendor_id" id="vendor_id" class="form-control" >
                <option value=""> Select Vendor Name </option>
                  <?php
                    foreach($vendors as $vendor){
                         echo '<option value="'.$vendor->id.'" ';
                         if($vendor->id == $data['vendor_id']){
                             echo "selected";
                         }
                         echo '>'.$vendor->name.'</option>';
                     }        
                    ?>
                </select>
            </div>
          </div>  
-->

           <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
              <label>Customer</label>
              <select name="customer_id" id="customer_id" class="form-control" required>
                 <option value="">Select Customer Name</option>
                      <?php
                        foreach($customers as $customer){
                            
                             echo '<option value="'.$customer->id.'" ';
                             if($customer->id == $data['customer_id']){
                                 echo "selected";
                             }
                             echo '>'.$customer->username.'</option>';
                         }        
                    ?>
                </select>
            </div>
          </div>
            
            
          <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
              <label>Job Id.</label>
           

                 <select name="job_no" id="job_id" class="form-control" required>

                     <option value="<?php echo $data['job_no'];?>"><?php echo $job_name;?></option>
          
                </select>


            </div>
          </div>            
     
    





           <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
              <label>Invoice No</label>
              <input type="text" name="invoice_no" class="form-control" id="invoice_no" placeholder="invoice No." value="<?php echo $data['invoice_no'];?>" required readonly>
            </div>
          </div>
           <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
              <label>Remarks</label>
              <input type="text" name="remarks" class="form-control" id="remarks" placeholder="Remarks" value="<?php echo $data['remarks'];?>">
            </div>
          </div>
        <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
              <label>Quotation Number</label>
              <input type="text" name="loa_number" class="form-control" id="loa_number" placeholder="Quotation Number" value="<?php echo $data['loa_number'];?>" required>
            </div>
          </div>
   
          <div class="col-xl-3 col-md-4 col-sm-6">
              <div class="form-group">
                <label>Truck Manifest No.</label>
                <select class="form-control js-searchBox" name="do_number">
                      <?php 
                        foreach($trucklist as $tkeys=>$tvals){
                          if($tvals['truck_number'] == $data['do_number'] ){
                              $sel  ="selected";
                          }
                          else{
                              $sel   ="";
                          }
                          echo '<option value="'.$tvals['truck_number'].'" '.$sel.'>'.$tvals['truck_number'].'</option>';
                        }
                      ?>
                </select>
              </div>
            </div> 
          <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
              <label>Customer Reference Number</label>
              <input type="text" name="po_reference" class="form-control" id="po_Ref" placeholder="Customer Reference Number" value="<?php echo $data['po_reference'];?>"required>
            </div>
          </div> 
            
          <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
              <label>Payment TERM</label>
              <input type="text" name="term" class="form-control" id="payment_term" placeholder="TERM" value="<?php echo $data['term'];?>" required>
            </div>
          </div> 
            
          <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
              <label>Start Date</label>
              <input type="date" name="start_date" class="form-control" id="startdate" placeholder="Start Date" value="<?php echo $data['start_date'];?>" required>
            </div>
          </div>  

          <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
              <label>End Date</label>
              <input type="date" name="end_date" class="form-control" id="enddate" placeholder="End Date" value="<?php echo $data['end_date'];?>" required>
            </div>
          </div> 

          <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
            <label>Customer Rates</label>
              <select class="form-control customer_all_rates" name="customer_rates">
                  <option value="<?php echo $data['customer_rates'];?>"><?php echo $data['customer_rates'];?></option>
              </select>
            </div>
          </div> 
          
          <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
              <label>Customer Reference Number 2</label>
              <input type="text" name="ibd" class="form-control" id="ibd" placeholder="Customer Reference Number 2" value="<?php echo $data['ibd'];?>">
            </div>
          </div> 
<!--
        <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
              <label>FAX</label>
              <input type="text" name="fax" class="form-control" id="fax" placeholder="FAX"  value="<?php echo $data['fax'];?>" required>
            </div>
          </div>
-->
        <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
              <label>ATTN</label>
              <input type="text" name="attn" class="form-control" id="attn" placeholder="ATTN" value="<?php echo $data['attn'];?>"  required>
            </div>
          </div>    

          
         <div class="col-xl-3 col-md-4 col-sm-6">
             <div class="form-group">
              <label>Loading Point</label>
              <input type="text" name="lodading_at_border" class="form-control" id="loading_point" placeholder="Loading Point" value="<?php echo $data['lodading_at_border'];?>"  required>
            </div>
          </div>
          
          
         <div class="col-xl-3 col-md-4 col-sm-6">
             <div class="form-group">
              <label>Delivery Point</label>
              <input type="text" name="delivery_point" class="form-control" id="delivery_point" placeholder="Delivery Point" value="<?php echo $data['delivery_point'];?>" required>
            </div>
          </div>
        
           <div class="col-xl-3 col-md-4 col-sm-6">
             <div class="form-group">
              <label>UOM</label>
                 
              <select class="form-control" name="utm">
                  
                  <option value="DESCRIPTION" <?php if($data['utm'] == "DESCRIPTION"){echo "selected";}?> >DESCRIPTION</option>
                  <option value="TON" <?php if($data['utm'] == "TON"){echo "selected";}?> >TON</option>
                  <option value="BAG" <?php if($data['utm'] == "BAG"){echo "selected";}?>>BAG</option>
                  <option value="BARREL" <?php if($data['utm'] == "BARREL"){echo "selected";}?>>BARREL</option>
                  <option value="BLOCK" <?php if($data['utm'] == "BLOCK"){echo "selected";}?>>BLOCK</option>
                  <option value="BOARD" <?php if($data['utm'] == "BOARD"){echo "selected";}?>>BOARD</option>
                  <option value="BOTTLE" <?php if($data['utm'] == "BOTTLE"){echo "selected";}?>>BOTTLE</option>
                  <option value="BOX" <?php if($data['utm'] == "BOX"){echo "selected";}?>>BOX</option>
                  <option value="BUNDLE" <?php if($data['utm'] == "BUNDLE"){echo "selected";}?>>BUNDLE</option>
                  <option value="CARTON" <?php if($data['utm'] == "CARTON"){echo "selected";}?>>CARTON</option>
                  <option value="CUBIC FEET" <?php if($data['utm'] == "CUBIC FEET"){echo "selected";}?>>CUBIC FEET</option>
                  <option value="CUBIC METER" <?php if($data['utm'] == "CUBIC METER"){echo "selected";}?>>CUBIC METER</option>
                  <option value="DEGREES CELSIUS" <?php if($data['utm'] == "DEGREES CELSIUS"){echo "selected";}?>>DEGREES CELSIUS</option>
                  <option value="DRUM" <?php if($data['utm'] == "DRUM"){echo "selected";}?>>DRUM</option>
                  <option value="PIECES" <?php if($data['utm'] == "PIECES"){echo "selected";}?>>PIECES</option>
                  <option value="FEET" <?php if($data['utm'] == "FEET"){echo "selected";}?>>FEET</option>
                  <option value="GALLON" <?php if($data['utm'] == "GALLON"){echo "selected";}?>>GALLON</option>
                  <option value="KILOGRAM" <?php if($data['utm'] == "KILOGRAM"){echo "selected";}?>>KILOGRAM</option>
                  <option value="METRIC TON" <?php if($data['utm'] == "METRIC TON"){echo "selected";}?>>METRIC TON</option>
                  <option value="PACK" <?php if($data['utm'] == "PACK"){echo "selected";}?>>PACK</option>
                  <option value="PAIL" <?php if($data['utm'] == "PAIL"){echo "selected";}?>>PAIL</option>
                  <option value="PALLET" <?php if($data['utm'] == "PALLET"){echo "selected";}?>>PALLET</option>
                  <option value="SHIPMENT" <?php if($data['utm'] == "SHIPMENT"){echo "selected";}?>>SHIPMENT</option>
              </select>
                 
            </div>
          </div> 

        </div>
        <div class="col-12" style="padding:0;">
            <div class="form-group">
                <div class="col-sm-12" style="padding:0px; margin-top: 30px; clear: both; ">
                    <label>Items ( Please select company for appering all the job id )</label>
                </div>
                <div class="col-sm-12" style="padding:0px;width:98%">
                    <div class="row">
                    <div class="col-xl-3 col-md-4 col-sm-6">
                        <div class="form-group"> 
                            <label>Job Id </label>   
                        </div> 
                    </div> 
                    <div class="col-xl-3 col-md-4 col-sm-6"> 
                        <div class="form-group"> 
                            <label>Description</label>  
                        </div>
                    </div>
                    <div class="col-xl-1 col-md-4 col-sm-6">
                        <div class="form-group"> 
                            <label>Qty</label>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-4 col-sm-6">
                        <div class="form-group">
                            <label>Extra Price per unit</label>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-4 col-sm-6">
                        <div class="form-group"> 
                            <label>Price</label> 
                        </div>
                    </div>  
                    <div class="col-xl-1 col-md-4 col-sm-6">
                        <div class="form-group"> 
                            <label>Tax</label> 
                        </div>
                    </div>  
                </div>
                </div> 
                <?php 
                    $alljobid=unserialize($data['jobid']); 
                    $allqty=unserialize($data['qty']) ;
                    $allprice=unserialize($data['price']) ; 
                    $allextra_price=unserialize($data['extra_price']) ; 
                    $description=unserialize($data['description']) ; 
                    $tax=unserialize($data['tax']) ; 
                   

                ?> 
                <div class="append-input">
                    <?php
                       if(count($alljobid) >0)
                       {
                           for($i=0;$i <count($alljobid);$i++)
                           {

                              $selected_job_id =  $alljobid[$i];

                              $taxes = $tax[$i];

                              if($taxes == 1){
                                $tax_value = 1;
                                $checked = "checked";
                              }
                              else{
                                $tax_value = 0;
                                $checked = "";
                              }

                             echo '<div class="dynamic-field1"> <div class="row"><div class="col-xl-3 col-md-4 col-sm-6"><div class="form-group">';  
                               ?>
                                <select  class="form-control select_job_id" name="jobid[]" >
                                    <option value="">Select Job Name </option>
                                    <?php
                                        foreach($job_ids as $keys=>$job_id){
                                            echo '<option value="'.$job_id->jobid.'" ';
                                            if($job_id->jobid == $selected_job_id){
                                             echo "selected";
                                            }
                                            echo '>'.$job_id->name.'</option>';
                                        }        
                                    ?>
                                </select>
                              <?php

                             echo '</div> </div><div class="col-xl-3 col-md-4 col-sm-6"><div class="form-group"><input type="text" name="description[]" value="'.$description[$i].'" class="form-control" id="description" placeholder="Description"> </div></div> <div class="col-xl-1 col-md-4 col-sm-6"><div class="form-group"><input type="text" name="qty[]" value="'.$allqty[$i].'" class="form-control" id="qty" placeholder="Qty"> </div></div> <div class="col-xl-2 col-md-4 col-sm-6"><div class="form-group"><input type="text" name="extra_price[]" value="'.$allextra_price[$i].'" class="form-control" id="additional_custom_charge" placeholder="Additional custom charge"></div></div> <div class="col-xl-2 col-md-4 col-sm-6"> <div class="form-group"><input type="text" name="price[]" value="'.$allprice[$i].'" value="" class="form-control price" id="price" placeholder="Price"></div></div><div class="col-xl-1 col-md-4 col-sm-6"> <div class="form-group"><input type="hidden" name="checkbox_1[]" class="checkme_parent" value="'.$tax_value.'"><input type="checkbox"  class="checkme" name="tax_per_item[]" value="'.$tax_value.'" '.$checked.'></div></div></div><button type="button" class="removesubservices">╳</button></div>';   
                           }

                       }

                    ?>
                </div>         
            </div>

            <div class="col-md-2 mt-30 append-buttons">
                <div class="clearfix">
                    <button type="button" id="add-button" class="btn btn-secondary float-left text-uppercase shadow-sm">Add Item
                    </button>
                </div>
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
 <script>
    
jQuery(".removesubservices").click(function(){
  jQuery(this).parent(".dynamic-field1").remove();
});

jQuery("#add-button").click(function(){

var company_id = $('#select_company_id').val();
$.ajax({
    url: "<?php echo base_url('admin/Vendorinvoice'); ?>/jobbycompany_id/"+company_id,
    cache: false,
    type:'GET',
    dataType:'html',
    success: function(data){  
      // alert(data);
        
      let appendinput = '<div class="dynamic-field"> <div class="row"><div class="col-xl-3 col-md-4 col-sm-6"><div class="form-group"> '+data+'  </div> </div> <div class="col-xl-3 col-md-4 col-sm-6"> <div class="form-group"><input type="text" name="description[]" class="form-control" placeholder="Description"> </div> </div><div class="col-xl-1 col-md-4 col-sm-6"><div class="form-group"><input type="text" name="qty[]" class="form-control" id="qty" placeholder="Qty"> </div></div><div class="col-xl-2 col-md-4 col-sm-6"><div class="form-group"><input type="text" name="extra_price[]" class="form-control" id="extra_price" placeholder="Extra Price Per unit"></div></div><div class="col-xl-2 col-md-4 col-sm-6"> <div class="form-group"><input type="text" name="price[]" class="form-control price" placeholder="Price"> </div> </div> <div class="col-xl-1 col-md-4 col-sm-6"> <div class="form-group"><input type="hidden" name="checkbox_1[]" class="checkme_parent" value="0"><input type="checkbox" class="checkme" name="tax_per_item[]" value="0"></div></div></div> <button type="button" class="removesubservices">╳</button></div>';
       jQuery(".append-input").append(appendinput);
       removefunction();
       checkbox_active();
          
    }
});


    
});

function removefunction(){
  jQuery(".removesubservices").click(function(){
    jQuery(this).parent(".dynamic-field").remove();
  });
 
}
</script>     
      
      
      
<script>
    jQuery(document).ready(function(){
      jQuery("#customer_id").change(function(){
          let customer_id = jQuery(this).val();

        
                $.ajax({
                  url: "<?php echo base_url('admin/users'); ?>/users_info/"+customer_id,
                  cache: false,
                  type:'GET',
                  dataType:'html',
                  success: function(data){  
                        var results = jQuery.parseJSON(data);
                        let startdate    = results.start_date;
                        let enddate      = results.end_date;
                        let payment_term = results.payment_term;
                        let attn         = results.attn;
                        let rates        = results.allrates;
                        jQuery("#attn").val(attn);
                        jQuery("#payment_term").val(payment_term);
                        jQuery("#startdate").val(startdate);
                        jQuery("#enddate").val(enddate);
                        jQuery(".customer_all_rates").html(rates);
                  }
                });
      });
    });
function checkbox_active(){
  jQuery('.checkme').click(function(){
    if(jQuery(this).prop('checked') == true){
       // jQuery(this).val(1);
        jQuery(this).parent().find('.checkme_parent').val(1);
    }
    else{
       // jQuery(this).val(0);
        jQuery(this).parent().find('.checkme_parent').val(0);
    }
  });
}



 $(document).ready(function(){

      checkbox_active();


        $('#select_company_id').change(function(){
            var company_id=$(this).val();   
            if ($(".dynamic-field")[0]){
               $(".dynamic-field").remove();
            }
            $.ajax({
                    url: "<?php echo base_url('admin/Vendorinvoice'); ?>/vendorbycompany_id/"+company_id,
                    cache: false,
                    type:'GET',
                    dataType:'html',
                    success: function(data){  
                           $('#vendor_id').html("");
                           $('#vendor_id').html(data);
                            console.log(data);
                        }
                });
             $.ajax({
                    url: "<?php echo base_url('admin/Vendorinvoice'); ?>/customerbycompany_id/"+company_id,
                    cache: false,
                    type:'GET',
                    dataType:'html',
                    success: function(data){  
                           $('#customer_id').html("");
                           $('#customer_id').html(data);
                            console.log(data);
                        }
                });       
            
               $.ajax({
                    url: "<?php echo base_url('admin/Vendorinvoice'); ?>/jobbycompany_id/"+company_id,
                    cache: false,
                    type:'GET',
                    dataType:'html',
                    success: function(data){  
                           $('#job_id').html("");
                           $('#job_id').html(data);
                            console.log(data);
                        }
                });
        }); 
       
    });
    
    $(document).on("change",".select_job_id",function(){
        
       // alert("Okay");
        var jobid=$(this).val();
        $html_data=$(this).parent().parent().parent();
        $.ajax({
                url: "<?php echo base_url('admin/Invoices'); ?>/get_extra_price_byjobid/"+jobid,
                type:'POST',
                success: function(data){  
                     var trimStr = $.trim(data);
                     $html_data.find('.price').val(trimStr);
                }
            });
    }); 
    
      $(document).on('change','.select_job_id',function(){
       let testing=$(this).val();
          
        var test_count=0;
        var db_test_count=0;  
        $('.select_job_id').each(function()
        {
            
            if(testing == $(this).val())
            {
              test_count++;
            }
       
        });   
  
          
     $.ajax({
            url: "<?php echo base_url('admin/Invoices'); ?>/get_match_jobid_counter/"+testing,
            type:'GET',
            success: function(data){  
               
                db_test_count=parseInt(data);
                if(test_count >1 || db_test_count >1)
                {
                alert('Alert ! You have already selected this Job.');
                }  
         
            }
        }); 


         
          
   });
    

jQuery("#manifest_id").keyup(function(){

        var manifest_id = $(this).val();
        $.ajax({
                url: "<?php echo base_url('admin/Invoices'); ?>/checkmanifest/"+manifest_id,
                cache: false,
                type:'GET',
                success: function(data){  
                   
                        console.log(data);
                        if(data == "0" || data == 0  || data == null){

                            jQuery("#manifest_id_error").html("Invalid");
                            jQuery("#manifest_id_error").addClass("error");
                             jQuery("#manifest_id_error").removeClass("correct");
                        }
                        else{
                              jQuery("#manifest_id_error").html("Correct Manifest No.");
                              jQuery("#manifest_id_error").addClass("correct");
                              jQuery("#manifest_id_error").removeClass("error");
                        }
                }

        });


});
$('.js-searchBox').searchBox(); 
</script> 
  </section> 
</div>

