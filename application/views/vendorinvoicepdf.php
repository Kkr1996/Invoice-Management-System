<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Vendor Invoice</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<style>


    tr td{
        font-size: 13px;
    }
    #price_list  td {
        border-width: 1px;
        padding: 5px;
        border-style: solid;
        border-color: #000000;
        background-color: #ffffff;
    }

</style>
</head>
<body style="margin: 0; padding: 0;">
<table style="box-sizing:border-box;" width="100%" border="0" cellspacing="0" cellpadding="0">
<?php 
    error_reporting(0);
    if(count($data) > 0 ){
        $item_code          = $data['item_code'];
        $descriptions       = unserialize($data['descriptions']);
        $qty                = unserialize($data['qty']);
        $price              = unserialize($data['price']);
        $discount           = unserialize($data['discount']); 
        $alljobid           = unserialize($data['jobid']); 
        $allqty             = unserialize($data['qty']) ;
        $allprice           = unserialize($data['price']) ;
        $additional_custom_charge=unserialize($data['additional_custom_charge']) ;
      
    }
      
    

            
?>
  <tr>
     <td colspan="2" align="center">
           <p style="font-size:20px;font-weight:bold;margin-bottom:0px;"><?php echo strtoupper($company_details['company_name']);?></p>
           <p style=" line-height: 1.5; margin-top:0px;" >(Company No: <?php echo  $company_details['registeration_no'];?>)
           <br><?php echo  $company_details['descriptions'];?>
           <br><?php echo "Phone :".$company_details['phone']." , FAX: ".$company_details['fax']; ?>
           <br><?php echo "Email :".$company_details['email'];?>
           <br><?php echo "<strong>SERVICE TAX NO.</strong> ".$company_details['service_tax_no']; ?></p>
      </td>
  </tr>
  <tr>
      <td colspan="2" style="font-size:16px;font-family:Verdana, Geneva, sans-serif;text-align:center;">
        <p><strong>INVOICE</strong></p>
      </td>
  </tr>
  <tr>
      <td width="61%" height="28">
          <table style="box-sizing:border-box;margin:10px;" width="90%" border="0" cellspacing="0" cellpadding="0">
          <tr width="80%">
             <p style=" line-height: 1.5">
                <?php echo "<strong>".$vendor_details['name']."</strong><br>" ?>
                <?php echo $vendor_details['address'];  ?><br>
                <Strong>  ATTN : <?php echo $data['attn_no']?></Strong><br>
                <Strong>   TEL: <?php echo $vendor_details['phone'];?></Strong><br>
             
            </p>
          </tr>
        </table>
      </td>
     <td width="39%" align="right">
         <table style="box-sizing:border-box;margin:10px; border-spacing: 0 0.5em;  border-collapse: separate;" width="80%" border="0" cellspacing="0" cellpadding="0">
            <tr>
             <td height="15" align="right" style="padding-right:10px; font-family:Verdana, Geneva, sans-serif;font-size:14px;">
                    <tr width="100%">
                        <td width="50%"><strong>INVOICE   </strong></td>
                        <td  width="50%"><strong><?php echo  ": ".strtoupper($data['invoice_id']);?></strong></td>
                    </tr>
                    <tr  width="100%">
                        <td width="50%"><strong>DATE   </strong></td>
                        <td  width="50%"><strong><?php  echo ": ".date("d.m.Y", strtotime($data['created_at']));?></strong></td>
                    </tr>
                    <tr  width="100%">
                        <td width="50%"><strong>D/O NO </strong></td>
                        <td  width="50%"><strong><?php echo  ": ".strtoupper($data['d_o_no']);?></strong></td>
                    </tr>
                    <tr  width="100%">
                        <td width="50%"><strong>TERM   </strong></td>
                        <td  width="50%"><strong><?php echo  ": ".strtoupper($data['terms']);?></strong></td>
                    </tr>  
              </td>
            </tr>
        </table>
      </td>
    </tr>
</table>
    <hr>
   

   <table style="width:100%;text-align:center;">
        <tr>   
          <td style="padding:5px;" height="18" colspan="2">    
           <table width="100%" id="price_list" cellspacing="0">   
                  <?php 
                    $counts = 1;
                    $sum = 0;
                    $additional = 0;
                  foreach(unserialize($data['item_code']) as $keys=>$values){

                    $total_amount_perunit  = $qty[$keys] * $price[$keys] - $discount[$keys];

                    $sum = $sum + $total_amount_perunit;
                        
                  }
                  ?>
            </table>
             
              <table width="100%" id="price_list" cellspacing="0">
                <tr>
                    <td width="8%" height="28" align="center"><strong>No.</strong></td>
                    <td width="8%" height="28" align="center"><strong>Job Id</strong></td>
                    <td width="50%" align="center"><strong>Description</strong></td>
                    <td width="8%" align="center"><strong>Qty</strong></td>
                    <td width="8%" align="center"><strong>Additional Custom Charge</strong></td>
                    <td width="8%" align="center"><strong>Total</strong>
                    </td>
                </tr>
                   <?php
                     $subtotal=0;
                    $add_charge = 0;
                     if($data['jobid']!="N;"){
                          if(count($alljobid) >0)
                           {
                               for($i=0;$i <count($alljobid);$i++)
                               {
                                  ?>
                                    <tr>
                                        <td width="8%" height="28" align="center"><?php echo ($i+1); ?></td>
                                        <td width="8%" height="28" align="center"> <?php echo strtoupper($alljobid[$i]);?></td>
                                        <td width="50%" align="center"><?php echo $jobid_desc[$i] ?></td>
                                        <td width="8%" align="center"><?php echo $allqty[$i] ?></td>
                                        <td width="8%" align="center"><?php echo $additional_custom_charge[$i] ?></td>
                                        <td width="8%" align="center"><?php echo $total=($allqty[$i]*$allprice[$i]) ?></td>
                                    </tr>
                                  <?php  
                                    $add_charge = $add_charge + $additional_custom_charge[$i]; 
                                    $subtotal=$subtotal+$total;  
                                   
                                  
                                }
                           }
                          ?>
                        <tr>
                            <td colspan="4" width="8%" align="center"></td>
                            <td width="8%" align="center"><?=$add_charge?></td>
                            <td width="8%" align="center"><?php echo $subtotal; ?></td>
                        </tr>
                         <?php
                     }
                   
                      ?>
                 <tfoot>
                    <tr class="text-offset">
                      <td colspan="5">Total Amount Excluding SST @6%</td>
                      <td><?=$totalchargewithout  = $add_charge + $subtotal;?></td>
                    </tr>
                    <tr class="text-offset">
                      <td colspan="5">SST@6%</td>
                      <td><?php
                          
                          $sst=($totalchargewithout*6)/100;
                          echo number_format((float)$sst, 2, '.', '');
                          ?></td>
                    </tr>
                    <tr class="text-offset">
                      <td colspan="5">TOTAL AMOUNT MYR</td>
                      <td><?php echo $total_amount_inc_tax = $totalchargewithout + $sst;?></td>
                    </tr>
                  </tfoot>  
              </table>  
              
        </td>
    </tr>
  </table> 
    
<table width="100%">
  <tbody>

    <tr>
      <td class="left">
          <?php $total_amount_inc_tax = number_format((float)$total_amount_inc_tax, 2, '.', ''); ?>
          RINGITT MALASIYA: <?php echo  AmountInWords($total_amount_inc_tax);?>
      </td>
     
    </tr>

  </tbody>
</table>
<table style="border-spacing: 0 4em;" width="50%">
    
    <tr>
        <td class="left" style="border-top:2px solid #000">
            <p><strong><?php echo strtoupper($company_details['company_name']);?></strong></p>
            <p><?php echo $company_details['disclaimer']; ?><strong><?php echo strtoupper($company_details['company_name']);?>.</strong></p>
        </td>
    </tr>
</table>

</body>

</html>

<script>
 function generatePDF() {
 var element = document.getElementById('rcc');
 html2pdf(element, {
  margin:       10,
  filename:     'myfile.pdf',
  image:        { type: 'jpeg', quality: 0.98 },
  html2canvas:  { scale: 2, logging: true, dpi: 10, letterRendering: true },
  jsPDF:        { unit: 'mm', format: 'a4', orientation: 'portrait' }
});
}
</script>
<?php
// Create a function for converting the amount in words
function AmountInWords(float $amount)
{
   $amount_after_decimal = round($amount - ($num = floor($amount)), 2) * 100;
   // Check if there is any number after decimal
   $amt_hundred = null;
   $count_length = strlen($num);
   $x = 0;
   $string = array();
   $change_words = array(0 => '', 1 => 'One', 2 => 'Two',
     3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
     7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
     10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
     13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
     16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
     19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',
     40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty',
     70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety');
    $here_digits = array('', 'Hundred','Thousand','Lakh', 'Crore');
    while( $x < $count_length ) {
      $get_divider = ($x == 2) ? 10 : 100;
      $amount = floor($num % $get_divider);
      $num = floor($num / $get_divider);
      $x += $get_divider == 10 ? 1 : 2;
      if ($amount) {
       $add_plural = (($counter = count($string)) && $amount > 9) ? 's' : null;
       $amt_hundred = ($counter == 1 && $string[0]) ? ' and ' : null;
       $string [] = ($amount < 21) ? $change_words[$amount].' '. $here_digits[$counter]. $add_plural.' 
       '.$amt_hundred:$change_words[floor($amount / 10) * 10].' '.$change_words[$amount % 10]. ' 
       '.$here_digits[$counter].$add_plural.' '.$amt_hundred;
        }
   else $string[] = null;
   }
   $implode_to_Rupees = implode('', array_reverse($string));
   $get_paise = ($amount_after_decimal > 0) ? "And " . ($change_words[$amount_after_decimal / 10] . " 
   " . $change_words[$amount_after_decimal % 10]) . ' Paise' : '';
   return ($implode_to_Rupees ? $implode_to_Rupees . 'Rupees ' : '') . $get_paise;
}
?>
