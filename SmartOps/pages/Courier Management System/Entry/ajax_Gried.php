<?php
function DatabaseConnection(){
    $conn = mysqli_connect("localhost","root","1234","cdberp");
    return $conn;
}
if(isset($_REQUEST['sr_gried'])){
        getDocument_Gried_POPUP_1($_REQUEST['sr_gried']);
}
if(isset($_REQUEST['self_fileNumber'])){
        getDocument_Gried_POPUP_selfAck($_REQUEST['self_fileNumber']);
}



function getDocument_Gried_POPUP_1($getString){
    $conn = DatabaseConnection();
    $arr_file = explode("|",$getString);
    $fileNumber = $arr_file[0];
    $griedCou = $arr_file[1];
    
    
    echo "<div id='outer'></div>";
    echo "<div id='conten'>";
    //echo "<div style='width: 100%; height: 30px;'><img src='../../../img/Close-Button.png' onclick='popdown();' /></div>";
    echo "<div style='width: 100%;'>";
    
    echo "
    <br/>
    <input class='buttonManage' style='width:100px;margin-left: 50px;height: 30px;' type='button' title='".$fileNumber."|".$griedCou."' value='Submit' onclick='submitFile(title);' />
    <input class='buttonManage' style='width:100px;margin-left: 5px;height: 30px;' type='button' value='Close' onclick='popdown();' />
    <br/>
    <hr/>
    <table class='tbl1' border='1'>
                <tr>
                    <td style='text-align:center; padding-top:5px; padding-bottom:5; width:200px;'>Doc Number</td>
                    <td style='text-align:center; padding-top:5px; padding-bottom:5;width:200px;'>Doc Name</td>
                    <td style='text-align:center; padding-top:5px; padding-bottom:5;width:50px;'>#</td>
                    <td style='text-align:center; padding-top:5px; padding-bottom:5;width:200px;'>#</td>
                  </tr>";
   	$subselect = "SELECT `subdoc` FROM `courier_files` WHERE `fileNumber`='".$fileNumber."'";
	$sqlsubselct = mysqli_query($conn,$subselect);
	while($chekSts = mysqli_fetch_array($sqlsubselct)){
        if($chekSts[0] == "NO"){
		  $sqldocment = "SELECT c.documentNumber , c.documentName
                        FROM courier_document as c
                        WHERE c.fileNumber = '".$fileNumber."';";
		  
        }else{
          $sqldocment = "SELECT c.subDocumentNumber , c.subDocumentName
                        FROM courier_document_sub as c
                        WHERE c.fileNumber = '".$fileNumber."';";
        }
        $queDocument = mysqli_query($conn,$sqldocment);
        $row = 1 ;
        while ($recDocument = mysqli_fetch_array($queDocument)){
                echo "<tr style='background-color:#FFFFFF;'>";
                echo "<td style='width:200px;'>
                      <input style='width:200px;' type='text' name='txt1".$row."' id='txt1".$row."' value='".$recDocument[0]."' readonly='readonly'/></td>";
                echo "<td style='width:200px;'>
                      <input style='width:200px;' type='text' name='txt2".$row."' id='txt2".$row."' value='".$recDocument[1]."' readonly='readonly'/></td>";
                echo "<td style='width:50px;'>";
                echo " <input type='checkbox' name='chkDoc".$row."' id='chkDoc".$row."' title='".$row."' onclick='isCheckBox(title);' />";
                echo "</td>";
                echo "<td style='width:200px;'>
                      <input style='width:200px;' type='text' name='txt3".$row."' id='txt3".$row."' value=''/>
                      </td>";
                echo "</tr>";
                $row++;
        }
    }
        
     
echo "</table>
<div style='display:none;'>
    <input type='text' name='txtrow' id='txtrow' value='".$row."'/>";
$sql_select_file_dtl =  "SELECT * FROM `courier_files` WHERE `fileNumber` = '".$fileNumber."';";
$que_select_file_dtl = mysqli_query($conn,$sql_select_file_dtl);
while($rec_select_file_dtl = mysqli_fetch_assoc($que_select_file_dtl)){
    echo "<input type='text' name='sendBranch' id='sendBranch' value='".$rec_select_file_dtl['branchNumber']."'/>";
    echo "<input type='text' name='sendDepartment' id='sendDepartment' value='".$rec_select_file_dtl['departmentNumber']."'/>";
    echo "<input type='text' name='fileType' id='fileType' value='".$rec_select_file_dtl['fileType']."'/>";
} 
echo "</div>
<br/>
</div>";
}



function getDocument_Gried_POPUP_selfAck($self_fileNumber){
    $conn = DatabaseConnection();
    
    echo "<div id='outer'></div>";
    echo "<div id='conten'>";
    echo "<div style='width: 100%; height: 30px;'><img src='../../../img/Close-Button.png' onclick='popdown();' /></div>";
    echo "<div style='width: 100%;'>";
    
    echo "
    <br/>
    <table border='1' cellpadding='0' cellspacing='0' style='background:#FFFFFF; font-family:Arial, Helvetica, sans-serif; font-size:12px;'>
                <tr style='background-color: #BEBABA;'>
                    <td style='text-align:center; width:100px;'>Doc Number</td>
                    <td style='text-align:center; width:350px;'>Doc Name</td>
                  </tr>";
   	$subselect = "SELECT `subdoc` FROM `courier_files` WHERE `fileNumber`='".$self_fileNumber."'";
	$sqlsubselct = mysqli_query($conn,$subselect);
	while($chekSts = mysqli_fetch_array($sqlsubselct)){
        if($chekSts[0] == "NO"){
		  $sqldocment = "SELECT c.documentNumber , c.documentName
                        FROM courier_document as c
                        WHERE c.fileNumber = '".$self_fileNumber."';";
		  
        }else{
          $sqldocment = "SELECT c.subDocumentNumber , c.subDocumentName
                        FROM courier_document_sub as c
                        WHERE c.fileNumber = '".$self_fileNumber."';";
        }
        $queDocument = mysqli_query($conn,$sqldocment);
        $row = 1 ;
        while ($recDocument = mysqli_fetch_array($queDocument)){
                echo "<tr>";
                echo "<td style='width:100px;padding-left: 10px;'>
                      ".$recDocument[0]."</td>";
                echo "<td style='width:350px;padding-left: 10px;'>
                      ".$recDocument[1]."</td>";
                echo "</tr>";
                $row++;
        }
    }
        
     
    echo "</table>
    <br/>
    </div>
    </div>";
}
?>