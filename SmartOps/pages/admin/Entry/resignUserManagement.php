<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Admin
Page Name		: Resign User Management
Purpose			: To Update Resign User
Author			: Madushan Wikramaarachchi
Date & Time		: 11.089 A.M 14/03/2017
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="P013";
	$_SESSION['Module'] = "Admin";
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>User Management</title>

    <!-- Bootstrap Core CSS -->
    <link href="../../../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- MetisMenu CSS -->
    <link href="../../../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet" />

    <!-- Custom CSS -->
    <link href="../../../dist/css/realSolution_1.css" rel="stylesheet" />

    <!-- Custom Fonts -->
    <link href="../../../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<!-- Common function Libariries -->
<!-- CSS-->
<!--<link rel="stylesheet" type="text/css" href="../../../CSS/globleCSS.css"/>
<link rel="stylesheet" type="text/css" href="../ADMIN_DEVELOPMENT/CSS/admin_Style_Sheet.css"/>-->
<!--Javascript-->

<!--Javascript-->
<script src="../../../js/jsLey.js"></script>
<script src="../../../js/commenfunction.js"></script>
<script src="../ADMIN_DEVELOPMENT/JAVASCRIPT_FUNCTION/admin_JavaScript.js"></script>
<!--END Common fumction Libariries-->
<style type="text/css">
    .tblsub{
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
		height:275px;
		overflow-y: scroll;
		border:#000000 solid 1px;
	}
</style>
<script type="text/javascript">
function pageRef(){
   window.open('http://cdberp:8080/cdb/pages/admin/Entry/resignUserManagement.php?DispName=Mkt%20Officer%20Enrolment','conectpage');
}
	function ajaxFunction(e){
		var http;  // The variable that makes Ajax possible! 
		var e=e || window.event;
		var keycode=e.which || e.keyCode;
		if(keycode!==13 || (e.target||e.srcElement).value=='') return false;
		try{ 
			// Opera 8.0+, Firefox, Safari 
			http = new XMLHttpRequest(); 
		}catch(ex){ 
			// Internet Explorer Browsers 
			try{ 
				http = new ActiveXObject("Msxml2.XMLHTTP"); 
			}catch(ex){ 
				try{ 
					http = new ActiveXObject("Microsoft.XMLHTTP"); 
				}catch(ex){ 
					// Something went wrong 
					alert("Your browser broke!"); 
					return false; 
				}
			}
		}
		var url = "getagentids.php?param4=";
		var idValue = document.getElementById("txtUserName").value;
		var myRandom = parseInt(Math.random()*99999999);  // cache buster
		http.open("GET", "getagentids.php?param4=" + escape(idValue) + "&rand=" + myRandom, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
		function handleHttpResponse(){
			if (http.readyState == 4){
				results = http.responseText.split(",");
                if(results[7].trim() == "ug00016" || results[7].trim() == "ug00015"){
                    document.getElementById('txtUserName').value = results[0].trim();
    				document.getElementById('txtUserID').value = results[1].trim();
    				// document.getElementById('txtPassword').value = results[2].trim();
    				document.getElementById('txtNIC').value = results[3].trim();
    				document.getElementById('txtEPF').value = results[4].trim();
    				document.getElementById('txtHRIS').value = results[5].trim();
    				document.getElementById('txtEmail').value = results[6].trim();
    			//	document.getElementById('selUserGroupCode').value = results[7].trim();
    				document.getElementById('txtBranchNumber').value = results[8].trim();
    				document.getElementById('txtBranchNumber1').value = results[9].trim();
                    document.getElementById('txtDepartmentNumber').value = results[10].trim();
                   // document.getElementById('txtAcc').value = results[12].trim();
                    document.getElementById('txtGSM').value = results[13].trim();
                    document.getElementById('selUserStat').value = results[14].trim();
                    //alert(results[10].trim() + " -- " + results[11].trim());
                    var CurrentDep=results[10].trim();
                    var userStat = results[14].trim()
                    var UserID = results[0].trim();
                    //alert(UserID);
    				var mydata1;
    				mydata1= new XMLHttpRequest();
    				mydata1.onreadystatechange=function(){
    					if(mydata1.readyState==4){
   						   document.getElementById('test').innerHTML=mydata1.responseText;
                           // document.getElementById('txtDepartmentNumber').value = CurrentDep;
                           document.getElementById('btnUsergroupUpdate').disabled = false;
                           if(userStat == 'A'){
                                	var mydata2;
                    				mydata2 = new XMLHttpRequest();
                    				mydata2.onreadystatechange=function(){
                    					if(mydata2.readyState==4){
                   						   //document.getElementById('test').innerHTML=mydata2.responseText;
                                           var respondData =  mydata2.responseText.trim();
                                           //alert(respondData);
                                           if(respondData == 0){
                                                document.getElementById('chkPATPAT').disabled = false;
                                                document.getElementById('btnPATPAT').disabled = false; 
                                                //document.getElementById('lblPATPAT').innerHTML = "";
                                                
                                           }else if(respondData == 1){
                                                document.getElementById('lblPATPAT').innerHTML = "* A User Account Has Already Been Created For This Officer. *";
                                                document.getElementById('lblPATPAT').style.color = "#994d00";
                                           }else{
                                            
                                           } 
                    					}
                    				}
                    				mydata2.open("GET","ajaxUserDepartmetSub.php"+"?getSUserID="+UserID,true);
                    				mydata2.send();
                           }
    					}
    				}
    				var a1=document.getElementById('txtDepartmentNumber').value;
    				mydata1.open("GET","ajaxUserDepartmetSub.php"+"?g2="+a1,true);
    				mydata1.send();
                }else{
                    alert('Only Marketing officers are allowed.');
                }
				
                
                
                
			}
		} 
	}
    
    function isPatpatuserManagement(){
        var getUserID = document.getElementById("txtUserName").value;
        //alert(getUserID);
        
        if(document.getElementById("chkPATPAT").checked == true){
            var r = confirm('Confirm to Update ?');
            if(r==true){
                //alert('function ok');
    			$.ajax({ 
    				type:'POST', 
    				data: {isUserID : getUserID }, 
    				url: 'ajaxUserDepartmetSub.php', 
    				success: function(val_retn) { 
    				    //document.getElementById('maneSpan').innerHTML = val_retn;
    				    alert(val_retn);
                        if(val_retn == 'OK'){
                            alert('Updated.')
                            pageRef();
                        }else{
                            alert('Updated Error.')
                        }
                        //pageCloseDefineLetterTypes();
    				}               
    			});
            }
        }else{
            alert("Can not Process. check in PATPAT user check Box.");
        }
       
    }
	function chak(){
		var em = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
		if(document.getElementById('txtEmail').value.length >0){
			if(!document.getElementById('txtEmail').value.match(em)){
				alert("Plase only enter yyyyyyy@ghj.com");
				document.getElementById('txtEmail').value ="";
				return false;
			}
			/*if(document.getElementById('txtNIC').value.length >0){
				if(document.getElementById('txtNIC').value.length!=10){
					alert("Plase only enter 9 numbers and end \' V\ '");
					document.getElementById('txtNIC').value ="";
					return false;
				}
			}else{
				return true;
			}*/
		}else{
			/*if(document.getElementById('txtNIC').value.length >0){
				if(document.getElementById('txtNIC').value.length!=10){
					alert("Plase only enter 9 numbers and end \' V\ '");
					document.getElementById('txtNIC').value ="";
					return false;
				}
			}else{
				return true;
			}*/
		}
		return true;
	}
	
	function popup(x){
	  if(x==1){
		document.getElementById('outer').style.visibility = "visible";
		document.getElementById('conten').style.visibility = "visible";
	  }else{
		document.getElementById('outer').style.visibility = "hidden";
		document.getElementById('conten').style.visibility = "hidden";
	  }	
	}
    
    function selectUserGroup(){
        alert('a');
        if(document.getElementById('selUserGroupCode').value == "ug00016"){
            document.getElementById('mkr').style.display = "inline";
        }
            
        
    }
</script> 
</head>
<body oncontextmenu="return false">
<form class="form-horizontal" action="" method="post" onsubmit="return chak()" style="margin-left: 20px;">
<h3>
<?php 
	echo $_REQUEST['DispName'];
?>
</h3>
<hr/>
<div class="container-fluid">
    <div class="panel panel-default">
            <div class="panel-heading">
                   User Informetion
            </div>
            <div class="panel-body">
				 <div class="form-group">
					<label class="col-sm-2">User ID : *</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" id="txtUserName" name="txtUserName" value="" maxlength="10" onkeypress="return disableEnterKey(event)" onkeyup="ajaxFunction(event)" required="required" placeholder="User ID" />
				    </div>
                 </div>
                 <div class='col-lg-12'>
					
				 </div>
                 
				 <div class='form-group'>
					 <label class="col-sm-2">User Name : *</label>
                     <div class="col-sm-7">
                        <input type="text" class="form-control" id="txtUserID" name="txtUserID" value="" maxlength="150" onkeypress="return disableEnterKey(event)" required="required" placeholder="User Name" disabled="disabled" />
				     </div>
                 </div>
                 <div class='col-lg-12'>
					
				 </div>
                  <div class='form-group'>
					 <label class="col-sm-2">N.I.C : *</label>
                     <div class="col-sm-3">
                        <input type="text" class="form-control" id="txtNIC" name="txtNIC" value="" maxlength="12"  onkeypress="return disableEnterKey(event)" placeholder="NIC" disabled="disabled"/>
				     </div>
                 </div>
                 <div class='col-lg-12'>
					
				 </div>
                 <div class='form-group'>
					 <label class="col-sm-2">E.P.F : </label>
                     <div class="col-sm-3">
                        <input type="text"  class="form-control" id="txtEPF" name="txtEPF" value="" maxlength="10" onkeypress="return disableEnterKey(event)"  placeholder="EPF Number" disabled="disabled" />
				     </div>
                 </div>
                 <div class='col-lg-12'>
					
				 </div>
                 <div class='form-group'>
					 <label class="col-sm-2">H.R.I.S : </label>
                     <div class="col-sm-3">
                        <input type="text"  class="form-control" id="txtHRIS" name="txtHRIS" value="" maxlength="10" onfocus="hilightColoyr(this.id)"  placeholder="HRIS Number" disabled="disabled"/>
				     </div>
                 </div>
                  <div class='col-lg-12'>
					
				 </div>
                 <div class='form-group'>
					 <label class="col-sm-2">E-Mail : </label>
                     <div class="col-sm-5">
                        <input type="text" class="form-control" id="txtEmail" name="txtEmail" value="" maxlength="100" onfocus="hilightColoyr(this.id)" placeholder="E - mail" disabled="disabled"/>
				     </div>
                 </div>
                 <div class='col-lg-12'>
					
				 </div>
                 <div class='form-group'>
					 <label class="col-sm-2">Branch Name : </label>
                     <div class="col-sm-4">
                        <div style='display:none;'>
                            <input type="text" name="txtBranchNumber" id="txtBranchNumber" value=""  onkeypress="return disableEnterKey(event)"  readonly="readonly" />
                        </div>
                        <input type="text" class="form-control" id="txtBranchNumber1" name="txtBranchNumber1" value="" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeypress="return disableEnterKey(event)" onclick="popup(1)"   placeholder="Barnch Name" disabled="disabled" />
				     </div>
                 </div>
                  <div class='col-lg-12'>
					
				 </div>
                 <div class='form-group'>
					 <label class="col-sm-2">Department Name : </label>
                     <div class="col-sm-4">
                        <div id='test'>
                            <input type="text" class="form-control" id="txtDepartmentNumber" name="txtDepartmentNumber" value="" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeypress="return disableEnterKey(event)" onclick="popup(1)" placeholder="Department Name" disabled="disabled" />
                        </div>
                        
                     </div>
                 </div>
                  <div class='col-lg-12'>
					
				 </div>
                 <div class='form-group'>
					 <label class="col-sm-2">GSM Number : </label>
                     <div class="col-sm-2">
                        <input type="text" class="form-control" id="txtGSM" name="txtGSM" value="" maxlength="10" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeypress="return disableEnterKey(event)"  placeholder="GSM Number" disabled="disabled"/>
				     </div>
                 </div>
                  <div class='col-lg-12'>
					
				 </div>
                 <div class='form-group'>
					 <label class="col-sm-2">PATPAT User : </label>
                     <div class="col-sm-7">
                        <input type="checkbox" id="chkPATPAT" name="chkPATPAT" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeypress="return disableEnterKey(event)" disabled="disabled"/>
				        <input type="button" style="width: 100px; margin-left: 20px;" name="btnPATPAT" id="btnPATPAT" value="Access" onclick="isPatpatuserManagement()" disabled="disabled" />
                        <label id="lblPATPAT">* Enable Access to PATPAT Marketing Officer *</label>
                     </div>
                 </div>
                  <div class='col-lg-12'>
					
				 </div>
                  <div class='form-group'>
					 <label class="col-sm-2">User Stat : *</label>
                     <div class="col-sm-4">
                         <select class="form-control" name="selUserStat" id="selUserStat" onkeypress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)">
                        	<option value="A">Active</option>
                            <option value="R">Resign</option>
                            <option value="T">Termineted</option>
                            <option value="S">Saspented</option>
                         </select>
				     </div>
                 </div>
                 <div class='col-lg-12'>
					
				 </div>
			</div>
    </div>
</div>
<div class="container-fluid">
    <button type="submit" style="width: 100px;" class="btn btn-success" value="Update" name="btnUsergroupUpdate" id="btnUsergroupUpdate" disabled="disabled" >Update</button>
    <button type="button" style="width: 100px;" class="btn btn-success" onclick="pageClose()">Close</button>
</div>
<br/>
        <?php
			if(isset($_POST['btnUsergroupUpdate']) && $_POST['btnUsergroupUpdate']=='Update'){
				// Set autocommit to off
				mysqli_autocommit($conn,FALSE);
				try{
                    date_default_timezone_set('Asia/Colombo');
					$newContac = trim($_POST['txtUserName'])."|".trim($_POST['txtUserID'])."|".trim($_POST['txtNIC'])."|".trim($_POST['txtEPF'])."|".trim($_POST['txtHRIS'])."|".trim($_POST['txtEmail'])."|".trim($_POST['selUserGroupCode'])."|".trim($_POST['txtBranchNumber'])."|".trim($_POST['txtDepartmentNumber'])."|".trim($_POST['txtAcc'])."|".trim($_POST['selUserStat']);
					$sqlLoadStNo="SELECT `auditNumber` FROM `audittable`";
	  				$res_LoadStNo=mysqli_query($conn,$sqlLoadStNo);
	 				$auditrow = mysqli_num_rows($res_LoadStNo) + 1;
					$selec = "SELECT `userName`,`userID`,`NIC`, `EPF`,`HRIS`,`email`,`usergroupNumber`, `branchNumber`,`deparmentNumber`, `CDB_SAVINGS_ACCOUNT`,`userStat` FROM `user` WHERE userName = '".trim($_POST['txtUserName'])."';";
					$select1 = mysqli_query($conn,$selec);
					while ($rec1 = mysqli_fetch_array($select1)){
					$concat = $rec1[0]."|".$rec1[1]."|".$rec1[2]."|".$rec1[3]."|".$rec1[4]."|".$rec1[5]."|".$rec1[6]."|".$rec1[7]."|".$rec1[8]."|".$rec1[9]."|".$rec1[10];
			 		}
					if(trim($_POST['txtUserName']) != ""){
					    
                        $addsql2="UPDATE user 
                                  SET userStat = '".trim($_POST['selUserStat'])."',
                                      modifiedBy = '".$_SESSION['user']."', 
                                      modifiedDateTime = now(), 
                                      authoriedBy = '".$_SESSION['user']."', 
                                      authoriedDateTime = now()
                                      WHERE userName = '".trim($_POST['txtUserName'])."';";
						$quary2 = mysqli_query($conn,$addsql2) or die(mysqli_error($conn));
                        
                        $addsqlMailGen = "INSERT INTO `mail_queue` (`jobIndateTime`, `sender`, `receivers_to`, `subject`, `body`, `receivers_cc`) VALUES(now(), '".$_SESSION['user']."', 'sachini@patpat.lk', 'Marketing Officer Enrollment - SmartOps', 'USER ID : ".trim($_POST['txtUserName']). " <BR> NEW STATUS : ". trim($_POST['selUserStat'])."', 'thushith@patpat.lk;rizvi.kareem@cdb.lk')";
                        $queryMailGen = mysqli_query($conn, $addsqlMailGen) or die(mysqli_error($conn));
                        
                        if(trim($_POST['selUserStat']) != "A"){
                            $sql_update = "UPDATE scat_03 AS sc3
                            SET sc3.scat_state_3 = 0
                            WHERE sc3.DefuserID = '".trim($_POST['txtUserName'])."';";
                            //echo $sql_update;
                            $queryupdate = mysqli_query($conn, $sql_update) or die(mysqli_error($conn)); 
                        }
						if(!$quary2){
						    mysqli_rollback($conn);
							echo "<script> alert('Updated not success!');</script>";
						}else{
							$table = "user";
							auditupdate($conn,$auditrow,$table,$concat,$newContac);
      	                    // Commit transaction
					        mysqli_commit($conn);
							echo "<script> alert('Updated success!');</script>";
                            echo "<script>pageClose();</script>";
						}
					}else{
					    mysqli_rollback($conn);
						echo "<script> alert('Please enter complete details!'); </script>";
					}
				}catch(Exception $e){
					// Rollback transaction
					mysqli_rollback($conn);
					echo 'Message: ' .$e->getMessage();
				}
			}
		?>
<div id="outer">
		
</div>
<div id="conten">
    <p class="topline">Search branch
     <input style="margin-left:310px; font-size: 12px;" type="button" onclick="popup(0)" value="Colse" id="popupclose" name="popupclose" />
    </p>
    <?php
		ShowGrid($conn,"SELECT `branchNumber`,`branchName` FROM `branch`",'txtBranchNumber','txtBranchNumber1','popup(0)','branch','txt1','txt2','NULL');			
     ?>
       
</div>
</form>
</body>
</html>