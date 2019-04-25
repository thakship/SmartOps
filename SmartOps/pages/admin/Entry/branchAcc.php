<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Admin
Page Name		: My Password Reset
Purpose			: To Password Reset
Author			: Madushan Wikramaarachci
Date & Time		: 2.09 P.M 06/08/2015 (Modified)
                : 11:00 A.M 29/04/2016 (Modified) - Inculed bootstrap (Madushan)
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="P012";
	$_SESSION['Module'] = "Admin";
	/*include('../../pageasses.php');
	//echo $_SESSION['usergroupNumber'];
	$ass = cakepageaccess();
	//echo $ass;
	if($ass != 1){
		header('Location:../../home.php');
	}*/
	include('../../../php_con/includes/db.ini.php');
    /*include('../../../php_con/includes/Common.php');
	include('../../loguser.php');*/
?>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Branch Access</title>

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
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<!-- Common function Libariries -->
<!-- CSS-->
<!--<link rel="stylesheet" type="text/css" href="../../../CSS/globleCSS.css"/>
<link rel="stylesheet" type="text/css" href="../ADMIN_DEVELOPMENT/CSS/admin_Style_Sheet.css"/>-->
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
<!--Javascript-->
<script src="../../../js/jsLey.js"></script>
<script src="../../../js/commenfunction.js"></script>
<script src="../ADMIN_DEVELOPMENT/JAVASCRIPT_FUNCTION/admin_JavaScript.js"></script>
<!--END Common fumction Libariries-->
<script type="text/javascript">
    function popup(x){
	  if(x==1){
		document.getElementById('outer').style.visibility = "visible";
		document.getElementById('conten').style.visibility = "visible";
	  }else{
		document.getElementById('outer').style.visibility = "hidden";
		document.getElementById('conten').style.visibility = "hidden";
	  }	
	}
    
    function pageClose(){ //Page Close Function.......
	   parent.location.href = parent.location.href;
    }
</script> 
</head>
<body oncontextmenu="return false">
<form class="form-horizontal" action="" method="post" style="margin-left: 20px;">
<h3>
<?php 
	echo $_REQUEST['DispName'];
?>
</h3>
<hr/>

<div class="container-fluid">
    <div class="panel panel-default">
            <div class="panel-heading">
                   Access Informetion
            </div>
            <div class="panel-body">
				  <div class='form-group'>
					 <label class="col-sm-2">Branch Name : </label>
                     <div class="col-sm-4">
                        <div style='display:none;'>
                            <input type="text" name="txtBranchNumber" id="txtBranchNumber" value=""  onkeypress="return disableEnterKey(event)"  readonly="readonly" required="required"/>
                        </div>
                        <input type="text" class="form-control" id="txtBranchNumber1" name="txtBranchNumber1" value="" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeypress="return disableEnterKey(event)" onclick="popup(1)"  required="required" placeholder="Barnch Name" />
				     </div>
                 </div>
                  <div class='col-lg-12'>
					
				 </div>
                 <div class='form-group'>
					 <label class="col-sm-2">Department Name : </label>
                     <div class="col-sm-4">
                        <div id='test'>
                            <select class="form-control" name="txtDepartmentNumber" id="txtDepartmentNumber" onkeypress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)">
                             <option value="">--Select Department Name--</option>
                            </select>
                        </div>
                        
                     </div>
                 </div>
                  <div class='col-lg-12'>
					
				 </div>

			</div>
    </div>
</div>
<div class="container-fluid">
    <button type="submit" style="width: 100px;" class="btn btn-success" value="Login"  name="btnAcc" id="btnAcc">Login</button>
    <button type="button" style="width: 100px;" class="btn btn-success" onclick="pageClose()">Close</button>
</div>
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
<?php
function ShowGrid($conn,$sql,$OutputCode,$OutputDescription,$pop,$funcname,$txt,$txta,$relationship){
	$sql = str_replace('%1%', "'".$relationship."'", $sql);
	$sql_grid= mysqli_query($conn,$sql) or die(mysqli_error($conn));
    echo "<table border='1'>
            <tr>
               <td style='text-align:center; padding-top:5px; padding-bottom:5;width:200px;'>Code</td>
               <td style='text-align:center; padding-top:5px; padding-bottom:5;width:200px;'>Description</td>
               <td style='text-align:center; padding-top:5px; padding-bottom:5;width:100px;'>Access</td> 
            </tr>";				
	$a = 1 ;					
	while ($recs = mysqli_fetch_array($sql_grid)){
		if ($a==1){
			echo "<script>
					function ".$funcname."(obj,title){
						var [m,n]= title.split('|');
						var m1 = [m];
						var n1 = [n];
						if(obj == 'btnselect'){ 
							var id1 = document.getElementById(m1).value;
							var id2 = document.getElementById(n1).value;
							document.getElementById('".$OutputCode."').value = id1;
							document.getElementById('".$OutputDescription."').value = id2;
							var mydata;
							mydata= new XMLHttpRequest();
							mydata.onreadystatechange=function(){
								if(mydata.readyState==4){
									document.getElementById('test').innerHTML=mydata.responseText;
								}
							}
							mydata.open('GET','ajaxUserDepartmet.php'+'?g1='+id1,true);
							mydata.send();
						}else{
							alert('else my code');
						}
					} 
				</script>";
		}
        echo "<tr style='background-color:#FFFFFF;'>";
        echo "<td style='width:200px;'><div style='display:none;'><input class='txt' type='text' name='$txt".$a."' id='$txt".$a."' value='".$recs[0]."'/></div> 
                              <input style='width:200px;' type='text' name='$txt".$a."' id='$txt".$a."' value='".$recs[0]."' disabled='disabled'/></td>";
        echo "<td style='width:200px;'> <div style='display:none;'><input class='txt' type='text' name='$txta".$a."' id='$txta".$a."' value='".$recs[1]."'/></div>
                              <input style='width:200px;' type='text' name='$txta".$a."' id='$txta".$a."' value='".$recs[1]."' disabled='disabled'/></td>";
        echo "<td style='width:100px;'>";
        echo "<input style='font-size: 12px;' type='button' id='btnselect' name='btnselect' title='$txt".$a."|$txta".$a."' value='Select' onclick='".$funcname."(this.id,title);".$pop.";'/>";
        echo "</td></tr>";
    	$a++;
    } //while
	echo "</table>";
}

if(isset($_POST['btnAcc']) && $_POST['btnAcc']=='Login'){
   // echo   $_POST['txtDepartmentNumber'] ;
    
    //echo $_POST['txtBranchNumber'];
    if($_POST['txtBranchNumber'] != "" && $_POST['txtDepartmentNumber'] != ""){
        
        $_SESSION['userBranch'] = $_POST['txtBranchNumber'];
        $_SESSION['userDepartment'] = $_POST['txtDepartmentNumber'];
        $sql_branch = "SELECT b.branchName , d.deparmentName
                         FROM branch AS b , deparment AS d
                        WHERE b.branchNumber = d.branchNumber AND
                               b.branchNumber = '".$_POST['txtBranchNumber']."' AND
                               d.deparmentNumber = '".$_POST['txtDepartmentNumber']."';";
        $query_branch_d = mysqli_query($conn,$sql_branch) or die(mysqli_error($conn));
        while($rec_branch_d = mysqli_fetch_array($query_branch_d)){
            $_SESSION['userBranchName'] = $rec_branch_d[0];
            $_SESSION['deparmentName'] = $rec_branch_d[1];   
           // echo $_SESSION['userBranchName'];
            //echo $_SESSION['deparmentName'];
            echo "<script> pageClose(); </script>";
        }
    }else{
        echo "Select Branch And Departmnet";
    }
}
?>
</form>
</body>
</html>