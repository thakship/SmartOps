<?php
	session_start();
	$_SESSION['page']="dfc/e/001";
	$_SESSION['Module'] = "DFCC Remittance";
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
<html>
<head>
<link rel="stylesheet" type="text/css" href="../../../CSS/globleCSS.css"/>
<link rel="stylesheet" type="text/css" href="../DLS_DEVELOPMENT/CSS/docline _system_Style_Sheet.css"/>
<!--Javascript-->
<script src="../../../js/jsLey.js"></script>
<script src="../../../js/commenfunction.js"></script>
<script src="../DLS_DEVELOPMENT/JAVASCRIPT_FUNCTION/docline_Sysem_JavaScript.js"></script>
<!--END Common fumction Libariries-->
<style>
table {
    width: 100%;
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid black;
    padding: 5px;
}

th {text-align: left;}
</style>
</head>
<body>

<div class="func">
<?php include 'dfcc_func.php';?>
</div>
<p class="topline">
<?php echo $_REQUEST['DispName']; ?> <!-- Current Page Header/Label -->
</p><hr />
<!-- Screen design will be started from here -->

<?php

  	$conn = dbConnection();
	$sql = "SELECT biz_entity, biz_name FROM dfcc_para WHERE dfcc_para.biz_entity = '1' ";
    $bizEntity = null;
	$result = $conn->query($sql);

	if ($result->num_rows > 0) 
    {
    	// output data of each row
    	while($row = $result->fetch_assoc()) 
        {
        	echo "Business Entity Code : " . $row["biz_entity"]. "<br>". "Business Entity Name: " . $row["biz_name"]. "<br>";
            $bizEntity = $row["biz_entity"];
    	}
	} else 
    {
    		echo ' <span style="color:red;"> Business entity not defined </span> ';
	}
	$conn->close();
?>
<br />
<br />

<form action="" method="post" enctype="multipart/form-data">
<input type="file" name="fileAttachment" id="fileAttachment"/> 
<input type="submit" name="btnSubmit" id="btnSubmit" value="Submit"/> 
<br />
<br />

<?php
if(isset($_POST['btnSubmit']) && $_POST['btnSubmit'] == "Submit")
{
    if($_FILES["fileAttachment"]["name"] != "")
    { 
        $temp = explode(".", $_FILES["fileAttachment"]["name"]);
        $extension = end($temp);
        if($extension == "txt")
        {
                $file_name = $_FILES['fileAttachment']['name'] ;
                $conn = dbConnection();
                $f = fopen($_FILES['fileAttachment']['tmp_name'], "r");
                    //Set autocommit to off
                    mysqli_autocommit($conn,FALSE);
                   
                    //get & update next batch number
                    $sql = "SELECT IFNULL(MAX(`dfcc_remit_hd`.`batch_num`),0) AS batchnum FROM `dfcc_remit_hd`";
                    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                    $row = $result->fetch_assoc();
                 
                    //Generate a unique batch number
                    $BatchNumber = $row["batchnum"] + 1;
                    //insert into header file
                    $sql_insert = "INSERT INTO `dfcc_remit_hd`(`batch_num`, `file_name`, `upload_date`, `upload_by`, `process_serial`) 
                                   VALUES ('".$BatchNumber."' ,'".$file_name."',DATE(NOW()),'".$_SESSION['user']."',0)";
                    $result = mysqli_query($conn , $sql_insert) or die(mysqli_error($conn));
                        
                    // Read line by line and insert into until end of file
                    while (($line = fgets($f)) !== false)
                    { 
                    	// Make an array using comma as delimiter
                        if (strlen(TRIM($line))> 0)
                        {
                            $arrM = explode("|",$line);
                        	// Write links (get the data in the array)
                        	$TransactionID = $arrM[0];
                        	$ReferenceNumber = $arrM[1];
                        	$SenderName = $arrM[2];
                        	$SenderCurrencyCode = $arrM[3];
                        	$SenderPhoneNumber = $arrM[4];
                        	$SendAmount = $arrM[5];
                        	$BenificiaryName = $arrM[6];
                        	$BenificiaryGlobalID = $arrM[7];
                        	$BenificiaryContactNumber = $arrM[8];
                        	$Purpose = $arrM[9];
                        	$AccountNumber = $arrM[10];
                        	$BankCode = $arrM[11];
                        	$BranchCode = $arrM[12];
                            if ($SendAmount <> 0){
                            	//insert into detail table
                            	$sql_insert = "INSERT INTO dfcc_remit(batch_num,tran_id,ref_num,sender_name,sender_curr,sender_phone,tran_amt,benif_name,benif_glob_id,benif_cont_num,purpose,acc_num,bank_code,bran_code)
                            	VALUES ('".$BatchNumber."','".$TransactionID."','".$ReferenceNumber."','".$SenderName."','".$SenderCurrencyCode."','".$SenderPhoneNumber."','".$SendAmount."','".$BenificiaryName."','".$BenificiaryGlobalID."','".$BenificiaryContactNumber."','".$Purpose."','".$AccountNumber."','".$BankCode."','".$BranchCode."');";
                            	$que_sql_insert = mysqli_query($conn , $sql_insert) or die(mysqli_error($conn));
                            }
                        }
                    }   //close while loop
                    // Commit transaction
                    if (mysqli_commit($conn)) 
                    {
                        echo ' <span style="color:green;"> Upload completed...! </span>';
                        echo "<br><br>";
                        echo "Batch Number: " . $BatchNumber;
                        echo "<br>";
                        echo "<script type='text/javascript'>
                                document.getElementById('btnSubmit').disabled=true;
                              </script>";
                    }
                else
                {
                    echo ' <span style="color:red;"> Upload failed...! </span>';
                }
                
                fclose($f);
                
                $conn->close(); //close file
        }else
        {
            echo ' <span style="color:red;"> File type invalid. Please select a <.txt> file </span>';
        }
    }else
    {
        echo ' <span style="color:red;"> File is not Selected </span>';
    }
}
?>
</form>
</body>
</html>