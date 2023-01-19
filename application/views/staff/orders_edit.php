  <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Orders </h1>
                       
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Edit Orders
                            </div>
                            <div class="card-body">  
                            <?php $this->load->view('admin/includes/_messages.php') ?>    
            <?php echo validation_errors(); ?>           
            <?php echo form_open(base_url('staff/staffcontroller/ordersupdate/'.$orders['order_id']), 'class="form-horizontal"');  ?>

              <div class="form-group">
                <div class="col-sm-12">
                  <label for="name" class="col-sm-3 control-label">Name</label>
                  <div class="col-sm-12">
                      <input type="text" name="name" class="form-control" value="<?= $orders['name']; ?>" id="name" required>
                      <input type="hidden" name="orderid" class="form-control" value="<?= $orders['order_id']; ?>" id="staffid"> 
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="name" class="col-sm-3 control-label">Email</label>
                <div class="col-sm-12">
                  <input type="text" name="email" class="form-control" value="<?= $orders['email']; ?>" id="email" placeholder="Email" required readonly>
                </div>
              </div>
            
                                
                                
               <div class="form-group">
                    <label for="inputAddress">Service</label>
                    <input type="text" class="form-control" id="services" name="services" placeholder="Services" value="<?= $orders['services']; ?>">
                </div>
           
                <div class="form-group">
                    <label for="inputAddress">Sub Service</label>
                    <input type="text" class="form-control" id="subservices" name="subservices" placeholder="subservices" value="<?= $orders['subservices']; ?>" >
                </div>
                <div class="form-group">
                     <label for="inputAddress">Prices</label><br>
                     <input type="text" class="form-control" name="prices"  placeholder="Prices" value="<?= $orders['price']; ?>" maxlength="10" readonly>
                </div>
                  
            
                                
                                
<div class="form-group">   
    
<?php                          
if($orders['eservices']) {
    $eservice  = unserialize($orders['eservices']);
}else{
    $eservice = [];
}                    
if($orders['esubservices']){
     $esubservices  = unserialize($orders['esubservices']);
}else{
    $esubservices = [];
}
                                
if($orders['eprices']){
    $eprices      = unserialize($orders['eprices']);
}else{
    $eprices = [];
}    
    
if($orders['eservices']){
    echo '<label for="inputAddress">Extra Services</label><br>';
    foreach(unserialize($orders['eservices']) as $keys=>$values){  
        
        echo '<div class="col-sm-12 dynamics_row">
            <div class="row">
            <div class="col-xl-4 col-md-6">
                <input type="text" name="eservices[]" class="form-control"  value="'.$values.'" id="sub_services" placeholder="Services" required> 
            </div>
            <div class="col-xl-4 col-md-6">
                <input type="text" name=" esubservices[]" class="form-control" value="'.$esubservices[$keys].'" id="sub_services" placeholder="Sub Services" required>
            </div>
            <div class="col-xl-4 col-md-6">
                <input type="text" name="eprices[]" class="form-control"  value="'.$eprices[$keys].'" id="sub_prices" placeholder="Sub Price" required> 
            </div>
            </div> <button type="button" class="removesubservices">Remove</button>
        </div>';
    }
}
    
?>              
</div>
                                
<div id="extra_services">
</div>          
                                
                                
<div class="addservices">Add Extra Services</div>            
<div class="form-group">
<label for="inputAddress">Final Price</label><br>
<input type="text" class="form-control" name="finalprice"  placeholder="finalprice" value="<?= $orders['finalprice']; ?>">
</div>
                                                           
                                
<div class="form-group">
<label for="name" class="col-sm-3 control-label">Mobile No.</label>
<div class="col-sm-12">
<input type="text" name="mobile_no" class="form-control" value="<?= $orders['mobile_no']; ?>" id="mobile_no" placeholder="Mobile No." required>
</div>
</div>
<label class="col-sm-3 control-label">Customer Id</label>
<?php
if($orders['registered_users'] == 0){
echo '<div class="form-group">
        <div class="col-sm-12">
          <input type="text" name="userid" class="form-control" id="userid" placeholder="Customer Id" value="'.$orders['userid'].'">
        </div>
     </div>';
}
else{
echo '<input type="text" name="userid" class="form-control" id="userid" value="'.$orders['userid'].'" placeholder="Customer Id">'; 
}
?>

<div class="form-group">
<label for="name" class="col-sm-3 control-label">Status</label>
<select name="status" class="form-control">
    <option value="New(default)"   <?php if($orders['status'] == "New(default)" ){echo "selected";}?> > New(default)</option>
    <option value="Dropped" <?php if($orders['status'] == "New(default)" ){echo "selected";}?>>Dropped</option>
    <option value="In discussion" <?php if($orders['status'] == "In discussion" ){echo "selected";}?>>In discussion</option>
    <option value="Converted" <?php if($orders['status'] == "Converted" ){echo "selected";}?>>Converted</option>
    <option value="WIP" <?php if($orders['status'] == "WIP" ){echo "selected";}?>>WIP</option>
    <option value="Completed" <?php if($orders['status'] == "Completed" ){echo "selected";}?>>Completed</option>
</select>
</div>
<div class="form-group">
<label for="name" class="col-sm-3 control-label">Remarks</label>
<div class="col-sm-12">
 <textarea col="10" rows="5" class="form-control" name="remarks"><?=$orders['remarks'];?></textarea>
</div>

</div>
<div class="form-group">

<?php
$sttus = $orders['status'];
if($sttus == "Converted"){
    echo '<label for="name" class="col-sm-3 control-label">Generate Pdf</label>';
    $inv_av = '<a href="'.base_url().'admin/staff/generatepdf/'.$orders['order_id'].'" target="_blank">Generate Pdf</a>';
     echo '<div class="form-group">'.$inv_av.'</div>';
}
else{
    $inv_av = 'N/A';  
}

?>        
</div>

                             
<div class="form-group" style="margin-top:30px;">

<div class="col-md-12">

<input type="submit" name="submit" value="Update Staff" class="btn btn-primary pull-right">

</div>

</div>
<?php echo form_close( ); ?>
<div class="card-body">

<form  method="post" action="<?php echo base_url();?>admin/staff/sendemail"  enctype="multipart/form-data"> 
<div class="form-group">
<label for="name" class="col-sm-3 control-label">Email to send documents</label>
<div class="col-md-12">
<input type="text" name="emails"  value="<?php echo $orders['email'];?>" class="form-control">
</div>
</div>

<div class="form-group">
<label>Payment Link</label>
<div class="col-md-12">
<input type="text" name="payment_link" class="form-control" placeholder="Payment Link">
</div>
</div>

<div class="form-group">
<label>Upload Document</label>
<div class="col-md-12">
<input type="file" name="userfile[]" class="form-control" multiple>
</div>
</div>







<div class="form-group">
<div class="col-md-12">
<input type="submit" name="submit11" value="Update Staff" class="btn btn-primary pull-right">
</div>
</div>
</form>
</div>

                     
                                
                </div>
            </div>
        </div>
    </main>
</div>









<script>   
jQuery(".addservices").click(function(){
    
     let appendinput = '<div class="col-sm-12 dynamic-field"><div class="row"><div class="col-xl-4 col-md-6"><input type="text" name="eservices[]" class="form-control" value="" id="sub_services" placeholder="Services" required> </div><div class="col-xl-4 col-md-6"> <input type="text" name=" esubservices[]" class="form-control" value="" id="sub_services" placeholder="Sub Services" required></div> <div class="col-xl-4 col-md-6"><input type="text" name="eprices[]" class="form-control" value="" id="sub_prices" placeholder="Sub Price" required> </div></div> <button type="button" class="removesubservices">Remove</button></div>';
     jQuery("#extra_services").append(appendinput);
     removefunction();

    
}); 
jQuery(".removesubservices").click(function(){
jQuery(this).parent(".dynamics_row").remove();
});  
function removefunction(){
  jQuery(".removesubservices").click(function(){
    jQuery(this).parent(".dynamic-field").remove();
    jQuery(this).parent(".dynamics_row").remove();
  });
 
}
</script>