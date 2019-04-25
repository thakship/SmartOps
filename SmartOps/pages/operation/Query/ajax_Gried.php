<?php
function DatabaseConnection(){
    $conn = mysqli_connect("localhost","root","1234","cdberp");
    return $conn;
}
if(isset($_REQUEST['sr_gried']) && isset($_REQUEST['userBranch'])){
        //serviceRequsestMaual_Gried_POPUP_1($_REQUEST['sr_gried']);
        serviceRequsestMaual_Gried_POPUP_1user($_REQUEST['userBranch']);
}

function serviceRequsestMaual_Gried_POPUP_1($helpID){
    $conn = DatabaseConnection();
    echo "<div id='outer'></div>";
    echo "<div id='conten'>";
    echo "<div style='width: 100%; height: 30px;'>
            <input type='button' class='buttonManage' style='width:100px; margin-top: 5px; margin-left: 5px;' name='btnColse' id='btnColse' value='Close' onclick='popup(0);' />
            <input type='button' class='buttonManage' style='width:100px; margin-top: 5px; margin-left: 5px;' name='btnPrint' id='btnprint' value='Print' onclick='isPrint();' />
            </div><hr/><br/>";
    
    echo "<div style='width: 100%;' id='viewsl_gried'>";
	$viewDoc = "SELECT ch.issue, 
					   ch.help_discr, 
					   ch.resulution, 
					   ch.solution, 
					   ch.solved_by, 
					   ch.solved_on, 
					   ch.cat_code,
					   ch.enterBy,
					   us.userID,
					   ch.enterDateTime,
					   ch.entry_branch,
					   br.branchName,
					   ch.entry_department,
					   de.deparmentName,
					   s1.scat_discr_1,
					   s2.scat_discr_2 ,
					   ch.scat_code_2 ,
					   ch.decision_discription
				FROM cdb_helpdesk AS ch , user AS us , branch AS br , deparment AS de , scat_01 AS s1 , scat_02 AS s2
				WHERE ch.enterBy = us.userName AND 
					  ch.scat_code_1 = s1.scat_code_1 AND 
					  ch.scat_code_2 = s2.scat_code_2 AND
							ch.entry_branch = br.branchNumber AND
							ch.entry_department = de.deparmentNumber AND
							ch.helpid =  '".$helpID."'";
            
	$sql_viewDoc = mysqli_query($conn,$viewDoc);
	$Rowsnos =  50;
	$Rowsnos2 =  50;
	$Rowsnos3 =  50;
	while ($add = mysqli_fetch_array($sql_viewDoc)){
		$viewDoc1 = "SELECT `userID` FROM `user` WHERE `userName` = '".$add[4]."'";
		$sql_viewDoc1 = mysqli_query($conn,$viewDoc1);
		$user = '-';
		while($add1 = mysqli_fetch_array($sql_viewDoc1)){
			$user = $add1[0];
		}
		$colsnos =  round ((strlen($add[1]) + 1) / 40,0);
		$Rowsnos = $Rowsnos < 4 ? 4 : $colsnos;
		$colsnos2 =  round ((strlen($add[2]) + 1) / 40,0);
		$Rowsnos2 = $Rowsnos2 < 4 ? 4 : $colsnos2;
		
		$colsnos3 =  round ((strlen($add[3]) + 1) / 40,0);
		$Rowsnos3 = $Rowsnos3 < 4 ? 4 : $colsnos3;
		if($add[6] == 1008 && $add[16] != 10081005){
			echo "<h3 style='text-align: center;'>FACILITY SETTLEMENT AND CR RELEASING MEMO</h3>";
		}
		if($add[6] == 1008 && $add[16] == 10081005){
			echo "<h3 style='text-align: center;'>OD INTEREST/ CHARGES WAIVE OFF MEMO</h3>";
		}
		echo "<br/><table style='font-size: 12px;font-family: sans-serif;' border='1' cellpadding='0' cellspacing='0'>";
		echo "<tr style='background-color:#FFFFFF;'>";
		echo "<td style='width:250px;padding-left: 5px;'>Request Branch: </td>";
		echo "<td style='width:400px;padding-left: 5px;'>".$add[11]." - ".$add[13]."</td>";
		echo "</tr>";
		echo "<tr style='background-color:#FFFFFF;'>";
		echo "<td style='width:250px;padding-left: 5px;'>Entry Date: </td>";
		echo "<td style='width:400px;padding-left: 5px;'>".$add[9]."</td>";
		echo "</tr>";
		echo "<tr style='background-color:#FFFFFF;'>";
		echo "<td style='width:250px;padding-left: 5px;'>User ID : </td>";
		echo "<td style='width:400px;padding-left: 5px;'>".$add[7]."-".$add[8]."</td>";
		echo "</tr>";
		echo "<tr style='background-color:#FFFFFF;'>";
		echo "<td style='width:250px;padding-left: 5px;'>Help ID </td>";
		echo "<td style='width:400px;padding-left: 5px;'>".$helpID."</td>";
		echo "</tr>";
		echo "<tr style='background-color:#FFFFFF;'>";
		echo "<td style='width:250px;padding-left: 5px;'>Category : </td>";
		echo "<td style='width:400px;padding-left: 5px;'>".$add[14]."</td>";
		echo "</tr>";
		echo "<tr style='background-color:#FFFFFF;'>";
		echo "<td style='width:250px;padding-left: 5px;'>Sub Category : </td>";
		echo "<td style='width:400px;padding-left: 5px;'>".$add[15]."</td>";
		echo "</tr>";
		echo "<tr style='background-color:#FFFFFF;'>";
		echo "<td style='width:250px;padding-left: 5px;'>";
		if($add[6] != 1008 ){
			echo "Issue :";
		}else{
			echo "Facility No :";
		}
		echo "</td>";
		echo "<td style='width:400px;;padding-left: 5px;'>".$add[0]."</td>";
		echo "</tr>";
		echo "<tr style='background-color:#FFFFFF;'>";
		echo "<td style='width:250px;;padding-left: 5px;'>Issue Description</td>";
		echo "<td style='width:400px;'><textarea rows='".($colsnos+3)."' style='width: 400px;padding-left: 5px;font-family: sans-serif;font-size: 12px;'>".$add[1]."</textarea></td>";
		echo "</tr>";
		echo "<tr style='background-color:#FFFFFF;'>";
		echo "<td style='width:250px;;padding-left: 5px;'>Caused by </td>";
		echo "<td style='width:400px;'><textarea rows='".$colsnos2."' style='width: 400px;padding-left: 5px;font-family: sans-serif;font-size: 12px;'>".$add[2]."</textarea></td>";
		echo "</tr>";
		echo "<tr style='background-color:#FFFFFF;'>";
		echo "<td style='width:250px;;padding-left: 5px;'>Solution </td>";
		echo "<td style='width:400px;'><textarea rows='".$colsnos3."' style='width: 400px;padding-left: 5px;font-family: sans-serif;font-size: 12px;'>".$add[3]."</textarea></td>";
		echo "</tr>";
		echo "<tr style='background-color:#FFFFFF;'>";
		echo "<td style='width:250px;;padding-left: 5px;'>Solved By </td>";
		echo "<td style='width:400px;;padding-left: 5px;'>".$add[4]." - ".$user."</td>";
		echo "</tr>";
		echo "<tr style='background-color:#FFFFFF;'>";
		echo "<td style='width:250px;;padding-left: 5px;'>Solved On </td>";
		echo "<td style='width:400px;;padding-left: 5px;'>".$add[5]."</td>";
		echo "</tr>";
		// .......... Start :: Added by Rizvi on 21-Oct-2016 to print the Decision
		if(trim($add[17]) != '' ){
			echo "<tr style='background-color:#FFFFFF;'>";
			echo "<td style='width:250px;;padding-left: 5px;'>Decision </td>";
			echo "<td style='width:400px;;padding-left: 5px;'>".$add[17]."</td>";
			echo "</tr>";
		}
		// .......... End :: Added by Rizvi on 21-Oct-2016 to print the Decision 
		
		if($add[6] == 1008 && $add[16] != 10081005){
			echo "<tr style='background-color:#FFFFFF;'>";
			echo "<td style='width:250px;padding-left: 5px;height: 100px;'>Notepad Referred (Inbank and Corebank) </td>";
			echo "<td style='width:400px;'>&nbsp;</td>";
			echo "</tr>";
			echo "<tr style='background-color:#FFFFFF;'>";
			echo "<td style='width:250px;padding-left: 5px;height: 100px;'>Other Facility Arrears / Disposal / Pledged Facility Details</td>";
			echo "<td style='width:400px;'>&nbsp;</td>"; 
			echo "</tr>";
		}
		if($add[6] == 1008 && $add[16] == 10081005){
			echo "<tr style='background-color:#FFFFFF;'>";
			echo "<td style='width:250px;padding-left: 5px;height: 100px;'>Recovery Comments </td>";
			echo "<td style='width:400px;'>&nbsp;</td>";
			echo "</tr>";
			echo "<tr style='background-color:#FFFFFF;'>";
			echo "<td style='width:250px;padding-left: 5px;height: 100px;'>Total Amount to be waived off (Rs.)</td>";
			echo "<td style='width:400px;'>&nbsp;</td>"; 
			echo "</tr>";
		}
					
			
	   echo "</table>";
	   if($add[6] == 1008 ){
			echo "<div tyle='font-weight: bold;'><br /><br/>";
			echo "<table style='font-size: 12px;font-weight: bold;' border='0' cellpadding='0' cellspacing='0'>";
			echo "<tr style='background-color:#FFFFFF;'>";
			echo "<td style='width:250px;padding-left: 5px;'>...........................................</td>";
			echo "<td style='width:400px;'>&nbsp;</td>";
			echo "</tr>";
			echo "<tr style='background-color:#FFFFFF;'>";
			echo "<td style='width:250px;padding-left: 5px;'>CHECKED BY - PDFD</td>";
			echo "<td style='width:400px;'>&nbsp;</td>";
			echo "</tr>";
			echo "</table>";
			echo "<br/><br/>";
			echo "<table style='font-size: 12px;font-weight: bold;' border='0' cellpadding='0' cellspacing='0'>";
			echo "<tr style='background-color:#FFFFFF;'>";
			echo "<td style='width:250px;padding-left: 5px;'>...........................................</td>";
			echo "<td style='width:400px;text-align: center;'>.................................</td>";
			echo "</tr>";
			echo "<tr style='background-color:#FFFFFF;'>";
			echo "<td style='width:250px;padding-left: 5px;'>AUTHORIZED BY - PDFD</td>";
			echo "<td style='width:400px;text-align: center;'>DATE</td>";
			echo "</tr>";
			echo "</table>";
			echo "<br /><br/>";
			echo "<table style='font-size: 12px;font-weight: bold;' border='0' cellpadding='0' cellspacing='0'>";
			echo "<tr style='background-color:#FFFFFF;'>";
			echo "<td style='width:400px;padding-left: 5px;'>...........................................</td>";
			echo "<td style='width:250px;'>&nbsp;</td>";
			echo "</tr>";
			echo "<tr style='background-color:#FFFFFF;'>";
			echo "<td style='width:400px;padding-left: 5px;'>APPROVED BY - PDFD</td>";
			echo "<td style='width:250px;'>&nbsp;</td>";
			echo "</tr>";
			echo "</table></div>";
	   }
	}
	echo "</div>";
}


function serviceRequsestMaual_Gried_POPUP_1user($userBranch){
    $conn = DatabaseConnection();
    echo "<div id='outer'></div>";
    echo "<div id='conten'>";
    echo "<div style='width: 100%; height: 30px;'><img src='../../../img/Close-Button.png' onclick='popup(0);' /></div>";
    echo "<div style='width: 100%;'>";
    echo "Search User name : <input class='box_decaretion' style='width:200px; background-color:#E0E0E0;' type='text' name='popupsearch' id='popupsearch' value='' onKeyPress='return disableEnterKey(event)'/> 
                            <input class='buttonManage' type='button' value='Search' id='popupSearchBTN' name='popupSearchBTN' onclick='fileSelect()' />
                            <div style='display:none;'>
                                <input style='width:100px;' type='text' name='tx' id='tx' value=''  onKeyPress='return disableEnterKey(event)'/>
                                <input style='width:100px;' type='text' name='ty' id='ty' value=''  onKeyPress='return disableEnterKey(event)'/>
                            </div>
                            <br/>
                            <br/>
                            <div id='getNewtblPopup'>";
                            $viewDoc = "SELECT u.userName , u.userID FROM user AS u WHERE u.branchNumber = '".$userBranch."' ";
                            $sql_viewDoc = mysqli_query($conn,$viewDoc);
                            echo "<table class='tbl1' border='1'>
                                    <tr>
                                        <td style='text-align:center; padding-top:5px; padding-bottom:5; width:200px;'>User Number</td>
                                        <td style='text-align:center; padding-top:5px; padding-bottom:5;width:200px;'>User Name</td>
                                        <td style='text-align:center; padding-top:5px; padding-bottom:5;width:100px;'>Access</td>
                                      </tr>";
                            $a = 1 ;
                            while ($add = mysqli_fetch_array($sql_viewDoc)){
                                    echo "<tr style='background-color:#FFFFFF;'>";
                                    echo "<td style='width:150px;'>
                                          <input style='width:150px;' type='text' name='txt1".$a."' id='txt1".$a."' value='".$add[0]."' readonly='readonly'/></td>";
                                    echo "<td style='width:200px;'>
                                          <input style='width:200px;' type='text' name='txt2".$a."' id='txt2".$a."' value='".$add[1]."' readonly='readonly'/></td>";
                                    echo "<td style='width:100px;'>";
                                    echo "<input style='font-size: 12px;' type='button' id='btnselect".$a."' name='btnselect".$a."' value='Select' title=".$a." onclick='selectDB(title);popup(0);'/>";
                                    echo "</td>";
                                    echo "</tr>";
                                    $a++;
                            }
               echo "</table></div></div></div>";
}
?>