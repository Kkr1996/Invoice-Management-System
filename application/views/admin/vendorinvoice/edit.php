<?php
error_reporting(0);
?>
<style type="text/css">
  .removesubservices{
      border: none;
      background: no-repeat;
      color: red;
      cursor: pointer!important;
      text-align: right;
  }
  .dynamic-field1{
    clear:both;
  }
</style>
<div class="content-wrapper">
  <section class="content">
    <div class="card">
      
      <div class="card-header">
           <h1><?=$data['invoice_id']?></h1>
      </div>
       <!-- form start -->
        <div class="card-body">

          <?php $this->load->view('admin/includes/_messages.php') ?>
           <div class="box-tools">
               <a href="<?= base_url('admin/vendorinvoice'); ?>" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
            </div>
          <?php echo validation_errors(); ?>
          <?php 
            echo form_open(base_url('admin/vendorinvoice/edit/'.$data['id']), 'class="form-horizontal"'); 
          ?>
   <div class="row">
       
          <div class="col-12">
                <div class="col-xl-3 col-md-4 col-sm-6" style="padding-left:0;">
                    <div class="form-group">
                    <label>Company Name</label>
                        <select name="company_id" class="form-control company_id" id="select_company_id" required>
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
                <label>Vendor</label>
                <select name="vendor_id" id="vendor_id" class="form-control" required>
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
              <label>Terms.</label>
              <input type="text" name="terms" class="form-control" id="terms" placeholder="Terms No."value="<?php echo $data['terms'];?>"  required>
            </div>
          </div>  
            
          <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
              <label>Attn No.</label>
              <input type="text" name="attn_no" class="form-control" id="attn_no" placeholder="Attn No." value="<?php echo $data['attn_no'];?>"  required>
            </div>
          </div>         
            
      
        <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
              <label>D/O NO.</label>
              <input type="text" name="d_o_no" class="form-control" id="d_o_no" placeholder="D/O NO." value="<?php echo $data['d_o_no'];?>" required>
            </div>
          </div>   
            
            
       <?php
       
       
       
       ?>
<div class="clear"> </div>
    <div class="col-12">
        <div class="form-group">
        <div class="col-sm-12">
            <label>Items</label>
        </div>
<?php
//error_reporting(0);
//$descriptions  = unserialize($data['descriptions']);
//$qty           = unserialize($data['qty']);
//$price         = unserialize($data['price']);   
//$discount      = unserialize($data['discount']);   
//
//            
//            
//            
//if($data['item_code']){
//  foreach(unserialize($data['item_code']) as $keys=>$values){
//    echo '<div class="col-sm-12 dynamic-field" id="dynamic-field-1">
//<div class="row">
//            <div class="col-xl-3 col-md-4 col-sm-6">
//            <div class="form-group"> <label>Item code</label>  <input type="text" name="item_code[]" class="form-control" id="item_code" placeholder="Item code" value="'.$values.'" required>  </div> 
//            </div>
//            <div class="col-xl-3 col-md-4 col-sm-6"><div class="form-group">  <label>Descriptions</label><input type="text" name="descriptions[]" class="form-control" value="'.$descriptions[$keys].'" id="descriptions" placeholder="Descriptions"> </div>
//            </div>
//            <div class="col-xl-3 col-md-4 col-sm-6"><div class="form-group"> <label>Qty</label><input type="text" name="qty[]" class="form-control" id="qty" placeholder="Qty" value="'.$qty[$keys].'"> </div>
//            </div>
//            <div class="col-xl-3 col-md-4 col-sm-6"> <div class="form-group"> <label>Price</label>  <input type="text" name="price[]" value="'.$price[$keys].'" class="form-control" id="price" placeholder="Price"> </div> </div>    
//            <div class="col-xl-3 col-md-4 col-sm-6"> <div class="form-group"> <label>Discount</label> <input type="text" name="discount[]" value="'.$discount[$keys].'" class="form-control" id="discount" placeholder="Discount">  </div> 
//            </div>
//</div>
//            <button type="button" class="removesubservices">Remove
//            </button>
//         </div>';
//  }
//}

?>
            

   <?php 
      $alljobid=unserialize($data['jobid']); 
      $allqty=unserialize($data['qty']) ;
      $allprice=unserialize($data['price']) ; 
      $additional_custom_charge=unserialize($data['additional_custom_charge']) ; 
            
        // echo '<pre>', var_dump($alljobid); echo '</pre>';

    ?>         
               
        <div class="append-input"> 
            <?php
               if(count($alljobid) >0)
               {
                   for($i=0;$i <count($alljobid);$i++)
                   {
                       
                      $selected_job_id =  $alljobid[$i];
                       
                     echo '<div class="col-sm-12 dynamic-field1"> <div class="row"><div class="col-xl-3 col-md-4 col-sm-6"><div class="form-group"> <label>Job Id </label>';  
                       ?>
                        <select  class="form-control" name="jobid[]">
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
                       
                     echo '</div> </div> <div class="col-xl-3 col-md-4 col-sm-6"><div class="form-group"> <label>Qty</label><input type="text" name="qty[]" value="'.$allqty[$i].'" class="form-control" id="qty" placeholder="Qty"> </div></div> <div class="col-xl-3 col-md-4 col-sm-6"><div class="form-group"> <label>Additional Custom Charge</label><input type="text" name="additional_custom_charge[]" value="'.$additional_custom_charge[$i].'" class="form-control" id="additional_custom_charge" placeholder="Additional custom charge"> </div></div> <div class="col-xl-3 col-md-4 col-sm-6"> <div class="form-group"> <label>Price</label>  <input type="text" name="price[]" value="'.$allprice[$i].'" class="form-control" id="price" placeholder="Price"> </div> </div> </div> <button type="button" class="removesubservices">Remove</button></div>';   
                   }
                  
               }
            
            ?>
        </div>         
        </div>

        <div class="col-md-2 mt-30 append-buttons">
        <div class="clearfix">
        <button type="button" id="add-button" class="btn btn-secondary float-left text-uppercase shadow-sm">Add
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
  
//jQuery(".company_id").change(function(){
//    let company_id =  jQuery(this).val();
//    var array_data =  {
//        "company_id":company_id
//    }
//   $.ajax({
//        type:'POST',
//        url: "<?= base_url('admin/Vendorinvoice'); ?>/vendors_all_by_cid/",
//        data:array_data,
//        success: function(data){
//            console.log(data);
//        }
//    });
//});
//    
    
    
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
        
      let appendinput = '<div class="col-sm-12 dynamic-field"> <div class="row"><div class="col-xl-3 col-md-4 col-sm-6"><div class="form-group"> <label>Job Id </label> '+data+'  </div> </div> <div class="col-xl-3 col-md-4 col-sm-6"><div class="form-group"> <label>Qty</label><input type="text" name="qty[]" class="form-control" id="qty" placeholder="Qty"> </div></div><div class="col-xl-3 col-md-4 col-sm-6"><div class="form-group"><label>Additional custom charge</label><input type="text" name="additional_custom_charge[]" class="form-control" id="additional_custom_charge" placeholder="Additional custom charge"></div></div><div class="col-xl-3 col-md-4 col-sm-6"> <div class="form-group"> <label>Price</label>  <input type="text" name="price[]" class="form-control" id="price" placeholder="Price"> </div> </div> </div> <button type="button" class="removesubservices">Remove</button></div>';
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
         var company_id=$('#select_company_id').val(); 
            
        $('#select_company_id').change(function(){
            var company_id=$(this).val();   
            if($('.dynamic-field')[0])
                {
                 $('.dynamic-field').remove();   
                }
            $.ajax({
                    url: "<?php echo base_url('admin/Vendorinvoice'); ?>/vendorbycompany_id/"+company_id,
                    cache: false,
                    type:'POST',
                    dataType:'html',
                    success: function(data){  
                           $('#ve[0]ndor_id').html("");
                           $('#vendor_id').html(data);
                            console.log(data);
                        }
                });
             $.ajax({
                    url: "<?php echo base_url('admin/Vendorinvoice'); ?>/customerbycompany_id/"+company_id,
                    cache: false,
                    type:'POST',
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