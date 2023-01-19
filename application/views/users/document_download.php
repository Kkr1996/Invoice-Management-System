<div id="layoutSidenav_content">
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Document download</h1>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                 Download
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Action</th>
                            <th>View</th>
                        </tr>
                    </thead>
               <tbody>   
                   <?php 
                    error_reporting(0);
                    $count=0;

                    if($files):
                    foreach($files as $keys=>$vals){



                        foreach(unserialize($vals['files']) as $keys=>$vales){
                             $count++;
                              echo '<tr>
                                        <td>'.$count.'</td>
                                        <td><a href="'.base_url().'uploads/users/'.$vals['member_id'].'/'.$vales.'" download>Download</a></td>
                                        <td><a href="'.base_url().'uploads/users/'.$vals['member_id'].'/'.$vales.'">View</a></td>

                                  </tr>';
                        }
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
