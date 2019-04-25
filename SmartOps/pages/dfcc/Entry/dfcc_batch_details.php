<?php
	session_start();
	$_SESSION['page']="dfc/e/002";
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
.error {color: #FF0000;}
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
$gender = "today";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $gender = test_input($_POST["gender"]);
}

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
?>
<p class="topline"> Remittance Batch Details <!-- Current Page Header/Label --></p><hr />
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
<br><br>


<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
   <input type="radio" name="gender" <?php if (isset($gender) && $gender=="today") echo "checked";?>  value="today">Today
   <input type="radio" name="gender" <?php if (isset($gender) && $gender=="all") echo "checked";?>  value="all">All
   <input type="submit" name="submit" value="Submit"> 
</form>


<br>
<?php
  	$conn = dbConnection();
    //populate grid datal

    if ($gender== "today") 
    {
        $sql = "SELECT upload_date, batch_num, file_name, upload_by, process_serial, process_date, process_by
        FROM dfcc_remit_hd WHERE upload_date =  DATE(NOW()) order by 1 desc,2 desc";
	    $result = mysqli_query($conn,$sql);
    } else if ($gender== "all"){
        $sql = "SELECT upload_date, batch_num, file_name, upload_by, process_serial, process_date, process_by
        FROM dfcc_remit_hd order by 1 desc,2 desc";
	    $result = mysqli_query($conn,$sql);
    }

	if(mysqli_num_rows($result) > 0) {
    	// output data of each row
        echo "<table id='myTable'>";
        echo "<tr><td>Upload Date</td><td>Batch Number</td><td>File Name</td><td>Upload By</td><td>Process Seriel</td><td>Processed Date</td><td>Processed By</td> </tr>";
	while($row = mysqli_fetch_assoc($result)){
    	    //$i = $i + 1;
            echo "<tr>";
            echo "<td>".$row["upload_date"]."</td><td>".$row["batch_num"]."</td><td>".$row["file_name"]."</td><td>".$row["upload_by"]."</td><td>".$row["process_serial"]."</td><td>".$row["process_date"]."</td><td>".$row["process_by"]."</td>";
            echo "</tr>";
    	}
        echo "</table>";
	} else {
    		echo "0 results";
	}
	$conn->close();
?>







</body>
</html>