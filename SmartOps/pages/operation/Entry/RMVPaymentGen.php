<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Operation
Page Name		: CR To Be Received List
Purpose			: To viwe Request List for CR To Be Received List
Author			: Madushan Wikramaarachchi
Date & Time		: 10.45 A.M 2019-03-27
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="ope/e/015";
	include('../../pageasses.php');
	//echo $_SESSION['usergroupNumber'];
	$ass = cakepageaccess();
	//echo getHelpIDreq1;
	if($ass != 1){
		header('Location:../../home.php');
	}
	include('../../../php_con/includes/db.ini.php');
	include('../../../php_con/includes/Common.php');
	include('../../loguser.php');
    include('../Operation_DEVELOPMENT/PHP_FUNCTION/operation_php_function.php');
  
  

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>RMV Payment Gen</title>
<!-- Common function Libariries -->
<!-- CSS-->
    <link rel="stylesheet" type="text/css" href="../../../CSS/globleCSS.css"/>
    <link rel="stylesheet" type="text/css" href="../Operation_DEVELOPMENT/CSS/operation_Style_Sheet.css"/>
<!--Javascript-->
<script src="../../../js/commenfunction.js"></script>
<script src="../Operation_DEVELOPMENT/JAVASCRIPT_FUNCTION/operation_js_function"></script>
<!--END Common fumction Libariries-->
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
</style>
<link rel="stylesheet" href="jquery/jquery-ui.css" />
<script src="jquery/jquery-1.9.1.js"></script>
<script src="jquery/jquery-ui.js"></script>
<script type="text/javascript">
function pageClose(){ //Page Close Function.......
	//parent.location.href = parent.location.href;
    window.open('http://cdberp:8080/cdb/pages/operation/Entry/CrReceivedList.php?DispName=CR%20Received%20List','conectpage');
}
function pageRef(){
   window.open('http://cdberp:8080/cdb/pages/operation/Entry/CrReceivedList.php?DispName=CR%20Received%20List','conectpage');
}

 function isChangeRowColoerOver(title){
        document.getElementById('tr'+title).style.backgroundColor = "#FDEEEE";
    }
    
    function isChangeRowColoerDown(title){
        document.getElementById('tr'+title).style.backgroundColor = "#FFFFFF";
    }
    

    
    function getPrint(){
        var val_letter_type_code = document.getElementById('txt_Letter_Type_Code').value;
        var val_batch_number = document.getElementById('txt_Batch_Number').value;
        var val_Remarks = document.getElementById('txt_Remarks').value;
        var val_user = document.getElementById('txtMyUserID').value;
        if(val_letter_type_code == ""){
            alert('Missing Letter Type.');
            document.getElementById('dis_ltc').style.display = "inline" ;
            
        }else if(val_batch_number == ""){
            alert('Missing Batch Number.');
            document.getElementById('dis_bn').style.display = "inline" ;
        }else if(val_Remarks == ""){
            alert('Missing Remarks.');
            document.getElementById('dis_Remarks').style.display = "inline" ; 
        }else if(val_user == ""){
            alert('Undefined User.');
        }else{
            var mydata1;
			mydata1 = new XMLHttpRequest();
			mydata1.onreadystatechange=function(){
				if(mydata1.readyState==4){
					document.getElementById('display_letter').innerHTML = mydata1.responseText;
                    var prtContent = document.getElementById("display_letter");
        			var WinPrint = window.open('', '', 'letf=0,top=0,width=1150,height=500,toolbar=0,scrollbars=0,status=0');
        			WinPrint.document.write(prtContent.innerHTML);
        			WinPrint.document.close();
        			WinPrint.focus();
        			WinPrint.print();
        			WinPrint.close();
                    pageClose();
                    
				}
			}
			//var sub1=document.getElementById('selectCodeDoc').value;
			mydata1.open("GET","ajax_letter_print.php"+"?get_letter_type_code="+val_letter_type_code+"&get_batch_number="+val_batch_number+"&get_Remarks="+val_Remarks+"&get_user="+val_user,true);
			mydata1.send();
        }
        
    }


   function receiptPrint(){
       var prtContent = document.getElementById("getDataTbl");
       // execute check expiration code
       var WinPrint = window.open('', '', 'letf=0,top=0,width=1150,height=500,toolbar=0,scrollbars=0,status=0');
       WinPrint.document.write(prtContent.innerHTML);
       WinPrint.document.close();
       WinPrint.focus();
       WinPrint.print();
       WinPrint.close();
       pageClose();

   }
   
   
function loadNewTablegired(title){
        
                        
              alert('Function OK');
               //      var v_user = document.getElementById('txtMyUserID').value;
    var rmv_user = document.getElementById('txtMyUserID').value; 
    var batch_ID = title;
    
        alert(batch_ID);
      
        var r = confirm('Are you sure you want to Process this?');
    //    alert('ok');
        if (r == true) {
            
            $.ajax({
                type: 'POST',
                data: {get_rmv_user : rmv_user , isRMVbatch_ID : batch_ID },
                url: '../Operation_DEVELOPMENT/PHP_FUNCTION/kiosk_php_function.php', 
                success: function (val_retn) {
                   document.getElementById('getDataTbl').innerHTML = val_retn;
                   receiptPrint();
                  /*  if(val_retn == 0){
                        document.getElementById('getErrorMsg').innerHTML = 'Invalid Letter Type';
                    }else{
                        document.getElementById('getDataTbl').innerHTML = val_retn;
                        //receiptPrint();
                    }*/
                }
            });
        }
    
        
    }
    //-- Madushan 2018-01-26 Cooment Print --- -------------------------------------------
    function getLetterPrint(title){
        //alert(title);
         var res = title.split('|');
        //alert(res[0]);
        //alert(res[1]);
       // var v_user = document.getElementById('txtMyUserID').value;
        //alert(v_user);
        mydata2 = new XMLHttpRequest();
        mydata2.onreadystatechange=function(){
            if(mydata2.readyState==4){
                document.getElementById('display_letter').innerHTML = mydata2.responseText;   
                var prtContent = document.getElementById("display_letter");
    			var WinPrint = window.open('', '', 'letf=0,top=0,width=1150,height=500,toolbar=0,scrollbars=0,status=0');
    			WinPrint.document.write(prtContent.innerHTML);
    			WinPrint.document.close();
    			WinPrint.focus();
    			WinPrint.print();
    			WinPrint.close();
                pageClose();   
                    
            }
        }
        mydata2.open("GET","ajax_get_grid.php"+"?get_LetterType_Print="+res[0]+"&get_Index_Print="+res[1]+"&get_Print_User="+res[2],true);
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
<div id="getAch_gried">
<table border='1' cellpadding='0' cellspacing='0'  id='myTable' style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;margin-left: 50px;'>
   	    <tr style="background-color: #BEBABA;">
        <td style="width:70px; text-align: right;"><span style="margin-right: 5px;">#</span></td>
        <td style="width:200px; text-align: left;"><span style="margin-left: 5px;">Batch Number</span></td>
        <td style="width:150px; text-align: left;"><span style="margin-left: 5px;">Request By</span></td>
        <td style="width:150px; text-align: left;"><span style="margin-left: 5px;">Request On</span></td>
        <td style="width:150px; text-align: left;"><span style="margin-left: 5px;">No Of Entries</span></td>
        
        <td style="width:80px;"></td>
        
    </tr>
        <?php
            $sql_select_type = "select `batch_id`,`createBy`,`createOn`,`noOfBatch`  from `rmv_batch_header` where print_status = '0'";
            $que_select_type = mysqli_query($conn,$sql_select_type) or die(mysqli_error());
            if(mysqli_num_rows($que_select_type) != 0) {
            $v = 1;
            while($rec_select_type = mysqli_fetch_array($que_select_type)){
            //    echo $rec_select_type[1];
               echo "<tr>";
               echo "<td style='width:70px; text-align: right;'><span style='margin-right: 5px;'>".$v."</span></td>";
               echo "<td style='width:200px; text-align: left;'><span style='margin-left: 5px;'>".$rec_select_type[0]."</span></td>";
                echo "<td style='width:250px; text-align: left;'><span style='margin-left: 5px;'>".$rec_select_type[1]."</span></td>";
                  echo "<td style='width:250px; text-align: left;'><span style='margin-left: 5px;'>".$rec_select_type[2]."</span></td>";
                    echo "<td style='width:250px; text-align: left;'><span style='margin-left: 5px;'>".$rec_select_type[3]."</span></td>";
                    echo "<td style='width:100px; text-align: left;'><input class='buttonManage' style='width: 100px;' title='".$rec_select_type[0]."' type='button' name='btnClose1' id='btnClose1' value='Print' onclick='loadNewTablegired(title);' /></td>";
              
               
               echo "</tr>"; 
            }
        }else{
            echo "<tr>
                    <td style='width:70px;'>&nbsp;</td>
                    <td style='width:200px;'>&nbsp;</td>
                    <td style='width:250px;'>&nbsp;</td>
                    <td style='width:150px;'>&nbsp;</td>
                    <td style='width:80px;'>&nbsp;</td>  
                </tr>";
        }
            
        ?>
</table>
<br /><hr />
<input class="buttonManage" style="width: 100px;" type="button" name="btnClose" id="btnClose" value="Close" onclick="pageClose();"/>
</div>
<div style="display: none;">
    <input type="text" id="txtMyUserID" name="txtMyUserID" value="<?php echo $_SESSION['user']; ?>" onkeypress="return disableEnterKey(event)" />
    <input type="text" id="txtMyUserGroup" name="txtMyUserGroup" value="<?php echo $_SESSION['usergroupNumber']; ?>" onkeypress="return disableEnterKey(event)" />
</div>

<div id="getDataTbl"></div>

</form>
</body>
</html>