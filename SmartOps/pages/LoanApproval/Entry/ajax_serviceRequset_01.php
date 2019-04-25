<?php
    $v_catID = $_REQUEST['txt1'];
    $v_Select_ID = $_REQUEST['txt2'];
    include('../../../php_con/includes/db.ini.php');
    if($v_Select_ID == 1){
        $v_sql_selection = "SELECT `scat_code_1`,`scat_discr_1` FROM `scat_01` WHERE `cat_code` = '".$v_catID."' AND `scat_state_1` = 1;";
        $v_selctTag = "<select class='box_decaretion'  style='width: 200px;' name='sel_scat01' id='sel_scat01' onKeyPress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' title='2' onchange='is_getScat_01(this.id,title);'><option value=''>--Select Sub Catagory 1--</option>";
    }
    if($v_Select_ID == 2){
        $v_sql_selection = "SELECT `scat_code_2`,`scat_discr_2` FROM `scat_02` WHERE `scat_code_1`='".$v_catID."' AND `scat_state_2` = '1';";
        $v_selctTag = "<select class='box_decaretion'  style='width: 200px;' name='sel_scat02' id='sel_scat02' onKeyPress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' title='4' onblur='colourLeave(this.id)' onchange='is_getScat_01(this.id,title);'><option value=''>--Select Sub Catagory 2--</option>";
    }
    if($v_Select_ID == 3){
        $v_sql_selection = "SELECT `deparmentNumber`,`deparmentName` FROM `deparment` WHERE `branchNumber` = '".$v_catID."'";
        $v_selctTag = "<select class='box_decaretion' name='txt_Department' id='txt_Department' onKeyPress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)'><option value=''>--Select Sub Catagory 1--</option>";
    }
    if($v_Select_ID == 4){
        $v_sql_selection = "SELECT `scat_code_3`,`scat_discr_3` FROM `scat_03` WHERE `scat_code_2`='".$v_catID."' AND `scat_state_3` = '1';";
        $v_selctTag = "<select class='box_decaretion'  style='width: 200px;' name='sel_scat03' id='sel_scat03' onKeyPress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)'><option value=''>--Select Sub Catagory 3--</option>";
    }
?>
<?php
    echo $v_selctTag;
    $que_selection = mysqli_query($conn,$v_sql_selection);
    while($RES_getSelection = mysqli_fetch_array($que_selection)){
        echo "<option value=".$RES_getSelection[0].">".$RES_getSelection[1]."</option>";
    }  
?>
</select>