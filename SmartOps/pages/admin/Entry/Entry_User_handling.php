<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Admin
Page Name		: Unlock User Account
Purpose			: To Unlock User Account
Author			: Madushan Wikramaarachchi
Date & Time		: 12.22 P.M 19/08/2014 (Modified)
                : 12:10 P.M 27/04/2014 (MOdified) - Inculed bootstrap (Madushan)
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="P007";
	$_SESSION['Module'] = "Admin";
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

    <title>Module Management</title>

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
<script language="javascript" type="text/javascript">
	function pageRef(){
        window.open('http://cdberp:8080/cdb/pages/admin/Entry/Entry_User_handling.php?DispName=Unlock%20User%20Account','conectpage');
    }
    
    function getdate(title){
        //alert(title);
        var c = document.getElementById('txtlogUser').value;
        if(title != ""){
            var r = confirm('Are you sure you want to Un - Block this?')
            if (r==true){
                //alert(c);
    			$.ajax({ 
    				type:'POST', 
    				data: {id : title ,value:c}, 
    				url: 'grid/aa.php', 
    				success: function(v_date) { 
    				    //alert(v_date);
                        if(v_date == 'YES'){
                            alert('Un-Block success!');
                            pageClose();
                        }else{
                            alert('Un-Block not success!');
                            pageClose();
                        }
     				         
    			     }
    			});
            }else{
    			//alert('BBBBB');		
    		}
        }else{
            alert('Missing User ID.');
        }
    }
</script>
</head>

<body oncontextmenu="return false">
<form class="form-horizontal" action="" method="post" style="margin-left: 20px;">
<h3>
<?php 
	echo $_REQUEST['DispName'];
?>
</h3>
<hr/>
<div style='display:none;'><input type='text' name='txtlogUser' id='txtlogUser' value='<?php echo $_SESSION['user']; ?>'/></div>
<div class="panel panel-default">
    <div class="panel-heading">
        User Block Informetion
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <div class="table-responsive">
            <table id="myTable" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>User ID</th>
                        <th>User Name</th>
                        <th>IP</th>
                        <th>Account State</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $select_module = "SELECT DISTINCT `userName`,`userID`,`accountStat`,`ip` FROM user_active  WHERE `accountStat` = 'L' ORDER BY userName ASC;";
                    $quary_module = mysqli_query($conn , $select_module);
                    $x = 1;
                    while($result_module = mysqli_fetch_array($quary_module)){
                        echo "<tr title='".$result_module[0]."' ondblclick='getdate(title);'>";
                        echo "<td>".$x."</td>";
                        echo "<td>".$result_module[0]."</td>";
                        echo "<td>".$result_module[1]."</td>";
                        echo "<td>".$result_module[3]."</td>";
                        echo "<td>".$result_module[2]."</td>";
                        echo "</tr>";
                        $x++;
                    }
                ?>  
                </tbody>
            </table>                   
        </div>
        <!-- /.table-responsive -->
    </div>
    <!-- /.panel-body -->
</div>
                <!-- /.panel -->

</form>
</body>
</html>
