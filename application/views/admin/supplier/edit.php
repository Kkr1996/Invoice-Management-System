<?php
error_reporting(0);
?>
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
           <h1><?=$user['username']?></h1>
      </div>
        <div class="card-body">
              <div class="box-tools">
               <a href="<?= base_url('admin/supplier'); ?>" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
            </div>
           <!-- For Messages -->
    <?php $this->load->view('admin/includes/_messages.php') ?>

            
    <form  method="post" action="<?php echo base_url();?>admin/supplier/edit/<?php echo $user['id'];?>"  enctype="multipart/form-data">

     <div class="row">
         



  
         
            <div class="col-xl-3 col-md-4 col-sm-6">
              <div class="form-group">
                <label>Supplier Name</label>
                <input type="text"   name="username" value="<?=$user['name']; ?>" class="form-control" id="username" placeholder="Name">
                <input type="hidden" name="supplier_id"   value="<?php echo $user['supplier_id'];?>">
              </div>
            </div>
   

            <div class="col-xl-3 col-md-4 col-sm-6">
              <div class="form-group">
                 <label><?= trans('email') ?></label>
                <input type="email" name="email" value="<?= $user['email']; ?>" class="form-control" id="email" placeholder="Email Address">
              </div>
            </div>  


         
            <div class="col-xl-3 col-md-4 col-sm-6">      
              <div class="form-group">
                <label>Contact Person Name</label>
                  <input type="text" name="contact_person" value="<?= $user['contact_person']; ?>" class="form-control" id="mobile_no" placeholder="Contact Person Name">
              </div>
            </div>
         
            <div class="col-xl-3 col-md-4 col-sm-6">
              <div class="form-group"> 
                 <label>Address</label>
                 <input type="text" name="address" class="form-control" id="address" value="<?= $user['address']; ?>" placeholder="Address">
              </div>
            </div>

          <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
            <label> Currency</label>
            <select name="customer_currency" class="form-control">
              <option value="MYR" <?= ($user['currency'] == "MYR")?'selected': '' ?> >MYR</option>
              <option value="USD" <?= ($user['currency'] == "USD")?'selected': '' ?>>USD</option>
              <option value="RM" <?= ($user['currency'] == "RM")?'selected': '' ?>>RM</option>
              <option value="THB" <?= ($user['currency'] == "THB")?'selected': '' ?>>THB</option>
              <option value="RM/THB" <?= ($user['currency'] == "RM/THB")?'selected': '' ?>>RM/THB</option>
              <option value="Local Currency" <?= ($user['currency'] == "Local Currency")?'selected': '' ?>>Local Currency</option>
            </select>
            </div>
          </div>

          <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
            <label><?= trans('status') ?></label>
            <select name="status" class="form-control">
              <option value=""><?= trans('select_status') ?></option>
              <option value="1" <?= ($user['is_active'] == 1)?'selected': '' ?> >Active</option>
              <option value="0" <?= ($user['is_active'] == 0)?'selected': '' ?>>In Active</option>
            </select>
            </div>
          </div>
            <div class="col-xl-3 col-md-4 col-sm-6">
              <div class="form-group"> 
                 <label>Account Code</label>
                 <input type="text" name="account" class="form-control" id="address" value="<?= $user['account_code']; ?>" placeholder="Account no.">
              </div>
            </div>
       <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group"> 
               <label>Payment Term</label>
                <select name="payment_term" class="form-control">
                  <option value="0 Days" <?= ($user['term'] == "0 Days")?'selected': '' ?> >0 Days</option>
                  <option value="Cash Only" <?= ($user['term'] == "Cash Only")?'selected': '' ?>>Cash Only</option>
                  <option value="D30" <?= ($user['term'] == "D30")?'selected': '' ?>>30 Days</option>
                  <option value="D60" <?= ($user['term'] == "D60")?'selected': '' ?>>60 Days</option>
                  <option value="D90" <?= ($user['term'] == "D90")?'selected': '' ?>>90 Days</option>
                </select>
            </div>
          </div>

               
               
        <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group"> 
                <label>Mobile</label>
                <input type="text" name="mobile" class="form-control" id="mobile"  value="<?php echo $user['mobile'];  ?>" placeholder="Mobile">
            </div>
        </div>   
      
        <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group"> 
                <label>Mobile Number 1</label>
                <input type="text" name="mobile_1" class="form-control" id="mobile_no_1" value="<?php echo $user['phone_1'];  ?>" placeholder="Mobile Number 1">
            </div>
        </div>         
                 
       <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group"> 
                <label>Mobile Number 2</label>
                <input type="text" name="mobile_no_2" class="form-control" id="mobile_no_2" value="<?php echo $user['phone_2'];  ?>" placeholder="Mobile Number 2">
            </div>
        </div>    

         
      </div>
        
     


              <div class="form-group">
                <div class="col-md-12">
                  <input type="submit" name="submit" value="Update" class="btn btn-primary pull-right">
                </div>
              </div>
            
         
    
     </form>
 
          <!-- /.box-body -->
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