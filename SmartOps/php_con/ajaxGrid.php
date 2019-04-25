<?php
function DatabaseConnection(){
    $conn = mysqli_connect("localhost","root","1234","cdberp");
    return $conn;
}

if(isset($_REQUEST['Load_su']) ){
    //echo $_REQUEST['get_Approve']." - ".$_REQUEST['get_function'];
    get_Approve($_REQUEST['Load_su']);
}

if(isset($_REQUEST['getIsCat2'])){
    //echo $_REQUEST['getIsCat2'];
    loadScat3SelectBox($_REQUEST['getIsCat2']);
}

function get_Approve($get_function){
    $conn = DatabaseConnection();
    echo "<div id='outer' ></div>";
    echo "<div id='conten' style='padding: 10px;  background-size: 550px 400px; ' ><br/>";
     echo "<div style='width: 100%;   height: 5px;text-align: right;margin-right: 10px;'></div>";
     echo "<form action=''  method='post' name='f1' enctype='multipart/form-data'>"; 
      echo "<img src='../img/suggestion1.png'  style='width: 180px; height:80px;  position: absolute; left: 380px;'/>";
     
     
     echo "<table>
            <tr>
                <td style='width: 150px;  font-family:courier;font-size: 16px;  text-align: right;'>
                  <b>  Category : </b><br/><br/>
                </td>
                <td style='vertical-align: top; font-family:courier;'>
                    <select class='box_decaretion'    style='width: 200px;' name='sel_scat02' id='sel_scat02' onkeypress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' onchange='is_getScat_01();' >
                            <option value=''>--Select Sub Category 2--</option>"; 
                            $v_sql_getCategory = "SELECT `scat_code_2`,`scat_discr_2` 
                                        FROM `scat_02` 
                                       WHERE `cat_code` = '1011' AND 
                                             `scat_code_1` = '101121';";
                            $que_getCategory = mysqli_query($conn,$v_sql_getCategory);
                                while($RES_getCategory = mysqli_fetch_array($que_getCategory)){
                                    echo "<option value=".$RES_getCategory[0].">".$RES_getCategory[1]."</option>";
                                }
                        echo " </select>
                        
                        <br/><br/>
                    </div>
                    
                </td>
            </tr>
            <tr>
                <td style='width: 150px; font-family:courier; font-size: 16px; text-align: right;'>
                  <b>  Sub Category : </b> <br/><br/>
                </td>
                <td>
                    <div id='divz' style='vertical-align: top; font-family:courier;'>
                         <select class='box_decaretion'  style='width: 200px;'  name='sel_scat03' id='sel_scat03' onkeypress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' >
                            <option value=''> --Select Sub Category 3--</option>
                            
                         </select>
                         <br/><br/>
                    </div>
                </td>
            </tr>
            <tr>
                    <td style='width: 150px; font-family:courier; font-size: 16px; text-align: right;'><b>Request : </b><br/><br/></td>
                    <td>
                        <input class='box_decaretion' type='text'  style='width:400px;' name='txt_issue' id='txt_issue' value='' onKeyPress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' required='required' />
                        <br/><br/>
                    </td>
                  </tr>
                  <tr>
                    <td style='width: 150px; font-family:courier;font-size: 16px; text-align: right; vertical-align: top;'><b>Description :</b></td>
                    <td>
                         <textarea class='box_decaretion' cols='47' rows='4' style='height:100px; width: 400px; font-family: sans-serif;' name='txt_Description' id='txt_Description' onKeyPress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' required='required'></textarea>
                    </td>
                  </tr>
                  <tr>
    <td style='width: 150px; font-family:courier; font-size: 16px; text-align: right;'><b>Attachment :</b></td>
    <td>
       <input class='buttonManage' style='font-family:courier;' type='file' name='fileAttachment' id='fileAttachment' />
    </td>
  </tr>
            </table>
            
                        
          <br/>";
   
       // echo "<input type='button' style='margin-left: 100px;'  class='buttonManage' id='btn_Edit' name='btn_Edit' value='Submit' onclick='isSolution();'/>";     
   echo "<input type='submit'  style='margin-left: 150px;' class='btn btn-success btn-sm ' id='btn_Edit' name='btn_Edit' value='Submit'/>&nbsp;&nbsp;&nbsp;";  
   echo "<input type='button'  style='margin-right: 200px;' class='btn btn-danger btn-sm  ' id='btn_Edit' name='btn_Edit' value='Close' title='Close' onclick='popup(0)'/>";
   echo "<img src='../img/suggestion2.jpeg'  style='width: 180px;height:110px; position: absolute;left: 380px; top: 280px;'/>"; 
        
    echo "</div>";
    echo "<div style='width: 100%;'></div>
     </form>
    </div>";
}

function loadScat3SelectBox($sCat2){
     $conn = DatabaseConnection();
     echo "<select class='box_decaretion'  style='width: 200px;' name='sel_scat03' id='sel_scat03' onkeypress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)' >
                            <option value=''>--Select Sub Catagory 3--</option>";
                         $v_sql_getCategory = "SELECT s.scat_code_3 , s.scat_discr_3
                                                FROM scat_03 AS s 
                                                WHERE s.scat_code_2 = '".$sCat2."'
                                                    and s.scat_state_3 = 1 
                                                    and s.isDisplay = 1;";
                            $que_getCategory = mysqli_query($conn,$v_sql_getCategory);
                                while($RES_getCategory = mysqli_fetch_array($que_getCategory)){
                                    echo "<option value=".$RES_getCategory[0].">".$RES_getCategory[1]."</option>";
                                }
                            
    echo "</select>";
}
?>