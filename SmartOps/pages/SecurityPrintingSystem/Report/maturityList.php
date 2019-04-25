<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Security Printing System
Page Name		: Maturity List
Purpose			: Maturity List - Automation
Author			: Madushan Wikramaarachi
Date & Time		: 02:34 A.M - 2016-06-13
------------------------------------------------------------------------------------------------------------------------>
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="sps/r/002";
	$_SESSION['Module'] = "Security Printing System";
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

    <title>Exam Results</title>

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
<script src="../SPS_DEVELOPMENT/SPS_js_function.js"></script>

<link rel="stylesheet" href="jquery/jquery-ui.css" />
<script src=" jquery/jquery-1.9.1.min.js"></script>
<script src="jquery/jquery-ui.js"></script>

<script type="text/javascript">
/*function disableselect(e) {
    return false;
}

function reEnable() {
    return true;
}

document.onselectstart = new Function("return false");

if (window.sidebar) {
    document.onmousedown = disableselect;
    document.onclick = reEnable;
}*/

function getGried(){
    //alert("A");
    var date1 = document.getElementById('txtFromDate').value;
    var date2 = document.getElementById('txtToDate').value;
    var userGroupEner = document.getElementById('userGroupEner').value;
    var userBranch = document.getElementById('userBranch').value;
    var user = document.getElementById('user').value;
    
    
    if(date1 == ""){
        alert('Missing Entry From (Date)');
   }else if(date2 == ""){
     alert('Missing Entry To (Date)');
   }else{
        mydata= new XMLHttpRequest();
        mydata.onreadystatechange=function(){
            if(mydata.readyState==4){
                //alert('a');
                document.getElementById('maneSpan').innerHTML=mydata.responseText;           
            }
        }
        mydata.open("GET","ajexMaturityList.php"+"?getSRReoptDate1="+date1+"&getSRReoptDate2="+date2+"&getUserGroupEner="+userGroupEner+"&getUserBranch="+userBranch+"&getUser="+user,true);
        mydata.send();
   }
}
</script>
<script>
  $(function() {
    $( "#txtFromDate" ).datepicker({dateFormat:"yy-mm-dd"});
  });
  $(function() {
    $( "#txtToDate" ).datepicker({dateFormat:"yy-mm-dd"});
  });
</script>
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
                   Maturity List Information
            </div>
            <div class="panel-body">
                 <div class='form-group'>
                    <?php 
                        $sql_date = "SELECT mis.* from (SELECT `FROM_DATE`,`TO_DATE` FROM `fd_mat_list_head` order by `FROM_DATE` desc) mis limit 1";
                        $quary_date = mysqli_query($conn , $sql_date);
                        while($rec_date = mysqli_fetch_assoc($quary_date)){
                            $fDate = $rec_date['FROM_DATE'];
                            $tDate = $rec_date['TO_DATE'];
                        }
                    ?>
					 <label class="col-sm-2">From Date : </label>
                     <div class="col-sm-2">
                        <input type="text" class="form-control" id="txtFromDate" name="txtFromDate" value="<?php echo $fDate; ?>" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeypress="return disableEnterKey(event)" placeholder="From Date" />
				     </div>
                     <label class="col-sm-2">To Date : </label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" id="txtToDate" name="txtToDate" value="<?php echo $tDate; ?>" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)"  onkeypress="return disableEnterKey(event)" placeholder="To Date"/>
				    </div>
                 </div>
			</div>
    </div>
</div>
<div class="container-fluid">
    <button type="button" style="width: 100px;" class="btn btn-success" onclick="pageClose()">Close</button>
    <button type="button" style="width: 100px;" class="btn btn-success" onclick="getGried()">Select</button>
</div>
<div style="display: none;">
   <input type="text" id="userGroupEner" name="userGroupEner" value="<?php echo $_SESSION['userGroupEner']; ?>" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeypress="return disableEnterKey(event)"/> 
   <input type="text" id="userBranch" name="userBranch" value="<?php echo $_SESSION['userBranch']; ?>" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeypress="return disableEnterKey(event)"/> 
   <input type="text" id="user" name="user" value="<?php echo $_SESSION['user']; ?>" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeypress="return disableEnterKey(event)"/> 
</div>
<hr />
<div id="maneSpan">
<table id="myTable" class="table table-striped table-bordered table-hover" style="font-size: 11px;">
    <thead>
        <tr>
            <!--
            <th>From Date</th>
            <th>To Date</th>
            -->
            <th>Deposit N0</th>
            <th>Client Name</th>
            <th>Deposit Date</th>
            <th>Maturity Date</th>
            <th>Current Branch CD</th>
            <th>Current Branch Name</th>
            <th>Introducer Code</th>
            <th>Introducer Name</th>
            <th>Channel</th>
        </tr>
    </thead>
    <tbody>
    <?php
        // echo "Session User : ".$_SESSION['user'];
        if($_SESSION['userGroupEner'] == 'ug00026' || $_SESSION['userGroupEner'] == 'ug00015'){ //IF USER GROUP IS CSO(ug00026) OR HOB(ug00015)
            $select_list = "SELECT * 
                            FROM fd_mat_list FDM, fd_mat_list_head FDMH 
                            WHERE FDM.FROM_DATE = FDMH.FROM_DATE
                              AND FDM.TO_DATE = FDMH.TO_DATE   
                              AND FDM.CURRENT_BRANCH_CD = (SELECT BR.br_code FROM branch BR WHERE BR.branchNumber = '".$_SESSION['userBranch']."') 
                              AND FDM.FROM_DATE = '".$fDate."'
                              AND FDM.TO_DATE = '".$tDate."'";
                             
            if($_SESSION['userGroupEner'] == 'ug00026'){ 
               // echo "test";
                $select_list = $select_list. " AND  (TRIM(FDM.INTRO_CD) = '".$_SESSION['user']."' OR TRIM(FDM.INTRO_CD) IS NULL OR TRIM(FDM.INTRO_CD) = 'RESIGNED')";
            }
            
            $select_list = $select_list. "ORDER BY MAT_DATE ASC;";                 
                                   //".$_SESSION['user']."
            $quary_list = mysqli_query($conn , $select_list);
            $x = 1;
            while($result_list = mysqli_fetch_assoc($quary_list)){
                echo "<tr>";
                // echo "<td>".$result_list['FROM_DATE']."</td>"; 
                // echo "<td>".$result_list['TO_DATE']."</td>";
                echo "<td>".$result_list['DEP_NO']."</td>";
                echo "<td>".$result_list['CLIENT_NAME']."</td>";
                echo "<td>".$result_list['DEP_DT']."</td>";
                echo "<td>".$result_list['MAT_DATE']."</td>";
                echo "<td>".$result_list['CURRENT_BRANCH_CD']."</td>";
                echo "<td>".$result_list['CURRENT_BRANCH_DESCR']."</td>";
                echo "<td>".$result_list['INTRO_CD']."</td>";
                echo "<td>".$result_list['INTRO_NAME']."</td>";
                echo "<td>".$result_list['CHANNEL']."</td>";
                echo "</tr>";
                $x++;
            }
            if($x==1) echo "<tr><td colspan='9'> No record(s) to print</td></tr>";
        }else { ////if($_SESSION['userGroupEner'] == 'ug00026')
            $select_list = "SELECT * FROM fd_mat_list FDM, fd_mat_list_head FDMH
                            WHERE FDM.FROM_DATE = FDMH.FROM_DATE
                              AND FDM.TO_DATE   = FDMH.TO_DATE
                              AND FDM.INTRO_CD  = '".$_SESSION['user']."'
                              AND FDM.INTRO_CD <> ''
                              AND FDM.FROM_DATE = '".$fDate."'
                              AND FDM.TO_DATE = '".$tDate."';";
                                  //".$_SESSION['user']."
            $quary_list = mysqli_query($conn , $select_list);
            $x = 1;
            while($result_list = mysqli_fetch_assoc($quary_list)){
                echo "<tr>";
                // echo "<td>".$result_list['FROM_DATE']."</td>"; 
                // echo "<td>".$result_list['TO_DATE']."</td>";
                echo "<td>".$result_list['DEP_NO']."</td>";
                echo "<td>".$result_list['CLIENT_NAME']."</td>";
                echo "<td>".$result_list['DEP_DT']."</td>";
                echo "<td>".$result_list['MAT_DATE']."</td>";
                echo "<td>".$result_list['CURRENT_BRANCH_CD']."</td>";
                echo "<td>".$result_list['CURRENT_BRANCH_DESCR']."</td>";
                echo "<td>".$result_list['INTRO_CD']."</td>";
                echo "<td>".$result_list['INTRO_NAME']."</td>";
                echo "<td>".$result_list['CHANNEL']."</td>";
                echo "</tr>";
                $x++;
            }
            if($x==1) echo "<tr><td colspan='9' style='font-size: 11px;'> No record(s) to print</td></tr>";
        }
    ?>  
    
    </tbody>
</table>
</div>
<span id="error"></span>
</form>
<script type="text/javascript">
    
</script>
</body>
</html>