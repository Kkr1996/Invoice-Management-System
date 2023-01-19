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
              <th>#Order <?= trans('id') ?></th>
              <th>Date Entry</th>
              <th><?= trans('username') ?></th>
              <th><?= trans('email') ?></th>
              <th>Prices</th>
              <th width="100" class="text-right"><?= trans('action') ?></th>
            </tr>
              
              
              
          </thead>
            
            
            
            <tbody>
                
                <?php 
                foreach($alldocuments as $keys=>$values){
                  //  echo '<pre>',var_dump($values); echo '</pre>';
                    
                    echo '<tr><td>'.$values['order_id'].'</td>
                            <td>'.$values['date_entry'].'</td>
                            <td>'.$values['name'].'</td>
                            <td>'.$values['email'].'</td>
                           <td>'.$values['price'].'</td>
                            <td><a title="View" class="view btn btn-sm btn-info" href="'.base_url('admin/users/view/'.$values['userid']).'"> <i class="fa fa-eye"></i></a>
				<a title="Edit" class="update btn btn-sm btn-warning" href="'.base_url('admin/users/edit/'.$values['id']).'"> <i class="fa fa-pencil-square-o"></i></a>
				<a title="Delete" class="delete btn btn-sm btn-danger" href='.base_url("admin/users/delete/".$values['id']).' title="Delete" onclick="return confirm(\'Do you want to delete ?\')"> <i class="fa fa-trash-o"></i></a></td></tr>
                           ';
                       
                }
                  
                ?>
                
            </tbody>
            
            
        </table>

          
      </div>
    </div>
      
      
  </section>  
</div>


<script type="text/javascript">
  $("body").on("change",".tgl_checkbox",function(){
    console.log('checked');
    $.post('<?=base_url("admin/users/change_status")?>',
    {
      '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
      id : $(this).data('id'),
      status : $(this).is(':checked') == true?1:0
    },
    function(data){
      $.notify("Status Changed Successfully", "success");
    });
  });
</script>


