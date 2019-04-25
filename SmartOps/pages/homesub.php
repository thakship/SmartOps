<?php
session_start();
if(!isset($_SESSION['user']))
{
	header('Location:../indexsub.php');	
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="icon" href="../img/lg_coc.png" type="image/x-icon" />
<title>CDB SmartOps SYSTEM</title>
<link href="../CSS/home.css" type="text/css" rel="stylesheet"/>
<link href="../CSS/manu.css" type="text/css" rel="stylesheet"/>
<script type="text/javascript" src="simpletreemenu.js">

/***********************************************
* Simple Tree Menu- © Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
***********************************************/

</script>
<script type="text/javascript">
	document.onmousedown=disableclick;
	status="Right Click Disabled";
	Function disableclick(e)
	{
	  if(event.button==2)
	   {
		 alert(status);
		 return true;	
	   }
	}
	function disableEnterKey(e){
		 var key;      
		 if(window.event)
			  key = window.event.keyCode; //IE
		 else
			  key = e.which; //firefox      
		 return (key != 13);
	}
	
</script>
<link rel="stylesheet" type="text/css" href="simpletree.css" />
</head>
<body oncontextmenu="return false">
	<div id="maneWape">
 	<div id="maneHead">
      <div id="logo">
      	<img src="../img/cdb_logo.gif" style="margin-left:60px; margin-top:5px; width:120px; height:50px;"/>
      </div>
      <div id="heading">
      	<div id="subHeading1">
        <br/>
        	<h1 class="head">CDB SmartOps SYSTEM</h1>
            <?php
				include('../php_con/includes/db.ini.php');
				$v_sql_uGroup ="SELECT `usergroupName` FROM `usergroup` WHERE `usergroupNumber` = '".$_SESSION['usergroupNumber']."'";
				$addv_sql_uGroup = mysqli_query($conn,$v_sql_uGroup);
				while ($recaddv_sql_uGroup = mysqli_fetch_assoc($addv_sql_uGroup)){
					$user_group_Enter_user = $recaddv_sql_uGroup['usergroupName'];
				}
			?>
        	<h1 class="head1">User ID : <?php echo $_SESSION['user']."-".$user_group_Enter_user; ?></h1>
            <h1 style="text-align: right; margin-right:5px; font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight: bold;">Branch : <?php 
			                                            $sqlBranch = "SELECT `branchName` FROM `branch` WHERE `branchNumber`= '$_SESSION[userBranch]'";
														$addBranch = mysqli_query($conn,$sqlBranch);
														while ($rec1 = mysqli_fetch_array($addBranch)){
															$BranchName = $rec1[0];
														}
														echo $BranchName;
                                                        $_SESSION['USERBRANCHNAME'] =$BranchName; 
                                                        ?></h1>
        </div>
        <div id="subHeading2">
         <h1 style="text-align: right; margin-right:5px;">Date : <?php 
																	$sql = "SELECT `currentDate` FROM `systemdate` WHERE `index`='1'";
																	$add = mysqli_query($conn,$sql);
																	while ($rec = mysqli_fetch_array($add)){
																		$dateNow = $rec[0];
																		
																	}
																	echo $dateNow;
																	$_SESSION['CURRENT_DATE'] = $dateNow;
																	if(isset($_SESSION['user']))
																		{
																			echo "<a href=../logoutsub.php class=line2>logout</a>"; 
																		}
																  ?>
          </h1>
        </div>
      </div>
    </div>
    <div class="line1">
    
    </div>
    <div id="maneBody" style="height:520px;">
    	<div id="subBody1" style="height:520px;overflow-y: scroll;">
        <br/><br/>
				<ul id="treemenu1" class="treeview">
				<?php
                	include('../php_con/includes/db.ini.php');
                    $usergroupNumber =$_SESSION['usergroupNumber'];
                    $sql1 = "SELECT DISTINCT (module.`moduleCode`), module.`moduleName`,module.`IconName`
                                FROM usergroup_module, module 
                                WHERE
                                module.`moduleCode`=usergroup_module.`moduleCode`
                                AND usergroup_module.`usergroupNumber` = '$_SESSION[usergroupNumber]' 
                                order by usergroup_module.`moduleCode`";
                    $quary1=mysqli_query($conn,$sql1);
                    //echo   "<ul>";
                    $a = 0;
                    while($recod1 = mysqli_fetch_array($quary1)){
                        //echo $recod1[0];
                        $a++;
                        echo "<li style='background-image:url(../img/".$recod1[2].");'>".$recod1[1];
                    
                            $sql2="SELECT distinct(pages.`pageType`) 
                                    FROM pages,usergroup_module_page
                                    WHERE usergroup_module_page.`moduleCode` = '$recod1[0]'
                                    AND pages.`moduleCode`=usergroup_module_page.`moduleCode`
                                    AND pages.`pageCode`= usergroup_module_page.`pageCode`
                                    AND usergroup_module_page.`usergroupNumber` = '$usergroupNumber'
                                    order by pages.`moduleCode`,pages.`pageType`";
                            $quary2 = mysqli_query($conn,$sql2);
                            //echo $sql2;
                            echo "<ul>";
                            while($recod2 = mysqli_fetch_array($quary2)){
                                echo "<li>".$recod2[0];
                                $sql3="SELECT pages.`pageCode`, pages.`pagePath`, pages.`pageName`
                                        FROM usergroup_module_page, pages
                                        WHERE usergroup_module_page.usergroupNumber = '$usergroupNumber'
                                        AND usergroup_module_page.moduleCode ='$recod1[0]'
                                        AND pages.pageType ='$recod2[0]'
                                        AND pages.`moduleCode`=usergroup_module_page.`moduleCode`
                                        AND pages.`pageCode`= usergroup_module_page.`pageCode`
                                        order by pages.`moduleCode`,pages.`pageType`";
                                $quary3=mysqli_query($conn,$sql3);
                                
                                
                                echo "<ul>";
                                $x = 1;
                                while($recod3 = mysqli_fetch_array($quary3)){
								
                                    $_SESSION['pageacc'.$x] = $recod3[0];
                                    $x++;
                                    echo "<li><a style='text-decoration:none;' href='".$recod3[1]."?DispName=".$recod3[2]."' target='conectpage'><label onclick='bodyViwe$x()'>".$recod3[2];
                                    echo "</label></a></li>";
					echo "<script>
						function bodyViwe$x(){
	 					document.getElementById('conectpage').style.display = '';
						document.getElementById('conectpage1').style.display = 'none';
							//alert('status');
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
			<script type="text/javascript">
            //ddtreemenu.createTree(treeid, enablepersist, opt_persist_in_days (default is 1))
            ddtreemenu.createTree("treemenu1", true)
            ddtreemenu.createTree("treemenu2", false)
            </script>
            </ul>
        </div>
    	<div id="subBody2" style="height:520px;"  oncontextmenu="return false">
        	<iframe name="conectpage1" id="conectpage1" style=" background-image: url(../img/erpbody.jpg);background-repeat:no-repeat; background-color:#FFFFFF;" width="100%" height="100%">
            
            </iframe>
			<iframe name="conectpage" id="conectpage" style='display:none;' width="100%" height="100%">
            
            </iframe>
        </div>
    </div>
    <div id="footer">
    
    </div>
 </div>
</body>
</html>