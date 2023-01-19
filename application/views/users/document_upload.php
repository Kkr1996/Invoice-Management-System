<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Document Upload</h1>
            <div class="mb-4">
                
                
                <div class="card-header" style="margin-top:30px;">
                    <i class="fas fa-table me-1"></i>
                    Document Upload
                </div>
                <?php $this->load->view('admin/includes/_messages.php') ?>
                <?php error_reporting (E_ALL ^ E_NOTICE); ?>
                
                <form  method="post" action="<?php echo base_url();?>users/usersdashboard/documentsend"  enctype="multipart/form-data" style="margin-top:15px;">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" placeholder="Title" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Upload Document</label>
                        <input type="file" name="userfile[]" class="form-control"  required>
                    </div>

                     <div class="form-group">
                       <input type="submit" class="btn btn-primary" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </main>
</div>

