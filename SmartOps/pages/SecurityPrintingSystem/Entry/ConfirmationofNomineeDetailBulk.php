<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Security Printing System
Page Name		: Confirmation of Nominee Detail Bulk
Purpose			: Request for Confirmation of Nominee Bulk 
Author			: Madushan Wikramaarachchi
Date & Time		: 12.34 P.M 13/12/2018
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="sps/e/014";
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
    include('../SPS_DEVELOPMENT/PHP_FUNCTION/SPS_php_function.php');
	//include('ajax_Gried.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Confirmation of Nominee Detail Bulk</title>
<!-- Common function Libariries -->
<!-- CSS-->
    <link rel="stylesheet" type="text/css" href="../../../CSS/globleCSS.css"/>
    <link rel="stylesheet" type="text/css" href="../SPS_DEVELOPMENT/SPS_Style_Sheet.css" />
<!--Javascript-->
<script src="../../../js/commenfunction.js"></script>
<script src="../SPS_DEVELOPMENT/SPS_js_function.js"></script>
<!--END Common fumction Libariries-->
<link rel="stylesheet" href="jquery/jquery-ui.css" />
<script src=" jquery/jquery-1.9.1.js"></script>
<script src="jquery/jquery-ui.js"></script>

</head>
<body oncontextmenu="return false">
<form action="" method="post" name="schform"  enctype="multipart/form-data"> 
<p class="topline">
<?php 
	echo $_REQUEST['DispName'];
?>
</p><hr/>
    
<div>
<table>
    <tr>
        <td style="width: 100px;  text-align: left;"><label class="linetop">Client Code :</label></td>
        <td>
            <input type="text" class="box_decaretion" maxlength="8" style="width:100px;" name="txtClientCode" id="txtClientCode" value="" onkeypress="return disableEnterKey(event)" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)"/>
            <label id="lblgetFacName" style="color: #8F270E;"></label>
        </td>
    </tr>
   
   
 
   
</table>
<br /><hr />
<input class="buttonManage" style="width: 100px; background-color: #e7e7e7;"  type="button" name="btnRequest" id="btnRequest" value="Request" onclick="isRequest();"/>
<input class="buttonManage" style="width: 100px; background-color: #e7e7e7;" type="button" name="btnClose" id="btnClose" value="Close" onclick="pageClose();"/>
</div>
<div style="display: none;">
    <input type="text" id="txtMyUserID" name="txtMyUserID" value="<?php echo $_SESSION['user']; ?>" onkeypress="return disableEnterKey(event)" />
    <input type="text" id="txtMyUserGroup" name="txtMyUserGroup" value="<?php echo $_SESSION['usergroupNumber']; ?>" onkeypress="return disableEnterKey(event)" />
</div>
<div id="err"></div>

 <!-- Javascript Code ----------------------------------------------------------------------- -->

    <script type="text/javascript">
        function pageRef(){
            window.open('http://cdberp:8080/cdb/pages/SecurityPrintingSystem/Entry/ConfirmationofNomineeDetailBulk.php?DispName=Confirmation%20Of%20Nominee%20Detail%20Bulk','conectpage');
        }

        function isChangeRowColoerOver(title){
            document.getElementById('tr'+title).style.backgroundColor = "#FDEEEE";
        }

        function isChangeRowColoerDown(title){
            document.getElementById('tr'+title).style.backgroundColor = "#FFFFFF";
        }
        function isRequest(){
            //alert('A');
            var txtClientCode = document.getElementById("txtClientCode").value; // Get Clint Code ....
            var txtMyUserID = document.getElementById("txtMyUserID").value; // Get Entry User ....
           // alert('B');
            if(txtClientCode == ""){
                alert("Missing Client Code.!");
            }else{
                var r = confirm('Confirm to Request?');
                if (r==true){
                //    alert('C');
                    $.ajax({
                        type:'POST',
                        data: {getClientCode : txtClientCode  , getEnrtyUser : txtMyUserID},
                        url: 'ajax_ConfirmationofNomineedetailRequesrBullk.php',
                        success: function(getVal) {
                         //   document.getElementById('err').innerHTML = getVal

                            alert(getVal);
                            pageRef()
                            /* pageRef();
                             alert('updated success!'); */
                        }
                    });
                }else{
                    //alert('BBBBB');
                }
            }
        }

    </script>


</form>
</body>
</html>