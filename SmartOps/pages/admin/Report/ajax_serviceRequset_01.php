<?php
    $v_catID = $_REQUEST['txt1'];
    $v_Select_ID = $_REQUEST['txt2'];
    include('../../../php_con/includes/db.ini.php');
        //$v_sql_selection = "SELECT `scat_code_1`,`scat_discr_1` FROM `scat_01` WHERE `cat_code` = '".$v_catID."' AND `scat_state_1` = 1;";
        $v_sql_selection = "select r.reportid ,
                                   r.reportdescription , 
                                   r.showBranch , 
                                   r.showDates , 
                                   r.excelEnabled, 
                                   r.columntoken, 
                                   r.F1_LABEL , 
                                   r.SelectionType , 
                                   r.SelectionTypeLbl
								 from reportgen AS r 
								 WHERE r.IsDisable = 0 and r.moduleCode = '".$v_catID."' AND r.reportid in (select reportid from reportgen_access where reportgen_access.usergroupNumber = '".$v_Select_ID."');";
       // echo $v_sql_selection;
        $v_selctTag = "<select style='width:286px;' class='box_decaretion' name='selReportType' id='selReportType' onkeypress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' onchange='getReportAuthendicetion();'><option value=''>-- Select Report Type --</option><strong></strong>";
    
    echo $v_selctTag;
    $que_selection = mysqli_query($conn,$v_sql_selection);
    while($rec1 = mysqli_fetch_array($que_selection)){
        echo "<option value='".$rec1[0]."@".$rec1[2]."@".$rec1[3]."@".$rec1[4]."@".$rec1[5]."@".$rec1[6]."@".$rec1[7]."@".$rec1[8]."'>".$rec1[1]."</option>";
    }  
?>
</select>