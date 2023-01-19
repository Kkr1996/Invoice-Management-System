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
                          
                              <div class="d-inline-block float-right">
                                <a href="<?= base_url('staff/staffcontroller/add'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Add New User</a>
                            </div>
                         <div class="card-body">


                            
                          <table id="na_datatable" class="table table-bordered table-striped">
                          <thead>
                          <tr>
                              
                              <th>No.</th>
                              <th>Name</th>
                              <th>Customer Id</th>
                              <th>Email</th>
                              <th>Mobile</th>
                              <th>Status</th>
                              <th class="text-right">Action</th>
                              
                          </tr>
                          </thead>

                          <tbody>

                          <?php
                          foreach($data as $keys=>$vals){

                                $status = ($vals['is_active'] == 1)? 'Active': 'In Active';
                                $verify = ($vals['is_verify'] == 1)? 'Verified': 'Pending';
                              echo '<tr role="row" class="odd">
                              <td>'.++$keys.'</td>
                              <td class="sorting_1">'.$vals['username'].'</td>
                              <td class="sorting_1">'.$vals['member_id'].'</td>
                              <td>'.$vals['email'].'</td>
                              <td>'.$vals['mobile_no'].'</td>
                              <td>'.$status.'</td>
                             
                              <td>
                                  <a 
                                  class="delete btn btn-sm btn-edit" href="'.base_url().'staff/staffcontroller/users_edit/'.$vals['id'].'"> 
                                  Edit
                                  </a>
                                  <a title="Delete" 
                                  class="delete btn btn-sm btn-delete" href="'.base_url().'staff/staffcontroller/users_delete/'.$vals['id'].'">
                                  Delete
                                  </a>
                                 
                              </td>
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
