<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Leisure
Page Name		: E - Ticket
Purpose			: To Booking Management
Author			: Madushan Wikramaarachchi
Date & Time		: 01:18 PM 23/09/2014
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="lei/r/003";
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
<title>E - Ticket</title>
<!-- Common function Libariries -->
<!-- CSS-->
<link rel="stylesheet" type="text/css" href="../../../CSS/globleCSS.css"/>
<link rel="stylesheet" type="text/css" href="../Leisure_DEVELOPMENT/CSS/leisure _system_Style_Sheet.css"/>
<!--Javascript-->
<script src="../../../js/jsLey.js"></script>
<script src="../../../js/commenfunction.js"></script>
<script src="../Leisure_DEVELOPMENT/JAVASCRIPT_FUNCTION/leisure_Sysem_JavaScript.js"></script>
<link rel="stylesheet" href="jquery/jquery-ui.css" />
<script src=" jquery/jquery-1.9.1.js"></script>
<script src="jquery/jquery-ui.js"></script>
<style type="text/css">
	.tbl1{
	 	text-align:center;
		width:970px;
		background: #eeeeee; /* Old browsers */
		background: -moz-linear-gradient(top, #eeeeee 0%, #cccccc 100%); /* FF3.6+ */
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#eeeeee), color-stop(100%,#cccccc)); /* Chrome,Safari4+ */
		background: -webkit-linear-gradient(top, #eeeeee 0%,#cccccc 100%); /* Chrome10+,Safari5.1+ */
		background: -o-linear-gradient(top, #eeeeee 0%,#cccccc 100%); /* Opera 11.10+ */
		background: -ms-linear-gradient(top, #eeeeee 0%,#cccccc 100%); /* IE10+ */
		background: linear-gradient(to bottom, #eeeeee 0%,#cccccc 100%); /* W3C */
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#eeeeee', endColorstr='#cccccc',GradientType=0 ); /* IE6-9 */
        font-family: Calibri;
        font-size: 12px;
	}
    .tbl2{
        width:720px;
        margin: 5px auto;
        background: #eeeeee; /* Old browsers */
        background: -moz-linear-gradient(top, #eeeeee 0%, #cccccc 100%); /* FF3.6+ */
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#eeeeee), color-stop(100%,#cccccc)); /* Chrome,Safari4+ */
        background: -webkit-linear-gradient(top, #eeeeee 0%,#cccccc 100%); /* Chrome10+,Safari5.1+ */
        background: -o-linear-gradient(top, #eeeeee 0%,#cccccc 100%); /* Opera 11.10+ */
        background: -ms-linear-gradient(top, #eeeeee 0%,#cccccc 100%); /* IE10+ */
        background: linear-gradient(to bottom, #eeeeee 0%,#cccccc 100%); /* W3C */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#eeeeee', endColorstr='#cccccc',GradientType=0 ); /* IE6-9 */
        font-family: Calibri;
        font-size: 12px;
    }
 .textline_01{
    text-align:left; 
    color: #FFFFFF;
    font-family: sans-serif;
    width:100px;
    height: 12px;
}
.textline_02{
    text-align:left; 
    color: #FFFFFF;
    font-family: sans-serif;
    height: 12px;
}
.buttonManage{
    font-size: 12px; 
    font-family: sans-serif;
    width: 80px;
}
.linetop{
    color: #FFFFFF;
    font-family: sans-serif;
    font-size: 12px;
}
</style>
<!--END Common fumction Libariries-->
<!-- Starts function here -->
<script type="text/javascript">
    $(function() {
        $( "#empappodate1" ).datepicker({dateFormat:"yy-mm-dd"});
    });
    $(function() {
        $( "#empappodate2" ).datepicker({dateFormat:"yy-mm-dd"});
    });
    
    function getdetails(){
        var V_FromDate = document.getElementById('empappodate1').value;
        var V_ToDate = document.getElementById('empappodate2').value;
        var V_userId = document.getElementById('txtUserID').value;
        var V_RePrint = document.getElementById("ChkPrinted").checked;
        var v_reprintValue = "";
        if(V_RePrint==true)
            v_reprintValue = "REPRINT";
            
       	var mydata;
        mydata= new XMLHttpRequest();
        mydata.onreadystatechange=function(){
			if(mydata.readyState==4){
				document.getElementById('divGetDetels').innerHTML=mydata.responseText;
			}
		}
		mydata.open("GET","ajax_eTicket.php"+"?fromDate="+V_FromDate+"&toDate="+V_ToDate+"&userID="+V_userId+"&reprint="+v_reprintValue,true);
		mydata.send();
    }
    
    function DoPrinteTicket(title){
       // alert(title);
        var [m,n]= title.split('|');
        var m1 = [m];
        //alert(m1);
        var n1 = [n];
        //alert(n1);
        var V_book_id = document.getElementById(m1).value;
        var V_userID = document.getElementById(n1).value;
        var V_userA = document.getElementById('txtUser').value;
        var V_date = document.getElementById('txtDate').value;
        //alert('V_book_id - '+ document.getElementById(m1).value);
        //alert('V_userID - ' + document.getElementById(n1).value);
        var r = confirm('Confirm to print ?')
        if (r==true){
            //alert('A : YES');
			$.ajax({ 
				type:'POST', 
				data: {B_id : V_book_id,u_id:V_userID,a_id:V_userA}, 
				url: 'ajax_doPrint.php', 
				success: function() { 
				//alert('Record authorized.'); 
   	                var mydata1;
                    mydata1= new XMLHttpRequest();
                    mydata1.onreadystatechange=function(){
                        if(mydata1.readyState==4){
				            document.getElementById('divGetDetels1').innerHTML=mydata1.responseText;
			             }
                    }
                    mydata1.open("GET","ajax_eTicket1.php"+"?book_id="+V_book_id+"&userID="+V_userID+"&cDate="+V_date,true);
                    mydata1.send();
                    var prtContent = document.getElementById("divGetDetels1");
                    var WinPrint = window.open('', '', 'letf=0,top=0,width=1150,height=500,toolbar=0,scrollbars=0,status=0');
                    WinPrint.document.write(prtContent.innerHTML);
                    WinPrint.document.close();
                    WinPrint.focus();
                    WinPrint.print();
                     pageClose();
				}
			});
            
        }else{
			//alert('A : NO');		
		}
    }
</script>
<!-- Ends  function here -->

</head>
<body oncontextmenu="return false" style="background-color: #1A5D83; padding-top: 40px;">
<p class="topline" style="color: #FFFFFF; margin-top: -25px;">
<?php echo $_REQUEST['DispName']; ?> <!-- Current Page Header/Label -->
</p><hr />
<!-- Screen design will be started from here -->
<form action="" method="post">
<table border="0" cellpadding='0' cellspacing='0'>
    <tr>
        <td class="textline_01"><p class="linetop">User ID :</p></td>
        <td class="textline_02">
            <input class="box_decaretion" style="width:150px;"  name="txtUserID" type="text"  id="txtUserID" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)"/>
        </td>
    </tr>
    <tr>
        <td class="textline_01"><p class="linetop">From (Date) :</p></td>
        <td class="textline_02">
            <input class="box_decaretion" style="width: 100px;"  name="empappodate1" type="text"  id="empappodate1" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)"/>
        <label class="linetop"> - &nbsp;</label>
            <input class="box_decaretion" style="width: 100px;"  name="empappodate2" type="text"  id="empappodate2" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)"/>
        </td>
    </tr>
    <tr>
        <td class="textline_01"> </td>
        <td class="textline_02"><input type="checkbox" class="box_decaretion" id="ChkPrinted" name="ChkPrinted"/> <label class="linetop" for="ChkPrinted">Re-Print</label>
        </td>
    </tr>
    
    <tr>
        <td class="textline_01"></td>
        <td class="textline_02">
           <input type="button" class="buttonManage" id="btnSelect" name="btnSelect" value="Select" onclick="getdetails()" />
           <input type="button" class="buttonManage" id="btnClose" name="btnClose" value="Close" onclick="pageClose()"/>
        </td>
    </tr>
    
</table>
<hr />
<div id="divGetDetels">

</div>
<div style='display:none;' id="divGetDetels1">

</div>
<div style='display:none;'>
    <input type='text' name='txtUser' id='txtUser' value='<?php echo  $_SESSION['user']; ?>'/>
    <input type='text' name='txtDate' id='txtDate' value='<?php echo  $_SESSION['CURRENT_DATE']; ?>'/>
</div>
</form>
</body>
</html>
