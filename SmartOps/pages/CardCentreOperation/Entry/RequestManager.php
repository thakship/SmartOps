<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Card Centre Operation
Page Name		: Request Manager 
Purpose			: Edit for Debit Card Request  
Author			: Madushan Wikramaarachchi
Date & Time		: 01.16 P.M 23/06/2017
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="ccs/e/002";
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
    include('../CardCentreOperation_DEVELOPMENT/PHP_FUNCTION/ccs_commen_function.php');
    
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Card Centre Operation</title>
<!-- Common function Libariries -->
<!-- CSS-->
    <link rel="stylesheet" type="text/css" href="../../../CSS/globleCSS.css"/>
    <link rel="stylesheet" type="text/css" href="../CardCentreOperation_DEVELOPMENT/CSS/CardCentreOperation_Style_Sheet.css" />
<!--Javascript-->
<script src="../../../js/commenfunction.js"></script>
<script src="../CardCentreOperation_DEVELOPMENT/JAVASCRIPT_FUNCTION/CardCentreOperation_JavaScript.js"></script>
<!--END Common fumction Libariries-->

<link rel="stylesheet" href="jquery/jquery-ui.css" />
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
    
    .isLinkApprove{
        color: #67B4D8;
    }
    .isLinkPending{
        color: #396C13;
    }
    .isLinkReject{
        color: #A60000;
    }
</style>
<script src=" jquery/jquery-1.9.1.js"></script>
<script src="jquery/jquery-ui.js"></script>
<script type="text/javascript">
   function pageRef(){
     window.open('http://cdberp:8080/cdb/pages/CardCentreOperation/Entry/RequestManager.php?DispName=Request%20Manager','conectpage');
   }
   
 function isReject(title){
   // alert("R");
    var resTitle = title.split("|");
    document.getElementById('idTr'+resTitle[0]).style.backgroundColor = "#E8E8AD";
    var v_srting =  "R|"+resTitle[1]+"|Are you sure you want to Reject this?";
    popup(1,v_srting);
  }
  
  function isView(title){
   // alert("R");
    var resTitle = title.split("|");
    document.getElementById('idTr'+resTitle[0]).style.backgroundColor = "#E8E8AD";
	var mydataGried;
	mydataGried= new XMLHttpRequest();
	mydataGried.onreadystatechange=function(){
		if(mydataGried.readyState==4){
		    //alert('b');
			document.getElementById('maneSpan').innerHTML = mydataGried.responseText;         
            document.getElementById('sel_Collecting_Branch').value = document.getElementById('getCollectingBranch').value;
            document.getElementById('sel_Home_Branch').value = document.getElementById('getHomeBranch').value;
            document.getElementById('sel_Sal_Plus_Category').value = document.getElementById('getSPCI').value;
            
            
		}
	}
    mydataGried.open("GET","../CardCentreOperation_DEVELOPMENT/PHP_FUNCTION/ccs_commen_ajax.php"+"?get_herdIDEdit="+resTitle[1],true);
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
   
function isSolution(title){
    //alert(title);
    var arrTitle = title.split("|");
    //alert(arrTitle[0]);
    //alert(arrTitle[1]);
    var entryUserId = document.getElementById('txtMyUserID').value;
     var txtComment = document.getElementById('txtComment').value;
    if(txtComment != ""){
        $.ajax({ 
    		type:'POST', 
    		data: {getSolutionType : arrTitle[0] , getRequestId : arrTitle[1] , getComment : txtComment , getEntryUserId : entryUserId }, 
    		url: '../CardCentreOperation_DEVELOPMENT/PHP_FUNCTION/ccs_commen_function.php', 
    		success: function(val_retn) { 
    		    alert(val_retn); 
                pageRef();
                //document.getElementById('err').innerHTML = val_retn;
    		}
	   });
    }else{
        alert('Missing Remark.');
    }
    	
    
}

 function getPurchasingLimit(){
        var  isWithdrawalLimit = document.getElementById('sel_Withdrawal_Limit').value;
        var resaltarr = isWithdrawalLimit.split("|");
        document.getElementById('txt_PurchasingLimit').value = resaltarr[1];
         
 }
 
   function isRequest(){
       // alert('A');
        var getHeadID = document.getElementById('getHeadID').value;
        //alert("getHeadID : "+getHeadID);
        var entryUser = document.getElementById('txtMyUserID').value;
       // alert("getHeadID : "+entryUser); 
        var acc_01 = document.getElementById('txt_acc_01').value;
       // alert("acc_01 : "+acc_01);
        var acc_02 = document.getElementById('txt_acc_02').value;
      //  alert("acc_02 : "+acc_02);
        var acc_03 = document.getElementById('txt_acc_03').value;
      //  alert("acc_03 : "+acc_03);
        var acc_04 = document.getElementById('txt_acc_04').value;
     //   alert("acc_04 : "+acc_04);
        var txt_App_Received_date = document.getElementById('txt_App_Received_date').value;
       // alert("txt_App_Received_date : "+txt_App_Received_date);
        var txt_Acc_Opening_Date = document.getElementById('txt_Acc_Opening_Date').value;
      //  alert("txt_Acc_Opening_Date : "+txt_Acc_Opening_Date);
        var txt_Clint_title = document.getElementById('txt_Clint_title').value;
      //  alert("txt_Clint_title : "+txt_Clint_title);
        var txt_Clint_Name = document.getElementById('txt_Clint_Name').value;
      //  alert("txt_Clint_Name : "+txt_Clint_Name);
        var txt_Embossing_Name = document.getElementById('txt_Embossing_Name').value;
      //  alert("txt_Embossing_Name : "+txt_Embossing_Name);
        var sel_Collecting_Branch = document.getElementById('sel_Collecting_Branch').value;
      //  alert("sel_Collecting_Branch : "+sel_Collecting_Branch);
        var sel_Home_Branch = document.getElementById('sel_Home_Branch').value;
     //   alert("sel_Home_Branch : "+sel_Home_Branch);
        var txt_cif = document.getElementById('txt_cif').value;
      //  alert("txt_cif : "+txt_cif);
        var txt_NIC = document.getElementById('txt_NIC').value;
      //  alert("txt_NIC : "+txt_NIC);
        var txt_DOB = document.getElementById('txt_DOB').value;
     //   alert("txt_DOB : "+txt_DOB);
        var txt_Permanent_Add_line_01 = document.getElementById('txt_Permanent_Add_line_01').value;
      //  alert("txt_Permanent_Add_line_01 : "+txt_Permanent_Add_line_01);
        var txt_Permanent_Add_line_02 = document.getElementById('txt_Permanent_Add_line_02').value;
     //   alert("txt_Permanent_Add_line_02 : "+txt_Permanent_Add_line_02);
        var txt_Permanent_Add_line_03 = document.getElementById('txt_Permanent_Add_line_03').value;
     //   alert("txt_Permanent_Add_line_03 : "+txt_Permanent_Add_line_03);
        var txt_Permanent_Add_line_04 = document.getElementById('txt_Permanent_Add_line_04').value;
     //   alert("txt_Permanent_Add_line_04 : "+txt_Permanent_Add_line_04);
        var txt_Permanent_Add_line_05 = document.getElementById('txt_Permanent_Add_line_05').value;
     //   alert("txt_Permanent_Add_line_05 : "+txt_Permanent_Add_line_05);
        var txt_Permanent_Add_line_06 = document.getElementById('txt_Permanent_Add_line_06').value;
    //    alert("txt_Permanent_Add_line_06 : "+txt_Permanent_Add_line_06);
        
        /*var txt_Communication_Add_line_01 = document.getElementById('txt_Communication_Add_line_01').value;
        alert("txt_Communication_Add_line_01 : "+txt_Communication_Add_line_01);
        var txt_Communication_Add_line_02 = document.getElementById('txt_Communication_Add_line_02').value;
        alert("txt_Communication_Add_line_02 : "+txt_Communication_Add_line_02);
        var txt_Communication_Add_line_03 = document.getElementById('txt_Communication_Add_line_03').value;
        alert("txt_Communication_Add_line_03 : "+txt_Communication_Add_line_03);
        var txt_Communication_Add_line_04 = document.getElementById('txt_Communication_Add_line_04').value;
        alert("txt_Communication_Add_line_04 : "+txt_Communication_Add_line_04);
        var txt_Communication_Add_line_05 = document.getElementById('txt_Communication_Add_line_05').value;
        alert("txt_Communication_Add_line_05 : "+txt_Communication_Add_line_05);
       // var txt_Communication_Add_line_06 = document.getElementById('txt_Communication_Add_line_06').value;
        alert("B");
        //alert("txt_Communication_Add_line_06 : "+txt_Communication_Add_line_06);
           alert("C");*/
        var txt_Mother_Maiden_Name = document.getElementById('txt_Mother_Maiden_Name').value;
       // alert("txt_Mother_Maiden_Name :"+txt_Mother_Maiden_Name);
        var txt_Mobile_Number = document.getElementById('txt_Mobile_Number').value;
      //  alert("txt_Mobile_Number : "+txt_Mobile_Number);
        var txt_Home_TP = document.getElementById('txt_Home_TP').value;
      //  alert("txt_Home_TP : "+txt_Home_TP);
        var sel_Sal_Plus_Category = document.getElementById('sel_Sal_Plus_Category').value;
      //  alert("getHeadID : "+sel_Sal_Plus_Category);
        var txt_Previous_Card_No = document.getElementById('txt_Previous_Card_No').value;
      //  alert("txt_Previous_Card_No : "+txt_Previous_Card_No);
        var txt_IntroducerCode = document.getElementById('txt_IntroducerCode').value;
      //  alert("txt_IntroducerCode : "+txt_IntroducerCode);
        var txt_IntroducerBranchCode = document.getElementById('txt_IntroducerBranchCode').value;
      //  alert("txt_IntroducerBranchCode : "+txt_IntroducerBranchCode);
        var sel_Withdrawal_Limit = document.getElementById('sel_Withdrawal_Limit').value;
       //  alert("sel_Withdrawal_Limit : "+sel_Withdrawal_Limit);
        var txt_PurchasingLimit = document.getElementById('txt_PurchasingLimit').value;
       // alert("txt_PurchasingLimit : "+txt_PurchasingLimit);
        if(getHeadID == ""){
            alert("Missing Header Number");
        }else if(acc_01 == ""){
            alert("Missing Account Number");
            document.getElementById('txt_acc_01').focus();
        }else if(txt_App_Received_date == ""){
            alert("Missing App Received Date");
            document.getElementById('txt_App_Received_date').focus();
        }else if(txt_Acc_Opening_Date == ""){
            alert("Missing Acc Opening Date");
            document.getElementById('txt_Acc_Opening_Date').focus();
        }else if(txt_Clint_title == ""){
            alert("Missing Clint title");
            document.getElementById('txt_Clint_title').focus();
        }else if(txt_Clint_Name == ""){
            alert("Missing Clint Name");
            document.getElementById('txt_Clint_Name').focus();
        }else if(txt_Embossing_Name == ""){
            alert("Missing Embossing Name");
            document.getElementById('txt_Embossing_Name').focus();
        }else if(sel_Collecting_Branch == ""){
            alert("Missing Collecting Branch");
            document.getElementById('sel_Collecting_Branch').focus();
        }else if(sel_Home_Branch == ""){
            alert("Missing Home Branch");
            document.getElementById('sel_Home_Branch').focus();
        }else if(txt_cif == ""){
            alert("Missing CIF");
            document.getElementById('txt_cif').focus();
        }else if(txt_NIC == ""){
            alert("Missing NIC");
            document.getElementById('txt_NIC').focus();
        }else if(txt_DOB == ""){
            alert("Missing DATE OF BIRTH");
            document.getElementById('txt_DOB').focus();
        }else if(txt_Mother_Maiden_Name == ""){
            alert("Missing Mother Maiden Name");
            document.getElementById('txt_Mother_Maiden_Name').focus();
        }else if(sel_Withdrawal_Limit == ""){
            alert("Missing Withdrawal Limit");
            document.getElementById('sel_Withdrawal_Limit').focus();
        }else{
          //  alert("OK");
             //if(document.getElementById('p_ADDRESS').checked == true){
                var add1 = txt_Permanent_Add_line_01;
                var add2 = txt_Permanent_Add_line_02;
                var add3 = txt_Permanent_Add_line_03;
                var add4 = txt_Permanent_Add_line_04;
                var add5 = txt_Permanent_Add_line_05;
                var city = txt_Permanent_Add_line_06
             /*}else{
                var add1 = txt_Communication_Add_line_01;
                var add2 = txt_Communication_Add_line_02;
                var add3 = txt_Communication_Add_line_03;
                var add4 = txt_Communication_Add_line_04;
                var add5 = txt_Communication_Add_line_05;
                var city = txt_Communication_Add_line_06;
             }*/
             
             
          
            var r = confirm('Are you sure you want Request this?')
               if (r==true){
                    $.ajax({ 
            		  type:'POST', 
            		  data: {isgetHeadIDE : getHeadID , isEntryUserE : entryUser , isAcc_01E : acc_01 , isAcc_02E : acc_02 , isAcc_03E : acc_03 , isAcc_04E : acc_04 , isApp_Received_dateE : txt_App_Received_date , isAcc_Opening_DateE : txt_Acc_Opening_Date , isClint_titleE : txt_Clint_title , isClint_NameE : txt_Clint_Name , isEmbossing_NameE : txt_Embossing_Name , isCollecting_BranchE : sel_Collecting_Branch , isHome_BranchE : sel_Home_Branch , isCIFE : txt_cif , isNICE : txt_NIC , isDOBE : txt_DOB , isMother_Maiden_NameE : txt_Mother_Maiden_Name , isMobile_NumberE : txt_Mobile_Number , isHome_TPE : txt_Home_TP , isSal_Plus_CategoryE : sel_Sal_Plus_Category , isPrevious_Card_NoE : txt_Previous_Card_No , isIntroducerCodeE : txt_IntroducerCode , isIntroducerBranchCodeE : txt_IntroducerBranchCode , isWithdrawal_LimitE : sel_Withdrawal_Limit , isPurchasingLimitE : txt_PurchasingLimit , isadd1E : add1 , isadd2E : add2 , isadd3E : add3 , isadd4E : add4 , isadd5E : add5 , iscityE : city}, 
            		  url: '../CardCentreOperation_DEVELOPMENT/PHP_FUNCTION/ccs_commen_function.php', 
            		  success: function(val_retn) { 
        		         alert(val_retn); 
                         pageRef();
                        //document.getElementById('err').innerHTML = val_retn;
            		  }
        	       });
                }else{
        			//alert('BBBBB');		
                }    
        }
    }
 
</script>
</head>
<body oncontextmenu="return false">
<form action="" method="post" name="schform"  enctype="multipart/form-data"> 
<p class="topline">
<?php 
	echo $_REQUEST['DispName'];
?>
</p><hr/>
<div>
<span id="maneSpan"> 
<table border="1" id="myTable" cellpadding="0" cellspacing="0" style="background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;">
            <tr style="background-color: #BEBABA;">
                <td style="width:80px; text-align: right;"><span style="margin-right: 5px;">#</span></td>
                <td style="width:300px; text-align: left;"><span style="margin-left: 5px;">Client Name</span></td>
                <td style="width:100px; text-align: left;"><span style="margin-left: 5px;">NIC</span></td>
                <td style="width:50px; text-align: left;"><span style="margin-left: 5px;">ACC FREES</span></td>
                <td style="width:50px; text-align: left;"><span style="margin-left: 5px;">ACC INOPE.</span></td>
                <td style="width:50px; text-align: left;"><span style="margin-left: 5px;">ACC AVLBLE</span></td>
                <td style="width:150px;"></td>
            </tr>
<?php
    
    /*$v_sql_select = "SELECT u.HEADER_ID , u.EMBOSSING_NAME , u.NIC , u.ACC_FREES , u.ACC_INOPERATIVE , u.ACC_AVLBLE
                       FROM  card_header AS u 
                      WHERE u.AUTH_STATUS = 3 AND
                            u.HOME_BRANCH = '".$_SESSION['userBranch']."';";*/
    $v_sql_select = "SELECT u.HEADER_ID , u.EMBOSSING_NAME , u.NIC , u.ACC_FREES , u.ACC_INOPERATIVE , u.ACC_AVLBLE , a.branchNumber
                        FROM  card_header AS u  , user AS a
                        WHERE u.AUTH_STATUS = 3  AND
                              u.ENTRY_BY = a.userName  AND
                              a.branchNumber  = '".$_SESSION['userBranch']."';";
                        //echo $v_sql_select;
    $v_que_select = mysqli_query($conn,$v_sql_select) or die(mysqli_error($conn));
    $index = 0;
    while($res_Select = mysqli_fetch_assoc($v_que_select)){
        $index++;
        
        /*if($res_Select['ssb_cycle'] != 0){
            $col = "#F0D7A5";
        }else{
            $col = "#FFFFFF";
        }*/
        $col = "#FFFFFF";
        echo "<tr id='idTr".$index."' style='background-color: ".$col.";'>";
        echo "<td title='".$res_Select['HEADER_ID']."' onclick='getDtl(title);' style='width:80px; text-align: right;vertical-align: top;'><span  style='margin-right: 5px;'>".$index."</span></td>";
        echo "<td title='".$res_Select['HEADER_ID']."' onclick='getDtl(title);' style='width:300px; text-align: left;vertical-align: top;'><span  style='margin-left: 5px;'>".$res_Select['EMBOSSING_NAME']."</span></td>";
        echo "<td title='".$res_Select['HEADER_ID']."' onclick='getDtl(title);' style='width:100px; text-align: left;vertical-align: top;'><span  style='margin-left: 5px;'>".$res_Select['NIC']."</span></td>";
        if($res_Select['ACC_FREES'] == 0){
            echo "<td title='".$res_Select['HEADER_ID']."' onclick='getDtl(title);' style='width:50px; text-align: left;vertical-align: top;'><span  style='margin-left: 5px;'><img src='../../../img/1.png'></span></span></td>";
        }else if($res_Select['ACC_FREES'] == 1){
            echo "<td title='".$res_Select['HEADER_ID']."' onclick='getDtl(title);' style='width:50px; text-align: left;vertical-align: top;'><span  style='margin-left: 5px;'><img src='../../../img/2.png'></span></span></td>";
        }else{
            echo "<td title='".$res_Select['HEADER_ID']."' onclick='getDtl(title);' style='width:50px; text-align: left;vertical-align: top;'><span  style='margin-left: 5px;'><img src='../../../img/warning.png'></span></span></td>";
        }
        
        if($res_Select['ACC_INOPERATIVE'] == 0){
            echo "<td title='".$res_Select['HEADER_ID']."' onclick='getDtl(title);' style='width:50px; text-align: left;vertical-align: top;'><span  style='margin-left: 5px;'><img src='../../../img/1.png'></span></span></td>";
        }else if($res_Select['ACC_INOPERATIVE'] == 1){
            echo "<td title='".$res_Select['HEADER_ID']."' onclick='getDtl(title);' style='width:50px; text-align: left;vertical-align: top;'><span  style='margin-left: 5px;'><img src='../../../img/2.png'></span></span></td>";
        }else{
            echo "<td title='".$res_Select['HEADER_ID']."' onclick='getDtl(title);' style='width:50px; text-align: left;vertical-align: top;'><span  style='margin-left: 5px;'><img src='../../../img/warning.png'></span></span></td>";
        }
        
        if($res_Select['ACC_AVLBLE'] >= 400.000){
            echo "<td title='".$res_Select['HEADER_ID']."' onclick='getDtl(title);' style='width:50px; text-align: left;vertical-align: top;'><span  style='margin-left: 5px;'><img src='../../../img/1.png'></span></span></td>";
        }else{
            echo "<td title='".$res_Select['HEADER_ID']."' onclick='getDtl(title);' style='width:50px; text-align: left;vertical-align: top;'><span  style='margin-left: 5px;'><img src='../../../img/2.png'></span></span></td>";
        }
        echo "<td style='width:150px;'>";
        echo "<a class='isLinkApprove' href='#' title='".$index."|".$res_Select['HEADER_ID']."' onclick='isView(title);'>View</a> |  <a class='isLinkReject' href='#' title='".$index."|".$res_Select['HEADER_ID']."' onclick='isReject(title);'>Reject</a> ";
        echo "</td>";
        echo "</tr>";
    }
?>
</table>
</span>

<br /><hr />
<input class="buttonManage" style="width: 100px;" type="button" name="btnClose" id="btnClose" value="Close" onclick="pageClose();"/>
</div>
<div style="display: none;">
    <input type="text" id="txtMyUserID" name="txtMyUserID" value="<?php echo $_SESSION['user']; ?>" onkeypress="return disableEnterKey(event)" />
    <input type="text" id="txtMyUserGroup" name="txtMyUserGroup" value="<?php echo $_SESSION['usergroupNumber']; ?>" onkeypress="return disableEnterKey(event)" />
</div>
<div id="err"></div>
<div id="getGried"></div>
</form>
</body>
</html>