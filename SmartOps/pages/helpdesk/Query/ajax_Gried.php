<?php
session_start();
function DatabaseConnection(){
    $conn = mysqli_connect("localhost","root","1234","cdberp");
    return $conn;
}
if(isset($_REQUEST['sr_gried'])){
        serviceRequsestMaual_Gried_POPUP_1($_REQUEST['sr_gried']);
}

if(isset($_REQUEST['isUserLog'])){
    getUserActiveGried($_REQUEST['isUserLog']);
}

function getUserActiveGried($isUserLog){
    $conn = DatabaseConnection();
    echo "<div id='outer1'></div>";
    echo "<div id='conten1'>";
    echo "<div style='width: 100%; height: 30px;'><img src='../../../img/Close-Button.png' onclick='getUser(0);' /></div>";
    echo "<div style='width: 100%;'>";
    echo "<lable style='padding: 10px;'>Search by name :</lable> <input class='box_decaretion' style='width:200px; background-color:#E0E0E0;' type='text' name='popupsearch' id='popupsearch' value='' onKeyPress='return disableEnterKey(event)'/> 
                            <input class='buttonManage' type='button' value='Search' id='popupSearchBTN' name='popupSearchBTN' onclick='fileSelect()' />
                            <div style='display:none;'>
                                <input style='width:100px;' type='text' name='tx' id='tx' value=''  onKeyPress='return disableEnterKey(event)'/>
                                <input style='width:100px;' type='text' name='ty' id='ty' value=''  onKeyPress='return disableEnterKey(event)'/>
                            </div>
                            <br/>
                            <br/>
                            <div id='getNewtblPopup'>";
                            $viewDoc = "SELECT `userName`,`userID` FROM `user` WHERE `userStat` = 'A' AND `branchNumber` = '". $_SESSION['userBranch']."' AND `deparmentNumber` = '".$_SESSION['userDepartment']."';";
							//echo  $viewDoc ;
							
                            $sql_viewDoc = mysqli_query($conn,$viewDoc);
                            echo "<table style='border-collapse: collapse;' border='1' rowspan='0' colspan='0'>
                                    <tr>
                                        <td style='text-align:center; padding-top:5px; padding-bottom:5; width:100px;'>User Number</td>
                                        <td style='text-align:center; padding-top:5px; padding-bottom:5;width:220px;'>User Name</td>
                                        <td style='text-align:center; padding-top:5px; padding-bottom:5;width:80px;'>Access</td>
                                      </tr>";
                            $a = 1 ;
                            while ($add = mysqli_fetch_array($sql_viewDoc)){
                                    echo "<tr style='background-color:#FFFFFF;'>";
                                    echo "<td style='width:100px;'>
                                          <input style='width:100px;' type='text' name='txt1".$a."' id='txt1".$a."' value='".$add[0]."' readonly='readonly'/></td>";
                                    echo "<td style='width:220px;'>
                                          <input style='width:220px;' type='text' name='txt2".$a."' id='txt2".$a."' value='".$add[1]."' readonly='readonly'/></td>";
                                    echo "<td style='width:80px;'>";
                                    echo "<input style='font-size: 12px;' type='button' id='btnselect".$a."' name='btnselect".$a."' value='Select' title=".$a." onclick='selectDB(title);getUser(0);'/>";
                                    echo "</td>";
                                    echo "</tr>";
                                    $a++;
                            }
               echo "</table></div></div>";
   	echo "</div>";
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
	    $GLOBALS['A'] = $add[16];
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
		/*if($add[6] == 1008 && $add[16] != 10081005){
			echo "<h3 style='text-align: center;'>FACILITY SETTLEMENT AND SECURTY DOCUMENT RELEASING MEMO</h3>";
		}
		if($add[6] == 1008 && $add[16] == 10081005){
			echo "<h3 style='text-align: center;'>OD INTEREST/ CHARGES WAIVE OFF MEMO</h3>";
		}*/
        $issue_lbl = "";
        $sql_getScat02 = "select s.issue_lbl , 
                                 s.memo_title_status , 
                                 s.memo_title ,
                                 s.memo_main_tbl_addition_status ,
                                 s.memo_main_tbl_addition ,
                                 s.memo_footer
                            FROM scat_02 AS s WHERE s.cat_code = '".$add[6]."' AND s.scat_code_2 = '".$add[16]."';";
        $query_getScat02 = mysqli_query($conn,$sql_getScat02) or die($sql_getScat02);
        while($resalt_getScat02 = mysqli_fetch_assoc($query_getScat02)){
            $issue_lbl = $resalt_getScat02['issue_lbl'];
            $memo_title_status = $resalt_getScat02['memo_title_status'];
            $memo_title = $resalt_getScat02['memo_title'];
            $memo_main_tbl_addition_status = $resalt_getScat02['memo_main_tbl_addition_status'];
            $memo_main_tbl_addition = $resalt_getScat02['memo_main_tbl_addition'];
            $memo_footer = $resalt_getScat02['memo_footer'];
            
        }
        
        if($memo_title_status == 1){
            echo $memo_title;
        }
        
 		echo "<table style='font-size: 12px;font-family: sans-serif;' border='1' cellpadding='0' cellspacing='0'>";
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
		if($issue_lbl == "" ){
			echo "Issue :";
		}else{
			echo $issue_lbl." :";
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
		
		/*if($add[6] == 1008 && $add[16] != 10081005){
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
		}*/
        
        if($memo_main_tbl_addition_status == 1){
            echo $memo_main_tbl_addition;
        }
					
			
	   echo "</table>";
       //----------------------------------------------------------------------------------------------
        $sql_noteget1 = "SELECT n.note_code , n.note_discr , n.enterBy , n.enterDateTime FROM cdb_help_note AS n WHERE n.helpid = '".$helpID."';";
         
         $squery_noteget1 = mysqli_query($conn , $sql_noteget1) or die(mysqli_error($conn));
         if(mysqli_num_rows($squery_noteget1)>0){
            echo "<br/>
                <table style='font-size: 12px;font-family: sans-serif;' border='1' cellpadding='0' cellspacing='0'>
                    <tr>
                    <td style='width:50px; text-align:right; padding-right:5px'>#</td>
                    <td style='width:400px; text-align:left; padding-left:5px'>Notes</td>
                    <td style='width:100px; text-align:left; padding-left:5px'>Enterd User</td>
                    <td style='width:150px; text-align:left; padding-left:5px'>Enterd On</td>
                 </tr>";
        
             while($rec_noteget1 = mysqli_fetch_assoc($squery_noteget1)){
                echo  "<tr>
                                <td style='width:50px; text-align:right; padding-right:5px'>".$rec_noteget1['note_code']."</td>
                                <td style='width:400px; text-align:left; padding-left:5px'>".$rec_noteget1['note_discr']."</td>
                                <td style='width:100px; text-align:left; padding-left:5px'>".$rec_noteget1['enterBy']."</td>
                                <td style='width:150px; text-align:left; padding-left:5px'>".$rec_noteget1['enterDateTime']."</td>
                            </tr> "; 
             }
         /*    echo "<tr>
                                <td style='width:50px; text-align:right; padding-right:5px'>&nbsp;</td>
                                <td style='width:400px; text-align:left; padding-left:5px'>&nbsp;</td>
                                <td style='width:100px; text-align:left; padding-left:5px'>&nbsp;</td>
                                <td style='width:150px; text-align:left; padding-left:5px'>&nbsp;</td>
                            </tr> "; */
             echo "</table>";
         }
       // echo "1";
        loopingDTL($conn,$helpID); // genaret note tbl
        
        //----------------------------------------------------------------------
	   /*if($add[6] == 1008 ){
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
	   }*/
       
       if($memo_footer != ""){
            echo $memo_footer;
       }
	}
	echo "</div>";
}

function getNoteTbl($conn,$helpID){
    
    $sql_hel = "select h.issue , b.branchName ,h.cat_code
                        FROM cdb_helpdesk AS h , branch AS b
                        WHERE
                         h.entry_branch = b.branchNumber and h.helpid = '".$helpID."';";
    $query_hel = mysqli_query($conn,$sql_hel) or die(mysqli_error($conn));
    while($resalt_hel = mysqli_fetch_array($query_hel)){
        $cat_id = $resalt_hel[2];
        echo "<lable style='font-size: 12px;font-family: sans-serif;'>Helpdesk ID : " . $helpID ." - ".$resalt_hel[0]."</lable> <lable style='font-size: 12px;font-family: sans-serif;'>(Entry Branch : ".$resalt_hel[1].")</lable><br/>";
    }
    
    
    if(!($cat_id == '1014' && ($GLOBALS['A'] == '10290123' || $GLOBALS['A'] == '10280118'))){
    
         $sql_noteget1 = "SELECT n.note_code , n.note_discr , n.enterBy , n.enterDateTime FROM cdb_help_note AS n WHERE n.helpid = '".$helpID."';";
             
         $squery_noteget1 = mysqli_query($conn , $sql_noteget1) or die(mysqli_error($conn));
         if(mysqli_num_rows($squery_noteget1)>0){
            echo "<br/>
                <table style='font-size: 12px;font-family: sans-serif;' border='1' cellpadding='0' cellspacing='0'>
                    <tr>
                    <td style='width:50px; text-align:right; padding-right:5px'>#</td>
                    <td style='width:400px; text-align:left; padding-left:5px'>Notes</td>
                    <td style='width:100px; text-align:left; padding-left:5px'>Enterd User</td>
                    <td style='width:150px; text-align:left; padding-left:5px'>Enterd On</td>
                 </tr>";
        
             while($rec_noteget1 = mysqli_fetch_assoc($squery_noteget1)){
                echo  "<tr>
                                <td style='width:50px; text-align:right; padding-right:5px'>".$rec_noteget1['note_code']."</td>
                                <td style='width:400px; text-align:left; padding-left:5px'>".$rec_noteget1['note_discr']."</td>
                                <td style='width:100px; text-align:left; padding-left:5px'>".$rec_noteget1['enterBy']."</td>
                                <td style='width:150px; text-align:left; padding-left:5px'>".$rec_noteget1['enterDateTime']."</td>
                            </tr> "; 
             }
            /* echo "<tr>
                                <td style='width:50px; text-align:right; padding-right:5px'>&nbsp;</td>
                                <td style='width:400px; text-align:left; padding-left:5px'>&nbsp;</td>
                                <td style='width:100px; text-align:left; padding-left:5px'>&nbsp;</td>
                                <td style='width:150px; text-align:left; padding-left:5px'>&nbsp;</td>
                            </tr> "; */
             echo "</table>";
         }
   
    }
}

function loopingDTL($conn,$helpID){
    //echo $helpID;
    $sql_l = "select h.Linked_helpid  FROM cdb_helpdesk AS h WHERE h.helpid = '".$helpID."';";
    //echo $sql_l;
    $query_l = mysqli_query($conn,$sql_l) or die(mysqli_error($conn));
    while($rec_l = mysqli_fetch_array($query_l)){
        if($rec_l[0] != ""){
            //echo $rec_l[0];
            getNoteTbl($conn,$rec_l[0]);
            loopingDTL($conn,$rec_l[0]);
        }   
    }
}
?>