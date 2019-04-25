<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Helpdesk
Page Name		: kiosk Branch Auth Q Report
Purpose			: get pending aithriztion 
Author			: Madushan Wikramaarachchi
Date & Time		: 12:30 PM 26/09/2017
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="hel/r/012";
	include('../../pageasses.php');
	//echo $_SESSION['usergroupNumber'];
	$ass = cakepageaccess();
	//echo getHelpIDreq1;
	if($ass != 1){
		header('Location:../../home.php');
	}
	include('../../../php_con/includes/db.ini.php');
	include('../../../php_con/includes/Common.php');
	include('../../loguser.php');
  include('../helpdesk_DEVELOPMENT/PHP_FUNCTION/helpdesk_php_function.php');
  
  

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>kiosk completed Report</title>
<!-- Common function Libariries -->
<!-- CSS-->
    <link rel="stylesheet" type="text/css" href="../../../CSS/globleCSS.css"/>
    <link rel="stylesheet" type="text/css" href="../helpdesk_DEVELOPMENT/CSS/helpdesk_Style_Sheet.css"/>
<!--Javascript-->
<script src="../../../js/commenfunction.js"></script>
<script src="../helpdesk_DEVELOPMENT/JAVASCRIPT_FUNCTION/helpdesk_js_function.js"></script>
<!--END Common fumction Libariries-->
<style type="text/css">
 
</style>
<link rel="stylesheet" href="jquery/jquery-ui.css" />
<script src=" jquery/jquery-1.9.1.js"></script>
<script src="jquery/jquery-ui.js"></script>
<script>
  $(function() {
    $( "#empappodate1" ).datepicker({dateFormat:"yy-mm-dd"});
  });
  $(function() {
    $( "#empappodate2" ).datepicker({dateFormat:"yy-mm-dd"});
  });
</script>
<script type="text/javascript">
function pageClose(){ //Page Close Function.......
	//parent.location.href = parent.location.href;
    window.open('http://cdberp:8080/cdb/pages/helpdesk/Report/kioskCompleted.php?DispName=Kiosk%20Completed%20Report','conectpage');
}
function pageRef(){
  // http://cdberp:8080/cdb/pages/helpdesk/Entry/kioskServiceRequestList.php?DispName=Kiosk%20Service%20Request%20List
   window.open('http://cdberp:8080/cdb/pages/helpdesk/Report/kioskCompleted.php?DispName=Kiosk%20Completed%20Report','conectpage');
}
function getGriedViwe(branchCode){
        
        //alert(branchCode);
        //var getFromDate = document.getElementById('branchCode').value;
        
        mydata= new XMLHttpRequest();
        mydata.onreadystatechange=function(){
            if(mydata.readyState==4){
                document.getElementById('maneSpan').innerHTML=mydata.responseText;           
            }
        }
        
        mydata.open("GET","ajax_kioskBranchAuthQReport.php"+"?getBranchAuthQ="+branchCode,true);
        mydata.send();
    }
</script>
</head>
<body oncontextmenu="return false" onkeydown="keyEvent(event)" onkeyup="metaKeyUp(event)">
<form action="" method="post" name="schform" enctype="multipart/form-data"> 
<p class="topline">
<?php 
	echo $_REQUEST['DispName'];
?>
</p><hr/>
<span id="maneSpan">
<label style="font-family:Arial, Helvetica, sans-serif; font-size:12px;margin-left: 42px; font-weight: bold;">Completed Requests Status - </label><br />
<table border="1" cellpadding="0" cellspacing="0" id="myTable1"  style="background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px; margin-left: 40px;">
       <tr style="background-color: #BEBABA;">
            <td style="width:60px;text-align: right;"><span style="margin-right: 5px;">#</span></td>
            <td style="width:100px;text-align: right;"><span style="margin-right: 5px;">BRANCH CODE</span></td>
            <td style="width:300px;text-align: left;"><span style="margin-left: 5px;">BRANCH NAME</span></td>
            <td style="width:60px;text-align: right;"><span style="margin-right: 5px;">FILES COUNT</span></td>
            <td style="width:150px;text-align: right;"><span style="margin-right: 5px;">OLDEST FILE</span></td>
            <td style="width:150px;text-align: right;"><span style="margin-right: 5px;">NEWEST FILE</span></td>
        </tr>
        <?php
            $sql = "select c.entry_branch AS BRANCH_CODE,
                    		 getBranchName(c.entry_branch) AS BRANCH_NAME,
                    		 COUNT(*) AS FILES_COUNT,
                    		 MIN(c.init_enrty_on) AS OLDEST_FILE,
                    		 MAX(c.init_enrty_on) AS NEWEST_FILE
                    FROM cdb_helpdesk AS c 
                    WHERE c.cmb_code = '5000' AND c.cat_code = '1014'
                    group by c.entry_branch
                    order by 3 desc;";  
            $query = mysqli_query($conn,$sql);
            $x = 1;
            while($resalt = mysqli_fetch_array($query)){
                echo "<tr title='".$resalt[0]."' onclick='getGriedViwe(title);'>";
                echo "<td style='width:60px;text-align: right;'><span style='margin-right: 5px;'>".$x."</span></td>";
                echo "<td style='width:100px;text-align: right;'><span style='margin-right: 5px;'>".$resalt[0]."</span></td>";
                echo "<td style='width:300px;text-align: left;'><span style='margin-left: 5px;'>".$resalt[1]."</span></td>";
                echo "<td style='width:60px;text-align: right;'><span style='margin-right: 5px;'>".$resalt[2]."</span></td>";
                echo "<td style='width:150px;text-align: right;'><span style='margin-right: 5px;'>".$resalt[3]."</span></td>";
                echo "<td style='width:150px;text-align: right;'><span style='margin-right: 5px;'>".$resalt[4]."</span></td>";
                echo "</tr>";
                $x++;
            }
            
            
        ?>
</table>
</span>
</form>
</body>
</html>
