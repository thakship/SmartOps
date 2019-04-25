<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Card Centre Operation
Page Name		: Card Send Branch
Purpose			: Send Branch for card
Author			: Madushan Wikramaarachchi
Date & Time		: 03.10 P.M 23/06/2017
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="ccs/e/007";
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
<title>Card Send Branch</title>
<!-- Common function Libariries -->
<!-- CSS-->
    <link rel="stylesheet" type="text/css" href="../../../CSS/globleCSS.css"/>
    <link rel="stylesheet" type="text/css" href="../CardCentreOperation_DEVELOPMENT/CSS/CardCentreOperation_Style_Sheet.css" />
<style type="text/css">
    .isLinkApprove{
        color: #67B4D8;
    }
    .isLinkPending{
        color: #396C13;
    }
    .isLinkReject{
        color: #A60000;
    }
</style>
<!--Javascript-->
<script src="../../../js/commenfunction.js"></script>
<script src="../CardCentreOperation_DEVELOPMENT/JAVASCRIPT_FUNCTION/CardCentreOperation_JavaScript.js"></script>
<!--END Common fumction Libariries-->
<link rel="stylesheet" href="jquery/jquery-ui.css" />
<script src=" jquery/jquery-1.9.1.js"></script>
<script src="jquery/jquery-ui.js"></script>
<script type="text/javascript">
   function pageRef(){
     window.open('http://cdberp:8080/cdb/pages/CardCentreOperation/Entry/CardSendBranch.php?DispName=Card%20Send%20Branch','conectpage');
   }
   function isSelect(title){
        //alert(title);
        if(title != ""){
            var mydata;
            mydata= new XMLHttpRequest();
            mydata.onreadystatechange=function(){
                if(mydata.readyState==4){
                    document.getElementById('maneSpan').innerHTML = mydata.responseText;    
                }
            }
            mydata.open("GET","ajax_cardSendBranch.php"+"?selectBranch="+title,true);
            mydata.send();
        }else{
            alert('Missing Branch.');
        }
   }
   function ischeck(title){
        
        if(document.getElementById('chka'+title).checked == true)
            document.getElementById('idTr'+title).style.backgroundColor = "#E8E8AD";
        else
            document.getElementById('idTr'+title).style.backgroundColor = "#FFFFFF";
   }
   
   function isBatchCreation(title){
       var entryUser = document.getElementById('txtMyUserID').value;
       var x = document.getElementById("myTable").rows.length;
       // alert(x);
        var headerID = "";
        for(var idCount = 1; idCount < x ; idCount++){
            if(document.getElementById('chka'+idCount).checked == true){
                headerID += document.getElementById('txtheade'+idCount).value;
                headerID += "|";
            }
        }
       //alert(entryUser);
       //alert(headerID);
       //alert(title);
        var r = confirm('Are you sure you want send Banch this Debit Card?')
       if (r==true){
            $.ajax({ 
    		  type:'POST', 
    		  data: {getSendBranchString : headerID , sendBranch : title,getSendBranchentryUser : entryUser}, 
    		  url: '../CardCentreOperation_DEVELOPMENT/PHP_FUNCTION/ccs_commen_function.php', 
    		  success: function(val_retn) { 
    		      alert(val_retn); 
                  pageRef();
               // document.getElementById('err').innerHTML = val_retn;
    		  }
	       });
        }else{
			//alert('BBBBB');		
        }
        
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
<span id="maneSpan"> 
<table border="1" id="myTable" cellpadding="0" cellspacing="0" style="background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;">
            <tr style="background-color: #BEBABA;">
                <td style="width:80px; text-align: right;"><span style="margin-right: 5px;">#</span></td>
                <td style="width:300px; text-align: left;"><span style="margin-left: 5px;">Branch</span></td>
                <td style="width:100px; text-align: left;"><span style="margin-left: 5px;">Count</span></td>
                <td style="width:75px;"></td>
            </tr>
<?php
    
    $v_sql_select = "SELECT ch.COLLECTING_BRANCH , b.branchName , COUNT(*)
                             FROM card_header AS ch , branch AS b
                             WHERE ch.COLLECTING_BRANCH = b.branchNumber AND
                                   ch.COM_DISPATCH_ON != '0000-00-00 00:00:00' AND
                                    ch.BRANCH_SENT_ON = '0000-00-00 00:00:00'
                    		GROUP BY  ch.COLLECTING_BRANCH;";
                        //echo $v_sql_select;
    $v_que_select = mysqli_query($conn,$v_sql_select) or die(mysqli_error($conn));
    $index = 0;
    while($res_Select = mysqli_fetch_array($v_que_select)){
        $index++;
        
        $col = "#FFFFFF";
        echo "<tr id='idTr".$index."' style='background-color: ".$col.";'>";
        echo "<td style='width:80px; text-align: right;vertical-align: top;'><span  style='margin-right: 5px;'>".$index."</span></td>";
        echo "<td style='width:300px; text-align: left;vertical-align: top;'><span  style='margin-left: 5px;'>".$res_Select[1]."</span></td>";
        echo "<td style='width:100px; text-align: left;vertical-align: top;'><span  style='margin-left: 5px;'>".$res_Select[2]."</span></td>";
        echo "<td style='width:75px;' id = 'idTd".$index."'>";
        echo "<a class='isLinkApprove' href='#' title='".$res_Select[0]."' onclick='isSelect(title);'>Select</a> ";
        echo "</td>";
        echo "</tr>";
    }
?>
</table>
</span>
<br /><hr />

<input class="buttonManage" style="width: 100px;" type="button" name="btnClose" id="btnClose" value="Close" onclick="pageClose();"/>
</div>
<div style="display: none;">
    <input type="text" id="txtMyUserID" name="txtMyUserID" value="<?php echo $_SESSION['user']; ?>" onkeypress="return disableEnterKey(event)" />
    <input type="text" id="txtMyUserGroup" name="txtMyUserGroup" value="<?php echo $_SESSION['usergroupNumber']; ?>" onkeypress="return disableEnterKey(event)" />
</div>
<div id="err"></div>
<div id="getGried"></div>
</form>
</body>
</html>