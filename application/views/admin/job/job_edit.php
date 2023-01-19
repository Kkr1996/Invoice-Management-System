<style type="text/css">
.removesubservices{
    border: none;
    background: no-repeat;
    color: red;
    cursor: pointer!important;
    text-align: right;
}
</style>
<style type="text/css">
  .tox-tinymce{
    width:auto!important;
  }
  .tox .tox-statusbar{
    display:none!important;
  }
  .tox .tox-promotion{
    display: none;
  }
  .searchBoxElement{
  background-color: white;
  border: 1px solid #aaa;
  position: absolute;
  max-height: 150px;
  overflow-x: hidden;
  overflow-y: auto;
  margin: 0;
  padding: 0;
  line-height: 23px;
  list-style: none;
  z-index: 1;
  -ms-overflow-style: none;
  scrollbar-width: none;
}

.searchBoxElement span{
  padding: 0 5px;
}


.searchBoxElement li{
  background-color: white;
  color: black;
}

.searchBoxElement li:hover{
  background-color: #50a0ff;
  color: white;
}

.searchBoxElement li.selected{
  background-color: #50a0ff;
  color: white;
}

.refineText{
  padding: 8px 0 8px 0 !important;
}
</style>

<script src='https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.2.0/tinymce.min.js'></script>
<script src="<?php echo base_url();?>assets/dist/js/jquery-searchbox.js"></script>
<div class="content-wrapper">
  <section class="content">
      <?php $this->load->view('admin/includes/_messages.php') ?>
    <div class="card">
      
      <div class="card-header">
           <h1><?=$jobs['name']?></h1>
      </div>
       <!-- form start -->
        <div class="card-body">
            <div class="box-tools">
               <a href="<?= base_url('admin/job'); ?>" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
            </div>
          <?php echo validation_errors(); ?>
          <?php 
            echo form_open(base_url('admin/job/edit/'.$jobs['id']), 'class="form-horizontal"'); 
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
                                 if($kvals['company_id'] == $jobs['company_id']){
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
                                    if($akvals['agents_id'] == $jobs['agents']){
                                        echo "selected";
                                    }
                                    echo '>'.$akvals['name'].'</option>';
                                }
                            }
                            ?>
                      </select>
                 </div>
             </div>
<!--
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
-->


          <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
              <label>Job Name</label>
              <input type="text" name="name" class="form-control" id="name" placeholder="Job Name" value="<?= $jobs['name']; ?>" required>
            </div>
          </div>
          
          <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
              <label>Job Category</label>
              <select class="form-control" name="job_category">
                   <option value="Domestic" <?php if($jobs['job_category'] =="Domestic"){echo "selected";}?>>Domestic</option>
                   <option value="Export" <?php if($jobs['job_category'] =="Export"){echo "selected";}?>>Export</option>
                   <option value="Import" <?php if($jobs['job_category'] =="Import"){echo "selected";}?> >Import</option>
              </select>
            </div>
          </div>
          
          <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
              <label>Job details</label>
              <input type="text" name="details" class="form-control" id="details" placeholder="Job Details" value="<?= $jobs['details']; ?>" required>
            </div>
          </div>
          <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
              <label>Job Price</label>
              <input type="text" name="price" class="form-control" id="price" placeholder="Job Price" value="<?= $jobs['price']; ?>" required>
            </div>
          </div>

          <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
            <label>Job Currency</label>
            <select name="job_currency" class="form-control">
              <option value="MYR" <?= ($jobs['job_currency'] == "MYR")?'selected': '' ?>>MYR</option>
              <option value="USD" <?= ($jobs['job_currency'] == "USD")?'selected': '' ?>>USD</option>
              <option value="Local Currency" <?= ($jobs['job_currency'] == "Local Currency")?'selected': '' ?>>Local Currency</option>
            </select>
            </div>
          </div>

         <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
              <label>Job Status</label>
              <select class="form-control" name="status">
                    <option <?php if($jobs['status']=="active"){echo "selected";}?> value="active">Open</option>
                    <option <?php if($jobs['status']=="processing"){echo "selected";}?> value="processing">Processing</option>
                    <option <?php if($jobs['status']=="completed"){echo "selected";}?> value="completed">Closed</option>
                    <option <?php if($jobs['status']=="cancel"){echo "selected";}?> value="cancel">Cancel</option>

              </select>
            </div>
          </div>
          
           <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
                 <label>Customer Name</label>
                 <select class="form-control js-searchBox" name="customer_id" id="customer_id">
                 <option value="">Select Customer Name</option>
                    <?php
                        if(count($customers) > 0){
                            foreach($customers as $akeys=>$akvals){
                                echo '<option value="'.$akvals->customer_id.'" ';
                                if($akvals->customer_id == $jobs['customer_id']){
                                    echo "selected";
                                }
                                echo '>'.$akvals->username.'</option>';
                            }
                        }
                    ?>
                </select>
            </div>
          </div>
          
          <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
              <label>Shipment</label>
              <input type="text" name="shipment" class="form-control" id="shipment" placeholder="Shipment" value="<?= $jobs['shipment']; ?>" required>
            </div>
          </div>
          
           <div class="col-xl-3 col-md-4 col-sm-6">
             <div class="form-group">
              <label>Commercial Invoices</label>
              <input type="text" name="commercial_invoices" class="form-control" id="commercial_invoices" value="<?= $jobs['commercial_invoices']; ?>" placeholder="Commercial Invoices" required>
            </div>
          </div>
          
          <div class="col-xl-3 col-md-4 col-sm-6">
             <div class="form-group">
              <label>Product Description</label>
              <input type="text" name="product_description" class="form-control" id="product_description" value="<?= $jobs['product_description']; ?>" placeholder="Product Description">
            </div>
          </div>
          
          
         <div class="col-xl-3 col-md-4 col-sm-6">
             <div class="form-group">
              <label>Item Qty</label>
              <input type="text" name="qty" value="<?= $jobs['qty']; ?>" class="form-control" id="qty" placeholder="Item Qty">
            </div>
          </div>

          <div class="col-xl-4 col-md-4 col-sm-6">
             <div class="form-group">
              <label>Item Weight</label>
              <input type="text" name="weight" value="<?= $jobs['weight']; ?>" class="form-control" id="weight" placeholder="Item Weight">
            </div>
          </div>
         <div class="col-xl-4 col-md-4 col-sm-6">
             <div class="form-group">
              <label>Loading Point</label>

              <textarea name="loading_point" rows="4" cols="4" class="form-control" placeholder="Loading Point"><?= $jobs['loading_point']; ?></textarea>
            </div>
          </div>
          
          
         <div class="col-xl-4 col-md-4 col-sm-6">
             <div class="form-group">
              <label>Delivery Point</label>
     
              <textarea name="delivery_point" rows="4" cols="4" class="form-control" placeholder="Delivery Point"><?= $jobs['delivery_point']; ?></textarea>
            </div>
          </div>
          
          
 
          
          
     

             <div class="col-xl-4 col-md-4 col-sm-6">
                 <div class="form-group">
                      <label>Shipper</label>
                      <textarea name="shipper" rows="4" cols="4" class="form-control" placeholder="Shipper"><?php echo $jobs['shipper'];?></textarea>
                 </div>
              </div>

              <div class="col-xl-4 col-md-4 col-sm-6">
                 <div class="form-group">
                      <label>Consignee</label>
                      <textarea name="consignee" rows="4" cols="4" class="form-control" placeholder="Consignee">
                     <?php echo $jobs['consignee'];?>
                     </textarea>
                 </div>
              </div>
              <div class="col-xl-4 col-md-4 col-sm-6">
                 <div class="form-group">
                      <label>Notify Party</label>
                      <textarea name="notify_party" rows="4" cols="4" class="form-control" placeholder="Notify Party"><?=$jobs['notify_party']; ?></textarea>
                 </div>
              </div>
          <div class="col-xl-3 col-md-4 col-sm-6">
             <div class="form-group">
              <label>UOM</label>
                 
              <select class="form-control" name="utm">
                  
                  <option value="DESCRIPTION" <?php if($jobs['utm'] == "DESCRIPTION"){echo "selected";}?> >DESCRIPTION</option>
                  <option value="TON" <?php if($jobs['utm'] == "TON"){echo "selected";}?> >TON</option>
                  <option value="BAG" <?php if($jobs['utm'] == "BAG"){echo "selected";}?>>BAG</option>
                  <option value="BARREL" <?php if($jobs['utm'] == "BARREL"){echo "selected";}?>>BARREL</option>
                  <option value="BLOCK" <?php if($jobs['utm'] == "BLOCK"){echo "selected";}?>>BLOCK</option>
                  <option value="BOARD" <?php if($jobs['utm'] == "BOARD"){echo "selected";}?>>BOARD</option>
                  <option value="BOTTLE" <?php if($jobs['utm'] == "BOTTLE"){echo "selected";}?>>BOTTLE</option>
                  <option value="BOX" <?php if($jobs['utm'] == "BOX"){echo "selected";}?>>BOX</option>
                  <option value="BUNDLE" <?php if($jobs['utm'] == "BUNDLE"){echo "selected";}?>>BUNDLE</option>
                  <option value="CARTON" <?php if($jobs['utm'] == "CARTON"){echo "selected";}?>>CARTON</option>
                  <option value="CUBIC FEET" <?php if($jobs['utm'] == "CUBIC FEET"){echo "selected";}?>>CUBIC FEET</option>
                  <option value="CUBIC METER" <?php if($jobs['utm'] == "CUBIC METER"){echo "selected";}?>>CUBIC METER</option>
                  <option value="DEGREES CELSIUS" <?php if($jobs['utm'] == "DEGREES CELSIUS"){echo "selected";}?>>DEGREES CELSIUS</option>
                  <option value="DRUM" <?php if($jobs['utm'] == "DRUM"){echo "selected";}?>>DRUM</option>
                  <option value="PIECES" <?php if($jobs['utm'] == "PIECES"){echo "selected";}?>>PIECES</option>
                  <option value="FEET" <?php if($jobs['utm'] == "FEET"){echo "selected";}?>>FEET</option>
                  <option value="GALLON" <?php if($jobs['utm'] == "GALLON"){echo "selected";}?>>GALLON</option>
                  <option value="KILOGRAM" <?php if($jobs['utm'] == "KILOGRAM"){echo "selected";}?>>KILOGRAM</option>
                  <option value="METRIC TON" <?php if($jobs['utm'] == "METRIC TON"){echo "selected";}?>>METRIC TON</option>
                  <option value="PACK" <?php if($jobs['utm'] == "PACK"){echo "selected";}?>>PACK</option>
                  <option value="PAIL" <?php if($jobs['utm'] == "PAIL"){echo "selected";}?>>PAIL</option>
                  <option value="PALLET" <?php if($jobs['utm'] == "PALLET"){echo "selected";}?>>PALLET</option>
                  <option value="SHIPMENT" <?php if($jobs['utm'] == "SHIPMENT"){echo "selected";}?>>SHIPMENT</option>
                  
              </select>
                 
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

  </section> 
</div>


<script>

$(document).ready(function(){


  $('#select_company_id').change(function(){
      var company_id=$(this).val();   
      if ($(".dynamic-field")[0]){
         $(".dynamic-field").remove();
      }

       // $.ajax({
       //        url: "<?php echo base_url('admin/Vendorinvoice'); ?>/customerbycompany_id/"+company_id,
       //        cache: false,
       //        type:'GET',
       //        dataType:'html',
       //        success: function(data){  
       //               $('#customer_id').html("");
       //               $('#customer_id').html(data);
       //                console.log(data);
       //            }
       //    });       
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
         $.ajax({
                    url: "<?php echo base_url('admin/users'); ?>/usersbycompany_id/"+company_id,
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
 tinymce.init({
    selector: 'textarea',
    width: 600,
    height: 300
});
$('.js-searchBox').searchBox();
  </script>