<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Helpdesk
Page Name		: Rental Calculator 
Purpose			: Rental Calculator using for Markating officer who get the some valves for loan
Author			: Madushan Wikramaarachchi
Date & Time		: 09.33 A.M 29/03/2016
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="hel/e/019";
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
<title>Rental Calculator</title>
<!-- Common function Libariries -->
<!-- CSS-->
    <link rel="stylesheet" type="text/css" href="../../../CSS/globleCSS.css"/>
    <link rel="stylesheet" type="text/css" href="../helpdesk_DEVELOPMENT/CSS/helpdesk_Style_Sheet.css"/>
    <link rel="stylesheet" href="jquery/jquery-ui.css" />
<!--Javascript-->
<script src="../../../js/commenfunction.js"></script>
<script src="../helpdesk_DEVELOPMENT/JAVASCRIPT_FUNCTION/helpdesk_js_function.js"></script>
<script src=" jquery/jquery-1.9.1.js"></script>
<script src="jquery/jquery-ui.js"></script>
<script type="text/javascript" src="NumericUpDown.js"></script>
<style type="text/css">
        body { font-family: Tahoma, Arial, Helvetica, sans-serif; }
        .numericUpDown {
                cursor: default;
                width: 35px;
                height: 18px;
                border: 1px solid #000;
                font-family: Tahoma, Arial, Helvetica, sans-serif;
                font-size: 13px;
        }
       
</style>

<!--END Common fumction Libariries-->

<script type="text/javascript"> 
//JAVASCRIPT FUNCTION START............................................................................................................................
function pageClose(){ //Page Close Function.......
	parent.location.href = parent.location.href;
    
}
function pageRef(){
   window.open('http://cdberp:8080/cdb/pages/helpdesk/Entry/makatinCal.php?DispName=Rental%20Calculator','conectpage');
}

function getRepayment_gried(){
    
    var status_r = document.getElementById('txt_Repayment_Type').value;
    //alert(status_r);
    if(status_r == "S"){
        document.getElementById('structured_gried').style.display = "inline";
    }else{
        document.getElementById('structured_gried').style.display = "none";
    }

    
}
 var i = 1;
function displayResult(){
	var ss = document.getElementById('txtb'+i).value;
	var cc = document.getElementById('txtc'+i).value;
	var x = document.getElementById("myTable").rows.length;
		if(ss != "" && cc != ""){
		var table=document.getElementById("myTable");
		var row=table.insertRow(-1);
		var cell1=row.insertCell(0);
		var cell2=row.insertCell(1);
		var cell3=row.insertCell(2);
		 var cell4=row.insertCell(3);
		cell1.innerHTML="<input style='width:80px;' type='text' name='txta"+(x)+"' id='txta"+(x)+"' value='"+(x)+"'  onKeyPress='return disableEnterKey(event)' readonly='readonly' />";
		cell2.innerHTML="<input style='width:150px;' type='text' name='txtb"+(x)+"' id='txtb"+(x)+"' value=''  onKeyPress='return disableEnterKey(event)' onkeydown='IntegerAllowed(event)'/>";
		cell3.innerHTML="<input style='width:150px;' type='text' name='txtc"+(x)+"' id='txtc"+(x)+"' value=''  onKeyPress='return disableEnterKey(event)' onkeydown='DecimalAllowed(event,this.value)'/>";
		 cell4.innerHTML="<img src='../../../img/dele.png' style='width:15px; margin-left: 10px;' onclick='deleteRow(this)'/>";
		document.getElementById('txtrow').value = document.getElementById("myTable").rows.length-1;
		document.getElementById('txtrow1').value = document.getElementById("myTable").rows.length-1;
		i++;
		}else{
			alert("Insert to data in befor row");
			//i = document.getElementById("myTable").rows.length;
		}
	
}

function deleteRow(n){
    var getA_vale = document.getElementById('txtb1').value;  
    //alert(getA_vale);
    if(getA_vale != ""){
   	    var num1_del = document.getElementById("myTable").rows.length;
       // alert(num1_del);
		//alert(m);
		//alert(num2);
        if(num1_del > 2 ){
            var m=n.parentNode.parentNode.rowIndex;
			document.getElementById('myTable').deleteRow(m);
			var num1 = document.getElementById("myTable").rows.length;
			var num2 = num1 - 1;
            //alert(num1_del);
			//alert(m);
			//alert(num2);
            document.getElementById('txtrow').value = num2;
			document.getElementById('txtrow1').value = num2;
			var y = 1;
			
			var  rowcount = document.getElementById("myTable").rows.length;
			i = rowcount-1;
			for(var mloop=2;mloop <=100;mloop++){
				var elementA =  document.getElementById('txta' + (mloop - 1));
				var elementB =  document.getElementById('txtb' + (mloop - 1));
				var elementC =  document.getElementById('txtc' + (mloop - 1));
				if (elementA != null)
				{
				  // Re-order the sequence of the table rows.............
				  elementA.value = y;
				  
				  //Changing the element ID's to capture in the php
				  elementA.id = 'txta' + y;				  
				  elementB.id = 'txtb' + y;
				  elementC.id = 'txtc' + y;
				  
				  //Changing the element name's to capture in the php				  
  			      elementA.name = 'txta' + y;				  
				  elementB.name = 'txtb' + y;
				  elementC.name = 'txtc' + y;
				  y++;
				}			
			}
        }else{
            alert('Can not delete row.');
        }
		
    }else{
        alert('Can not delete. First row is Empty.');
    }
			
}

function isCalculate(){
    //alert('isCalculate');
    var logUser = document.getElementById('logUser').value;
    
    var numrows       = document.getElementById('txtrow1').value;
    var LoanAmount    = document.getElementById('txt_Loan_Amount').value;
    var LoanPeriod    = document.getElementById('txt_Period').value;
    var InterestRate  = document.getElementById('txt_Rate').value;
    var VatRate       = document.getElementById('txt_VatRate').value;
    var NumDownPmt    = NumDownPayment.Value;
    var IP_txt_CapChg = document.getElementById('txt_CapChg').value;
    
    
    if(LoanAmount == ""){
        alert('Missing Loan Amount.');
    }else if(LoanPeriod == ""){
        alert('Missing Loan Period.');
    }else if(InterestRate == ""){
        alert('Missing Interest Rate.');
    }else{
        
        var RentalParam ;
        RentalParam = "";   
        var num_rental = 0;
        var amu = 0.00; 
        if(document.getElementById('txt_Repayment_Type').value == 'S'){
            for(var MCounter = 1;MCounter<=numrows;MCounter++ ){
                  RentalParam = RentalParam + MCounter + "|" + document.getElementById("txtc"+MCounter).value + "|" + document.getElementById("txtb"+MCounter).value + "|" + "M$";
                  num_rental = num_rental + parseInt(document.getElementById("txtb"+MCounter).value);
                  amu = amu + Number(document.getElementById("txtc"+MCounter).value);
            }
        }else{
             RentalParam = "1|||";
        }
           
        //alert('num_rental : '+num_rental);
        //alert('amu : '+amu);
        if(document.getElementById('txt_Repayment_Type').value == 'S'){
            /*if(LoanAmount != amu){
                alert('Loan Amount is not marching to Structured Total Amount.');
            }else */
            if(LoanPeriod != num_rental){
                alert('Loan Period is not marching to Number of Rental.')
            }else{
                var mydataSub;
                mydataSub= new XMLHttpRequest();
            	mydataSub.onreadystatechange=function(){
            		if(mydataSub.readyState==4){
            			document.getElementById('getGried').innerHTML = mydataSub.responseText;
            		}
            	}
            	mydataSub.open("GET","ajax_makatinCal.php"+"?logUser="+logUser+"&LoanAmount="+LoanAmount+"&LoanPeriod="+LoanPeriod+"&InterestRate="+InterestRate+"&VatRate="+VatRate+"&RentalParam="+RentalParam+"&NumDownPmt="+NumDownPmt+"&IP_txt_CapChg="+IP_txt_CapChg,true);
            	mydataSub.send();
            }
        }else{
            var mydataSub;
            mydataSub= new XMLHttpRequest();
        	mydataSub.onreadystatechange=function(){
        		if(mydataSub.readyState==4){
        			document.getElementById('getGried').innerHTML = mydataSub.responseText;
        		}
        	}
        	mydataSub.open("GET","ajax_makatinCal.php"+"?logUser="+logUser+"&LoanAmount="+LoanAmount+"&LoanPeriod="+LoanPeriod+"&InterestRate="+InterestRate+"&VatRate="+VatRate+"&RentalParam="+RentalParam+"&NumDownPmt="+NumDownPmt+"&IP_txt_CapChg="+IP_txt_CapChg,true);
        	mydataSub.send();
        }
    }
}
window.onload = function() {
    document.getElementById("txt_Loan_Amount").focus();
};

function DecimalAllowed(evt,Str){
  //alert(evt.keyCode);
  if ( evt.keyCode == 46 || evt.keyCode == 9 || evt.keyCode == 8 || evt.keyCode == 190  || evt.keyCode == 110) {
    		// let it happen, don't do anything
            if(evt.keyCode == 190 || evt.keyCode == 110){
                if(Str.indexOf(".") >0)
                    evt.preventDefault();    
            }
  }else {
    	// Ensure that it is a number and stop the keypress
    	if ((evt.keyCode >= 48 && evt.keyCode <= 57 ) || (evt.keyCode >= 96 && evt.keyCode <= 105)) 
            true;
        else
    		evt.preventDefault();	
    }
}

function IntegerAllowed(evt){
  if ( evt.keyCode == 46 || evt.keyCode == 8 || evt.keyCode == 9) {
    		// let it happen, don't do anything
  }else {
    	// Ensure that it is a number and stop the keypress
    	if ((evt.keyCode >= 48 && evt.keyCode <= 57 ) || (evt.keyCode >= 96 && evt.keyCode <= 105)) 
            true;
        else
    		evt.preventDefault();	
    }
}


//JAVASCRIPT FUNCTION END............................................................................................................................
</script>
</head>
<body oncontextmenu="return false" onkeydown="keyEvent(event)" onkeyup="metaKeyUp(event)">
<form action="" method="post" name="schform" enctype="multipart/form-data"> 
<p class="topline">
<?php  	echo $_REQUEST['DispName']; ?> 
</p><hr/>
<label class="linetop" style="margin-left: 80px; font-weight: bold;"><?php echo $_SESSION['user']." - ".$_SESSION['userID']; ?> </label><br /><br />
<span id="maneSpan">

<div style='display: none;'>
    <input type='text' name='logUser' id='logUser' value='<?php echo $_SESSION['user']; ?>' onkeypress='return disableEnterKey(event)'/> 
</div>
<table>
  <tr>
    <td style="width: 150px; text-align: right;"><label class="linetop">Loan Amount :</label></td>
    <td>
        <input autofocus="autofocus" class="box_decaretion" type="text"  style="width:100px;" name="txt_Loan_Amount" id="txt_Loan_Amount" value="" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" maxlength="18" placeholder="0.00" required="required" onkeydown="DecimalAllowed(event,this.value)" />
    </td>
    <td style="width: 150px; text-align: right;"><label  class="linetop" for="NumDownPayment">No of Downpayment:</label></td>
    <td>
        <input type="text" name="NumDownPayment" id="NumDownPayment" class="numericUpDown" readonly="readonly" />

        <script type="text/javascript">
        var NumDownPayment = new numericUpDown("NumDownPayment");
        NumDownPayment.Default = 0;
        NumDownPayment.Minimum = 0;
        NumDownPayment.Maximum = 99
        NumDownPayment.InterceptArrowKeys = false;
        </script>
        
        
    </td>
  </tr>
  <tr>
    <td style="width: 150px; text-align: right;"><label class="linetop">Period :</label></td>
    <td>
        <input class="box_decaretion" type="text"  style="width:100px;" name="txt_Period" id="txt_Period" value="" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" placeholder="0" required="required" onkeydown="IntegerAllowed(event)"/>
    </td>
    <td style="width: 150px; text-align: right;"><label class="linetop">Capitalized Charges :</label></td>
    <td>
        <input class="box_decaretion" type="text"  style="width:100px;" name="txt_CapChg" id="txt_CapChg" value="0" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" placeholder="0" required="required" onkeydown="DecimalAllowed(event,this.value)"/>
    </td>

    
  </tr>
  <tr>
    <td style="width: 150px; text-align: right;"><label class="linetop">Rate :</label></td>
    <td>
        <input class="box_decaretion" type="text"  style="width:100px;" name="txt_Rate" id="txt_Rate" value=""  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" placeholder="Rate" required="required" onkeydown="DecimalAllowed(event,this.value)"/>
    </td>
  </tr>
  <tr>
    <td style="width: 150px; text-align: right;"><label class="linetop">VAT Applicable :</label></td>
    <td>
        <select class="box_decaretion" name="txt_VatRate" id="txt_VatRate" onkeypress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)">
            <option value="0">No</option>
            <option value="11">Yes</option>
        </select>
    </td>
  </tr>
  <tr>
    <td style="width: 150px; text-align: right;"><label class="linetop">Repayment Type :</label></td>
    <td>
        <select class="box_decaretion" name="txt_Repayment_Type" id="txt_Repayment_Type" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeyup="getRepayment_gried();" onchange="getRepayment_gried();">
            <option value="F">Fixed</option>
            <option value="S">Structured</option>
        </select>
    </td>
  </tr>
</table>




<div id="structured_gried" style="display: none;">
<br />
<input class="buttonManage" style="margin-left: 150px;" type="button" onclick="displayResult()" value="Insert new row" id="rowNew" name="rowNew" />
<br /><br />
 <table border="1" cellpadding="0" cellspacing="0" style="margin-left: 150px;" id="myTable">
  <tr style="background-color: #BEBABA;">
    <td style="width:80px;">Index</td>
    <td style="width:150px;">Number of Rental</td>
    <td style="width:150px;">Amount</td>
    <td style="width:50px;"></td>
  </tr>
  <tr>
    <td style="width:80px;"><input style="width:80px;" type="text" name="txta1" id="txta1" value="1"  onkeypress="return disableEnterKey(event)" readonly="readonly" /></td>
    <td style="width:150px;"><input style="width:150px;" type="text" name="txtb1" id="txtb1" value=""  onkeypress="return disableEnterKey(event)" onkeydown="IntegerAllowed(event)" /></td>
    <td style="width:150px;"><input style="width:150px;" type="text" name="txtc1" id="txtc1" value=""  onkeypress="return disableEnterKey(event)" onkeydown="DecimalAllowed(event,this.value)"/></td>
     <td style="width:50px;"><img src="../../../img/dele.png" style="width:15px; margin-left: 10px;" onclick="deleteRow(this)"/></td>
  </tr>
</table>
<br/>
<div style='display:none;'>
<table>
  <tr>
    <td><label class="linetop">Number of Document(s) :</label></td>
    <td>
   		&nbsp;&nbsp;
        <div style='display:none;'>
			<input type="text" name="txtrow" id="txtrow" value="1"/>
        </div>
        <input class="box_decaretion" type="text" name="txtrow1" id="txtrow1" value="1" disabled="disabled"/>
   </td>
  </tr>
</table>
</div>
</div>

<div style="margin-left: 155px; padding-top: 5px;">
    <input class="buttonManage" style="width: 100px;" type="button" id="btnUsergroupSave" name="btnUsergroupSave" onclick="isCalculate();" value="Calculate "/>
    <input class="buttonManage" style="width: 100px;" type="button" id="btnUsergroupSave" name="btnUsergroupSave" onclick="pageRef();" value="Reset"/>
    <input class="buttonManage" style="width: 100px;" type="button" id="btnUsergroupSave" name="btnUsergroupSave" onclick="pageClose();" value="Close"/>
</div>


</span>
<hr/>
<!-- ****************************************************************************************************************************************************** -->
<span id="getGried"></span>

</form>
</body>
</html>
