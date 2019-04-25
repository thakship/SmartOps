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
            <input class="box_decaretion" style="width: 100px;"  name="empappodate1" type="text"  id="empappodate1" onFocus="hilightColoyr(this.id)" onBlur="colourLeave(this.id)" onKeyPress="return disableEnterKey(event)" required/>
        </td>
    </tr>
    <tr>
        <td class="textline_01"><p class="linetop">To (Date) :</p></td>
        <td class="textline_02">
            <input class="box_decaretion" style="width: 100px;"  name="empappodate2" type="text"  id="empappodate2" onFocus="hilightColoyr(this.id)" onBlur="colourLeave(this.id)" onKeyPress="return disableEnterKey(event)" required/>
        </td>
    </tr>
    <tr>
        <td class="textline_01"><p class="linetop">Number Of Rooms :</p></td>
        <td class="textline_02">
            <select class="box_decaretion"  style="width: 150px;" name="selnumOfRooms" id="selnumOfRooms" onKeyPress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onBlur="colourLeave(this.id)" required>
            	<?php
                    $sql_room = "SELECT `num_of_rooms` FROM `leisure_parameter`";
                    $quary_room = mysqli_query($conn,$sql_room);
                    while ($rec_room = mysqli_fetch_array($quary_room)) {
                      // for($i = 1 ; $i< $rec_room[0] ; $i++){  
                ?>
                            <!--<option value="<?php //echo $i; ?>"><?php //echo $i; ?></option>-->
                <?php
                        
                        //}
                ?>
                           <option value="<?php echo $rec_room[0]; ?>">Entire Bungalow</option>
                <?php
                    }
                ?>
            </select>
        </td>
    </tr>
    <tr>
        <td class="textline_01"><p class="linetop">Number Of Adults :</p></td>
        <td class="textline_02">
            <select class="box_decaretion" style="width: 50px;" name="selnumOfaduls" id="selnumOfaduls" onKeyPress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onBlur="colourLeave(this.id)" required>
                <?php
                    $sql_aduls = "SELECT `num_of_aduls_max` FROM `leisure_parameter`";
                    $quary_aduls = mysqli_query($conn,$sql_aduls);
                    while ($rec_aduls = mysqli_fetch_array($quary_aduls)) {
                        for($j = 1 ; $j<= $rec_aduls[0] ; $j++){  
                ?>
                            <option value="<?php echo $j; ?>"><?php echo $j; ?></option>
                <?php
                        
                        }
                    }
                ?>
            </select>
        </td>
    </tr>
    <tr>
        <td class="textline_01"><p class="linetop">Number Of Children :</p></td>
        <td class="textline_02">
            <select class="box_decaretion"  style="width:50px;" name="selnumOfchildren" id="selnumOfchildren" onKeyPress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onBlur="colourLeave(this.id)" required="required" >
                <?php
                    $sql_children = "SELECT `num_of_children_max` FROM `leisure_parameter`";
                    $quary_children = mysqli_query($conn,$sql_children);
                    while ($rec_children = mysqli_fetch_array($quary_children)) {
                        for($y = 0 ; $y<= $rec_children[0] ; $y++){  
                ?>
                            <option value="<?php echo $y; ?>"><?php echo $y; ?></option>
                <?php
                        
                        }
                    }
                ?>
            </select>
        </td>
    </tr>
</table>
<div style='display:none;'>
    <?php
       $sql_roomreat = "select room_chg,entire_Bungalow_rate,num_of_rooms,Datediff from leisure_parameter";
        $quary_roomreat = mysqli_query($conn,$sql_roomreat);
        while ($rec_roomreat = mysqli_fetch_array($quary_roomreat)) {
    ?>
    <input class='txt' type='text' name='txtRoomRate' id='txtRoomRate' value='<?php echo $rec_roomreat[0]; ?>'/>
    <input class='txt' type='text' name='txtEBangalo' id='txtEBangalo' value='<?php echo $rec_roomreat[1]; ?>'/>
    <input class='txt' type='text' name='txtNumRoom'  id='txtNumRoom'  value='<?php echo $rec_roomreat[2]; ?>'/>
    <input class='txt' type='text' name='txtDateDiff' id='txtDateDiff' value='<?php echo $rec_roomreat[3]; ?>'/>
    <?php
        }
    ?>
</div>
<table>
    <!--<tr>
        <td class="textline_03">
        <input type="checkbox" style="margin-left: 10px;" class="box_decaretion" name="chkSalray" id="chkSalray"  onKeyPress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onblur="colourLeave(this.id)" required="required" />
        &nbsp;<label class="linetop" for="chkSalray">I agree to salray deduction.</label>
        </td>
    </tr>-->
    <tr>
        <td class="textline_03">
        <input type="checkbox" style="margin-left:1px;" class="box_decaretion" name="chkPolicy" id="chkPolicy"  onKeyPress="return disableEnterKey(event)"  onfocus="hilightColoyr(this.id)" onBlur="colourLeave(this.id)" required="required" />
        &nbsp;<label class="linetop" for="chkPolicy" style="font-family: sans-serif; font-size: 11px;">I have read and understood the policy and stay guidelines.&nbsp; - &nbsp;<a href="policy.pdf" style="color: #FFFFFF;" target="_blank">Read Policy</a></label>
        </td>
     </tr>
</table>
<table>
     <tr>
        <td class="textline_01"></td>
        <td class="textline_02">
            <input type="submit" class="buttonManage" id="btnSubmit" name="btnSubmit" value="Submit" />
            <input type="button" class="buttonManage" id="btnClose" name="btnClose" value="Close" onClick="pageClose()"/>
        </td>
     </tr>
</table>
<br />


</body>
</html>