<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.css"> 

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <section class="content">
    <!-- For Messages -->
    <?php $this->load->view('admin/includes/_messages.php') ?>
      
      
    <div class="card">
      <div class="card-header">
        <div class="d-inline-block">
          <h3 class="card-title"><i class="fa fa-list"></i>Users Documents</h3>
        </div>
        <div class="d-inline-block float-right">
          <?php if($this->rbac->check_operation_permission('add')): ?>
<!--            <a href="<?= base_url('admin/users/add'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> <?= trans('add_new_user') ?></a>-->
          <?php endif; ?>
        </div>
      </div>
    </div>
      
    <div class="card">
      <div class="card-body table-responsive">
        <table id="na_datatable" class="table table-bordered table-striped" width="100%">
          <thead>
              
              
            <tr>
              <th>ID</th>
              <th>Date Entry</th>
              <th>Title</th>
              <th>Files</th>
              <th width="100" class="text-right"><?= trans('action') ?></th>
            </tr>
              
              
              
          </thead>
            
            
            
            <tbody>
               <?php
                
                  foreach($alldocuments as $keys=>$vals){
                      //  echo '<pre>',var_dump($vals['id']); echo '</pre>';
                        
                        echo '<tr>
                        <td>'.++$keys.'</td>
                        <td>'.$vals['created_at'].'</td>
                        <td>'.$vals['title'].'</td>
                        <td><a href="'.base_url().'/uploads/users/'.$vals['userid'].'/'.$vals['path'].'">View</a></td>
                        <td><a href="'.base_url().'/admin/users/delete_files_users/'.$vals['id'].'">Delete</a></td></tr>';
                  }
               ?>
               
            </tbody>
            
            
        </table>

          
      </div>
    </div>
      
      
  </section>  
</div>





