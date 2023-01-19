<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
        

            <div class="card mb-4">
             
                <div class="card-body">
                      <div class="card">
                        <div class="card-header">
                          <div class="d-inline-block">
                            <h3 class="card-title"><i class="fa fa-list"></i>&nbsp; Query List</h3>
                          </div>

                        </div>
                         <div class="card-body">
                          <table id="na_datatable" class="table table-bordered table-striped">
                          <thead>

                          <tr>
                          <th>No.</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Mobile</th>
                          <th>Message</th>
                         
                          </tr>

                          </thead>

                          <tbody>

                          <?php
                          foreach($info as $keys=>$vals){
                          echo '<tr role="row" class="odd">
                          <td>'.++$keys.'</td>
                          <td class="sorting_1">'.$vals['firstname'].'</td>
                          <td>'.$vals['email'].'</td>
                          <td>'.$vals['mobile'].'</td>
                          <td><textarea cols="5" rows="4" class="form-control" readonly>'.$vals['message'].'</textarea></td>
                 
                         
                          </tr>';
                          }
                          ?>
                          </tbody>

                          </table>
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </main>
</div>
