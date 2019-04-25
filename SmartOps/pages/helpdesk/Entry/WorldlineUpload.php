<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Helpdesk
Page Name		: World line Upload
Purpose			: To Upload for World line
Author			: Madushan Wikramaarachchi
Date & Time		: 09:30 A.M 13/12/2018
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
session_start();
$_SESSION['page']="hel/e/066";
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>World line Upload</title>
    <!-- Common function Libariries -->
    <!-- CSS-->
    <link rel="stylesheet" type="text/css" href="../../../CSS/globleCSS.css"/>
    <link rel="stylesheet" type="text/css" href="../helpdesk_DEVELOPMENT/CSS/helpdesk_Style_Sheet.css"/>
    <!--Javascript-->
    <script src="../../../js/commenfunction.js"></script>
    <script src="../helpdesk_DEVELOPMENT/JAVASCRIPT_FUNCTION/helpdesk_js_function.js"></script>
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
            height:275px;
            overflow-y: scroll;
            border:#000000 solid 1px;
        }
    </style>
    <link rel="stylesheet" href="jquery/jquery-ui.css" />
    <script src=" jquery/jquery-1.9.1.js"></script>
    <script src="jquery/jquery-ui.js"></script>
    <script type="text/javascript">
        function pageClose(){ //Page Close Function.......
            parent.location.href = parent.location.href;
        }


    </script>

</head>
<body oncontextmenu="return false" onsubmit="return chak()">
<form action="" method="post" name="schform" enctype="multipart/form-data">
    <p class="topline">
        <?php
        echo $_REQUEST['DispName'];
        ?>
    </p><hr/>

    <table>
        <tr>
            <td style="width: 100px; text-align: right;"><label class="linetop">Enterd User :</label></td>
            <td>
                <input class="box_decaretion" type="text"  style="width:200px; color: #747474; background: #D3D3D3;" name="txt_User" id="txt_User" value="<?php echo $_SESSION['user']; ?>" onKeyPress="return disableEnterKey(event)" readonly="readonly"/>
            </td>
        </tr>
        <tr>
            <td style="width: 100px; text-align: right;"><label class="linetop">Attachment :</label></td>
            <td>
                <input class="buttonManage" type="file" name="fileAttachment" id="fileAttachment" />
            </td>
        </tr>
    </table>
    <table>

    </table>
    </div>
    <br />
    <table>
        <tr>
            <td style="width: 100px;">&nbsp;</td>
            <td>
                <input type="submit" style="width: 100px;" class="buttonManage" id="btnSave" name="btnSave" value="Upload" />
                <input type="button" style="width: 100px;" class="buttonManage" id="btnClose" name="btnClose" value="Close" onclick="pageClose()"/>
            </td>
        </tr>
    </table>

    <?php

    if(isset($_POST['btnSave']) && $_POST['btnSave']=='Upload'){

        // Get Upload File .......................................................
        $file = $_FILES['fileAttachment']['tmp_name'];
        $fileType = $_FILES['fileAttachment']['type'];
        $fileName = $_FILES['fileAttachment']['name'];


        $mfieldArray = array(); // Create Array for each line in array

        $myfile = fopen($file, "r") or die("Unable to open file!");

        $lncount = 0; // Line number counter
        $recCount = 0;

        fseek($myfile, 0);
        /*
        0  Reference Number	        10
        1  Filler	                    1
        2  Title	                    12
        3  Name	                    26
        4  Filler	                    1
        5  Mailing Address-1	        40
        6  Filler	                    1
        7  Mailing Address-2	        40
        8  Filler	                    1
        9  Mailing Address-3	        40
        10 Filler	                    1
        11 Mailing Address-4	        40
        12 Filler	                    1
        13 Mailing City	            30
        14 Filler	                    1
        15 Mailing State	            30
        16 Filler	                    1
        17 Mailing Country	            30
        18 Filler	                    1
        19 Mailing PIN Code	        9
        20 Filler	                    6
        21 Telephone - Home	        12
        22 Filler	                    1
        23 Credit Limit	            10
        24 Filler	                    1
        25 Cash Limit	                10
        26 Filler	                    1
        27 Last Manufacturing Date	    6
        28 Filler	                    1
        29 Embossing Name	            26
        30 Filler	                    1
        31 Application Sequence No	    30
        32 Card Number	                19
        33 Filler	                    1
        34 Branch Code	                20
        35 Filler	                    1
        36 Branch Name	                30
        37 Filler	                    1
        38 Bank Account Number	        24
        39 Filler	                    1
        40 Creation Date	            6
        41 Filler	                    1
        42 Application Sequence No	    30
        43 Filler	                    1
        44 End Expity Date	            10
        45 Filler	                    1
        46 Mobile number	            12
        47 Filler	                    1
        48 Currency Code	            3
        49 Filler	                    1
        50 Billing Cycle	            2
        51 Filler	                    1
        52 Due Date Cycle	            2
         */

        $batch_num = 0;

        
        try{
            $sqlFunction ="SELECT GetNextSerial('world_line','world_line') FROM DUAL";    //Create the Next Serial for the header / detail
            $quary_Function = mysqli_query($conn,$sqlFunction);
            while ($rec_Function = mysqli_fetch_array($quary_Function)){
                $batch_num = $rec_Function[0];
            }
			
			mysqli_autocommit($conn,FALSE);
            // Insert data to word line header ........................................................
            $sql_world_line_header = "INSERT INTO world_line_header (v_index , file_name , upload_by) VALUES(".$batch_num." , '".$fileName."' , '".$_SESSION['user']."')";
            try {
                $query_word_line_header = mysqli_query($conn, $sql_world_line_header) or die(GetFormattedException(mysqli_errno($conn),mysqli_error($conn)));
            }catch(Exception $e){
                echo "Error Occured";
            }
            //echo $sql_world_line_header;
            while(!feof($myfile)) {
                //echo "IN WHILE"."<br/>";
                $line = fgets($myfile);

                $mfieldArray[0] = substr($line,0,10);  //	Character	M	Card number (7th to 16th position).
                $mfieldArray[1] = substr($line,10,1);  //	Character		Space
                $mfieldArray[2] = substr($line,11,12);  //	Character	M	Right padded with spaces.
                $mfieldArray[3] = substr($line,23,26);  //	Character	M	Right padded with spaces.
                $mfieldArray[4] = substr($line,49,1);  //	Character		Space
                $mfieldArray[5] = substr($line,50,40);  //	Character	M	Right padded with spaces.
                $mfieldArray[6] = substr($line,90,1);  //	Character		Space
                $mfieldArray[7] = substr($line,91,40);  //	Character	O	Right padded with spaces.
                $mfieldArray[8] = substr($line,131,1);  //	Character		Space
                $mfieldArray[9] = substr($line,132,40);  //	Character	O	Right padded with spaces.
                $mfieldArray[10] = substr($line,172,1);  //	Character		Space
                $mfieldArray[11] = substr($line,173,40);  //	Character	O	Right padded with spaces.
                $mfieldArray[12] = substr($line,213,1);  //	Character		Space
                $mfieldArray[13] = substr($line,214,30);  //	Character	O	Right padded with spaces.
                $mfieldArray[14] = substr($line,244,1);  //	Character		Space
                $mfieldArray[15] = substr($line,245,30);  //	Character	O	Right padded with spaces.
                $mfieldArray[16] = substr($line,275,1);  //	Character		Space
                $mfieldArray[17] = substr($line,276,30);  //	Character	O	Right padded with spaces.
                $mfieldArray[18] = substr($line,306,1);  //	Character		Space
                $mfieldArray[19] = substr($line,307,9);  //	Character	O	Right padded with spaces.
                $mfieldArray[20] = substr($line,316,6);  //	Character		 TEL:
                $mfieldArray[21] = substr($line,322,12);  //	Character	O	Right padded with spaces.
                $mfieldArray[22] = substr($line,334,1);  //	Character		Space
                $mfieldArray[23] = substr($line,335,10);  //	Character	M	Amount in Rs. Left padded with spaces.
                $mfieldArray[24] = substr($line,345,1);  //	Character		Space
                $mfieldArray[25] = substr($line,346,10);  //	Character	M	Amount in Rs. Left padded with spaces.
                $mfieldArray[26] = substr($line,356,1);  //	Character		Space
                $mfieldArray[27] = substr($line,357,6);  //	Date	M	ddmmyy
                $mfieldArray[28] = substr($line,363,1);  //	Character		Space
                $mfieldArray[29] = substr($line,364,26);  //	Character	M	Right padded with spaces.
                $mfieldArray[30] = substr($line,390,1);  //	Character		Space
                $mfieldArray[31] = substr($line,391,30);  //	Character	NA	Right padded with spaces.
                $mfieldArray[32] = substr($line,421,19);  //	Character	M	Right padded with spaces.
                $mfieldArray[33] = substr($line,440,1);  //	Character		Space
                $mfieldArray[34] = substr($line,441,20);  //	Character	M	Right padded with spaces.
                $mfieldArray[35] = substr($line,461,1);  //	Character		Space
                $mfieldArray[36] = substr($line,462,30);  //	Character	M	Right padded with spaces.
                $mfieldArray[37] = substr($line,492,1);  //	Character		Space
                $mfieldArray[38] = substr($line,493,24);  //	Character	O	Right padded with spaces.
                $mfieldArray[39] = substr($line,517,1);  //	Character		Space
                $mfieldArray[40] = substr($line,518,6);  //	Date	M	ddmmyy
                $mfieldArray[41] = substr($line,524,1);  //	Character		Space
                $mfieldArray[42] = substr($line,525,30);  //	Character	O	Right padded with spaces.
                $mfieldArray[43] = substr($line,555,1);  //	Character		Space
                $mfieldArray[44] = substr($line,556,10);  //	Character	M	format dd/mm/yyyy
                $mfieldArray[45] = substr($line,566,1);  //	Character		Space
                $mfieldArray[46] = substr($line,567,12);  //	Character	O	Right padded with spaces.
                $mfieldArray[47] = substr($line,579,1);  //	Character		Space
                $mfieldArray[48] = substr($line,580,3);  //	Character	M
                $mfieldArray[49] = substr($line,583,1);  //	Character		Space
                $mfieldArray[50] = substr($line,584,2);  //	Character	C	format 'dd'
                $mfieldArray[51] = substr($line,586,1);  //	Character		Space
                $mfieldArray[52] = substr($line,587,2);  //	Character	C	format 'dd'


                //echo "Current line: " . $lncount . "<br/><br/>";
                //if($lncount == 0 || $mfieldArray[0] == "") {$lncount++; continue;}
                if($mfieldArray[0] == "") {$lncount++; continue;}

                if(true){
                    if($mfieldArray[0] != "") {
                        $sql_world_line_dtl = "INSERT INTO `world_line_dtl` (
                                                                    `v_index` ,
                                                                    `reference_number` ,
                                                                    `title` ,
                                                                    `name` ,
                                                                    `mailing_address_1` ,
                                                                    `mailing_address_2` ,
                                                                    `mailing_address_3` ,
                                                                    `mailing_address_4` ,
                                                                    `mailing_city` ,
                                                                    `mailing_state` ,
                                                                    `mailing_country` ,
                                                                    `mailing_pin_code` ,
                                                                    `telephone_home` ,
                                                                    `credit_limit` ,
                                                                    `cash_limit` ,
                                                                    `last_manufacturing_date` ,
                                                                    `embossing_name` ,
                                                                    `application_sequence_no` ,
                                                                    `card_number` ,
                                                                    `branch_code` ,
                                                                    `branch_name` ,
                                                                    `bank_account_number` ,
                                                                    `creation_date` ,
                                                                    `application_sequence_no_1` ,
                                                                    `end_expity_date` ,
                                                                    `mobile_number` ,
                                                                    `currency_code` ,
                                                                    `billing_cycle` ,
                                                                    `due_date_cycle` 
                                                            ) VALUES( ".$batch_num." ,
                                                                     '".$mfieldArray[0]."' ,
                                                                    '".$mfieldArray[2]."' ,
                                                                    '".$mfieldArray[3]."' ,
                                                                    '".$mfieldArray[5]."' ,
                                                                    '".$mfieldArray[7]."' ,
                                                                    '".$mfieldArray[9]."' ,
                                                                    '".$mfieldArray[11]."' ,
                                                                    '".$mfieldArray[13]."' ,
                                                                    '".$mfieldArray[15]."' ,
                                                                    '".$mfieldArray[17]."' ,
                                                                    '".$mfieldArray[19]."' ,
                                                                    '".$mfieldArray[21]."' ,
                                                                    '".$mfieldArray[23]."' ,
                                                                    '".$mfieldArray[25]."' ,
                                                                    '".$mfieldArray[27]."' ,
                                                                    '".$mfieldArray[29]."' ,
                                                                    '".$mfieldArray[31]."' ,
                                                                    '".$mfieldArray[32]."' ,
                                                                    '".$mfieldArray[34]."' ,
                                                                    '".$mfieldArray[36]."' ,
                                                                    '".$mfieldArray[38]."' ,
                                                                    '".$mfieldArray[40]."' ,
                                                                    '".$mfieldArray[42]."' ,
                                                                    '".$mfieldArray[44]."' ,
                                                                    '".$mfieldArray[46]."' ,
                                                                    '".$mfieldArray[48]."' ,
                                                                    '".$mfieldArray[50]."' ,
                                                                    '".$mfieldArray[52]."' );";
                        $recCount++;
                        //echo $sql_world_line_dtl;
                        $query_world_line_dtl = mysqli_query($conn, $sql_world_line_dtl) or die(mysqli_error($conn));
                        //echo "lncount = " . $lncount . " = ". $sql_world_line_dtl ."<br/>";
                        $lncount++;  // Increment line counter
                    }
                    //echo strpos($line,":");
                }
                strpos($line,":");

            }

            $update_world_line_header = "UPDATE world_line_header
                                        SET record_count = ".$recCount."
                                        WHERE v_index = ".$batch_num;
            $query_UPDATE_word_line_header = mysqli_query($conn,$update_world_line_header) or die(mysqli_error($conn));
            //echo $update_world_line_header."<br/>";
            fclose($myfile);

            if($update_world_line_header){
                echo "Output : ".$recCount." record(s) uploaded.";
            }else{
                echo "Output : No Records updated";
            }
            mysqli_commit($conn);
        }catch(Exception $e){
            echo "Error";
            mysqli_rollback($conn);
            echo 'Message: '.$e->getMessage();
        }
    }
    ?>

    <!-- ****************************************************************************************************************************************************** -->
    <span id="getGried"></span>
    <?php
    //serviceRequsestMaual_Gried_POPUP_1($conn);
    ?>
</form>
</body>
</html>

