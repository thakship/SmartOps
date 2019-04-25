<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Security Printing System
Page Name		: Money Ex Receipt 
Purpose			: To Print Money Exchenge slip
Author			: Madushan Wikramaarachi
Date & Time		: 1.20 A.M 17/05/2016
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="sps/r/001";
	//$_SESSION['Module'] = "Admin";
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

    <title>Money Ex Receipt</title>

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
<style type="text/css">
    .tbl_with_first_col{
        width: 150px;
    }
</style>
<script language="javascript" type="text/javascript">
        
</script> 
<style type="text/css">    

</style>
</head>
<body oncontextmenu="return false">
<form class="form-horizontal" action="" method="post" style="margin-left: 20px;">
<h3>
<?php 
	echo $_REQUEST['DispName'];
?>
</h3>
<div style="display: none;">
    <input type="text" id="txtMyUserID" name="txtMyUserID" value="<?php echo $_SESSION['user']; ?>" onkeypress="return disableEnterKey(event)" />
</div>
<hr/>
<div class="container-fluid">
    <div class="panel panel-default">
            <div class="panel-heading">
                   Receipt Informetion
            </div>
            <div class="panel-body">
				 <div class="form-group">
					<label class="col-sm-2">Branch : *</label>
                    <?php
                        $sql_branch = "SELECT `br_code` , `branchName` FROM `branch` WHERE `branchNumber` = '".$_SESSION['userBranch']."';";
                        $que_branch = mysqli_query($conn,$sql_branch) or die(mysqli_error($conn));
                        while($rec_branch = mysqli_fetch_array($que_branch)){
                            $br_coad = $rec_branch[0];
                            $br_name = $rec_branch[1];
                        }
                    ?>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" id="txtBranchCode" name="txtBranchCode" value="<?php echo $br_coad; ?>" maxlength="10" onkeypress="return disableEnterKey(event)" readonly="readonly" placeholder="Branch Code" />
				    </div>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" id="txtBranchName" name="txtBranchName" value="<?php echo $br_name; ?>" maxlength="50" onkeypress="return disableEnterKey(event)"  readonly="readonly" placeholder="Branch Name" />
				    </div>
                 </div>
                 <div class='col-lg-12'>
					
				 </div>
                 
				 <div class='form-group'>
					 <label class="col-sm-2">User : *</label>
                     <div class="col-sm-2">
                        <input type="text" class="form-control" id="txtuserId" name="txtuserId" value="<?php echo $_SESSION['user']; ?>" maxlength="10" onkeypress="return disableEnterKey(event)" readonly="readonly" placeholder="User ID" />
				    </div>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" id="txtuserName" name="txtuserName" value="<?php echo $_SESSION['userID']; ?>" maxlength="150" onkeypress="return disableEnterKey(event)" readonly="readonly" placeholder="User Name" />
				    </div>
                 </div>
                  <div class='col-lg-12'>
					
				 </div>
                 <div class='form-group'>
					<label class="col-sm-2">Date : *</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" id="txtDate" name="txtDate" placeholder="--/--/--"  value="<?php echo date("Y-m-d") ?>" readonly="readonly" maxlength="30"/>
                    </div>
				 </div>
                  <div class='col-lg-12'>
					
				 </div>
			</div>
    </div>
</div>
<div class="container-fluid">
    <button type="button" style="width: 150px;" class="btn btn-success" onclick="loadReceipt();">Load Receipt</button>
</div>
<br />
<div class="panel panel-default">
                <div class="panel-heading">
                    Receipt table
                </div>
                <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div id="loadTable" class="table-responsive">
                            <table id="myTable" class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Client info</th>
                                        <th>Client ID </th>
                                        <th>Purchase Amt</th>
                                        <th>Rate</th>
                                        <th>Sale Amt</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    
                                    //$select_module = "SELECT amo.moduleCode , amo.moduleName , amo.IconName FROM module AS amo;";
                                    //$quary_module = mysqli_query($conn , $select_module);
                                    $x = 1;
                                    //while($result_module = mysqli_fetch_array($quary_module)){
                                        echo "<tr title='' onclick=''>";
                                        echo "<td>".$x."</td>";
                                        echo "<td>&nbsp;</td>";
                                        echo "<td>&nbsp;</td>";
                                        echo "<td>&nbsp;</td>";
                                        echo "<td>&nbsp;</td>";
                                        echo "<td>&nbsp;</td>";
                                        echo "<td><p class='fa fa-print'></p></td>";
                                        echo "</tr>";
                                      //  $x++;
                                    //}
                                ?>  
                                </tbody>
                            </table>
                                     
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
<div class="container-fluid">
    <button type="button" style="width: 100px;" class="btn btn-success" onclick="pageClose()">Close</button>
</div>
<div id="printablediv">
</div>
</form>
<script type="text/javascript">
    function pageClose(){ //Page Close Function.......
	   parent.location.href = parent.location.href;
    }
    function loadReceipt(){
        //alert('loadReceipt - function');
        var receiptDate = document.getElementById('txtDate').value;
        var receiptBranch = document.getElementById('txtBranchCode').value;
        var entryUser = document.getElementById('txtuserId').value;
        mydata = new XMLHttpRequest();
        mydata.onreadystatechange=function(){
        if(mydata.readyState==4){
            document.getElementById('loadTable').innerHTML = mydata.responseText;           
        }
        }
        mydata.open("GET","ajex_moneyExReceipt.php"+"?get_receiptDate="+receiptDate+"&get_receiptBranch="+receiptBranch,true);
        mydata.send();
    }
    
    function receiptPrint(title){
        //alert(title);
        var entryUser = document.getElementById('txtuserId').value;
        var entyDate = document.getElementById('txtDate').value;
        var arr_title = title.split("|");
        /*for(var r = 0; r < arr_title.length ; r++){
            alert(arr_title[r]);
        }*/
        var r = confirm('Are you sure you want to Print this?')
        if (r==true){
         //alert(var_aa+"--"+var_bb+"--"+var_ee+"--"+var_ff+"--"+var_gg);
	     $.ajax({ 
				type:'POST', 
				data: {TP_FXTRAN_BRN_CODE : arr_title[0] , TP_FXTRAN_DATE : arr_title[1] , TP_FXTRAN_DAY_SL : arr_title[2] , TP_FXTRAN_CUST_CODE : arr_title[3] , TP_FXTRAN_PUR_CURR : arr_title[4] , TP_FXTRAN_PUR_AMT : arr_title[5] , TP_FXTRAN_SALE_CURR : arr_title[6] , TP_FXTRAN_SALE_AMT : arr_title[7] , TP_FXTRAN_CONV_RATE : arr_title[8] , TP_FXTRAN_CUST_NAME : arr_title[9] , TP_FXTRAN_NIC_NUM : arr_title[10] , TP_FXTRAN_PASS_NUMBER :  arr_title[11] , get_entryUser : entryUser , TP_FXTRAN_REM1 : arr_title[12] , TP_FXTRAN_REM2 : arr_title[13] , TP_FXTRAN_REM3 : arr_title[14]}, 
				url: 'function_moneyExReceipt.php', 
				success: function(val_retn) { 
				    //alert(val_retn); 
                    //document.getElementById('aaaa').innerHTML = val_retn;
                    
                    if(val_retn == "OK"){
                        //alert(arr_title[0]);
                        mydataprint = new XMLHttpRequest();
                        mydataprint.onreadystatechange=function(){
                            if(mydataprint.readyState==4){
                                document.getElementById('printablediv').innerHTML = mydataprint.responseText;    
                                var prtContent = document.getElementById("printablediv");
                    			var WinPrint = window.open('', '', 'letf=0,top=0,width=1150,height=500,toolbar=0,scrollbars=0,status=0');
                    			WinPrint.document.write(prtContent.innerHTML);
                    			WinPrint.document.close();
                    			WinPrint.focus();
                    			WinPrint.print();
                    			WinPrint.close();
                                pageClose();      
                            }
                        }
                        mydataprint.open("GET","ajex_moneyExReceipt.php"+"?TP_FXTRAN_BRN_CODE="+arr_title[0]+"&TP_FXTRAN_DATE="+arr_title[1]+"&TP_FXTRAN_DAY_SL="+arr_title[2]+"&TP_FXTRAN_CUST_CODE="+arr_title[3]+"&TP_FXTRAN_PUR_CURR="+arr_title[4]+"&TP_FXTRAN_PUR_AMT="+arr_title[5]+"&TP_FXTRAN_SALE_CURR="+arr_title[6]+"&TP_FXTRAN_SALE_AMT="+arr_title[7]+"&TP_FXTRAN_CONV_RATE="+arr_title[8]+"&TP_FXTRAN_CUST_NAME="+arr_title[9]+"&TP_FXTRAN_NIC_NUM="+arr_title[10]+"&TP_FXTRAN_PASS_NUMBER="+arr_title[11]+"&get_entyDate="+entyDate+"&TP_FXTRAN_REM1="+arr_title[12]+"&TP_FXTRAN_REM2="+arr_title[13]+"&TP_FXTRAN_REM3="+arr_title[14],true);
                        mydataprint.send();
                    }else{
                        alert("Recode not updated")
                    }
				}
			});
        }else{
			//alert('BBBBB');		
		}
    }
    function getprintCopy(){
		var prtContent = document.getElementById("printablediv");
		var WinPrint = window.open('', '', 'letf=0,top=0,width=1150,height=500,toolbar=0,scrollbars=0,status=0');
		WinPrint.document.write(prtContent.innerHTML);
		WinPrint.document.close();
		WinPrint.focus();
		WinPrint.print();
		WinPrint.close();
    }
</script>
</body>
</html>