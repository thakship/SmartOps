<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Loan Approval
Page Name		: Report on Loan Approval - ERP module 
Purpose			: To get Report on Loan Approval - ERP module 
Author			: Madushan Wikramaarachchi
Date & Time		: 08.59 A.M 20/05/2016
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="lon/e/001";
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

    <title>Report on Loan Approval - ERP module </title>

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
<script src="../helpdesk_DEVELOPMENT/JAVASCRIPT_FUNCTION/helpdesk_js_function.js"></script>
<!--END Common fumction Libariries-->

<link rel="stylesheet" href="jquery/jquery-ui.css" />
<script src=" jquery/jquery-1.9.1.js"></script>
<script src="jquery/jquery-ui.js"></script>
<script src="jquery.btechco.excelexport.js"></script>
<script src="jquery.base64.js"></script>
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
  $(function() {
    $( "#empappodate1" ).datepicker({dateFormat:"yy-mm-dd"});
  });
  $(function() {
    $( "#empappodate2" ).datepicker({dateFormat:"yy-mm-dd"});
  });
</script>
<script type="text/javascript">
	function getdata(){
		var mydata;
		mydata= new XMLHttpRequest();
		mydata.onreadystatechange=function(){
			if(mydata.readyState==4){
				document.getElementById('cueTopBrnch').innerHTML=mydata.responseText;
			}
		}
		var type1=document.getElementById('empappodate1').value;
 	    var type2=document.getElementById('empappodate2').value;
		mydata.open("GET","ajafunction_repart.php"+"?date1="+type1+"&date2="+type2,true);
		mydata.send();
	}
function Typeprint(){
		var prtContent = document.getElementById("cueTopBrnch");
		var WinPrint = window.open('', '', 'letf=0,top=0,width=1150,height=500,toolbar=0,scrollbars=0,status=0');
		WinPrint.document.write(prtContent.innerHTML);
		WinPrint.document.close();
		WinPrint.focus();
		WinPrint.print();
		WinPrint.close();
	}
    function getprintCopy(){
		var prtContent = document.getElementById("cueTopBrnch");
		var WinPrint = window.open('', '', 'letf=0,top=0,width=1150,height=500,toolbar=0,scrollbars=0,status=0');
		WinPrint.document.write(prtContent.innerHTML);
		WinPrint.document.close();
		WinPrint.focus();
		WinPrint.print();
		WinPrint.close();
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
                   Report on Loan Approval - ERP module 
            </div>
            <div class="panel-body">
				 <div class="form-group">
					<label class="col-sm-2">From Date : *</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" id="empappodate1" name="empappodate1" value="" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeypress="return disableEnterKey(event)" placeholder="----/--/--" />
				    </div>
                    <label class="col-sm-2">To Date : *</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" id="empappodate2" name="empappodate2" value="" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeypress="return disableEnterKey(event)" placeholder="----/--/--" />
				    </div>
                 </div>
                 <div class='col-lg-12'>
					
				 </div>
                 <div class="container-fluid">
                    <button type="button" style="width: 100px;" class="btn btn-success" value="Select" name="btnSelect" id="btnSelect" onclick="getdata();">Select</button>
                    <button type="button" style="width: 100px;" class="btn btn-success" value="Excel" name="btnExport" id="btnExport">Excel</button>
                    <button type="button" style="width: 100px;" class="btn btn-success" onclick="pageClose()">Close</button>
                </div>
                <div class='col-lg-12'>
					
				 </div>
                 
			</div>
    </div>
</div>
<hr />
</form>
<div id="cueTopBrnch" >
    <table border="1" id="myTable" cellpadding="0" cellspacing="0" style="font-size: 12px; margin-left: 10px;">
      <tr>
      	 <th style="text-align:left; padding-left:5px;">#</th>
         <th style="text-align:left; padding-left:5px;">Help ID</th>
         <th style="text-align:left; padding-left:5px;">Entry Date</th>
         <th style="text-align:left; padding-left:5px;">Loan type</th>
         <th style="text-align:left; padding-left:5px;">Client name</th>
         <th style="text-align:left; padding-left:5px;">Loan amount</th>
         <th style="text-align:left; padding-left:5px;">Entry By</th>
         <th style="text-align:left; padding-left:5px;">Branch</th>
         <th style="text-align:left; padding-left:5px;">Department</th>
         <th style="text-align:left; padding-left:5px;">Assigned To</th>
         <th style="text-align:left; padding-left:5px;">Current Status</th>
         <th style="text-align:left; padding-left:5px;">Pending Notified On</th>
         <th style="text-align:left; padding-left:5px;">File Re-Submitted On</th>
         <th style="text-align:left; padding-left:5px;">Approval Date</th>
         <th style="text-align:left; padding-left:5px;">Rejection Date</th>
         <th style="text-align:left; padding-left:5px;">Elapsed Time</th>
      </tr>
      <tr style="background-color: #FFFFFF;"> 
      	 <td style="text-align:left; padding-left:5px;">&nbsp;</td>
      	 <td style="text-align:left; padding-left:5px;">&nbsp;</td>
      	 <td style="text-align:left; padding-left:5px;">&nbsp;</td>
      	 <td style="text-align:left; padding-left:5px;">&nbsp;</td>
      	 <td style="text-align:left; padding-left:5px;">&nbsp;</td>
         <td style="text-align:left; padding-left:5px;">&nbsp;</td>
         <td style="text-align:left; padding-left:5px;">&nbsp;</td>
         <td style="text-align:left; padding-left:5px;">&nbsp;</td>
         <td style="text-align:left; padding-left:5px;">&nbsp;</td>
         <td style="text-align:left; padding-left:5px;">&nbsp;</td>
         <td style="text-align:left; padding-left:5px;">&nbsp;</td>
         <td style="text-align:left; padding-left:5px;">&nbsp;</td>
         <td style="text-align:left; padding-left:5px;">&nbsp;</td>
         <td style="text-align:left; padding-left:5px;">&nbsp;</td>
         <td style="text-align:left; padding-left:5px;">&nbsp;</td>
         <td style="text-align:left; padding-left:5px;">&nbsp;</td>
      </tr>
    </table>
</div>
</body>
</html>

