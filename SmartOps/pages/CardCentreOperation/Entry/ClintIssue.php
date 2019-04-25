<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Card Centre Operation
Page Name		: Clint Issue
Purpose			: card Issue for customer
Author			: Madushan Wikramaarachchi
Date & Time		: 03.10 P.M 23/06/2017
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="ccs/e/008";
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
  #outer{
		visibility: hidden;
		position: fixed;
		left: 0px;
		top:0px;
		width: 100%;
		height: 100%;
		background: #6DA6E4;
		opacity: 0.7;
	}
	#conten{
		position: fixed;
		margin-top:-150px;
		margin-left: -200px;
		top:50%;
		left:50%;
		visibility: hidden;
		background: #ffffff;
		z-index: 5;
		height:300px;
		border:#000000 solid 1px;
	}
    
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
     window.open('http://cdberp:8080/cdb/pages/CardCentreOperation/Entry/ClintIssue.php?DispName=Clint%20Issue%20-%20Card','conectpage');
   }
   function isApprove(title){
        var resTitle = title.split("|");
        document.getElementById('idTr'+resTitle[0]).style.backgroundColor = "#E8E8AD";
        var v_srting =  "I|"+resTitle[1]+"|Are you sure you want to Issue Card?";
        popup(1,v_srting);
   }
   
   
    function popup(x,title){
           // alert(x);
            //alert(title);
        if(x==1){ 
    		    //alert('a');
    			var mydataGried;
    			mydataGried= new XMLHttpRequest();
    			mydataGried.onreadystatechange=function(){
    				if(mydataGried.readyState==4){
    				    //alert('b');
    					document.getElementById('getGried').innerHTML = mydataGried.responseText;  
    					document.getElementById('outer').style.visibility = "visible";
    					document.getElementById('conten').style.visibility = "visible";           
    				}
    			}
    			mydataGried.open("GET","ajax_Gried.php"+"?get_Approve="+x+"&get_function="+title,true);
    			mydataGried.send();
    			document.getElementById('outer').style.visibility = "visible";
    			document.getElementById('conten').style.visibility = "visible";
    		
    	  }else{
    		document.getElementById('outer').style.visibility = "hidden";
    		document.getElementById('conten').style.visibility = "hidden";
    	  }	
    }

    function isSolution(title){
        //alert(title);
        var arrTitle = title.split("|");
        //alert(arrTitle[0]);
        //alert(arrTitle[1]);
        var entryUserId = document.getElementById('txtMyUserID').value;
         var txtComment = document.getElementById('txtComment').value;
        if(txtComment != ""){
            $.ajax({ 
        		type:'POST', 
        		data: {getSolutionType : arrTitle[0] , getRequestId : arrTitle[1] , getComment : txtComment , getEntryUserId : entryUserId }, 
        		url: '../CardCentreOperation_DEVELOPMENT/PHP_FUNCTION/ccs_commen_function.php', 
        		success: function(val_retn) { 
        		    alert(val_retn); 
                    pageRef();
                    //document.getElementById('err').innerHTML = val_retn;
        		}
    	   });
        }else{
            alert('Missing Remark.');
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
<div>
<span id="maneSpan"> 
<table border="1" id="myTable" cellpadding="0" cellspacing="0" style="background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;">
            <tr style="background-color: #BEBABA;">
                <td style="width:80px; text-align: right;"><span style="margin-right: 5px;">#</span></td>
                <td style="width:300px; text-align: left;"><span style="margin-left: 5px;">Client Name</span></td>
                <td style="width:100px; text-align: left;"><span style="margin-left: 5px;">NIC</span></td>
                <td style="width:75px;"></td>
            </tr>
<?php
    
    $v_sql_select = "SELECT ch.HEADER_ID , ch.EMBOSSING_NAME , ch.NIC
                        FROM card_header AS ch 
                        WHERE ch.BRANCH_RECEIVE_ON != '0000-00-00 00:00:00' AND
                              ch.CLIENT_ISS_ON = '0000-00-00 00:00:00' AND 
                              ch.COLLECTING_BRANCH = '".$_SESSION['userBranch']."';";
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
        echo "<a class='isLinkApprove' href='#' title='".$index."|".$res_Select['HEADER_ID']."' onclick='isApprove(title);'>Update</a> ";
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