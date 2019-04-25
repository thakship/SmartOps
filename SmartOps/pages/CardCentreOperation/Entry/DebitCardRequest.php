<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Card Centre Operation
Page Name		: Debit Card Request
Purpose			: Request for Debit Card Request  
Author			: Madushan Wikramaarachchi
Date & Time		: 12.23 P.M 23/06/2017
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="ccs/e/001";
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
<title>Debit Card Request</title>
<!-- Common function Libariries -->
<!-- CSS-->
    <link rel="stylesheet" type="text/css" href="../../../CSS/globleCSS.css"/>
    <link rel="stylesheet" type="text/css" href="../CardCentreOperation_DEVELOPMENT/CSS/CardCentreOperation_Style_Sheet.css" />
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
		height:275px;
		overflow-y: scroll;
		border:#000000 solid 1px;
	}
    .isLinkApprove{
        color: #67B4D8;
    }
</style>
<!--Javascript-->
<script src="../../../js/commenfunction.js"></script>
<script src="../CardCentreOperation_DEVELOPMENT/JAVASCRIPT_FUNCTION/CardCentreOperation_JavaScript.js"></script>
<!--END Common fumction Libariries-->
<link rel="stylesheet" href="jquery/jquery-ui.css" />
<script src=" jquery/jquery-1.9.1.js"></script>
<script src="jquery/jquery-ui.js"></script>
<script language="javascript" type="text/javascript">
function ajaxFunction(e){
	var http;  // The variable that makes Ajax possible! 
    var e=e || window.event;
	var keycode=e.which || e.keyCode;
	if(keycode!==13 || (e.target||e.srcElement).value=='') return false;
	try{ 
		// Opera 8.0+, Firefox, Safari 
		http = new XMLHttpRequest(); 
	}catch(ex){ 
		// Internet Explorer Browsers 
		try{ 
			http = new ActiveXObject("Msxml2.XMLHTTP"); 
		}catch(ex){ 
    		try{ 
        		http = new ActiveXObject("Microsoft.XMLHTTP"); 
    		}catch(ex){ 
        		// Something went wrong 
        		alert("Your browser broke!"); 
        		return false; 
    		}
		}
	}
    //alert("A");
    var acc_01 = document.getElementById('txt_acc_01').value;
    //alert(acc_01);
    var pType = "I";
    var mydata;
	mydata = new XMLHttpRequest();
	mydata.onreadystatechange=function(){
		if(mydata.readyState==4){
			 results = mydata.responseText.split("|");
             //document.getElementById('err').innerHTML = mydata.responseText;
            alert(results[0]);
            if(results[0] != "J"){
                            if(results[0].trim() == "NOT"){
                                alert("Already Account is link in Card");
                            }else if(results[0].trim() == ""){
                                alert("Invalid Account Number.");
                            }else if(results[17].trim() == ""){
                                 alert("Missing Address.");
                            }else{
                                	/*
                                          0 - ACCNUM            varchar2(35) ,
                                          1 - AC_OPNDATE        varchar2(10),
                                          2 - CLTYPE            varchar2(1),
                                          3 - AC_CLCODE         number(12),
                                          4 - CL_SERIAL         number(3),
                                          5 - CL_CODE           number(12)  ,
                                          6 - CL_TITLE          varchar2(15),
                                          7 - CL_NAME           varchar2(270),
                                          8 - CL_NAME_INIT      varchar2(500),
                                          9 - CL_ID             varchar2(15),
                                         10 - CL_DOB            varchar2(10),
                                         11 - CL_COM_ADD_1      varchar2(50),
                                         12 - CL_COM_ADD_2      varchar2(50),
                                         13 - CL_COM_ADD_3      varchar2(50),
                                         14 - CL_COM_ADD_4      varchar2(50),
                                         15 - CL_COM_ADD_5      varchar2(50),
                                         16 - CL_COM_LOCATION   varchar2(50),
                                         17 - CL_PRM_ADD_1      varchar2(50),
                                         18 - CL_PRM_ADD_2      varchar2(50),
                                         19 - CL_PRM_ADD_3      varchar2(50),
                                         20 - CL_PRM_ADD_4      varchar2(50),
                                         21 - CL_PRM_ADD_5      varchar2(50),
                                         22 - CL_PRM_LOCATION   varchar2(50),
                                         23 - CL_GSM            varchar2(15),
                                         24 - CL_HOMETEL        varchar2(15)
                                        */
                                document.getElementById('txt_acc_01').value = results[0].trim();
                                document.getElementById('txt_Acc_Opening_Date').value = results[1].trim();
                                document.getElementById('txt_cif').value = results[5].trim();
                                document.getElementById('txt_Clint_title').value = results[6].trim();
                                document.getElementById('txt_Clint_Name').value = results[7].trim();
                                document.getElementById('txt_NIC').value = results[9].trim();
                                document.getElementById('txt_DOB').value = results[10].trim();
                                document.getElementById('txt_Permanent_Add_line_01').value  = results[17].trim();
                                document.getElementById('txt_Permanent_Add_line_02').value = results[18].trim();
                                document.getElementById('txt_Permanent_Add_line_03').value = results[19].trim();
                                document.getElementById('txt_Permanent_Add_line_04').value = results[20].trim();
                                document.getElementById('txt_Permanent_Add_line_05').value = results[21].trim();
                                document.getElementById('txt_Permanent_Add_line_06').value = results[22].trim();
                                document.getElementById('txt_Communication_Add_line_01').value = results[11].trim();
                                document.getElementById('txt_Communication_Add_line_02').value = results[12].trim();
                                document.getElementById('txt_Communication_Add_line_03').value = results[13].trim();
                                document.getElementById('txt_Communication_Add_line_04').value = results[14].trim();
                                document.getElementById('txt_Communication_Add_line_05').value = results[15].trim();
                                document.getElementById('txt_Communication_Add_line_06').value = results[16].trim();
                                document.getElementById('txt_Mobile_Number').value = results[23].trim();
                                document.getElementById('txt_Home_TP').value = results[24].trim();  
                                if(results[23].trim() == ""){
                                    alert("Missing Mobile Number.");
                                    document.getElementById('txt_Mobile_Number').style.backgroundColor = "#ff8080";
                                    
                                }
                                if(results[24].trim() == ""){
                                    document.getElementById('txt_Home_TP').style.backgroundColor = "#ff8080";   
                                }
                                if(results[25].trim() != ""){
                                     document.getElementById('txt_Previous_Card_No').value = results[25].trim();
                                     var res = results[25].trim().substring(12);
                                     document.getElementById('lbl_pcn').innerHTML = "****-****-****-"+res;
                                } 
                            }
            }else{
                //document.getElementById('getGrdDat').innerHTML = mydata.responseText;
                var mydataGried1;
    			mydataGried1 = new XMLHttpRequest();
    			mydataGried1.onreadystatechange=function(){
    				if(mydataGried1.readyState==4){
    					document.getElementById('getGrdDat').innerHTML = mydataGried1.responseText;   
    				}
    			}
    			mydataGried1.open("GET","ajax_Gried.php"+"?str_joint="+mydata.responseText,true);
    			mydataGried1.send();
                
            }
		}
	}
	mydata.open('GET','ajaxDebitCardRequest.php'+'?getAcc_01='+acc_01+'+&parpasType='+pType,true);
	mydata.send();
    
    
			
}
</script> 
<script type="text/javascript">
   function isLoadDtl(title){
        //alert(title);
        var mydataGried1;
		mydataGried1 = new XMLHttpRequest();
		mydataGried1.onreadystatechange=function(){
			if(mydataGried1.readyState==4){
				document.getElementById('getGrdDat').innerHTML = mydataGried1.responseText;   
			}
		}
		mydataGried1.open("GET","ajax_Gried.php"+"?str_singalClint="+title,true);
		mydataGried1.send();
        
   }
  
   function pageRef(){
     window.open('http://cdberp:8080/cdb/pages/CardCentreOperation/Entry/DebitCardRequest.php?DispName=Debit%20Card%20Request','conectpage');
   }
   
   function getPurchasingLimit(){
        var  isWithdrawalLimit = document.getElementById('sel_Withdrawal_Limit').value;
        var resaltarr = isWithdrawalLimit.split("|");
        document.getElementById('txt_PurchasingLimit').value = resaltarr[1];
         
   }
   
    function popup(x){
		if(x==1){
			var mydataGried;
			mydataGried= new XMLHttpRequest();
			mydataGried.onreadystatechange=function(){
				if(mydataGried.readyState==4){
					document.getElementById('getGried').innerHTML=mydataGried.responseText;  
					document.getElementById('outer').style.visibility = "visible";
					document.getElementById('conten').style.visibility = "visible";           
				}
			}
			mydataGried.open("GET","ajax_Gried.php"+"?sr_gried="+x,true);
			mydataGried.send();
			/*document.getElementById('outer').style.visibility = "visible";
			document.getElementById('conten').style.visibility = "visible";*/
		
	   }else{
		  document.getElementById('outer').style.visibility = "hidden";
		  document.getElementById('conten').style.visibility = "hidden";
	   }	
    }
    function fileSelect(){
		var mydata5;
		mydata5= new XMLHttpRequest();
		mydata5.onreadystatechange=function(){
			if(mydata5.readyState==4){
				document.getElementById('getNewtblPopup').innerHTML=mydata5.responseText;
			}
		}
		var searchup=document.getElementById('popupsearch').value;
		mydata5.open('GET','ajaxEntryPopu1.php'+'?txtsearch='+searchup,true);
		mydata5.send();
  }
  
  	function selectDB(xx){
			var id1 = document.getElementById('txt1'+xx).value;
			var id2 = document.getElementById('txt2'+xx).value;
            var id3 = document.getElementById('txt3'+xx).value;
            var id4 = document.getElementById('txt4'+xx).value;
			//alert(id1);
			//alert(id2);
			document.getElementById('txt_IntroducerCode').value = id1;
			document.getElementById('txt_Introducer_Name').value = id2;
            document.getElementById('txt_IntroducerBranchCode').value = id3;
			document.getElementById('txt_IntroducerBranchName').value = id4;
	}
    
    function isRequest(){
       // alert('A');
        
        var entryUser = document.getElementById('txtMyUserID').value;
        var entryBranch = document.getElementById('txtMyUserBRanch').value;
        var entryDepartment = document.getElementById('txtMyUserDepartment').value;
         
        var acc_01 = document.getElementById('txt_acc_01').value;
        var acc_02 = document.getElementById('txt_acc_02').value;
        var acc_03 = document.getElementById('txt_acc_03').value;
        var acc_04 = document.getElementById('txt_acc_04').value;
        var txt_App_Received_date = document.getElementById('txt_App_Received_date').value;
        var txt_Acc_Opening_Date = document.getElementById('txt_Acc_Opening_Date').value;
        var txt_Clint_title = document.getElementById('txt_Clint_title').value;
        var txt_Clint_Name = document.getElementById('txt_Clint_Name').value;
        var txt_Embossing_Name = document.getElementById('txt_Embossing_Name').value;
        var sel_Collecting_Branch = document.getElementById('sel_Collecting_Branch').value;
        var sel_Home_Branch = document.getElementById('sel_Home_Branch').value;
        var txt_cif = document.getElementById('txt_cif').value;
        var txt_NIC = document.getElementById('txt_NIC').value;
        var txt_DOB = document.getElementById('txt_DOB').value;
        var txt_Permanent_Add_line_01 = document.getElementById('txt_Permanent_Add_line_01').value;
        var txt_Permanent_Add_line_02 = document.getElementById('txt_Permanent_Add_line_02').value;
        var txt_Permanent_Add_line_03 = document.getElementById('txt_Permanent_Add_line_03').value;
        var txt_Permanent_Add_line_04 = document.getElementById('txt_Permanent_Add_line_04').value;
        var txt_Permanent_Add_line_05 = document.getElementById('txt_Permanent_Add_line_05').value;
        var txt_Permanent_Add_line_06 = document.getElementById('txt_Permanent_Add_line_06').value;
        var txt_Communication_Add_line_01 = document.getElementById('txt_Communication_Add_line_01').value;
        var txt_Communication_Add_line_02 = document.getElementById('txt_Communication_Add_line_02').value;
        var txt_Communication_Add_line_03 = document.getElementById('txt_Communication_Add_line_03').value;
        var txt_Communication_Add_line_04 = document.getElementById('txt_Communication_Add_line_04').value;
        var txt_Communication_Add_line_05 = document.getElementById('txt_Communication_Add_line_05').value;
        var txt_Communication_Add_line_06 = document.getElementById('txt_Communication_Add_line_06').value;
        var txt_Mother_Maiden_Name = document.getElementById('txt_Mother_Maiden_Name').value;
        var txt_Mobile_Number = document.getElementById('txt_Mobile_Number').value;
        var txt_Home_TP = document.getElementById('txt_Home_TP').value;
        var sel_Sal_Plus_Category = document.getElementById('sel_Sal_Plus_Category').value;
        var txt_Previous_Card_No = document.getElementById('txt_Previous_Card_No').value;
        var txt_IntroducerCode = document.getElementById('txt_IntroducerCode').value;
        var txt_IntroducerBranchCode = document.getElementById('txt_IntroducerBranchCode').value;
        var sel_Withdrawal_Limit = document.getElementById('sel_Withdrawal_Limit').value;
        //alert(sel_Withdrawal_Limit);
        var txt_PurchasingLimit = document.getElementById('txt_PurchasingLimit').value;
        
        if(acc_01 == ""){
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
             if(sel_Sal_Plus_Category == "" ){
                sel_Sal_Plus_Category = 0;
             }
             if(document.getElementById('p_ADDRESS').checked == true){
                var add1 = txt_Permanent_Add_line_01;
                var add2 = txt_Permanent_Add_line_02;
                var add3 = txt_Permanent_Add_line_03;
                var add4 = txt_Permanent_Add_line_04;
                var add5 = txt_Permanent_Add_line_05;
                var city = txt_Permanent_Add_line_06
             }else{
                var add1 = txt_Communication_Add_line_01;
                var add2 = txt_Communication_Add_line_02;
                var add3 = txt_Communication_Add_line_03;
                var add4 = txt_Communication_Add_line_04;
                var add5 = txt_Communication_Add_line_05;
                var city = txt_Communication_Add_line_06;
             }
          
            var r = confirm('Are you sure you want Request this?')
               if (r==true){
                    $.ajax({ 
            		  type:'POST', 
            		  data: {isEntryUser : entryUser , isAcc_01:acc_01 , isAcc_02:acc_02 , isAcc_03:acc_03 , isAcc_04:acc_04 , isApp_Received_date:txt_App_Received_date , isAcc_Opening_Date:txt_Acc_Opening_Date , isClint_title:txt_Clint_title , isClint_Name:txt_Clint_Name , isEmbossing_Name:txt_Embossing_Name , isCollecting_Branch:sel_Collecting_Branch , isHome_Branch:sel_Home_Branch , isCIF:txt_cif , isNIC:txt_NIC , isDOB:txt_DOB , isMother_Maiden_Name:txt_Mother_Maiden_Name , isMobile_Number:txt_Mobile_Number , isHome_TP:txt_Home_TP , isSal_Plus_Category:sel_Sal_Plus_Category , isPrevious_Card_No:txt_Previous_Card_No , isIntroducerCode:txt_IntroducerCode , isIntroducerBranchCode:txt_IntroducerBranchCode , isWithdrawal_Limit:sel_Withdrawal_Limit , isPurchasingLimit:txt_PurchasingLimit , isadd1:add1 , isadd2:add2 , isadd3:add3 , isadd4:add4 , isadd5:add5 , iscity : city , isentryBranch : entryBranch , isentryDepartment : entryDepartment}, 
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
<script>
  $(function() {
    $( "#txt_App_Received_date" ).datepicker({dateFormat:"yy-mm-dd"});
  });
  $(function() {
    $( "#txt_Acc_Opening_Date" ).datepicker({dateFormat:"yy-mm-dd"});
  });
</script>

</head>
<body oncontextmenu="return false">
<form action="" method="post" name="schform"  enctype="multipart/form-data"> 
<p class="topline">
<?php 
	echo $_REQUEST['DispName'];
?>
</p><hr/>
<div id="getGrdDat">
<table>
    <tr>
        <td style="width: 160px; text-align: right;"><label class="linetop">ACCOUNT :</label></td>
        <td>
            <input type="text" class="box_decaretion" maxlength="20" style="width:250px;" name="txt_acc_01" id="txt_acc_01" value="" onkeypress="return disableEnterKey(event)" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" placeholder="Account 01" onkeyup="ajaxFunction(event)"/>
        </td>
    </tr>
    <tr>
        <td style="width: 160px; text-align: right; vertical-align: top;"><label class="linetop">&nbsp;</label></td>
        <td>
             <input type="text" class="box_decaretion" maxlength="20" style="width:250px;" name="txt_acc_02" id="txt_acc_02" value="" onkeypress="return disableEnterKey(event)" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" placeholder="Account 02"/>
             <input type="text" class="box_decaretion" maxlength="20" style="width:250px;" name="txt_acc_03" id="txt_acc_03" value="" onkeypress="return disableEnterKey(event)" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" placeholder="Account 03"/>
             <input type="text" class="box_decaretion" maxlength="20" style="width:250px;" name="txt_acc_04" id="txt_acc_04" value="" onkeypress="return disableEnterKey(event)" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" placeholder="Account 04"/>
        </td>
    </tr>
    <tr>
        <td style="width: 160px; text-align: right; vertical-align: top;"><label class="linetop">APP RECEIVED DATE :</label></td>
        <td>
             <input type="text" class="box_decaretion" style="width:100px;" name="txt_App_Received_date" id="txt_App_Received_date" value="" onkeypress="return disableEnterKey(event)" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" placeholder="----/--/--"/>&nbsp;&nbsp;
             <label class="linetop">ACC OPENING DATE : </label>&nbsp;
             <input type="text" class="box_decaretion" style="width:100px;background-color: #B6B6B6;" name="txt_Acc_Opening_Date" id="txt_Acc_Opening_Date" value="" onkeypress="return disableEnterKey(event)" placeholder="----/--/--"/>
        </td>
    </tr>
    <tr>
        <td style="width: 160px; text-align: right; vertical-align: top;"><label class="linetop">CLIENT :</label></td>
        <td>
             <input type="text" class="box_decaretion" maxlength="5" style="width:50px;background-color: #B6B6B6;" name="txt_Clint_title" id="txt_Clint_title" value="" onkeypress="return disableEnterKey(event)" readonly="readonly"/>
             <input type="text" class="box_decaretion" style="width:500px;background-color: #B6B6B6;" name="txt_Clint_Name" id="txt_Clint_Name" value="" onkeypress="return disableEnterKey(event)" placeholder="Clint Name" readonly="readonly"/>
        </td>
    </tr>
    <tr>
        <td style="width: 160px; text-align: right; vertical-align: top;"><label class="linetop">EMBOSSING NAME :</label></td>
        <td>
            <input type="text" class="box_decaretion" style="width:500px;" name="txt_Embossing_Name" id="txt_Embossing_Name" value="" onkeypress="return disableEnterKey(event)" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" placeholder="Embossing Name"/>
        </td>
    </tr>
    <tr>
        <td style="width: 160px; text-align: right; vertical-align: top;"><label class="linetop">COLLECTING BRANCH :</label></td>
        <td>
            <select class="box_decaretion"  style="width: 200px;" name="sel_Collecting_Branch" id="sel_Collecting_Branch" onkeypress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)">
            <option value="">--Select Collecting Branch --</option>
            <?php
                $v_sql_Collecting_Branch = "SELECT b.branchNumber , b.branchName FROM branch AS b WHERE b.branchNumber != '0001';";
                $que_Collecting_Branch = mysqli_query($conn,$v_sql_Collecting_Branch);
                while($RES_Collecting_Branch = mysqli_fetch_array($que_Collecting_Branch)){
                    echo "<option value='".$RES_Collecting_Branch[0]."'>".$RES_Collecting_Branch[1]."</option>";
                }
            ?>
            </select> 
             
             
             &nbsp;&nbsp;
             <label class="linetop">HOME BRANCH : </label>&nbsp;
             <select class="box_decaretion"  style="width: 200px;" name="sel_Home_Branch" id="sel_Home_Branch" onkeypress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)">
                <option value="">--Select Home Barnch --</option>
                <?php
                    $v_sql_Home_Branch = "SELECT b.branchNumber , b.branchName FROM branch AS b WHERE b.branchNumber != '0001';";
                    $que_Home_Branch = mysqli_query($conn,$v_sql_Home_Branch);
                    while($RES_Home_Branch = mysqli_fetch_array($que_Home_Branch)){
                        echo "<option value='".$RES_Home_Branch[0]."'>".$RES_Home_Branch[1]."</option>";
                    }
                ?>
                </select> 

        </td>
    </tr>
    <tr>
        <td style="width: 160px; text-align: right; vertical-align: top;"><label class="linetop">CIF :</label></td>
        <td>
             <input type="text" class="box_decaretion" maxlength="12" style="width:100px;background-color: #B6B6B6;" name="txt_cif" id="txt_cif" value="" onkeypress="return disableEnterKey(event)"  placeholder="CIF" readonly="readonly"/>
             <label class="linetop">NIC : </label>
             <input type="text" class="box_decaretion" maxlength="15" style="width:200px;background-color: #B6B6B6;" name="txt_NIC" id="txt_NIC" value="" onkeypress="return disableEnterKey(event)" placeholder="NIC" readonly="readonly"/>
             <label class="linetop">DATE OF BIRTH : </label>
             <input type="text" class="box_decaretion" style="width:100px;background-color: #B6B6B6;" name="txt_DOB" id="txt_DOB" value="" onkeypress="return disableEnterKey(event)" placeholder="----/--/--" />
        </td>
    </tr>
</table>
<table>
    <tr>
        <td style="width: 160px; text-align: right;vertical-align: top;"><label class="linetop">PERMANENT ADDRESS :</label></td>
        <td>
            <input type="radio" name="rod_ADDRESS" id="p_ADDRESS" value="1" checked="checked" /><br /><br />
            <input type="text" class="box_decaretion" style="width:250px;background-color: #B6B6B6;" name="txt_Permanent_Add_line_01" id="txt_Permanent_Add_line_01" value="" onkeypress="return disableEnterKey(event)" placeholder="Address Line 01" /><br />
            <input type="text" class="box_decaretion" style="width:250px;margin-top: 3px;background-color: #B6B6B6;" name="txt_Permanent_Add_line_02" id="txt_Permanent_Add_line_02" value="" onkeypress="return disableEnterKey(event)" placeholder="Address Line 02" /><br />
            <input type="text" class="box_decaretion" style="width:250px;margin-top: 3px;background-color: #B6B6B6;" name="txt_Permanent_Add_line_03" id="txt_Permanent_Add_line_03" value="" onkeypress="return disableEnterKey(event)" placeholder="Address Line 03" /><br />
            <input type="text" class="box_decaretion" style="width:250px;margin-top: 3px;background-color: #B6B6B6;" name="txt_Permanent_Add_line_04" id="txt_Permanent_Add_line_04" value="" onkeypress="return disableEnterKey(event)" placeholder="Address Line 04" /><br />
            <input type="text" class="box_decaretion" style="width:250px;margin-top: 3px;background-color: #B6B6B6;" name="txt_Permanent_Add_line_05" id="txt_Permanent_Add_line_05" value="" onkeypress="return disableEnterKey(event)" placeholder="Address Line 05" /><br />
            <input type="text" class="box_decaretion" style="width:250px;margin-top: 3px;background-color: #B6B6B6;" name="txt_Permanent_Add_line_06" id="txt_Permanent_Add_line_06" value="" onkeypress="return disableEnterKey(event)" placeholder="City" /><br />
        </td>
        <td style="width: 160px; text-align: right;vertical-align: top;"><label class="linetop">COMMUNICATION ADDRESS :</label></td>
        <td>
             <input type="radio" name="rod_ADDRESS" id="c_ADDRESS" value="2" /><br /><br />
            <input type="text" class="box_decaretion" style="width:250px;background-color: #B6B6B6;" name="txt_Communication_Add_line_01" id="txt_Communication_Add_line_01" value="" onkeypress="return disableEnterKey(event)" placeholder="Address Line 01" /><br />
            <input type="text" class="box_decaretion" style="width:250px;margin-top: 3px;background-color: #B6B6B6;" name="txt_Communication_Add_line_02" id="txt_Communication_Add_line_02" value="" onkeypress="return disableEnterKey(event)" placeholder="Address Line 02" /><br />
            <input type="text" class="box_decaretion" style="width:250px;margin-top: 3px;background-color: #B6B6B6;" name="txt_Communication_Add_line_03" id="txt_Communication_Add_line_03" value="" onkeypress="return disableEnterKey(event)" placeholder="Address Line 03" /><br />
            <input type="text" class="box_decaretion" style="width:250px;margin-top: 3px;background-color: #B6B6B6;" name="txt_Communication_Add_line_04" id="txt_Communication_Add_line_04" value="" onkeypress="return disableEnterKey(event)" placeholder="Address Line 04" /><br />
            <input type="text" class="box_decaretion" style="width:250px;margin-top: 3px;background-color: #B6B6B6;" name="txt_Communication_Add_line_05" id="txt_Communication_Add_line_05" value="" onkeypress="return disableEnterKey(event)" placeholder="Address Line 05"/><br />
            <input type="text" class="box_decaretion" style="width:250px;margin-top: 3px;background-color: #B6B6B6;" name="txt_Communication_Add_line_06" id="txt_Communication_Add_line_06" value="" onkeypress="return disableEnterKey(event)" placeholder="City" /><br />
        </td>
    </tr>
</table>
<table>
    <tr>
        <td style="width: 160px; text-align: right;"><label class="linetop">MOTHER MAIDEN NAME :</label></td>
        <td>
            <input type="text" class="box_decaretion" style="width:500px;" name="txt_Mother_Maiden_Name" id="txt_Mother_Maiden_Name" value="" onkeypress="return disableEnterKey(event)" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" placeholder="Mother Maiden Name"/>
        </td>
    </tr>
    <tr>
        <td style="width: 160px; text-align: right; vertical-align: top;"><label class="linetop">MOBILE NUMBER :</label></td>
        <td>
             <input type="text" class="box_decaretion" maxlength="10" style="width:100px;" name="txt_Mobile_Number" id="txt_Mobile_Number" value="" onkeypress="return disableEnterKey(event)" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)"/>&nbsp;&nbsp;
             <label class="linetop">HOME TP : </label>&nbsp;
             <input type="text" class="box_decaretion" maxlength="10" style="width:100px;" name="txt_Home_TP" id="txt_Home_TP" value="" onkeypress="return disableEnterKey(event)" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" />
        </td>
    </tr>
    <tr>
        <td style="width: 160px; text-align: right; vertical-align: top;"><label class="linetop">SAL PLUS CATEGORY :</label></td>
        <td>
            <select class="box_decaretion"  style="width: 200px;" name="sel_Sal_Plus_Category" id="sel_Sal_Plus_Category" onkeypress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)">
            <option value="">--Select Sal Plus Category --</option>
            <?php
                $sql_SAL = "SELECT cs.SAL_PLUS_CATEGORY_ID , cs.SAL_PLUS_CATEGORY_DIS FROM card_sal_plus_category AS cs;";
                $que_SAL = mysqli_query($conn,$sql_SAL);
                while($RES_SAL = mysqli_fetch_array($que_SAL)){
                    echo "<option value='".$RES_SAL[0]."'>".$RES_SAL[1]."</option>";
                }
            ?>
            </select> 
        </td>
    </tr>
    <tr>
        <td style="width: 160px; text-align: right;"><label class="linetop">PREVIOUS CARD NO. :</label></td>
        <td>
            <input type="text" class="box_decaretion" maxlength="20" style="width:250px; display: none;" name="txt_Previous_Card_No" id="txt_Previous_Card_No" value="" onkeypress="return disableEnterKey(event)" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" placeholder="Previous Card No."/>
            <label id="lbl_pcn" style="color: #B70000;"></label>
        </td>
    </tr>
    <tr>
        <td style="width: 160px; text-align: right; vertical-align: top;"><label class="linetop">INTRODUCER :</label></td>
        <td>
             <input type="text" class="box_decaretion" maxlength="10" style="width:70px;background-color: #B6B6B6;" name="txt_IntroducerCode" id="txt_IntroducerCode" value="" onkeypress="return disableEnterKey(event)" onclick="popup(1);" readonly="readonly"/>
             <input type="text" class="box_decaretion" style="width:500px;background-color: #B6B6B6;" name="txt_Introducer_Name" id="txt_Introducer_Name" value="" onkeypress="return disableEnterKey(event)" placeholder="Introducer Name" onclick="popup(1);" readonly="readonly"/>
             <input class="buttonManage" style="width: 50px;" type="button" name="btnRequest" id="btnRequest" value="..." onclick="popup(1);"/>
        </td>
    </tr>
    <tr>
        <td style="width: 160px; text-align: right; vertical-align: top;"><label class="linetop">INTRODUCER BRANCH :</label></td>
        <td>
             <input type="text" class="box_decaretion" style="width:70px;background-color: #B6B6B6;" name="txt_IntroducerBranchCode" id="txt_IntroducerBranchCode" value="" onkeypress="return disableEnterKey(event)"  readonly="readonly"/>
             <input type="text" class="box_decaretion" style="width:250px;background-color: #B6B6B6;" name="txt_IntroducerBranchName" id="txt_IntroducerBranchName" value="" onkeypress="return disableEnterKey(event)"  placeholder="Introducer Branch" readonly="readonly"/>
        </td>
    </tr>
     <tr>
        <td style="width: 160px; text-align: right; vertical-align: top;"><label class="linetop">WITHDRAWAL LIMIT :</label></td>
        <td>
            <select class="box_decaretion"  style="width: 200px;" name="sel_Withdrawal_Limit" id="sel_Withdrawal_Limit" onkeypress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onchange="getPurchasingLimit();">
            <option value="">--Select Withdrawal Limit--</option>
            <?php
                $v_sql_W = "SELECT w.WP_ID , w.WITHDRAWAL_LIMIT , w.PURCHASING_LIMIT FROM card_withdrawal_pos_header AS w";
                $que_W = mysqli_query($conn,$v_sql_W);
                while($RES_W = mysqli_fetch_array($que_W)){
                    echo "<option value='".$RES_W[0]."|".$RES_W[2]."|".$RES_W[1]."'>".$RES_W[1]." - ".$RES_W[2]."</option>";
                }
            ?>
            </select> 
             
             
             &nbsp;&nbsp;
             <label class="linetop">PURCHASING LIMIT : </label>&nbsp;
             <input type="text" class="box_decaretion" style="width:200px;background-color: #B6B6B6;" name="txt_PurchasingLimit" id="txt_PurchasingLimit" value="" onkeypress="return disableEnterKey(event)" readonly="readonly" />
        </td>
    </tr>
</table>
<br /><hr />
<input class="buttonManage" style="width: 100px;" type="button" name="btnRequest" id="btnRequest" value="Request" onclick="isRequest();"/>
<input class="buttonManage" style="width: 100px;" type="button" name="btnClose" id="btnClose" value="Close" onclick="pageClose();"/>
</div>
<div style="display: none;">
    <input type="text" id="txtMyUserID" name="txtMyUserID" value="<?php echo $_SESSION['user']; ?>" onkeypress="return disableEnterKey(event)" />
    <input type="text" id="txtMyUserGroup" name="txtMyUserGroup" value="<?php echo $_SESSION['usergroupNumber']; ?>" onkeypress="return disableEnterKey(event)" />
    <input type="text" id="txtMyUserBRanch" name="txtMyUserBRanch" value="<?php echo $_SESSION['userBranch']; ?>" onkeypress="return disableEnterKey(event)" />
    <input type="text" id="txtMyUserDepartment" name="txtMyUserDepartment" value="<?php echo $_SESSION['userDepartment']; ?>" onkeypress="return disableEnterKey(event)" />
</div>
<div id="err"></div>
<span id="getGried"></span>
</form>
</body>
</html>