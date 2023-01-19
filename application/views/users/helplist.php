<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
        

                 <div class="card">
                  <div class="card-header">
                    <div class="d-inline-block">
                      <h3 class="card-title"><i class="fa fa-list"></i>&nbsp; Query</h3>
                    </div>

                  </div>
                </div>

                <div class="card">
                  <div class="card-body table-responsive">
                    <table id="na_datatable" class="table table-bordered table-striped" width="100%">
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>Customer Id</th>
                          <th>Subject</th>
                          <th>Message</th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php 
                              foreach($data as $keys=>$vals){
                                echo '<tr>
                                        <td>'.$vals['id'].'</td>
                                        <td>'.$vals['userid'].'</td>
                                        <td>'.$vals['subject'].'</td>
                                        <td><textarea>'.$vals['message'].'</textarea></td>
                                    </tr>'; 
                              }
                          ?>
                      </tbody>
                    </table>
                  </div>
                </div>
            
            
        </div>
    </main>
</div>
  <script type="text/javascript">
     $(document).ready(function(){
      $(".btn-delete").click(function(){
        if (!confirm("Do you want to delete")){
          return false;
        }
      });
    });
  </script>