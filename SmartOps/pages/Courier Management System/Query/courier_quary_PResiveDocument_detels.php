<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Courier Management System
Page Name		: Partially Received Documents
Purpose			: To controling Partially Received Documents
Author			: Madushan Wikramaarachchi
Date & Time		: 11.27 A.M 25/08/2014 (Modified)
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="cou/q/003";
	$_SESSION['Module'] = "Courier Management System";
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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Partially Received Documents</title>
<!-- Common function Libariries -->
<!-- CSS-->
<link rel="stylesheet" type="text/css" href="../../../CSS/globleCSS.css"/>
<link rel="stylesheet" type="text/css" href="../CMS_DEVELOPMENT/CSS/courier_Management_System_Style_Sheet.css"/>
<!--Javascript-->
<script src="../../../js/jsLey.js"></script>
<script src="../../../js/commenfunction.js"></script>
<script src="../CMS_DEVELOPMENT/JAVASCRIPT_FUNCTION/courier_Management_System_JavaScript.js"></script>
<!--END Common fumction Libariries-->
<style type="text/css">
	.tbl1{
	 	text-align:center;
		/*width:600px;*/		
        background: #eeeeee; /* Old browsers */
		background: -moz-linear-gradient(top, #eeeeee 0%, #cccccc 100%); /* FF3.6+ */
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#eeeeee), color-stop(100%,#cccccc)); /* Chrome,Safari4+ */
		background: -webkit-linear-gradient(top, #eeeeee 0%,#cccccc 100%); /* Chrome10+,Safari5.1+ */
		background: -o-linear-gradient(top, #eeeeee 0%,#cccccc 100%); /* Opera 11.10+ */
		background: -ms-linear-gradient(top, #eeeeee 0%,#cccccc 100%); /* IE10+ */
		background: linear-gradient(to bottom, #eeeeee 0%,#cccccc 100%); /* W3C */
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#eeeeee', endColorstr='#cccccc',GradientType=0 ); /* IE6-9 */
	}
	.tbl2{
	 	text-align:center;
		background: #eeeeee; /* Old browsers */
		background: -moz-linear-gradient(top, #eeeeee 0%, #cccccc 100%); /* FF3.6+ */
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#eeeeee), color-stop(100%,#cccccc)); /* Chrome,Safari4+ */
		background: -webkit-linear-gradient(top, #eeeeee 0%,#cccccc 100%); /* Chrome10+,Safari5.1+ */
		background: -o-linear-gradient(top, #eeeeee 0%,#cccccc 100%); /* Opera 11.10+ */
		background: -ms-linear-gradient(top, #eeeeee 0%,#cccccc 100%); /* IE10+ */
		background: linear-gradient(to bottom, #eeeeee 0%,#cccccc 100%); /* W3C */
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#eeeeee', endColorstr='#cccccc',GradientType=0 ); /* IE6-9 */
	}
	#subtbl{
		height:200px;
		overflow-y: scroll;
		float:left;
		margin-bottom:30px;
	}
	#subtb2{
		height:200px;
		visibility: hidden;
		padding-top:20px;
		overflow-y: scroll;
		width:1500px;
	}
</style>
<script type="text/javascript">
function pageRef(){
        window.open('http://cdberp:8080/cdb/pages/Courier%20Management%20System/Query/courier_quary_PResiveDocument_detels.php?DispName=Courier%20OUT%20Disacknowledgment','conectpage');
    }
    function isBranchError(title){
        //alert(title);
        var arr_discription = title.split("|");
        //alert(arr_discription[0]);
        //alert(arr_discription[1]);
        //alert(arr_discription[2]);
        var disacknowledgmentNote = document.getElementById('txtDisNote'+arr_discription[2]).value;
        var logUser = document.getElementById('logUser').value;
        //alert(disacknowledgmentNote);
        if(disacknowledgmentNote == ""){
            alert("Missing disacknowledgment Note.");
            document.getElementById('txtDisNote'+arr_discription[2]).focus();
        }else{
            var r = confirm('Are you sure you want to Process this?')
            if (r==true){
                //alert('C');
    			$.ajax({ 
    				type:'POST', 
    				data: {isFileNumber : arr_discription[0] , isDocumnetNumber : arr_discription[1] ,isDisacknowledgmentNote :disacknowledgmentNote ,isLogUser : logUser}, 
    				url: 'ajaxPDRFunction.php', 
    				success: function(val_retn) { 
    				    //alert(val_retn); 
                        alert("Data Updateed");
                        pageRef();
    				}
    			});
            }else{
    			//alert('BBBBB');		
    		}
        }
    }
</script>
</head>
<body oncontextmenu="return false">
<form action="" method="post" name="schform">
<p class="topline">
<?php 
	echo $_REQUEST['DispName'];
?>
</p><hr/>
<input type="button" style="width: 100px;" class="buttonManage" id="btnClose" name="btnClose" value="Close" onclick="pageClose()"/>
<br /><br />
<div style='display:none;'>
	<input type='text' name='udepartment' id='udepartment' value='<?php echo $_SESSION['userDepartment']; ?>'/>
	<input type='text' name='ubranch' id='ubranch' value='<?php echo $_SESSION['userBranch']; ?>'/>
    <input type='text' name='logUser' id='logUser' value='<?php echo $_SESSION['user']; ?>'/>
</div>
<?php
	//$selectfil="SELECT `fileNumber`,`fileName` FROM `courier_files` WHERE `stats`='PDR' AND `branchNumber`='$_SESSION[userBranch]' AND `departmentNumber`='$_SESSION[userDepartment]'";
	$selectfil = "SELECT c.`fileNumber`,c.`fileName`, b.`branchName` , d.`deparmentName`
                    FROM `courier_files` AS c , `deparment` AS d , `branch` AS b 
                    WHERE c.`stats`='PDR' AND
                    c.`receiveDepartmentNumber` = d.`deparmentNumber`
                    AND c.`receiveBranchNumber` = .b.`branchNumber`
                     AND c.`branchNumber`='".$_SESSION['userBranch']."' 
                    AND c.`departmentNumber`='".$_SESSION['userDepartment']."'
                    AND c.error_log = 0;";
    //echo $selectfil;
    $sql_selectfil = mysqli_query($conn,$selectfil);
		//$_SESSION[userDepartment]	
?>
<div id="subtbl">
<table class="tbl1" border="1" cellpadding="0" cellspacing="0">
      <tr>
      	 <td style="text-align:center; padding-top:5px; padding-bottom:5; width:200px;">File Number</td>
        <td style="text-align:center; padding-top:5px; padding-bottom:5;width:300px;">File Name</td>
        <td style="text-align:center; padding-top:5px; padding-bottom:5;width:300px;">Branch</td>
        <td style="text-align:center; padding-top:5px; padding-bottom:5;width:300px;">Department</td>
        <td style="text-align:center; padding-top:5px; padding-bottom:5;width:100px;">Access</td>
      </tr>
	<?php
	  	$b = 1 ;
      	while($add_file = mysqli_fetch_array($sql_selectfil)){
			echo "<script>
					function cdocument1(obj,title){
						//alert('cdocument1 :' + obj + ' ' + title);
						document.getElementById('subtb2').style.visibility = 'visible';
						var [m,n]= title.split('|');
						var m1 = [m];
						var n1 = [n];
						//alert('m is : ' + m1);
						//alert('n is : ' + n1);
						//var ddd = document.getElementById(obj).value;
						//alert(ddd);
						
						if(obj == 'btnselect'){ 
							//alert('aaaa');
							
							var mydata;
							mydata= new XMLHttpRequest();
							mydata.onreadystatechange=function(){
								if(mydata.readyState==4){
									//alert('aa2 - Before');
									document.getElementById('subtb2').innerHTML=mydata.responseText;
									//alert('aa2 - After');
								}
							}
							//alert('aa2 - End');
							var no=document.getElementById(m1).value;
							//alert(no);
							var no1=document.getElementById(n1).value;
							//alert(no1);
							
							mydata.open('GET','ajaxfilePDR01.php'+'?txt1='+no+ '&txt2='+no1,true);
							//alert('aa2 - End - 3');
							mydata.send();
							//alert('Send');
							
						}else{
							alert('else my code');
						}										
					}
					
					</script>";
					
				 echo "<tr style='background-color:#FFFFFF;'>";
				 echo "<td style='width:200px;text-align:left;'>
					   <div id='diva".$b."' style='display:none;'>
					   <input type='text' name='sela".$b."' id='sela".$b."' value='".$add_file[0]."' required/></div>
					   ".$add_file[0]."</td>";
				 echo "<td style='width:300px;text-align:left;'>
   					<div id='divb".$b."' style='display:none;'>
					   <input type='text' name='selb".$b."' id='selb".$b."' value='".$add_file[1]."' required/></div>
					   ".$add_file[1]."</td>";
         echo "<td style='width:300px;text-align:left;'>
					   ".$add_file[2]."</td>";
                        echo "<td style='width:300px;text-align:left;'>
					   ".$add_file[3]."</td>";
                       
				 echo "<td style='width:100px;'>";
				 echo "<input style='font-size: 12px;' type='button' id='btnselect' name='btnselect' value='Select' title='sela".$b."|selb".$b."' onclick='cdocument1(this.id,title)'/>";
				 echo "</td>";
				 echo "</tr>";
				 $b++;
		}
		
	?>
</table>
</div>
<br/><br/>
<div id="subtb2">
     
</div>
</form>
</body>
</html>