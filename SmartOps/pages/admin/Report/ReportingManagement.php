<!------------------------------------------------------------------------------------------------------------------------
Module Code		: Admin
Page Name		: Reporting Management 
Purpose			: To Genarete Reporting usgin sql dinamic
Author			: Madushan Wickramaarachchi
Date & Time		: 09.55 A.M 23/05/2017
------------------------------------------------------------------------------------------------------------------------->
<!-- Common Included -->
<?php
	session_start();
	$_SESSION['page']="adm/r/001";
	$_SESSION['Module'] = "Admin";
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Reporting Management </title>

<link rel="stylesheet" type="text/css" href="../../../CSS/globleCSS.css"/>
<script src="../../../js/commenfunction.js"></script>
<!--Javascript-->
<script src="../../../js/jsLey.js"></script>
<script src="../../../js/commenfunction.js"></script>
<script src="../ADMIN_DEVELOPMENT/JAVASCRIPT_FUNCTION/admin_JavaScript.js"></script>

<link rel="stylesheet" href="jquery/jquery-ui.css" />
<script src=" jquery/jquery-1.9.1.js"></script>
<script src="jquery/jquery-ui.js"></script>
<script src="jquery.btechco.excelexport.js"></script>
<script src="jquery.base64.js"></script>
<!--END Common fumction Libariries-->
<style type="text/css">
    .box_decaretion{
        border: #000000 solid 1px;
    }
    .tblsub{
	 	text-align:center;
		background: #eeeeee; /* Old browsers */
		background: -moz-linear-gradient(top, #eeeeee 0%, #cccccc 100%); /* FF3.6+ */
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#eeeeee), color-stop(100%,#cccccc)); /* Chrome,Safari4+ */
		background: -webkit-linear-gradient(top, #eeeeee 0%,#cccccc 100%); /* Chrome10+,Safari5.1+ */
		background: -o-linear-gradient(top, #eeeeee 0%,#cccccc 100%); /* Opera 11.10+ */
		background: -ms-linear-gradient(top, #eeeeee 0%,#cccccc 100%); /* IE10+ */
		background: linear-gradient(to bottom, #eeeeee 0%,#cccccc 100%); /* W3C */
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#eeeeee', endColorstr='#cccccc',GradientType=0 ); /* IE6-9 */
    }
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
    .buttonManage{
        font-size: 12px; 
    }

</style>
<script type="text/javascript">
	function popup(x,y){
	  if(x==1){
		if(y=="Branch"){  
			document.getElementById('outer').style.visibility = "visible";
			document.getElementById('conten').style.visibility = "visible";
		}else{
			document.getElementById('outer').style.visibility = "visible";
			document.getElementById('UserCont').style.visibility = "visible";
		}
	  }else{
		document.getElementById('outer').style.visibility = "hidden";
		document.getElementById('conten').style.visibility = "hidden";
		document.getElementById('UserCont').style.visibility = "hidden";
	  }	
	}
    
    function getGried(){
        //alert('A');
         var isReportType = document.getElementById('selReportType').value;
         var res = isReportType.split("@");
         var isBranchNumber = document.getElementById('txtBranchNumber').value;
         var istxtBranchName = document.getElementById('txtBranchNumber1').value;
         var isFromDate = document.getElementById('empappodate1').value;
         var isToDate = document.getElementById('empappodate2').value;
         var v_user = document.getElementById('txtMyUserID').value;
         
         var SelectionType = document.getElementById('selSelectionType').value;
         if(res[1] == 1 && istxtBranchName == "" && istxtBranchName == ""){
            alert('Branch code is mandatory field.');
         }else if(res[2] == 1 && (isFromDate == "" || isToDate == "")){
             alert('Date is mandatory field.');
         }else{
            mydata2 = new XMLHttpRequest();
            mydata2.onreadystatechange=function(){
                if(mydata2.readyState==4){
                    document.getElementById('TABLEGEN').innerHTML = mydata2.responseText;        
                    document.getElementById('btnExport').disabled = res[3] == 0;
                }
            }
            mydata2.open("GET","ajax_reportgen.php"+"?get_reportid="+res[0]+"&get_BranchNumber="+isBranchNumber+"&get_FromDate="+isFromDate+"&get_ToDate="+isToDate+"&get_genUser="+v_user+"&get_SelectionType="+SelectionType,true);
            mydata2.send();
         }
         
         
         
    }
    
    function getReportAuthendicetion(){
        //alert(title);
        var isReportType = document.getElementById('selReportType').value;
        var res = isReportType.split("@");
        //alert(isReportType);
        //alert(res[0]);
     
        document.getElementById('txtBranchNumber1').disabled = res[1] == 0;
        document.getElementById('empappodate1').disabled = res[2] == 0;
        document.getElementById('empappodate2').disabled = res[2] == 0;
        document.getElementById('selSelectionType').disabled = res[6] == 0;
        //alert("res[5] : " + res[5]);
        var ColTokernizer = res[4].split("|");
        var FieldToken = "";
        var TableHeader = "<tr style='background-color: #BEBABA;'>";
        for (x in ColTokernizer) {
            FieldToken = ColTokernizer[x].split("^");
            for (y in ColTokernizer) {
                if (y==0)
                    TableHeader = TableHeader + "<td style='text-align: left;'><span style='margin: 5px;'>" + FieldToken[0] + "</span></td>" ;
            }
        }
        TableHeader = TableHeader + "</tr>";
        //alert(res[2]);
		if(res[2]==1){
			document.getElementById('empappodate1').value = GetCurrentDate();
			document.getElementById('empappodate2').value = GetCurrentDate();
		}
		document.getElementById("lblBranchName").innerHTML = res[5];
        document.getElementById("RPTGEN").innerHTML = TableHeader;
        document.getElementById('RPTGEN').style.display = "inline";
       	if(res[6] == 1){
       	    document.getElementById("lblST").innerHTML = res[7];
       	    //alert('A');
            mydata3 = new XMLHttpRequest();
            mydata3.onreadystatechange=function(){
                if(mydata3.readyState==4){
                    document.getElementById('divbbb').innerHTML = mydata3.responseText;        
                }
            }
            mydata3.open("GET","ajax_reportgen.php"+"?get_dropReportid="+res[0],true);
            mydata3.send();
			//document.getElementById('divbbb').value = ;
		}
    }
	function GetCurrentDate() {
		var d = new Date(),
		month = '' + (d.getMonth() + 1),
		day = '' + d.getDate(),
		year = d.getFullYear();

		if (month.length < 2) month = '0' + month;
		if (day.length < 2) day = '0' + day;

		return [year, month, day].join('-');
	}
    
 function is_getScat_01(getID,getTitle){
    var getCat = document.getElementById(getID).value;
    var txtMyUserGroup = document.getElementById('txtMyUserGroup').value;
    
    
    if(getTitle == 1){
        var divID = 'diva';
    }
    
    if(getCat == "" &&  getTitle == 1){
        document.getElementById('selReportType').value = "";
        document.getElementById('selReportType').disabled = true; 
    }else{
        //alert('A');
        //alert(getCat);
        //alert(txtMyUserGroup);
        var mydata;
        mydata= new XMLHttpRequest();
        mydata.onreadystatechange=function(){
            if(mydata.readyState==4){
                document.getElementById(divID).innerHTML = mydata.responseText;     
            }
        }
        mydata.open("GET","ajax_serviceRequset_01.php"+"?txt1="+getCat+"&txt2="+txtMyUserGroup,true);
        mydata.send();
    }
    
}
</script> 
<script>
    $(document).ready(function () {
        $("#btnExport").click(function () {
            $("#myTable").btechco_excelexport({
                //alert('Table');
                containerid: "myTable"
               , datatype: $datatype.Table
            });
        });
    });

  $(function() {
    $( "#empappodate1" ).datepicker({dateFormat:"yy-mm-dd"});
  });
  $(function() {
    $( "#empappodate2" ).datepicker({dateFormat:"yy-mm-dd"});
  });
</script>
</head>
<body oncontextmenu="return false">
<form action="" method="post" name="schform" style="margin-left: 20px;">
<p class="topline">
<?php 
	echo $_REQUEST['DispName'];
?>
</p>
<hr/>
<table>
    <tr>
        <td style="text-align: right; width:150px;"><label class="linetop" style="margin-right: 5px;">Module : </label></td>
        <td style="text-align:left; padding-top:5px; padding-bottom:5;">
            <select class="box_decaretion"  style="width: 200px;" name="sel_catagory" id="sel_catagory" onkeypress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" title="1" onchange="is_getScat_01(this.id,title);">
                <option value="">--Select Module --</option>
                    <?php
                        $v_sql_getCategory = "select m.moduleCode , m.moduleName from module AS m;";
                        $que_getCategory = mysqli_query($conn,$v_sql_getCategory);
                        while($RES_getCategory = mysqli_fetch_array($que_getCategory)){
                            echo "<option value=".$RES_getCategory[0].">".$RES_getCategory[1]."</option>";
                        }
                    ?>
             </select>
                            
        </td>
    </tr>
     <tr>
        <td style="text-align: right; width:150px;"><label class="linetop" style="margin-right: 5px;">Report Type : </label></td>
        <td style="text-align:left; padding-top:5px; padding-bottom:5;">
           <div id="diva">
             <select style="width:286px;" class="box_decaretion" name="selReportType" id="selReportType" onkeypress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onchange="getReportAuthendicetion();" disabled="disabled">
                <option value="">--Select Report Type--</option>
             </select>
           </div>          
        </td>
    </tr>
    <tr>
        <td style="text-align: right; width:150px;"><label id="lblBranchName" class="linetop" style="margin-right: 5px;">Branch Name :</label></td>
        <td style="text-align:left; padding-top:5px; padding-bottom:5;">
            <div style='display:none;'>
                <input type="text" name="txtBranchNumber" id="txtBranchNumber" value=""  onkeypress="return disableEnterKey(event)"  readonly="readonly" required="required"/>
            </div>
            <input title="Branch" type="text" class="box_decaretion" id="txtBranchNumber1" name="txtBranchNumber1" value="" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeypress="return disableEnterKey(event)" onclick="popup(1,title)"  placeholder="" disabled="disabled" />
        </td>
    </tr>
     <tr>
        <td style="text-align: right; width:150px;"><label class="linetop" style="margin-right: 5px;">Date :</label></td>
        <td style="text-align:left; padding-top:5px; padding-bottom:5;">
            <input type="text" class="box_decaretion" id="empappodate1" name="empappodate1" value="" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeypress="return disableEnterKey(event)" placeholder="----/--/--" disabled="disabled"/>
            <input type="text" class="box_decaretion" id="empappodate2" name="empappodate2" value=""  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeypress="return disableEnterKey(event)" placeholder="----/--/--" disabled="disabled"/>
        </td>
    </tr>
     <tr>
        <td style="text-align: right; width:150px;"><label id="lblST" class="linetop" style="margin-right: 5px;">Selection Type : </label></td>
        <td style="text-align:left; padding-top:5px; padding-bottom:5;">
           <div id="divbbb">
             <select style="width:286px;" class="box_decaretion" name="selSelectionType" id="selSelectionType" onkeypress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" disabled="disabled">
                <option value="">--Select Selection Type--</option>
             </select>
           </div>          
        </td>
    </tr>
    

</table>
<br />
<div >
    <input class="buttonManage" type="button" style="width: 100px;"  value="Generate" name="btnGenerate" id="btnGenerate" onclick="getGried();" />
    <input class="buttonManage" type="button" style="width: 100px;"  value="Excel" name="btnExport" id="btnExport" disabled="disabled" />
    <input class="buttonManage" style="width: 100px;" type="button" name="btnClose" id="btnClose" value="Close" onclick="pageClose();"/>
</div>
<div style="display: none;">
    <input type="text" id="txtMyUserID" name="txtMyUserID" value="<?php echo $_SESSION['user']; ?>" onkeypress="return disableEnterKey(event)" />
    <input type="text" id="txtMyUserGroup" name="txtMyUserGroup" value="<?php echo $_SESSION['usergroupNumber']; ?>" onkeypress="return disableEnterKey(event)" />
</div>
<br/>
<div id="outer">
		
</div>
<div id="conten">
    <p class="topline">Search branch
     <input style="margin-left:310px; font-size: 12px;" type="button" onclick="popup(0)" value="Colse" id="popupclose" name="popupclose" />
    </p>
    <?php
		ShowGrid($conn,"SELECT `branchNumber`,`branchName` FROM `branch`",'txtBranchNumber','txtBranchNumber1','popup(0)','branch','txt1','txt2','NULL');			
     ?>
       
</div>
<div id="TABLEGEN">
<table id="RPTGEN" border='1' cellpadding='0' cellspacing='0'  style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px; margin-left: 1px;'>
</table>
</div>


</form>
</body>
</html>