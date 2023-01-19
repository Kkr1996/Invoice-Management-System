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
</style>

<script src='https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.2.0/tinymce.min.js'></script>
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
               <a href="<?= base_url('admin/truckdetails'); ?>" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
            </div>
          <?php echo validation_errors(); ?>
          <?php 
            echo form_open(base_url('admin/truckdetails/edit/'.$data['id']), 'class="form-horizontal"'); 
          ?>
        <div class="row">
            


          <div class="col-xl-4 col-md-4 col-sm-6">
            <div class="form-group">
              <label>Truck Number</label>
              <input type="text" name="trucknumber" class="form-control" id="trucknumber" placeholder="Truck Number" value="<?php echo $data['truck_number'];?>" required>
            </div>
          </div>
          
           
                    
          <div class="col-xl-4 col-md-4 col-sm-6">
            <div class="form-group">
              <label>Chasis Number</label>
              <input type="text" name="chasis_number" class="form-control" id="chasis_number" value="<?php echo $data['chasis_number'];?>"  placeholder="Chasis Number">
            </div>
          </div>  
            
          <div class="col-xl-4 col-md-4 col-sm-6">
            <div class="form-group">
                <label>Vendor</label>
                <input type="text" name="vendor" class="form-control" id="vendor" value="<?php echo $data['vendor'];?>"  placeholder="Vendor" required>
            </div>
          </div>  
            
         <div class="col-xl-9 col-md-4 col-sm-6">
             <div class="form-group">
                  <label>Truck Details</label>
                  <textarea name="truckdetails" rows="4" cols="4" class="form-control" placeholder="Truck Details"><?php echo $data['truck_details'];?></textarea>
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
  </script>