
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>

<style>
#myInput{
    float: right;
    margin-bottom: 30px;
}
.action-flex{
    display: flex;
    flex-basis: 10%;
}
</style>

<div class="content-wrapper">  
 <section class="content">
  <!-- For Messages -->
  <?php $this->load->view('admin/includes/_messages.php') ?>
  <div class="card">
       
      
    <div class="card-header">
        <h1>Vendor New</h1>
        <div class="box-tools pull-right">
            <a href="<?= base_url('admin/vendor/add'); ?>" class="btn btn-primary btn-sm">ADD NEW</a>
        </div>
    </div>
     <div class="card-body">
         
         <div class="fileimport">
            <div class="form-group">
                <label>Download Template <small>(Note - Download the template for bulk entry on site.)</small></label>
                <p class="#"><a href="<?php echo base_url();?>/assets/template/VendorTemplate.csv" download>Click Here</a></p>
            </div>

        </div>
        <hr>
        <div class="fileimport">
            <div class="form-group">
                <label>Import CSV</label>
            </div>
            <form method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>admin/vendor/vendorimportcsv">
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
         
         
       <input id="myInput" type="text" placeholder="Search..">
      <table id="na_datatable" class="table table-bordered table-striped">
        <thead>

        <tr>
          <th>No.</th>
          <th>Vendor Code</th> 
          <th>Vendor Name</th>
          <th>Email</th>
        
          <th>Status</th>
          <th>Action</th>
        </tr>

        </thead>

<tbody id="myTable">

  <?php

  foreach($records as $keys=>$vals){
      
      if($vals['status'] == 1){
          $status ="Active";
      }
      else{
          $status ="Inactive";
      }
      
    echo '<tr role="row" class="odd">
      <td>'.++$keys.'</td>
      <td class="sorting_1">'.$vals['id'].'</td>
      <td class="sorting_1">'.$vals['name'].'</td>
     
      <td>'.$vals['email'].'</td>


      <td>
         <span class="btn btn-xs btn-success" title="status">'.$status.'<span><span></span></span></span>
      </td>
      
       <td>
         <a title="Edit" class="btn-edit" href="'.base_url().'admin/vendor/edit/'.$vals['id'].'">Edit
        </a>
        <a title="Delete" 
           class="btn-delete" href="'.base_url().'admin/vendor/del/'.$vals['id'].'" 
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
        var removedata = [5];
        table = document.getElementById("na_datatable");
        var csv = 'ID, Vendor Code, Vendor Name, Email Address, Status\n';
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
        hiddenElement.download = 'Info-Vendor.csv';
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
