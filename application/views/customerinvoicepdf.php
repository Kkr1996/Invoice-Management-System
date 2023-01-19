<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Customer Invoice</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<style>
    
    #download{
        text-align: center;
        display: flex;
        justify-content: center;
        background: black;
        padding: 15px;
        color: #fff;
        border: none;
        margin: 45px auto;
        cursor: pointer;
    }
    tr td{
        font-size: 14px;
    }
    #price_list  td {
        border-width: 1px;
        padding: 5px;
        border-style: solid;
        border-color: #000000;
        background-color: #ffffff;
    }
    .img-responsive{
        width: 140px;
    }
</style>
</head>

<body style="margin: 0; padding: 0;">
    
<header>
    <div class="container">
        <div class="header-par">
            <div class="header-left">
                <img src="<?php echo base_url();?>assets/company/<?php echo $company_info['company_id']."/". $company_info['image'];   ?>" class="img-responsive" />
            </div> 
        </div>
    </div>
</header>
    
<table width="100%" border="0" cellspacing="0" cellpadding="0">
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
        $allextraprice      = unserialize($data['extra_price']);
        $description        = unserialize($data['description']);
        $tax                = unserialize($data['tax']);    
    }
?>

<tr>
    <td width="60%"></td>
    <td width="40%">SST Reg No : <?php echo $company_info['registeration_no'] ?></td>
</tr>
  <tr>
    <td width="61%" height="28">
      <table style="box-sizing:border-box;margin:10px; font-family:Verdana, Geneva, sans-serif;text-align:left;" width="100%"  cellspacing="0" cellpadding="0">
          <tr width="50%">
                <table style="box-sizing:border-box; border-spacing: 0 0.5em;  border-collapse: separate;" width="80%" cellspacing="0" cellpadding="0">
                    <tr width="100%">
                        <td colspan="2" ><label><?php echo $customer_details['username'];  ?></label> </td>
                    </tr>
                    <tr width="100%">
                        <td colspan="2"><label><?php echo $customer_details['address'];  ?></label> </td>
                    </tr>
                    <br>
                    <tr width="100%">
                        <td width="20%"><label>ATTN</label> </td>
                        <td width="80%"><label><?php echo ": ".$data['attn']?></label></td>
                    </tr>
                   
                    <tr width="100%">
                        <td width="20%"><label>A/C NO.</label> </td>
                        <td width="80%"><label><?php echo ": ".$company_info['a_c_no']?></label></td>
                    </tr>           

                    <tr width="100%">
                        <td width="20%"><label>TEL</label> </td>
                        <td width="80%"><label><?php echo ": ".$customer_details['mobile_no']?></label></td>
                    </tr>

                </table>
          </tr>
        </table>
        
  </td>
   <td width="39%" align="right">
     
   <table style="box-sizing:border-box;margin:10px; border-spacing:0 0.5em;" width="80%" cellspacing="0" cellpadding="0">
            <tr>
                <td height="31" colspan="2" style="font-size:15px;"><strong>INVOICE</strong></td>
            </tr>

            <tr width="100%">
                <td width="50%" style="padding-bottom:4px;"><label>Number</label> </td>
                <td width="50%"><label><?php echo ": ".$data['invoice_no']?></label></td>
            </tr>
            <tr width="100%">
                <td width="50%" style="padding-bottom:4px;"><label>Date</label></td>
                <td width="50%"><label><?php echo ": ".date("d.m.Y"); ?></label></td>
           </tr>
            <tr width="100%">
                <td width="50%" style="padding-bottom:4px;"><label>Term</label>  </td>
                <td width="50%"><label><?php echo ": ".$data['term'];?></label></td>
            </tr>
            <tr width="100%">
                <td width="50%" style="padding-bottom:4px;"> <label>Job No/ID</label> </td>
               <td width="50%"><label><?php echo ": ".$data['job_no'];  ?></label></td>
            </tr>
            <tr width="100%">
                <td width="50%" style="padding-bottom:4px;"><label> LOA Number </label></td>
                <td width="50%"><label><?php echo ": ".$data['loa_number'];  ?></label></td>
           </tr>
            <tr width="100%">
                <td width="50%" style="padding-bottom:4px;"><label>DO Number </label> </td>
                <td width="50%"><label><?php echo ": ".$data['do_number'];  ?></label></td>
            </tr>
            <tr width="100%">
                <td width="50%" style="padding-bottom:4px;"><label> PO Reference </label></td>
                <td width="50%"><label><?php echo ": ".$data['po_reference'];  ?></label></td>
            </tr>
            <tr width="100%">
                <td width="50%" style="padding-bottom:4px;"><label>IBD </label> </td>
                 <td width="50%"><label><?php echo ": ".$data['ibd'];  ?></label></td>
            </tr>
         
            
     
    </table>
  </td>
  </tr>

<tr>
      
<td style="font-family:Verdana, Geneva, sans-serif;" colspan="2">     
<table width="100%" id="price_list" cellspacing="0" border="0">
        
        <tr>
            <td width="5%"  align="center" style="font-size:12px;">No.</td>
            <td width="10%" align="center" style="font-size:12px;">Item Code</td>
            <td width="20%" align="center" style="font-size:12px;">Description</td>
            <td width="5%"  align="center" style="font-size:12px;">Qty</td>
            <td width="5%"  align="center" style="font-size:12px;">Price/Unit</td>
            <td width="10%"  align="center" style="font-size:12px;">Sub Total</td>
            <td width="15%"  align="center" style="font-size:12px;">Total Excl. SST (RM)</td>
            <td width="15%"  align="center" style="font-size:12px;">SST Amt @6% (RM)</td>
            <td width="15%"  align="center" style="font-size:12px;">Total Incl. SST (RM)</td>    
        </tr>
       
         <?php
         $total_excl_sst=0;
         $tota_sst_amt=0;
         $add_charge = 0;
         if($data['jobid']!="N;"){
              if(count($alljobid) >0)
               {
                   for($i=0;$i <count($alljobid);$i++)
                   {
                       
                      $actual_price  = $allqty[$i]  * $allprice[$i];
                      $extra_price   = $allqty[$i]  * $allextraprice[$i];


                      $total_sum_price_per_unit = $extra_price + $actual_price;

                      $actual_price_per_unit    = $allprice[$i] + $allextraprice[$i];

                      $sub_total_price_byqty     =$actual_price_per_unit * $allqty[$i];   

                      if($tax[$i]==1)
                      {
                         $sst_price_byqty= ( $sub_total_price_byqty*6)/100;  
                      }
                      else
                      {
                         $sst_price_byqty  =$sub_total_price_byqty*0;
                      }
                       
                       
                      $total_price_with_sst_byqty= $sub_total_price_byqty +  $sst_price_byqty; 
                         
                       
                      ?>
                        <tr>
                            
                            <td width="5%"  align="center" style="font-size:12px;"><?php echo ($i+1); ?></td>
                            <td width="10%" align="center" style="font-size:12px;"> <?php echo strtoupper($alljobid[$i]);?></td>
                            <td width="20%" align="center" style="font-size:12px;"><?php echo $description[$i]; ?></td>
                            
                            <td width="5%"  align="center" style="font-size:12px;"><?php echo $allqty[$i]; ?></td>
                            
                            <td width="5%"  align="center" style="font-size:12px;"><?php echo $actual_price_per_unit; ?></td>

                            <td width="10%" align="center" style="font-size:12px;"><?php echo $sub_total_price_byqty;?></td>

                            <td width="15%" align="center" style="font-size:12px;"><?php echo $sub_total_price_byqty;?></td>
                            
                            <td width="15%" align="center" style="font-size:12px;"><?php echo $sst_price_byqty; ?></td>
                            <td width="15%" align="center" style="font-size:12px;"><?php echo $total_price_with_sst_byqty; ?></td>
                           
                         
                            
                        </tr>
                      <?php  
                        $total_excl_sst = $total_excl_sst + $sub_total_price_byqty;
                        $tota_sst_amt = $tota_sst_amt + $sst_price_byqty;
                    }
                  ?>    
                     
                      
                 <?php      
                  
               }
            }
          ?>   
       
       
       
       
          <?php 
            $counts = 1;
            $sum = 0;
           foreach(unserialize($data['item_code']) as $keys=>$values){
            $total_amount_perunit  = $qty[$keys] * $price[$keys] - $discount[$keys];
            $sum = $sum + $total_amount_perunit;
            echo '<tr border="1"><td align="center">'.$counts++.'</td>
            <td  align="center">'.$values.'</td>
            <td  align="center">'.$descriptions[$keys].'</td>
            <td  align="center">'.$qty[$keys].'</td>
            <td  align="center">'.$price[$keys].'</td>
            <td  align="center">'.$discount[$keys].'</td>
            <td  align="center">'.$total_amount_perunit.'</td></tr>';
              
          }
          ?>
    </table>
  
    <table width="100%" style="margin-top:10px;">
      <tbody>
        <tr>
          <td class="left">
              RINGITT MALASIYA: <?php echo  AmountInWords($total_excl_sst + $tota_sst_amt);?>
          </td>
        </tr>
      </tbody>
    </table>
      
</td>
</tr>
</table>
    <table width="40%" id="price_list" cellspacing="0" align="right" style="margin-top:20px; font-family:Verdana, Geneva, sans-serif;">
         <tr>
            <td align="center">Total Excl. SST </td>
            <td align="center"><?php echo $total_excl_sst; ?></td>
        </tr>
        <tr>
            <td align="center" >SST Amt @ 6% </td>
            <td align="center" ><?php echo  $tota_sst_amt; ?></td>
        </tr>
        <tr>
            <td align="center"><strong>Total Payable Incl. SST</strong></td>
            <td align="center"><strong><?php echo($total_excl_sst + $tota_sst_amt) ; ?></strong></td>
        </tr>
        
    </table>    

    
    <table style="font-size:12px;margin-top:30px; font-family:Verdana, Geneva, sans-serif;">
        <tr>
            <ol style="padding:0px;margin:0px;">
                <li>Discrepancy, if any, must be reported within 7 days from the date of receipt of invoice. Else, it will be treated as accurate <br> For inqueries on invoice, please contact<?php echo "+ ". $company_info['phone'] ?>. </li>
                <li>Payment by cheque must be crossed "Account payee only" and make payable to "<?php echo  $company_info['company_name'];?>" (<?php echo $company_info['company_code']; ?>). </li>
                <li>Bank address: <?php echo $company_info['bank_name'].", ".$company_info['bank_address']; ?>. </li>
                <li>Bank Account Number: <?php echo $company_info['a_c_no'];  ?> SWIFT Code: <?php echo $company_info['swift_code'];  ?> </li>
                <li>Late Payment: Beyond agreed credit terms, late payment shall attract penalty at pervailing bank overdraft rates </li>
            </ol>
            <hr>
            <p style="margin-bottom:0;"><?php echo  $company_info['company_name'];?> (<?php echo $company_info['company_code']; ?>).
             <br>
             <?php echo  $company_info['descriptions'];?> 
            </p>
          
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
