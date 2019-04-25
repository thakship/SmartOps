<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Security Printing System
Page Name		: Security Printing Authorization
Purpose			: This process allows to define amount slabs for each letter type and assign a Signatory Group code for each amount slab.
Author			: Madushan Wikramaarachchi
Date & Time		: 01.12 P.M 27/04/2015
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="sps/a/001";
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
<title>Security Printing Authorization</title>
<!-- Common function Libariries -->
<!-- CSS-->
    <link rel="stylesheet" type="text/css" href="../../../CSS/globleCSS.css"/>
    <link rel="stylesheet" type="text/css" href="../SPS_DEVELOPMENT/SPS_Style_Sheet.css" />
<style type="text/css">
	
</style>
<!--Javascript-->
<script src="../../../js/commenfunction.js"></script>
<script src="../SPS_DEVELOPMENT/SPS_js_function.js"></script>
<!--END Common fumction Libariries-->
<link rel="stylesheet" href="jquery/jquery-ui.css" />
<script src=" jquery/jquery-1.9.1.js"></script>
<script src="jquery/jquery-ui.js"></script>
<script type="text/javascript">
    function isGetRecordGriedCBL05(){
        var var_aa = document.getElementById('is_var_ff').value;
        var var_user = document.getElementById('is_var_user').value;
        var r = confirm('Are you sure you want to authorized this?')
        if (r==true){
          //alert(var_aa+"--"+var_bb+"--"+var_ee+"--"+var_ff+"--"+var_user);
	      $.ajax({ 
				type:'POST', 
				data: {get_spa_Batch_Numbercbl05 : var_aa ,get_spa_usercbl05 : var_user }, 
				url: '../SPS_DEVELOPMENT/PHP_FUNCTION/SPS_php_function.php', 
				success: function(val_retn) { 
				    alert(val_retn); 
                    //document.getElementById('aaaa').innerHTML=val_retn;
                    pageCloseSecurityPrintinAuthorization();
				}
			});	
        }else{
			//alert('BBBBB');		
		}
        
    }


    
    function isGetRecordGried(){
       // alert(title);
        var var_aa = document.getElementById('is_var_aa').value;
        var var_bb = document.getElementById('is_var_bb').value;
        var var_ee = document.getElementById('is_var_ee').value;
        var var_ff = document.getElementById('is_var_ff').value;
        var var_user = document.getElementById('is_var_user').value;
        var r = confirm('Are you sure you want to authorized this?')
        if (r==true){
          //alert(var_aa+"--"+var_bb+"--"+var_ee+"--"+var_ff+"--"+var_user);
	      $.ajax({ 
				type:'POST', 
				data: {get_spa_Letter_Type : var_aa , get_spa_Batch_Number : var_bb , get_spa_Amount_Slab_001 : var_ee , val_spa_Amount_Slab_002 : var_ff ,get_spa_user : var_user }, 
				url: '../SPS_DEVELOPMENT/PHP_FUNCTION/SPS_php_function.php', 
				success: function(val_retn) { 
				    alert(val_retn); 
                    //document.getElementById('aaaa').innerHTML=val_retn;
                    pageCloseSecurityPrintinAuthorization();
				}
			});	
        }else{
			//alert('BBBBB');		
		}
    }
    
    function isGetRecordGriedpo(){
       // alert(title);
        var var_aa = document.getElementById('is_var_aa').value;
        var var_bb = document.getElementById('is_var_bb').value;
        var var_ee = document.getElementById('is_var_ee').value;
        var var_ff = document.getElementById('is_var_ff').value;
        var var_gg = document.getElementById('is_var_gg').value;
        
        
        var r = confirm('Are you sure you want to authorized this?')
        if (r==true){
         //alert(var_aa+"--"+var_bb+"--"+var_ee+"--"+var_ff+"--"+var_gg);
	     $.ajax({ 
				type:'POST', 
				data: {get_spa_CBD_PO : var_aa , get_spa_Amount_Slab_001_PO : var_bb , val_spa_Amount_Slab_002_PO : var_ee , var_user_PO_auth : var_ff , var_PO_type : var_gg}, 
				url: '../SPS_DEVELOPMENT/PHP_FUNCTION/SPS_php_function.php', 
				success: function(val_retn) { 
				    alert(val_retn); 
                    //document.getElementById('aaaa').innerHTML=val_retn;
                    pageCloseSecurityPrintinAuthorization();
				}
			});
        }else{
			//alert('BBBBB');		
		}
    }
    
    function isGetRecordGriedNewpo(title){
        //alert('a');
        var var_aa = document.getElementById('is_var_aa').value;
        var var_bb = document.getElementById('is_var_bb').value;
        var var_ee = document.getElementById('is_var_ee').value;
        var var_ff = document.getElementById('is_var_ff').value;
        var var_gg = document.getElementById('is_var_gg').value;
        var facNo = "";
        
        for(var i = 1 ; i <= title ; i++){
            var isStatus = document.getElementById("chka"+i).checked;
            //alert(isStatus);
            if(isStatus == true){
                //alert(i);
                facNo = facNo+document.getElementById('txtFacNo'+i).value+"|";
                //alert(facNo);
            }
        }
        
        var r = confirm('Are you sure you want to authorized this?')
        if (r==true){
         //alert(var_aa+"--"+var_bb+"--"+var_ee+"--"+var_ff+"--"+var_gg);
	     $.ajax({ 
				type:'POST', 
				data: {get_spa_CBD_new_PO : var_aa , get_spa_Amount_Slab_001_new_PO : var_bb , val_spa_Amount_Slab_002_new_PO : var_ee , var_user_PO_new_auth : var_ff , var_PO_new_type : var_gg , var_facNo : facNo}, 
				url: '../SPS_DEVELOPMENT/PHP_FUNCTION/SPS_php_function.php', 
				success: function(val_retn) { 
				    alert(val_retn); 
                    //document.getElementById('aaaa').innerHTML = val_retn;
                    pageCloseSecurityPrintinAuthorization();
				}
			});
        }else{
			//alert('BBBBB');		
		}
    }
    
    function isGetauthBC(title){
          var var_auth = document.getElementById('is_var_user').value;
          var txtV_INDEX = "";
        
        for(var i = 1 ; i <= title ; i++){
            var isStatus = document.getElementById("chka"+i).checked;
            //alert(isStatus);
            if(isStatus == true){
                //alert(i);
                txtV_INDEX = txtV_INDEX+document.getElementById('txtV_INDEX'+i).value+"|";
                //alert(facNo);
            }
        }
        
        var r = confirm('Are you sure you want to authorized this?')
        if (r==true){
         //alert(var_aa+"--"+var_bb+"--"+var_ee+"--"+var_ff+"--"+var_gg);
	     $.ajax({ 
				type:'POST', 
				data: {var_user_BC_new_auth : var_auth ,  var_BC_txtV_INDEX : txtV_INDEX}, 
				url: '../SPS_DEVELOPMENT/PHP_FUNCTION/SPS_php_function.php', 
				success: function(val_retn) { 
				    alert(val_retn); 
                    //document.getElementById('aaaa').innerHTML = val_retn;
                    pageCloseSecurityPrintinAuthorization();
				}
			});
        }else{
			//alert('BBBBB');		
		}
    }
    
    function isGetauthCommon(title){
        var arrayres = title.split("|");
          var var_auth = document.getElementById('is_var_user').value;
          var txtV_INDEX = "";
        
        for(var i = 1 ; i <= arrayres[0] ; i++){
            var isStatus = document.getElementById("chka"+i).checked;
            //alert(isStatus);
            if(isStatus == true){
                //alert(i);
                txtV_INDEX = txtV_INDEX+document.getElementById('txtV_INDEX'+i).value+"|";
                //alert(facNo);
            }
        }
        
        var r = confirm('Are you sure you want to authorized this?')
        if (r==true){
         //alert(var_aa+"--"+var_bb+"--"+var_ee+"--"+var_ff+"--"+var_gg);
	     $.ajax({ 
				type:'POST', 
				data: {var_user_authby : var_auth ,  var_INDEX_comen : txtV_INDEX , com_typeCode : arrayres[1] }, 
				url: '../SPS_DEVELOPMENT/PHP_FUNCTION/SPS_php_function.php', 
				success: function(val_retn) { 
				    alert(val_retn); 
                    //document.getElementById('aaaa').innerHTML = val_retn;
                    pageCloseSecurityPrintinAuthorization();
				}
			});
        }else{
			//alert('BBBBB');		
		}
    }
    function loadNewTableCBL05(title){
     //   var var_batch = document.getElementById('txte'+title).value;
     //   var var_gen_by = document.getElementById('txtc'+title).value;
        var var_CBL05_batch_number = document.getElementById('txtd'+title).value;
        var var_CBL05_user_Id = document.getElementById('txtMyUserID').value;
        //alert(var_batch+"--"+var_gen_by+"--"+var_gen_on+"--"+var_user_Id);
        mydata= new XMLHttpRequest();
        mydata.onreadystatechange=function(){
            if(mydata.readyState==4){
                document.getElementById('aaaa').innerHTML=mydata.responseText;           
            }
        }
        mydata.open("GET","ajx_load_gried.php"+"?var_spa_batchcbl05_approve="+var_CBL05_batch_number+"&var_spa_gen_by_cbl05="+var_CBL05_user_Id,true);
        mydata.send();
        document.getElementById('tr'+title).style.backgroundColor = "#9AE7F0";
    }
    
    function loadNewTable(title){
        var var_batch = document.getElementById('txte'+title).value;
        var var_gen_by = document.getElementById('txtc'+title).value;
        var var_gen_on = document.getElementById('txtd'+title).value;
        var var_user_Id = document.getElementById('txtMyUserID').value;
        //alert(var_batch+"--"+var_gen_by+"--"+var_gen_on+"--"+var_user_Id);
        mydata= new XMLHttpRequest();
        mydata.onreadystatechange=function(){
            if(mydata.readyState==4){
                document.getElementById('aaaa').innerHTML=mydata.responseText;           
            }
        }
        mydata.open("GET","ajx_load_gried.php"+"?var_spa_batch="+var_batch+"&var_spa_gen_by="+var_gen_by+"&var_spa_gen_on="+var_gen_on+"&var_spa_user_Id="+var_user_Id,true);
        mydata.send();
        document.getElementById('tr'+title).style.backgroundColor = "#9AE7F0";
    }
    
    function loadNewTableBC(title){
       // alert("BC");
        var var_date = document.getElementById('txtb'+title).value;
        var var_user_Id = document.getElementById('txtMyUserID').value;
        //alert(var_batch+"--"+var_gen_by+"--"+var_gen_on+"--"+var_user_Id);
        mydata= new XMLHttpRequest();
        mydata.onreadystatechange=function(){
            if(mydata.readyState==4){
                document.getElementById('aaaa').innerHTML=mydata.responseText;           
            }
        }
        mydata.open("GET","ajx_load_gried.php"+"?var_BC_DATE="+var_date+"&var_AUTHBY="+var_user_Id,true);
        mydata.send();
        //document.getElementById('tr'+title).style.backgroundColor = "#9AE7F0";
    }
    
    
    
    function loadNewTableVive(title){
        //alert(title);
        
        var arryres = title.split("|");
        var var_date = document.getElementById('txtb'+arryres[0]).value;
        var var_user_Id = document.getElementById('txtMyUserID').value;
        //alert(var_batch+"--"+var_gen_by+"--"+var_gen_on+"--"+var_user_Id);
        mydata= new XMLHttpRequest();
        mydata.onreadystatechange=function(){
            if(mydata.readyState==4){
                document.getElementById('aaaa').innerHTML=mydata.responseText;           
            }
        }
        mydata.open("GET","ajx_load_gried.php"+"?var_request_date="+var_date+"&var_auth_by="+var_user_Id+"&varTypeCoe="+arryres[1],true);
        mydata.send();
        //document.getElementById('tr'+title).style.backgroundColor = "#9AE7F0";
    }
    
    function getAthGried(title){
       var var_aa = document.getElementById('txtaa'+title).value;
       var var_bb = document.getElementById('txtbb'+title).value;
       var var_ee = document.getElementById('txtee'+title).value;
       var var_ff = document.getElementById('txtff'+title).value;
       var var_user = document.getElementById('txtMyUserID').value;
       //alert(var_aa+'--'+var_bb+'--'+var_ee+'--'+var_ff+'--'+var_user);
        mydata1 = new XMLHttpRequest();
        mydata1.onreadystatechange=function(){
            if(mydata1.readyState==4){
                document.getElementById('aaaa').innerHTML=mydata1.responseText;           
            }
        }
        mydata1.open("GET","ajx_load_gried.php"+"?get_var_aa="+var_aa+"&get_var_bb="+var_bb+"&get_var_ee="+var_ee+"&get_var_ff="+var_ff+"&get_var_user="+var_user,true);
        mydata1.send();
    }
    
     function getAthGriedPO(title){
       var var_aa = document.getElementById('txtaa'+title).value;
       //alert(var_aa);
       var var_bb = document.getElementById('txtbb'+title).value;
       var var_ee = document.getElementById('txtee'+title).value;
       var var_ff = document.getElementById('txtff'+title).value;
       var var_user = document.getElementById('txtMyUserID').value;
       
       //alert(var_bb+'--'+var_ee+'--'+var_ff+'--'+var_user);
       mydata1 = new XMLHttpRequest();
        mydata1.onreadystatechange=function(){
            if(mydata1.readyState==4){
                document.getElementById('aaaa').innerHTML=mydata1.responseText;           
            }
        }
        mydata1.open("GET","ajx_load_gried.php"+"?get_var_bb_po="+var_bb+"&get_var_ee_po="+var_ee+"&get_var_ff_po="+var_ff+"&get_var_user_po="+var_user+"&get_var_aa_po="+var_aa,true);
        mydata1.send();
    }
    
     function isChangeRowColoerOverSub(title){
        document.getElementById('trsub'+title).style.backgroundColor = "#FDEEEE";
    }
    
    function isChangeRowColoerDownSub(title){
        document.getElementById('trsub'+title).style.backgroundColor = "#FFFFFF";
    }
    
    function loadNewTablegired(title){
        var var_txttypea = document.getElementById('txttypea'+title).value;
        var vae_txtMyUserID = document.getElementById('txtMyUserID').value;
       // alert(var_txttypea);
       // alert(vae_txtMyUserID);
        mydata2 = new XMLHttpRequest();
        mydata2.onreadystatechange=function(){
            if(mydata2.readyState==4){
                document.getElementById('getAch_gried').innerHTML=mydata2.responseText;           
            }
        }
        if(var_txttypea == "RLET"){
            mydata2.open("GET","ajx_load_gried.php"+"?get_txttypea="+var_txttypea,true);
        }else if(var_txttypea == "PORD" || var_txttypea == "LEPO3W" || var_txttypea == "LEPOGE" || var_txttypea == "HPPO3W" || var_txttypea == "HPPOGE" || var_txttypea == "MOPOLE" || var_txttypea == "UCLEPO" || var_txttypea == "MPOMB"){
            mydata2.open("GET","ajx_load_gried.php"+"?get_txttypeapo="+var_txttypea+"&gettxtMyUserID="+vae_txtMyUserID,true);
        }else{
            mydata2.open("GET","ajx_load_gried.php"+"?get_txttypea="+var_txttypea,true);
        }
        
        mydata2.send();
        
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
<?php
    if (isset($_SESSION['user'])) {

        // it does; output the message
        $usreloguerid = $_SESSION['user'];
    
        
        //unset($_SESSION['registered']);
    }else{
        // remove the key so we don't keep outputting the message
        unset($_SESSION['user']);
    }
    $sql_count_access = "SELECT COUNT(*) FROM sps_sig_groups_users AS sgu WHERE sgu.USER_ID = '".$usreloguerid."';";
    $que_count_access = mysqli_query($conn,$sql_count_access) or die(mysqli_error());
    while($rec_count_access = mysqli_fetch_array($que_count_access)){
        if($rec_count_access[0] != 0){
?>
<div style="display: none;">
    <input type="text" id="txtMyUserID" name="txtMyUserID" value="<?php echo $usreloguerid; ?>" onkeypress="return disableEnterKey(event)" />
</div>
<br />
<table>
    <tr>
        <td style="width: 150px; text-align: right;"><label class="linetop">User :</label></td>
        <td>
        	<?php
                $sql_UserName = "SELECT u.userID FROM `user` AS u WHERE u.userName = '".$usreloguerid."';";
                $que_UserName = mysqli_query($conn,$sql_UserName) or die(mysqli_error());
                while($res_UserName = mysqli_fetch_array($que_UserName)){
                    echo $usreloguerid." - ".$res_UserName[0];
                }
            ?>
        </td>
    </tr>
</table>
<br />
<div id="getAch_gried">
<table border='1' cellpadding='0' cellspacing='0'  id='myTable' style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;margin-left: 50px;'>
   	    <tr style='background-color: #BEBABA;'>
            <td style='width:150px; text-align: left;'><span style='margin-left: 5px;'>Letter Code</span></td>
            <td style='width:250px; text-align: left;'><span style='margin-left: 5px;'>Letter Type</span></td>
            <td style='width:100px; text-align: left;'><span style='margin-left: 5px;'></span></td>
        </tr>
        <?php
            $sql_select_type = "SELECT `TYPE_CODE`,`TYPE_DESC` FROM `sps_let_types`;";
            $que_select_type = mysqli_query($conn,$sql_select_type) or die(mysqli_error());
            $v = 0;
            while($rec_select_type = mysqli_fetch_assoc($que_select_type)){
                $v++;
               echo "<tr style='background-color: #FFFFFF;' title='".$v."' onclick='loadNewTablegired(title);'>";
               echo "<td style='width:150px; text-align: left;'><span style='margin-left: 5px;'>".$rec_select_type['TYPE_CODE']."</span><span style='display: none;'><input type='text' name='txttypea".$v."' id='txttypea".$v."' value='".$rec_select_type['TYPE_CODE']."' onkeypress='return disableEnterKey(event)' readonly='readonly' /></span></td>
            <td style='width:250px; text-align: left;'><span style='margin-left: 5px;'>".$rec_select_type['TYPE_DESC']."</span><span style='display: none;'><input type='text' name='txttypeb".$v."' id='txttypeb".$v."' value='".$rec_select_type['TYPE_DESC']."' onkeypress='return disableEnterKey(event)' readonly='readonly' /></span></td>
            <td style='width:100px; text-align: left;'><input class='buttonManage' style='width: 100px;' title='".$v."' type='button' name='btnClose1' id='btnClose1' value='Select' onclick='loadNewTablegired(title);'/></td>
        </tr> "; 
            }
            
        ?>
</table>
</div>
<br />
<hr />
<br />
<div id="aaaa">
<div style="margin-left: 50px;">
<input class="buttonManage" style="width: 100px;" type="button" name="btnClose" id="btnClose" value="Close" onclick="pageClose();"/>
</div>
</div>
<?php    
        }else{
?>
<label class="linetop" style="color: #BB0000; font-family: sans-serif; font-size: 16px; font-weight: bold;">Not authorized to  access this page.</label>
<?php    
        }
    }
?>

</form>
</body>
</html>

