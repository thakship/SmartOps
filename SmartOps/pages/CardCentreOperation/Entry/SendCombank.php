<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Card Centre Operation
Page Name		: Send Com bank
Purpose			: gen excel for Send Com bank
Author			: Madushan Wikramaarachchi
Date & Time		: 03.10 P.M 23/06/2017
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="ccs/e/005";
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
    include('../CardCentreOperation_DEVELOPMENT/PHP_FUNCTION/ccs_commen_function.php');
    
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Card Centre Operation</title>
<!-- Common function Libariries -->
<!-- CSS-->
    <link rel="stylesheet" type="text/css" href="../../../CSS/globleCSS.css"/>
    <link rel="stylesheet" type="text/css" href="../CardCentreOperation_DEVELOPMENT/CSS/CardCentreOperation_Style_Sheet.css" />
<!--Javascript-->
<script src="../../../js/commenfunction.js"></script>
<script src="../CardCentreOperation_DEVELOPMENT/JAVASCRIPT_FUNCTION/CardCentreOperation_JavaScript.js"></script>
<!--END Common fumction Libariries-->
<link rel="stylesheet" href="jquery/jquery-ui.css" />
<script src=" jquery/jquery-1.9.1.js"></script>
<script src="jquery/jquery-ui.js"></script>
<script src="jquery.btechco.excelexport.js"></script>
<script src="jquery.base64.js"></script>
<script type="text/javascript">
   function pageRef(){
     window.open('http://cdberp:8080/cdb/pages/CardCentreOperation/Entry/SendCombank.php?DispName=Send%20Combank%20Load','conectpage');
   }
   function isGenerate(){
        var batchNumber = document.getElementById('sel_Select_Batch').value;
        var genUser = document.getElementById('txtMyUserID').value;
        if(batchNumber != ""){
            var mydata;
            mydata= new XMLHttpRequest();
            mydata.onreadystatechange=function(){
                if(mydata.readyState==4){
                    document.getElementById('genGrid').innerHTML = mydata.responseText;   
                    document.getElementById('btnExport').disabled = false;  
                    $.ajax({ 
            		  type:'POST', 
            		  data: {getComBatch : batchNumber , getComEntryUser : genUser}, 
            		  url: '../CardCentreOperation_DEVELOPMENT/PHP_FUNCTION/ccs_commen_function.php', 
            		  success: function(val_retn) { 
            		      alert(val_retn); 
                        //document.getElementById('err').innerHTML = val_retn;
            		  }
        	       });
                }
            }
            mydata.open("GET","ajax_sendCombank.php"+"?getBatchNumber="+batchNumber+"&genUser="+genUser,true);
            mydata.send();
        }else{
            alert('Missing Batch Number.');
            document.getElementById('btnExport').disabled = true;
        }
   }
</script>
<script>
    $(document).ready(function () {
        $("#btnExport").click(function () {
            $("#myTable").btechco_excelexport({
                //alert('Table');
                containerid: "myTable"
               , datatype: $datatype.Table
            });
        });
    });
</script>

</head>
<body oncontextmenu="return false">
<form action="" method="post" name="schform"  enctype="multipart/form-data"> 
<p class="topline">
<?php 
	echo $_REQUEST['DispName'];
?>
</p><hr/>
<div>
<table>
    <tr>
        <td style="width: 160px; text-align: right;"><label class="linetop">Select Batch :</label></td>
        <td>
            <select class="box_decaretion"  style="width: 200px;" name="sel_Select_Batch" id="sel_Select_Batch" onkeypress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)">
            <option value="">--Select Select Batch --</option>
            <?php
                $sql_SelectBatch = "SELECT cb.BATCH_ID FROM  card_batch_header AS cb WHERE cb.BATCH_STATS = 2 AND cb.NUM_ACCS > 0;";
                $que_SelectBatch = mysqli_query($conn,$sql_SelectBatch);
                while($RES_SelectBatch = mysqli_fetch_array($que_SelectBatch)){
                    echo "<option value='".$RES_SelectBatch[0]."'>".$RES_SelectBatch[0]."</option>";
                }
            ?>
            </select> 
        </td>
    </tr>
</table>
<br /><hr />
<input class="buttonManage" style="width: 100px;" type="button" name="btnGenerate" id="btnGenerate" value="Generate" onclick="isGenerate();"/>
 <input class="buttonManage" type="button" style="width: 100px;"  value="Excel" name="btnExport" id="btnExport" disabled="disabled" />
<input class="buttonManage" style="width: 100px;" type="button" name="btnClose" id="btnClose" value="Close" onclick="pageClose();"/>
</div>
<div style="display: none;">
    <input type="text" id="txtMyUserID" name="txtMyUserID" value="<?php echo $_SESSION['user']; ?>" onkeypress="return disableEnterKey(event)" />
    <input type="text" id="txtMyUserGroup" name="txtMyUserGroup" value="<?php echo $_SESSION['usergroupNumber']; ?>" onkeypress="return disableEnterKey(event)" />
</div>
<div id="err"></div>
<div id="genGrid"></div>
</form>
</body>
</html>