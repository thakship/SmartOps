<?php
	if(!isset($_SESSION['usergroupNumber'])){
		header('Location:../../../index.php');
	}else{
		//include('../php_con/includes/db.ini.php');
		/*$add="SELECT * FROM `usergroup_module_page` WHERE `usergroupNumber`='$_SESSION[usergroupNumber]'";
		$quary = mysqli_query($conn,$add);
 		while ($rec = mysqli_fetch_array($quary)) {
			if($rec['pageCode'] != $_SESSION['page']){
				//header('Location:../../home.php');
				echo $rec['pageCode'];
			}else{
				echo "dddfd";
			}
		}*/
	}
?>