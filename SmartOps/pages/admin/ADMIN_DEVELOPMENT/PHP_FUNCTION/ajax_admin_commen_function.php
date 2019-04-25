<?php
 //.........................................Databse Connection .......................................................
function DatabaseConnection(){
    $conn = mysqli_connect("localhost","root","1234","cdberp");
    return $conn;
}

 if(isset($_REQUEST['get_UM_userGroupCode'])){
    //echo $_REQUEST['get_UM_userGroupCode'];
    loadUserGroup_Aceesss(trim($_REQUEST['get_UM_userGroupCode']));
    
 }
 if(isset($_REQUEST['get_UP_userGroupCode'])){
    //echo $_REQUEST['get_UM_userGroupCode'];
    loadModule_selectted(trim($_REQUEST['get_UP_userGroupCode']));
    
 }
 
  if(isset($_REQUEST['get_tbl_up_userGroupCode']) && isset($_REQUEST['get_tbl_up_moduleCode'])){
	//   echo "get_tbl_up_userGroupCode = ".trim($_REQUEST['get_tbl_up_userGroupCode']);
	//   echo "get_tbl_up_moduleCode = ".trim($_REQUEST['get_tbl_up_moduleCode']);
    loadPage_Access(trim($_REQUEST['get_tbl_up_userGroupCode']),trim($_REQUEST['get_tbl_up_moduleCode']));
 }

 function loadUserGroup_Aceesss($userGroupCode){
    $conn = DatabaseConnection();
	$addsql01="SELECT module.`moduleCode`, 
                      module.`moduleName`,
			          IF((SELECT 1 FROM usergroup_module WHERE usergroup_module.`usergroupNumber` = '".$userGroupCode."'  AND usergroup_module.`moduleCode`= module.`moduleCode`)  IS NULL, 'NO', 'YES')  AS ACC 
               FROM module;";
	$quary101 = mysqli_query($conn,$addsql01) or die(mysqli_error($conn));
    $num = mysqli_num_rows($quary101);
	$a = 1 ;
     echo "<table id='myTable' class='table table-striped table-bordered table-hover'>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Module Code</th>
                        <th>Module Name</th>
                        <th>Access</th>
                    </tr>
                </thead>
                <tbody>";
	 while($rec = mysqli_fetch_array($quary101)) {
	     echo "<tr>
                <td>".$a."</td>
                <td>
                    <div style='display:none;'><input type='text' name='txta".$a."' id='txta".$a."' value='".$rec[0]."'/></div>
                    ".$rec[0]."
                </td>
                <td>
                    <div style='display:none;'><input type='text' name='txtb".$a."' id='txtb".$a."' value='".$rec[1]."'/></div>
                    ".$rec[1]."
                </td>
                <td>";
                 if($rec[2] == "YES"){
        			 echo "<input type='checkbox' name='chka".$a."' id='chka".$a."' checked='checked'/>";
  			     }else{
        			 echo "<input type='checkbox' name='chka".$a."' id='chka".$a."'/>";
      			 }
                echo "</td>
            </tr>";
		 $a++;
	 }
     echo "</tbody></table>
     <div style='display:none;'><input type='text' name='txtnum' id='txtnum' value='".$num."'/></div>";
 }

function loadModule_selectted($get_UP_userGroupCode){
    //echo $get_UP_userGroupCode;
    $conn = DatabaseConnection();
    echo "<select class='form-control' name='selModuleCode' id='selModuleCode' onkeypress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)'>";
    echo "<option value=''>----Select Module Name----</option>";
    $sql_select_module = "SELECT m.moduleCode , m.moduleName 
                            FROM usergroup_module AS u , module AS m
                            WHERE u.moduleCode = m.moduleCode AND
                                  u.usergroupNumber = '".$get_UP_userGroupCode."';";
    $query_select_module = mysqli_query($conn , $sql_select_module) or die(mysqli_error($conn));
    while($rec_select_module = mysqli_fetch_array($query_select_module)){
        echo "<option value='".$rec_select_module[0]."'>".$rec_select_module[1]."</option>";
    }
    echo "</select>";
	//echo  $sql_select_module;
}

function loadPage_Access($userGroupCode,$moduleCode){
    //echo $userGroupCode." -- ".$moduleCode;
    $conn = DatabaseConnection();
    $addsql01="SELECT pages.`pageCode`,pages.`pageName`,'YES'
								FROM usergroup_module,pages,usergroup_module_page 
								WHERE usergroup_module.`moduleCode` = pages.`moduleCode`
								AND usergroup_module.`usergroupNumber`  = '".$userGroupCode."'
								AND usergroup_module.`moduleCode`  = '".$moduleCode."'
								AND usergroup_module_page.`usergroupNumber`= usergroup_module.`usergroupNumber`
								AND usergroup_module_page.`moduleCode`= usergroup_module.`moduleCode`
								AND usergroup_module_page.`pageCode`= pages.`pageCode`
								UNION
								(SELECT pages.`pageCode`,pages.`pageName`,'NO'
								FROM usergroup_module,pages
								WHERE usergroup_module.`moduleCode` = pages.`moduleCode`
								AND usergroup_module.`usergroupNumber`  = '".$userGroupCode."'
								AND usergroup_module.`moduleCode`  = '".$moduleCode."'
								AND pages.`pageCode` NOT IN
								(SELECT pages.`pageCode`
								FROM usergroup_module,pages,usergroup_module_page 
								WHERE usergroup_module.`moduleCode` = pages.`moduleCode`
								AND usergroup_module.`usergroupNumber`  = '".$userGroupCode."'
								AND usergroup_module.`moduleCode`  = '".$moduleCode."'
								AND usergroup_module_page.`usergroupNumber`= usergroup_module.`usergroupNumber`
								AND usergroup_module_page.`moduleCode`= usergroup_module.`moduleCode`
								AND usergroup_module_page.`pageCode`= pages.`pageCode`));";
	$quary101 = mysqli_query($conn,$addsql01) or die(mysqli_error($conn));
	//	echo $addsql01;
    $num = mysqli_num_rows($quary101);
	$a = 1 ;
     echo "<table id='myTable' class='table table-striped table-bordered table-hover'>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Page Code</th>
                        <th>Page Name</th>
                        <th>Access</th>
                    </tr>
                </thead>
                <tbody>";
	 while($rec = mysqli_fetch_array($quary101)) {
	     echo "<tr>
                <td>".$a."</td>
                <td>
                    <div style='display:none;'><input type='text' name='txta".$a."' id='txta".$a."' value='".$rec[0]."'/></div>
                    ".$rec[0]."
                </td>
                <td>
                    <div style='display:none;'><input type='text' name='txtb".$a."' id='txtb".$a."' value='".$rec[1]."'/></div>
                    ".$rec[1]."
                </td>
                <td>";
                 if($rec[2] == "YES"){
        			 echo "<input type='checkbox' name='chka".$a."' id='chka".$a."' checked='checked'/>";
  			     }else{
        			 echo "<input type='checkbox' name='chka".$a."' id='chka".$a."'/>";
      			 }
                echo "</td>
            </tr>";
		 $a++;
	 }
     echo "</tbody></table>
     <div style='display:none;'><input type='text' name='txtnum' id='txtnum' value='".$num."'/></div>";
    
}
?>