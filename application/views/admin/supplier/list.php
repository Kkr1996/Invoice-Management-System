<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.css"> 

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <section class="content">
    <!-- For Messages -->
    <?php $this->load->view('admin/includes/_messages.php') ?>
      
      
    <div class="card-header">
        <h1>Customer</h1>
        <div class="box-tools pull-right">
            <a href="<?= base_url('admin/supplier/add'); ?>" class="btn btn-primary btn-sm">ADD NEW</a>
        </div>
    </div>
      
    <div class="fileimport">
        <div class="form-group">
            <label>Download Template <small>(Note - Download the template for bulk entry on site.)</small></label>
            <p class="#"><a href="<?php echo base_url();?>/assets/template/SupplierListing.csv" download>Click Here</a></p>
        </div>

    </div>
    <hr>
    <div class="fileimport">
        <div class="form-group">
            <label>Import CSV</label>
        </div>
        <form method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>admin/supplier/importcsv">
           
            <input type="file" name="file" required>
            <br>
            <input type="submit" name="file" value="Import">
        </form>
    </div>
      
<!--
       <div class="text-right">
            <a href="#" id="downloadcsv"></a>
            <button onclick="download_csv_all()" class="export-data-btn exporta_selected btn">
            Export All
            </button>
        </div> 
-->
    <div class="card">

      <div class="card-body table-responsive">
        <table id="na_datatable" class="table table-bordered table-striped" width="100%">
          <thead>
            <tr>
              <th>#Account Code</th>
          
              <th>Supplier Name</th>
              <th>Email Address</th>
              <th>Customer Person</th>
              <th>Contact Number</th>
              <th>Status</th>
              <th><?= trans('action') ?></th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach($records as $keys=>$vals){
              $status = ($vals['is_active'] == 1)?'Active': 'In Active';
                echo  '<tr role="row" class="odd">
                        <td>'.$vals['account_code'].'</td>
                        <td>'.$vals['name'].'</td>
                        <td class="sorting_1">'.$vals['email'].'</td>
                        <td class="sorting_1 statusletter">'.$vals['contact_person'].'</td>
                        <td class="sorting_1 statusletter">'.$vals['mobile'].'</td>
                        <td class="sorting_1 statusletter">'.$status.'</td>
                        <td>
                          <a title="Edit" 
                               class="btn-edit" href="'.base_url().'admin/supplier/edit/'.$vals['id'].'"> Edit
                          </a>
                          
                         
                          
                        </td>
                     </tr>';
                }
            ?>
            </tbody>
        </table>
      </div>
    </div>
  </section>  
</div>

<script>
        var table = document.getElementById("na_datatable");
        function checkAll (){
            var table = document.getElementById("na_datatable");
            var val = table.rows[0].cells[0].children[0].checked;
            for (var i = 1; i < table.rows.length; i++){
                table.rows[i].cells[0].children[0].checked = val;
            }
        }  
        function download_csv_all(){  
        var removedata = [6];
        table = document.getElementById("na_datatable");
        var csv = 'ID, CustomerCode, Userame, Useremail, Customer Contact Number, Status\n';

            console.log(table.rows.length);
            
            for (var j = 1; j < table.rows.length; j++){
            var userData = [];
            var dt_data;
            var dd_data;
        
          
                for (var x = 0; x < table.rows[j].cells.length; x++){
                         if(!removedata.includes(x)){

                        csv+= table.rows[j].cells[x].innerText;
                        if(table.rows[j].cells[x].classList.contains('stamp--data')){
                            csv+= '- ';
                            var dt = table.rows[j].querySelectorAll('.stamp--data .claimed--badges dt');
                            var dd = table.rows[j].querySelectorAll('.stamp--data .claimed--badges dd');                        
                            for(var dlc = 0; dlc < dt.length; dlc++){
                                dt_data += dt[dlc].innerHTML +': ' + dd[dlc].innerHTML.replace(/,/g,'') + ' ';
                                if(dlc < dt.length - 1){
                                    dt_data+= '|';
                                }
                            }
                            csv+= dt_data.replace("undefined", "");
                        }                    
                        if(x < table.rows[j].cells.length - 1){
                           csv+= ',';
                        }
                         }
                }
                csv+= '\n';
                               
            }
            
           // alert(csv);
            //console.log(csv);
            var hiddenElement = document.getElementById('downloadcsv');
            hiddenElement.href = 'data:attachment/csv;charset=utf-8,' + encodeURIComponent(csv);
            hiddenElement.target = '_blank';
            hiddenElement.download = 'Info-Customers.csv';
            hiddenElement.click();    
        
               
    }
    
</script>

<!-- DataTables -->
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.js"></script>






