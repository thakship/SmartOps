<?php
	$valNum = $_REQUEST['txt1'];
	include('../../../php_con/includes/db.ini.php');
?>
<table border="0" style="width:100%; height:100px; font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif;">
	<tr style="width:100%; height:100px;">
        <td style="width:40%; height:100px; text-align:left;">
            <img src="../../../img/logo_hdr.jpg"/><br/>
            <label style="font-weight:bold; font-size:12px;">Citizens Development Business Finance PLC</label><br/>
        </td>
        <td style="width:40%; height:100px; text-align:left; margin-left:10px;line-height:16px;">
             <label> No. 123,</label><br/>
             <label> Orabipasha Mawatha,</label><br/>
             <label> Colombo 10. </label><br/>
             <label> Tel : (94) 11 7388388 </label><br/>
             <label> Fax : (94) 11 2429888 </label><br/>
        </td>
        <td style="width:20%; height:100px;text-align:left; margin-left:10px;">
            <label style="font-weight:bold;">COLLECTION DOCKET</label><br/><br/>
            <label style="line-height:20px;">A/C No :</label><br/>
            <label style="line-height:20px;">Date	:</label><br/>
            <label style="line-height:30px;">DD :</label><br/>
            <label style="line-height:30px;">DOCKET NUMBER : <?php echo $valNum; ?></label><br/>
       </td>
   </tr>
</table>
<hr style="background:#000000; height:1px;"/>
<table border="0" style="width:100%; height:60px;text-align:left;font-size:12px;font-family:Verdana, Arial, Helvetica, sans-serif;line-height:16px;">
	<tr style="vertical-align:top;">
    	<td style="width:60%; height:60px;">
        <label>Company : Transnational BPM Lanka (Pvt) Limited</label><br/>
        <label>Address &nbsp;&nbsp;: 2<sup>nd</sup> Floor, 151/3,</label><br/>
        <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Castle Street, Colombo - 08,</label><br/>
        <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sri Lanka.</label><br/>
        <label>Tel &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: (94) 11 7574574</label><br/>
        <label>Fax &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: (94) 11 4514588</label><br/>
        <label>E-mail &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: sewwandi@prontolanka.com</label><br/>
    	</td>
        <td style="width:40%; height:60px;">
    	<label>Department / Branch :</label><br/>
        <label>Person :</label><br/>
        </td>
    </tr>
</table>
<div style="width:100%; float:left;text-align:left;">
<table border="1" style="width:100%;font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif;" cellpadding="0" cellspacing="0">
	<tr>
    	<td style="width:5%;">No</td>
        <td style="width:15%;">Corton Number</td>
        <td style="width:25%;">Faciloty Number</td>
        <td style="width:5%;">Doc type</td>
        <td style="width:5%;">No</td>
        <td style="width:15%;">Corton Number</td>
        <td style="width:25%;">Faciloty Number</td>
        <td style="width:5%;">Doc type</td>
        
    </tr>
<?php
	$sql_getGried = "SELECT `box_number`,`doc_number`,`doc_type` FROM `doc_line_stat_history` WHERE `batch_number`='$valNum'";
	$query_getGried = mysqli_query($conn,$sql_getGried);
	$V_NumRow = mysqli_num_rows($query_getGried);
	$loopCounter = 0;
	while ($rec_getGried = mysqli_fetch_array($query_getGried)){
		if ($loopCounter % 2 == 0) 
			echo "<TR>";			
			echo "<TD>".($loopCounter + 1)."</TD>";
			echo "<TD> $rec_getGried[0] </TD>";
			echo "<TD> $rec_getGried[1] </TD>";
            echo "<TD> $rec_getGried[2] </TD>";
		if ($loopCounter % 2 == 1	)		
			echo "</TR>";	
			$loopCounter++;
	}
	if ($loopCounter % 2 == 1)
		echo "<TD> &nbsp;</TD><TD> &nbsp;</TD><TD> &nbsp;</TD></TR>";
?>
</table>
</div>
<br/>

<table border="0" style="width:100%; height:200px;text-align:left;font-size:12px;font-family:Verdana, Arial, Helvetica, sans-serif;line-height:20px; vertical-align:top">
	<tr style="height:200px;">
	<td style="width:50%;">
    	<label style="font-weight:bold;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TBPM</label><br/>
        <label>Name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: ..............................................</label><br/>
        <label>Designation : ..............................................</label><br/> 
        <label>Date &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: .............................................</label><br/>
        <label>Time &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: .............................................</label><br/><br/><br/>
        <label>Signature &nbsp;&nbsp;&nbsp;&nbsp;: .............................................</label><br/>
    </td>
    <td style="width:50%;">
    	<label style="font-weight:bold;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Customer</label><br/>
        <label style=" border:#000000 solid 1px;">Authorized by</label><br/>
       	<label>Name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: ..............................................</label><br/>
        <label>Designation : ..............................................</label><br/>
        <label>Department : ..............................................</label><br/>
        <label>Identity Card No :........................................</label><br/>
        <label>Date : .......................... &nbsp;&nbsp;&nbsp;Time : .................</label><br/>
       <label>Signature &nbsp;&nbsp;&nbsp;&nbsp;: .............................................</label><br/>
    </td>
    </tr>
</table>
<hr style="background:#000000; height:1px;"/>
<div style="width:100%; height:20px; float:left;margin-top:10px;font-size:12px;font-family:Verdana, Arial, Helvetica, sans-serif;font-weight:bold;text-align:center;">
        <label>FOR OFFICE USE ONLY</label>
</div>
<table border="0" style="width:100%;height:100px;text-align:left;font-size:12px;font-family:Verdana, Arial, Helvetica, sans-serif;line-height:20px;">
	<tr style="height:100px;">
	<td style="width:40%;">
        <label>Processed by : ..............................</label><br/>
        <label>Date : .........................................</label><br/>
        <label style="font-weight:bold;">CHARGES</label><br/>
        <label>Transportation : ......................................</label><br/>
        <label>Storage : ..........................................</label><br/>
        <label>Other : .............................................</label><br/>
    </td>
    <td style=" width:30%;">
    <br/>
    	<label>................................</label><br/>
        <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;W.O. Number</label><br/>
        <br/>
    	<label>................................</label><br/>
        <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Signature</label><br/>
    </td>
    <td style="width:30%;">
    <br/><br/><br/><br/>
    	<label>New Boxes ...................</label><br/>
    	<label>Old Boxes .....................</label><br/>
    </td>
</tr>
</table>