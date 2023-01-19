<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Query</h1>

            <div class="card mb-4">
                
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Submit your Query
                </div>
                
                <div class="card-body">
                   <?php $this->load->view('admin/includes/_messages.php') ?>
                    <form action="<?php echo base_url();?>users/usersdashboard/submittoken" method="post">
                        
                         <div class="form-group">
                             <label>Subject</label>
                            <input type="text" name="subject" placeholder="Subject" class="form-control">
                         </div>
                        
                         <div class="form-group">
                             <label>Message</label>
                             <textarea type="text" name="message" placeholder="message" cols="12" rows="12" class="form-control"></textarea>
                         </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Submit">
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </main>
</div>