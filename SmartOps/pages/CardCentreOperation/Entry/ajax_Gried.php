<?php
session_start();
function DatabaseConnection(){
    $conn = mysqli_connect("localhost","root","1234","cdberp");
    return $conn;
}
if(isset($_REQUEST['sr_gried'])){
        serviceRequsestMaual_Gried_POPUP_1();
}
if(isset($_REQUEST['srm_gried'])){
        serviceRequsestMaual_Manual_Gried_POPUP_2();
}

if(isset($_REQUEST['get_Approve']) && isset($_REQUEST['get_function'])){
    //echo $_REQUEST['get_Approve']." - ".$_REQUEST['get_function'];
    get_Approve($_REQUEST['get_function']);
}
if(isset($_REQUEST['str_joint'])){
       // echo "l123456 - ".$_REQUEST['str_joint'];
        getJointAccountGried($_REQUEST['str_joint']);
}

if(isset($_REQUEST['str_singalClint'])){
       // echo "l123456 - ".$_REQUEST['str_joint'];
        get_singalClint($_REQUEST['str_singalClint']);
}
function serviceRequsestMaual_Gried_POPUP_1(){
    $conn = DatabaseConnection();
    echo "<div id='outer'></div>";
    echo "<div id='conten'>";
    echo "<div style='width: 100%; height: 30px;'><img src='../../../img/Close-Button.png' onclick='popup(0);' /></div>";
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
                            $viewDoc = "SELECT u.userName, u.userID , u.branchNumber , b.branchName 
                                            FROM user AS u , branch AS b
                                            WHERE u.branchNumber = b.branchNumber AND
                                                  u.userStat = 'A' AND 
                                                  u.branchNumber = '". $_SESSION['userBranch']."' AND 
                                            		u.deparmentNumber = '".$_SESSION['userDepartment']."';";
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
                                          <input style='width:220px;' type='text' name='txt2".$a."' id='txt2".$a."' value='".$add[1]."' readonly='readonly'/>
                                          <input style='display: none;' type='text' name='txt3".$a."' id='txt3".$a."' value='".$add[2]."' />
                                          <input style='display: none;' type='text' name='txt4".$a."' id='txt4".$a."' value='".$add[3]."' />
                                          </td>";
                                    echo "<td style='width:80px;'>";
                                    echo "<input style='font-size: 12px;' type='button' id='btnselect".$a."' name='btnselect".$a."' value='Select' title=".$a." onclick='selectDB(title);popup(0);'/>";
                                    echo "</td>";
                                    echo "</tr>";
                                    $a++;
                            }
               echo "</table></div></div></div>";
}

function serviceRequsestMaual_Manual_Gried_POPUP_2(){
    $conn = DatabaseConnection();
    echo "<div id='outersub'></div>";
    echo "<div id='contensub'>
            <div style='width: 100%; height: 30px;'><img src='../../../img/Close-Button.png' onclick='popupsub(0);'/></div>
            <div style='width: 100%;'>
                Search User name : <input class='box_decaretion' style='width:200px; background-color:#E0E0E0;' type='text' name='popupsearchsub' id='popupsearchsub' value='' onKeyPress='return disableEnterKey(event)'/> 
                                    <input class='buttonManage' type='button' value='Search' id='popupSearchBTNsub' name='popupSearchBTNsub' onclick='fileSelectsub()' />
                <div style='display:none;'>
                    <input style='width:100px;' type='text' name='txsub' id='txsub' value=''  onKeyPress='return disableEnterKey(event)'/>
                    <input style='width:100px;' type='text' name='tysub' id='tysub' value=''  onKeyPress='return disableEnterKey(event)'/>
                </div>
        <br/>
        <br/>
        <div id='getNewtblPopupsub'>";
        $viewDocsub = "SELECT `user`.`userName`, `user`.`userID`, `user`.`branchNumber`, `branch`.`branchName`, `user`.`deparmentNumber`, `deparment`.`deparmentName`
                        FROM `user`, `branch`, `deparment` 
                        WHERE `user`.`branchNumber` = `branch`.`branchNumber` AND
                        	`user`.`deparmentNumber` = `deparment`.`deparmentNumber`";
        $sql_viewDocsub = mysqli_query($conn,$viewDocsub);
        echo "<table class='tbl1' border='1'>
              <tr>
                <td style='text-align:center; padding-top:5px; padding-bottom:5; width:200px;'>User Number</td>
                <td style='text-align:center; padding-top:5px; padding-bottom:5;width:200px;'>User Name</td>
                <td style='text-align:center; padding-top:5px; padding-bottom:5;width:100px;'>Access</td>
              </tr>";
                    $a = 1 ;
                    while ($addsub = mysqli_fetch_array($sql_viewDocsub)){
                        echo "<tr style='background-color:#FFFFFF;'>";
                        echo "<td style='width:150px;'>
                              <input style='width:150px;' type='text' name='txt1sub".$a."' id='txt1sub".$a."' value='".$addsub[0]."' readonly='readonly'/></td>";
                        echo "<td style='width:200px;'>
                              <input style='width:200px;' type='text' name='txt2sub".$a."' id='txt2sub".$a."' value='".$addsub[1]."' readonly='readonly'/>
                              <div style='display:none;'>
                                <input style='width:200px;' type='text' name='txt3sub".$a."' id='txt3sub".$a."' value='".$addsub[2]."' readonly='readonly'/>
                                <input style='width:200px;' type='text' name='txt4sub".$a."' id='txt4sub".$a."' value='".$addsub[3]."' readonly='readonly'/>
                                <input style='width:200px;' type='text' name='txt5sub".$a."' id='txt5sub".$a."' value='".$addsub[4]."' readonly='readonly'/>
                                <input style='width:200px;' type='text' name='txt6sub".$a."' id='txt6sub".$a."' value='".$addsub[5]."' readonly='readonly'/>
                              </div>
                              </td>";
                        echo "<td style='width:100px;'>";
                        echo "<input style='font-size: 12px;' type='button' id='btnselectsub".$a."' name='btnselectsub".$a."' value='Select' title='".$a."' onclick='selectDBsub(title);popupsub(0);'/>";
                        echo "</td>";
                        echo "</tr>";
                        $a++;
                    }
			echo "</table></div></div></div>";
    
}

function get_Approve($get_function){
    $classes = explode("|",$get_function);
     
    echo "<div id='outer'></div>";
    echo "<div id='conten' style='padding: 10px;'><br/>";
     echo "<div style='width: 100%; height: 30px;text-align: right;margin-right: 10px;'></div>";
     echo $classes[2];
     echo "<br/>";
     echo "<table>
            <tr>
                <td>
                    Comment : 
                </td>
                <td>
                    <textarea id='txtComment' name='txtComment' rows='4' style='width: 300px;padding-left: 10px;font-family: Times New Roman;font-size: 12px;border: solid #000000 1px;'></textarea>     
                </td>
            </tr>
            </table>
          <br/>";
    echo "<div style='width: 100%;'>";    
    if($classes[0] == "A"){
        echo "<input type='button' style='margin-left: 100px;'  class='buttonManage' id='btn_Edit' name='btn_Edit' value='Approve' title='A|".$classes[1]."' onclick='isSolution(title);'/>";     
    }
    if($classes[0] == "R"){
        echo "<input type='button' style='margin-left: 100px;'  class='buttonManage' id='btn_Edit' name='btn_Edit' value='Reject' title='R|".$classes[1]."' onclick='isSolution(title);'/>";     
    }
    if($classes[0] == "P"){
        echo "<input type='button' style='margin-left: 100px;'  class='buttonManage' id='btn_Edit' name='btn_Edit' value='Pending' title='P|".$classes[1]."' onclick='isSolution(title);'/>";     
    }
    if($classes[0] == "I"){
        echo "<input type='button' style='margin-left: 100px;'  class='buttonManage' id='btn_Edit' name='btn_Edit' value='Issue' title='I|".$classes[1]."' onclick='isSolution(title);'/>";     
    }
     if($classes[0] == "B"){
        echo "<input type='button' style='margin-left: 100px;'  class='buttonManage' id='btn_Edit' name='btn_Edit' value='Back' title='B|".$classes[1]."' onclick='isSolution(title);'/>";     
    }
   echo "<input type='button' style='margin-right: 10px;' class='buttonManage' id='btn_Edit' name='btn_Edit' value='Close' title='Close' onclick='popup(0,title)'/>";
          
    echo "</div>";
    echo "<div style='width: 100%;'></div>
    </div>";
}

function getJointAccountGried($str_joint){
    $perant_array = explode("@",$str_joint);
    //echo $perant_array[0]."<br/>";
    //echo $perant_array[1]."<br/>";
    

    
    echo "<table border='1' id='myTable' cellpadding='0' cellspacing='0' style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;'>
            <tr style='background-color: #BEBABA;'>
                <td style='width:80px; text-align: right;'><span style='margin-right: 5px;'>#</span></td>
                <td style='width:300px; text-align: left;'><span style='margin-left: 5px;'>Client Name</span></td>
                <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>NIC</span></td>
                <td style='width:150px;'></td>
            </tr>";
            $child_array1 = explode("|",$perant_array[0],2);
            $child_array2 = explode("|",$child_array1[1]);
             //echo $child_array2[7]."<br/>";
             //echo $child_array2[9]."<br/>";
          echo "<tr>
                <td style='width:80px; text-align: right;'><span style='margin-right: 5px;'>1</span></td>
                <td style='width:300px; text-align: left;'><span style='margin-left: 5px;'>".$child_array2[7]."</span></td>
                <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>".$child_array2[9]."</span></td>
                <td style='width:150px;'><a class='isLinkApprove' href='#' title='".$child_array1[1]."' onclick='isLoadDtl(title);'>Load</a> </td>
              </tr>";
    $r = 2;
    
    for($i = 1; $i<sizeof($perant_array); $i++){
        if($perant_array[$i] != ""){
            //echo "<hr/>".$perant_array[$i]."<br/>";
            $child_array3 = explode("|",$perant_array[$i]);
           
           // echo $child_array3[7]."<br/>";
           // echo $child_array3[9]."<br/>";
            echo "<tr>
                    <td style='width:80px; text-align: right;'><span style='margin-right: 5px;'>".$r."</span></td>
                    <td style='width:300px; text-align: left;'><span style='margin-left: 5px;'>".$child_array3[7]."</span></td>
                    <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>".$child_array3[9]."</span></td>
                    <td style='width:150px;'><a class='isLinkApprove' href='#' title='".$perant_array[$i]."' onclick='isLoadDtl(title);'>Load</a></td>
                  </tr>";
        }
        $r++;
    }
     echo "<table/>";
    
}

function get_singalClint($str_singalClint){
    //echo $str_singalClint;
    $conn = DatabaseConnection();
    $perant_array = explode("|",$str_singalClint);
    /* document.getElementById('txt_acc_01').value = $perant_array[0].trim();
document.getElementById('txt_Acc_Opening_Date').value = $perant_array[1].trim();
document.getElementById('txt_cif').value = $perant_array[5].trim();
document.getElementById('txt_Clint_title').value = $perant_array[6].trim();
document.getElementById('txt_Clint_Name').value = $perant_array[7].trim();
document.getElementById('txt_NIC').value = $perant_array[9].trim();
document.getElementById('txt_DOB').value = $perant_array[10].trim();
document.getElementById('txt_Permanent_Add_line_01').value  = $perant_array[17].trim();
document.getElementById('txt_Permanent_Add_line_02').value = $perant_array[18].trim();
document.getElementById('txt_Permanent_Add_line_03').value = $perant_array[19].trim();
document.getElementById('txt_Permanent_Add_line_04').value = $perant_array[20].trim();
document.getElementById('txt_Permanent_Add_line_05').value = $perant_array[21].trim();
document.getElementById('txt_Permanent_Add_line_06').value = $perant_array[22].trim();
document.getElementById('txt_Communication_Add_line_01').value = $perant_array[11].trim();
document.getElementById('txt_Communication_Add_line_02').value = $perant_array[12].trim();
document.getElementById('txt_Communication_Add_line_03').value = $perant_array[13].trim();
document.getElementById('txt_Communication_Add_line_04').value = $perant_array[14].trim();
document.getElementById('txt_Communication_Add_line_05').value = $perant_array[15].trim();
document.getElementById('txt_Communication_Add_line_06').value = $perant_array[16].trim();
document.getElementById('txt_Mobile_Number').value = $perant_array[23].trim();
document.getElementById('txt_Home_TP').value = $perant_array[24].trim(); */
    echo "<table>
    <tr>
        <td style='width: 160px; text-align: right;'><label class='linetop'>ACCOUNT :</label></td>
        <td>
            <input type='text' class='box_decaretion' maxlength='20' style='width:250px;' name='txt_acc_01' id='txt_acc_01' value='".$perant_array[0]."' onkeypress='return disableEnterKey(event)' onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' placeholder='Account 01' onkeyup='ajaxFunction(event)'/>
        </td>
    </tr>
    <tr>
        <td style='width: 160px; text-align: right; vertical-align: top;'><label class='linetop'>&nbsp;</label></td>
        <td>
             <input type='text' class='box_decaretion' maxlength='20' style='width:250px;' name='txt_acc_02' id='txt_acc_02' value='' onkeypress='return disableEnterKey(event)' onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' placeholder='Account 02'/>
             <input type='text' class='box_decaretion' maxlength='20' style='width:250px;' name='txt_acc_03' id='txt_acc_03' value='' onkeypress='return disableEnterKey(event)' onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' placeholder='Account 03'/>
             <input type='text' class='box_decaretion' maxlength='20' style='width:250px;' name='txt_acc_04' id='txt_acc_04' value='' onkeypress='return disableEnterKey(event)' onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' placeholder='Account 04'/>
        </td>
    </tr>
    <tr>
        <td style='width: 160px; text-align: right; vertical-align: top;'><label class='linetop'>APP RECEIVED DATE :</label></td>
        <td>
             <input type='text' class='box_decaretion' style='width:100px;' name='txt_App_Received_date' id='txt_App_Received_date' value='' onkeypress='return disableEnterKey(event)' onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' placeholder='----/--/--'/>&nbsp;&nbsp;
             <label class='linetop'>ACC OPENING DATE : </label>&nbsp;
             <input type='text' class='box_decaretion' style='width:100px;background-color: #B6B6B6;' name='txt_Acc_Opening_Date' id='txt_Acc_Opening_Date' value='".$perant_array[1]."' onkeypress='return disableEnterKey(event)' placeholder='----/--/--'/>
        </td>
    </tr>
    <tr>
        <td style='width: 160px; text-align: right; vertical-align: top;'><label class='linetop'>CLIENT :</label></td>
        <td>
             <input type='text' class='box_decaretion' maxlength='5' style='width:50px;background-color: #B6B6B6;' name='txt_Clint_title' id='txt_Clint_title' value='".$perant_array[6]."' onkeypress='return disableEnterKey(event)' readonly='readonly'/>
             <input type='text' class='box_decaretion' style='width:500px;background-color: #B6B6B6;' name='txt_Clint_Name' id='txt_Clint_Name' value='".$perant_array[7]."' onkeypress='return disableEnterKey(event)' placeholder='Clint Name' readonly='readonly'/>
        </td>
    </tr>
    <tr>
        <td style='width: 160px; text-align: right; vertical-align: top;'><label class='linetop'>EMBOSSING NAME :</label></td>
        <td>
            <input type='text' class='box_decaretion' style='width:500px;' name='txt_Embossing_Name' id='txt_Embossing_Name' value='' onkeypress='return disableEnterKey(event)' onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' placeholder='Embossing Name'/>
        </td>
    </tr>
    <tr>
        <td style='width: 160px; text-align: right; vertical-align: top;'><label class='linetop'>COLLECTING BRANCH :</label></td>
        <td>
            <select class='box_decaretion'  style='width: 200px;' name='sel_Collecting_Branch' id='sel_Collecting_Branch' onkeypress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)'>
            <option value=''>--Select Collecting Branch --</option>";
            $v_sql_Collecting_Branch = "SELECT b.branchNumber , b.branchName FROM branch AS b WHERE b.branchNumber != '0001';";
            $que_Collecting_Branch = mysqli_query($conn,$v_sql_Collecting_Branch);
            while($RES_Collecting_Branch = mysqli_fetch_array($que_Collecting_Branch)){
                echo "<option value='".$RES_Collecting_Branch[0]."'>".$RES_Collecting_Branch[1]."</option>";
            }
            echo " </select>
             &nbsp;&nbsp;
             <label class='linetop'>HOME BRANCH : </label>&nbsp;
             <select class='box_decaretion'  style='width: 200px;' name='sel_Home_Branch' id='sel_Home_Branch' onkeypress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)'>
                <option value=''>--Select Home Barnch --</option>";
             $v_sql_Home_Branch = "SELECT b.branchNumber , b.branchName FROM branch AS b WHERE b.branchNumber != '0001';";
            $que_Home_Branch = mysqli_query($conn,$v_sql_Home_Branch);
            while($RES_Home_Branch = mysqli_fetch_array($que_Home_Branch)){
                echo "<option value='".$RES_Home_Branch[0]."'>".$RES_Home_Branch[1]."</option>";
            }
            echo "
                </select> 

        </td>
    </tr>
    <tr>
        <td style='width: 160px; text-align: right; vertical-align: top;'><label class='linetop'>CIF :</label></td>
        <td>
             <input type='text' class='box_decaretion' maxlength='12' style='width:100px;background-color: #B6B6B6;' name='txt_cif' id='txt_cif' value='".$perant_array[5]."' onkeypress='return disableEnterKey(event)'  placeholder='CIF' readonly='readonly'/>
             <label class='linetop'>NIC : </label>
             <input type='text' class='box_decaretion' maxlength='15' style='width:200px;background-color: #B6B6B6;' name='txt_NIC' id='txt_NIC' value='".$perant_array[9]."' onkeypress='return disableEnterKey(event)' placeholder='NIC' readonly='readonly'/>
             <label class='linetop'>DATE OF BIRTH : </label>
             <input type='text' class='box_decaretion' style='width:100px;background-color: #B6B6B6;' name='txt_DOB' id='txt_DOB' value='".$perant_array[10]."' onkeypress='return disableEnterKey(event)' placeholder='----/--/--' />
        </td>
    </tr>
</table>
<table>
    <tr>
        <td style='width: 160px; text-align: right;vertical-align: top;'><label class='linetop'>PERMANENT ADDRESS :</label></td>
        <td>
            <input type='radio' name='rod_ADDRESS' id='p_ADDRESS' value='1' checked='checked' /><br /><br />
            <input type='text' class='box_decaretion' style='width:250px;background-color: #B6B6B6;' name='txt_Permanent_Add_line_01' id='txt_Permanent_Add_line_01' value='".$perant_array[17]."' onkeypress='return disableEnterKey(event)' placeholder='Address Line 01' readonly='readonly'/><br />
            <input type='text' class='box_decaretion' style='width:250px;margin-top: 3px;background-color: #B6B6B6;' name='txt_Permanent_Add_line_02' id='txt_Permanent_Add_line_02' value='".$perant_array[18]."' onkeypress='return disableEnterKey(event)' placeholder='Address Line 02' readonly='readonly'/><br />
            <input type='text' class='box_decaretion' style='width:250px;margin-top: 3px;background-color: #B6B6B6;' name='txt_Permanent_Add_line_03' id='txt_Permanent_Add_line_03' value='".$perant_array[19]."' onkeypress='return disableEnterKey(event)' placeholder='Address Line 03' readonly='readonly'/><br />
            <input type='text' class='box_decaretion' style='width:250px;margin-top: 3px;background-color: #B6B6B6;' name='txt_Permanent_Add_line_04' id='txt_Permanent_Add_line_04' value='".$perant_array[20]."' onkeypress='return disableEnterKey(event)' placeholder='Address Line 04' readonly='readonly'/><br />
            <input type='text' class='box_decaretion' style='width:250px;margin-top: 3px;background-color: #B6B6B6;' name='txt_Permanent_Add_line_05' id='txt_Permanent_Add_line_05' value='".$perant_array[21]."' onkeypress='return disableEnterKey(event)' placeholder='Address Line 05' readonly='readonly'/><br />
            <input type='text' class='box_decaretion' style='width:250px;margin-top: 3px;background-color: #B6B6B6;' name='txt_Permanent_Add_line_06' id='txt_Permanent_Add_line_06' value='".$perant_array[22]."' onkeypress='return disableEnterKey(event)' placeholder='City' readonly='readonly'/><br />
        </td>
        <td style='width: 160px; text-align: right;vertical-align: top;'><label class='linetop'>COMMUNICATION ADDRESS :</label></td>
        <td>
             <input type='radio' name='rod_ADDRESS' id='c_ADDRESS' value='2' /><br /><br />
            <input type='text' class='box_decaretion' style='width:250px;background-color: #B6B6B6;' name='txt_Communication_Add_line_01' id='txt_Communication_Add_line_01' value='".$perant_array[11]."' onkeypress='return disableEnterKey(event)' placeholder='Address Line 01' readonly='readonly'/><br />
            <input type='text' class='box_decaretion' style='width:250px;margin-top: 3px;background-color: #B6B6B6;' name='txt_Communication_Add_line_02' id='txt_Communication_Add_line_02' value='".$perant_array[12]."' onkeypress='return disableEnterKey(event)' placeholder='Address Line 02' readonly='readonly'/><br />
            <input type='text' class='box_decaretion' style='width:250px;margin-top: 3px;background-color: #B6B6B6;' name='txt_Communication_Add_line_03' id='txt_Communication_Add_line_03' value='".$perant_array[13]."' onkeypress='return disableEnterKey(event)' placeholder='Address Line 03' readonly='readonly'/><br />
            <input type='text' class='box_decaretion' style='width:250px;margin-top: 3px;background-color: #B6B6B6;' name='txt_Communication_Add_line_04' id='txt_Communication_Add_line_04' value='".$perant_array[14]."' onkeypress='return disableEnterKey(event)' placeholder='Address Line 04' readonly='readonly'/><br />
            <input type='text' class='box_decaretion' style='width:250px;margin-top: 3px;background-color: #B6B6B6;' name='txt_Communication_Add_line_05' id='txt_Communication_Add_line_05' value='".$perant_array[15]."' onkeypress='return disableEnterKey(event)' placeholder='Address Line 05' readonly='readonly'/><br />
            <input type='text' class='box_decaretion' style='width:250px;margin-top: 3px;background-color: #B6B6B6;' name='txt_Communication_Add_line_06' id='txt_Communication_Add_line_06' value='".$perant_array[16]."' onkeypress='return disableEnterKey(event)' placeholder='City' readonly='readonly'/><br />
        </td>
    </tr>
</table>
<table>
    <tr>
        <td style='width: 160px; text-align: right;'><label class='linetop'>MOTHER MAIDEN NAME :</label></td>
        <td>
            <input type='text' class='box_decaretion' style='width:500px;' name='txt_Mother_Maiden_Name' id='txt_Mother_Maiden_Name' value='' onkeypress='return disableEnterKey(event)' onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' placeholder='Mother Maiden Name'/>
        </td>
    </tr>
    <tr>
        <td style='width: 160px; text-align: right; vertical-align: top;'><label class='linetop'>MOBILE NUMBER :</label></td>
        <td>
             <input type='text' class='box_decaretion' maxlength='10' style='width:100px;' name='txt_Mobile_Number' id='txt_Mobile_Number' value='".$perant_array[23]."' onkeypress='return disableEnterKey(event)' onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)'/>&nbsp;&nbsp;
             <label class='linetop'>HOME TP : </label>&nbsp;
             <input type='text' class='box_decaretion' maxlength='10' style='width:100px;' name='txt_Home_TP' id='txt_Home_TP' value='".$perant_array[24]."' onkeypress='return disableEnterKey(event)' onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' />
        </td>
    </tr>
    <tr>
        <td style='width: 160px; text-align: right; vertical-align: top;'><label class='linetop'>SAL PLUS CATEGORY :</label></td>
        <td>
            <select class='box_decaretion'  style='width: 200px;' name='sel_Sal_Plus_Category' id='sel_Sal_Plus_Category' onkeypress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)'>
            <option value=''>--Select Sal Plus Category --</option>";
            $sql_SAL = "SELECT cs.SAL_PLUS_CATEGORY_ID , cs.SAL_PLUS_CATEGORY_DIS FROM card_sal_plus_category AS cs;";
                $que_SAL = mysqli_query($conn,$sql_SAL);
                while($RES_SAL = mysqli_fetch_array($que_SAL)){
                    echo "<option value='".$RES_SAL[0]."'>".$RES_SAL[1]."</option>";
                }
    echo " </select> 
        </td>
    </tr>
    <tr>
        <td style='width: 160px; text-align: right;'><label class='linetop'>PREVIOUS CARD NO. :</label></td>
        <td>
            <input type='text' class='box_decaretion' maxlength='20' style='width:250px; display: none;' name='txt_Previous_Card_No' id='txt_Previous_Card_No' value='' onkeypress='return disableEnterKey(event)' onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' placeholder='Previous Card No.'/>
            <label id='lbl_pcn' style='color: #B70000;'></label>
        </td>
    </tr>
    <tr>
        <td style='width: 160px; text-align: right; vertical-align: top;'><label class='linetop'>INTRODUCER :</label></td>
        <td>
             <input type='text' class='box_decaretion' maxlength='10' style='width:70px;background-color: #B6B6B6;' name='txt_IntroducerCode' id='txt_IntroducerCode' value='' onkeypress='return disableEnterKey(event)' onclick='popup(1);' readonly='readonly'/>
             <input type='text' class='box_decaretion' style='width:500px;background-color: #B6B6B6;' name='txt_Introducer_Name' id='txt_Introducer_Name' value='' onkeypress='return disableEnterKey(event)' placeholder='Introducer Name' onclick='popup(1);' readonly='readonly'/>
             <input class='buttonManage' style='width: 50px;' type='button' name='btnRequest' id='btnRequest' value='...' onclick='popup(1);'/>
        </td>
    </tr>
    <tr>
        <td style='width: 160px; text-align: right; vertical-align: top;'><label class='linetop'>INTRODUCER BRANCH :</label></td>
        <td>
             <input type='text' class='box_decaretion' style='width:70px;background-color: #B6B6B6;' name='txt_IntroducerBranchCode' id='txt_IntroducerBranchCode' value='' onkeypress='return disableEnterKey(event)'  readonly='readonly'/>
             <input type='text' class='box_decaretion' style='width:250px;background-color: #B6B6B6;' name='txt_IntroducerBranchName' id='txt_IntroducerBranchName' value='' onkeypress='return disableEnterKey(event)'  placeholder='Introducer Branch' readonly='readonly'/>
        </td>
    </tr>
     <tr>
        <td style='width: 160px; text-align: right; vertical-align: top;'><label class='linetop'>WITHDRAWAL LIMIT :</label></td>
        <td>
            <select class='box_decaretion'  style='width: 200px;' name='sel_Withdrawal_Limit' id='sel_Withdrawal_Limit' onkeypress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' onchange='getPurchasingLimit();'>
            <option value=''>--Select Withdrawal Limit--</option>";
        $v_sql_W = "SELECT w.WP_ID , w.WITHDRAWAL_LIMIT , w.PURCHASING_LIMIT FROM card_withdrawal_pos_header AS w";
                $que_W = mysqli_query($conn,$v_sql_W);
                while($RES_W = mysqli_fetch_array($que_W)){
                    echo "<option value='".$RES_W[0]."|".$RES_W[2]."|".$RES_W[1]."'>".$RES_W[1]." - ".$RES_W[2]."</option>";
                }
          echo "</select> 
             &nbsp;&nbsp;
             <label class='linetop'>PURCHASING LIMIT : </label>&nbsp;
             <input type='text' class='box_decaretion' style='width:200px;background-color: #B6B6B6;' name='txt_PurchasingLimit' id='txt_PurchasingLimit' value='' onkeypress='return disableEnterKey(event)' readonly='readonly' />
        </td>
    </tr>
</table>
<br /><hr />
<input class='buttonManage' style='width: 100px;' type='button' name='btnRequest' id='btnRequest' value='Request' onclick='isRequest();'/>
<input class='buttonManage' style='width: 100px;' type='button' name='btnClose' id='btnClose' value='Close' onclick='pageClose();'/>";
}
    
?>