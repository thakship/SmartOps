<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="lolkittens" />

	<title>Untitled 3</title>
    <link rel="stylesheet" type="text/css" href="../../../CSS/globleCSS.css"/>
<link rel="stylesheet" type="text/css" href="../CMS_DEVELOPMENT/CSS/courier_Management_System_Style_Sheet.css"/>
<!--Javascript-->
<script src="../../../js/jsLey.js"></script>
<script src="../../../js/commenfunction.js"></script>
<script src="../CMS_DEVELOPMENT/JAVASCRIPT_FUNCTION/courier_Management_System_JavaScript.js"></script>
<script src="jquery.btechco.excelexport.js"></script>
<script src="jquery.base64.js"></script>
<script>
    $(document).ready(function () {
        $("#btnExport").click(function () {
            $("#myTable1").btechco_excelexport({
                //alert('Table');
                containerid: "myTable1"
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
<script type="text/javascript">
	function readdata(y,x) {

        // Use the <input type='file'...> object to get a filename without showing the object.
		//alert(y);
		//alert(x);
        //document.all["fileInput"].click();
		
		//alert(fileName);
		//var fileget = document.getElementById('txtread').value;
		var filePath = "C:/uploadsCMSExcel/Copy_of_iNet.xls";
		//alert(filePath);
		if(filePath!=""){
		  alert(filePath);
			var mydata2;
			mydata2= new XMLHttpRequest();
			mydata2.onreadystatechange=function(){
				if(mydata2.readyState==4){
					document.getElementById('newdoctb1').innerHTML=mydata2.responseText;
				}
			}
			mydata2.open("GET","ajaxtest_upload.php"+"?txtpartha="+filePath,true);
			mydata2.send();
		}else{
			alert('Enter Document!');
		}

    }	
</script>
</head>

<body>
<input class="buttonManage" type='button' id="nor" value="Get Uploaded file" onclick="readdata(1,1);" />
<input type="button" style="width: 100px;" class='buttonManage' name="btnExport" id="btnExport" value="Excel"/>
<div id="newdoctb1">

</div>
</body>
</html>