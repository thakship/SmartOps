<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Helpdesk
Page Name		: Service Request Authorization 
Purpose			: To ervice Request Authorization 
Author			: Madushan Wikramaarachchi
Date & Time		: 01.32 P.M 06/06/2016
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="hel/e/027";
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
    include('../helpdesk_DEVELOPMENT/PHP_FUNCTION/helpdesk_php_function.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Service Request Authorization </title>
<!-- Common function Libariries -->
<!-- CSS-->
    <!--END Common fumction Libariries-->
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
            margin-top:-150px;
            margin-left: -200px;
            top:50%;
            left:50%;
            visibility: hidden;
            background: #ffffff;
            z-index: 5;
            height:300px;
            border:#000000 solid 1px;
        }

        /* The Modal (background) */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            padding-top: 100px; /* Location of the box */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }

        /* Modal Content */
        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        /* The Close Button */
        .close {
            color: #aaaaaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
    <link rel="stylesheet" href="jquery/jquery-ui.css" />
    <style>

#progress-bar {background-color: #12CC1A;height:12px;color: #FFFFFF;width:0%;-webkit-transition: width .3s;-moz-transition: width .3s;transition: width .3s;}
#progress-div {border:#0FA015 1px solid;padding: 1px 0px;margin:1px 0px;border-radius:4px;text-align:center; font-size: 10px; font-weight: bold; color: black;}
#targetLayer{width:100%;text-align:center;}

</style>
</head>
<body oncontextmenu="return false">
  
<p class="topline">
<?php 
	echo $_REQUEST['DispName'];
?>
</p><hr/>
<span id="maneSpan_sub">
<form action="" method="post" id="uploadForm" name="uploadForm" enctype="multipart/form-data">
<div id="targetLayer"></div>
<div id="loader-icon" style="display:none;"><img src="LoaderIcon.gif" /></div>
<span id="maneSpan"> 
<table border="1" id="myTable" cellpadding="0" cellspacing="0" style="background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;">
            <tr style="background-color: #BEBABA;">
                <td style="width:80px; text-align: right;"><span style="margin-right: 5px;">Help ID</span></td>
                <td style="width:100px; text-align: left;"><span style="margin-left: 5px;">Sub Category 02</span></td>
                <td style="width:200px; text-align: left;"><span style="margin-left: 5px;">Issue</span></td>
                <td style="width:450px;text-align: left;"><span  style="margin-left: 5px;">Information Dis.</span></td>
                <td style="width:200px; text-align: right;"><span style="margin-right: 5px;"></span></td>
                <td style="width:150px;"></td>
            </tr>
<?php
    
    $v_sql_select = "SELECT `cdb_helpdesk`.`helpid`, `cdb_helpdesk`.`issue`,`cdb_helpdesk`.`help_discr`,`cdb_helpdesk`.`attachment_name`,`cdb_helpdesk`.`attachment_namesub` , `cdb_helpdesk`.`ssb_cycle` , `scat_02`.`scat_discr_2` , `cdb_helpdesk`.`enterBy`,`cdb_helpdesk`.`Intrest_Rate`,`cdb_helpdesk`.`cat_code`
                    FROM `cdb_helpdesk` , `scat_02`
                    WHERE `cdb_helpdesk`.`scat_code_2` = `scat_02`.scat_code_2 AND
                          `cdb_helpdesk`.`cmb_code` = '5000' AND
                          `cdb_helpdesk`.`entry_branch` = '".$_SESSION['userBranch']."' AND     
                          `cdb_helpdesk`.`entry_department` = '".$_SESSION['userDepartment']."' 
						  UNION
						  SELECT `loan_cdb_helpdesk`.`helpid`, `loan_cdb_helpdesk`.`issue`,`loan_cdb_helpdesk`.`help_discr`,`loan_cdb_helpdesk`.`attachment_name`,`loan_cdb_helpdesk`.`attachment_namesub` , `loan_cdb_helpdesk`.`ssb_cycle` , `loan_product`.`product_name` , `loan_cdb_helpdesk`.`enterBy`,0,9999
					FROM `loan_cdb_helpdesk` , `loan_product`
                    WHERE `loan_cdb_helpdesk`.`scat_code_2` = `loan_product`.product_id AND
                          `loan_cdb_helpdesk`.`cmb_code` = '5000' AND
                          `loan_cdb_helpdesk`.`entry_branch` = '".$_SESSION['userBranch']."' AND     
                          `loan_cdb_helpdesk`.`entry_department` = '".$_SESSION['userDepartment']."';";
                          
      
                        //echo $v_sql_select;
    $v_que_select = mysqli_query($conn,$v_sql_select);
    $index = 0;
    while($res_Select = mysqli_fetch_assoc($v_que_select)){
        $index++;
         /*if($index%2 == 1){
            $col = "#C7C9C5";
            $col = "#FFFFFF";
        }else{
             $col = "#FFFFFF";
        }*/
        
        if($res_Select['ssb_cycle'] != 0){
            $col = "#F0D7A5";
        }else{
            $col = "#FFFFFF";
        }
        
        echo "<tr style='background-color: ".$col.";' title = '".getuserdtl($conn,$res_Select['enterBy'])."' onclick='getDtl_helpRequest(".$res_Select['helpid'].")'>";
        echo "<td style='width:80px; text-align: right;vertical-align: top;'><span  style='margin-right: 5px;'>".$res_Select['helpid']."</span></td>";
        echo "<td style='width:100px; text-align: left;vertical-align: top;'><span  style='margin-left: 5px;'>".$res_Select['scat_discr_2']."</span></td>";
        echo "<td style='width:200px; text-align: left;vertical-align: top;'><span  style='margin-left: 5px;'>".$res_Select['issue']."</span></td>";
        //11:43 AM 23/11/2018        
        if($res_Select['cat_code'] == 1014)
            echo "<td style='width:450px; text-align: left;'><span  style='margin-left: 5px;'><textarea rows='4' style='width: 450px;padding-left: 10px;font-family: Times New Roman;font-size: 12px;border: none;background-color: ".$col.";' readonly='readonly'>".$res_Select['help_discr'].chr(13)."Interest Rate : ".$res_Select['Intrest_Rate']."</textarea></span></td>";
        else
            echo "<td style='width:450px; text-align: left;'><span  style='margin-left: 5px;'><textarea rows='4' style='width: 450px;padding-left: 10px;font-family: Times New Roman;font-size: 12px;border: none;background-color: ".$col.";' readonly='readonly'>".$res_Select['help_discr']."</textarea></span></td>";
            
        echo "<td style='width:210px; text-align: left;'><span  style='margin-left: 5px;'>";
        if($res_Select['attachment_name'] != ""){
            echo "<a href='../../../uploadHelpdesk/".$res_Select['attachment_name']."' target='_blank'>Attachment 1</a> |";    
        }
        if($res_Select['attachment_namesub'] != ""){
            echo "<a href='../../../uploadHelpdesk/".$res_Select['attachment_namesub']."' target='_blank'>Attachment 2</a>";    
        }
        echo "</span></td>";
        echo "<td style='width:150px;'>";
         echo "<input type='button' class='buttonManage' id='btn_Edit' name='btn_Edit' value='Approve' title='".$res_Select['helpid']."' onclick='isApprove(title);'/>";
         // echo "<input type='button' class='buttonManage' id='btn_close' name='btn_close' value='Reject' title='".$res_Select['helpid']."' onclick='isReject(title);'/>";
           echo "<input type='button' class='buttonManage' id='btn_close' name='btn_close' value='Pending' title='".$res_Select['helpid']."' onclick='isPending(title);'/>";
                
            echo "</td>";
        echo "</tr>";
    }
?>
</table>
</span>
</span>

<div id="getGried"></div>
<div id="err"></div>

<?php
    function getuserdtl($conn,$userID){
        $sql = "select u.userName  , u.userID , u.GSMNO from user AS u where u.userName = '".$userID."';";
        $query = mysqli_query($conn,$sql);
        while($r = mysqli_fetch_array($query)){
            return $r[0]."\n".$r[1]."\n".$r[2];
        }
    }
?>
<!-- ****************************************************************************************************************************************************** -->
<span id="getGried"></span>
<div style="display: none;">
    <input type="text" name="txt_user" id="txt_user" value="<?php echo  $_SESSION['user']; ?>" />
</div>
</form>


<link rel="stylesheet" type="text/css" href="../../../CSS/globleCSS.css"/>
<link rel="stylesheet" type="text/css" href="../helpdesk_DEVELOPMENT/CSS/helpdesk_Style_Sheet.css"/>
<!--Javascript-->
<script src="../../../js/commenfunction.js"></script>
<script src="../helpdesk_DEVELOPMENT/JAVASCRIPT_FUNCTION/helpdesk_js_function.js"></script>
<script src=" jquery/jquery-1.9.1.js"></script>
<script src="jquery/jquery-ui.js"></script>
<script type="text/javascript">
    function pageClose(){ //Page Close Function.......
        window.open('http://cdberp:8080/cdb/pages/helpdesk/Entry/ServiceRequestAuthorization.php?DispName=Service%20Request%20Authorization','conectpage');
    }
    function isApprove(title){
        var getUser = document.getElementById('txt_user').value;
        var r = confirm('Are you sure you want to Approve this?')
        if (r==true){
            //alert(getUser+'-'+title+'A');
            $.ajax({
                type:'POST',
                data: {hidA : title , huserA : getUser},
                url: 'functionServiceRequestAuthorization.php',
                success: function(dat) {
				    //document.getElementById('err').innerHTML = data;

                    alert(dat);
                    alert('Approve Success');
                    pageClose();
                }
            });
        }else{
            //alert('BBBBB');
        }
    }

    function isReject(title){
        var getUser = document.getElementById('txt_user').value;
        var r = confirm('Are you sure you want to Reject this?')
        if (r==true){
            // alert(getUser+'-'+title+'R');
            $.ajax({
                type:'POST',
                data: {hidR : title , huserR : getUser},
                url: 'functionServiceRequestAuthorization.php',
                success: function(dat) {
                    //alert(dat);
                    alert('Reject Success');
                    pageClose();
                }
            });
        }else{
            //alert('BBBBB');
        }
    }
    function isPending(title){
        //alert('a');

        var getUser = document.getElementById('txt_user').value;
        var comment = prompt('Are you sure you want to Pending notified this?', '');
        if (comment == null || comment == '') {
            alert('Missing Pending notified');
        } else {
            //alert(comment);
            $.ajax({
                type:'POST',
                data: {hidp : title , huserp : getUser ,commentp : comment},
                url: 'functionServiceRequestAuthorization.php',
                success: function(dat) {
                    // alert(dat);
                    alert('Pending notified Success');
                    pageClose();
                }
            });
        }
    }

    function getDtl_helpRequest(help_id){
        //alert(help_id);
        var modal = document.getElementById('myModal');
        modal.style.display = "block";

        //getAuthDtl
        var mydataGried;
        mydataGried= new XMLHttpRequest();
        mydataGried.onreadystatechange=function(){
            if(mydataGried.readyState==4){
                //alert('b');
                document.getElementById('getAuthDtl').innerHTML = mydataGried.responseText;
            }
        }
        mydataGried.open("GET","ajax_Gried.php"+"?setHelpId_Auth="+help_id,true);
        mydataGried.send();

    }


    function popup(x,title){
        // alert(x);
        //alert(title);
        if(x==1){
            //alert('a');
            var mydataGried;
            mydataGried= new XMLHttpRequest();
            mydataGried.onreadystatechange=function(){
                if(mydataGried.readyState==4){
                    //alert('b');
                    document.getElementById('getGried').innerHTML = mydataGried.responseText;
                    document.getElementById('outer').style.visibility = "visible";
                    document.getElementById('conten').style.visibility = "visible";
                }
            }
            mydataGried.open("GET","ajax_Gried.php"+"?get_Approve="+x+"&get_function="+title,true);
            mydataGried.send();
            document.getElementById('outer').style.visibility = "visible";
            document.getElementById('conten').style.visibility = "visible";

        }else{
            document.getElementById('outer').style.visibility = "hidden";
            document.getElementById('conten').style.visibility = "hidden";
        }
    }

    function closeBtn(){
        var modal = document.getElementById('myModal');
        modal.style.display = "none";
    }
</script>
<div id="myModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
        <span class="close" onclick="closeBtn();">&times;</span>
        <br/><br/>
        <hr/>
        <div id="getAuthDtl">

        </div>
    </div>
</div>

</body>
</html>

