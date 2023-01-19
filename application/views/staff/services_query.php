
<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">My Orders</h1>
                        <div class="card mb-4">
                              <div class="d-inline-block float-right">
                                <a href="<?= base_url('staff/staffcontroller/addorders'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Add New Orders</a>
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Order Id </th>
                                            <th>Date Entry </th>
                                            <th>Name </th>
                                            <th>Email</th>
                                            <th>Mobile No</th>
                                            <th>Services</th>
                                            <th>Sub Services</th>
                                            <th>Price</th>
                                            <th>Fianl Price</th>
                                           
                                            <th>Status</th>
                                            <th>Customer Id</th>
                                            <th>Registered /Not Registered</th>
                                            <th>Generate PDF</th>
                                            
                                            <th>Message</th>
                                            <th>Remarks</th>
                                            <th>Action</th>
                                           
                                        </tr>
                                    </thead>
                                    
                                  
                                    <tbody>
                                        
                                        <?php
                                        
                                        if($results):
                                        foreach($results as $keys=>$values){
                                            
                                            
                                            $status =   ($values['status']) ? $values['status'] : "N/A";
                                            
                                            $pdf_status =   ($values['status'] === "Converted") ? '<a href="'.base_url().'/admin/staff/generatepdf/'.$values['order_id'].'" target="_blank">Generate pdf</a>' : "N/A";
                                    
                                            if($values['userid']){
                                                $regisered_status = "Registered";
                                            }
                                            else{
                                                $regisered_status = "Not Registered";
                                            }

                                            
                                            echo '<tr>
                                                      <td>'.++$keys.'</td>
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
                                                      <td>'.$values['userid'].'</td>
                                                      <th>'.$regisered_status.'</th>
                                                      <td>'.$pdf_status.'</td>
                                                      <td>'.$values['message'].'</td>
                                                      <td>'.$values['remarks'].'</td>
                                                  <td>
                                                  <a title="Edit" class="update btn btn-sm" href="'.base_url('staff/staffcontroller/orders_edit/'.$values['order_id']).'"> Edit</i></a>
            	                                 </td>
                                            </tr>';
                                            
                                        }
                                        endif;
                                        ?>
                                       
                                
                                      
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
               
            </div>

