<div class="content-wrapper">
  <section class="content">
    <!-- For Messages -->
    <?php $this->load->view('admin/includes/_messages.php') ?>
    <div class="card">
      <div class="card-header">
           <h1>New Agent</h1>
      </div>
      <div class="card-body">
          <div class="box-tools">
             <a href="<?= base_url('admin/agents'); ?>" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
          </div>

        <?php echo validation_errors(); ?>           
        <?php echo form_open(base_url('admin/agents/add'), 'class="form-horizontal"');  ?>


        <div class="row">
            <div class="col-12">
                <div class="col-xl-3 col-md-4 col-sm-6" style="padding-left:0;">
                    <div class="form-group">
                    <label>Company Name</label>
                        <select name="company_id" class="form-control" required>
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
              <label>Agent Name</label>
              <input type="text" name="name" class="form-control" id="name" placeholder="Name" required>
            </div>
          </div>
         <div class="col-xl-3 col-md-4 col-sm-6">
          <div class="form-group">
              <label for="name">Email Address</label>
              <input type="text" name="email" class="form-control" id="name" placeholder="Email Address" required>
          </div>
         </div>
         <div class="col-xl-3 col-md-4 col-sm-6">
             <div class="form-group">
              <label for="name">Agent Contact Number</label>
                <input type="text" name="phone" class="form-control" id="phone" placeholder="Agent Contact Number">
            </div>
          </div>      

           <div class="col-xl-3 col-md-4 col-sm-6">
             <div class="form-group">
              <label for="name">Agent commission</label>
                <input type="text" name="commission" class="form-control" id="commission" placeholder="Agent commission">
            </div>
          </div>
          <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
              <label> Descriptions</label>
              <input type="text" name="details" class="form-control" id="details" placeholder="Details">
            </div>
          </div>
          <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
              <label>Agents Id</label>
              <input type="text" name="agents_id" class="form-control" id="agents_id" placeholder="Agents Id">
            </div>
          </div>
         <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="form-group">
              <label>Status</label>
              <select class="form-control" name="status">
                   <option value="published" >Active</option>
                    <option value="draft">In Active</option>
              </select>
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