<?php
//.........................................Databse Connection .......................................................
function DatabaseConnection(){
    $conn = mysqli_connect("localhost","root","1234","cdberp");
    return $conn;
}
if(isset($_REQUEST['get_reportid']) && isset($_REQUEST['get_BranchNumber']) && isset($_REQUEST['get_FromDate']) && isset($_REQUEST['get_ToDate']) && isset($_REQUEST['get_genUser']) && isset($_REQUEST['get_SelectionType'])){
   //echo $_REQUEST['get_reportid']." - ".$_REQUEST['get_BranchNumber']." - ".$_REQUEST['get_FromDate']." - ".$_REQUEST['get_ToDate']." - ".$_REQUEST['get_genUser'];
   generateNormalTable(trim($_REQUEST['get_reportid']),trim($_REQUEST['get_BranchNumber']),trim($_REQUEST['get_FromDate']),trim($_REQUEST['get_ToDate']),trim($_REQUEST['get_genUser']),trim($_REQUEST['get_SelectionType']));
}

if(isset($_REQUEST['get_dropReportid'])){
    getDropDownList($_REQUEST['get_dropReportid']);
}
// function *******************************************************************************

function generateNormalTable($reportid,$branchNumber,$fromDate,$toDate,$genUser,$get_SelectionType){
    $conn = DatabaseConnection();
    $RowColor = "#ffffff";
	$arr = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
	$preTDValue = "";
	$iSFirstRow = "";
    $sql_reportgen = "select r.sqltoken , r.columntoken , r.showBranch, r.showDates,r.NumColumns,r.RowColourBasedOn , r.SelectionType
                from reportgen  AS r 
                WHERE r.IsDisable = 0 AND
                      r.reportid = '".$reportid."';";
    $query_reportgen = mysqli_query($conn , $sql_reportgen) or die(mysqli_error($conn));
    while($resalt_reportgen = mysqli_fetch_assoc($query_reportgen)){
        echo "<table border='1' cellpadding='0' cellspacing='0' id='myTable'  style='background:#FFFFFF;text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:11px; margin-left: 1px;'>";
      //Branch ID^VARCHAR^10^N|Branch Descr^VARCHAR^10^G|Branch Telephoner^VARCHAR^10^N
        $COL_ALIGN = array($resalt_reportgen['NumColumns']);
		$COL_TOTAL = array($resalt_reportgen['NumColumns']);
        $array_tr = explode('|',$resalt_reportgen['columntoken']);
        echo "<tr style='background-color: #BEBABA;'>";
        for($x = 0 ; $x < sizeof($array_tr) ; $x++){
            $array_dff = explode('^',$array_tr[$x]);
            for($z = 0 ; $z < sizeof($array_dff) ; $z++){
                $align  = $array_dff[1] == "VARCHAR"?"left":"right";
				$ctotal = $array_dff[3] == "G"?"1":"0";
                $COL_ALIGN[$x] =$align;
				$COL_TOTAL[$x] =$ctotal;
                if($z == 0){  
                    echo "<td style='text-align: ".$align.";'><span style='margin: 0px;'>".$array_dff[$z]."</span></td>";
                }
            }
        }
        echo "</tr>";
        
        $sql_report_typr = $resalt_reportgen['sqltoken'];
        
        // Binding Dynamic variables into the SQL
        if($resalt_reportgen['showBranch']==1){
            $sql_report_typr = str_replace("':1'","'".$branchNumber."'",$sql_report_typr);
        }    
        if($resalt_reportgen['showDates']==1){
            $sql_report_typr = str_replace("':2'","'".$fromDate."'",$sql_report_typr);
            $sql_report_typr = str_replace("':3'","'".$toDate."'",$sql_report_typr);
        }
        
         if($resalt_reportgen['SelectionType']==1){
            $sql_report_typr = str_replace("':4'","'".$get_SelectionType."'",$sql_report_typr);
        } 
        // End of Binding Dynamic variables into the SQL
        // echo $sql_report_typr;    
		
        $quary_report_typr = mysqli_query($conn,$sql_report_typr) or die(mysqli_error($conn));
        while ($rec1 = mysqli_fetch_array($quary_report_typr)){
          echo "<tr style='background-color:".$RowColor."'>";
          for($a = 0 ; $a < $x ; $a++){
			if($iSFirstRow==""){
				if($resalt_reportgen['RowColourBasedOn']>0 && $resalt_reportgen['RowColourBasedOn']==($a+1)){
					$preTDValue = $rec1[$a];
				}
				$iSFirstRow=="True";
			}
			
            $align = $COL_ALIGN[$a];
			$ctotal = $COL_TOTAL[$a];
			if($ctotal=="1")
				$arr[$a] = $arr[$a] + $rec1[$a];
			else
				$arr[$a] = $arr[$a] + 0;
			if($resalt_reportgen['RowColourBasedOn']>0){
				if($resalt_reportgen['RowColourBasedOn']==($a+1)){
					$RowColor = ($preTDValue == $rec1[$a]?"#ffeead":"#ffffff");
			
					//echo "preTDValue = ". $preTDValue . " | rec1[$a] =".$rec1[$a]."<br>";
					$preTDValue = $rec1[$a];
				}
			}
            echo "<td style='text-align: ".$align.";'>".$rec1[$a]."&nbsp;</td>";
			
          }       
		  if($resalt_reportgen['RowColourBasedOn']==0)
			$RowColor = ($RowColor=="#ffffff"?"#ffeead":"#ffffff");
		  else{
			  
		  }
          echo "</tr>";
		}
        
        for($a = 0 ; $a < $x ; $a++){
			$ctotal = $COL_TOTAL[$a];
			$align = $COL_ALIGN[$a];
			if($ctotal=="1")
				echo "<td style='font-size:large;font-weight:bold;text-align: ".$align.";'>".$arr[$a]."</td>";
			else
				echo "<td>&nbsp;</td>";
        }
        echo "</tr>";
        echo "</table>";   
    }
    
}

function getDropDownList($Reportid){
     $conn = DatabaseConnection();
     $sql = "select r.SelectionTypeSQL
                from reportgen AS r 
                where r.reportid = '".$Reportid."'
                  and r.SelectionType = 1;";
     $query = mysqli_query($conn,$sql) or die(mysqli_error($conn));
     
     while($resalt = mysqli_fetch_array($query)){
        //echo $resalt[0];
        echo "<select style='width:286px;' class='box_decaretion' name='selSelectionType' id='selSelectionType' onkeypress='return disableEnterKey(event)'  onfocus='hilightColoyr(this.id)' onblur='colourLeave(this.id)'>";
        echo "<option value=''>--Select Selection Type--</option>";
         $q_run = mysqli_query($conn,$resalt[0]) or die(mysqli_error($conn));
         while($r_run = mysqli_fetch_array($q_run)){
             echo "<option value='".$r_run[0]."'> ".$r_run[1]." </option>";
         }
        echo " </select>";
     }
     
}
?>