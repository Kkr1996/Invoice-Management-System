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
               <a href="<?= base_url('admin/users'); ?>" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
            </div>
           <!-- For Messages -->
    <?php $this->load->view('admin/includes/_messages.php') ?>

            
    <form  method="post" action="<?php echo base_url();?>admin/users/edit/<?php echo $user['id'];?>"  enctype="multipart/form-data">

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
                                 if($kvals['company_id'] == $user['company_id']){
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
                      <label>Agents</label>
                      <select name="agents" class="form-control" id="agentslist">
                            <option value=''>Select Agents Name</option>
                            <?php
                            if(count($agentsrecords) > 0){
                                foreach($agentsrecords as $akeys=>$akvals){
                                    echo '<option value="'.$akvals['agents_id'].'" ';
                                    if($akvals['agents_id'] == $user['agents']){
                                        echo "selected";
                                    }
                                    echo '>'.$akvals['name'].'</option>';
                                }
                            }
                            ?>
                      </select>
                 </div>
             </div>
         
            <div class="col-xl-3 col-md-4 col-sm-6">
              <div class="form-group">
                <label class="required">Customer Name </label>
                <input type="text"   name="username" value="<?=$user['username']; ?>" class="form-control" id="username" placeholder="Customer Name">     
                <input type="hidden" name="userid"   value="<?php echo $user['member_id'];?>">
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
                <label>Customer Contact Number</label>
                  <input type="number" name="mobile_no" value="<?= $user['mobile_no']; ?>" class="form-control" id="mobile_no" placeholder="Customer Contact Number">
              </div>
            </div>
            <div class="col-xl-3 col-md-4 col-sm-6">
              <div class="form-group"> 
                 <label>Customer address</label>
                 <input type="text" name="address" class="form-control" id="address" value="<?= $user['address']; ?>" placeholder="Customer address">
              </div>
            </div>

          <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
            <label>Customer Currency</label>
            <select name="customer_currency" class="form-control">
              <option value="MYR" <?= ($user['customer_currency'] == "MYR")?'selected': '' ?> >MYR</option>
              <option value="USD" <?= ($user['customer_currency'] == "USD")?'selected': '' ?>>USD</option>
              <option value="RM" <?= ($user['customer_currency'] == "RM")?'selected': '' ?>>RM</option>
              <option value="THB" <?= ($user['customer_currency'] == "THB")?'selected': '' ?>>THB</option>
              <option value="RM/THB" <?= ($user['customer_currency'] == "RM/THB")?'selected': '' ?>>RM/THB</option>
              <option value="Local Currency" <?= ($user['customer_currency'] == "Local Currency")?'selected': '' ?>>Local Currency</option>
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

            <!-- <div class="col-xl-3 col-md-4 col-sm-6">
              <div class="form-group"> 
                 <label>Account No</label>
                 <input type="text" name="account" class="form-control" id="address" value="<?= $user['account_number']; ?>" placeholder="Account no.">
              </div>
            </div> -->

         <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group"> 
               <label>Account Code</label>
               <input type="text" name="account_code" class="form-control" id="account_code" value="<?= $user['account_code']; ?>" placeholder="Account Code">
            </div>
          </div>
         
      </div>
           <div class="row">
           <div class="col-xl-12">
                <div class="form-group"> 
                    <label>Customer Rate</label>
                </div>
           </div>
                   <div class="col-xl-12">
               <div class="form-group">    
            <?php 
                
                $customer_rate=unserialize($user['customer_rate']);
//                echo count($customer_rate);
                if(count($customer_rate) >0)
                {
                   for($i=0;$i<count($customer_rate);$i++)
                   {
                    if($i==0)
                    {
                        ?>
                         <div class="input-group control-group after-add-more">  
                            <input type="text" name="customer_rate[]" value="<?php echo $customer_rate[$i];?>" class="form-control" placeholder="Enter Cutomer Rate Here">  
                            <div class="input-group-btn">   
                                 <button type="button" class="btn add-more" ><i class="fa fa-plus" aria-hidden="true"></i></button>  
                            </div>  
                        </div>
                        <?php
                        
                    }
                    else
                    {
                       ?>
                            <div class="control-group input-group" style="margin-top:25px">  
                                <input type="text" name="customer_rate[]" value="<?php echo $customer_rate[$i];?>"  class="form-control" placeholder="Enter Cutomer Rate Here">  
                                <div class="input-group-btn">   
                                  <button class="btn btn-danger remove remove-btn" type="button"><i class="fa fa-minus" aria-hidden="true"></i> </button>  
                                </div>  
                            </div>  
                       <?php     
                    }
                 }   
                }
                else
                {
                    ?>
                    <div class="input-group control-group after-add-more">  
                        <input type="text" name="customer_rate[]" class="form-control" placeholder="Enter Cutomer Rate Here">  
                        <div class="input-group-btn">   
                             <button type="button" class="btn add-more" ><i class="fa fa-plus" aria-hidden="true"></i></button>  
                        </div>  
                    </div>
                   
                   <?php
                    
                    
                }
              
               
               ?>   
              </div>
           </div>    
<!--
           <div class="col-xl-12">
               <div class="form-group"> 
-->
<!--
                <div class="input-group control-group after-add-more">  
                    <input type="text" name="customer_rate[]" class="form-control" placeholder="Enter Cutomer Rate Here">  
                    <div class="input-group-btn">   
                        <button type="button" class="btn add-more" ><i class="fa fa-plus" aria-hidden="true"></i></button>  
                    </div>  
                </div>
-->
<!--
               </div>
  
           </div>
-->
          <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group"> 
               <label>Start Date</label>
               <input type="date" name="start_date" value="<?php echo date('Y-m-d' ,strtotime($user['start_date']));  ?>" class="form-control" id="address" placeholder="Start Date">
            </div>
          </div>
          <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group"> 
               <label>End Date</label>
               <input type="date" name="end_date" value="<?php echo date('Y-m-d' ,strtotime($user['end_date']));  ?>"  class="form-control" id="address" placeholder="End Date">
            </div>
          </div>
          
        
          
         <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group"> 
               <label>Payment Term</label>
                <select name="payment_term" class="form-control">
                  <option value="0 Days" <?= ($user['payment_term'] == "0 Days")?'selected': '' ?> >0 Days</option>
                  <option value="Cash Only" <?= ($user['payment_term'] == "Cash Only")?'selected': '' ?>>Cash Only</option>
                  <option value="D30" <?= ($user['payment_term'] == "D30")?'selected': '' ?>>30 Days</option>
                  <option value="D60" <?= ($user['payment_term'] == "D60")?'selected': '' ?>>60 Days</option>
                  <option value="D90" <?= ($user['payment_term'] == "D90")?'selected': '' ?>>90 Days</option>
                </select>
            </div>
          </div>
          
          <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group"> 
               <label>Attn</label>
               <input type="text" name="attn" value="<?php echo $user['attn'];  ?>"  class="form-control" id="address" placeholder="ATTN">
            </div>
          </div>
          <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group"> 
               <label>GST</label>
               <input type="text" name="gst" class="form-control" id="gst" value="<?php echo $user['gst'];  ?>" placeholder="GST">
            </div>
          </div>
          <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group"> 
               <label>SST</label>
               <input type="text" name="sst" class="form-control" id="sst" value="<?php echo $user['sst'];  ?>" placeholder="SST">
            </div>
          </div> 
               
               

           
        <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group"> 
            <label>Group Company Name</label>
            <input type="text" name="group_company_name" class="form-control" id="group_company_name" value="<?php echo $user['group_company_name'];  ?>" placeholder="Group Company Name">
            </div>
        </div>        
           
       <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group"> 
            <label>Billing Address</label>
            <input type="text" name="billingaddress" class="form-control" id="billingaddress" value="<?php echo $user['billingaddress'];  ?>"placeholder="Billing Address">
            </div>
        </div>       
           
      
        <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group"> 
                <label>Mobile Number 1</label>
                <input type="text" name="mobile_1" class="form-control" id="mobile_no_1" value="<?php echo $user['mobile_1'];  ?>" placeholder="Mobile Number 1">
            </div>
        </div>         
                 
       <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group"> 
                <label>Mobile Number 2</label>
                <input type="text" name="mobile_no_2" class="form-control" id="mobile_no_2" value="<?php echo $user['mobile_no_2'];  ?>" placeholder="Mobile Number 2">
            </div>
        </div>         
               
               
               
           
               
               
               
               
               
               
               
               
       </div>


      <div class="form-group">
        <div class="col-md-12">
          <input type="submit" name="submit" value="Update" class="btn btn-primary pull-right">
        </div>
      </div>
            
          </form>
      </div>
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