<?php
	session_start();
	$_SESSION['page']="dfc/e/003";
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
{font-family: 'Cuprum';;}

</style>
<link rel="stylesheet" href="jquery/jquery-ui.css" />
<script src=" jquery/jquery-1.9.1.js"></script>
<script src="jquery/jquery-ui.js"></script>
<script src="jquery.btechco.excelexport.js"></script>
<script src="jquery.base64.js"></script>
<script>
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
<body>

<div class="func">
<?php include 'dfcc_func.php';?>
</div>


<?php
// define variables and set to empty values
$batchnum = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $batchnum = test_input($_POST["batchnum"]);
}

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
?>
<p class="topline">Remittance Extract <!-- Current Page Header/Label --></p><hr />
<!-- Screen design will be started from here -->


<?php
  	$conn = dbConnection();
	$sql = "SELECT biz_entity, biz_name FROM dfcc_para WHERE biz_entity = 1";
	$result = mysqli_query($conn, $sql);

	if ($result->num_rows > 0) {
    	// output data of each row
    	while($row = $result->fetch_assoc()) {
        	echo "Business Entity Code : " . $row["biz_entity"]. "<br>". "Business Entity Name: " . $row["biz_name"]. "<br>";
    	}
	} else {
    		echo "0 results";
	}
	$conn->close();
?>

<br/>
<form method="post" action="<?php //echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
Batch Number: <input type="text" name="batchnum" />
<input type="submit" name="submit" value="Submit" /> 
<br /><br />
<input type="checkbox" name="process" value="process"/> Process<br/>
<input type="button" style="width: 100px;" name="btnExport" id="btnExport" value="Excel" disabled="disabled"/>
</form>
<br />

<?php
  	$conn = dbConnection();
    
    //get value date
    $sql = "SELECT `upload_date` FROM `dfcc_remit_hd` WHERE `batch_num` = '".$batchnum."' ";
    $result_valdate = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result_valdate);
    $val_date = $row["upload_date"];
    
    //populate grid datal
	$sql = "SELECT `batch_num`, `tran_id`, `ref_num`, `sender_name`, `sender_curr`, `sender_phone`, `tran_amt`, `benif_name`, `benif_glob_id`, `benif_cont_num`, `purpose`, `acc_num`, `bank_code`, `bran_code`
            FROM `dfcc_remit` WHERE batch_num = '".$batchnum."' ";
	$result = mysqli_query($conn,$sql);

	if(mysqli_num_rows($result) > 0) {
	    $i = 0;
        
        //convert date to DDMMYYYY
        $timestamp = strtotime($val_date);
        $dmy = date("dmY", $timestamp);
    	// output data of each row
        echo "<div id='cueTopBrnch'>
                <table border='1' cellpadding='0' id='myTable' cellspacing='0'>";
        echo "<tr>
                <td bgcolor='FFFF66'>Serial</td>
                <td bgcolor='FFFF66'>Value Date</td>
                <td bgcolor='FFFF66'>Account Number</td>
                <td bgcolor='FFFF66'>Amount</td>
                <td bgcolor='FFFF66'>Transaction Reference</td><td>Batch Number</td>
                <td>Transaction ID</td>
                <td>Reference Number</td>
                <td>Sender Name</td>
                <td>Sender Currency Code</td>
                <td>Sender Phone Number</td>
                <td>Benificiary Name</td>
                <td>Benificiary Global ID</td>
                <td>Benificiary Contact Number</td>
                <td>Purpose</td>
                <td>Bank Code</td>
                <td>Branch Code</td>
            </tr>";
    	while($row = mysqli_fetch_assoc($result)){
    	    $i = $i + 1;
            echo "<tr>";
            echo "<td bgcolor='FFFF66'>".$i."</td><td bgcolor='FFFF66'>" . $dmy. "</td><td bgcolor='FFFF66'>" .$row["acc_num"]."</td><td bgcolor='FFFF66'>".$row["tran_amt"]."</td><td bgcolor='FFFF66'>".$row["benif_glob_id"]."-".$row["purpose"]."</td><td>".$row["batch_num"]."</td><td>".$row["tran_id"]."</td><td>".$row["ref_num"]."</td><td>".$row["sender_name"]."</td><td>".$row["sender_curr"]."</td><td>".$row["sender_phone"]."</td><td>".$row["benif_name"]."</td><td>".$row["benif_glob_id"]."</td><td>".$row["benif_cont_num"]."</td><td>".$row["purpose"]."</td><td>".$row["bank_code"]."</td><td>".$row["bran_code"]."</td>";
            echo "</tr>";
    	}
        echo "</table>
                </div>";
        if(!empty($_POST['process'])) {
            $sql = "SELECT process_serial FROM dfcc_remit_hd WHERE batch_num = '".$batchnum."' ";
            $result_serial_chk = mysqli_query($conn,$sql);
            $row_serial_chk = mysqli_fetch_assoc($result_serial_chk);
            if ($row_serial_chk["process_serial"] == 0) 
            {
                echo "<script type='text/javascript'>
                                    document.getElementById('btnExport').disabled=false;
                                  </script>";
            
                //update processed by user
                $sql = "UPDATE dfcc_remit_hd SET process_serial = process_serial + 1, process_by = '".$_SESSION['user']."', process_date = DATE(NOW())
                WHERE batch_num = '".$batchnum."' ";
                $result_update = mysqli_query($conn,$sql);
                echo "<font color='green'> Remittance processed successfully..! </font>";
            }else
            {
                echo "<font color='red'> Remittance already Processed..! </font>";
            }
            
        }
	} else {
    		echo "0 results";
	}
	$conn->close();
?>

</body>
</html>