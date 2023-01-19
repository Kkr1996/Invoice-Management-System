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
    .comapny_code{
        display: none;
        color: red;
        font-size: 14px;
    }
</style>

<script src='https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.2.0/tinymce.min.js'></script>

<div class="content-wrapper">

  <section class="content">

    <!-- For Messages -->

    <?php $this->load->view('admin/includes/_messages.php') ?>

    <div class="card">

      <div class="card-header">

           <h1>New Company</h1>

      </div>

      <div class="card-body">

          <div class="box-tools">

             <a href="<?= base_url('admin/company'); ?>" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Back</a>

          </div>

        <?php echo validation_errors(); ?>           

      

        <form method="post" accept-charset="utf-8" action="<?php echo base_url();?>admin/company/add" enctype="multipart/form-data" class="form-horizontal">

        <div class="row">

          <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
              <label>Company Name</label>
              <input type="text" name="company_name" class="form-control" id="company_name" placeholder="Company Name">
            </div>
          </div>

          

          <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
              <label>SST Registeration No.</label>
              <input type="text" name="registeration_no" class="form-control" id="registeration_no" placeholder="SST Registeration No">
            </div>
          </div>



          <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
              <label>Email</label>
              <input type="text" name="email" class="form-control" id="email" placeholder="Email">
            </div>
          </div>

          <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
              <label>Phone</label>
              <input type="text" name="phone" class="form-control" id="phone" placeholder="Phone">
            </div>
          </div>
          <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
              <label>Fax</label>
              <input type="text" name="fax" class="form-control" id="fax" placeholder="Fax">
            </div>
          </div>
          <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
              <label>Service Tax No</label>
              <input type="text" name="service_tax_no" class="form-control" id="service_tax_no" placeholder="Service Tax No">
            </div>
          </div>
        <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
              <label>Bank Name</label>
              <input type="text" name="bank_name" class="form-control" id="bank_name" placeholder="Bank Name" required>
            </div>
          </div>     
         <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
              <label>Bank Address</label>
              <input type="text" name="bank_address" class="form-control" id="bank_address" placeholder="Bank Address" required>
            </div>
          </div>    
          <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
              <label>Acc/No.</label>
              <input type="text" name="a_c_no" class="form-control" id="a_c_no" placeholder="Acc/No." required>
            </div>
          </div>
            <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
              <label>Swift Code</label>
              <input type="text" name="swift_code" class="form-control" id="swift_code" placeholder="Swift Code" required>
            </div>
          </div>
            <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
              <label>Account Code</label>
              <input type="text" name="company_code" class="form-control" id="company_code" placeholder="Company Code" required>
              <p class="comapny_code">Company code is already existed.</p>
            </div>
          </div>

            <div class="form-group">
                <label class="control-label">Logo</label><br/>
                <input type="file" name="userfile[]" accept=".png, .jpg, .jpeg, .gif, .svg">
                <p><small class="text-success"><?= trans('allowed_types') ?>: gif, jpg, png, jpeg</small></p>
            </div>


          <div class="col-xl-12 col-md-4 col-sm-6">
            <div class="form-group">
              <label>Company Address</label>
              <textarea name="descriptions" class="form-control" id="descriptions" placeholder="Company Address" style="height:20rem;width:100%;"></textarea>
            </div>
          </div>

            <div class="col-xl-12 col-md-4 col-sm-6">
            <div class="form-group">
              <label>Disclaimer</label>
              <textarea name="disclaimer" class="form-control" id="disclaimer" placeholder="Company Disclaimer " style="height:20rem;width:100%;"></textarea>
            </div>
          </div>





        </div>



          <div class="form-group">

            <div class="col-md-12">
              
             <input type="hidden" value="1" class="ccode">
                
              <input type="submit" name="submit" value="Add" class="btn btn-primary pull-right submit">

            </div>

          </div>
</form>

      </div>





    </div>

  </section> 

</div>

<script>
    jQuery(".submit").click(function(e){
     
        let ccode = jQuery(".ccode").val();
        let flag = true;
        
        if(ccode == 0){
            alert("Company Code is already existed.")
            flag = false;
        }
        
        if(flag == true){
            return true; 
        }
        else{
            return false;
        }
        
        
    });
    
    jQuery(document).ready(function(){
      jQuery("#company_code").keyup(function(){
          let company_code = jQuery(this).val();

        
                $.ajax({
                  url: "<?php echo base_url('admin/company'); ?>/checkcompany_code/"+company_code,
                  cache: false,
                  type:'GET',
                  dataType:'html',
                  success: function(data){  
         
                      if(data == 1){
                          
                          jQuery(".comapny_code").show();
                          jQuery(".ccode").val(0);
                      }
                      else{
                          jQuery(".comapny_code").hide();
                          jQuery(".ccode").val(1);
                      }
                        //jQuery(".customer_all_rates").html(rates);
                  }
                });
      });
    });

</script>

<script>
tinymce.init({
    selector: 'textarea',
    width: 600,
    height: 300
});

  $("#location").addClass('active');

</script>