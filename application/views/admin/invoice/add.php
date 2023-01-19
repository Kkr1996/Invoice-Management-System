<script src="<?php echo base_url();?>assets/dist/js/jquery-searchbox.js"></script>
<div class="content-wrapper">
  <section class="content">
    <!-- For Messages -->
  <?php $this->load->view('admin/includes/_messages.php'); ?>
    <div class="card">
      <div class="card-header">
           <h1>New Invoices</h1>
      </div>
      <div class="card-body">
          <div class="box-tools">
             <a href="<?= base_url('admin/invoices'); ?>" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
          </div>
        <?php echo validation_errors(); ?>           
        <?php echo form_open(base_url('admin/invoices/add'), 'class="form-horizontal custom_admin_form"');  ?>


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
              <label>Customer</label>
                <select name="customer_id" id="customer_id" class="form-control" required>
                 <option value="">Select Customer Name</option>
          
                </select>
              </div>
          </div>  

          <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
              <label>Job Name.</label>
                  <select name="job_no" id="job_id" class="form-control">
                  <option value="">Select Job Name</option>
          
                </select>
            </div>
          </div> 
          
          
     

   
 
<!--
           <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
              <label>Vendor</label>
                <select name="vendor_id" class="form-control" id="vendor_id">
             
                </select>
            </div>
          </div>        

           <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
              <label>Vendor Invoice</label>
              <input type="text" name="vendor_invoice" class="form-control" id="vendor_invoice" placeholder="Vendor Invoice" >
            </div>
          </div>
    

           <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
              <label>Cost</label>
              <input type="text" name="cost" class="form-control" id="cost" placeholder="Cost" required>
            </div>
          </div>           
-->
          <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
              <label>Remarks</label>
              <input type="text" name="remarks" class="form-control" id="remarks" placeholder="Remarks">
            </div>
          </div>
            
           <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
              <label>Quotation Number</label>
              <input type="text" name="loa_number" class="form-control" id="remarks" placeholder="Quotation Number" required>
            </div>
          </div>
          
  



           <div class="col-xl-3 col-md-4 col-sm-6">
              <div class="form-group">
                <label>Truck Manifest No.</label>
                <select class="form-control js-searchBox" name="do_number">
                      <?php 
                        foreach($trucklist as $tkeys=>$tvals){
                          echo '<option value="'.$tvals['truck_number'].'">'.$tvals['truck_number'].'</option>';
                        }
                      ?>
                </select>
              </div>
            </div>



            <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
              <label>Customer Reference Number</label>
              <input type="text" name="po_reference" class="form-control" id="remarks" placeholder="Customer Reference Number" required>
            </div>
          </div>  
            <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
              <label>Payment Term</label>
              <input type="text" name="term" class="form-control" id="payment_term" placeholder="Payment Term" required>
            </div>
          </div>  
          <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
              <label>Start Date</label>
              <input type="date" name="start_date" class="form-control" id="startdate" placeholder="Start Date" required>
            </div>
          </div>  

          <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
              <label>End Date</label>
              <input type="date" name="end_date" class="form-control" id="enddate" placeholder="End Date"  required>
            </div>
          </div> 
          <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
            <label>Customer Rates</label>
              <select class="form-control customer_all_rates" name="customer_rates">
                 
              </select>
            </div>
          </div> 
<!--
          <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
              <label>FAX</label>
              <input type="text" name="fax" class="form-control" id="fax" placeholder="FAX" required>
            </div>
          </div>
-->
         <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
              <label>ATTN</label>
              <input type="text" name="attn" class="form-control" id="attn" placeholder="ATTN" required>
            </div>
          </div>
          <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
              <label>Customer Reference Number 2</label>
              <input type="text" name="ibd" class="form-control" id="ibd" placeholder="Customer Reference Number 2">
            </div>
          </div> 
         <div class="col-xl-3 col-md-4 col-sm-6">
             <div class="form-group">
              <label>Loading Point</label>
              <input type="text" name="lodading_at_border" class="form-control" id="loading_point" placeholder="Loading Point" required>
            </div>
          </div>
          
          
         <div class="col-xl-3 col-md-4 col-sm-6">
             <div class="form-group">
              <label>Delivery Point</label>
              <input type="text" name="delivery_point" class="form-control" id="delivery_point" placeholder="Delivery Point" required>
            </div>
          </div>
            
           <div class="col-xl-3 col-md-4 col-sm-6">
             <div class="form-group">
              <label>UOM</label>
                 
              <select class="form-control" name="utm">
                  
                  <option value="DESCRIPTION">DESCRIPTION</option>
                  <option value="TON">TON</option>
                  <option value="BAG">BAG</option>
                  <option value="BARREL">BARREL</option>
                  <option value="BLOCK">BLOCK</option>
                  <option value="BOARD">BOARD</option>
                  <option value="BOTTLE">BOTTLE</option>
                  <option value="BOX">BOX</option>
                  <option value="BUNDLE">BUNDLE</option>
                  <option value="CARTON">CARTON</option>
                  <option value="CUBIC FEET">CUBIC FEET</option>
                  <option value="CUBIC METER">CUBIC METER</option>
                  <option value="DEGREES CELSIUS">DEGREES CELSIUS</option>
                  <option value="DRUM">DRUM</option>
                  <option value="PIECES">PIECES</option>
                  <option value="FEET">FEET</option>

                  <option value="GALLON">GALLON</option>
                  <option value="KILOGRAM">KILOGRAM</option>
                  <option value="METRIC TON">METRIC TON</option>
                  <option value="PACK">PACK</option>
                  <option value="PAIL">PAIL</option>
                  <option value="PALLET">PALLET</option>
                  <option value="SHIPMENT">SHIPMENT</option>
              </select>
                 
            </div>
          </div>  
            
            
            
        </div>
          
          
        <div class="col-12" style="padding:0">
            <div class="form-group">
                
                
                <div class="col-sm-12" style="padding:0px">
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
                <div class="append-input">
                    
                </div>         
            </div>

            <div class="col-md-2 mt-30 append-buttons" style="padding:0">
                <div class="clearfix">
                    <button type="button" id="add-button" class="btn btn-secondary float-left text-uppercase shadow-sm">Add Item
                    </button>
                </div>
            </div>
        </div>    

     

          <div class="form-group">
            <div class="col-md-12">
              <input type="submit" name="submit" value="Save" class="btn btn-primary pull-right">
            </div>
          </div>
        <?php echo form_close( ); ?>
      </div>


    </div>
  </section> 
</div>
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



//jQuery(".removesubservices").click(function(){
//  jQuery(this).parent(".dynamic-field1").remove();
//});

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

function removefunction(){
  jQuery(".removesubservices").click(function(){
    jQuery(this).parent(".dynamic-field").remove();
  });
 
}
</script>



<script>
  
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
        var jobid=$(this).val();
        $html_data=$(this).parent().parent().parent();
        $.ajax({
                url: "<?php echo base_url('admin/Invoices'); ?>/get_extra_price_byjobid/"+jobid,
                cache: false,
                type:'GET',
                success: function(data){  
                     $html_data.find('.price').val(data);
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
    
</script>
<script>
  $("#location").addClass('active');
  $('.js-searchBox').searchBox();
</script>