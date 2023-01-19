 <!-- Datatable style -->
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.css">   
<div class="content-wrapper">  
 <section class="content">
  <!-- For Messages -->
  <?php $this->load->view('admin/includes/_messages.php') ?>
  <div class="card">
    <div class="card-header">
        <h1>Agent</h1>
        <div class="box-tools pull-right">
            <a href="<?= base_url('admin/agents/add'); ?>" class="btn btn-primary btn-sm">ADD NEW</a>
        </div>
    </div>
     <div class="card-body">
         <div class="fileimport">
            <div class="form-group">
                <label>Download Template <small>(Note - Download the template for bulk entry on site.)</small></label>
                <p class="#"><a href="<?php echo base_url();?>/assets/template/AgentTemplate.csv" download>Click Here</a></p>
            </div>

        </div>
        <hr>
        <div class="fileimport">
            <div class="form-group">
                <label>Import CSV</label>
            </div>
            <form method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>admin/agents/agentsimportcsv">
                <input type="file" name="file" required>
                <br>
                <input type="submit" name="file" value="Import">
            </form>
        </div>
      
       <div class="text-right">
            <a href="#" id="downloadcsv"></a>
            <button onclick="download_csv_all()" class="export-data-btn exporta_selected btn">
            Export All
            </button>
        </div> 
         
      <table id="na_datatable" class="table table-bordered table-striped">
        <thead>

        <tr>
          <th>ID</th>
          <th>Agent ID</th>
          <th>Agent Name</th>
          <th>Company Name</th>
          <th>Agent Email</th>
          <th>Agent Contact Number</th>
          <th>Agent commission</th>
          <th>Agent Status</th>
          <th>Action</th>
        </tr>

        </thead>

            <tbody>
            <?php
            foreach($records as $keys=>$vals){


              //  $c_id = "select company_name from ci_company where company_id = '".$vals['company_id']."' ";

              $sql ="SELECT * FROM ci_company where company_id = '".$vals['company_id']."'   ";
              $query = $this->db->query($sql);
              if ($query->num_rows() > 0) {
                foreach ($query->result() as $row) {
                  $c_id = $row->company_name;
                }
              }
                
                echo '<tr role="row" class="odd">
                   <td>'.++$keys.'</td>
                   <td>'.$vals['agents_id'].'</td>
                   <td class="sorting_1">'.$vals['name'].'</td>
                   <td class="sorting_1">'.$c_id.'</td>
                   <td class="sorting_1">'.$vals['email'].'</td>
                   <td class="sorting_1">'.$vals['phone'].'</td>
                   <td class="sorting_1">'.$vals['commission'].'</td>
                   <td class="sorting_1 statusletter">'.$vals['status'].'</td>
                   <td>
                    <a title="Edit" 
                        class="btn-edit" href="'.base_url().'admin/agents/edit/'.$vals['id'].'"> Edit
                    </a>
                 
                  </td>
                </tr>';
            }
            ?>
            </tbody>
        
      </table>
      <!-- <a title="Delete" 
                       class="btn-delete" href="'.base_url().'admin/agents/del/'.$vals['id'].'" 
                       onclick="return confirm("Do you want to delete ?")"> Delete
                    </a> -->
    </div>
  </div>
  <!-- /.box -->
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
        var removedata = [7];
        table = document.getElementById("na_datatable");
        var csv = 'ID, Agent ID, Agent Name, Agent Email, Agent Contact Number, Agent commission, Agent Status\n';
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
        hiddenElement.download = 'Info-Agents.csv';
        hiddenElement.click();    
        
               
    }
    
</script>




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

