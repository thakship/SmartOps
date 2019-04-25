<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Card Centre Operation
Page Name		: Receive Card
Purpose			: Receive Card from com bank
Author			: Madushan Wikramaarachchi
Date & Time		: 03.10 P.M 23/06/2017
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="ccs/e/006";
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
    window.open('http://cdberp:8080/cdb/pages/CardCentreOperation/Entry/ReceiveCard.php?DispName=Receive%20Card','conectpage');
}

function ischeck(title){
    
    if(document.getElementById('chka'+title).checked == true){
         document.getElementById('idTr'+title).style.backgroundColor = "#E8E8AD";
         document.getElementById('txtCardNumber'+title).disabled = false;
    }else{
         document.getElementById('idTr'+title).style.backgroundColor = "#FFFFFF";
         document.getElementById('txtCardNumber'+title).disabled = true;
    }
       
}

function isBatchCreation(){
       var entryUser = document.getElementById('txtMyUserID').value;
        var x = document.getElementById("myTable").rows.length;
       //alert(x);
        var headerID = "";
        var cardNumber = "";
        var isRun = 1;
        for(var idCount = 1; idCount < x ; idCount++){
            if(document.getElementById('chka'+idCount).checked == true){
                headerID += document.getElementById('txtheade'+idCount).value;
                headerID += "|";
                if(document.getElementById('txtCardNumber'+idCount).value != ""){
                   cardNumber += document.getElementById('txtCardNumber'+idCount).value;
                   cardNumber += "|";
                }else{
                    isRun = 0;
                }
                
            }
        }
        //alert(headerID);
        
       if(isRun == 1){
            var r = confirm('Are you sure you want Batch Creation?')
           if (r == true){
               // alert('AAAAA');
                //alert(headerID);
                //alert(cardNumber);
                $.ajax({ 
        		  type:'POST', 
        		  data: {getReceiveHeaderID : headerID , getDebitCardNumber : cardNumber , getReceiveEntryUser : entryUser}, 
        		  url: '../CardCentreOperation_DEVELOPMENT/PHP_FUNCTION/ccs_commen_function.php', 
        		  success: function(val_retn) { 
        		      alert(val_retn); 
                      pageRef()
                    //document.getElementById('err').innerHTML = val_retn;
        		  }
    	       });
            }else{
    			//alert('BBBBB');		
            }
       }else{
            alert("Some Card Number is Missing.");
       }
}
   
function loadGraid(){
    
    var sendBranch = document.getElementById('sel_Home_Branch').value;
    alert(sendBranch);
    
	var mydata5;
	mydata5= new XMLHttpRequest();
	mydata5.onreadystatechange=function(){
		if(mydata5.readyState==4){
			document.getElementById('maneSpan').innerHTML = mydata5.responseText;
		}
	}
    
	mydata5.open('GET','ajax_ReceiveCard.php'+'?sendCBranch='+sendBranch,true);
	mydata5.send();
}

function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
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
<div>
<table>
    <tr>
        <td style="width: 160px; text-align: right;"><label class="linetop">Send Branch :</label></td>
        <td>
                <select class="box_decaretion"  style="width: 200px;" name="sel_Home_Branch" id="sel_Home_Branch" onkeypress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onchange="loadGraid();">
                <option value="">--Select Home Barnch --</option>
                <?php
                    $v_sql_Home_Branch = "SELECT DISTINCT ch.HOME_BRANCH , b.branchName
                                                FROM card_header AS ch , branch AS b
                                                WHERE ch.HOME_BRANCH = b.branchNumber AND
                                                      ch.COM_DISPATCH_ON = '0000-00-00 00:00:00' AND
                                                      ch.COM_SENT_ON != '0000-00-00 00:00:00';";
                        $que_Home_Branch = mysqli_query($conn,$v_sql_Home_Branch);
                        while($RES_Home_Branch = mysqli_fetch_array($que_Home_Branch)){
                            echo "<option value='".$RES_Home_Branch[0]."'>".$RES_Home_Branch[1]."</option>";
                        }
                ?>
                </select>
        
        </td>
    </tr>
</table>
<br />
<hr />
<span id="maneSpan"> 
<table border="1" id="myTable" cellpadding="0" cellspacing="0" style="background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;">
            <tr style="background-color: #BEBABA;">
                <td style="width:80px; text-align: right;"><span style="margin-right: 5px;">#</span></td>
                <td style="width:300px; text-align: left;"><span style="margin-left: 5px;">Client Name</span></td>
                <td style="width:100px; text-align: left;"><span style="margin-left: 5px;">NIC</span></td>
                <td style="width:75px;"></td>
                <td style="width:200px;">Card Number</td>
            </tr>
<?php
    
    $v_sql_select = "SELECT ch.HEADER_ID , ch.EMBOSSING_NAME , ch.NIC  
                        FROM card_header AS ch 
                        WHERE ch.COM_DISPATCH_ON = '0000-00-00 00:00:00' AND
                              ch.COM_SENT_ON != '0000-00-00 00:00:00';";
                                                //echo $v_sql_select;
    $v_que_select = mysqli_query($conn,$v_sql_select) or die(mysqli_error($conn));
    $index = 0;
    while($res_Select = mysqli_fetch_assoc($v_que_select)){
        $index++;
        
        /*if($res_Select['ssb_cycle'] != 0){
            $col = "#F0D7A5";
        }else{
            $col = "#FFFFFF";
        }*/
        $col = "#FFFFFF";
        echo "<tr id='idTr".$index."' style='background-color: ".$col.";'>";
        echo "<td style='width:80px; text-align: right;vertical-align: top;'><span  style='margin-right: 5px;'>".$index."</span></td>";
        echo "<td style='width:300px; text-align: left;vertical-align: top;'><span  style='margin-left: 5px;'>".$res_Select['EMBOSSING_NAME']."</span></td>";
        echo "<td style='width:100px; text-align: left;vertical-align: top;'><span  style='margin-left: 5px;'>".$res_Select['NIC']."</span></td>";
        echo "<td style='width:75px;' id = 'idTd".$index."'>";
        echo "<input style='display: none;' type='text' id='txtheade".$index."' name='txtheade".$index."' value='".$res_Select['HEADER_ID']."' onkeypress='return disableEnterKey(event);'/>";
        echo "<input type='checkbox' name='chka".$index."' id='chka".$index."' title='".$index."' onclick='ischeck(title);'/>";
        echo "</td>";
        echo "<td style='width:200px;'>";
        echo "<input style='width:200px;' type='text' id='txtCardNumber".$index."' name='txtCardNumber".$index."' value='' onkeypress='return isNumber(event);'   disabled='disabled'/>";
        echo "</td>";
        echo "</tr>";
    }
?>
</table>
</span>
<br /><hr />
<input class="buttonManage" style="width: 100px;" type="button" name="btnRequest" id="btnRequest" value="Request" onclick="isBatchCreation();"/>
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