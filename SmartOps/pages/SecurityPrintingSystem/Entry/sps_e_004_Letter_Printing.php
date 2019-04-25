<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Security Printing System
Page Name		: Letter Printing
Purpose			: This process prints Renewal Letters for fully authorized batches in the LET_GEN table. Only if all the entries in a particular batch have been authorized by required number of signatories (required number of signatories are defined in the parameter level), that batch will be presented for printing.
Author			: Madushan Wikramaarachchi
Date & Time		: 02.56 P.M 07/05/2015
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="sps/e/004";
	include('../../pageasses.php');
	//echo $_SESSION['usergroupNumber'];
	$ass = cakepageaccess();
	//echo $ass;
	if($ass != 1){
		header('Location:../../home.php');
	}
	include('../../../php_con/includes/db.ini.php');
	include('../../../php_con/includes/Common.php');
	include('../../loguser.php');
    include('../SPS_DEVELOPMENT/PHP_FUNCTION/SPS_php_function.php');
	//include('ajax_Gried.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Letter Printing</title>
<!-- Common function Libariries -->
<!-- CSS-->
    <link rel="stylesheet" type="text/css" href="../../../CSS/globleCSS.css"/>
    <link rel="stylesheet" type="text/css" href="../SPS_DEVELOPMENT/SPS_Style_Sheet.css" />
<style type="text/css">
	
</style>
<!--Javascript-->
<script src="../../../js/commenfunction.js"></script>
<script src="../SPS_DEVELOPMENT/SPS_js_function.js"></script>
<!--END Common fumction Libariries-->
<link rel="stylesheet" href="jquery/jquery-ui.css" />
<script src=" jquery/jquery-1.9.1.js"></script>
<script src="jquery/jquery-ui.js"></script>
<script type="text/javascript">
   function isChangeRowColoerOver(title){
        document.getElementById('tr'+title).style.backgroundColor = "#FDEEEE";
    }
    
    function isChangeRowColoerDown(title){
        document.getElementById('tr'+title).style.backgroundColor = "#FFFFFF";
    }
    
    function loadNewTable(title){
        //alert(title);
        var letter_T = document.getElementById('txta'+title).value;
        var batch_N = document.getElementById('txtb'+title).value;
        document.getElementById('txt_Letter_Type_Code').value = letter_T;
        document.getElementById('txt_Batch_Number').value = batch_N;
    }
    
    function getPrint(){
        var val_letter_type_code = document.getElementById('txt_Letter_Type_Code').value;
        var val_batch_number = document.getElementById('txt_Batch_Number').value;
        var val_Remarks = document.getElementById('txt_Remarks').value;
        var val_user = document.getElementById('txtMyUserID').value;
        if(val_letter_type_code == ""){
            alert('Missing Letter Type.');
            document.getElementById('dis_ltc').style.display = "inline" ;
            
        }else if(val_batch_number == ""){
            alert('Missing Batch Number.');
            document.getElementById('dis_bn').style.display = "inline" ;
        }else if(val_Remarks == ""){
            alert('Missing Remarks.');
            document.getElementById('dis_Remarks').style.display = "inline" ; 
        }else if(val_user == ""){
            alert('Undefined User.');
        }else{
            var mydata1;
			mydata1 = new XMLHttpRequest();
			mydata1.onreadystatechange=function(){
				if(mydata1.readyState==4){
					document.getElementById('display_letter').innerHTML = mydata1.responseText;
                    var prtContent = document.getElementById("display_letter");
        			var WinPrint = window.open('', '', 'letf=0,top=0,width=1150,height=500,toolbar=0,scrollbars=0,status=0');
        			WinPrint.document.write(prtContent.innerHTML);
        			WinPrint.document.close();
        			WinPrint.focus();
        			WinPrint.print();
        			WinPrint.close();
                    pageClose();
                    
				}
			}
			//var sub1=document.getElementById('selectCodeDoc').value;
			mydata1.open("GET","ajax_letter_print.php"+"?get_letter_type_code="+val_letter_type_code+"&get_batch_number="+val_batch_number+"&get_Remarks="+val_Remarks+"&get_user="+val_user,true);
			mydata1.send();
        }
        
    }
    function getprintCopy(){
		var prtContent = document.getElementById("display_letter");
		var WinPrint = window.open('', '', 'letf=0,top=0,width=1150,height=500,toolbar=0,scrollbars=0,status=0');
		WinPrint.document.write(prtContent.innerHTML);
		WinPrint.document.close();
		WinPrint.focus();
		WinPrint.print();
		WinPrint.close();
    }
    function loadNewTablegired(title){
        var var_txttypea = document.getElementById('txttypea'+title).value;
        var vae_txtMyUserID = document.getElementById('txtMyUserID').value;
        var vae_txtMyUserGroup = document.getElementById('txtMyUserGroup').value;
        //alert(var_txttypea);
        //alert(vae_txtMyUserID);
        mydata2 = new XMLHttpRequest();
        mydata2.onreadystatechange=function(){
            if(mydata2.readyState==4){
                document.getElementById('getAch_gried').innerHTML=mydata2.responseText;           
            }
        }
        if(var_txttypea == "RLET"){
            mydata2.open("GET","ajax_get_grid.php"+"?get_vae_txtMyUserID="+vae_txtMyUserID+"&get_vae_txtMyUserGroup="+vae_txtMyUserGroup,true);
        }else if(var_txttypea == "LEPO3W" || var_txttypea == "LEPOGE" || var_txttypea == "HPPO3W" || var_txttypea == "HPPOGE" || var_txttypea == "MOPOLE" || var_txttypea == "UCLEPO" || var_txttypea == "MPOMB"){
            mydata2.open("GET","ajax_get_grid.php"+"?get_txttypeapo="+var_txttypea+"&gettxtMyUserID="+vae_txtMyUserID+"&getvar_txttypea="+var_txttypea,true);
        }else if(var_txttypea == "BALCON"){
            //alert(var_txttypea+" "+vae_txtMyUserID+" "+vae_txtMyUserGroup);
            mydata2.open("GET","ajax_get_grid.php"+"?get_txttypeaBC="+var_txttypea+"&gettxtMyUserBC="+vae_txtMyUserID,true);
        }else if(var_txttypea == "COND" || var_txttypea == "CBL05" || var_txttypea == "COND2" ){
            //alert(var_txttypea+" "+vae_txtMyUserID+" "+vae_txtMyUserGroup);
            mydata2.open("GET","ajax_get_grid.php"+"?getLetType="+var_txttypea+"&getEntryUser="+vae_txtMyUserID,true);
        }else{
            //mydata2.open("GET","ajax_get_grid.php"+"?get_txttypea="+var_txttypea,true);
        }
        
        mydata2.send();
        
    }
    
    function get_PO_print(title){
        alert(title);
        var res = title.split('|');
        //alert(res[0]);
        //alert(res[1]);
        var v_user = document.getElementById('txtMyUserID').value;
        mydata2 = new XMLHttpRequest();
        mydata2.onreadystatechange=function(){
            if(mydata2.readyState==4){
                document.getElementById('display_letter').innerHTML=mydata2.responseText;   
                var prtContent = document.getElementById("display_letter");
    			var WinPrint = window.open('', '', 'letf=0,top=0,width=1150,height=500,toolbar=0,scrollbars=0,status=0');
    			WinPrint.document.write(prtContent.innerHTML);
    			WinPrint.document.close();
    			WinPrint.focus();
    			WinPrint.print();
    			WinPrint.close();
                pageClose();   
                    
            }
        }
        mydata2.open("GET","ajax_get_grid.php"+"?get_fac_num_print_OP="+res[0]+"&get_Sys_num_po="+res[1]+"&get_v_user_print="+v_user+"&get_v_type="+res[2],true);
        mydata2.send();
    }
    
    function get_supAger_print(title){
        var res = title.split('|');
        //alert(res[0]);
        //alert(res[1]);
        var v_user = document.getElementById('txtMyUserID').value;
        mydata2 = new XMLHttpRequest();
        mydata2.onreadystatechange=function(){
            if(mydata2.readyState==4){
                document.getElementById('display_letter').innerHTML=mydata2.responseText;   
                var prtContent = document.getElementById("display_letter");
    			var WinPrint = window.open('', '', 'letf=0,top=0,width=1150,height=500,toolbar=0,scrollbars=0,status=0');
    			WinPrint.document.write(prtContent.innerHTML);
    			WinPrint.document.close();
    			WinPrint.focus();
    			WinPrint.print();
    			WinPrint.close();
                pageClose();   
                    
            }
        }
        mydata2.open("GET","ajax_get_grid.php"+"?get_fac_num_print_supAger="+res[0]+"&get_Sys_num_supAger="+res[1]+"&get_v_user_print_supAger="+v_user+"&get_v_type_supAger="+res[2],true);
        mydata2.send();
    }
    
    function get_Mortgage_print(title){
        alert(title);
         var res = title.split('|');
        //alert(res[0]);
        //alert(res[1]);
        var v_user = document.getElementById('txtMyUserID').value;
        mydata2 = new XMLHttpRequest();
        mydata2.onreadystatechange=function(){
            if(mydata2.readyState==4){
                document.getElementById('display_letter').innerHTML=mydata2.responseText;   
                var prtContent = document.getElementById("display_letter");
    			var WinPrint = window.open('', '', 'letf=0,top=0,width=1150,height=500,toolbar=0,scrollbars=0,status=0');
    			WinPrint.document.write(prtContent.innerHTML);
    			WinPrint.document.close();
    			WinPrint.focus();
    			WinPrint.print();
    			WinPrint.close();
                pageClose();   
                    
            }
        }
        mydata2.open("GET","ajax_get_grid.php"+"?get_fac_num_print_Mortgage="+res[0]+"&get_Sys_num_Mortgage="+res[1]+"&get_v_user_print_Mortgage="+v_user+"&get_v_type_Mortgage="+res[2],true);
        mydata2.send();
    }
    
    function get_Murabahah_Mortgage_print(title){
       // alert(title);
         var res = title.split('|');
        //alert(res[0]);
        //alert(res[1]);
        var v_user = document.getElementById('txtMyUserID').value;
        mydata2 = new XMLHttpRequest();
        mydata2.onreadystatechange=function(){
            if(mydata2.readyState==4){
                document.getElementById('display_letter').innerHTML=mydata2.responseText;   
                var prtContent = document.getElementById("display_letter");
    			var WinPrint = window.open('', '', 'letf=0,top=0,width=1150,height=500,toolbar=0,scrollbars=0,status=0');
    			WinPrint.document.write(prtContent.innerHTML);
    			WinPrint.document.close();
    			WinPrint.focus();
    			WinPrint.print();
    			WinPrint.close();
                pageClose();   
                    
            }
        }
        mydata2.open("GET","ajax_get_grid.php"+"?get_fac_num_print_MURA_Mortgage="+res[0]+"&get_Sys_num_MURA_Mortgage="+res[1]+"&get_v_user_print_MURA_Mortgage="+v_user+"&get_v_type_MURA_Mortgage="+res[2],true);
        mydata2.send();
    }
    
    function get_BC_print(title){
        //alert(title);
         var res = title.split('|');
        //alert(res[0]);
        //alert(res[1]);
        var v_user = document.getElementById('txtMyUserID').value;
        //alert(v_user);
        mydata2 = new XMLHttpRequest();
        mydata2.onreadystatechange=function(){
            if(mydata2.readyState==4){
                document.getElementById('display_letter').innerHTML = mydata2.responseText;   
                var prtContent = document.getElementById("display_letter");
    			var WinPrint = window.open('', '', 'letf=0,top=0,width=1150,height=500,toolbar=0,scrollbars=0,status=0');
    			WinPrint.document.write(prtContent.innerHTML);
    			WinPrint.document.close();
    			WinPrint.focus();
    			WinPrint.print();
    			WinPrint.close();
                pageClose();   
                    
            }
        }
        mydata2.open("GET","ajax_get_grid.php"+"?get_index_BC="+res[1]+"&get_clint_code_bc="+res[0]+"&get_v_user_print_BC="+v_user+"&get_v_type_BC="+res[2],true);
        mydata2.send();
    }
    //-- Madushan 2018-01-26 Cooment Print --- -------------------------------------------
    function getLetterPrint(title){
        //alert(title);
         var res = title.split('|');
        //alert(res[0]);
        //alert(res[1]);
       // var v_user = document.getElementById('txtMyUserID').value;
        //alert(v_user);
        mydata2 = new XMLHttpRequest();
        mydata2.onreadystatechange=function(){
            if(mydata2.readyState==4){
                document.getElementById('display_letter').innerHTML = mydata2.responseText;   
                var prtContent = document.getElementById("display_letter");
    			var WinPrint = window.open('', '', 'letf=0,top=0,width=1150,height=500,toolbar=0,scrollbars=0,status=0');
    			WinPrint.document.write(prtContent.innerHTML);
    			WinPrint.document.close();
    			WinPrint.focus();
    			WinPrint.print();
    			WinPrint.close();
                pageClose();   
                    
            }
        }
        mydata2.open("GET","ajax_get_grid.php"+"?get_LetterType_Print="+res[0]+"&get_Index_Print="+res[1]+"&get_Print_User="+res[2],true);
        mydata2.send();
    }
</script>


</head>
<body oncontextmenu="return false">
<form action="" method="post" name="schform"  enctype="multipart/form-data"> 
<p class="topline">
<?php 
	echo $_REQUEST['DispName'];
?>
</p><hr/>
<div id="getAch_gried">
<table border='1' cellpadding='0' cellspacing='0'  id='myTable' style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;margin-left: 50px;'>
   	    <tr style='background-color: #BEBABA; '>
            <td style='width:150px; text-align: left;'><span style='margin-left: 5px;'>Letter Code</span></td>
            <td style='width:250px; text-align: left;'><span style='margin-left: 5px;'>Letter Type</span></td>
            <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'></span></td>
        </tr>
        <?php
            $sql_select_type = "SELECT `TYPE_CODE`,`TYPE_DESC` FROM `sps_let_types`;";
            $que_select_type = mysqli_query($conn,$sql_select_type) or die(mysqli_error());
            $v = 0;
            while($rec_select_type = mysqli_fetch_assoc($que_select_type)){
                $v++;
               echo "<tr style='background-color: #FFFFFF;' title='".$v."' onclick='loadNewTablegired(title);'>";
               echo "<td style='width:150px; text-align: left;'><span style='margin-left: 5px;'>".$rec_select_type['TYPE_CODE']."</span><span style='display: none;'><input type='text' name='txttypea".$v."' id='txttypea".$v."' value='".$rec_select_type['TYPE_CODE']."' onkeypress='return disableEnterKey(event)' readonly='readonly' /></span></td>
            <td style='width:250px; text-align: left;'><span style='margin-left: 5px;'>".$rec_select_type['TYPE_DESC']."</span><span style='display: none;'><input type='text' name='txttypeb".$v."' id='txttypeb".$v."' value='".$rec_select_type['TYPE_DESC']."' onkeypress='return disableEnterKey(event)' readonly='readonly' /></span></td>
            <td style='width:100px; text-align: left;'><input class='buttonManage' style='width: 100px;' title='".$v."' type='button' name='btnClose1' id='btnClose1' value='Select' onclick='loadNewTablegired(title);'/></td>
        </tr> "; 
            }
            
        ?>
</table>
<br /><hr />
<input class="buttonManage" style="width: 100px;" type="button" name="btnClose" id="btnClose" value="Close" onclick="pageClose();"/>
</div>
<div style="display: none;">
    <input type="text" id="txtMyUserID" name="txtMyUserID" value="<?php echo $_SESSION['user']; ?>" onkeypress="return disableEnterKey(event)" />
    <input type="text" id="txtMyUserGroup" name="txtMyUserGroup" value="<?php echo $_SESSION['usergroupNumber']; ?>" onkeypress="return disableEnterKey(event)" />
</div>

</form>
</body>
</html>