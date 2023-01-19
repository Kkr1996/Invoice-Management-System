<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Email</title>
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
</style>
</head>
<button onclick="generatePDF()" id="download">Download as PDF</button>
<body style="margin: 0; padding: 0;">
<div class="container">

<table style="box-sizing:border-box; border:1px solid #c8c8c8;" width="100%" border="0" cellspacing="0" cellpadding="0" id="rcc">

  <tr>
     <td height="100" colspan="2" align="center"><img src="<?php echo base_url();?>assets/img/logo-log.png" width="219" /> <hr />
    </td>
  </tr>
  <tr>
    <td height="31" colspan="2" style="padding-left:10px; font-size:20px; font-family:Verdana, Geneva, sans-serif;"><strong>INVOICE</strong></td>
  </tr>
  <tr>
    <td width="61%" height="28"><table style="box-sizing:border-box; border:1px solid #c8c8c8; margin:10px;" width="90%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td  width="25%" height="25" style="padding-left:10px; font-family:Verdana, Geneva, sans-serif; border-bottom:1px solid #c8c8c8; border-right:1px solid #c8c8c8; font-size:14px;"><strong>Name </strong></td>
        <td width="75%" style="padding-left:10px; font-family:Verdana, Geneva, sans-serif; border-bottom:1px solid #c8c8c8;  font-size:14px;">Demo Name</td>
      </tr>
      <tr>
        <td height="25" style="padding-left:10px; font-family:Verdana, Geneva, sans-serif; border-right:1px solid #c8c8c8;  font-size:14px;"><strong>Address</strong></td>
        <td style="padding-left:10px; font-family:Verdana, Geneva, sans-serif;  font-size:14px;">Lucknow, India</td>
      </tr>
      
      
      <tr>
        <td height="25" style="padding-left:10px; font-family:Verdana, Geneva, sans-serif; border-right:1px solid #c8c8c8; border-top:1px solid #c8c8c8;  font-size:14px;"><strong>Mobile</strong></td>
        <td style="padding-left:10px; font-family:Verdana, Geneva, sans-serif; border-top:1px solid #c8c8c8;  font-size:14px;">+91-88888888888</td>
      </tr>
      
      
    </table></td>
    <td width="39%" align="right"><table style="box-sizing:border-box; border:1px solid #c8c8c8; margin:10px;" width="80%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="25" align="right" style="padding-right:10px; font-family:Verdana, Geneva, sans-serif; border-bottom:1px solid #c8c8c8; border-right:1px solid #c8c8c8; font-size:14px;"><strong>Order ID</strong> : #3DRT567</td>
        </tr>
      <tr>
        <td height="25" align="right" style="padding-right:10px; font-family:Verdana, Geneva, sans-serif; border-right:1px solid #c8c8c8;  font-size:14px;"><strong>Reciept No</strong> : #5674DFTRG</td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td height="28" colspan="2"> </td>
  </tr>
  <tr>
    <td style="padding:10px;" height="28" colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="13%" height="28" align="center" style="border-bottom:1px solid #c8c8c8; border-right:1px solid #c8c8c8; border-left:#c8c8c8 1px solid; border-top:#c8c8c8 1px solid; font-family:Verdana, Geneva, sans-serif; font-size:13px;"><strong>S.N</strong></td>
        <td width="22%" align="center" style="border-bottom:1px solid #c8c8c8; border-right:1px solid #c8c8c8; border-top:#c8c8c8 1px solid; font-family:Verdana, Geneva, sans-serif; font-size:13px;"><strong>DESCRIPTION </strong></td>
        <td width="26%" align="center" style="border-bottom:1px solid #c8c8c8; border-right:1px solid #c8c8c8; border-top:#c8c8c8 1px solid; font-family:Verdana, Geneva, sans-serif; font-size:13px;"><strong>AMOUNT</strong></td>
        <td width="20%" align="center" style="border-bottom:1px solid #c8c8c8; border-right:1px solid #c8c8c8; border-top:#c8c8c8 1px solid; font-family:Verdana, Geneva, sans-serif; font-size:13px;"><strong>QUATITY</strong></td>
        <td width="19%" align="center" style="border-bottom:1px solid #c8c8c8; border-right:1px solid #c8c8c8; border-top:#c8c8c8 1px solid; font-family:Verdana, Geneva, sans-serif; font-size:13px;"><strong>TOTAL AMOUNT</strong></td>
      </tr>
      <tr>
        <td style="border-bottom:1px solid #c8c8c8; border-right:1px solid #c8c8c8; border-left:#c8c8c8 1px solid" height="28" align="center">1</td>
        <td style="border-bottom:1px solid #c8c8c8; border-right:1px solid #c8c8c8;" align="center">Domain</td>
        <td style="border-bottom:1px solid #c8c8c8; border-right:1px solid #c8c8c8;" align="center">500</td>
        <td style="border-bottom:1px solid #c8c8c8; border-right:1px solid #c8c8c8;" align="center">1</td>
        <td style="border-bottom:1px solid #c8c8c8; border-right:1px solid #c8c8c8;" align="center">500</td>
      </tr>
      <tr>
        <td style="border-bottom:1px solid #c8c8c8; border-right:1px solid #c8c8c8; border-left:#c8c8c8 1px solid" height="28" align="center">2</td>
        <td style="border-bottom:1px solid #c8c8c8; border-right:1px solid #c8c8c8;" align="center">Hosting </td>
        <td style="border-bottom:1px solid #c8c8c8; border-right:1px solid #c8c8c8;" align="center">1500</td>
        <td style="border-bottom:1px solid #c8c8c8; border-right:1px solid #c8c8c8;" align="center">1</td>
        <td style="border-bottom:1px solid #c8c8c8; border-right:1px solid #c8c8c8;" align="center">1500</td>
      </tr>
      <tr>
        <td style="border-bottom:1px solid #c8c8c8; border-right:1px solid #c8c8c8; border-left:#c8c8c8 1px solid" height="28" align="center">3</td>
        <td style="border-bottom:1px solid #c8c8c8; border-right:1px solid #c8c8c8;" align="center">Designing</td>
        <td style="border-bottom:1px solid #c8c8c8; border-right:1px solid #c8c8c8;" align="center">4000</td>
        <td style="border-bottom:1px solid #c8c8c8; border-right:1px solid #c8c8c8;" align="center">1</td>
        <td style="border-bottom:1px solid #c8c8c8; border-right:1px solid #c8c8c8;" align="center">4000</td>
      </tr>
    </table>
       
    </td>
  </tr>
  <tr>
    <td style="padding:10px;" height="28"> </td>
    <td style="padding:10px;" height="28"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td style="border-bottom:1px solid #c8c8c8; border-right:1px solid #c8c8c8; border-top:1px solid #c8c8c8; border-left:1px solid #c8c8c8; font-family:Verdana, Geneva, sans-serif; font-size:13px; padding-left:10px;" width="51%" height="29"><strong>Total Amount</strong></td>
        <td width="49%" align="center" style="border-bottom:1px solid #c8c8c8; border-right:1px solid #c8c8c8; border-top:1px solid #c8c8c8;">6000</td>
      </tr>
      <tr>
        <td style="border-bottom:1px solid #c8c8c8; border-right:1px solid #c8c8c8; border-left:1px solid #c8c8c8; font-family:Verdana, Geneva, sans-serif; font-size:13px; padding-left:10px;" height="29"><strong>GST </strong></td>
        <td align="center" style="border-bottom:1px solid #c8c8c8; border-right:1px solid #c8c8c8;">200</td>
      </tr>
      <tr>
        <td style="border-bottom:1px solid #c8c8c8; border-right:1px solid #c8c8c8; border-left:1px solid #c8c8c8; font-family:Verdana, Geneva, sans-serif; font-size:13px; padding-left:10px;" height="29"><strong>Total Amount</strong></td>
        <td align="center" style="border-bottom:1px solid #c8c8c8; border-right:1px solid #c8c8c8;">6200</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="28" colspan="2"> </td>
  </tr>
  <tr>
    <td style="font-family:Verdana, Geneva, sans-serif; font-size:13px;" height="28" colspan="2" align="center">
     <strong>Company Name</strong>
                            <br>
                            ABC AREA
                            <br>
                            Tel: +00 000 000 0000 | Email: info@companyname.com
                            <br>
                            Company Registered in Country Name. Company Reg. 12121212.
                            <br>
                            VAT Registration No. 021021021 | ATOL No. 1234
    </td>
  </tr>
  <tr>
    <td height="28" colspan="2"> </td>
  </tr>
</table>
</div>
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