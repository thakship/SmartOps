<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Security Printing System
Page Name		: Renewal Reminder of Insurance Policy
Purpose			: Renewal Reminder of Insurance Policy - Automation
Author			: Madushan Wikramaarachi
Date & Time		: 10:48 A.M - 2016-09-21
------------------------------------------------------------------------------------------------------------------------>
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="sps/r/003";
	$_SESSION['Module'] = "Security Printing System";
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

    <title>Renewal Reminder of Insurance Policy</title>

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
<style>
@font-face {
    font-family: tamil_1;
    src: url(../../../fonts/Latha.ttf);
}
@font-face {
    font-family: tamil_2;
    src: url(../../../fonts/Bamini.ttf);
}
@font-face {
    font-family: sinhala1;
    src: url(../../../fonts/FMEconbld.TTF);
}
@font-face {
    font-family: sinhala2;
    src: url(../../../fonts/Thibd_.ttf);
}

.sin1{
    font-family: sinhala1;
}
.sin2{
    font-family: sinhala2;
}
.tam1{
    font-family: tamil_1;
    font-size: 11px;
}
.tam2{
    font-family: tamil_2;
}
.commenpara{
    /*font-family: sans-serif;*/
    font-size: 12px;
}
.commenparaedit{
    /*font-family: sans-serif;*/
   /* font-size: 12px;*/
    font-weight: bold;
}
</style>
<!--Javascript-->
<script src="../../../js/jsLey.js"></script>
<script src="../../../js/commenfunction.js"></script>
<script src="../SPS_DEVELOPMENT/SPS_js_function.js"></script>

<link rel="stylesheet" href="jquery/jquery-ui.css" />
<script src=" jquery/jquery-1.9.1.min.js"></script>
<script src="jquery/jquery-ui.js"></script>

<script type="text/javascript">
 function printDiv(divID) {
    //Get the HTML of div
    var divElements = document.getElementById(divID).innerHTML;
    //Get the HTML of whole page
    var oldPage = document.body.innerHTML;

    //Reset the page's HTML with div's HTML only
    document.body.innerHTML = 
      "<html><head><title></title></head><body>" + 
      divElements + "</body>";

    //Print Page
    window.print();

    //Restore orignal HTML
    //document.body.innerHTML = oldPage;
}
</script>
<script>
/*  $(function() {
    $( "#txtFromDate" ).datepicker({dateFormat:"yy-mm-dd"});
  });
  $(function() {
    $( "#txtToDate" ).datepicker({dateFormat:"yy-mm-dd"});
  });*/
</script>
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
                   Renewal Reminder
            </div>
            <div class="panel-body">
                 <div class='form-group'>
                    
                 </div>
			</div>
    </div>
</div>
<div class="container-fluid">
    <button type="button" style="width: 100px;" class="btn btn-success" onclick="pageClose()">Close</button>
    <button type="button" style="width: 100px;" class="btn btn-success" onclick="javascript:printDiv('printablediv')">Select</button>
</div>

<hr />
<div id="printablediv">
<br /><br /><br /><br /><br /><br /><br /><br /><br />
<div>Dear Sir/Madam,</div>
<br /><br />
<div class="commenparaedit">Renewal Reminder of Insurance Policy</div>
<br />
<div>We are pleased to inform you that the below mentioned insurance policy has been renewed for the year of 2016-08-11 as per the details given below. </div>
<br />
<br />
<table class="commenparaedit">
    <tr>
        <td style="width: 200px;"><label style="margin-left: 50px;" >Vehicle Number</label></td>
        <td>:</td>
    </tr>
     <tr>
        <td style="width: 200px;"><label style="margin-left: 50px;" >Policy Number</label></td>
        <td>:</td>
    </tr>
     <tr>
        <td style="width: 200px;"><label style="margin-left: 50px;" >Policy Period</label></td>
        <td>:</td>
    </tr>
     <tr>
        <td style="width: 200px;"><label style="margin-left: 50px;" >Insurance Company</label></td>
        <td>:</td>
    </tr>
</table>
<br />
<div>For further queries regarding the premium and the insurance policy please contact CDB (0117388388) and collect your insurance policy.</div>
<br />
<div class="sin2">&#3465;&#3524;&#3501; &#3523;&#3507;&#3524;&#3505;&#3530; &#3476;&#3510;&#3484;&#3546; &#3515;&#3482;&#3530;&#8205;&#3522;&#3499;&#3535;&#3520;&#3515;&#3499;&#3514; 2016-09-18 &#3520;&#3515;&#3530;&#3522;&#3514; &#3523;&#3507;&#3524;&#3535; &#3461;&#3525;&#3540;&#3501;&#3530; &#3482;&#3515; &#3463;&#3501;&#3538; &#3510;&#3520; &#3482;&#3535;&#3515;&#3540;&#3499;&#3538;&#3482;&#3520; &#3503;&#3536;&#3505;&#3540;&#3512;&#3530; &#3503;&#3545;&#3512;&#3540;.</div>
<br />
<div class="sin2">&#3515;&#3482;&#3530;&#8205;&#3522;&#3499; &#3520;&#3535;&#3515;&#3538;&#3482;&#3514; &#3523;&#3524; &#3515;&#3482;&#3530;&#8205;&#3522;&#3499; &#3523;&#3524;&#3501;&#3538;&#3482;&#3514; &#3523;&#3512;&#3530;&#3510;&#3505;&#3530;&#3504; &#3520;&#3536;&#3497;&#3538;&#3503;&#3540;&#3515; &#3501;&#3548;&#3515;&#3501;&#3540;&#3515;&#3540; &#3523;&#3507;&#3524;&#3535; <label style="font-family: sans-serif;">CDB</label>  &#3462;&#3514;&#3501;&#3505;&#3514; &#3461;&#3512;&#3501;&#3535; &#3476;&#3510;&#3484;&#3546; &#3515;&#3482;&#3530;&#8205;&#3522;&#3499; &#3523;&#3524;&#3501;&#3538;&#3482;&#3514; &#3517;&#3510;&#3535; &#3484;&#3505;&#3530;&#3505;. (&#3461;&#3512;&#3501;&#3505;&#3530;&#3505; 011 7 388 388).</div>
<br />
<div class="tam1">&#2951;&#2965;&#3021; &#2965;&#2975;&#3007;&#2980;&#2990;&#3021; &#2990;&#3010;&#2994;&#2990;&#3021; &#2980;&#2969;&#3021;&#2965;&#2995;&#3009;&#2965;&#3021;&#2965;&#3009; &#2980;&#3006;&#2996;&#3021;&#2990;&#3016;&#2991;&#3009;&#2975;&#2985;&#3021; &#2949;&#2993;&#3007;&#2991;&#2980;&#3021;&#2980;&#2992;&#3009;&#2997;&#2980;&#3009; &#2958;&#2985;&#3021;&#2985;&#2997;&#3014;&#2985;&#3021;&#2993;&#3006;&#2994;&#3021; &#2990;&#3015;&#2994;&#3021; &#2965;&#3009;&#2993;&#3007;&#2986;&#3021;&#2986;&#3007;&#2975;&#2986;&#3021;&#2986;&#2975;&#3021;&#2975;&#3009;&#2995;&#3021;&#2995; &#2965;&#3006;&#2986;&#3021;&#2986;&#3009;&#2993;&#3009;&#2980;&#3007; &#2965;&#3018;&#2995;&#3021;&#2965;&#3016; 2016-08-11 &#2950;&#2990;&#3021; &#2950;&#2979;&#3021;&#2975;&#3009;&#2965;&#3021;&#2965;&#3006;&#2965; &#2986;&#3009;&#2980;&#3009;&#2986;&#3007;&#2965;&#3021;&#2965;&#2986;&#3021;&#2986;&#2975;&#3021;&#2975;&#3009;&#2995;&#3021;&#2995;&#2980;&#3009;.</div>
<br />
<div class="tam1">&#2990;&#3015;&#2994;&#3009;&#2990;&#3021; &#2965;&#3006;&#2986;&#3021;&#2986;&#3009;&#2993;&#3009;&#2980;&#3007; &#2965;&#3018;&#2995;&#3021;&#2965;&#3016; &#2990;&#2993;&#3021;&#2993;&#3009;&#2990;&#3021; &#2965;&#3006;&#2986;&#3021;&#2986;&#3009;&#2993;&#3009;&#2980;&#3007; &#2965;&#2975;&#3021;&#2975;&#2979;&#2990;&#3021; &#2980;&#3018;&#2975;&#2992;&#3021;&#2986;&#3006;&#2985; &#2997;&#3007;&#2986;&#2992;&#2969;&#3021;&#2965;&#2995;&#3016; &#2949;&#2993;&#3007;&#2991; CDB(011 7388388) &#2951;&#2994;&#2965;&#3021;&#2965;&#2980;&#3021;&#2980;&#3007;&#2993;&#3021;&#2965;&#3009; &#2980;&#3018;&#2975;&#2992;&#3021;&#2986;&#3009; &#2965;&#3018;&#2979;&#3021;&#2975;&#3009; &#2953;&#2969;&#3021;&#2965;&#2995;&#3021; &#2965;&#3006;&#2986;&#3021;&#2986;&#3009;&#2993;&#3009;&#2980;&#3007; &#2949;&#2975;&#3021;&#2975;&#3016;&#2991;&#3016; &#2986;&#3014;&#2993;&#3021;&#2993;&#3009;&#2965;&#3021; &#2965;&#3018;&#2995;&#3021;&#2995;&#2997;&#3009;&#2990;&#3021;.</div>
<br />
<div>
    <label>This is a computer generated letter and does not require a signature.</label><br /> 
    <label class="sin2">&#3512;&#3545;&#3514; &#3508;&#3515;&#3538;&#3485;&#3505;&#3482; &#3484;&#3501; &#3517;&#3538;&#3508;&#3538;&#3514;&#3482;&#3538;. &#3461;&#3501;&#3530;&#3523;&#3505;&#3530; &#3461;&#3520;&#3521;&#3530;&#8205;&#3514; &#3505;&#3548;&#3520;&#3546;.</label><br />
    <label class="tam1">&#2951;&#2980;&#3009; &#2965;&#2979;&#2985;&#3007;&#2990;&#2991;&#2986;&#2986;&#3021;&#2975;&#3009;&#2980;&#3021;&#2980;&#2986;&#3021;&#2986;&#2975;&#3021;&#2975; &#2965;&#2975;&#3007;&#2980;&#2990;&#3021; &#2958;&#2985;&#3021;&#2986;&#2980;&#2985;&#3006;&#2994;&#3021; &#2965;&#3016;&#2991;&#3014;&#3006;&#2986;&#3021;&#2986;&#2990;&#3021; &#2949;&#2997;&#2970;&#3007;&#2991;&#2990;&#3007;&#2994;&#3021;&#2994;&#3016;</label>

</div>
</div>
<span id="error"></span>
</form>

</body>
</html>