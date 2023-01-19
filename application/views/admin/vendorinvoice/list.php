 <!-- Datatable style -->
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.css">   
<div class="content-wrapper">  
 <section class="content">
  <!-- For Messages -->
  <?php $this->load->view('admin/includes/_messages.php') ?>
  <div class="card">
    <div class="card-header">
        <h1>Vendor Invoice</h1>
        <div class="box-tools pull-right">
            <a href="<?= base_url('admin/vendorinvoice/add'); ?>" class="btn btn-primary btn-sm">ADD NEW</a>
        </div>
    </div>
     <div class="card-body">
      <table id="na_datatable" class="table table-bordered table-striped joblist">
        <thead>

        <tr>
          <th>ID</th>
          <th>Invoice ID</th>
         
          <th>Action</th>
        </tr>

        </thead>

            <tbody>
            <?php
            foreach($records as $keys=>$vals){
            echo '<tr role="row" class="odd">
               <td>'.++$keys.'</td>
               <td>'.$vals['invoice_id'].'</td>
              
               <td>
               
                <a title="Edit" 
                    class="btn-edit" href="'.base_url().'admin/vendorinvoice/edit/'.$vals['id'].'"> Edit
                </a>
                <a title="view" 
                    class="btn-view" href="'.base_url().'admin/vendorinvoice/view/'.$vals['invoice_id'].'" target="_blank"> View 
                </a>
                 <a title="view" 
                    class="btn-view" href="'.base_url().'admin/vendorinvoice/view/'.$vals['invoice_id'].'" download> Download 
                </a>
               
                <a title="Delete" 
                   class="btn-delete" href="'.base_url().'admin/vendorinvoice/del/'.$vals['id'].'" 
                   onclick="return confirm("Do you want to delete ?")"> Delete
                </a>
                
              </td>
            </tr>';
            }
            ?>
            </tbody>
        
      </table>
    </div>
  </div>
  <!-- /.box -->
  </section>  
</div>





  <!-- Scripts for this page -->
  <script type="text/javascript">
     $(document).ready(function(){
      $(".btn-delete").click(function(){
        if (!confirm("Do you want to delete")){
          return false;
        }
      });
    });
  </script>
  <script>
  $("#location").addClass('active');
  </script>

