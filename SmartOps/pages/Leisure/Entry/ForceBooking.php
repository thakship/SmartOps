<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Leisure
Page Name		: Force Booking
Purpose			: To force booking Rooms
Author			: Madushan Wikramaarachchi
Date & Time		: 11:50 AM 29/06/2017
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="lei/e/006";
	$_SESSION['Module'] = "Leisure";
	include('../../pageasses.php');
	$ass = cakepageaccess();
	if($ass != 1){
		header('Location:../../home.php');
	}
	include('../../../php_con/includes/db.ini.php');
	include('../../../php_con/includes/Common.php');
	include('../../loguser.php');
    include('../Leisure_DEVELOPMENT/PHP_FUNCTION/leisure_system_php_function.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Force Booking</title>
<!-- Common function Libariries -->
<!-- CSS-->
<link rel="stylesheet" type="text/css" href="../../../CSS/globleCSS.css"/>
<link rel="stylesheet" type="text/css" href="../Leisure_DEVELOPMENT/CSS/leisure _system_Style_Sheet.css"/>
<!--Javascript-->
<script src="../../../js/jsLey.js"></script>
<script src="../../../js/commenfunction.js"></script>
<script src="../Leisure_DEVELOPMENT/JAVASCRIPT_FUNCTION/leisure_Sysem_JavaScript.js"></script>
<!--END Common fumction Libariries-->

<!-- Starts CDB User defined function here -->
<script type="text/javascript">
    $(function() {
        $( "#empappodate1" ).datepicker({dateFormat:"yy-mm-dd"});
    });
    $(function() {
        $( "#empappodate2" ).datepicker({dateFormat:"yy-mm-dd"});
    });
    function getwindow(){
        window.open("aboutLeisure.php");
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
    
    function pageRef(){
        window.open('http://cdberp:8080/cdb/pages/Leisure/Entry/ForceBooking.php?DispName=Force%20Booking','conectpage');
    }
    function pageBokking(){
        var fromDate = document.getElementById('empappodate1').value;
        var toDate = document.getElementById('empappodate2').value;
        var remark = document.getElementById('txtRemark').value;
        var userID = document.getElementById('txtMyUserID').value;
        var requestBy = document.getElementById('txtRequestBy').value;

        if(fromDate > toDate){
            alert('Date Fields Invalied.');
        }else if(requestBy == ""){
            alert('Missing Request User.');
        }else if(remark == ""){
            alert('Missing Remark.');
        }else{
            var r = confirm('Are you sure you want to Request this?')
            if (r==true){
    	      $.ajax({ 
    				type:'POST', 
    				data: {get_fromDate : fromDate , get_toDate : toDate , get_remark : remark , get_userID : userID , getrequestBy : requestBy}, 
    				url: 'functionForceBooking.php', 
    				success: function(val_retn) { 
    				    alert(val_retn);
                        pageRef();
    				}
    			});	
            }else{
    			//alert('BBBBB');		
    		}
        }
        
    }
    
    
</script>
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
		margin-top:-200px;
		margin-left: -500px;
		top:50%;
		left:50%;
		visibility: hidden;
		background: #ffffff;
		z-index: 5;
		height:400px;
		overflow-y: scroll;
		border:#000000 solid 1px;
	}
    
    
</style>
<!-- Ends CDB User defined function here -->

</head>
<body oncontextmenu="return false">
<p class="topline" style="color: #FFFFFF; margin-top: -30px;">
<?php echo $_REQUEST['DispName']; ?> <!-- Current Page Header/Label -->
</p><hr />
<!-- Screen design will be started from here -->
<form action="" method="post">
    <div style="width: 100%; float: left;">
    <div>
        <?php
            require('calendar/index.html');
        ?>
    </div>
    <div style="margin-left: 10px; float: left;">
        <?php
            require('fromForceBooking.php');
        ?>
    </div>
    </div>
    <div style="width: 100%;float: left;">
        <hr />
        <div style="width: 650px; height: 50px; float: left; margin-left: 10px;">
            <div style="margin-left: 10px; width: 200px; height: 100px; float: left; background-image: url(../../../img/01_1.png);" onclick="popup(1);" title="More details for Holiday Bungalow">
            
            </div>
            <div style="margin-left: 10px; width: 200px; height: 100px; float: left;background-image: url(../../../img/03_1.png);" onclick="popup(1);" title="More details for Holiday Bungalow">
               
            </div>
            <div style="margin-left: 10px; width: 200px; height: 100px; float: left;background-image: url(../../../img/02_1.png);" onclick="popup(1);" title="More details for Holiday Bungalow">
               
            </div>
        </div>
        <div style="width: 400px; height: 50px; float: left;">
            <?php
                $sql_msg = "select leisure_parameter.msg_view from leisure_parameter";
                $quary_msg = mysqli_query($conn,$sql_msg);
            ?>
            <textarea cols="65" rows="4" style="height:100px ; border: solid 1px #000000; font-size: 12px; font-family: sans-serif;" disabled="disabled"><?php while($rec_msg = mysqli_fetch_array($quary_msg)){ echo $rec_msg[0]; } ?> </textarea>
        </div>
    </div>
<div id="outer">
		
</div>
<div id="conten">
    <div style="width: 100%; height: 30px;">
        <img src="../../../img/Close-Button.png" onclick="popup(0);" />
    </div>
    <div style="width: 100%;">
        <img src="../../../img/holidaybangalo.png" />
    </div>
		
</div>
<div style="display: none;">
    <input type="text" id="txtMyUserID" name="txtMyUserID" value="<?php echo $_SESSION['user']; ?>" onkeypress="return disableEnterKey(event)" />
</div>
</form>

</body>
</html>
