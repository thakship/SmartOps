<!DOCTYPE HTML>
<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Leisure
Page Name		: Booking Cancellation
Purpose			: To Booking cancellation
Author			: Madushan Wikramaarachchi
Date & Time		: 3:24 AM 12/09/2014
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="depac/e/001";
	$_SESSION['Module'] = "Dep Ack";
	include('../../pageasses.php');
	$ass = cakepageaccess();
	if($ass != 1){
		header('Location:../../home.php');
	}
	include('../../../php_con/includes/db.ini.php');
	include('../../../php_con/includes/Common.php');
	include('../../loguser.php');
    include('../DepAckno_DEVELOPMENT/PHP_FUNCTION/DepAckno_php_function.php');
?>

<html> 
<head>
<!-- Common function Libariries -->
<!-- CSS-->
<link rel="stylesheet" type="text/css" href="../../../CSS/globleCSS.css"/>
<link rel="stylesheet" type="text/css" href="../DepAckno_DEVELOPMENT/CSS/DepAckno_Style_Sheet.css"/>
<!--Javascript-->
<script src="../../../js/jsLey.js"></script>
<script src="../../../js/commenfunction.js"></script>
<script src="../DepAckno_DEVELOPMENT/JAVASCRIPT_FUNCTION/DepAckno_JavaScript.js"></script>
<style type="text/css">
    .lebelClss{
        font-family: sans-serif;
        font-size: 12px;
    }
</style>
<!--END Common fumction Libariries-->
<!-- Starts function here -->
<script type="text/javascript">
    function pageClose(){ //Page Close Function.......
	   parent.location.href = parent.location.href;
        //window.open('http://cdberp:8080/cdb/pages/helpdesk/Entry/serviceRequsetList.php?DispName=Service%20Request%20List','conectpage');
    }
    function getTxtVal(){
        var a = document.getElementById('depnum').value;
        var b = document.getElementById('contnum').value;
        var c = document.getElementById("txtuserName").value;
        var d = document.getElementById("txtuserBranch").value;
        $.ajax({ 
				type:'POST', 
				data: {depnum : a,contnum : b,getuserID : c,getuserBranch : d}, 
				url: 'dep_data.php', 
				success: function(data) { 
				  document.getElementById('maneCon').innerHTML = data;    
				}
			});	
    }
    function getprint(){
        //alert('a');
        //var isprintText = document.getElementById("txtareaPrintText").value;
        var isEm = document.getElementById('txtareaComment').value;
        var isUserID = document.getElementById("txtuserName").value;
        var isdepNum = document.getElementById('txtdepNum').value;
        var isConNum = document.getElementById("txtConNum").value; 
        var isBranch = document.getElementById("txtuserBranch").value;
        var iscmbOptionCertificate = document.getElementById('cmbOptionCertificate').value;
        var istxtcerNum  = document.getElementById('txtcerNum').value;
        var istxtClient_Name  = document.getElementById('txtClient_Name').value;
        
        
        if(isEm!= ""){
           if(istxtcerNum != ""){
            alert('Are you sure print');
                 var prtContent = document.getElementById("getNewView");
                    var WinPrint = window.open('', '', 'letf=0,top=0,width=1150,height=500,toolbar=0,scrollbars=0,status=0');
                    WinPrint.document.write(prtContent.innerHTML);
        			WinPrint.document.close();
        			WinPrint.focus();
        			WinPrint.print();
        			WinPrint.close();
                    alert('OK');
                    $.ajax({ 
        				type:'POST', 
        				//data: {getprintText : isprintText, getComment : isEm, getUsreID : isUserID, getdepNum : isdepNum, getConNum : isConNum, getUserBranch : isBranch},
                        data: {getComment : isEm, getUsreID : isUserID, getdepNum : isdepNum, getConNum : isConNum, getUserBranch : isBranch, getOptionCertificate : iscmbOptionCertificate, getiscerNum : istxtcerNum, gettxtClient_Name : istxtClient_Name}, 
        				url: '../DepAckno_DEVELOPMENT/PHP_FUNCTION/DepAckno_php_function.php', 
        				success: function(data) { 
        				    document.getElementById('maneCon').innerHTML = data;  
                            alert('Deposit Acknowledgement Printed Successfully.');  
                            pageClose();
        				}
        			});
           }else{
                alert('Certificate Serial is mandatory.');
           }
           
        }else{
            alert('Commend field is mandatory.');
        }
    }
function getprintCopy(){
		var prtContent = document.getElementById("getNewView");
		var WinPrint = window.open('', '', 'letf=0,top=0,width=1150,height=500,toolbar=0,scrollbars=0,status=0');
		WinPrint.document.write(prtContent.innerHTML);
		WinPrint.document.close();
		WinPrint.focus();
		WinPrint.print();
		WinPrint.close();
 }
function getOptgetspe(){ 
    document.getElementById('getspe').innerHTML = document.getElementById('cmbOption').value;
}
function getOptgetspesub(){
    document.getElementById('getaaaaaa').innerHTML = document.getElementById('cmbOptionCertificate').value;
}
function getPrintText(){
    document.getElementById('getPrintText').innerHTML = document.getElementById('txtcerNum').value;
}
</script>
<!-- Ends  function here -->
</head>
<body>
<p class="topline">
<?php 
	echo $_REQUEST['DispName'];
?>
</p>
<hr/>
<br/><br/>
<div style="display: none;">
     <input type="text" name="txtuserName" id="txtuserName" value="<?php echo $_SESSION['user']; ?>" />
     <input type="text" name="txtuserBranch" id="txtuserBranch" value="<?php echo $_SESSION['userBranch']; ?>" />
</div>
<!--<form action="dep_data.php" method="post">-->
<form action="" method="post">
<div id="maneCon">
    <table>
      <tr>
        <td style="width: 120px; text-align: right;"><label class="linetop">Deposit Number :</label></td>
        <td>
             <input type="text" name="depnum" id="depnum" maxlength="22" class="box_decaretion" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" />
      </tr>
      <tr>
        <td style="width: 120px; text-align: right;"><label class="linetop">Contract Number:</label></td>
        <td>
       	    <input type="text" name="contnum" maxlength="5" id="contnum" class="box_decaretion" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)"/>
        </td>
      </tr>
    </table>
    <!--<input value="Continue" type="submit" />-->
    <br />
    <table>
      <tr>
        <td style="width: 120px;"></td>
        <td>
            <input type="button" class="buttonManage" value="Continue" onclick="getTxtVal()" />
            <input type="button" class="buttonManage" id="btnClose" name="btnClose" value="Close" onclick="pageClose()"/> 
      </tr>
</div>
</form>

</body>
</html>