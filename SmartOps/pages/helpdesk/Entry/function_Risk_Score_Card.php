<?php

include('../../../php_con/includes/db.ini.php');

if(isset($_REQUEST['isgetData']) && isset($_REQUEST['isget_status'])){
    getSelectComponants($conn,$_REQUEST['isgetData'],$_REQUEST['isget_status']);
}

function  getSelectComponants($conn,$isgetData,$isget_status){
    $sql = "";
    if($isget_status == "Facilitiy"){
        $sql = "select cc.risk_attrib_descr,cc.risk_attrib_value from cdb_risk_params  cc where cc.risk_attrib_code = 'PRODLOOKUP' and cc.risk_attrib_subcode = '".$isgetData."' and cc.risk_attrib_disable = 0;";
        echo "<select class='box_decaretion' name='sel_Type_of_Facility' id='sel_Type_of_Facility' onkeypress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' onchange='getRiskRating(this.id)' >
                <option value='0'>-- Select Type of Facility --</option>";
    }else if ($isget_status == "Customer"){
        $sql = "select cc.risk_attrib_descr,cc.risk_attrib_value from cdb_risk_params  cc where cc.risk_attrib_code = 'CUSTCAT' and cc.risk_attrib_subcode = '".$isgetData."'  and cc.risk_attrib_disable = 0;"; 
        echo "<select class='box_decaretion' name='sel_Customer_Category' id='sel_Customer_Category' onkeypress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)'  onchange='getRiskRating(this.id)'>
              <option value='0'>-- Select Customer Category --</option>";
    }else if ($isget_status == "AI"){
        $sql = "select cc.risk_attrib_descr,cc.risk_attrib_value from cdb_risk_params  cc where cc.risk_attrib_code = 'Revenue-Income' and cc.risk_attrib_subcode = '".$isgetData."' and cc.risk_attrib_disable = 0;";
        echo " <select class='box_decaretion' name='sel_Anticipated_Investment' id='sel_Anticipated_Investment' onkeypress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)'  onchange='getRiskRating(this.id)'>
              <option value='0'>-- Select Anticipated Investment --</option>";
    }else{
        $sql = "";
    }
    
    if($sql != ""){
        $query = mysqli_query($conn,$sql) or die(mysqli_error($conn));
          
        while($resalt = mysqli_fetch_array($query)){
             echo "<option value=".$resalt[1].">".$resalt[0]."</option>";
        }
        echo "</select>";
       
    }
}
?>