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
    <!-- For Messages -->
    <?php $this->load->view('admin/includes/_messages.php') ?>
    <div class="card">
      <div class="card-header">
           <h1>New Job</h1>
      </div>
      <div class="card-body">
          <div class="box-tools">
             <a href="<?= base_url('admin/job'); ?>" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
          </div>
        <?php echo validation_errors(); ?>           
        <?php echo form_open(base_url('admin/job/add'), 'class="form-horizontal"');  ?>


        <div class="row">
            
           <div class="col-12">
                <div class="col-xl-3 col-md-4 col-sm-6" style="padding-left:0;">
                    <div class="form-group">
                        <label>Company Name</label>
                        <select name="company_id" class="form-control"  id="select_company_id" required>
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
                      <label>Agents</label>
                      <select name="agents" class="form-control" id="agentslist" required>
                      <option value=''>Select Agents Name</option>
                      </select>
                 </div>
              </div>

<!--
          <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
              <label>Customer</label>
              <select name="customer_id" id="customer_id" class="form-control" required>
                 <option value="">Select Customer Name</option>
          
                </select>
            </div>
          </div>  
-->

          <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
              <label>Job Name</label>
              <input type="text" name="name" class="form-control" id="name" placeholder="Job Name" required>
            </div>
          </div>
          
           
          <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
              <label>Job Category</label>
              <select class="form-control" name="job_category">
                   <option value="Domestic">Domestic</option>
                   <option value="Export">Export</option>
                   <option value="Import">Import</option>
              </select>
            </div>
          </div>
          
          <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
              <label>Job details</label>
              <input type="text" name="details" class="form-control" id="details" placeholder="Job Details" required>
            </div>
          </div>

          <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
              <label>Job Price</label>
              <input type="text" name="price" class="form-control" id="price" placeholder="Job Price" required>
            </div>
          </div>
          <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
            <label>Job Currency</label>
            <select name="job_currency" class="form-control">
              <option value="MYR">MYR</option>
              <option value="USD">USD</option>
              <option value="Local Currency">Local Currency</option>
            </select>
            </div>
          </div>
         <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
              <label>Job Status</label>
              <select class="form-control" name="status">
                    <option value="active">Open</option>
                    <option value="processing">Processing</option>
                    <option value="completed">Closed</option>
                      <option value="cancel">Cancel</option>
              </select>
            </div>
          </div>
           <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">

              <label>Customer Name</label>
              <select id="customer_id" name="customer_id" class="form-control js-searchBox">
                
              </select>

            </div>
          </div>
          
          <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
              <label>Shipment</label>
              <input type="text" name="shipment" class="form-control" id="shipment" placeholder="Shipment" required>
            </div>
          </div>
          
           <div class="col-xl-3 col-md-4 col-sm-6">
             <div class="form-group">
              <label>Commercial Invoices</label>
              <input type="text" name="commercial_invoices" class="form-control" id="commercial_invoices" placeholder="Commercial Invoices" required>
            </div>
          </div>
          
          
       
        
          <div class="col-xl-3 col-md-4 col-sm-6">
             <div class="form-group">
              <label>Product Description</label>
              <input type="text" name="product_description" class="form-control" id="product_description"  placeholder="Product Description">
            </div>
          </div>
          
          
         <div class="col-xl-3 col-md-4 col-sm-6">
             <div class="form-group">
              <label>Item Qty</label>
              <input type="text" name="qty" class="form-control" id="qty" placeholder="Item Qty">
            </div>
          </div>
          
          
         <div class="col-xl-3 col-md-4 col-sm-6">
             <div class="form-group">
              <label>Item Weight</label>
              <input type="text" name="weight" class="form-control" id="weight" placeholder="Item Weight">
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
               
            
            
            
            
            
                
            
              <div class="col-xl-6 col-md-6 col-sm-6">
                 <div class="form-group">
                      <label>Shipper</label>
                      <textarea name="shipper" rows="4" cols="4" class="form-control" placeholder="Shipper"></textarea>
                 </div>
              </div>

              <div class="col-xl-4 col-md-4 col-sm-6">
                 <div class="form-group">
                      <label>Consignee</label>
                      <textarea name="consignee" rows="4" cols="4" class="form-control" placeholder="Consignee"></textarea>
                 </div>
              </div>
              <div class="col-xl-4 col-md-4 col-sm-6">
                 <div class="form-group">
                      <label>Notify Party</label>
                      <textarea name="notify_party" rows="4" cols="4" class="form-control" placeholder="Notify Party"></textarea>
                 </div>
              </div>

              <div class="col-xl-4 col-md-4 col-sm-6">
                 <div class="form-group">
                      <label>Loading Point </label>
                      <textarea name="loading_point" rows="4" cols="4" class="form-control" placeholder="Loading Point"></textarea>
                 </div>
              </div>

            <div class="col-xl-4 col-md-4 col-sm-6">
              <div class="form-group">
                <label>Delivery Point</label>
               <textarea name="delivery_point" rows="4" cols="4" class="form-control" placeholder="Delivery Point"></textarea>
              </div>
            </div>        
            
            
            
            
            
            
          
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
  $("#location").addClass('active');
</script>
<script>
  $(document).ready(function(){
        $('#select_company_id').change(function(){
            var company_id=$(this).val();   
            if ($(".dynamic-field")[0]){
               $(".dynamic-field").remove();
            }
            // $.ajax({
            //       url: "<?php echo base_url('admin/Vendorinvoice'); ?>/customerbycompany_id/"+company_id,
            //       cache: false,
            //       type:'GET',
            //       dataType:'html',
            //       success: function(data){  
            //               $('#customer_id').html("");
            //               $('#customer_id').html(data);
            //               console.log(data);
            //           }
            //   });
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
                      $('.js-searchBox').searchBox();
                    }   
              });
        }); 
      
    });
 tinymce.init({
    selector: 'textarea',
    width: 600,
    height: 300
});

</script>