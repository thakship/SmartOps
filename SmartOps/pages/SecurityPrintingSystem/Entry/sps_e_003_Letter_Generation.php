<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Security Printing System
Page Name		: Letter Generation
Purpose			: This process takes the Letter Type and the Maturity Date as an input.
Author			: Madushan Wikramaarachchi
Date & Time		: 08.44 A.M 23/04/2015
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="sps/e/003";
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
    include('../SPS_DEVELOPMENT/PHP_FUNCTION/SPS_php_function.php');
	//include('ajax_Gried.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Letter Generation</title>
<!-- Common function Libariries -->
<!-- CSS-->
    <link rel="stylesheet" type="text/css" href="../../../CSS/globleCSS.css"/>
    <link rel="stylesheet" type="text/css" href="../SPS_DEVELOPMENT/SPS_Style_Sheet.css" />
<style type="text/css">
	#outer{
		visibility: hidden;
		position: fixed;
		left: 0px;
		top:0px;
		width: 100%;
		height: 100%;
		background: #6DA6E4;
		opacity: 0.7;
	}
	#conten{
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
    .container {
    width: 40%;
    height: 40%;
    background: #444;
    margin: 0 auto;
}
.container img.wide {
    max-width: 100%;
    max-height: 100%;
    height: auto;
}
.container img.tall {
    max-height: 100%;
    max-width: 100%;
    width: auto;
}
    
</style>
<!--Javascript-->
<script src="../../../js/commenfunction.js"></script>
<script src="../SPS_DEVELOPMENT/SPS_js_function.js"></script>
<!--END Common fumction Libariries-->
<link rel="stylesheet" href="jquery/jquery-ui.css" />
<script src=" jquery/jquery-1.9.1.js"></script>
<script src="jquery/jquery-ui.js"></script>
<script type="text/javascript">
   $(function() {
        $( "#empappodate1" ).datepicker({dateFormat:"yy-mm-dd"});
    });
    
    function getODBDateProsses(){
     
        var getDate = document.getElementById('empappodate1').value;
        var get_let_types = document.getElementById('sel_sgu_let_types').value;
        var val_user = document.getElementById('txtMyUserID').value;
        var val_DateCurnt = document.getElementById('txtDateCurnt').value;
        var val_U_type = document.getElementById('txt_U_Type').value;
         
        
        if(getDate == ""){
            alert("Select Maturity Date.");
        }else if(get_let_types == ""){
            alert("Select Letter Type.");
        }else if(val_user == ""){
            alert('Undefind User.');
        }else if(val_DateCurnt <= getDate){
             alert('Future days not allowed.');
        }else{
           if(val_U_type == 'U' ){
                var val_txt_u_defiend = document.getElementById('txt_u_defiend').value;
                if(val_txt_u_defiend == ""){
                    alert('Undefind User.');
                    
                }else{
                    
                    var mydate = new Date(val_user);
                    var month = new Array();
                    month[0] = "JAN";
                    month[1] = "FEB";
                    month[2] = "MAR";
                    month[3] = "APR";
                    month[4] = "MAY";
                    month[5] = "JUN";
                    month[6] = "JUL";
                    month[7] = "AUG";
                    month[8] = "SEP";
                    month[9] = "OCT";
                    month[10] = "NOV";
                    month[11] = "DEC";
                
                    var d = new Date(getDate);
                    var n = d.getDate()+'-'+month[d.getMonth()]+'-'+d.getFullYear();
                    //alert(n);
                    
                    var r = confirm('Are you sure you want to Process this?')
                    
                    if (r==true){
                        
                       
                        document.getElementById("sp1").style.display = "inline";
                        
            			$.ajax({ 
            			 
            				type:'POST', 
            				data: {get_LetterTypeCode : get_let_types , get_date : n ,get_User : val_user,d_date : getDate , U_type : val_U_type ,txt_u_defiend : val_txt_u_defiend }, 
            				url: '../SPS_DEVELOPMENT/PHP_FUNCTION/SPS_php_ODF_function.php', 
            				success: function(val_retn) { 
            				    
            				    //alert(val_retn); 
                                document.getElementById("sp1").style.display = "none";
                                document.getElementById('aaaa').innerHTML = val_retn;
                                //pageCloseDefineLetterTypes();
                                document.getElementById('empappodate1').disabled = true;
                                document.getElementById('sel_sgu_let_types').disabled = true;
                                document.getElementById('btnProcess').disabled = true;
                                
            				}
            			});
                    }else{
                        
            			//alert('BBBBB');		
            		}
                }
           }else if(val_U_type == 'G'){
                var val_txt_U_Group = document.getElementById('txt_U_Group').value;
                if(val_txt_U_Group == ""){
                    alert('Undefind User Group.');
                }else{
                    //alert('b');
                    var mydate = new Date(val_user);
                    var month = new Array();
                    month[0] = "JAN";
                    month[1] = "FEB";
                    month[2] = "MAR";
                    month[3] = "APR";
                    month[4] = "MAY";
                    month[5] = "JUN";
                    month[6] = "JUL";
                    month[7] = "AUG";
                    month[8] = "SEP";
                    month[9] = "OCT";
                    month[10] = "NOV";
                    month[11] = "DEC";
                
                    var d = new Date(getDate);
                    var n = d.getDate()+'-'+month[d.getMonth()]+'-'+d.getFullYear();
                    //alert(n);
                    var r = confirm('Are you sure you want to Process this?')
                   
                    if (r==true){
                        document.getElementById("sp1").style.display = "inline";
            			$.ajax({ 
            				type:'POST', 
            				data: {get_LetterTypeCode : get_let_types , get_date : n ,get_User : val_user,d_date : getDate , U_type : val_U_type ,txt_u_defiend : val_txt_U_Group }, 
            				url: '../SPS_DEVELOPMENT/PHP_FUNCTION/SPS_php_ODF_function.php', 
            				success: function(val_retn) { 
            				    //alert(val_retn); 
                                document.getElementById("sp1").style.display = "none";
                                document.getElementById('aaaa').innerHTML = val_retn;
                                //pageCloseDefineLetterTypes();
                                document.getElementById('empappodate1').disabled = true;
                                document.getElementById('sel_sgu_let_types').disabled = true;
                                document.getElementById('btnProcess').disabled = true;
                                
            				}
            			});
                    }else{
            			//alert('BBBBB');		
            		}
                }
           }
        }
            
       
        
    }
    
    function isChangeRowColoerOver(title){
        document.getElementById('tr'+title).style.backgroundColor = "#FDEEEE";
    }
    
    function isChangeRowColoerDown(title){
        document.getElementById('tr'+title).style.backgroundColor = "#FFFFFF";
    }
    function getUserNemeFunction(){
        var val_sel = document.getElementById('sel_sgu_let_types').value;
        getdata= new XMLHttpRequest();
        getdata.onreadystatechange=function(){
            if(getdata.readyState==4){
                document.getElementById('span_data').innerHTML=getdata.responseText;      
                var get_bac_date = document.getElementById('getDDD').value;
                if(get_bac_date != ""){
                    document.getElementById('empappodate1').value = get_bac_date;
                }
                
            }
        }
        getdata.open("GET","../SPS_DEVELOPMENT/PHP_FUNCTION/SPS_Ajax.php"+"?var_lgppp_val_sel="+val_sel,true);
        getdata.send();
    }
   
    function getAcceessLeval(){
        var val_U_Type = document.getElementById('txt_U_Type').value;
        if(val_U_Type == 'U'){
            document.getElementById("span_user_difind").style.display = "inline";
            document.getElementById("span_user_Source").style.display = "none";
        }else if(val_U_Type == 'G'){
            document.getElementById("span_user_Source").style.display = "inline";
            document.getElementById("span_user_difind").style.display = "none";
        }   
    }
    function popup(x){
		if(x==1){
			var mydataGried;
			mydataGried= new XMLHttpRequest();
			mydataGried.onreadystatechange=function(){
				if(mydataGried.readyState==4){
					document.getElementById('getGried').innerHTML=mydataGried.responseText;  
					document.getElementById('outer').style.visibility = "visible";
					document.getElementById('conten').style.visibility = "visible";           
				}
			}
			mydataGried.open("GET","ajax_Gried.php"+"?sr_gried="+x,true);
			mydataGried.send();
			/*document.getElementById('outer').style.visibility = "visible";
			document.getElementById('conten').style.visibility = "visible";*/
		
	  }else{
		document.getElementById('outer').style.visibility = "hidden";
		document.getElementById('conten').style.visibility = "hidden";
	  }	
	}
    function selectDB(xx){
			var id1 = document.getElementById('txt1'+xx).value;
			var id2 = document.getElementById('txt2'+xx).value;
			document.getElementById('txt_u_defiend').value = id1;
			document.getElementById('lbl_user_name').innerHTML = id2;
	}
     function fileSelect(){
		var mydata5;
		mydata5= new XMLHttpRequest();
		mydata5.onreadystatechange=function(){
			if(mydata5.readyState==4){
				document.getElementById('getNewtblPopup').innerHTML=mydata5.responseText;
			}
		}
		var searchup=document.getElementById('popupsearch').value;
		mydata5.open('GET','ajaxEntryPopu1.php'+'?txtsearch='+searchup,true);
		mydata5.send();
    }
</script>


</head>
<body oncontextmenu="return false">
<form action="" method="post" name="schform"  enctype="multipart/form-data"> 
<p class="topline">
<?php 
	echo $_REQUEST['DispName'];
?>
</p><hr/>
<span id="sp1" style="display:none"><img src="../../../img/loading.gif" /></span>
<table>
    <tr>
        <td style="width: 150px; text-align: right;"><label class="linetop">Letter Type Code :</label></td>
        <td>
        	 <?php
        		$sql_sps_let_types = "SELECT `TYPE_CODE`, `TYPE_DESC` FROM `sps_let_types` WHERE `TYPE_CODE` = 'RLET' ;";
                $quary_sps_let_types = mysqli_query($conn,$sql_sps_let_types);
            ?>
            <select class="box_decaretion" name="sel_sgu_let_types" id="sel_sgu_let_types" onkeyup="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onchange="getUserNemeFunction()">
            <option value="">--Select Letter Type--</option>
            <?php
                while ($rec_sps_let_types = mysqli_fetch_array($quary_sps_let_types)) {
                    echo "<option value='".$rec_sps_let_types[0]."'>".$rec_sps_let_types[1]."</option>";
                }
            ?>
            </select>
            <span id="span_data"></span>
        </td>
    </tr>
    <tr>
        <td style="width: 150px; text-align: right;"><label class="linetop">Maturity Date :</label></td>
        <td>
        	 <input class="box_decaretion" style="width: 100px;"  name="empappodate1" type="text"  id="empappodate1" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeypress="return disableEnterKey(event)" required="required"/>
        </td>
    </tr>
    <tr>
        <td style="width: 150px; text-align: right;"><label class="linetop">User Type:</label></td>
        <td>
            <select class="box_decaretion" name="txt_U_Type" id="txt_U_Type" onkeyup="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onchange="getAcceessLeval();">
                <option value="U">User Difind</option>
                <option value="G">User Group</option>
            </select>
        </td>
    </tr>
     <tr>
        <td style="width: 150px; text-align: right;"><label class="linetop">User Source</label></td>
        <td>
            <span id="span_user_difind">
                <input class="box_decaretion" style="width: 100px;"  name="txt_u_defiend" type="text"  id="txt_u_defiend" onclick="popup(1);" value="<?php echo $_SESSION['user']; ?>" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeypress="return disableEnterKey(event)" readonly="readonly"/>
                <label id="lbl_user_name"><?php echo $_SESSION['userID']; ?></label>
            </span>
            <span id="span_user_Source" style="display: none;">
                <select class="box_decaretion" name="txt_U_Group" id="txt_U_Group" onkeyup="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onchange="getUserNemeFunction()">
                    <option value="">--Select User Group--</option>
                    <?php 
                        $sql_uerGroup = "SELECT `usergroupNumber`,`usergroupName` FROM `usergroup` WHERE `sps_ath_print`= '1';";
                        $quary_userGroup =  mysqli_query($conn, $sql_uerGroup);
                        while($rec_userGroup = mysqli_fetch_array($quary_userGroup)){
                            echo "<option value='".$rec_userGroup[0]."'>".$rec_userGroup[1]."</option>";
                        }
                    ?>
                    
                   
                </select>
            </span>
        </td>
    </tr>
</table><br />
<div style="display: none;">
    <input type="text" id="txtMyUserID" name="txtMyUserID" value="<?php echo $_SESSION['user']; ?>" onkeypress="return disableEnterKey(event)" />
    <input type="text" id="txtsqe" name="txtsqe" value="" onkeypress="return disableEnterKey(event)" />
    <?php
        $sql_p = "SELECT `currentDate` FROM `systemdate` WHERE `index`='1'";
        $add_p = mysqli_query($conn,$sql_p);
        while ($rec_p = mysqli_fetch_array($add_p)){
            $CURRENT_DATE = $rec_p[0];
        }
    ?>
      <input type="text" id="txtDateCurnt" name="txtDateCurnt" value="<?php echo $CURRENT_DATE; ?>" onkeypress="return disableEnterKey(event)" />
</div>
<div style="margin-left: 100px;">
     <input class="buttonManage" style="width: 100px;" type="button" name="btnProcess" id="btnProcess" value="Process" onclick="getODBDateProsses();"/>
     <input class="buttonManage" style="width: 100px;" type="button" name="btnClose" id="btnClose" value="Close" onclick="pageClose();"/>
</div>
<hr />
<div id="aaaa">
    <table border='1' cellpadding='0' cellspacing='0'  id='myTable' style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;margin-left: 50px;'>
   	    <tr style='background-color: #BEBABA;'>
            <td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>Letter Type</span></td>
            <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>Batch Number</span></td>
            <td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>Generated By</span></td>
            <td style='width:150px; text-align: left;'><span style='margin-left: 5px;'>Generated (Date/Time)</span></td>
            <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>Num. of Entries</span></td>
        </tr>
        <tr id="tr1" title="1" onmouseover="isChangeRowColoerOver(title);" onmouseout="isChangeRowColoerDown(title);">
            <td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>&nbsp;</span></td>
            <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>&nbsp;</span></td>
            <td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>&nbsp;</span></td>
            <td style='width:150px; text-align: left;'><span style='margin-left: 5px;'>&nbsp;</span></td>
            <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'>&nbsp;</span></td>
        </tr>
    </table>
</div>
<!-- ****************************************************************************************************************************************************** -->
<span id="getGried"></span>
</form>
</body>
</html>

