<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Control Panel
Page Name		: EOD/SOD Account Closure
Purpose			: To Close and reopen accounts
Author			: nilanka Chameera
Date & Time		: 01.00 P.M 27/11/2018
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="P014";
	include('../../pageasses.php');
	//echo $_SESSION['usergroupNumber'];
	$ass = cakepageaccess();
	//echo $ass;
	if($ass != 1){
		header('Location:../../home.php');
	}
//	include('../../../php_con/includes/db.ini.php');
//	include('../../../php_con/includes/Common.php');
	include('../../loguser.php');
    
    //include ('../../../php_con/includes/dbCrud.php');
    //include ('../../../php_con/includes/dbPara.php');
    // $myConn = new dbCrud($setHost, $setUser, $setPassword,$database);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>EOD/SOD Account Closure </title>
<!-- Common function Libariries -->
<!-- CSS-->
    <link rel="stylesheet" type="text/css" href="../../../CSS/globleCSS.css"/>
    <link rel="stylesheet" type="text/css" href="../helpdesk_DEVELOPMENT/CSS/helpdesk_Style_Sheet.css"/>
    <link rel="stylesheet" href="jquery/jquery-ui.css" />

</head>
<body oncontextmenu="return false" onkeydown="keyEvent(event)" onkeyup="metaKeyUp(event)">
<form action="" method="post" name="schform" enctype="multipart/form-data"> 
<p class="topline">
<?php 
	echo $_REQUEST['DispName'];
?>

</p><hr/>
<div style="display: none;">
    <input type="text" name="txt_USERMY" id="txt_USERMY" value="<?php echo  $_SESSION['user']; ?>" />
</div>
<span id="maneSpan">
<p style="margin: 5px; text-decoration: underline;">Account Closure</p>
<table>
  <tr>
    <td style="width: 200px; text-align: right;"><label class="linetop">Internal Account Number :</label></td>
    <td>
        <input class="box_decaretion" type="text"  style="width:150px;" name="txt_Acc_Num" id="txt_Acc_Num" value="" onkeypress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeyup="ajaxFunction(event)" />
    </td>
      
   
   <td>&nbsp;&nbsp;&nbsp;&nbsp;
     <input class="buttonManage" style="width: 80px;" type="button" id="btnSub" name="btnSub" onclick="getData();" value="Submit"/>   
     <label id="lbl_Return_1" style="color: #CC1313;"></label>     
  </td>
  </tr>
</table>



<hr />
<p style="margin: 5px; text-decoration: underline;">Account Open</p>
<table>
  <tr>
    <td style="width: 200px; text-align: right;"><label class="linetop">Re Open Closed Account :</label></td>
    <td>
     <input class="buttonManage" style="width: 80px;" type="button" id="btnSub" name="btnSub" onclick="accOpen();" value="Submit"/>        
     <label id="lbl_Return_2" style="color: #CC1313;"></label>  
  </td>
    
  </tr>
 
</table>
<br /><hr />


<br />

<div style="margin-left: 10px;">
    
    <input class="buttonManage" style="width: 100px;" type="button" id="btnUsergroupSave" name="btnUsergroupSave" onclick="pageClose();" value="Close"/>
</div>
</span>
<!-- ****************************************************************************************************************************************************** -->
<span id="divNote"></span>
    <!--Javascript-->
    <script src="../../../js/commenfunction.js"></script>
    <script src="../helpdesk_DEVELOPMENT/JAVASCRIPT_FUNCTION/helpdesk_js_function.js"></script>
    <script src=" jquery/jquery-1.9.1.js"></script>
    <script src="jquery/jquery-ui.js"></script>
    <!--END Common fumction Libariries-->

    <script type="text/javascript">
        //JAVASCRIPT FUNCTION START............................................................................................................................
        function pageClose(){ //Page Close Function.......
            parent.location.href = parent.location.href;

        }
        function pageRef(){
            window.open('http://cdberp:8080/cdb/pages/admin/Entry/dayendaccountclosure.php?DispName=EOD/SOD%20Account%20Closure','conectpage');
        }

        function getData(){
            //alert('A');
            //  var getUser = document.getElementById('txt_user').value;
            var AccNum = document.getElementById('txt_Acc_Num').value;
            if(AccNum == ""){
                document.getElementById('lbl_Return_1').innerHTML = "Missing Internal Account Number. ["+AccNum+"]";
            }else if(isNaN(AccNum)) {
                document.getElementById('lbl_Return_1').innerHTML = "Invalid Internal Account Number. (Only Allow for Numbers).["+AccNum+"]";
            }else{
                var r = confirm('Are you sure want to close the account?')
                if (r==true){

                    //alert('aaaa');
                    //alert(AccNum);
                    $.ajax({
                        type:'POST',
                        data: {getaccnum : AccNum},
                        url: 'ajaxCoreSystemFunction.php',
                        success: function(val_retn) {
                            // alert(val_retn);
                            document.getElementById('lbl_Return_1').innerHTML = val_retn;

                            //alert('Updated.');
                            //    pageRef();

                        }
                    });
                }else{
                    //alert('BBBBB');
                }
            }

        }

        function accOpen(){
            var r = confirm('Are you sure want to open the account?')
            if (r == true){

                // alert('aaaa');
                //alert(AccNum);
                $.ajax({
                    type:'POST',
                    data: {isOpen : r},
                    url: 'ajaxCoreSystemFunction.php',
                    success: function(val_retn) {
                        //alert(val_retn);
                        document.getElementById('lbl_Return_2').innerHTML = val_retn;

                        //alert('Updated.');
                        //    pageRef();

                    }
                });
            }else{
                //alert('BBBBB');
            }
        }
    </script>

</form>
</body>
</html>