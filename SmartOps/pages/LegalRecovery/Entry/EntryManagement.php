<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Legal Recovery
Page Name		: Entry Management
Purpose			: Entry Up to table for data
Author			: Madushan Wikramaarachi
Date & Time		: 03:08 P.M - 2016-12-19
------------------------------------------------------------------------------------------------------------------------>
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="lre/e/001";
	$_SESSION['Module'] = "Legal Recovery";
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Entry Management</title>

    <!-- Bootstrap Core CSS -->
    <link href="../../../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- MetisMenu CSS -->
    <link href="../../../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet" />

    <!-- Custom CSS -->
    <link href="../../../dist/css/realSolution_1.css" rel="stylesheet" />

    <!-- Custom Fonts -->
    <link href="../../../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<!-- Common function Libariries -->
<!-- CSS-->
<!--<link rel="stylesheet" type="text/css" href="../../../CSS/globleCSS.css"/>
<link rel="stylesheet" type="text/css" href="../ADMIN_DEVELOPMENT/CSS/admin_Style_Sheet.css"/>-->
<!--Javascript-->
<script src="../../../js/jsLey.js"></script>
<script src="../../../js/commenfunction.js"></script>
<script src="../ADMIN_DEVELOPMENT/JAVASCRIPT_FUNCTION/admin_JavaScript.js"></script>
<!--END Common fumction Libariries-->
</head>
<body oncontextmenu="return false">
<form class="form-horizontal" action="" method="post" style="margin-left: 20px;">
<h3>
<?php 
	echo $_REQUEST['DispName'];
?>
</h3>
<hr/>
<div class="container-fluid">
    <div class="panel panel-default">
            <div class="panel-heading">
                   Entry Management Information
            </div>
            <div class="panel-body">
                 <div class='form-group'>
		             <label class="col-sm-2">Customer Code : </label>
                     <div class="col-sm-3">
                        <input type="text" class="form-control input-sm" id="txtCustomerCode" name="txtCustomerCode" value="" maxlength="8" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeypress="return disableEnterKey(event)" required="required" />
				     </div>
					<label class="col-sm-2">Facility No : </label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control input-sm" id="txtFacilityNo" name="txtFacilityNo" value="" maxlength="20" onkeypress="return disableEnterKey(event)" required="required" />
				    </div>
                 </div>
                 <div class='col-lg-12'>
					
				 </div>
                 <div class="form-group">
					<label class="col-sm-2">Customer Name : </label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control input-sm" id="txtCustomerName" name="txtCustomerName" value="" onkeypress="return disableEnterKey(event)" required="required" />
				    </div>
                 </div>
                 <div class='col-lg-12'>
					
				 </div>
                 <div class="form-group">
					<label class="col-sm-2">Customer Mobile : </label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control input-sm" id="txtCustomerMobile" name="txtCustomerMobile" value="" maxlength="10" onkeypress="return disableEnterKey(event)" required="required" />
				    </div>
                  </div>
                 <div class='col-lg-12'>
					
				 </div>
                 <div class="form-group">
					<label class="col-sm-2">Customer Telephone : </label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control input-sm" id="txtCustomerTelephone" name="txtCustomerTelephone" value="" maxlength="10" onkeypress="return disableEnterKey(event)" required="required" />
				    </div>
                  </div>
                 <div class='col-lg-12'>
					
				 </div>
                 <div class="form-group">   
                	<label class="col-sm-2">Product Type : </label>
                    <div class="col-sm-3">
                        <select class="form-control input-sm" id="txtProductType" name="txtProductType" onkeypress="return disableEnterKey(event)">
                             <option value="">-- Select Product Type --</option>
                             <?php
                                $sql_Product_type = "SELECT `product_id`, `product_name` FROM `lr_product`;";
                                $query_Product_type = mysqli_query($conn,$sql_Product_type) or die(mysqli_error($conn));
                                while($rec_Product_type = mysqli_fetch_array($query_Product_type)){
                                    echo "<option value='".$rec_Product_type[1]."'>".$rec_Product_type[1]."</option>";
                                }
                             ?>
                        </select>
				    </div> 
                	<label class="col-sm-2">Facility Type : </label>
                    <div class="col-sm-3">
                        <select class="form-control input-sm" id="txtFacilityType" name="txtFacilityType" onkeypress="return disableEnterKey(event)">
                            <option value="">-- Select Facility Type --</option>
                            <option value="Fix Rentals">Fix Rentals</option>
                            <option value="Structured Rentals">Structured Rentals</option>
                        </select>
				    </div>
                 </div>
                 <div class='col-lg-12'>
					
				 </div>
                 <div class="form-group">
					<label class="col-sm-2">Period : </label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control input-sm" id="txtPeriod" title="Number of Months" maxlength="3" name="txtPeriod" value="" onkeypress="return disableEnterKey(event)" required="required" />
                    </div>
                    <label class="col-sm-2">Start Date : </label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control input-sm" id="txtStartDate" name="txtStartDate" value="" onkeypress="return disableEnterKey(event)" required="required" />
                    </div>
                 </div>
                 <div class='col-lg-12'>
					
				 </div>
                 <div class="form-group">
					<label class="col-sm-2">Facility Status : </label>
                    <div class="col-sm-3">
                        <select class="form-control input-sm" id="txtFacilityStatus" name="txtFacilityStatus" onkeypress="return disableEnterKey(event)">
                            <option value="">-- Select Facility Status --</option>
                            <option value="Active">Active</option>
                            <option value="Close">Close</option>
                        </select>
                    </div>
                 	<label class="col-sm-2">Facility Amount : </label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control input-sm" id="txtFacilityAmount" name="txtFacilityAmount" maxlength="15" value="" onkeypress="return disableEnterKey(event)" required="required" placeholder="0.00" />
				    </div>
                 </div>
                  <div class='col-lg-12'>
					
				 </div>
                 <div class="form-group">
					<label class="col-sm-2">Expiry Date : </label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control input-sm" id="txtExpiryDate" name="txtExpiryDate" value="" onkeypress="return disableEnterKey(event)" required="required" />
				    </div>
					<label class="col-sm-2">Activation Date : </label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control input-sm" id="txtAcctivationDate" name="txtAcctivationDate" value="" onkeypress="return disableEnterKey(event)" required="required" />
				    </div>
                 </div>
                 <div class='col-lg-12'>
					
				 </div>
                 <div class="form-group">
					<label class="col-sm-2">Actual Loss Amount: </label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control input-sm" id="txtActualLossAmount" name="txtActualLossAmount" maxlength="15" value="" onkeypress="return disableEnterKey(event)" placeholder="0.00" required="required"/>
				    </div>
                     <div class="col-sm-3">
                        <select class="form-control input-sm" id="txtDesition" name="txtDesition" onkeypress="return disableEnterKey(event)">
                            <option value="">-- Select Status --</option>
                            <option value="Profit">Profit</option>
                            <option value="Loss">Loss</option>
                        </select>
				    </div>
                 </div>
			</div>
    </div>
</div>
<div class="container-fluid">
     <input type="button" class="btn btn-success col-sm-1" style="margin-right: 10px;" id="btnCalculator" value="Calculator" onclick="genGried();" />
     <input type="button" class="btn btn-success col-sm-1" style="margin-right: 10px;" id="btnSumbit" value="Submit" disabled="disabled" onclick="isSubmit();" />
     <input type="button" class="btn btn-success col-sm-1" style="margin-right: 10px;" value="Close" onclick="pageClose();" />
</div>

<br />
<hr />
<div class="panel panel-default">
                <div class="panel-heading">
                    Your Calculator 
                </div>
                <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <span id="diva">
                                               
                            </span>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            <span id="error"></span>
</form>
<link rel="stylesheet" href="jquery/jquery-ui.css" />
<script src=" jquery/jquery-1.9.1.js"></script>
<script src="jquery/jquery-ui.js"></script>
<script type="text/javascript">
    // ----------------------------- Page Close Function ------------------------------------------------------------------------
    function pageClose(){ 
	   parent.location.href = parent.location.href;
    }
    function pageref(){ 
	   window.open('http://cdberp:8080/cdb/pages/LegalRecovery/Entry/EntryManagement.php?DispName=Entry%20Management','conectpage');
    }
    
    // ----------------------------- Load table for calculater -----------------------------------------------------------------
    /*function genExpiarDate(){
        var startDate = document.getElementById("txtStartDate").value;
        alert(startDate);
        //var d = new Date();
        
    }*/
    function genGried(){
        //alert('a');
        var period = document.getElementById("txtPeriod").value;
        var facilityAmount = document.getElementById("txtFacilityAmount").value;
        var startDate = document.getElementById("txtStartDate").value;
        if(period == ""){
            alert("Missing Period (this is numeric value).");
            document.getElementById("txtPeriod").focus();
        }else if(facilityAmount == ""){
            alert("Missing Facility Amount (this is numeric value).");
            document.getElementById("txtFacilityAmount").focus();
        }else if(startDate == ""){
            alert("Missing Start Date.");
            document.getElementById("txtStartDate").focus();
        }else if(isNaN(period)){
            alert("Invalid Period (this is numeric value).");
            document.getElementById("txtPeriod").value = "";
            document.getElementById("txtPeriod").focus();
        }else if(isNaN(facilityAmount)){
            alert("Invalid Facility Amount (this is numeric value).");
            document.getElementById("txtFacilityAmount").value = "";
            document.getElementById("txtFacilityAmount").focus();
        }else{
            var mydata;
    		mydata= new XMLHttpRequest();
    		mydata.onreadystatechange=function(){
    			if(mydata.readyState==4){
    				document.getElementById('diva').innerHTML=mydata.responseText;
                    document.getElementById('btnSumbit').disabled = false;
                    document.getElementById('btnCalculator').disabled = true;
    			}
    		}
    		mydata.open("GET","ajaxEntryManagement.php"+"?getPeriod="+period+"&getFacilityAmount="+facilityAmount+"&getStartDate="+startDate,true);
    		mydata.send();
        }
        
        
    }
    
    // --------------------------- Function for data Submition -----------------------------------------------
    
    function isSubmit(){
        //alert('Submit function Active');
        var customerCode = document.getElementById("txtCustomerCode").value;
        var facilityNo = document.getElementById("txtFacilityNo").value;
        var customerName = document.getElementById("txtCustomerName").value;
        var customerMobile = document.getElementById("txtCustomerMobile").value;
        var customerTelephone = document.getElementById("txtCustomerTelephone").value;
        var productType = document.getElementById("txtProductType").value;
        var facilityType = document.getElementById("txtFacilityType").value;
        var period = document.getElementById("txtPeriod").value;
        var startDate = document.getElementById("txtStartDate").value;
        var facilityStatus = document.getElementById("txtFacilityStatus").value;
        var facilityAmount = document.getElementById("txtFacilityAmount").value;
        var expiryDate = document.getElementById("txtExpiryDate").value;
        var acctivationDate = document.getElementById("txtAcctivationDate").value;
        var actualLossAmount = document.getElementById("txtActualLossAmount").value;
        var desition = document.getElementById("txtDesition").value;
        
        
        if(customerCode == ""){
            alert("Missing Customer Code.");
            document.getElementById("txtCustomerCode").focus();
        }else if(facilityNo == ""){
            alert("Missing Facility Number.");
            document.getElementById("txtFacilityNo").focus();
        }else if(customerName == ""){
            alert("Missing Customer Name.");
            document.getElementById("txtCustomerName").focus();
        }else if(customerMobile == ""){
            alert("Missing Customer Mobile.");
            document.getElementById("txtCustomerMobile").focus();
        }else if(productType == ""){
            alert("Missing Product Type.");
            document.getElementById("txtProductType").focus();
        }else if(facilityType == ""){
            alert("Missing Facility Type.");
            document.getElementById("txtFacilityType").focus();
        }else if(period == ""){
            alert("Missing Period.");
            document.getElementById("txtPeriod").focus();
        }else if(startDate == ""){
            alert("Missing Start Date.");
            document.getElementById("txtStartDate").focus();
        }else if(facilityStatus == ""){
            alert("Missing Facility Status.");
            document.getElementById("txtFacilityStatus").focus();
        }else if(facilityAmount == ""){
            alert("Missing Facility Amount.");
            document.getElementById("txtFacilityAmount").focus();
        }else if(expiryDate == ""){
            alert("Missing Expiry Date.");
            document.getElementById("txtExpiryDate").focus();
        }else if(acctivationDate == ""){
            alert("Missing Activation Date.");
            document.getElementById("txtAcctivationDate").focus();
        }else if(actualLossAmount == "" ){
            alert("Missing Actual Loss Amount.");
            document.getElementById("txtActualLossAmount").focus();
        }else if(isNaN(customerMobile)){
            alert("Invalid Customer Mobile.");
            document.getElementById("txtCustomerMobile").value = "";
            document.getElementById("txtCustomerMobile").focus();
        }else if(isNaN(customerTelephone)){
            alert("Invalid Customer Telephone.");
            document.getElementById("txtCustomerTelephone").value = "";
            document.getElementById("txtCustomerTelephone").focus();
        }else if(isNaN(period)){
            alert("Invalid Period (this is numeric value).");
            document.getElementById("txtPeriod").value = "";
            document.getElementById("txtPeriod").focus();
        }else if(isNaN(facilityAmount)){
            alert("Invalid Facility Amount (this is numeric value).");
            document.getElementById("txtFacilityAmount").value = "";
            document.getElementById("txtFacilityAmount").focus();
        }else if(isNaN(actualLossAmount)){
            alert("Invalid Actual Loss Amount (this is numeric value).");
            document.getElementById("txtActualLossAmount").value = "";
            document.getElementById("txtActualLossAmount").focus();
        }else if(startDate > expiryDate){
             alert("Expiry date is Greater than  Star date.).");
            document.getElementById("txtExpiryDate").value = "";
          document.getElementById("txtExpiryDate").focus();
        }else if(startDate < acctivationDate){
           alert("Expiry date is Less than Activation Date.).");
           document.getElementById("txtAcctivationDate").value = "";
           document.getElementById("txtAcctivationDate").focus();
        }else if(desition == ""){
            alert("Missing Profit and Lost Status.");
            document.getElementById("txtDesition").focus();
        }else{
            //alert("Not Empty Value.");
            var status_check = true;
            var sum_TotalPayable = 0;
            var noteString = ""
            for(var val_x = 1 ; val_x <= period ; val_x++){
                //alert(val_x);
                if(document.getElementById('txtTotalPayable'+val_x).value == ""){
                    alert('Missing Total Payable data');
                    document.getElementById('txtTotalPayable'+val_x).focus();
                    status_check = false;
                    break;
                }else{
                    sum_TotalPayable = sum_TotalPayable+ Number(document.getElementById('txtTotalPayable'+val_x).value);
                    noteString = noteString+val_x+"|";
                    //alert(noteString);
                    noteString = noteString+document.getElementById('txtRepayDate'+val_x).value+"|";
                    //alert(noteString);
                    noteString = noteString+document.getElementById('txtTotalPayable'+val_x).value+"|";
                    //alert(noteString);
                    noteString = noteString+document.getElementById('txtMonthlyAmount'+val_x).value+"@";
                    //alert(noteString);
                }                  
            }
           
            if(status_check == true ){
               // alert("facilityAmount : "+facilityAmount);
               // alert("sum_TotalPayable : "+sum_TotalPayable);
                if(sum_TotalPayable ==  facilityAmount){
                    var r = confirm('Are you sure you want to Submit this?');
                    if (r==true){
                         $.ajax({ 
                				type:'POST', 
                				data: {isCustomerCode : customerCode , isFacilityNo : facilityNo , isCustomerName : customerName , isCustomerMobile : customerMobile , isCustomerTelephone : customerTelephone , isProductType : productType , isFacilityType : facilityType , isPeriod : period , isStartDate : startDate , isFacilityStatus : facilityStatus , isFacilityAmount : facilityAmount , isExpiryDate : expiryDate , isAcctivationDate : acctivationDate , isActualLossAmount : actualLossAmount, isNoteString : noteString , isDesition : desition}, 
                				url: 'ajaxEntryManagement.php', 
                				success: function(val_retn){ 
                				    if(val_retn == "OK"){
                				        alert("Record Saved");
                                        pageref();
                				    }else{
                				        alert("Data Not Saved");
                                        document.getElementById('diva').innerHTML = val_retn; 
                				    }
                				    //alert(val_retn); 
                                    //document.getElementById('diva').innerHTML = val_retn;   
                				}
             			 });
                    }else{
            			//alert('BBBBB');		
            		}
                }else{
                    alert("Facility Amount is not match total of Payable");
                }
            }
        }
    }
</script>
<script>
  $(function() {
    $( "#txtExpiryDate" ).datepicker({dateFormat:"yy-mm-dd"});
  });
  $(function() {
    $( "#txtAcctivationDate" ).datepicker({dateFormat:"yy-mm-dd"});
  });
   $(function() {
    $( "#txtStartDate" ).datepicker({dateFormat:"yy-mm-dd"});
  });
  
</script>
</body>
</html>