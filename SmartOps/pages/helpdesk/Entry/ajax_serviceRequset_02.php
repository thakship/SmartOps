<?php

include('../../../php_con/includes/db.ini.php'); // DB Connection .....

if(isset($_REQUEST['getSel_scat02'])){
    getTextAreaDiscription($conn,$_REQUEST['getSel_scat02']);
}

if(isset($_REQUEST['getScat03_Sub'])){
    getScat03_subValue($conn,$_REQUEST['getScat03_Sub']);
}

function getScat03_subValue($conn,$Scat03){
    //echo "OK ".$Scat03;
    $sql = "SELECT s.SheetRateInt,
                   s.MinIntRate
            from scat_03 AS s 
            where s.scat_code_3 = ".$Scat03.";";
    $query = mysqli_query($conn,$sql) or die(mysqli_error($conn));
    while($rec = mysqli_fetch_array($query)){
        echo $rec[0]."|".$rec[1];
    }
}

function getTextAreaDiscription($conn,$scat02){
    //echo $scat02;
    $VRWO = "<textarea class='box_decaretion' cols='47' rows='4' style='height:100px; width: 400px;' name='txt_Description' id='txt_Description' onkeypress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' required='required'>
Asset	: 
Make 	: 
Model	: 
Reg no	: 
         </textarea>";
          
    $SQL = "SELECT s2.templet_issue
                FROM scat_02 AS s2
                where s2.templet_issue <> '' and s2.scat_code_2 = '".$scat02."' limit 1;";
    //echo $SQL;
    $QUERY = mysqli_query($conn,$SQL) or die(mysqli_error($conn));
    $q = mysqli_num_rows($QUERY);
    //echo $q; 
    while($resalt = mysqli_fetch_array($QUERY)){
                $VRWO =  "<textarea class='box_decaretion' cols='47' rows='4' style='height:100px; width: 400px;' name='txt_Description' id='txt_Description' onkeypress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' required='required'>".$resalt[0]."</textarea>";
    }   
    echo $VRWO;
  
}

?>