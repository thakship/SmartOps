<!--<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />--!>
<script type="text/javascript">
/*function getprint(){
var prtContent = document.getElementById("getNewView");
  var WinPrint = window.open('', '', 'letf=0,top=0,width=1150,height=500,toolbar=0,scrollbars=0,status=0');
  WinPrint.document.write(prtContent.innerHTML);
  WinPrint.document.close();
  WinPrint.focus();
  WinPrint.print();
  WinPrint.close();
}
*/
</script>

<!--</head>
<body>-->
<?php
   $depnum = $_POST['depnum'];
   $contnum= $_POST['contnum'];
   $dif_userID = $_POST['getuserID'];
   $dif_userBranch = $_POST['getuserBranch'];
   require 'ora_database.php';
   $dbCon = ora_database::connect();
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//error_reporting(E_ALL | E_STRICT);
//ini_set('display_errors', 'Off');

/*$dbstr1 ="(DESCRIPTION =(ADDRESS = (PROTOCOL = TCP)(HOST =192.168.4.10)(PORT = 1521))
(CONNECT_DATA =
(SERVER = DEDICATED)
(SERVICE_NAME = cdbprod)
(INSTANCE_NAME = cdbprod)))";
$dbCon = oci_connect('CDBERP','CDBERP',$dbstr1); 

date_default_timezone_set("Asia/Calcutta");
echo date("Y/m/d H:i:s");
echo "\n";
if(!$dbCon){
	//$err = OCIError();
	$err = ocierror();
	trigger_error('Could not establish a connection: ' . $err['message'], E_USER_ERROR);
 	echo "Connection failed.".$err['message'];
	//exit;
}else {
	//print "Connected to Oracle!";
	echo "Successfully connected to Oracle.\n";
}*/

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /*$stid = oci_parse($dbCon, "select i.iaclink_actual_acnum, 
                               p.pbdcont_cont_num,
                               p.pbdcont_ac_dep_amt,
                               to_char(p.pbdcont_eff_date,'dd-MON-yyyy'),
                               to_char(p.pbdcont_mat_date,'dd-MON-yyyy'),
                               pkg_mycdb.get_jname_array(a.acnts_client_num),
                               pkg_mycdb.get_client_comm_details2(a.acnts_client_num)
                               from pbdcontract p, iaclink i, acnts a
                               where p.pbdcont_entity_num = 1
                               and p.pbdcont_dep_ac_num = i.iaclink_internal_acnum
                               and p.pbdcont_cont_num = '".$contnum."'
                               and p.pbdcont_closure_date is null
                               and i.iaclink_entity_num = p.pbdcont_entity_num
                               and i.iaclink_internal_acnum = p.pbdcont_dep_ac_num
                               and i.iaclink_actual_acnum = '".$depnum."' 
                               and a.acnts_entity_num = 1
                               and a.acnts_internal_acnum = i.iaclink_internal_acnum ");*/
    $stid = oci_parse($dbCon,"select i.iaclink_actual_acnum, 
                               p.pbdcont_cont_num,
                               p.pbdcont_ac_dep_amt,
                               to_char(p.pbdcont_eff_date,'dd-MON-yyyy'),
                               to_char(p.pbdcont_mat_date,'dd-MON-yyyy'),
                               cdbproddb.pkg_mycdb.get_jname_array(a.acnts_client_num)
                               ,cdbproddb.pkg_mycdb.get_client_comm_details2(a.acnts_client_num)
                               from cdbproddb.pbdcontract p, cdbproddb.iaclink i, cdbproddb.acnts a
                               where p.pbdcont_entity_num = 1
                               and p.pbdcont_dep_ac_num = i.iaclink_internal_acnum
                               and p.pbdcont_cont_num = '".$contnum."'
                               /*and p.pbdcont_closure_date is null */
                               and i.iaclink_entity_num = p.pbdcont_entity_num
                               and i.iaclink_internal_acnum = p.pbdcont_dep_ac_num
                               and i.iaclink_actual_acnum = '".$depnum."' 
                               and a.acnts_entity_num = 1
                               and a.acnts_internal_acnum = i.iaclink_internal_acnum ");
    oci_execute($stid);
        ini_set('max_execution_time', 36000); //300 seconds = 5 minutes 
        echo "<table border='0' style='font-family: sans-serif; font-size: 14px;'>";
        while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) { //Read Oracle Source table
            echo "<tr><td style='width:200px;'>Deposit Number</td><td>: ".$row[0]."</td></tr>";
            echo "<tr><td style='width:200px;'>Contract Number</td><td>: ".$row[1]."</td></tr>";
            echo "<tr><td style='width:200px;'>Deposit Amount</td><td>: ".$row[2]."</td></tr>";
            echo "<tr><td style='width:200px;'>Effective Date</td><td>: ".$row[3]."</td></tr>";
            echo "<tr><td style='width:200px;'>Maturity Date</td><td>: ".$row[4]."</td></tr>";
            echo "<tr><td style='width:200px;'>Client Name</td><td>: ".$row[5]."<div style='display: none;'><input type='text' name='txtClient_Name' id='txtClient_Name' value='".$row[5]."' /></div></td></tr>";
            echo "<tr><td style='width:200px;'>Client Address</td><td>: ".$row[6]."</td></tr>";
        }
    // $stid = oci_parse($dbCon,"");
        echo "</table>";
        
        oci_free_statement($stid);
       // oci_close($dbCon);
      // $stdropdown = oci_parse($dbCon,"select cdbproddb.invtype.invtype_code, cdbproddb.invtype.invtype_descn from cdbproddb.invtype");
       //oci_execute($stdropdown);
        
       
?>

<br />
<hr/>
<div style="display: none;">
     <input type="text" name="txtdepNum" id="txtdepNum" value="<?php echo $depnum; ?>" />
     <input type="text" name="txtConNum" id="txtConNum" value="<?php echo $contnum; ?>" /> 
</div>
<table border='0' style='font-family: sans-serif; font-size: 14px;'>
<tr>
<td style='width:120px; text-align: right;'>Renewal Option</td>
<td>
<select class="box_decaretion" id="cmbOption" name="myoption" onchange="getOptgetspe()">
     <option value="redemption">Redemption</option>
     <option value="renewal in full">Renewal in full</option>
     <option value="renewal in partial">Renewal in partial</option>
     <option value="cash backed loan">Cash Backed Loan</option>
     <option value="pledge">Pledge</option>
</select>
</td>
</tr>
<tr>
<td style='width:120px; text-align: right;'>Certificate Serial Number</td>
<td>
<select class="box_decaretion" id="cmbOptionCertificate" name="cmbOptionCertificate" onchange="getOptgetspesub()" >
     <option value="Danasurakum">Danasurakum</option>
     <option value="Senior Citizens">Senior Citizens</option>
     <option value="">Other</option>
    <?php
      /*  while (($row_stdropdown = oci_fetch_array($stdropdown, OCI_BOTH)) != false) { //Read Oracle Source table
            echo "<option value='".$row_stdropdown[0]."'>".$row_stdropdown[1]."</option>";
        }*/
        oci_close($dbCon);
    ?>

</select><span style="color: #D20000;">*</span>
<input class="box_decaretion" type="text" id="txtcerNum" maxlength="10" style="width: 150;" name="txtcerNum" value="" onkeypress="return disableEnterKey(event)" onkeyup="getPrintText()" required="required" />
</td>
</tr>
<!--<tr>
<td style='width:120px; vertical-align: top; text-align: right;'>Print Text</td>
<td>
    <textarea class="box_decaretion" id="txtareaPrintText" cols="50" rows="2" maxlength="60" onkeyup="getPrintText()"></textarea>
</td>
</tr><tr>-->
<td style='width:120px;vertical-align: top;text-align: right;'>Comment <span style="color: #D20000;">*</span></td>
<td>
<textarea class="box_decaretion" id="txtareaComment" cols="50" rows="3"></textarea>
</td>
</tr>
</table>
<br />

<?php
    //$con=mysqli_connect("localhost","root","","mydb");
    $con=mysqli_connect("localhost","root","1234","cdberp");
    $result=mysqli_query($con,"SELECT prnt_serial,gen_on,gen_by,auth_on,auth_by,prnt_on,prnt_by ,`print_text`,`remarks`, `cert_type`, `cert_Number`
                         FROM print_gen WHERE dep_num = '" .$depnum. "' and cont_num = '" .$contnum."'");
    
    if(!$result){
        die(mysqli_error());
    } else{
        echo "<table border='1' cellpadding='0' cellspacing='0' style='font-family: sans-serif; font-size: 14px;margin-left: 50px;'>";
        echo "<tr>";
        echo "<th style='width:40px;'>#</th>";
        //echo "<th style='width:150px;'>Generated On</th>";
        //echo "<th style='width:100px;'>Generated By</th>";
       // echo "<th style='width:150px;'>Authorized On</th>";
        //echo "<th style='width:150px;'>Authorized By</th>";
        echo "<th style='width:150px;'>Printed On</th>";
        echo "<th style='width:100px;'>Printed By</th>";
        echo "<th style='width:150px;'>Print Text</th>";
        echo "<th style='width:250px;'>Remarks</th>";
        echo "</tr>";
        
        while ($row=mysqli_fetch_array($result)){
            echo "<tr>";
            echo "<td style='width:40px;'><span style='margin-left: 5px;'>".$row[0]."</span></td>";
            //echo "<td style='width:150px;'><span style='margin-left: 5px;'>".$row[1]."</span></td>";
           // echo "<td style='width:100px;'><span style='margin-left: 5px;'>".$row[2]."</span></td>";
            //echo "<td style='width:150px;'><span style='margin-left: 5px;'>".$row[3]."</td>";
            //echo "<td style='width:150px;'><span style='margin-left: 5px;'>".$row[4]."</td>";
            echo "<td style='width:150px;'><span style='margin-left: 5px;'>".$row[5]."</span></td>";
            echo "<td style='width:100px;'><span style='margin-left: 5px;'>".$row[6]."</span></td>";
            echo "<td style='width:150px;'><span style='margin-left: 5px;'>".$row[9]." - ".$row[10]."</span></td>";
            echo "<td style='width:250px;'><span style='margin-left: 5px;'>".$row[8]."</span></td>";
            echo "</tr>";
        }
        echo "</table>";
    }
   
?>
<br />
<input type="button" style="margin-left: 50px; width: 200px;" id="btnPrint" name="btnPrint" onclick="getprint()" value="Print" />
<br />
<div id="getNewView" style="display: none;">
<div style="width: 100%; height: 200px;">
    <div style="width: 60%; float: left; height: 100px;">
    
    </div>
    <div style="width: 40%; float: left; height: 200px; text-align: right;">
        <img style="margin-right: 20px;" src="../../../img/logo_hdr.jpg"/><br />
        <p style='font-family: sans-serif; font-size: 10px;margin-right: 40px;'>
            Citizens Development Business Finance PLC.<br />
            No 123, Orabipasha Road, Colombo 10.<br />
            Customer Care Hot Line : 011 - 7388388<br />
            E-mail : cdb@cdb.lk Web : www.cdb.lk<br />
            Fax : 011-2429888<br />
            (Company Reg. No. PB 232 PQ)
        </p>
    </div>
</div>
<div style="margin-left: 50px;">
<?php
    
    $dbCon = ora_database::connect();
    /*$stid1 = oci_parse($dbCon, "select to_char(to_date(fn_get_currbuss_date(1,'LKR')),'dd-MON-yyyy') biz_date,
                        pkg_mycdb.get_jname_array(a.acnts_client_num) cl_name,
                        pkg_mycdb.get_client_comm_details2(pkg_mycdb.GET_CLIENT_DETAILS(7,a.acnts_client_num)) cl_add,
                        i.iaclink_actual_acnum || '/' || p.pbdcont_cont_num acc_num,
                        p.pbdcont_ac_dep_amt dep_amt
                        from pbdcontract p, iaclink i, acnts a 
                        where p.pbdcont_entity_num = 1
                        and p.pbdcont_dep_ac_num = i.iaclink_internal_acnum
                        and p.pbdcont_cont_num = '8'
                        and p.pbdcont_closure_date is null
                        and i.iaclink_entity_num = p.pbdcont_entity_num
                        and i.iaclink_internal_acnum = p.pbdcont_dep_ac_num
                        and i.iaclink_actual_acnum = '001100004032340102'  
                        and a.acnts_entity_num = 1
                        and a.acnts_internal_acnum = i.iaclink_internal_acnum");*/
    $stid1 = oci_parse($dbCon, "select to_char(to_date(cdbproddb.fn_get_currbuss_date(1,'LKR')),'dd-MON-yyyy') biz_date,
                        cdbproddb.pkg_mycdb.get_jname_array(a.acnts_client_num) cl_name,
                        cdbproddb.pkg_mycdb.get_client_comm_details2(cdbproddb.pkg_mycdb.GET_CLIENT_DETAILS(7,a.acnts_client_num)) cl_add,
                        i.iaclink_actual_acnum || '/' || p.pbdcont_cont_num acc_num,
                        p.pbdcont_ac_dep_amt dep_amt
                        from cdbproddb.pbdcontract p, cdbproddb.iaclink i, cdbproddb.acnts a 
                        where p.pbdcont_entity_num = 1
                        and p.pbdcont_dep_ac_num = i.iaclink_internal_acnum
                        and p.pbdcont_cont_num = '" .$contnum."'
                        /* and p.pbdcont_closure_date is null */
                        and i.iaclink_entity_num = p.pbdcont_entity_num
                        and i.iaclink_internal_acnum = p.pbdcont_dep_ac_num
                        and i.iaclink_actual_acnum = '" .$depnum. "'  
                        and a.acnts_entity_num = 1
                        and a.acnts_internal_acnum = i.iaclink_internal_acnum");
    //echo $stid1;
    oci_execute($stid1);
    ini_set('max_execution_time', 36000); //300 seconds = 5 minutes 

    while (($row = oci_fetch_array($stid1, OCI_BOTH)) != false) { //Read Oracle Source table
        //echo "<tr><td>Deposit Number  </td><td>:</td><td>".$row[0]."</td></tr>";
        //echo "<tr><td>Contract Number </td><td>:</td><td>".$row[1]."</td></tr>";
        //echo "<tr><td>Deposit Amount  </td><td>:</td><td>".$row[2]."</td></tr>";
        //echo "<tr><td>Effective Date  </td><td>:</td><td>".$row[3]."</td></tr>";
        //echo "<tr><td>Maturity Date   </td><td>:</td><td>".$row[4]."</td></tr>";
    
    
    //echo "<tr><td></td><td>logo here</td></tr>";
    //echo "<tr><td></td><td>company address here</td></tr>";
    //echo "<tr><td></td><td>customer care line here</td></tr>";
    //echo "<tr><td></td><td>email, web here</td></tr>";
    //echo "<tr><td></td><td>fax here</td></tr>";
    //echo "<tr><td></td><td>company registration here</td></tr>";
    $sql_getUserName = "SELECT userID FROM `user` WHERE userName = '".$dif_userID."';";
    $que_getUserName = mysqli_query($con, $sql_getUserName);
    while($RES_getUsreName = mysqli_fetch_assoc($que_getUserName)){
        $isUserName = $RES_getUsreName['userID'];
    }
    
    $sql_branchName = "SELECT branchName FROM `branch` WHERE branchNumber = '".$dif_userBranch."';";
    $que_branchName = mysqli_query($con, $sql_branchName);
    while($RES_getBranch = mysqli_fetch_assoc($que_branchName)){
        $getUserBranchNAme = $RES_getBranch['branchName'];
    }
    
    echo "<table border='0' style='font-family: sans-serif; font-size: 14px;'>";
    echo "<tr><td>".$row[0]."</td></tr>";
    echo "<tr><td>&nbsp</td></tr>";
    echo "<tr><td>".$row[1]."</td></tr>";
    echo "<tr><td>".str_replace(',,',' ',$row[2])."</td></tr>";
    echo "<tr><td>&nbsp</td></tr>";
    echo "<tr><td>Dear Sir/ Madam</td></tr>";
    echo "<tr><td>&nbsp</td></tr>";
    echo "</table><br/>";
    echo "<table style='font-family: sans-serif; font-size: 14px;'>";
    echo "<tr><td style='width:200px;'>Fixed Deposit No</td><td>: ".$row[3]."</td></tr>";
     echo "<tr><td style='width:200px;'>&nbsp;</td>&nbsp;<td></td></tr>";
    echo "<tr><td style='width:200px;'>Capital Amount</td><td>: Rs. ".number_format($row[4], 2)."</td></tr>";
    echo "<tr><td>&nbsp</td></tr>";
    echo "</table>";
    echo "<p style='font-family: sans-serif; font-size: 14px;'>We hereby acknowledge the receipt of above Fixed Deposit Certificate for <span id='getspe'>redemption</span>.<br/>
    Certificate serial No : <span id='getaaaaaa'>Danasurakum </span>&nbsp;&nbsp;<span id='getPrintText'></span></p><br/><br/>";
    
    echo "<p style='font-family: sans-serif; font-size: 14px;'>Yours Faithfully,</p>";
    echo "<P style='font-family: sans-serif; font-size: 16px;'>CITIZENS DEVELOPMENT BUSINESS FINANCE PLC.</p><br/>";
    
    echo "<table border='0' style='font-family: sans-serif; font-size: 14px;'>";
    echo "<tr><td style='width:200px;'>Authorized Signature</td><td>:</td></tr>";
    echo "<tr><td style='width:200px;'>&nbsp</td><td></td></tr>";
    echo "<tr><td style='width:200px;'>Officer Name</td><td>: ".$isUserName."</td></tr>";
    echo "<tr><td style='width:200px;'>&nbsp</td><td></td></tr>";
    echo "<tr><td style='width:200px;'>Officer Code</td><td>: ".$dif_userID."</td></tr>";
    echo "<tr><td style='width:200px;'>&nbsp</td><td></td></tr>";
    echo "<tr><td style='width:200px;'>CDB Branch</td><td>: ".$getUserBranchNAme."</td></tr>";
    echo "</table>";
    }
    oci_free_statement($stid1);
    oci_close($dbCon);
    mysqli_close($con);
?>

</div>

<!--<table border=1>
<tr><td></td><td>logo here</td></tr>
<tr><td></td><td>company address here</td></tr>
<tr><td></td><td>customer care line here</td></tr>
<tr><td></td><td>email, web here</td></tr>
<tr><td></td><td>fax here</td></tr>
<tr><td></td><td>company registration here</td></tr>
<tr><td></td><td>company registration here</td></tr>
</table>-->
</div>
<!--</body>
</html>-->

 
