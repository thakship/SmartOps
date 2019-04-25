<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Courier Management System
Page Name		: Receive Courier Files
Purpose			: To Receive Courier Files
Author			: Madushan Wikramaarachchi
Date & Time		: 03.47 P.M 21/08/2014 (Modified)
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="cou/e/007";
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
<title>Receive Courier Files</title>
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
		margin-left: -150px;
		top:50%;
		left:50%;
		visibility: hidden;
		background: #ffffff;
		z-index: 5;
		height:275px;
		overflow-y: scroll;
		border:#000000 solid 1px;
	}
</style>
<script type="text/javascript">
    function pageRef(){
        window.open('http://cdberp:8080/cdb/pages/Courier%20Management%20System/Entry/courier_receive_files.php?DispName=Receive%20Courier%20Files','conectpage');
    }
    
    function getDepartmentdtl(title){
        //alert(title);
        dtl_array = title.split("|");
        //alert(dtl_array[0]);
        //alert(dtl_array[1]);
        var userBranch = document.getElementById('ubranch').value;
        var userDepartmnet = document.getElementById('udepartment').value;
        
        var mydata;
        mydata= new XMLHttpRequest();
        mydata.onreadystatechange=function(){
            if(mydata.readyState==4){
                document.getElementById('conten_div').innerHTML = mydata.responseText;           
            }
        }
        
        mydata.open("GET","ajxReceiveCourierFiles-New.php"+"?getBranchNumber="+dtl_array[0]+"&getfileType="+dtl_array[1]+"&getReciveBranch="+userBranch+"&getReciveDepartmnet="+userDepartmnet,true);
        mydata.send();
                
    }
    
    function viewFiles(title){
        //alert(title);
        fileDtl_array = title.split("|");
        var userBranch = document.getElementById('ubranch').value;
        var userDepartmnet = document.getElementById('udepartment').value;
        var data1;
        data1= new XMLHttpRequest();
        data1.onreadystatechange=function(){
            if(data1.readyState==4){
                document.getElementById('sub_conten_1').innerHTML = data1.responseText;           
            }
        }
        
        data1.open("GET","ajxReceiveCourierFiles-New.php"+"?getSendBranchNumber="+fileDtl_array[0]+"&getSendDepartmentNumber="+fileDtl_array[1]+"&getfileType="+fileDtl_array[2]+"&getReciveBranch="+userBranch+"&getReciveDepartmnet="+userDepartmnet,true);
        data1.send();
        
    }
    
    function selectDocuments(title){
        //alert(title);
        var mydataGried;
		mydataGried= new XMLHttpRequest();
		mydataGried.onreadystatechange=function(){
			if(mydataGried.readyState==4){
				document.getElementById('getGried').innerHTML=mydataGried.responseText;  
				document.getElementById('outer').style.visibility = "visible";
				document.getElementById('conten').style.visibility = "visible";           
			}
		}
		mydataGried.open("GET","ajax_Gried.php"+"?sr_gried="+title,true);
		mydataGried.send();
        
    }
    
    function popdown(){
        document.getElementById('outer').style.visibility = "hidden";
		document.getElementById('conten').style.visibility = "hidden";
    }
    
    
    function submitFile(title){
       //alert(title);
        doc_array = title.split("|");
        
        var rowCount = document.getElementById('txtrow').value;
        var logUser = document.getElementById('logUser').value;
        var getBranchNumber = document.getElementById('sendBranch').value;
        var getsendDepartment = document.getElementById('sendDepartment').value;
        var getfileType = document.getElementById('fileType').value;
        var userBranch = document.getElementById('ubranch').value;
        var userDepartmnet = document.getElementById('udepartment').value;
        
        var fileNum = doc_array[0];
        var preSts = doc_array[1];
        var getPostString = getBranchNumber+"|"+getsendDepartment+"|"+getfileType+"|"+userBranch+"|"+userDepartmnet;
        //alert(fileNum);
        //alert(preSts);
        //alert(getPostString);
        var docString = "";
        alert(rowCount);
        var PDRStstus = 0;
        for(var i = 1 ; i < rowCount ; i++){
            //alert('i '+i);
            if(document.getElementById('chkDoc'+i).checked == true){
                //alert('OK')
                docString = docString+document.getElementById('txt1'+i).value+"|";
            }else{
                PDRStstus = 1;
            }
        }
var retVal = ""  
alert(PDRStstus);  
if(PDRStstus == 1){
    retVal = prompt("Why are you untick Documnet ?", "");
}
isStat = "NOT";
if(retVal == "" && PDRStstus == 0){
    isStat = "OK";
}else if(retVal == "" && PDRStstus == 1){
    isStat = "NOT";
}else{
    isStat = "OK";
}        

if(isStat == "OK"){


        var r = confirm('Are you sure Update it?');
        if (r == true){
    		$.ajax({ 
    			type:'POST', 
    			data: {isFileNumber : fileNum , isDocString : docString , isLogUser : logUser}, 
    			url: 'ajxReceiveCourierFiles-New.php', 
    			success: function(val_retn) { 
    			   //alert(val_retn);
                   if(val_retn == 'OK'){
                        alert("Data is Updated."); 
                   }else{
                        alert("System Error!"); 
                   }
                    //pageCloseDefineLetterTypes();
                   //document.getElementById('conten_div').innerHTML = val_retn;
                    
                   // saveDocument(val_retn);
    			}
                
    		});	
        }else{
    		//alert('BBBBB');		
    	}   
        //alert(docString);
        
        popdown();
        //alert('a');
        if(preSts == 1){
            //pageRef();
            alert('Another courier file(s) Remaining');
            window.open('http://cdberp:8080/cdb/pages/Courier%20Management%20System/Entry/ReceiveCourierFiles-New.php?DispName=Receive%20Courier%20Files%20-%20New','conectpage');
        }else{
            alert('Another courier file(s) Remaining');
            viewFiles(getPostString);
        }
}else{
    
}
    }
</script>
<body oncontextmenu="return false">
<form action="" method="post" name="schform">
<p class="topline">
<?php 
	echo $_REQUEST['DispName'];
?>
</p><hr/>
<div style='display:none;'>
	<input type='text' name='udepartment' id='udepartment' value='<?php echo $_SESSION['userDepartment']; ?>'/>
	<input type='text' name='ubranch' id='ubranch' value='<?php echo $_SESSION['userBranch']; ?>'/>
    <input type='text' name='logUser' id='logUser' value='<?php echo $_SESSION['user']; ?>'/>
</div>
<div id="conten_div">
 <?php
	$selectBranchNum="SELECT distinct `courier_files`.`branchNumber`,`courier_files`.`fileType`, `branch`.`branchName`
                      FROM `courier_files` , `branch`
                      WHERE `courier_files`.`branchNumber` = `branch`.`branchNumber` AND
                            `courier_files`.`receiveBranchNumber`='".$_SESSION['userBranch']."' AND 
                            `courier_files`.`receiveDepartmentNumber` = '".$_SESSION['userDepartment']."' AND 
                            (`courier_files`.`stats`='DR' OR `courier_files`.`preFileNumber`= null) AND `courier_files`.`stats`!='PDR' 
                            ORDER BY `branch`.`branchName`;";
    $sql_selectBranchNum = mysqli_query($conn,$selectBranchNum) or die (mysqli_error($conn));
?>
<table border="1" cellpadding="0" cellspacing="0" style="background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;">
      <tr style="background-color: #BEBABA;">
      	 <td style="text-align:center; width:200px;">Branch Name</td>
        <td style="text-align:center; width:200px;">Courier Type</td>
        <td style="text-align:center; width:150px;">Access </td>
      </tr>
	<?php
	  	$b = 1 ;
      	while($add_selectBranchNum = mysqli_fetch_array($sql_selectBranchNum)){
				 echo "<tr style='background-color:#FFFFFF;'>";
				 echo "<td style='text-align: left; padding-left: 10px; width:200px;'>".$add_selectBranchNum[2]."</td>";
				 echo "<td style='text-align: left; padding-left: 10px; width:200px;'>".$add_selectBranchNum[1]."</td>";
				 echo "<td style='width:150px;'>";
				 echo "<input type='button' id='btnselect' name='btnselect' value='Select' title='".$add_selectBranchNum[0]."|".$add_selectBranchNum[1]."' onclick='getDepartmentdtl(title);'/>";
				 echo "</td>";
				 echo "</tr>";
				 $b++;
		}
		
	?>
</table>
</div>
<br />
<hr />
<div id="sub_conten_1"></div>
<span id="getGried"></span>
</form>
</body>
</html>