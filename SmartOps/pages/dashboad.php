<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Dash Boad
Page Name		: Dash Boad
Purpose			: To Create Dash Boad
Author			: Madushan Wikramaarachchi
Date & Time		: 2.17 P.M 06/04/2016 
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	if(!isset($_SESSION['user']) && !isset($_SESSION['userID']) && !isset($_SESSION['userBranchName']) && !isset($_SESSION['GSMNO']) && !isset($_SESSION['userEmail']) && !isset($_SESSION['usergroupNumber']))
    {
    	header('Location:../index.php');	
    }
    include('../php_con/includes/db.ini.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Dash boad</title>
<!-- Common function Libariries -->
<!-- CSS-->
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>CDB Smart Operations</title>

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet" />

    <!-- Custom CSS -->
    <link href="../dist/css/realSolution_1.css" rel="stylesheet" />

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]--> 
   <script type="text/javascript" src="../javascript/jquery.js"></script>
        <script type="text/javascript" src="../javascript/bootstrap.js"></script>
    <script>
    function startTime() {
        var today = new Date();
        var h = today.getHours();
        var m = today.getMinutes();
        var s = today.getSeconds();
        m = checkTime(m);
        s = checkTime(s);
        document.getElementById('txt').innerHTML =
        h + ":" + m + ":" + s;
        var t = setTimeout(startTime, 500);
    }
    function checkTime(i) {
        if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
        return i;
    }
    function pageClose(){ //Page Close Function.......
	   parent.location.href = parent.location.href;
    }
    function isDonotshow(title){
        //alert(title);
        var r = confirm('Are you sure you want to Do not show this?')
        if (r==true){
         //alert(var_aa+"--"+var_bb+"--"+var_ee+"--"+var_ff+"--"+var_gg);
	     $.ajax({ 
				type:'POST', 
				data: {getdonotshowid : title }, 
				url: '../php_con/comfunction.php', 
				success: function(val_retn) { 
				   if(val_retn == 'OK'){
				        pageClose();
				   }else{
				     alert('Not Update');
				   }
				    
				}
			});
        }else{
			//alert('BBBBB');		
		}
    }
    </script>
</head>
<body oncontextmenu="return false" style="background-color: #FFFFFF;" onload="startTime()" >
<form action="" method="post">
<br /><br />
<div class="row">
<div class="col-lg-6 col-md-6">
       <?php
                                   $ans = getResalt_view($conn,$_SESSION['user']);
                                   
                                   if($ans != ""){
                                    echo "<div class='alert alert-success alert-dismissable' style='margin-left: 50px;'>";
                                    //echo "<marquee behavior='scroll' direction='UP' scrollamount='3' height='200px'>";
                                     echo $ans;
                                    echo "</marquee>";
                                    echo "</div>";
      
      ?>
                            
<?php
}else{
          echo "<img src='../images/cover-img_asp.png' class='col-lg-12 col-md-12'/>";                          
}
?>
</div>
<div class="col-lg-6 col-md-5">
    <div class="panel panel-default">
        <div class="panel-heading">
            System Information
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped" style="font-size: 13px;">
                    <tbody>
                        <tr>
                            <td style="width: 110px;">Date</td>
                            <td>: <?php echo $_SESSION['CURRENT_DATE']; ?></td>
                        </tr>
                        <tr>
                            <td style="width: 110px;">Time</td>
                            <td>: <span id="txt"></span></td>
                        </tr>
                        <tr>
                            <td style="width: 110px;">User ID </td>
                            <td>: <?php echo $_SESSION['user']; ?></td>
                        </tr>
                        <tr>
                            <td style="width: 110px;">User Name</td>
                            <td>: <?php echo $_SESSION['userID']; ?></td>
                        </tr>
                        <tr>
                            <td style="width: 110px;">User Branch</td>
                            <td>: <?php echo $_SESSION['userBranchName']; ?></td>
                        </tr>
                        <tr>
                            <td style="width: 110px;">Mobile Number </td>
                            <td>: <?php echo $_SESSION['GSMNO']; ?></td>
                        </tr>
                        <tr>
                            <td style="width: 110px;">E - mail </td>
                            <td>: <?php echo $_SESSION['userEmail']; ?></td>
                        </tr>
                        <tr>
                            <td style="width: 110px;">User Group</td>
                            <td>: <?php 
                                        $v_sql_uGroup ="SELECT `usergroupName` FROM `usergroup` WHERE `usergroupNumber` = '".$_SESSION['usergroupNumber']."'";
            				    $addv_sql_uGroup = mysqli_query($conn,$v_sql_uGroup);
            				    while ($recaddv_sql_uGroup = mysqli_fetch_assoc($addv_sql_uGroup)){
            					   echo $recaddv_sql_uGroup['usergroupName'];
            				    } ?></td>
                        </tr>
                        <tr>
                            <td style="width: 110px;">System Version</td>
                            <td>: CDB Smart Operations - 3.0</td>
                        </tr>
                    </tbody>
                </table>
               
            </div>
            <div style="text-align: center;">
                <!--<span style="font-size: 12px;">Developed By : CDB IT</span> -->
            </div>
            <!-- /.table-responsive -->
        </div>
        <!-- /.panel-body -->
    </div>
    <!-- /.panel -->
</div>
</div>
<!-- /.col-lg-6 -->
 
</form>
<?php
function getResalt_view($conn,$userID){
   $a = "";
   $sql_select_r = "SELECT `newsId`, `userId`, `newsLbl`, `news`, `startOn`, `endOn`, `newsStast`,'L' FROM `cdb_news` 
                    WHERE  `startOn` <= now()
                      AND `endOn` >= now()
                     AND `newsStast` = 0 
                      AND `userId` = '".$userID."'
                      union all
                      SELECT `newsId`, `userId`, `newsLbl`, `news`, `startOn`, `endOn`, `newsStast`,'G' FROM `cdb_news_global` 
                    WHERE  `startOn` <= now()
                       AND `endOn` >= now()
                       AND `newsStast` = 0;";
  // echo $sql_select_r;
   $que_select_r = mysqli_query($conn,$sql_select_r) or die(mysqli_error($conn));
   if(mysqli_num_rows($que_select_r) != 0){
        
           while($rec_select_r = mysqli_fetch_array($que_select_r)){
            //<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                $a .= "";
                $a .= "<h5><U>".$rec_select_r[2]."</U></h5>";         
                $a .=  $rec_select_r[3];  
				if($rec_select_r[7]=="L")
					$a .= "<hr/><input type='button' class='btn btn-default' value = 'Do not show' style='margin-left: 300px;' title='".$rec_select_r[0]."' onclick='isDonotshow(title);'/>";
           }
     }else{
        $a = "";
     }
     return $a;  
   
}
?>
</body>
</html>