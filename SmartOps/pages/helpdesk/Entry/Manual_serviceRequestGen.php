<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Helpdesk
Page Name		: Service Request
Purpose			: To Request for Service
Author			: Madushan Wikramaarachchi
Date & Time		: 10.36 A.M 24/12/2014
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="hel/e/058";
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
    include('../helpdesk_DEVELOPMENT/PHP_FUNCTION/helpdesk_php_function.php');
	//include('ajax_Gried.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Service Request</title>
<!-- Common function Libariries -->
<!-- CSS-->
    <link rel="stylesheet" type="text/css" href="../../../CSS/globleCSS.css"/>
    <link rel="stylesheet" type="text/css" href="../helpdesk_DEVELOPMENT/CSS/helpdesk_Style_Sheet.css"/>
<!--Javascript-->
<script src="../../../js/commenfunction.js"></script>
<script src="../helpdesk_DEVELOPMENT/JAVASCRIPT_FUNCTION/helpdesk_js_function.js"></script>
<!--END Common fumction Libariries-->
<style type="text/css">
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
		height:275px;
		overflow-y: scroll;
		border:#000000 solid 1px;
	}
</style>
<link rel="stylesheet" href="jquery/jquery-ui.css" />
<script src=" jquery/jquery-1.9.1.js"></script>
<script src="jquery/jquery-ui.js"></script>
<script type="text/javascript">
function pageClose(){ //Page Close Function.......
	parent.location.href = parent.location.href;
}

    
</script>

</head>
<body oncontextmenu="return false" onsubmit="return chak()">
<form action="" method="post" name="schform" enctype="multipart/form-data"> 
<p class="topline">
<?php 
	echo $_REQUEST['DispName'];
?>
</p><hr/>

<table>
  <tr>
    <td style="width: 100px; text-align: right;"><label class="linetop">Category :</label></td>
    <td>
         <select class="box_decaretion"  style="width: 200px;" name="sel_catagory" id="sel_catagory" onkeypress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" title="1" onchange="is_getScat_01(this.id,title);">
            <option value="">--Select Category --</option>
            <?php
              
                //$v_sql_getCategory = "select s.V_number , s.Dep_name from servicereq_gen_manual AS s WHERE s.status = 1;";
            $v_sql_getCategory ="select sg.V_number , sg.Dep_name
                                    from servicereq_gen_manual AS sg , servicereq_gen_manual_acc AS se
                                    WHERE sg.V_number = se.V_number
                                       and sg.`status` = 1
                                       and se.usergroup = '".$_SESSION['usergroupNumber']."';";
                $que_getCategory = mysqli_query($conn,$v_sql_getCategory);
                while($RES_getCategory = mysqli_fetch_array($que_getCategory)){
                    echo "<option value=".$RES_getCategory[0].">".$RES_getCategory[1]."</option>";
                }
            ?>
         </select>
    </td>
  

  
  </tr>
</table>

<table>
    <tr>
    <td style="width: 100px; text-align: right;"><label class="linetop">Enterd User :</label></td>
    <td>
        <input class="box_decaretion" type="text"  style="width:200px; color: #747474; background: #D3D3D3;" name="txt_User" id="txt_User" value="<?php echo $_SESSION['user']; ?>" onKeyPress="return disableEnterKey(event)" readonly="readonly"/>
    </td>
  </tr>
  <tr>
    <td style="width: 100px; text-align: right;"><label class="linetop">Attachment :</label></td>
    <td>
       <input class="buttonManage" type="file" name="fileAttachment" id="fileAttachment" />
    </td>
  </tr>
</table>
<table>
  

</table>
</div>
<br />
<table>
     <tr>
        <td style="width: 100px;">&nbsp;</td>
        <td>
            <input type="submit" style="width: 100px;" class="buttonManage" id="btnSave" name="btnSave" value="Upload" />
            <input type="button" style="width: 100px;" class="buttonManage" id="btnClose" name="btnClose" value="Close" onclick="pageClose()"/>
        </td>
     </tr>
</table>

<?php

if(isset($_POST['btnSave']) && $_POST['btnSave']=='Upload'){
    //echo "A";
        //$ok = true;
        $file = $_FILES['fileAttachment']['tmp_name'];
        $fileType = $_FILES['fileAttachment']['type'];
        ///echo $fileType;
        $mimes = array('application/vnd.ms-excel','text/plain','text/csv','text/tsv');

    $temp = explode(".", $_FILES["fileAttachment"]["name"]);
    $extension = end($temp);

    //echo $extension;

        //if(in_array($_FILES['fileAttachment']['type'],$mimes)){
    if($extension == "csv"){
          // do something
          $err = 0;
                    if ($file == NULL){
                      //error(_('Please select a file to import'));
                      // redirect(page_link_to('admin_export'));
                        echo "Please select a file to import";
                    }else if ($_POST['sel_catagory'] == ""){
                        echo "Select Category.";
                    }else{
                        //$TableID = 1;
                        $handle = fopen($file, "r");
                        $x = 1;
                        while(($filesop = fgetcsv($handle, 1000, ",")) !== false){ // S - While 1
                            //echo sizeof($filesop);
                            if(sizeof($filesop) == 6){ // Array IF
                          
                            
                            $scat_2 = $filesop[0]; 
                            $scat_3 = $filesop[1];
                            $iss = $filesop[2];
                            $iss_dis = $filesop[3];
                            $facilityAmount = $filesop[4];
                            $entryOn = $filesop[5];
                                          //echo $cat_2."<br/>";
                            
                            $select_servicereq_gen_manual = "select s.cat_code, s.scat_code_1 
                                                               from servicereq_gen_manual AS s 
                                                              WHERE s.V_number = ".trim($_POST['sel_catagory']);
                            $qury_servicereq_gen_manual = mysqli_query($conn,$select_servicereq_gen_manual) or mysqli_error($conn);

                            while($rec_servicereq_gen_manual = mysqli_fetch_assoc($qury_servicereq_gen_manual)){ // S - While 2


                                $catagory = $rec_servicereq_gen_manual['cat_code'];
                                $scat_1 = $rec_servicereq_gen_manual['scat_code_1'];

                                $validateCount = 0;

                                $sql_Auth_Very = "SELECT `auth_verified`,`scat_code_2`,`DefuserID` 
                                                    FROM `scat_02` 
                                                   WHERE `cat_code` = '".$catagory."' 
                                                     AND  `scat_code_1` = '".$scat_1."' 
                                                     AND `scat_discr_2` = '".$scat_2."';";
                                $query_Auth_Very = mysqli_query($conn ,$sql_Auth_Very) or die(mysqli_error($conn));
                                //echo $sql_Auth_Very;

                                $rowcount = mysqli_num_rows($query_Auth_Very);

                                $scat_code_3 = "";

                                if(trim($_POST['sel_catagory']) == 3){
                                    // ----- 2018-10-15 --- By Madushan----------------------------------------- 
                                    // This user For Onliy Patpat request genarete. .................................
                                    // Mareting officer code has not in scat 3 .
                                    $scat_code_3 = $scat_3;
                                }else{

                                    $s3 = "SELECT s.scat_code_3 
                                             FROM scat_03  AS s 
                                            WHERE s.scat_discr_3 = '".$scat_3."' 
                                              AND s.scat_state_3 = 1;";
                                    $q3 = mysqli_query($conn ,$s3) or die(mysqli_error($conn));
                                    while($r3 = mysqli_fetch_array($q3)){
                                        $scat_code_3 = $r3[0];
                                    }
                                }
                                
                                
                                if($rowcount != 0){
                                    // ---- Create Table ID ---------------------------------------
                                    $Current_Year = date("Y" , strtotime($_SESSION['CURRENT_DATE']));
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
                                        $scat_code_2 = $rec_Auth_Very[1];
                                        $usrDf = $rec_Auth_Very[2];
                                        if($entryOn == ""){
                                            $entryOn = date("Y-m-d H:i:s");
                                        }
                                        
                                        if($rec_Auth_Very[0] == 1){
                                            $validateCount = 1;
                                            
                                            $v_getSQL_insert = "INSERT INTO `cdb_helpdesk`(`helpid`, `cat_code`, `scat_code_1`, `scat_code_2`, `cmb_code`, `ur_code`, `pr_code`, `issue`, `help_discr`, `enterBy`, `enterDateTime`,`attachment_name`, `inner_brCode`, `inner_dept`, `inner_user`, `inner_remark`, `inner_get`,`entry_branch`,`entry_department`,`s_type`,`scat_code_3`,`asing_by`,`ipAddress`,`defPassword`,`ssb_facility_amount`,`init_enrty_by`,`init_enrty_on`,`branch_auth_by`,`branch_auth_on`) 
                                                                                   VALUES ('".$TableID."', '".$catagory."', '".$scat_1."', '".$scat_code_2."', '5000', '6001', '7001', '".$txt_issue."', '".$txt_Description."', '".$_SESSION['user']."', '".$entryOn."','','', '', '','','0','".$_SESSION['userBranch']."','".$_SESSION['userDepartment']."','8001','".$scat_code_3."','".$usrDf."','".$_SESSION['userIP']."','','".$facilityAmount."','".$_SESSION['user']."','".$entryOn."','','0000-00-00 00:00:00');";
                                            	//echo $v_getSQL_insert."<br/>";
            							    $que_getSQL_insert = mysqli_query($conn,$v_getSQL_insert) or die(mysqli_error($conn));
            								$v_getSQL_insert_1 = "INSERT INTO `cdb_helpdesk_his`(`helpid`, `cat_code`, `scat_code_1`, `scat_code_2`, `cmb_code`, `ur_code`, `pr_code`, `issue`, `help_discr`, `enterBy`, `enterDateTime`,`attachment_name`, `inner_brCode`, `inner_dept`, `inner_user`, `inner_remark`, `inner_get`,`entry_branch`,`entry_department`,`s_type`,`scat_code_3`,`asing_by`,`ipAddress`,`ssb_facility_amount`,`init_enrty_by`,`init_enrty_on`,`branch_auth_by`,`branch_auth_on`)
                                                                    VALUES ('".$TableID."', '".$catagory."', '".$scat_1."', '".$scat_code_2."', '5000', '6001', '7001', '".$txt_issue."', '".$txt_Description."', '".$_SESSION['user']."', '".$entryOn."','','', '', '','','0','".$_SESSION['userBranch']."','".$_SESSION['userDepartment']."','8001','".$scat_code_3."','".$usrDf."','".$_SESSION['userIP']."','".$facilityAmount."','".$_SESSION['user']."','".$entryOn."','','0000-00-00 00:00:00');";
            								//echo $v_getSQL_insert_1."<br/>";
            							   $que_getSQL_insert_1 = mysqli_query($conn,$v_getSQL_insert_1) or die(mysqli_error($conn));	
                                            
                
                                        }else{
                                            $validateCount = 0;
                                            $v_getSQL_insert = "INSERT INTO `cdb_helpdesk`(`helpid`, `cat_code`, `scat_code_1`, `scat_code_2`, `cmb_code`, `ur_code`, `pr_code`, `issue`, `help_discr`, `enterBy`, `enterDateTime`,`attachment_name`, `inner_brCode`, `inner_dept`, `inner_user`, `inner_remark`, `inner_get`,`entry_branch`,`entry_department`,`s_type`,`scat_code_3`,`asing_by`,`ipAddress`,`defPassword`,`ssb_facility_amount`) 
                                                        VALUES ('".$TableID."', '".$catagory."', '".$scat_1."', '".$scat_code_2."', '5001', '6001', '7001', '".$txt_issue."', '".$txt_Description."', '".$_SESSION['user']."', '".$entryOn."','','', '', '','','0','".$_SESSION['userBranch']."','".$_SESSION['userDepartment']."','8001','".$scat_code_3."','".$usrDf."','".$_SESSION['userIP']."','','".$facilityAmount."');";
                                           	//$v_getSQL_insert."<br/>";
                                            $que_getSQL_insert = mysqli_query($conn,$v_getSQL_insert) or die(mysqli_error($conn));
                                            $v_getSQL_insert_1 = "INSERT INTO `cdb_helpdesk_his`(`helpid`, `cat_code`, `scat_code_1`, `scat_code_2`, `cmb_code`, `ur_code`, `pr_code`, `issue`, `help_discr`, `enterBy`, `enterDateTime`,`attachment_name`, `inner_brCode`, `inner_dept`, `inner_user`, `inner_remark`, `inner_get`,`entry_branch`,`entry_department`,`s_type`,`scat_code_3`,`asing_by`,`ipAddress`,`ssb_facility_amount`)
                                                         VALUES ('".$TableID."', '".$catagory."', '".$scat_1."', '".$scat_code_2."', '5001', '6001', '7001', '".$txt_issue."', '".$txt_Description."', '".$_SESSION['user']."', '".$entryOn."','','', '', '','','0','".$_SESSION['userBranch']."','".$_SESSION['userDepartment']."','8001','".$scat_code_3."','".$usrDf."','".$_SESSION['userIP']."','".$facilityAmount."');";
                                            //echo $v_getSQL_insert_1."<br/>";
                                            $que_getSQL_insert_1 = mysqli_query($conn,$v_getSQL_insert_1) or die(mysqli_error($conn));
                                        
                                        }
                                        echo "HelpId : ".$TableID."<br/>";
                                       // $TableID++;
                                    }  
                                }else{
                                    echo " Missing details in category 2 field in CSV file  : ".$scat_2." Row Number ".$x."<br/>";
                                    
                                }      
                                $x++;             
                            }// end While 2
                            
                            }else{
                                $err = 1;
                                    
                            } // End Array IF
                        } // While End 1
                               
                    }
                    if($err == 1){
                        echo "Array Out Of Bounds Error.";
                    }
                    
       } else {
          die("CSV file only allowed to upload");
        }
        
}
?>

<!-- ****************************************************************************************************************************************************** -->
<span id="getGried"></span>
<?php
	//serviceRequsestMaual_Gried_POPUP_1($conn);
?>
</form>
</body>
</html>

