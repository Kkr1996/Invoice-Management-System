<div id="layoutSidenav_content">
<div class="container-fluid px-4">

    <main>
        <h1>Profile</h1>
    </main>

    <?php $this->load->view('admin/includes/_messages.php') ?>
    <form action="<?php echo base_url();?>staff/Staffcontroller/update_profile" method="post">

        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

        <?php
            foreach($results as $keys=>$vals){

                echo '<div class="form-group">
                  <label>Name</label>
                  <input type="text" name="name" placeholder="Name" class="form-control" value="'.$vals['name'].'">
                </div>

                 <div class="form-group">
                  <label>Email</label>
                  <input type="text" name="email" placeholder="Email" class="form-control" value="'.$vals['Email'].'">
                </div>

              
            <input type="hidden" name="existpassword" class="form-control" value="'.$vals['password'].'">



          <div class="form-group has-feedback">
             <div class="col-sm-12">
               <label for="name" class="col-sm-3 control-label">Password</label>
             <input type="password" name="password" id="password" class="form-control" placeholder="'.trans('password').'" >
             </div>
          </div>
          <div class="form-group has-feedback">
             <div class="col-sm-12">
                <label for="name" class="col-sm-3 control-label">Confirm Password</label>
                <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="'.trans('confirm').'" >
            </div>
          </div>

               <div class="form-group">
                    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                        <input type="submit" name="submit" value="Submit" class="btn btn-primary">
                    </div>
                </div>';


            }
        ?>

    

    </form>
</div>
</div>