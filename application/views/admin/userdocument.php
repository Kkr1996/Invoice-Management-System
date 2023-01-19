<div class="content-wrapper">
  <section class="content">
    <div class="card">

      <div class="card-header">
        <div class="d-inline-block">
          <h3 class="card-title"><i class="fa fa-pencil"></i>&nbsp; Upload document for users </h3>
        </div>
      </div>

  <?php $this->load->view('admin/includes/_messages.php') ?>
 <div class="card-body">
      <table id="na_datatable" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>No.</th>
          <th>Name</th>
          <th>Action</th>
        </tr>
        </thead>
        <tbody>

          <?php
            foreach($documents as $keys=>$vals){
                echo '<tr role="row" class="odd">
                       <td>'.++$keys.'</td>
                       <td class="sorting_1">'.$vals['name'].'</td>
                       
                       <td>
                       
                          <a href="'.base_url().'uploads/documents/'.$vals['files'].'" download>Download</a>&nbsp;&nbsp;</p>
                          <a href="'.base_url().'uploads/documents/'.$vals['files'].'">View</a>
                          
                          <a title="Delete" 
                           class="delete btn btn-sm" href="'.base_url().'admin/dashboard/del/'.$vals['id'].'" 
                           onclick="return confirm("Do you want to delete ?")" style="color:red;"> Delete</i>
                          </a>
                          
                      </td>
                      
                </tr>';
              }
          ?>
        </tbody>
      </table>
    </div>
        <div class="card-body">
            
            
           
             <form  method="post" action="<?php echo base_url();?>admin/dashboard/uploaddocument"  enctype="multipart/form-data"> 
             
              <div class="form-group">
                    <label>Document Name</label>
                    <div class="col-md-12">
                          <input type="text" name="title" class="form-control">
                    </div>
                </div>
                 
                 
                <div class="form-group">
                    <label>Upload Document</label>
                    <div class="col-md-12">
                          <input type="file" name="userfile[]" class="form-control">
                    </div>
                </div>
                 

                 
                <div class="form-group">
                    <div class="col-md-12">
                      <input type="submit" name="submit11" value="Upload" class="btn btn-primary pull-right">
                    </div>
                </div>
                 
                 
            </form>
        </div>

    </div>

  </section> 

</div>


