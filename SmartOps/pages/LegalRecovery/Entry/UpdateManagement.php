<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Legal Recovery
Page Name		: Update Management
Purpose			: Entry Up to table for data
Author			: Madushan Wikramaarachi
Date & Time		: 02:08 P.M - 2016-01-03
------------------------------------------------------------------------------------------------------------------------>
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="lre/e/002";
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

    <title>Update Management</title>

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
                     <label class="col-sm-2">Facility No : </label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control input-sm" id="txtFacilityNo" name="txtFacilityNo" value="" maxlength="20" onkeypress="return disableEnterKey(event)" onkeyup="ajaxFunction(event)" required="required" />
				    </div>
		             <label class="col-sm-2">Customer Code : </label>
                     <div class="col-sm-3">
                        <input type="text" class="form-control input-sm" id="txtCustomerCode" name="txtCustomerCode" value="" maxlength="8" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeypress="return disableEnterKey(event)" required="required" />
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
					<label class="col-sm-2">Gross Rental : </label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control input-sm" id="txtGrossRental" title="Gross Rental" name="txtGrossRental" value="" onkeypress="return disableEnterKey(event)" required="required" />
                    </div>
                    <label class="col-sm-2">Due Outstanding : </label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control input-sm" id="txtDueOutstanding" name="txtDueOutstanding" title="Due Outstanding" value="" onkeypress="return disableEnterKey(event)" required="required" />
                    </div>
                 </div>
                 <div class='col-lg-12'>
					
				 </div>
                 <div class="form-group">
					<label class="col-sm-2">Total Amount to be Recovered : </label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control input-sm" id="txtTotalAmounttobeRecovered" title="Total Amount to be Recovered" name="txtTotalAmounttobeRecovered" value="" onkeypress="return disableEnterKey(event)" required="required" />
                    </div>
                    <label class="col-sm-2">No of Rental Matured : </label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control input-sm" id="txtNoOfRentalMatured" name="txtNoOfRentalMatured" title="No of Rental Matured" value="" onkeypress="return disableEnterKey(event)" required="required" />
                    </div>
                 </div>
                 <div class='col-lg-12'>
					
				 </div>
                 <div class="form-group">
					<label class="col-sm-2">No of Rental Paid : </label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control input-sm" id="txtNoOfRentalPaid" title="No of Rental Paid" name="txtNoOfRentalPaid" value="" onkeypress="return disableEnterKey(event)" required="required" />
                    </div>
                    <label class="col-sm-2">No of Rental in Arrears : </label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control input-sm" id="txtNoOfRentalInArrears" name="txtNoOfRentalInArrears" title="No of Rental in Arrears" value="" onkeypress="return disableEnterKey(event)" required="required" />
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
                    <label class="col-sm-2">Paid In Advance : </label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control input-sm" id="txtPaidInAdvance" name="txtPaidInAdvance" value="" onkeypress="return disableEnterKey(event)" required="required" />
				    </div>
                 </div>
			</div>
    </div>
</div>
<div class="container-fluid">
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
    
    // ----------------------------- Load table for calculater -----------------------------------------------------------------
    /*function genExpiarDate(){
        var startDate = document.getElementById("txtStartDate").value;
        alert(startDate);
        //var d = new Date();
        
    }*/
    
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
			var url = "getagentids.php?param2=";
            var idValue = document.getElementById("txtFacilityNo").value;
            //alert(idValue);
            var myRandom = parseInt(Math.random()*99999999);  // cache buster
            http.open("GET", "getagentids.php?param2=" + escape(idValue) + "&rand=" + myRandom, true);
            http.onreadystatechange = handleHttpResponse;
            http.send(null);
         	function handleHttpResponse(){
            	if (http.readyState == 4){
            	   //alert('AA');
                	results = http.responseText.split("|");
                    //alert('BB');
                    //alert(results[14].trim()+' '+results[15].trim()+' '+results[16].trim()+' '+results[17].trim()+' '+results[20].trim());
                    if(results[0].trim() == ""){
                        alert("Invalied Facility Number");
                    }else{
                        document.getElementById("txtCustomerCode").value = results[0].trim();
                        document.getElementById("txtFacilityNo").value = results[1].trim();
                        document.getElementById("txtCustomerName").value = results[2].trim();
                        document.getElementById("txtCustomerMobile").value = results[3].trim();
                        document.getElementById("txtCustomerTelephone").value = results[4].trim();
                        document.getElementById("txtProductType").value = results[5].trim();
                        document.getElementById("txtFacilityType").value = results[6].trim();
                        document.getElementById("txtPeriod").value = results[7].trim();
                        document.getElementById("txtStartDate").value = results[8].trim();
                        document.getElementById("txtFacilityStatus").value = results[9].trim();
                        document.getElementById("txtFacilityAmount").value = results[10].trim();
                        document.getElementById("txtExpiryDate").value = results[11].trim();
                        document.getElementById("txtAcctivationDate").value = results[12].trim();
                        document.getElementById("txtActualLossAmount").value = results[13].trim();
                        document.getElementById("txtGrossRental").value = results[14].trim();
                        document.getElementById("txtDueOutstanding").value = results[15].trim();
                        document.getElementById("txtTotalAmounttobeRecovered").value = results[16].trim();
                        document.getElementById("txtNoOfRentalMatured").value = results[17].trim();
                        document.getElementById("txtNoOfRentalPaid").value = results[18].trim();
                        document.getElementById("txtNoOfRentalInArrears").value = results[19].trim();
                        document.getElementById("txtPaidInAdvance").value = results[20].trim();
                        var mydata;
                		mydata= new XMLHttpRequest();
                		mydata.onreadystatechange=function(){
                			if(mydata.readyState==4){
                				document.getElementById('diva').innerHTML=mydata.responseText;
                			}
                		}
                		mydata.open("GET","ajaxEntryManagement.php"+"?getFacilityNo="+results[1].trim(),true);
                		mydata.send();
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