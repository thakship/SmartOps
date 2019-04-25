<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Card Centre OperationisGenerate
Page Name		: Send to Debit
Purpose			: Debit to Ecsel Load
Author			: Madushan Wikramaarachchi
Date & Time		: 03.10 P.M 23/06/2017
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
session_start();
$_SESSION['page']="ccs/e/009";
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
    <script src=" jquery/jquery-1.9.1.js"></script>
    <script src="jquery/jquery-ui.js"></script>
    <script src="jquery.btechco.excelexport.js"></script>
    <script src="jquery.base64.js"></script>
    <script type="text/javascript">
        function pageRef(){
            window.open('http://cdberp:8080/cdb/pages/CardCentreOperation/Entry/SendtoDebit.php?DispName=Send%20to%20Debit%20Load','conectpage');
        }


        function isGenerate(){
            var batchNumber = document.getElementById('sel_Select_Batch').value;
            var empappodate1 = document.getElementById('empappodate1').value;
            var empappodate2 = document.getElementById('empappodate2').value;
            if(empappodate1 == ""){
                alert('Select From Date.');
                document.getElementById('btnExport').disabled = true;
            }else if(empappodate2 == ""){
                alert('Select To Date.');
                document.getElementById('btnExport').disabled = true;
            }else if(batchNumber != ""){
                document.getElementById('btnExport').disabled = false;
                $.ajax({
                    type:'POST',
                    data: {getRepID : batchNumber , fromDate : empappodate1 , toDate : empappodate2 },
                    url: 'Ajax_Instant_card_REP.php',
                    success: function(val_retn) {
                        //alert("Gen OK.");
                        document.getElementById('genGrid').innerHTML = val_retn;
                    }
                });
            }else{
                alert('Select Report Type.');
                document.getElementById('btnExport').disabled = true;
            }
        }


    </script>

    <script>
        $(function() {
            $( "#empappodate1" ).datepicker({dateFormat:"yy-mm-dd"});
        });
        $(function() {
            $( "#empappodate2" ).datepicker({dateFormat:"yy-mm-dd"});
        });

        $(document).ready(function () {
            $("#btnExport").click(function () {
                $("#myTable").btechco_excelexport({
                    //alert('Table');
                    containerid: "myTable"
                    , datatype: $datatype.Table
                });
            });
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

    <div>
        <table>
            <tr>
                <td style="width: 160px; text-align: right;"><label class="linetop">Select Report :</label></td>
                <td>
                    <select class="box_decaretion"  style="width: 200px;" name="sel_Select_Batch" id="sel_Select_Batch" onkeypress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onchange="isGetTbl()">
                        <option value="">--Select Report --</option>
                        <option value="1">Instant Card Fee Deduction Customer list</option>
                        <option value="2">Details of Debit card instant - commercial report</option>
                    </select>
                </td>
            </tr>
        </table>
        <table>
            <tr>
                <td style="text-align: right; width:150px;"><label class="linetop" style="margin-right: 5px;">Date Period :</label></td>
                <td style="text-align:left; padding-top:5px; padding-bottom:5;width:150px;">
                    <input class="box_decaretion"  name="empappodate1" type="text"  id="empappodate1" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onKeyPress="return disableEnterKey(event)" placeholder="From Date"/>
                </td>
                <td style="text-align:left; padding-top:5px; padding-bottom:5;width:150px;">
                    <input class="box_decaretion"  name="empappodate2" type="text"  id="empappodate2" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onKeyPress="return disableEnterKey(event)"  placeholder="To Date"/>
                </td>
            </tr>
        </table>
        <br />
        <br /><hr />
        <input class="buttonManage" style="width: 100px;" type="button" name="btnGenerate" id="btnGenerate" value="Generate" onclick="isGenerate();"/>
        <input class="buttonManage" type="button" style="width: 100px;"  value="Excel" name="btnExport" id="btnExport" disabled="disabled" />
        <input class="buttonManage" style="width: 100px;" type="button" name="btnClose" id="btnClose" value="Close" onclick="pageClose();"/>
    </div>
    <div style="display: none;">
        <input type="text" id="txtMyUserID" name="txtMyUserID" value="<?php echo $_SESSION['user']; ?>" onkeypress="return disableEnterKey(event)" />
        <input type="text" id="txtMyUserGroup" name="txtMyUserGroup" value="<?php echo $_SESSION['usergroupNumber']; ?>" onkeypress="return disableEnterKey(event)" />
    </div>
    <div id="err"></div>
    <div id="genGrid"></div>
    <div id="getGried"></div>


</form>
</body>
</html>