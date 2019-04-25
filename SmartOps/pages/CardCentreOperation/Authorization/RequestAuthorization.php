<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Card Centre Operation
Page Name		: Request Authorization 
Purpose			: Debit Card Request Authorization  
Author			: Madushan Wikramaarachchi
Date & Time		: 01.22 P.M 23/06/2017
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="ccs/a/001";
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
    
    
 /* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
    background-color: #fefefe;
    margin: auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
}

/* The Close Button */
.close {
    color: #aaaaaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
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
     window.open('http://cdberp:8080/cdb/pages/CardCentreOperation/Authorization/RequestAuthorization.php?DispName=Request%20Authorization','conectpage');
   }
function isApprove(title){
    //alert("A");
    var resTitle = title.split("|");
    document.getElementById('idTr'+resTitle[0]).style.backgroundColor = "#E8E8AD";
    var v_srting =  "A|"+resTitle[1]+"|Are you sure you want to Approve this?";
    popup(1,v_srting);
    
}

function isReject(title){
   // alert("R");
    var resTitle = title.split("|");
    document.getElementById('idTr'+resTitle[0]).style.backgroundColor = "#E8E8AD";
    var v_srting =  "R|"+resTitle[1]+"|Are you sure you want to Reject this?";
    popup(1,v_srting);
}
function isPending(title){
    //alert('P');
   // alert(title);
    var resTitle = title.split("|");
    document.getElementById('idTr'+resTitle[0]).style.backgroundColor = "#E8E8AD";
    var v_srting =  "P|"+resTitle[1]+"|Are you sure you want to Pending Notified this?";
    popup(1,v_srting);
}

function getDtl(title){
    //alert(title);
    var modal = document.getElementById('myModal');
    modal.style.display = "block";
    
    //getAuthDtl
    var mydataGried;
	mydataGried= new XMLHttpRequest();
	mydataGried.onreadystatechange=function(){
		if(mydataGried.readyState==4){
		    //alert('b');
			document.getElementById('getAuthDtl').innerHTML = mydataGried.responseText;      
		}
	}
	mydataGried.open("GET","../CardCentreOperation_DEVELOPMENT/PHP_FUNCTION/ccs_commen_ajax.php"+"?get_herdIDDtl="+title,true);
	mydataGried.send();
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

function closeBtn(){
    var modal = document.getElementById('myModal');
    modal.style.display = "none";
}
</script>

<script>
    var metaChar = false;
    function keyEvent(event) {
        var key = event.keyCode || event.which;
       // alert("Key pressed " + key);
    if(key == 112){ // F1 Key
        //alert("Key pressed " + key);
       var mydataNew;
		mydataNew= new XMLHttpRequest();
		mydataNew.onreadystatechange=function(){
			if(mydataNew.readyState==4){
				document.getElementById('maneSpan').innerHTML=mydataNew.responseText;
			}
		}
		mydataNew.open('GET','ajax_Gried.php'+'?AUTH_GRIED='+1,true);
		mydataNew.send();
    }else if(key == 113){ // F2 Key
        //alert("Key pressed " + key);
       var mydataNew;
		mydataNew= new XMLHttpRequest();
		mydataNew.onreadystatechange=function(){
			if(mydataNew.readyState==4){
				document.getElementById('maneSpan').innerHTML=mydataNew.responseText;
			}
		}
		mydataNew.open('GET','ajax_Gried.php'+'?AUTH_GRIED='+2,true);
		mydataNew.send();
    }else{
        
    }
}
</script>
</head>
<body oncontextmenu="return false" onkeydown="keyEvent(event)" onkeyup="metaKeyUp(event)">
<form action="" method="post" name="schform"  enctype="multipart/form-data"> 
<p class="topline">
<?php 
	echo $_REQUEST['DispName'];
?>
</p><hr/>
<div>
<label class="linetop" style="font-weight: bold;">F1 : 501 , F2 : Other</label><br /><br />
<span id="maneSpan"> 
<table border="1" id="myTable" cellpadding="0" cellspacing="0" style="background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;">
            <tr style="background-color: #BEBABA;">
                <td style="width:80px; text-align: right;"><span style="margin-right: 5px;">#</span></td>
                <td style="width:300px; text-align: left;"><span style="margin-left: 5px;">Client Name</span></td>
                <td style="width:100px; text-align: left;"><span style="margin-left: 5px;">NIC</span></td>
                <td style="width:50px; text-align: left;"><span style="margin-left: 5px;">ACC FREES</span></td>
                <td style="width:50px; text-align: left;"><span style="margin-left: 5px;">ACC INOPE.</span></td>
                <td style="width:50px; text-align: left;"><span style="margin-left: 5px;">ACC AVLBLE</span></td>
                <td style="width:150px;"></td>
            </tr>
<?php
    
    $v_sql_select = "SELECT u.HEADER_ID , u.EMBOSSING_NAME , u.NIC , u.ACC_FREES , u.ACC_INOPERATIVE , u.ACC_AVLBLE , u.ACCOUNT_NO_1 
                       FROM  card_header AS u 
                      WHERE u.AUTH_ON = '0000-00-00 00:00:00' AND (u.AUTH_STATUS = 0 OR u.AUTH_STATUS = 3);";
                        //echo $v_sql_select;
    $v_que_select = mysqli_query($conn,$v_sql_select) or die(mysqli_error($conn));
    $index = 0;
    while($res_Select = mysqli_fetch_assoc($v_que_select)){
        $index++;
        $ACCOUNT_NO_1 = $res_Select['ACCOUNT_NO_1'];
        $Product_code = substr($ACCOUNT_NO_1,-4);
        /*if($res_Select['ssb_cycle'] != 0){
            $col = "#F0D7A5";
        }else{
            $col = "#FFFFFF";
        }*/
        
        $col = "#FFFFFF";
        echo "<tr id='idTr".$index."' style='background-color: ".$col.";'>";
        echo "<td title='".$res_Select['HEADER_ID']."' onclick='getDtl(title);' style='width:80px; text-align: right;vertical-align: top;'><span  style='margin-right: 5px;'>".$index."</span></td>";
        echo "<td title='".$res_Select['HEADER_ID']."' onclick='getDtl(title);' style='width:300px; text-align: left;vertical-align: top;'><span  style='margin-left: 5px;'>".$res_Select['EMBOSSING_NAME']."</span></td>";
        echo "<td title='".$res_Select['HEADER_ID']."' onclick='getDtl(title);' style='width:100px; text-align: left;vertical-align: top;'><span  style='margin-left: 5px;'>".$res_Select['NIC']."</span></td>";
        
        if($res_Select['ACC_FREES'] == 0){
            echo "<td title='".$res_Select['HEADER_ID']."' onclick='getDtl(title);' style='width:50px; text-align: left;vertical-align: top;'><span  style='margin-left: 5px;'><img src='../../../img/1.png'></span></span></td>";
        }else if($res_Select['ACC_FREES'] == 1){
            echo "<td title='".$res_Select['HEADER_ID']."' onclick='getDtl(title);' style='width:50px; text-align: left;vertical-align: top;'><span  style='margin-left: 5px;'><img src='../../../img/2.png'></span></span></td>";
        }else{
            echo "<td title='".$res_Select['HEADER_ID']."' onclick='getDtl(title);' style='width:50px; text-align: left;vertical-align: top;'><span  style='margin-left: 5px;'><img src='../../../img/warning.png'></span></span></td>";
        }
        
        if($res_Select['ACC_INOPERATIVE'] == 0){
            echo "<td title='".$res_Select['HEADER_ID']."' onclick='getDtl(title);' style='width:50px; text-align: left;vertical-align: top;'><span  style='margin-left: 5px;'><img src='../../../img/1.png'></span></span></td>";
        }else if($res_Select['ACC_INOPERATIVE'] == 1){
            echo "<td title='".$res_Select['HEADER_ID']."' onclick='getDtl(title);' style='width:50px; text-align: left;vertical-align: top;'><span  style='margin-left: 5px;'><img src='../../../img/2.png'></span></span></td>";
        }else{
            echo "<td title='".$res_Select['HEADER_ID']."' onclick='getDtl(title);' style='width:50px; text-align: left;vertical-align: top;'><span  style='margin-left: 5px;'><img src='../../../img/warning.png'></span></span></td>";
        }
        
        if($res_Select['ACC_AVLBLE'] >= 400.000){
            echo "<td title='".$res_Select['HEADER_ID']."' onclick='getDtl(title);' style='width:50px; text-align: left;vertical-align: top;'><span  style='margin-left: 5px;'><img src='../../../img/1.png'></span></span></td>";
        }else{
            echo "<td title='".$res_Select['HEADER_ID']."' onclick='getDtl(title);' style='width:50px; text-align: left;vertical-align: top;'><span  style='margin-left: 5px;'><img src='../../../img/2.png'></span></span></td>";
        }
        
        echo "<td style='width:150px;'>";
       
        if($res_Select['ACC_FREES'] == 0 && $res_Select['ACC_INOPERATIVE'] == 0 && $res_Select['ACC_AVLBLE'] >= 400.00){
            echo "<a class='isLinkApprove' href='#' title='".$index."|".$res_Select['HEADER_ID']."' onclick='isApprove(title);'>Approve</a> | ";
        }else if($res_Select['ACC_FREES'] == 0 && $res_Select['ACC_INOPERATIVE'] == 0 && ($Product_code == "0901" || $Product_code == "0301" || $Product_code == "1301")){
             echo "<a class='isLinkApprove' href='#' title='".$index."|".$res_Select['HEADER_ID']."' onclick='isApprove(title);'>Approve</a> | ";
        }else{
            
        }
        echo "<a class='isLinkPending' href='#' title='".$index."|".$res_Select['HEADER_ID']."' onclick='isPending(title);'>Pending</a> | <a class='isLinkReject' href='#' title='".$index."|".$res_Select['HEADER_ID']."' onclick='isReject(title);'>Reject</a> ";
        //echo $Product_code;
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


<!------------------------------------------------------------------------------------------>
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close" onclick="closeBtn();">&times;</span>
    <div id="getAuthDtl">
    
    </div>
  </div>
</div>
<!------------------------------------------------------------------------------------------>
</form>
</body>
</html>