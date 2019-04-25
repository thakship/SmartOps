<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="lolkittens" />
	<title>Untitled 4</title>
<link rel="stylesheet" href="jquery/jquery-ui.css" />
<script src=" jquery/jquery-1.9.1.js"></script>
<script src="jquery/jquery-ui.js"></script>
<script type="text/javascript">
    $(function() {
        $( "#empappodate1" ).datepicker({dateFormat:"yy-mm-dd"});
    });
    $(function() {
        $( "#empappodate2" ).datepicker({dateFormat:"yy-mm-dd"});
    });
</script>
<style type="text/css">
.textline_01{
    text-align:left; 
    color: #FFFFFF;
    font-family: sans-serif;
    width:170px;
}
.textline_03{
    text-align:left; 
    color: #FFFFFF;
    font-family: sans-serif;
}
.textline_02{
    text-align:left; 
    color: #FFFFFF;
    font-family: sans-serif;
    width:250px;
}
.buttonManage{
    font-size: 12px; 
    font-family: sans-serif;
    width: 100px;
}
.linetop{
    color: #FFFFFF;
    font-family: sans-serif;
    font-size: 12px;
}
</style>
</head>

<body>

<table>
    <tr>
        <td class="textline_01"><p class="linetop">From (Date) :</p></td>
        <td class="textline_02">
            <input class="box_decaretion" style="width: 100px;"  name="empappodate1" type="text"  id="empappodate1" value="" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeypress="return disableEnterKey(event)" required="required"/>
        </td>
    </tr>
    <tr>
        <td class="textline_01"><p class="linetop">To (Date) :</p></td>
        <td class="textline_02">
            <input class="box_decaretion" style="width: 100px;"  name="empappodate2" type="text"  id="empappodate2" value="" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeypress="return disableEnterKey(event)" required="required"/>
        </td>
    </tr>
    <tr>
        <td class="textline_01"><p class="linetop">Request By :</p></td>
        <td class="textline_02">
            <input class="box_decaretion" style="width: 100px;"  name="txtRequestBy" type="text"  id="txtRequestBy" value="" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeypress="return disableEnterKey(event)" required="required"/>
        </td>
    </tr>
    <tr>
        <td class="textline_01"><p class="linetop">Remark :</p></td>
        <td class="textline_02">
            <textarea class="box_decaretion" style="width: 200px;"  name="txtRemark" id="txtRemark" onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" onkeypress="return disableEnterKey(event)" required="required"></textarea>
        </td>
    </tr>
    
</table>
<br />
<table>
     <tr>
        <td class="textline_01"></td>
        <td class="textline_02">
            <input type="button" class="buttonManage" id="btnSubmit" name="btnSubmit" value="Submit" onclick="pageBokking()"/>
            <input type="button" class="buttonManage" id="btnClose" name="btnClose" value="Close" onclick="pageClose()"/>
        </td>
     </tr>
</table>
<br />


</body>
</html>