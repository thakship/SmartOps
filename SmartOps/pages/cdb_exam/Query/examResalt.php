<!------------------------------------------------------------------------------------------------------------------------
Module Code		: CDB Exam
Page Name		: Exam Results
Purpose			: View Exam Reslt
Author			: Madushan Wikramaarachi
Date & Time		: 10:03 A.M - 2016-04-20
------------------------------------------------------------------------------------------------------------------------>
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="exm/q/001";
	$_SESSION['Module'] = "CDB Exam";
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

    <title>Exam Results</title>

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
<!--Javascript-->
<script src="../../../js/jsLey.js"></script>
<script src="../../../js/commenfunction.js"></script>
<script src="../ADMIN_DEVELOPMENT/JAVASCRIPT_FUNCTION/admin_JavaScript.js"></script>
<!--END Common fumction Libariries-->
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
                   Exam Results Information
            </div>
            <div class="panel-body">
                 <div class='form-group'>
					 <label class="col-sm-2">Exam Year : </label>
                     <div class="col-sm-2">
                        <input type="text" class="form-control" id="ExamYear" name="ExamYear" value="<?php echo date("Y"); ?>" maxlength="4" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeypress="return disableEnterKey(event)" required="required" />
				     </div>
                 </div>
                  <div class='col-lg-12'>
					
				 </div>
				 <div class="form-group">
					<label class="col-sm-2">HRIS Number : </label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" id="HRISNumber" name="HRISNumber" value="" maxlength="10" onkeypress="return disableEnterKey(event)" required="required" placeholder="HRIS Number" />
				    </div>
                 </div>
                 <div class='col-lg-12'>
					
				 </div>
			</div>
    </div>
</div>
<div class="container-fluid">
    <button type="button" style="width: 100px;" class="btn btn-success" value="Save" name="btnModuleSave" id="btnModuleSave" onclick="viewResalt();">View Results</button>
    <button type="button" style="width: 100px;" class="btn btn-success" onclick="pageClose()">Close</button>
</div>

<br />
<hr />
<div class="panel panel-default">
                <div class="panel-heading">
                    Your Results
                </div>
                <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <span id="diva">
                                     <table id="myTable" class="table table-striped table-bordered table-hover">
                                        <tbody>
                                            <tr>
                                                <td class='col-lg-2'>Year </td>
                                                <td>:</td>
                                            </tr>
                                            <tr>
                                                <td class='col-lg-2'>HRIS Number </td>
                                                <td>:</td>
                                            </tr>
                                            <tr>
                                                <td class='col-lg-2'>Name </td>
                                                <td>:</td>
                                            </tr>
                                            <tr>
                                                <td class='col-lg-2'>Paper Type </td>
                                                <td>:</td>
                                            </tr>
                                            <tr>
                                                <td class='col-lg-2'>Grade </td>
                                                <td>:</td>
                                            </tr>
                                        </tbody>
                                    </table>               
                            </span>
                              
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            <span id="error"></span>
</form>
<script type="text/javascript">
    function viewResalt(){
        //alert('a');
        var ExamYear = document.getElementById("ExamYear").value;
        var HRISNumber = document.getElementById("HRISNumber").value;
        var mydata;
		mydata= new XMLHttpRequest();
		mydata.onreadystatechange=function(){
			if(mydata.readyState==4){
				document.getElementById('diva').innerHTML=mydata.responseText;
			}
		}
		mydata.open("GET","ajaxExamResalt.php"+"?get_ExamYear="+ExamYear+"&get_HRISNumber="+HRISNumber,true);
		mydata.send();
    }
</script>
</body>
</html>