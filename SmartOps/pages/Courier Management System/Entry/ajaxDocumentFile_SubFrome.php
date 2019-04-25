<?php
	$x=$_REQUEST['txtdoc'];
	//echo $x;
	
?>

<input class="buttonManage" type="button" onclick="displayResult()" value="Insert new row" id="rowNew" name="rowNew" /> <span style="color: #E10000;">F9</span>
&nbsp;&nbsp;<input class="buttonManage" type='button' id="nor" value="Get Uploaded file" onclick="readdata(1,1);" />
<br />
<br /> 
 <div id="newdoctb1" onkeydown="keyEvent(event)" onkeyup="metaKeyUp(event)">
 <table width="921" border="1" id="myTable1" style="width:800px;">
  <tr style="width:800px;" class="tbl1">
    <td width="100" style="width:100px;">Index</td>
    <td width="350" style="width:350px;">Sub Document Number</td>
    <td width="449" style="width:350px;">Sub Document Name</td>
    <td width="449" style="width:100px;"></td>
  </tr>
  <tr style="width:800px;">
    <td style="width:100px;"><input style="width:100px;" type="text" name="txtaa1" id="txtaa1" value="1"  onKeyPress="return disableEnterKey(event)" readonly /> </td>
    <td style="width:350px;"><input style="width:350px;" type="text" name="txtbb1" id="txtbb1" value=""  onKeyPress="return disableEnterKey(event)" /></td>
    <td style="width:350px;"><input style="width:350px;" type="text" name="txtcc1" id="txtcc1" value=""  onKeyPress="return disableEnterKey(event)" /></td>
     <td style="width:100px;"><input type="button" value="Delete" id="del" name="del" onclick="deleteRow(this)" /></td>
  </tr>
</table>
<table>
  <tr>
    <td><p class="linetop">Number of Document(s)</p></td>
    <td>
   		&nbsp;&nbsp;
        <div style='display:none;'>
			<input type="text" name="txtrow" id="txtrow" value="1"/>
        </div>
        <input class="box_decaretion" type="text" name="txtrow1" id="txtrow1" value="1" disabled="disabled"/>
   </td>
  </tr>
</table>
</div>