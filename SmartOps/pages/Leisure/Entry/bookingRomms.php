<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Leisure
Page Name		: Booking Rooms
Purpose			: To Booking Rooms
Author			: Madushan Wikramaarachchi
Date & Time		: 9:50 AM 04/09/2014
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="lei/e/001";
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
<title>Box Closure</title>
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
    
   function getBookingFee(){
        var fee =0;
        var date1 = new Date(document.getElementById('empappodate1').value);
        var date2 = new Date(document.getElementById('empappodate2').value);
        if(date1 <= date2){
            var diffDays = (Math.ceil((Math.abs(date2.getTime() - date1.getTime())) / (1000 * 3600 * 24))+ parseInt(document.getElementById('txtDateDiff').value)) ;
            if(document.getElementById('selnumOfRooms').value < document.getElementById('txtNumRoom').value ){
                fee = document.getElementById('selnumOfRooms').value * diffDays * document.getElementById('txtRoomRate').value;
            }else{
                fee = diffDays * document.getElementById('txtEBangalo').value;
            }            
        } 
        return  fee ; 
   } 
   
   function chak(){
        if(getBookingFee()>0){ 
            var r = confirm("Confirm your booking ?\n\n" + "Booking amount : " + getBookingFee().toString()+"/=");
            if (r == true) {
                
                return true;
            }else{
                alert("Cancelled by the user.");
                return false;
            }
        }else{
            alert("Date selection is incorrect.");
            return false;
        }
    return true;
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
<body oncontextmenu="return false" onsubmit="return chak()">
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
            require('frmgetBooking.php');
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
 <?php
 
    if(isset($_POST['btnSubmit']) && $_POST['btnSubmit']=='Submit'){
       mysqli_autocommit($conn,FALSE); // Set autocommit to off
        try{
            $dateDiffPlus = 0;
            $sql_datediff = "select leisure_parameter.Datediff from leisure_parameter";
            $rs_datediff = mysqli_query($conn,$sql_datediff);
            while($rec_datDiff = mysqli_fetch_array($rs_datediff)){ 
                $dateDiffPlus = $rec_datDiff[0]; 
            }
            
            $batch_num = 0; 
            $dateDiff = 0;
            $date1 = new DateTime($_POST['empappodate1']); //Get the User selected from date
            $date2 = new DateTime($_POST['empappodate2']); //Get the User selected to date
            $interval = $date1->diff($date2);              // Get the date diff from to and from 
            $dateDiff = $dateDiffPlus + ($interval->days) ;            // if it's same date we force it to 1
           // echo  $dateDiff;
           if (isset($_POST['chkPolicy'])) { //isset($_POST['chkSalray']) && 
            if($_POST['empappodate2'] >= $_POST['empappodate1']){
                    $Current_Year = date("Y" , strtotime($_SESSION['CURRENT_DATE']));
                    
                    // Validation rule engine
                    $ValidationStatus = DoValidation($_SESSION['user'],$date1->format('Y-m-d'),$date2->format('Y-m-d'),$_POST['selnumOfRooms'],$Current_Year,$dateDiff,$conn,$_SESSION['CURRENT_DATE']);
                    
                    if(substr($ValidationStatus,0,1)=="E"){
                        //alert substr($ValidationStatus,2)
                         echo "<script> alert('".substr($ValidationStatus,2)."');</script>"; 
                    }else{
                         $TableID = "";
                         $sqlFunction ="SELECT GetNextSerial('m4',".$Current_Year.") FROM DUAL";    //Create the Unique Bokking Reference [Year wise]
    	                 $quary_Function = mysqli_query($conn,$sqlFunction);
        			     while ($rec_Function = mysqli_fetch_array($quary_Function)){
        			         $batch_num = $rec_Function[0]; 
        			     }
                         $sql_numOfRooms = "SELECT `num_of_rooms` FROM `leisure_parameter`";
                       	 $quary_numOfRooms = mysqli_query($conn,$sql_numOfRooms);
                        while($rec_numOfRooms= mysqli_fetch_array($quary_numOfRooms)){
                            $getFullRooms = $rec_numOfRooms[0];
                        }
                    
                         // Primary Key creation
                         $TableID = $Current_Year.str_pad($batch_num, 4, '0', STR_PAD_LEFT); //This will return 20140001 as first number for 2014 and 20150001 in 2015
           
                         //Insert the Leisure Header table
                         if(strlen($TableID)==8){
                            
                             if($_POST['selnumOfRooms'] < $getFullRooms){
                                $V_get_bunglow_booked = "NO";
                             }else{
                                $V_get_bunglow_booked = "YES";
                             }
                             
                             $sql_booking = "INSERT INTO `leisure_header`(`bookingId`, `userName`, `fromDate`, `toDate`, `numOfRooms`, `numOfAduls`, `numOfChildren`, `state`, `enteredBy`, `enteredDataTime`,`salary_ded_ok`,`policy_read_ok`,`entire_bunglow_booked`) VALUES ('".$TableID."','".$_SESSION['user']."','".$_POST['empappodate1']."','". $_POST['empappodate2']."','".$_POST['selnumOfRooms']."','".$_POST['selnumOfaduls']."','".$_POST['selnumOfchildren']."','P','".$_SESSION['user']."',now(),'NO','YES','$V_get_bunglow_booked')";
                             $quary_booking = mysqli_query($conn,$sql_booking) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
                         
                             if(!$quary_booking){
                                echo "<script> alert('Updated not success!');</script>";
                             }else{
                                $sql_bookingHitory = "INSERT INTO `leisure_history`(`bookingId`, `userName`, `fromDate`, `toDate`, `numOfRooms`, `numOfaduls`, `numOfChildren`, `state`, `enteredBy`, `enteredDataTime`,`salary_ded_ok`,`policy_read_ok`,`entire_bunglow_booked`) VALUES ('".$TableID."','".$_SESSION['user']."','".$_POST['empappodate1']."','". $_POST['empappodate2']."','".$_POST['selnumOfRooms']."','".$_POST['selnumOfaduls']."','".$_POST['selnumOfchildren']."','P','".$_SESSION['user']."',now(),'NO','YES','$V_get_bunglow_booked')";
                                $quary_bookingHitory = mysqli_query($conn,$sql_bookingHitory) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
                        
                                $date_get = str_replace('-', '/', $_POST['empappodate1']);
                                for($loop=0;$loop <$dateDiff ; $loop++){
                                    $CurrentDate = date('Y-m-d',strtotime($date_get."+$loop days"));
                            
                                    $sql_bookingDetels = "INSERT INTO `leisure_detels`(`bookingId`, `bookDate`, `numOfRooms`) VALUES ('".$TableID."','".$CurrentDate."','". $_POST['selnumOfRooms']."')"; 
                                    $quary_bookingDetels  = mysqli_query($conn,$sql_bookingDetels ) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
                                }
                                $sql_mail_select = "select leisure_parameter.to_mail from leisure_parameter"; 
                                $quary_mail_select = mysqli_query($conn,$sql_mail_select);
 			                    while($rec_mail_select= mysqli_fetch_array($quary_mail_select)){
 			                        $sql_del_user = "select user.userID,branch.branchName from user,branch where user.branchNumber = branch.branchNumber and user.userName = '".$_SESSION['user']."'";
            	                    $quary_del_user = mysqli_query($conn,$sql_del_user);
                                    while($rec_del_user= mysqli_fetch_array($quary_del_user)){
                                        $getmail = $rec_mail_select[0];
                                        $title = "Leisure Booking Request - ".$rec_del_user[0]."[".$_SESSION['user']."]";
                                        $message = "<html><head><title>HTML email</title></head><body>
<table border='1'>
	<tr>
        <td style='width:150px;text-align:left;padding-left:5px'>Branch : </td>
        <td style='width:300px; text-align:left; padding-left:5px'> ".$rec_del_user[1]." </td>
    </tr>
    <tr>
        <td style='width:150px;text-align:left;padding-left:5px'>From Date : </td>
        <td style='width:300px; text-align:left; padding-left:5px'> ".$_POST['empappodate1']." </td>
    </tr>
    <tr>
        <td style='width:150px;text-align:left;padding-left:5px'>To Date : </td>
        <td style='width:300px; text-align:left; padding-left:5px'> ".$_POST['empappodate2']." </td>
    </tr>
    <tr>
        <td style='width:150px;text-align:left;padding-left:5px'>Number Of Rooms : </td>
        <td style='width:300px; text-align:left; padding-left:5px'> ".$_POST['selnumOfRooms']." </td>
    </tr>
    <tr>
        <td style='width:150px;text-align:left;padding-left:5px'>Number Of Adults : </td>
        <td style='width:300px; text-align:left; padding-left:5px'> ".$_POST['selnumOfaduls']." </td>
    </tr>
    <tr>
        <td style='width:150px;text-align:left;padding-left:5px'>Number Of Children : </td>
        <td style='width:300px; text-align:left; padding-left:5px'> ".$_POST['selnumOfchildren']." </td>
    </tr>
</table><br/>    
URL : http://cdberp:8080/cdb/    
</body></html>";
                                        	$headers = "MIME-Version: 1.0" . "\r\n";
                                            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		
						                      // More headers
                                            $headers .= 'From: <cdberp@cdbnet.lk>' . "\r\n";
						                    $headers .= 'Cc:' . "\r\n";
				                            sendMailNuw($getmail,$title,$message,$headers);
                                        }   
         			                }
                                    echo "<script> alert('Booking was success.');</script>"; 
                                } 
                         }else {
                            echo "<script> alert('Error while creating booking reference.');</script>";
                         }
                    }
            }else{
                //echo $dateDiff;
                echo "<script> alert('Invalid Date(s)!');</script>"; 
            }
            }else{
                echo "<script> alert('You must accept the Policy to proceed.');</script>";  //You must accept the Policy and Salary deduction to proceed. 
            }
            
           // Commit transaction
	       mysqli_commit($conn);
           //Send e>>mail
           
        }catch(Exception $e){
	       // Rollback transaction
	       mysqli_rollback($conn);
	       echo 'Message: ' .$e->getMessage();
        }
	}
?>
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
</form>

</body>
</html>
