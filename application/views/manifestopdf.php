<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Customer Invoice</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<style>
tr, td, p,h2{
    font-size:10px;
}
.table th, .table td {
    border: 1px solid black;
}
body{
    max-width: 600px;
    margin: auto;
}
</style>

</head>

<body>
<?php
    // foreach($manifesto as $mkeys=>$mvals){
    //     echo '<pre>',var_dump($mvals); echo '</pre>';
    // }
?>
<table width="100%" cellspacing="0" cellpadding="0" style="margin-top:0px" style="border:none;">
    <thead>
        <tr>
            <td style="text-align:left;"  width="50%">
            <?php
                if($company_info['image']){
                    ?>
                        <img src="<?php echo base_url();?>assets/company/<?php echo $company_info['company_id']."/". $company_info['image']; ?>" style="max-width:400px;margin-bottom:10px;"/>
                    <?php
                }
                else{
                  ?>
                  <img src="<?php echo base_url();?>assets/dist/img/dummy_logo_png.png" style="max-width:100px;margin-bottom:10px;"/>
                  <?php
                }
            ?>
               
           </td>
            <td style="text-align:right;font-size:24px;color:grey;font-weight:bold;" width="50%">Truck Manifest</td>
        </tr>
    </thead>
</table>
<hr style="margin-top:0px;">
<table  cellspacing="0" cellpadding="0" width="100%" >
    <thead>
        <tr>
           <td width="70%" valign="top" height="50" style="border:1px solid #d3d3d3;padding: 5px;padding-top: 5px;padding-bottom: 5px;font-size: 12px;float: left;font-style: italic;">
               <h2 style="margin:0;padding: 0;font-style: italic;">Disclaimer</h2>
               <p style="margin:0;padding: 0;align-items: top;vertical-align:top;"><?php echo $company_info['disclaimer']?></p>
           </td>
           <td width="30%" style="float:right;text-align: right;vertical-align: middle;align-items: center;">
               <table style="text-align:right;float:right;"> 
                    <tr style="text-align:right;">
                       <td> Job No:  </td>
                       <td style="border:1px solid #000;padding: 5px;"><?php echo $manifesto['job_id']?> </td>
                    </tr>
                    <br>
                    <tr style="text-align:right;">
                       <td> Date:  </td>
                       <td style="border:1px solid #000;padding: 5px;">
                       <?php

                        $date = date_create($manifesto['created_at']);
                        echo date_format($date,"d-m-Y");

                     
                       
                       ?></td>
                    </tr>
              </table>
           <td>
        </tr>
    </thead>
</table>

<table cellspacing="0" cellpadding="0" width="100%" style="margin-top:10px;">
    <thead>
            <td style="width:33.33%;font-size:11px;text-align: left;padding:5px 15px;border: 1px solid #000;">Shipper</td>
            <td width="1%"></td>
            <td  style="width:33.33%;font-size:11px;text-align: left;padding:5px 15px; border: 1px solid #000;">Consignee</td>
            <td width="1%"></td>
            <td  style="width:33.33%;font-size:11px;text-align: left;padding:5px 15px; border: 1px solid #000;">Notify Party</td>
    </thead>
<?php
//echo '<pre>',var_dump($job_list); echo '</pre>';
foreach($job_list as $jkeys=>$jvals){
?>
    <tbody>
        <td  style="width:33.33%;font-size: 12px;border: 1px solid #000;"> 
            <div style="min-height: 70px;padding:5px; margin-top:0px;padding-top:0px;">
                     <?php echo $jvals['shipper']; ?>
            </div>
        </td>
        <td width="1%;"></td>
        <td  style="width:33.33%;font-size: 12px;border: 1px solid #000;">

            <div style="min-height: 70px;padding:5px;padding-top:0px;"> 
                 <?php echo $jvals['consignee']; ?>
            </div>
        </td>
         <td width="1%;"></td>
        <td  style="width:33.33%;font-size: 12px;border: 1px solid #000;">
            <div style="min-height: 70px;padding:5px;padding-top:0px;">
            <?php echo $jvals['notify_party']; ?>
            </div>
        </td>
    </tbody>
  <?php
}
?>
</table>



<table cellspacing="0" cellpadding="0" width="100%"  style="margin-top:10px;">
    <thead>
            <td style="width:33.33%;font-size:10px;text-align: left;padding:5px 15px;border: 1px solid #000;">Loading Point</td>
            <td width="1%"></td>
            <td  style="width:33.33%;font-size:10px;text-align: left;padding:5px 15px;border: 1px solid #000;">Delivery Point</td>
            <td width="1%"></td>
            <td  style="width:33.33%;font-size:10px;text-align: left;padding:5px 15px;border: 1px solid #000;">Describe Facility, Equipment & Process at Loading/ Unloading site</td>
    </thead>
    <tbody>
        <td  style="width:33.33%;font-size: 12px;border: 1px solid #000;" align="top"> 
                <div style="min-height: 60px;padding:5px;padding-top:0px;">
                <?php echo $jvals['loading_point']; ?>
            </div>
        </td>
        <td width="1%"></td>
        <td  style="width:33.33%;font-size: 12px;border: 1px solid #000;" align="top">
            <div style="min-height: 60px;padding:5px;padding-top:0px;"> 
                     <?php echo $jvals['delivery_point']; ?>
            </div>
        </td>
          <td width="1%"></td>
        <td  style="width:33.33%;font-size: 12px;border: 1px solid #000;">
             <div style="min-height: 60px;padding:5px;padding-top:0px;">
             <?php echo $manifesto['describe_f_e']; ?>
            </div>
        </td>
    </tbody>
</table>


<table cellspacing="0" cellpadding="0"  border="1"  width="100%"  style="margin-top:10px;" class="table"> 
    <tbody>
        <tr>
            <td width="25%">
                <p style="padding:5px;margin: 0;padding-left: 10px;">Loading Origin</p> 
            </td>
            <td width="25%">
             <p style="padding:5px;margin: 0;padding-left: 10px;">   <?php echo $manifesto['loading_origin']; ?></p> 
           </td>
            <td width="25%">
             <p style="padding:5px;margin: 0;padding-left: 10px;">Loading Date </p> 
           </td>
            <td width="25%">
                <p style="padding:5px;margin: 0;padding-left: 10px;">    <?php echo $manifesto['loading_date']; ?> </p> 
            </td>
        </tr>


        <tr>
            <td width="25%">
                <p style="padding:5px;margin: 0;padding-left: 10px;">Delivery Destination</p> 
            </td>
            <td width="25%">
             <p style="padding:5px;margin: 0;padding-left: 10px;">   <?php echo $manifesto['delivery_destination']; ?> </p> 
           </td>
            <td width="25%">
             <p style="padding:5px;margin: 0;padding-left: 10px;">Delivery  Date</p> 
           </td>
            <td width="25%">
                <p style="padding:5px;margin: 0;padding-left: 10px;">  <?php echo $manifesto['delivery_date']; ?>  </p> 
            </td>
        </tr>
        <tr>
            <td width="25%">
                <p style="padding:5px;margin: 0;padding-left: 10px;">PO/DO Ref no Other Customer Ref</p> 
            </td>
            <td width="25%">
             <p style="padding:5px;margin: 0;padding-left: 10px;">  <?php echo $manifesto['po_do_ref']; ?> </p> 
           </td>
            <td width="25%">
             <p style="padding:5px;margin: 0;padding-left: 10px;">Truck Type </p> 
           </td>
            <td width="25%">
                <p style="padding:5px;margin: 0;padding-left: 10px;"><?php echo $manifesto['truck_type']; ?> </p> 
            </td>
        </tr>
         <tr>
            <td width="25%">
                <p style="padding:5px;margin: 0;padding-left: 10px;">Container No <br> Seal No</p> 
            </td>
            <td width="25%">
             <p style="padding:5px;margin: 0;padding-left: 10px;"><?php echo $manifesto['truck_type']; ?></p> 
           </td>
          
            <td width="25%" align="top" style="padding-left:10px;">
                <p style="padding:5px;margin: 0;padding-left: 10px;">  <?php echo $manifesto['truck_no']; ?></p> 
            </td>
            <td width="25%" align="top" style="padding-left:10px;">
             <p style="padding:5px;margin: 0;padding-left: 10px;"><?php echo $manifesto['truck_location'];?> </p> 
           </td>
        </tr>


    </tbody>
</table>

<table cellspacing="0" cellpadding="0" border="1"  width="100%"  style="margin-top:10px;font-size: 14px;" class="table">
    <tbody>
        
         <tr>
            <td width="25%">
                <p style="padding:5px;margin: 0;padding-left: 10px;">Special Remarks</p>
            </td>
            <td width="25%">
               <p style="padding:5px;margin: 0;padding-left: 10px;">Description of Goods</p> 


           </td>
            <td width="25%">
                 <p style="padding:5px;margin: 0;padding-left: 10px;">Quantity </p> 


           </td>
            <td width="25%">
                <p style="padding:5px;margin: 0;padding-left: 10px;"> Gross Weight </p> 

            </td>
        </tr>
        
         <tr>
            <td width="25%" style="padding-left:10px;padding-right:10px;font-size:10px;">

                <p style="font-size:10px;">
                 <b>Customs Clearance by:</b>
                <?php echo $manifesto['special_marks']; ?>
               </p>
            </td>
            <td width="25%">
               <p style="padding:5px;margin: 0;padding-left: 10px;"> <?php echo $manifesto['descriptions_goods']; ?></p> 


           </td>
            <td width="25%">
                 <p style="padding:5px;margin: 0;padding-left: 10px;"><?php echo $manifesto['quantity']; ?> </p> 
           </td>
            <td width="25%" style="padding-left: 10px;">
                <p style="padding:5px;margin: 0;padding-left: 10px;padding-bottom: 0px;"><?php echo $manifesto['gross_weigth']; ?>  </p> 

            </td>
        </tr>
    </tbody>
</table>


<table style="margin-top:30px;" width="100%" cellspacing="0" cellpadding="0" style="padding: 10px;">
     <thead>

         <tr>
              <td colspan="2"  width="50%" ><b>Confirmation of Receipt (Proof of Delivery)</b></td>
              <td style="border:1px solid #000;padding: 5px;" width="25%">Official Company Stamp</td>
              <td style="border:1px solid #000;padding: 5px;" width="25%">Authorised Signature</td>
         </tr>


         <tr>
              <td style="border:1px solid #000;padding: 5px;" width="25%">Name</td>
              <td style="border:1px solid #000;padding: 5px;" width="25%"></td>
              <td style="border-right: 1px solid #000;"></td>
              <td style="border-top:1px solid #000;border-right: 1px solid #000;padding: 5px;"></td>
         </tr>
         <tr>
              <td style="border:1px solid #000;padding: 5px;" width="25%">ID card no</td>
              <td style="border:1px solid #000;padding: 5px;" width="25%"></td>
              <td style="border-right: 1px solid #000;"></td>
              <td style="border-right: 1px solid #000;"></td>
         </tr>
         <tr>
              <td style="border:1px solid #000;padding: 5px;" width="25%">Company</td>
              <td style="border:1px solid #000;padding: 5px;" width="25%"></td>
              <td style="border-right: 1px solid #000;"></td>
              <td style="border-right: 1px solid #000;"></td>
             
         </tr>
          <tr>
              <td style="border:1px solid #000;padding: 5px;" width="25%">Position</td>
              <td style="border:1px solid #000;padding: 5px;" width="25%"></td>

              <td colspan="2" style="text-align:center;padding: 5px;border:1px solid #000;">To be completed authorized recipient at delivery point</td>
          </tr>

          <tr>
             <td colspan="1" style="border-top:1px solid #000;padding: 5px;" width="25%" height="0"></td> 

             <td colspan="3" style="border:1px solid #000;padding:5px;text-align: left;align-items: baseline;" width="75%" height="10">
             Remarks by Receiver
                <div style="height: 35px;"></div>
            </td> 
          </tr>

     </thead>
</table>

<table id="table_6">
    <thead>
        <tr>
            <td  style="text-align:left"><?php echo $company_info['descriptions'];?></td>
        </tr>
    </thead>
</table>

</body>

</html>
