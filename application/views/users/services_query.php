  <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Services Query</h1>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Services
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Order Id </th>
                                            <th>Date Entry </th>
                                            <th>Name </th>
                                            <th>Email</th>
                                            <th>Mobile No</th>
                                            <th>Service</th>
                                            <th>Sub Service</th>
                                            <th>Price</th>
                                            <th>Final Price</th>
                                            <th>Status</th>
                                            <th>Message</th>
                                            <th>Remarks</th>
                                           
                                        </tr>
                                    </thead>
                  
                                    <tbody>
                                        <?php
                                            if($results){
                                                foreach($results as $keys=>$values){
                                                    $status =   ($values['status']) ? $values['status'] : "N/A";
                                                    echo '<tr>
                                                      <td>'.$values['order_id'].'</td>
                                                      <td>'.$values['date_entry'].'</td>
                                                      <td>'.$values['name'].'</td>
                                                      <td>'.$values['email'].'</td>
                                                      <td>'.$values['mobile_no'].'</td>
                                                      <td>'.$values['services'].'</td>
                                                      <td>'.$values['subservices'].'</td>
                                                      <td>'.$values['price'].'</td>
                                                      <td>'.$values['finalprice'].'</td>
                                                      <td>'.$status.'</td>
                                                      <td>'.$values['message'].'</td>
                                                      <td>'.$values['remarks'].'</td>
                                                    </tr>';
                                                }
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
         </main>
  </div>