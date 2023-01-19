<style type="text/css">
.removesubservices{
border: none;
background: no-repeat;
color: red;
cursor: pointer!important;
text-align: right;
}
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
           <h1><?=$manifest['manifest_no']?></h1>
      </div>
       <!-- form start -->
        <div class="card-body">
            <div class="box-tools">
                <a href="<?= base_url('admin/manifest/view'); ?>/<?php echo $manifest['id'];?>" class="btn btn-primary btn-sm">View</a>
                <a href="<?= base_url('admin/manifest'); ?>" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
            </div>
          <?php echo validation_errors(); ?>
          <?php 
            echo form_open(base_url('admin/manifest/edit/'.$manifest['id']), 'class="form-horizontal"'); 
          ?>
        <div class="row">
                <div class="col-12">
                <div class="col-xl-3 col-md-4 col-sm-6" style="padding-left:0;">
                    <div class="form-group">
                        <label>Select Job No</label>
                        <select name="job_no" class="form-control"  id="job_no" required>
                        <option value="">Select Job Id</option>
                        <?php
                         if(count($records) > 0){
                             foreach($records as $keys=>$kvals){
                                 echo '<option value="'.$kvals['jobid'].'" ';
                                 if($kvals['jobid'] == $manifest['job_id']){
                                     echo "selected";
                                 }
                                 echo '>'.$kvals['jobid'].'</option>';
                             }
                         }
                        ?>
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-4 col-md-4 col-sm-6">


                <?php
                   //echo '<pre>',var_dump($joblist); echo '</pre>';
                ?>

                 <div class="form-group">
                      <label>Shipper</label>
                      <textarea name="shipper" rows="4" cols="4" class="form-control" id="shipper"><?=$joblist['shipper'];?></textarea>
                 </div>
              </div>

              <div class="col-xl-4 col-md-4 col-sm-6">
                 <div class="form-group">
                      <label>Consignee</label>
                      <textarea name="consignee" rows="4" cols="4" class="form-control" id="consignee"><?=$joblist['consignee'];?></textarea>
                 </div>
              </div>
              <div class="col-xl-4 col-md-4 col-sm-6">
                 <div class="form-group">
                      <label>Notify Party</label>
                      <textarea name="notify_party" rows="4" cols="4" class="form-control" id="notify_party" placeholder="Notify Party"><?=$joblist['notify_party'];?></textarea>
                 </div>
              </div>

              <div class="col-xl-4 col-md-4 col-sm-6">
                 <div class="form-group">
                      <label>Loading Point </label>
                       <textarea name="loading_point" rows="4" cols="4" class="form-control" id="loading_point"><?=$joblist['loading_point'];?></textarea>
                 </div>
              </div>

            <div class="col-xl-4 col-md-4 col-sm-6">
              <div class="form-group">
                <label>Delivery Point</label>
               <textarea name="delivery_point" rows="4" cols="4" class="form-control" id="delivery_point"><?=$joblist['delivery_point'];?></textarea>
              </div>
            </div>
          
  
            <div class="col-xl-4 col-md-4 col-sm-6">
              <div class="form-group">
                <label>Describe Facility, Equipment & Process at Loading/ Unloading site</label>
                <textarea name="describe_f_e" rows="4" cols="4" class="form-control" id="describe_f_e"><?=$manifest['describe_f_e'];?></textarea>
              </div>
            </div>


            <div class="col-xl-3 col-md-4 col-sm-6">
              <div class="form-group">
                <label>Truck Manifest No.</label>
                <select class="form-control js-searchBox" name="manifest_no">
                      <?php 
                        foreach($trucklist as $tkeys=>$tvals){
                          if($tvals['truck_number'] == $manifest['manifest_no'] ){
                              $sel  ="selected";
                          }
                          else{
                              $sel   ="";
                          }
                          echo '<option value="'.$tvals['truck_number'].'" '.$sel.'>'.$tvals['truck_number'].'</option>';
                        }
                      ?>
                </select>
              </div>
            </div>
            <div class="col-xl-3 col-md-4 col-sm-6">
              <div class="form-group">
                <label>Loading Origin</label>
                <input type="text" name="loading_origin" class="form-control" value="<?=$manifest['loading_origin'];?>" id="loading_origin" placeholder="Loading Origin"required>
              </div>
            </div>
          

            <div class="col-xl-3 col-md-4 col-sm-6">
              <div class="form-group">
                <label>Delivery Destination</label>
                <input type="text" name="delivery_destination" class="form-control" value="<?=$manifest['delivery_destination'];?>" id="delivery_destination" placeholder="Delivery Destination" required>
              </div>
            </div>
         <div class="col-xl-3 col-md-4 col-sm-6">
             <div class="form-group">
              <label>Loading Date</label>
              <input type="date" name="loading_date" value="<?=$manifest['loading_date'];?>" class="form-control" id="loading_date" placeholder="Loading Date">
            </div>
          </div>
          
          
         <div class="col-xl-3 col-md-4 col-sm-6">
             <div class="form-group">
              <label>Delivery Date</label>
            <input type="date" name="delivery_date" value="<?=$manifest['delivery_date'];?>" class="form-control" id="delivery_date" placeholder="Delivery Date">
            </div>
          </div>
        
          <div class="col-xl-3 col-md-4 col-sm-6">
             <div class="form-group">
              <label>PO/DO Ref no Other Customer Ref</label>
            <input type="text" name="po_do_ref" class="form-control" value="<?=$manifest['po_do_ref'];?>" id="po_do_ref" placeholder="PO/DO Ref no..." required>
            </div>
          </div>

          <div class="col-xl-3 col-md-4 col-sm-6">
             <div class="form-group">
              <label>Truck Type</label>
               <input type="text" name="truck_type" class="form-control" value="<?=$manifest['truck_type'];?>" id="truck_type" placeholder="Truck Type" required>
            </div>
          </div>

          <div class="col-xl-3 col-md-4 col-sm-6">
             <div class="form-group">
              <label>Container No / Seal No</label>
            <input type="text" name="container_no" class="form-control" id="container_no" value="<?=$manifest['container_no'];?>" placeholder="Container No / Seal No" required>
            </div>
          </div>


          <div class="col-xl-3 col-md-4 col-sm-6">
             <div class="form-group">
                 <label>Truck Location </label>
                 <textarea name="truck_location" rows="2" cols="4" class="form-control" placeholder="Truck Location" id="truck_location"><?=$manifest['truck_location'];?></textarea>
            </div>
          </div>
          <div class="col-xl-3 col-md-4 col-sm-6">
             <div class="form-group">
                 <label>Special Remarks</label>
                 <textarea rows="2" cols="4" name="special_marks" class="form-control" id="special_marks" placeholder="Special Remarks"><?=$manifest['special_marks'];?></textarea>
            </div>
          </div>

          <div class="col-xl-3 col-md-4 col-sm-6">
             <div class="form-group">
                 <label>Description of Goods</label>
                <input type="text" name="descriptions_goods" class="form-control" value="<?=$manifest['descriptions_goods'];?>" id="descriptions_goods" placeholder="Description of Goods" required>
            </div>
          </div>
          
          <div class="col-xl-3 col-md-4 col-sm-6">
             <div class="form-group">
                 <label>Quantity</label>
                <input type="text" name="quantity" class="form-control" value="<?=$manifest['quantity'];?>" id="quantity" placeholder="Job Name" required>
            </div>
          </div>
          
          <div class="col-xl-3 col-md-4 col-sm-6">
             <div class="form-group">

               <label>Gross Weight</label>
       

                <textarea name="gross_weigth" rows="2" cols="4" class="form-control" id="gross_weigth" placeholder="Gross Weight">
                    <?=$manifest['gross_weigth'];?>
                </textarea>


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

    $('#job_no').change(function(){
    var job_id=$(this).val();   

    $.ajax({
          url: "<?php echo base_url('admin/job'); ?>/jobgetbyid/"+job_id,
          cache: false,
          type:'GET',
          dataType:'html',
          success: function(data){  
                 

            var obj            = jQuery.parseJSON ( data );
            let shipper        = obj.shipper;
            let consignee      = obj.consignee;
            let notify_party   = obj.notify_party;
            let loading_point  = obj.loading_point;
            let delivery_point = obj.delivery_point;
            tinymce.get('shipper').getBody().innerHTML = shipper;
            tinymce.get('consignee').getBody().innerHTML = consignee;
            tinymce.get('notify_party').getBody().innerHTML = notify_party;
            tinymce.get('loading_point').getBody().innerHTML = '<p>' + loading_point + '</p>';;
            tinymce.get('delivery_point').getBody().innerHTML = '<p>' + delivery_point +'</p>';;

          }
      });


}); 
});
tinymce.init({
selector: '#shipper',
width: 600,
readonly : true,
height: 300
});
tinymce.init({
selector: '#consignee',
width: 600,
readonly : true,
height: 300
});

tinymce.init({
selector: '#notify_party',
width: 600,
readonly : true,
height: 300
});
tinymce.init({
selector: '#loading_point',
readonly : true,
width: 600,
height: 300
});
tinymce.init({
selector: '#delivery_point',
readonly : true,
width: 600,
height: 300
});
tinymce.init({
selector: '#describe_f_e',
width: 600,
height: 300
});


tinymce.init({
selector: '#truck_location',
width: 600,
height: 300
});
tinymce.init({
selector: '#gross_weigth',
width: 600,
height: 300
});
tinymce.init({
selector: '#special_marks',
width: 600,
height: 300
});



$('.js-searchBox').searchBox();
  </script>