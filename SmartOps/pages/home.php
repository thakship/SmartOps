<?php
session_start();
if(!isset($_SESSION['user']) && !isset($_SESSION['userBranch']))
{
    //echo "a";
    echo "<script> alert('Undefind User !'); </script>";
	header('Location:../index.php');	
}else{
include('../php_con/includes/db.ini.php');
$sql = "SELECT `currentDate` FROM `systemdate` WHERE `index`='1'";
$add = mysqli_query($conn,$sql);
while ($rec = mysqli_fetch_array($add)){
	$dateNow = $rec[0];
	
}
$PAUTH = 0;
$_SESSION['CURRENT_DATE'] = $dateNow;
$sqlBranch = "SELECT `branchName` FROM `branch` WHERE `branchNumber`= '".$_SESSION['userBranch']."'";
$addBranch = mysqli_query($conn,$sqlBranch);
while ($rec1 = mysqli_fetch_array($addBranch)){
	$BranchName = $rec1[0];
}

                          
      
$sqlBranch = "SELECT COUNT(*) FROM (SELECT CH.helpid FROM `cdb_helpdesk` AS CH , `scat_02` WHERE CH.`scat_code_2` = `scat_02`.scat_code_2 AND CH.`cmb_code` = '5000' AND CH.`entry_branch` = '".$_SESSION['userBranch']."' AND CH.`entry_department` = '".$_SESSION['userDepartment']."' UNION SELECT `loan_cdb_helpdesk`.helpid FROM `loan_cdb_helpdesk` , `loan_product` WHERE `loan_cdb_helpdesk`.`scat_code_2` = `loan_product`.product_id AND  `loan_cdb_helpdesk`.`cmb_code` = '5000' AND `loan_cdb_helpdesk`.`entry_branch` = '".$_SESSION['userBranch']."' AND `loan_cdb_helpdesk`.`entry_department` = '".$_SESSION['userDepartment']."') AS TBL;";
//echo $sqlBranch;
$addBranch = mysqli_query($conn,$sqlBranch);
while ($rec1 = mysqli_fetch_array($addBranch)){
	$PAUTH = $rec1[0];
}


$_SESSION['USERBRANCHNAME'] = $BranchName;
            
?>
<!DOCTYPE html>
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
    <style type="text/css">
        .inline_conectpage1{
            background-size: cover !important;
        }
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
		height:400px;
		border:#000000 solid 1px;
	}
    </style>
<!-- Added by Rizvi 10:07 AM 26/12/2017 for implement the snow fall effect 
<script type="text/javascript" src="snowstorm.js"></script>	
	-->
<!-- now, we'll customize the snowStorm object -->
<!-- 
<script>
snowStorm.snowColor = '#33AFFF';   // blue-ish snow! #99ccff?
snowStorm.flakesMaxActive = 96;    // show more snow on screen at once
snowStorm.useTwinkleEffect = true; // let the snow flicker in and out of view
</script>
-->
<!-- <script>
snowStorm.snowColor = '#33B8FF';
</script>-->
</head>


<body style="background-color: #F9F9F9;">
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0; background-color: #ebeedd;">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                
                <a class="navbar-brand" href="home.php" style="font-weight: bold;"><span style="float: left; margin-left: 10px; margin-top: -8px;"><img src="../img/smartops2.png"/></span><span style="color: #00a0df; margin-left: 100px; font-family: sans; font-size: 30px;"></span></a>
					
            </div>
			<div class="navbar-header">
			<?php 
				if($PAUTH>0){?>
					<!--
					<a href="http://cdberp:8080/cdb/pages/helpdesk/Entry/ServiceRequestAuthorization.php?DispName=Service%20Request%20Authorization" target='conectpage' onclick='bodyViweload()'><span style="float: left; margin-left: 10px; margin-top: 15px;">Auth Pending</span></a>
					 -->
					<a href="../../cdb/pages/helpdesk/Entry/ServiceRequestAuthorization.php?DispName=Service%20Request%20Authorization" target='conectpage' onclick='bodyViweload()'><span style="float: left; margin-left: 10px; margin-top: 15px;">Auth Pending</span></a>					 
				<?php }	
			?>
			</div>
            <!-- /.navbar-header -->
            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="color: #7575a3;">
                        <i class="fa fa-user fa-fw"></i> <?php echo $_SESSION['user']; ?> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="admin/Entry/my_password_reset.php?DispName=My Password Reset" target='conectpage' onclick='bodyViweload()'><i class="fa fa-key fa-fw"></i> Password Reset</a></li>
                        <li class="divider"></li>
                        <?php
                            $sql_logbranch = "SELECT COUNT(*) FROM button_dif_access AS b WHERE b.b_id = 2 AND (b.acc_group = '".$_SESSION['usergroupNumber']."' OR b.acc_group = '".$_SESSION['user']."');";
                            $query_logbranch = mysqli_query($conn,$sql_logbranch) or die(mysqli_error($conn));
                            while($rec_logbranch = mysqli_fetch_array($query_logbranch)){
                                if($rec_logbranch[0] != 0){
                                    echo " <li><a href='admin/Entry/branchAcc.php?DispName=Branch Access' target='conectpage' onclick='bodyViweload()'><i class='fa fa-home fa-fw'></i> Branch Access</a></li>
                                           <li class='divider'></li>";
                                }
                            }
                        ?>
                        <!--<li><a href="txtFileCr.php"><i class="fa fa-thumbs-up  fa-1x"></i> My Suggestions</a></li>-->
						<li><label style="padding-left: 25px;" onclick="popup(1)"><i class="fa fa-thumbs-up  fa-1x"></i> My Suggestions</label></li>
                        <li class="divider"></li>
                        <li><a href="../logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <script type="text/javascript">
                        function bodyViweload(){
    	 					document.getElementById('conectpage').style.display = '';
    						document.getElementById('conectpage1').style.display = 'none';
    							//alert('status');
						}
                        function loadBranch(){
                            alert('A');
                        }
                    </script>
                    
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation" >
                <div class="sidebar-nav navbar-collapse" style="overflow-y: scroll;height: 550px; font-size: 12px;">
                    <ul class="nav" id="side-menu">
				    <?php
                    //$urlTran = "&user=".$_SESSION['user'];
                    $urlTran = "";
                    $usergroupNumber =$_SESSION['usergroupNumber'];
                    $sql_select_modules = "SELECT DISTINCT(module.moduleCode) , module.moduleName , module.IconName
                                            FROM usergroup_module AS aum , module as module
                                            WHERE module.moduleCode = aum.moduleCode AND
                                                  aum.usergroupNumber = '".$_SESSION['usergroupNumber']."' 
                                            ORDER BY module.moduleCode ;";
                    $quary_select_modules=mysqli_query($conn,$sql_select_modules);
                    //echo   "<ul>";
                    $a = 0;
                    while($recod_select_modules = mysqli_fetch_array($quary_select_modules)){
                        //echo $recod1[0];
                        $a++;
                        echo "<li><a href='#'><i class='fa ".$recod_select_modules[2]." fa-fw'></i> ".$recod_select_modules[1]."<span class='fa arrow'></span></a>";
                           
                            $sql_select_pageType="SELECT DISTINCT(ap.pageType)
                                    FROM pages AS ap , usergroup_module_page AS aump
                                    WHERE aump.moduleCode = '".$recod_select_modules[0]."' AND
                                    			ap.moduleCode = aump.moduleCode AND
                                    			ap.pageCode = aump.pageCode AND
                                    			aump.usergroupNumber = '".$_SESSION['usergroupNumber']."'
                                    ORDER BY ap.moduleCode , ap.pageType ;";
                            $quary_select_pageType = mysqli_query($conn,$sql_select_pageType);
                            //echo $sql2;
                            echo "<ul class='nav nav-second-level'>";
                            while($recod_select_pageType= mysqli_fetch_array($quary_select_pageType)){
                                echo "<li><a href='#'><i class='fa fa-angle-double-right fa-fw'></i> ".$recod_select_pageType[0]."<span class='fa arrow'></span></a>";
                                
                                $sql_select_page="SELECT ap.pageCode , ap.pagePath , ap.pageName
                                        FROM pages AS ap , usergroup_module_page AS aump 
                                        WHERE aump.usergroupNumber = '".$_SESSION['usergroupNumber']."' AND
                                        			aump.moduleCode = '".$recod_select_modules[0]."' AND
                                        			ap.pageType = '".$recod_select_pageType[0]."' AND
                                        			ap.moduleCode = aump.moduleCode AND
                                        			ap.pageCode = aump.pageCode 
                                        ORDER BY ap.moduleCode , ap.pageType";
                                $quary_select_page=mysqli_query($conn,$sql_select_page);
                                
                                echo "<ul class='nav nav-third-level'>";
                                $x = 1;
                                while($recod__select_page = mysqli_fetch_array($quary_select_page)){
                                    //$_SESSION['pageacc'.$x] = $recod3[0];
                                    $x++;
                                    echo "<li><a style='text-decoration:none;' href='".$recod__select_page[1]."?DispName=".$recod__select_page[2].$urlTran."' target='conectpage'><label style='font-weight: normal;' onclick='bodyViwe".$x."()'>".$recod__select_page[2];
                                    echo "</label></a></li>";
                					echo "<script>
                						function bodyViwe".$x."(){
                	 					document.getElementById('conectpage').style.display = '';
                						document.getElementById('conectpage1').style.display = 'none';
										//alert('".$recod__select_page[1]."');
                						}
                					</script>";
                                }
                                echo "</ul>"; //detail line end
                                echo "</li>";	//master line end
                            }
                           echo "</ul>";	
                        echo "</li>";	
                    }
                    // echo   "</ul>";		     
                    ?>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <!-- Page Content -->
        <div id="page-wrapper" style="padding: 0px;">
            <div class="container-fluid col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0px;">
                <div class="row">
                    <iframe class="col-lg-12 col-md-12 col-sm-12 col-xs-12 inline_conectpage1" id="conectpage1" frameBorder="0" style="background-color:#ffffff; height: 550px; padding: 0;" src="dashboad.php">
                        
                    </iframe>
        			<iframe class="col-lg-12 col-md-12 col-sm-12 col-xs-12 inline_conectpage1" name="conectpage" frameBorder="0" id="conectpage" style='display:none; height: 550px;'>
                        
                    </iframe>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
<div style="display: none;">
    <input type="text" name="txt_EntryUser" id="txt_EntryUser" value="<?php echo  $_SESSION['user']; ?>" />
</div> 
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

<script>
function pageClose(){ //Page Close Function.......
	parent.location.href = parent.location.href;	
}
function popup(x){
      // alert(x);
        //alert(title);
     if(x==1){ 
		   // alert('a');
			var mydataGried;
			mydataGried = new XMLHttpRequest();
			mydataGried.onreadystatechange=function(){
				if(mydataGried.readyState==4){
				 //   alert('b');
					document.getElementById('getGried').innerHTML = mydataGried.responseText;  
					document.getElementById('outer').style.visibility = "visible";
					document.getElementById('conten').style.visibility = "visible";
				}
			}
            //alert('v');
			mydataGried.open("GET","../php_con/ajaxGrid.php"+"?Load_su="+x,true);
			mydataGried.send();
		
	  }else{
		document.getElementById('outer').style.visibility = "hidden";
		document.getElementById('conten').style.visibility = "hidden";
	  }	
}

function is_getScat_01(){
    var cat2 = document.getElementById('sel_scat02').value;
    //alert(cat2);
    var mydata;
    mydata= new XMLHttpRequest();
    mydata.onreadystatechange=function(){
        if(mydata.readyState==4){
            document.getElementById('divz').innerHTML=mydata.responseText;
        }
    }
    mydata.open("GET","../php_con/ajaxGrid.php"+"?getIsCat2="+cat2,true);
    mydata.send();
}

function isSolution(){
   // alert('A00');
   var EntryUser = document.getElementById('txt_EntryUser').value;
   var catagory = '1011';
   var scat_1 = '101121';
   var scat_2 = document.getElementById('sel_scat02').value;
   var scat_3 = document.getElementById('sel_scat03').value;
   var iss = document.getElementById('txt_issue').value;
   var iss_dis =  document.getElementById('txt_Description').value;
    
   
    var r = confirm('Confirm to Approved?');
    if (r==true){
        //alert('function ok');
        //$entryUser,$catagory,$scat_1,$scat_2,$scat_3,$iss,$iss_dis
		$.ajax({ 
			type:'POST', 
			data: {isEntryUserHelpdesk : EntryUser , iscatagory : catagory , isscat_1 : scat_1 , isscat_2 : scat_2 , isscat_3 : scat_3 , isiss : iss ,isdis : iss_dis }, 
			url: '../php_con/includes/functionCommen.php', 
			success: function(val_retn) { 
			    //document.getElementById('maneSpan').innerHTML = val_retn;
			    alert(val_retn);
                pageClose();
                //pageCloseDefineLetterTypes();
                
			}               
		});
    }
    
}
</script>
<div id="getGried"></div>
<?php
if(isset($_POST['btn_Edit']) && $_POST['btn_Edit']=='Submit'){
        //echo "<script>alert('A');</script>";
    $entryUser = $_SESSION['user'];
    //echo $entryUser;
     $catagory  = "1011";
     $scat_1 =  "101121";
     $scat_2 = $_POST['sel_scat02'];
     $scat_3 = $_POST['sel_scat03'];
     $iss = $_POST['txt_issue'];
     $iss_dis = $_POST['txt_Description'];
     //echo $entryUser ." -- ". $catagory ." -- ". $scat_1 ." -- ". $scat_2 ." -- ". $scat_3 ." -- ".  $iss ." -- ". $iss_dis;
    // $entryUser - Entry Use
         //  echo $entryUser;
    // $catagory  - Catagory
    // $scat_1 - Sub catagary 1  
    // $scat_2 - Sub catagary 2
    // $scat_3 - Sub catagary 3
    // $iss    - Issur
    // $iss_dis - Issuer Discreption
    // $entryUser - Entry User
    $validateCount = 0;
    $sql_Auth_Very = "SELECT `auth_verified`,`scat_code_2`,`DefuserID` 
                        FROM `scat_02` 
                       WHERE `cat_code` = '".$catagory."' 
                         AND  `scat_code_1` = '".$scat_1."' 
                         AND `scat_code_2` = '".$scat_2."';";
   // echo $sql_Auth_Very;
    $query_Auth_Very = mysqli_query($conn ,$sql_Auth_Very) or die(mysqli_error($conn));
    $rowcount = mysqli_num_rows($query_Auth_Very);
    if($rowcount != 0){
        // ---- Create Table ID ---------------------------------------
        $sql = "SELECT `currentDate` FROM `systemdate` WHERE `index`='1'";
        $add = mysqli_query($conn,$sql);
        while ($rec = mysqli_fetch_array($add)){
        	$dateNow = $rec[0];
        	
        }
        $Current_Year = date("Y" , strtotime($dateNow));
        $sqlFunction ="SELECT GetNextSerial('m6',".$Current_Year.") FROM DUAL";    //Create the Unique Bokking Reference [Year wise]
        $quary_Function = mysqli_query($conn,$sqlFunction);
        while ($rec_Function = mysqli_fetch_array($quary_Function)){
            $batch_num = $rec_Function[0]; 
        }
        $TableID = $Current_Year.str_pad($batch_num, 6, '0', STR_PAD_LEFT); //This will return 2014000001 as first number for 2014 and 20150001 in 2015
       //-------------------------------------------------------
        $txt_issue = mysqli_real_escape_string($conn,trim($iss));
        $txt_Description = mysqli_real_escape_string($conn,trim($iss_dis));
        while($rec_Auth_Very = mysqli_fetch_array($query_Auth_Very)){
            $scat_code_2 = $rec_Auth_Very[1]; // Sub catagary 2
            $usrDf = $rec_Auth_Very[2]; //Defalt asing user
            // Get User Barnch Number and Department Number 
            //$userBranch
            //$userDepartment
            //$userIP
             $sql_user_dtl = "select u.branchNumber , u.deparmentNumber , u.ip 
                              from user u
                              WHERE u.userName = '".$entryUser."';";
            $query_user_dtl = mysqli_query($conn ,$sql_user_dtl) or die(mysqli_error($conn));
           
            while($rec_user_dtl = mysqli_fetch_array($query_user_dtl)){
                $userBranch = $rec_user_dtl[0];
                $userDepartment = $rec_user_dtl[1];
                $userIP = $rec_user_dtl[2];
             }
   //-----------------------------------------------------------------------------------------------
   $_SESSION['fileAttachment'] = "";

 // Attachemt Uploaded..............................................................................
 
   $_SESSION['fileAttachment'] = "";
        if($_FILES["fileAttachment"]["name"] != ""){ 
            $temp = explode(".", $_FILES["fileAttachment"]["name"]);
            $extension = end($temp);
            if(($_FILES["fileAttachment"]["size"] < 12000000)){
                if($_FILES["fileAttachment"]["error"] == 0){
				    $getUploadStates = 2;
                }else{
				   $_SESSION['fileAttachment'] = $TableID.$_FILES["fileAttachment"]["name"];
				   $sql = "SELECT `currentDate` FROM `systemdate` WHERE `index`='1'";
				   $add = mysqli_query($conn,$sql);
				   while ($rec = mysqli_fetch_array($add)){
					  $dateNow = $rec[0];
			       }  
                    if(file_exists("C:/wamp64/www/CDB/uploadHelpdesk/" .$_SESSION['fileAttachment'])){
                        //echo "<script> alert('already exists');script>";
                        $getUploadStates = 3;
                        $_SESSION['fileAttachment']="";
					
  				   }else{
                        move_uploaded_file($_FILES["fileAttachment"]["tmp_name"],"C:/wamp64/www/CDB/uploadHelpdesk/" .$_SESSION['fileAttachment']);
                        //echo "<script> alert('Uploaded file');script>";
                        $getUploadStates = $_SESSION['fileAttachment'];
                        
                    }
                }
            }else{
               $getUploadStates =  1;  
            }
        }else{
            $getUploadStates =  4;
        }
//$getUploadStates = is_upload_file($conn,$TableID);
if($getUploadStates == 1){
    echo "<script> alert('maximum file size. < 2MB >');</script>";
}else{
    if($getUploadStates == 2){
        echo "<script> alert('already exists. File Error.');</script>";   
    }else{
        if($getUploadStates == 3){
            echo "<script> alert('already exists. Path.');</script>";
        }else{
            if($rec_Auth_Very[0] == 1){
                $validateCount = 1;
            
                $v_getSQL_insert = "INSERT INTO `cdb_helpdesk`(`helpid`, `cat_code`, `scat_code_1`, `scat_code_2`, `cmb_code`, `ur_code`, `pr_code`, `issue`, `help_discr`, `enterBy`, `enterDateTime`,`attachment_name`, `inner_brCode`, `inner_dept`, `inner_user`, `inner_remark`, `inner_get`,`entry_branch`,`entry_department`,`s_type`,`scat_code_3`,`asing_by`,`ipAddress`,`defPassword`,`ssb_facility_amount`,`init_enrty_by`,`init_enrty_on`,`branch_auth_by`,`branch_auth_on`) 
                                                       VALUES ('".$TableID."', '".$catagory."', '".$scat_1."', '".$scat_code_2."', '5000', '6001', '7002', '".$txt_issue."', '".$txt_Description."', '".$entryUser."', now(),'".$_SESSION['fileAttachment']."','', '', '','','0','".$userBranch."','".$userDepartment."','8001','".$scat_3."','".$usrDf."','".$userIP."','','','".$entryUser."',NOW(),'','0000-00-00 00:00:00');";
                	//echo $v_getSQL_insert."<br/>";
			    $que_getSQL_insert = mysqli_query($conn,$v_getSQL_insert) or die(mysqli_error($conn));
				$v_getSQL_insert_1 = "INSERT INTO `cdb_helpdesk_his`(`helpid`, `cat_code`, `scat_code_1`, `scat_code_2`, `cmb_code`, `ur_code`, `pr_code`, `issue`, `help_discr`, `enterBy`, `enterDateTime`,`attachment_name`, `inner_brCode`, `inner_dept`, `inner_user`, `inner_remark`, `inner_get`,`entry_branch`,`entry_department`,`s_type`,`scat_code_3`,`asing_by`,`ipAddress`,`ssb_facility_amount`,`init_enrty_by`,`init_enrty_on`,`branch_auth_by`,`branch_auth_on`)
                                        VALUES ('".$TableID."', '".$catagory."', '".$scat_1."', '".$scat_code_2."', '5000', '6001', '7002', '".$txt_issue."', '".$txt_Description."', '".$entryUser."', now(),'".$_SESSION['fileAttachment']."','', '', '','','0','".$userBranch."','".$userDepartment."','8001','".$scat_3."','".$usrDf."','".$userIP."','','".$entryUser."',NOW(),'','0000-00-00 00:00:00');";
				//echo $v_getSQL_insert_1."<br/>";
			   $que_getSQL_insert_1 = mysqli_query($conn,$v_getSQL_insert_1) or die(mysqli_error($conn));	
                

            }else{
                $validateCount = 0;
                $v_getSQL_insert = "INSERT INTO `cdb_helpdesk`(`helpid`, `cat_code`, `scat_code_1`, `scat_code_2`, `cmb_code`, `ur_code`, `pr_code`, `issue`, `help_discr`, `enterBy`, `enterDateTime`,`attachment_name`, `inner_brCode`, `inner_dept`, `inner_user`, `inner_remark`, `inner_get`,`entry_branch`,`entry_department`,s_type`,`scat_code_3`,`asing_by`,`ipAddress`,`defPassword`,`ssb_facility_amount`) 
                            VALUES ('".$TableID."', '".$catagory."', '".$scat_1."', '".$scat_code_2."', '5001', '6001', '7002', '".$txt_issue."', '".$txt_Description."', '".$entryUser."', now(),'".$_SESSION['fileAttachment']."','', '', '','','0','".$userBranch."','".$userDepartment."','8001','".$scat_3."','".$usrDf."','".$userIP."','','');";
               	//$v_getSQL_insert."<br/>";
                $que_getSQL_insert = mysqli_query($conn,$v_getSQL_insert) or die(mysqli_error($conn));
                $v_getSQL_insert_1 = "INSERT INTO `cdb_helpdesk_his`(`helpid`, `cat_code`, `scat_code_1`, `scat_code_2`, `cmb_code`, `ur_code`, `pr_code`, `issue`, `help_discr`, `enterBy`, `enterDateTime`,`attachment_name`, `inner_brCode`, `inner_dept`, `inner_user`, `inner_remark`, `inner_get`,`entry_branch`,`entry_department`,`s_type`,`scat_code_3`,`asing_by`,`ipAddress`,`ssb_facility_amount`)
                             VALUES ('".$TableID."', '".$catagory."', '".$scat_1."', '".$scat_code_2."', '5001', '6001', '7002', '".$txt_issue."', '".$txt_Description."', '".$entryUser."', now(),'".$_SESSION['fileAttachment']."','', '', '','','0','".$userBranch."','".$userDepartment."','8001','".$scat_3."','".$usrDf."','".$userIP."','');";
                //echo $v_getSQL_insert_1."<br/>";
                $que_getSQL_insert_1 = mysqli_query($conn,$v_getSQL_insert_1) or die(mysqli_error($conn));
            
            }
        }
     }
}

//--------------------------------------------------------------------------------------------------------
             echo "<script>alert('HelpId : ".$TableID."');</script>";
            //echo "HelpId : ".$TableID."";
           // $TableID++;
        }  
    }else{
        echo " Invalied Dtl<br/>";
        
    }      
}


function is_upload_file($conn,$TableID){
        $_SESSION['fileAttachment'] = "";
        if($_FILES["fileAttachment"]["name"] != ""){ 
            $temp = explode(".", $_FILES["fileAttachment"]["name"]);
            $extension = end($temp);
            if(($_FILES["fileAttachment"]["size"] < 12000000)){
                if($_FILES["fileAttachment"]["error"] > 0){
				    return 2;
                }else{
				   $_SESSION['fileAttachment'] = $TableID.$_FILES["fileAttachment"]["name"];
				   $sql = "SELECT `currentDate` FROM `systemdate` WHERE `index`='1'";
				   $add = mysqli_query($conn,$sql);
				   while ($rec = mysqli_fetch_array($add)){
					  $dateNow = $rec[0];
			       }  
                    if(file_exists("C:/wamp64/www/CDB/uploadHelpdesk/" .$_SESSION['fileAttachment'])){
                        //echo "<script> alert('already exists');script>";
                        return 3;
                        $_SESSION['fileAttachment']="";
					
  				   }else{
                        move_uploaded_file($_FILES["fileAttachment"]["tmp_name"],"C:/wamp64/www/CDB/uploadHelpdesk/" .$_SESSION['fileAttachment']);
                        //echo "<script> alert('Uploaded file');script>";
                        return $_SESSION['fileAttachment'];
                        
                    }
                }
            }else{
               return 1;  
            }
        }else{
            return 4;
        }
}
?>
</body>

</html>
<?php
    }
?>