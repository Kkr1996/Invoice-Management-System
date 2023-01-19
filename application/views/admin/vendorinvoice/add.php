<div class="content-wrapper">
  <section class="content">
    <!-- For Messages -->
    <?php $this->load->view('admin/includes/_messages.php') ?>
    <div class="card">
      <div class="card-header">
           <h1>New Vendor Invoice</h1>
      </div>
      <div class="card-body">
          <div class="box-tools">
             <a href="<?= base_url('admin/vendorinvoice'); ?>" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
          </div>
        <?php echo validation_errors(); ?>           
        <?php echo form_open(base_url('admin/vendorinvoice/add'), 'class="form-horizontal"');  ?>


        <div class="row">
            
         <div class="col-12">
                <div class="col-xl-3 col-md-4 col-sm-6" style="padding-left:0;">
                    <div class="form-group">
                    <label>Company Name</label>
                        <select name="company_id" id="select_company_id"  class="form-control" required>
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
              <label>Vendor</label>
                <select name="vendor_id" id="vendor_id" class="form-control" required>
                <option value="">Select Vendor Name</option>
                <?php
//                if(count($vendorlist) > 0){
//                    foreach($vendorlist as $keys=>$kvals){
//                        echo '<option value="'.$kvals['staff_id'].'">'.$kvals['name'].'</option>';
//                    }
//                }
                ?>
                </select>
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
              <label>Invoice Date.</label>
              <input type="date" name="invoice_date" class="form-control" id="invoice_date" placeholder="Invoice Date" required>
            </div>
          </div>          
            
          <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
              <label>Terms</label>
              <input type="text" name="terms" class="form-control" id="terms" placeholder="terms" required>
            </div>
          </div>        
            
          <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
              <label>Attn No.</label>
              <input type="text" name="attn_no" class="form-control" id="attn_no" placeholder="Attn No." required>
            </div>
          </div>         
         <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
              <label>D/O NO.</label>
              <input type="text" name="d_o_no" class="form-control" id="d_o_no" placeholder="D/O NO." required>
            </div>
          </div>           
   <div class="clear"> </div>
            
    <div class="col-12">
        <div class="form-group">
            <div class="col-sm-12">
                <label>Items</label>
       
            </div>
            <div class="append-input">
            </div>         
        </div>

        <div class="col-md-2 mt-30 append-buttons">
            <div class="clearfix">
                <button type="button" id="add-button" class="btn btn-secondary float-left text-uppercase shadow-sm">Add Item
                </button>
            </div>
        </div>
    </div>  

            
        
            

            
 
  
<!--          <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
              <label>Job Status</label>
              <select class="form-control" name="status">
                   <option value="published">Confirmed</option>
                    <option value="draft">Draft</option>
              </select>
            </div>
          </div> -->

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
  
jQuery(".removesubservices").click(function(){     
  jQuery(this).parent(".dynamic-field").remove();
});

jQuery("#add-button").click(function(){
    
var company_id = $('#select_company_id').val();
$.ajax({
    url: "<?php echo base_url('admin/Vendorinvoice'); ?>/jobbycompany_id/"+company_id,
    cache: false,
    type:'GET',
    dataType:'html',
    success: function(data){    
      let appendinput = '<div class="col-sm-12 dynamic-field"> <div class="row"><div class="col-xl-3 col-md-3 col-sm-6"><div class="form-group"> <label>Job Id </label> '+data+'  </div> </div> <div class="col-xl-3 col-md-3 col-sm-6"><div class="form-group"> <label>Qty</label><input type="text" name="qty[]" class="form-control" id="qty" placeholder="Qty"> </div></div><div class="col-xl-3 col-md-3 col-sm-6"><div class="form-group"><label>Additional custom charge</label><input type="text" name="additional_custom_charge[]" class="form-control" id="additional_custom_charge" placeholder="Additional custom charge"></div></div>  <div class="col-xl-3 col-md-3 col-sm-6"> <div class="form-group"> <label>Price</label>  <input type="text" name="price[]" class="form-control" id="price" placeholder="Price"> </div> </div> </div> <button type="button" class="removesubservices">Remove</button></div>';
       jQuery(".append-input").append(appendinput);
       removefunction();
        
        
    }
});
   
});


function removefunction(){
  jQuery(".removesubservices").click(function(){
    jQuery(this).parent(".dynamic-field").remove();
  });
 
}
</script>
<!--select compmay script -->
<script>
  
     $(document).ready(function(){
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
        }); 
       
    });
    
</script>

<script>
  $("#location").addClass('active');
</script>