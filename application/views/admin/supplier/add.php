<style>
  .add-more,.remove-btn
    {
        color: #ffffff;
        border-radius: 0px;
        padding: 10px 15px;
        border: none!important;
        font-weight: normal;
        font-size: 16px;
        box-shadow: none;
        transition: 0.5s;
        background-color: #002a3a!important;
    }
</style>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="card card-default">
        <div class="card-header">
          <h1>New Supplier</h1>
        </div>
        <div class="card-body">
          <div class="box-tools">
             <a href="<?= base_url('admin/supplier'); ?>" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
          </div>
           <!-- For Messages -->
            <?php $this->load->view('admin/includes/_messages.php') ?>

            <?php echo form_open(base_url('admin/supplier/add'), 'class="form-horizontal"');  ?> 

            <div class="row">
                


                
               <div class="col-xl-3 col-md-4 col-sm-6">
                 <div class="form-group">
                  <label>Supplier Name</label>
                  <input type="text" name="username" class="form-control" id="username" placeholder="Supplier Name" required>
                 </div>
              </div>
               
  
               <div class="col-xl-3 col-md-4 col-sm-6">
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Email Address">
                </div>
              </div>
               <div class="col-xl-3 col-md-4 col-sm-6">
                <div class="form-group"> 
                  <label>Contact Person Name</label>
                  <input type="text" name="contact_person" class="form-control" id="contact_person" placeholder="Contact Person Name">
                </div>
              </div>
                
              <div class="col-xl-3 col-md-4 col-sm-6">
                <div class="form-group"> 
                   <label>Address</label>
                   <input type="text" name="address" class="form-control" id="address" placeholder="Customer address">
                </div>
              </div>

          <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
            <label>Currency</label>
            <select name="customer_currency" class="form-control">
              <option value="MYR">MYR</option>
              <option value="USD">USD</option>
              <option value="RM">RM</option>
              <option value="THB">THB</option>
              <option value="RM/THB">RM/THB</option>
      
              <option value="Local Currency">Local Currency</option>
            </select>
            </div>
          </div>

          <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
            <label><?= trans('status') ?></label>
            <select name="status" class="form-control">
              <option value=""><?= trans('select_status') ?></option>
              <option value="1">Active</option>
              <option value="0">In Active</option>
            </select>
            </div>
          </div>
                
          <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group"> 
               <label>Account Code</label>
               <input type="text" name="account" class="form-control" id="address" placeholder="Account Number">
            </div>
          </div>


 

        </div>
       <div class="row">
          





          <div class="col-xl-3 col-md-4 col-sm-6">
              
            <div class="form-group"> 
                <label>Payment Term</label>
                <select name="payment_term" class="form-control">
                  <option value="0 Days">0 Days</option>
                  <option value="Cash Only">Cash Only</option>
                  <option value="D30">30 Days</option>
                  <option value="D60">60 Days</option>
                  <option value="D90">90 Days</option>
                </select>
            </div>
            
          </div>
          <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group"> 
               <label>Attn</label>
               <input type="text" name="attn" class="form-control" id="address" placeholder="ATTN">
            </div>
          </div>
         

        <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group"> 
                <label>Mobile</label>
                <input type="text" name="mobile" class="form-control" id="mobile"  placeholder="Mobile">
            </div>
        </div>    
       <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group"> 
                <label>Mobile Number 1</label>
                <input type="text" name="mobile_1" class="form-control" id="mobile_no_1"  placeholder="Mobile Number 1">
            </div>
        </div>    
           <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group"> 
                <label>Mobile Number 2</label>
                <input type="text" name="mobile_no_2" class="form-control" id="mobile_no_2" placeholder="Mobile Number 2">
            </div>
        </div> 
           
           

       </div>
   
            
            
            
            

             <div class="form-group mt-3">
              <div class="col-md-12">
                <input type="submit" name="submit" value="Add" class="btn btn-primary pull-right">
              </div>
            </div>


       
            <?php echo form_close( ); ?>
        </div>
          <!-- /.box-body -->'
         
              
                    <div class="copy hide"> 
                        <div class="form-group"> 
                            <div class="control-group input-group" style="margin-top:25px">  
                                <input type="text" name="customer_rate[]" class="form-control" placeholder="Enter Cutomer Rate Here">  
                                <div class="input-group-btn">   
                                  <button class="btn btn-danger remove remove-btn" type="button"><i class="fa fa-minus" aria-hidden="true"></i> </button>  
                                </div>  
                            </div>  
                        </div>  
                   </div>
         
          <!--//end copy hide-->
      </div>
    </section> 
  </div>

<script type="text/javascript">  
  
    $(document).ready(function() {  
  
      $(".add-more").click(function(){   
          var html = $(".copy").html();  
          $(".after-add-more").after(html);  
      });  
  
      $("body").on("click",".remove",function(){   
          $(this).parents(".control-group").remove();  
      });  
  
    });  
  
    $(document).ready(function(){
        $('#select_company_id').change(function(){
              var company_id=$(this).val();   
               $.ajax({
                    url: "<?php echo base_url('admin/agents'); ?>/agentsbycompany_id/"+company_id,
                    cache: false,
                    type:'GET',
                    dataType:'html',
                    success: function(data){  

                      $('#agentslist').html("");
                      $('#agentslist').html(data);
                      console.log(data);

                    }
                    
                });
        }); 
    });
</script> 