<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Helpdesk
Page Name		: Service Request Acknowledge
Purpose			: do Service Request Acknowledgement
Author			: Madushan Wikramaarachchi
Date & Time		: 02.25 P.M 16/01/2015
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="hel/e/004";
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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Service Request Acknowledge</title>
<!-- Common function Libariries -->
<!-- CSS-->
    <link rel="stylesheet" type="text/css" href="../../../CSS/globleCSS.css"/>
    <link rel="stylesheet" type="text/css" href="../helpdesk_DEVELOPMENT/CSS/helpdesk_Style_Sheet.css"/>
<!--Javascript-->
<script src="../../../js/commenfunction.js"></script>
<script src="../helpdesk_DEVELOPMENT/JAVASCRIPT_FUNCTION/helpdesk_js_function.js"></script>
<!--END Common fumction Libariries-->
<style type="text/css">
    #outer1{
		visibility: hidden;
		position: fixed;
		left: 0px;
		top:0px;
		width: 100%;
		height: 100%;
		background: #6DA6E4;
		opacity: 0.7;
	}
	#conten1{
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
//	parent.location.href = parent.location.href;
    window.open('http://cdberp:8080/cdb/pages/helpdesk/Entry/serviceRequsetAcknowlege.php?DispName=SR%20Acknowledge','conectpage');
}
function isSubmitAct(title){
    var [m,n,b]= title.split('|');
    var m1 = [m];
    var n1 = [n];
    var b1 = [b];
    var gethID = document.getElementById(m1).value;
    var getrmk = document.getElementById(n1).value;
    var getUser = document.getElementById('txtuser').value;
     var getsco= document.getElementById(b1).value;
    var r = confirm('Are you sure you want to Submit this?')
    if (r==true){
		$.ajax({ 
			type:'POST', 
			data: {atchid : gethID , atcgetrmk : getrmk, atcUsre : getUser, actSco : getsco}, 
			url: '../helpdesk_DEVELOPMENT/PHP_FUNCTION/helpdesk_php_function.php', 
			success: function() { 
			 alert('updated success!'); 
             pageClose();
			}
		});	
    }else{
		//alert('BBBBB');		
	}
    //alert(gethID);
    //alert(getrmk);
}

function isReOpen(title){
    //alert(title);
    var [m,n,b]= title.split('|');
    var m1 = [m];
    var n1 = [n];
    var b1 = [b];
    var gethID1 = document.getElementById(m1).value;
    var getrmk1 = document.getElementById(n1).value;
    var getUser1 = document.getElementById('txtuser').value;
    var getsco1= document.getElementById(b1).value;
    //var SolvedByID = document.getElementById('span_id').innerHTML;
   var r = confirm('Are you sure you want to Re-open this?')
    if (r==true){
		$.ajax({ 
			type:'POST', 
			data: {atchid1 : gethID1 , atcgetrmk1 : getrmk1, atcUsre1 : getUser1, actSco1 : getsco1}, 
			url: '../helpdesk_DEVELOPMENT/PHP_FUNCTION/helpdesk_php_function.php', 
			success: function() { 
			 //document.getElementById('maneSpan').innerHTML = data;
			 alert('updated success!'); 
             pageClose();
			}
		});	
    }else{
		//alert('BBBBB');		
	}
}

// Develop Madushan - 2017-11-14

function is_getScat_01(getID,getTitle){
    var getCat = document.getElementById(getID).value;
    var cat1 = document.getElementById('sel_catagory').value;
    var cat2 = document.getElementById('sel_scat01').value;
    var cat3 = document.getElementById('sel_scat02').value;
    if(getTitle == 1){
        var divID = 'diva';
    }
    if(getTitle == 2){
        var divID = 'divb';
        
    }
    if(getTitle == 3){
        var divID = 'divc';
        
    }
    if(getTitle == 4){
        var divID = 'divz';
        
    }
    if(getCat == "" &&  getTitle == 1){
        document.getElementById('sel_scat01').value = "";
        document.getElementById('sel_scat02').value = "";
        document.getElementById('sel_scat03').value = "";
        document.getElementById('sel_scat01').disabled = true; 
        document.getElementById('sel_scat02').disabled = true;
        document.getElementById('sel_scat03').disabled = true; 
    }else if(getCat == "" &&  getTitle == 2){
        document.getElementById('sel_scat02').value = "";
        document.getElementById('sel_scat02').disabled = true;
        document.getElementById('sel_scat03').value = "";
        document.getElementById('sel_scat03').disabled = true; 
    }else if(getCat == "" &&  getTitle == 3){
        document.getElementById('txt_Department').value = "";
        document.getElementById('txt_Department').disabled = true; 
    }else{
        var mydata;
        mydata= new XMLHttpRequest();
        mydata.onreadystatechange=function(){
            if(mydata.readyState==4){
                document.getElementById(divID).innerHTML=mydata.responseText;
                if(getTitle == 1){
                   document.getElementById('sel_scat02').value = "";
                   document.getElementById('sel_scat02').disabled = true; 
                    document.getElementById('sel_scat03').value = "";
                   document.getElementById('sel_scat03').disabled = true;
                } 
                if(getTitle == 2){
                    document.getElementById('sel_scat03').value = "";
                   document.getElementById('sel_scat03').disabled = true;
                } 
                if(getTitle == 4){
                    //alert('OK');
                                        
                    var mydatais;
            		mydatais= new XMLHttpRequest();
            		mydatais.onreadystatechange=function(){
            			if(mydatais.readyState==4){
            				document.getElementById('get_issue').innerHTML=mydatais.responseText;
            			}
            		}
            		mydatais.open("GET","../helpdesk_DEVELOPMENT/PHP_FUNCTION/helpdesk_Ajax.php"+"?getIss_templet="+getCat+"&get_status="+getTitle+"&getcatCodeSelect="+cat1,true);
            		mydatais.send();
                    
                }           
                     
            }
        }
        mydata.open("GET","ajax_serviceRequset_01.php"+"?txt1="+getCat+"&txt2="+getTitle,true);
        mydata.send();
    }
    
}
function getUser(title){
        //alert('A')
        if(title==1){
			var mydataGried;
			mydataGried= new XMLHttpRequest();
			mydataGried.onreadystatechange=function(){
				if(mydataGried.readyState==4){
					document.getElementById('getGried').innerHTML = mydataGried.responseText;  
					document.getElementById('outer1').style.visibility = "visible";
					document.getElementById('conten1').style.visibility = "visible";           
				}
			}
			mydataGried.open("GET","ajax_Gried.php"+"?isUserLog="+title,true);
			mydataGried.send();
	  }else{
		document.getElementById('outer1').style.visibility = "hidden";
		document.getElementById('conten1').style.visibility = "hidden";
	  }
}
function popup(title){
        //alert('A')
        if(title==1){
			var mydataGried;
			mydataGried= new XMLHttpRequest();
			mydataGried.onreadystatechange=function(){
				if(mydataGried.readyState==4){
					document.getElementById('getGried').innerHTML = mydataGried.responseText;  
					document.getElementById('outer1').style.visibility = "visible";
					document.getElementById('conten1').style.visibility = "visible";           
				}
			}
			mydataGried.open("GET","ajax_Gried.php"+"?isUserLog="+title,true);
			mydataGried.send();
	  }else{
		document.getElementById('outer1').style.visibility = "hidden";
		document.getElementById('conten1').style.visibility = "hidden";
	  }
}
function selectDB(xx){
			var id1 = document.getElementById('txt1'+xx).value;
			var id2 = document.getElementById('txt2'+xx).value;
			//alert(id1);
			//alert(id2);
			document.getElementById('txt_AssignBy').value = id1;
			document.getElementById('getAUser').innerHTML = id2;
}

 function fileSelect(){
      //alert('B')
		var mydata5;
		mydata5= new XMLHttpRequest();
		mydata5.onreadystatechange=function(){
			if(mydata5.readyState==4){
				document.getElementById('getNewtblPopup').innerHTML=mydata5.responseText;
			}
		}
		var searchup = document.getElementById('popupsearch').value;
		mydata5.open('GET','ajaxEntryPopu1.php'+'?txtsearch='+searchup,true);
		mydata5.send();
  }
  
   function isSelectSRReport(){
        
        var date1 = document.getElementById('empappodate1').value;
        var date2 = document.getElementById('empappodate2').value;
       
        var cat_m = document.getElementById('sel_catagory').value;
        var cat1 = document.getElementById('sel_scat01').value;
        var cat2 = document.getElementById('sel_scat02').value;
        var cat3 = document.getElementById('sel_scat03').value
        
        var asingUer = document.getElementById('txt_AssignBy').value;
        
         var getUserBranch = document.getElementById('txtuserBranch').value;
          var getUserDepartment = document.getElementById('txtuserDepartment').value;
        
         
        
  	    var r = 1;
        mydata= new XMLHttpRequest();
        mydata.onreadystatechange=function(){
            if(mydata.readyState==4){
                //alert('a');
                document.getElementById('maneSpan').innerHTML=mydata.responseText;           
            }
        }
        mydata.open("GET","ajax_serviceRequsetAcknowlege.php"+"?getSRReoptDate1="+date1+"&getSRReoptDate2="+date2+"&getcat_m="+cat_m+"&getcat1="+cat1+"&getcat2="+cat2+"&getcat3="+cat3+"&getAsingUer="+asingUer+"&isgetUserBranch="+getUserBranch+"&isgetUserDepartment="+getUserDepartment,true);
        
        mydata.send();
      
 }
</script>
<script>
  $(function() {
    $( "#empappodate1" ).datepicker({dateFormat:"yy-mm-dd"});
  });
  $(function() {
    $( "#empappodate2" ).datepicker({dateFormat:"yy-mm-dd"});
  });
</script>

</head>
<body oncontextmenu="return false">
<form action="" method="post" name="schform" enctype="multipart/form-data"> 
<p class="topline">
<?php 
	echo $_REQUEST['DispName'];
?>
</p><hr/>


<table>
  <tr>
    <td style="width: 100px; text-align: right;"><label class="linetop">&nbsp;</label></td>
    <td>
         <select class="box_decaretion"  style="width: 200px;margin-right: 5px;" name="sel_catagory" id="sel_catagory" onkeypress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" title="1" onchange="is_getScat_01(this.id,title);">
            <option value="">--Select Catagory --</option>
            <?php
                $v_sql_getCategory = "SELECT c.cat_code , c.cat_discr 
                                      FROM cat_states AS c 
                                      WHERE c.car_state = '1' AND 
                                             c.isDisplay = 1 AND
                                              c.cat_code !='1014';";
                $que_getCategory = mysqli_query($conn,$v_sql_getCategory);
                while($RES_getCategory = mysqli_fetch_array($que_getCategory)){
                    echo "<option value=".$RES_getCategory[0].">".$RES_getCategory[1]."</option>";
                }
            ?>
         </select>
    </td>
    <td>
        <div id="diva">
             <select class="box_decaretion"  style="width: 200px;margin-right: 5px;" name="sel_scat01" id="sel_scat01" onkeypress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" disabled="disabled">
                <option value="">--Select Sub Catagory 1--</option>
             </select>
         </div>
    </td>
    <td>
        <div id="divb">
             <select class="box_decaretion"  style="width: 200px;margin-right: 5px;" name="sel_scat02" id="sel_scat02" onkeypress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" disabled="disabled">
                <option value="">--Select Sub Catagory 2--</option>
             </select>
        </div>
    </td>
    <td>
        <div id="divz">
             <select class="box_decaretion"  style="width: 200px;" name="sel_scat03" id="sel_scat03" onkeypress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" disabled="disabled">
                <option value="">--Select Sub Catagory 3--</option>
             </select>
        </div>
    </td>
  </tr>
</table>
<br />
<table>
     <tr>
        <td style="text-align: right;width:115px;"><label class="linetop">Entry By :</label></td>
        <td style="text-align:left;">
        	<input type="text" class="box_decaretion" name="txt_AssignBy" id="txt_AssignBy" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeypress="return disableEnterKey(event)" title="1" onclick="getUser(title);"/>
            <span id="getAUser"></span>
        </td>
      </tr>
</table>
<table>
     <tr>
        <td style="text-align: left;width:115px;"><label class="linetop">Solved From (Date) :</label></td>
        <td style="text-align:left;width:100px;">
        	<input class="box_decaretion"  name="empappodate1" type="text"  id="empappodate1" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeypress="return disableEnterKey(event)"/>
        </td>
        <td style="text-align:right; width:100px;"><label class="linetop">Solved To (Date) :</label></td>
        <td style="text-align:left;width:100px;">
        	<input class="box_decaretion"  name="empappodate2" type="text"  id="empappodate2" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeypress="return disableEnterKey(event)"/>
        </td>
      </tr>
</table>
<br/>
<div style="margin-left: 100px;">
<input type="button" style="width: 100px;" class='buttonManage' name="getSQLDate" id="getSQLDate" value="Select" onclick="isSelectSRReport()" />
<input type="button" style="width: 100px;" class="buttonManage" id="btnClose" name="btnClose" value="Close" onclick="pageClose()"/>
</div>
<hr />
<span id="maneSpan">
<?php
   $v_sql_select = "SELECT `cdb_helpdesk`.`helpid`, 
                           `cdb_helpdesk`.`issue`,  
                           DATE(`cdb_helpdesk`.`enterDateTime`) AS enDate,  
                           `cdb_helpdesk`.`solved_by`, 
                           DATE(`cdb_helpdesk`.`solved_on`) AS svDate , 
                           `cdb_helpdesk`.`entry_branch` AS entry_branch  , 
                           `cdb_helpdesk`.`enterBy` AS enterBy , 
                            `scat_02`.scat_discr_2 AS sca
                    FROM `cdb_helpdesk` ,scat_02
                    WHERE  `cdb_helpdesk`.scat_code_2 = scat_02.scat_code_2 AND
                           `cdb_helpdesk`.`cmb_code` = '5002' AND 
                           `cdb_helpdesk`.`cat_code` != '1014' AND 
                           `cdb_helpdesk`.`entry_branch` = '".$_SESSION['userBranch']."' AND 
                           `cdb_helpdesk`.`entry_department` = '".$_SESSION['userDepartment']."';";
    //echo     $v_sql_select;   
?>
<table border="1" id="myTable" style="background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;">
            <tr style="background-color: #BEBABA;">
                <td style="width:60px;"><span style="margin-right: 5px;">Help ID</span></td>
                <td style="width:250px;"><span  style="margin-left: 5px;">Issue</span></td>
                <td style="width:150px;"><span  style="margin-left: 5px;">Sub Cat 2</span></td>
                <td style="width:80px;"><span style="margin-right: 5px;">Entry by</span></td>
                <td style="width:80px;"><span style="margin-right: 5px;">Entry Date</span></td>
                 <td style="width:80px;"><span style="margin-right: 5px;">Solved Date</span></td>
                <td style="width:80px;"><span style="margin-right: 5px;">Solved by</span></td>
                <td style="width:150px;"><span style="margin-right: 5px;">Remark</span></td>
                <td style="width:60px;"></td>
                <td style="width:200px;"></td>
            </tr>
<?php
                 
    $v_que_select = mysqli_query($conn,$v_sql_select);
    $index = 0;
    
    while($res_Select = mysqli_fetch_assoc($v_que_select)){
        $index++;
        $getuserName = "";
        if($index%2 == 1){
            $col = "#FFFFFF";
        }else{
             $col = "#FFFFFF";
        }
        $sql_userName = "SELECT `userID` FROM `user` WHERE `userName` = '".$res_Select['solved_by']."';";
        $que_userName = mysqli_query($conn,$sql_userName);
        while($RSE_userName = mysqli_fetch_assoc($que_userName)){
            $getuserName = $RSE_userName['userID'];
        }
        $sql_userName1 = "SELECT `userID` FROM `user` WHERE `userName` = '".$res_Select['enterBy']."';";
        $que_userName1 = mysqli_query($conn,$sql_userName1);
        while($RSE_userName1 = mysqli_fetch_assoc($que_userName1)){
            $getuserName1 = $RSE_userName1['userID'];
        }
        echo "<tr style='background-color: ".$col.";'>";
        echo "<td style='width:60px; text-align: right;'><div style='display: none;'><input type='text' name='txtclose".$index."' id='txtclose".$index."' value='".$res_Select['helpid']."'  onKeyPress='return disableEnterKey(event)'/></div><span  style='margin-right: 5px;'>".$res_Select['helpid']."</span></td>";
        echo "<td style='width:250px; text-align: left;'><span  style='margin-left: 5px;'>".$res_Select['issue']."</span></td>";
        
        echo "<td style='width:250px; text-align: left;'><span  style='margin-left: 5px;'>".$res_Select['sca']."</span></td>";
        
        echo "<td style='width:80px; text-align: left;' title='".$getuserName1."'><span id='span_id' style='margin-left: 5px;'>".$res_Select['enterBy']."</span></td>";
        echo "<td style='width:80px; text-align: right;'><span  style='margin-right: 5px;'>".$res_Select['enDate']."</span></td>";
        echo "<td style='width:80px; text-align: left;'><span  style='margin-left: 5px;'>".$res_Select['svDate']."</span></td>";
        echo "<td style='width:80px; text-align: left;' title='".$getuserName."'><span id='span_id' style='margin-left: 5px;'>".$res_Select['solved_by']."</span></td>";
        echo "<td style='width:150px; text-align: left;'><input type='text' style='width:150px;' name='txtremark".$index."' id='txtremark".$index."' value=''  onKeyPress='return disableEnterKey(event)'/></td>";
         echo "<td style='width:60px;'>
                    <select class='box_decaretion'  style='width: 50px;' name='sel_atc".$index."' id='sel_atc".$index."' onKeyPress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)'>
                    <option value='0'>0</option>
                    <option value='1'>1</option>
                    <option value='2'>2</option>
                    <option value='3'>3</option>
                    <option value='4'>4</option>
                    <option value='5'>5</option>
             </select>
                </td>";
        echo "<td style='width:200px;'>
                <input type='button' class='buttonManage' id='btn_ReOpen' name='btn_ReOpen' value='Re-open' title='txtclose".$index."|txtremark".$index."|sel_atc".$index."' onclick='isReOpen(title);'/>
                <input type='button' class='buttonManage' id='btn_Atc' name='btn_Atc' value='Submit' title='txtclose".$index."|txtremark".$index."|sel_atc".$index."' onclick='isSubmitAct(title);'/>
            </td>";
        echo "</tr>";
    }
?>
</table>
</span>
<span id="getGried"></span> 
<div style="display: none;">
   <input type="text" name="txtuser" id="txtuser" value="<?php echo $_SESSION['user']; ?>"  onKeyPress="return disableEnterKey(event)"/>
   <input type="text" name="txtuserBranch" id="txtuserBranch" value="<?php echo $_SESSION['userBranch']; ?>"  onKeyPress="return disableEnterKey(event)"/>
   <input type="text" name="txtuserDepartment" id="txtuserDepartment" value="<?php echo $_SESSION['userDepartment']; ?>"  onKeyPress="return disableEnterKey(event)"/>
</div>


</form>
</body>
</html>

