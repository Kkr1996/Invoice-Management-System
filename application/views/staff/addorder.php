<div id="layoutSidenav_content">
    <main class="main-parent add-orders">
        <div class="container-fluid px-4">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                   Add New Orders 
                </div>
                   <!-- form start -->
                    <div class="card-body">
                        <?php echo validation_errors(); ?>           
                        <?php echo form_open(base_url('staff/staffcontroller/addneworderssubmit'), 'class="form-horizontal"');  ?>

                          <div class="form-group">

                              <label for="name" class="col-sm-3 control-label">Name</label>
                              <div class="col-sm-12">
                                  <input type="text" name="name" class="form-control" id="name" required>
                                  <input type="hidden" name="staffid" class="form-control" id="staffid" value="<?php echo $staff_id;?>"> 
                              </div>

                          </div>
                          <div class="form-group">
                              <label for="name" class="col-sm-3 control-label">Email </label>
                              <div class="col-sm-12">
                                  <input type="text" name="email" class="form-control" id="email" required>
                              </div>
                          </div>

                            <div class="form-group">
                                <label for="inputAddress">Service</label>
                                <input type="text" class="form-control" id="services" name="services" placeholder="Services">
                            </div>

                            <div class="form-group">
                                <label for="inputAddress">Sub Service</label>
                                <input type="text" class="form-control" id="subservices" name="subservices" placeholder="subservices">
                            </div>

                            <div class="form-group">
                                 <label for="inputAddress">Prices</label><br>
                                 <input type="text" class="form-control" name="prices" placeholder="Prices"  maxlength="10">
                            </div>
                            <div class="form-group">
                                 <label for="inputAddress">Final Price</label><br>
                                 <input type="text" class="form-control" name="finalprice"  placeholder="finalprice">
                            </div>
                        
<div id="extra_services">
</div>   
<div class="addservices">Add Extra Services</div>   
                        
                        
                          <div class="form-group">
                            <label for="name" class="col-sm-3 control-label">Mobile No.</label>
                            <div class="col-sm-12">
                              <input type="text" name="mobile" class="form-control" id="mobile" placeholder="Mobile No." required>
                            </div>
                          </div>

                         <div class="form-group">
                            <label class="col-sm-3 control-label">Customer Id</label>
                            <div class="col-sm-12">
                                <input type="text" name="userid" class="form-control" id="userid" placeholder="Customer Id"  required>
                            </div>
                         </div>
                          <div class="form-group">
                              <label for="name" class="col-sm-3 control-label">Status</label>
                              <div class="col-sm-12">
                              <select name="status" class="form-control">
                                    <option value="New(default)" >New(default)</option>
                                    <option value="Dropped">Dropped</option>
                                    <option value="In discussion">In discussion</option>
                                    <option value="Converted">Converted</option>
                                    <option value="WIP">WIP</option>
                                    <option value="Completed">Completed</option>
                              </select>
                            </div>
                          </div>

                          <div class="form-group">

                              <label for="name" class="col-sm-3 control-label">Remarks</label>
                              <div class="col-sm-12">
                                 <textarea col="10" rows="5" class="form-control" name="remarks"></textarea>
                              </div>

                          </div>

                          <div class="form-group">
                            <div class="col-md-12">
                              <input type="submit" name="submit" value="Update Staff" class="btn btn-primary pull-right">
                            </div>
                          </div>
                        <?php echo form_close( ); ?>

                    </div>
                    <!-- /.card-body -->

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


