<?php
$pbranch=$_GET['pB'];
$pFiletype=$_GET['pf'];
$pDate=$_GET['pdt'];
$pUser=$_GET['pUs'];
//echo $FNUM;
//$To=$_GET['to'];
mysql_connect('localhost','root','1234');
mysql_select_db('cdberp');
require('fpdf16/fpdf.php');

class PDF_MySQL_Table extends FPDF
{
var $ProcessingTable=false;
var $aCols=array();
var $TableX;
var $HeaderColor;
var $RowColors;
var $ColorIndex;

function Header()
{
    //Print the table header if necessary
    if($this->ProcessingTable)
        $this->TableHeader();
}

function TableHeader()
{
    $this->SetFont('Arial','B',12);
    $this->SetX($this->TableX);
    $fill=!empty($this->HeaderColor);
    if($fill)
        $this->SetFillColor($this->HeaderColor[0],$this->HeaderColor[1],$this->HeaderColor[2]);
    foreach($this->aCols as $col)
        $this->Cell($col['w'],6,$col['c'],1,0,'C',$fill);
    $this->Ln();
}

function Row($data)
{
    $this->SetX($this->TableX);
    $ci=$this->ColorIndex;
    $fill=!empty($this->RowColors[$ci]);
    if($fill)
        $this->SetFillColor($this->RowColors[$ci][0],$this->RowColors[$ci][1],$this->RowColors[$ci][2]);
    foreach($this->aCols as $col)
        $this->Cell($col['w'],5,$data[$col['f']],1,0,$col['a'],$fill);
    $this->Ln();
    $this->ColorIndex=1-$ci;
}

function CalcWidths($width,$align)
{
    //Compute the widths of the columns
    $TableWidth=0;
    foreach($this->aCols as $i=>$col)
    {
        $w=$col['w'];
        if($w==-1)
            $w=$width/count($this->aCols);
        elseif(substr($w,-1)=='%')
            $w=$w/100*$width;
        $this->aCols[$i]['w']=$w;
        $TableWidth+=$w;
    }
    //Compute the abscissa of the table
    if($align=='C')
        $this->TableX=max(($this->w-$TableWidth)/2,0);
    elseif($align=='R')
        $this->TableX=max($this->w-$this->rMargin-$TableWidth,0);
    else
        $this->TableX=$this->lMargin;
}

function AddCol($field=-1,$width=-1,$caption='',$align='L')
{
    //Add a column to the table
    if($field==-1)
        $field=count($this->aCols);
    $this->aCols[]=array('f'=>$field,'c'=>$caption,'w'=>$width,'a'=>$align);
}

function Table($query,$prop=array())
{
    //Issue query
    $res=mysql_query($query) or die('Error: '.mysql_error()."<BR>Query: $query");
    //Add all columns if none was specified
    if(count($this->aCols)==0)
    {
        $nb=mysql_num_fields($res);
        for($i=0;$i<$nb;$i++)
            $this->AddCol();
    }
    //Retrieve column names when not specified
    foreach($this->aCols as $i=>$col)
    {
        if($col['c']=='')
        {
            if(is_string($col['f']))
                $this->aCols[$i]['c']=ucfirst($col['f']);
            else
                $this->aCols[$i]['c']=ucfirst(mysql_field_name($res,$col['f']));
        }
    }
    //Handle properties
    if(!isset($prop['width']))
        $prop['width']=0;
    if($prop['width']==0)
        $prop['width']=$this->w-$this->lMargin-$this->rMargin;
    if(!isset($prop['align']))
        $prop['align']='C';
    if(!isset($prop['padding']))
        $prop['padding']=$this->cMargin;
    $cMargin=$this->cMargin;
    $this->cMargin=$prop['padding'];
    if(!isset($prop['HeaderColor']))
        $prop['HeaderColor']=array();
    $this->HeaderColor=$prop['HeaderColor'];
    if(!isset($prop['color1']))
        $prop['color1']=array();
    if(!isset($prop['color2']))
        $prop['color2']=array();
    $this->RowColors=array($prop['color1'],$prop['color2']);
    //Compute column widths
    $this->CalcWidths($prop['width'],$prop['align']);
    //Print header
    $this->TableHeader();
    //Print rows
    $this->SetFont('Arial','',11);
    $this->ColorIndex=0;
    $this->ProcessingTable=true;
    while($row=mysql_fetch_array($res))
        $this->Row($row);
    $this->ProcessingTable=false;
    $this->cMargin=$cMargin;
    $this->aCols=array();
}
}

class PDF extends PDF_MySQL_Table
{
function Header()
{
	global $pbranch;
	global $pFiletype;
	global $pDate;
	global $pUser;
    //Title
		//date_default_timezone_set('Asia/Colombo');
		date_default_timezone_set('Asia/Almaty');
		
		$sqlBrn= "SELECT `branchName` FROM `branch` WHERE `branchNumber` = '".$pbranch."'";
		$sql_Brn= mysql_query($sqlBrn) or die(mysql_error());
		while ($recs1 = mysql_fetch_array($sql_Brn)){
			$ToBranch =  " : ".$recs1[0];
		}
	$pFiletype1 = " : ".$pFiletype;
	$pDate1 = " : ".$pDate;
	$pUser1 = " : ".$pUser." on ".date("Y-m-d H:i:s");
    $this->SetFont('Arial','',20);
	$this->Image('img/logobg.jpg',10,6,30);
    $this->Cell(0,6,'Courier Creation Report',0,1,'C');
	$this->Line(10, 17, 300-20, 17);
	 $this->SetFont('Arial','',12);
	$this->Cell(40,10,'Branch Name','J');
	$this->Cell(40,10,$ToBranch,0,1);
	$this->Cell(40,10,'File Type','J');
	$this->Cell(40,10,$pFiletype1,0,1);
	$this->Cell(40,10,'Create date','J');
	$this->Cell(40,10,$pDate1,0,1);
	$this->Cell(40,10,'User Info','J');
	$this->Cell(40,10,$pUser1,0,1);
    $this->Ln(10);
	
    //Ensure table header is output
    parent::Header();
}
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Text color in gray
    $this->SetTextColor(128);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
}
}

//Connect to database

//$conn=mysqli_connect("localhost","root","","cdberptest");
// Check connection
/*if (mysqli_connect_errno($conn))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}*/

$pdf=new PDF();

$pdf->AddPage('L');
//First table: put all columns automatically
$pdf->AddCol('rank',15,'Rank','L');
$pdf->AddCol('fileNumber',50,'File Number','L');					   
$pdf->AddCol('fileName',75,'File Name','L');		
$pdf->AddCol('branchName',50,'Recv. Branch','L');		
$pdf->AddCol('numberOfDocument',30,'No of Docs','L');		
$pdf->AddCol('receiveDateTime',40,'Rec Date_Time','L');	
	
$prop=array('HeaderColor'=>array(206,204,204),
            'color1'=>array(242,235,235),
            'color2'=>array(250,236,236),
            'padding'=>2);	
$pdf->Table("SELECT @rownum := @rownum + 1 AS rank,`fileNumber`,`fileName`,`branchName` ,`numberOfDocument`,REPLACE(`receiveDateTime` , '0000-00-00 00:00:00' , '-') AS `receiveDateTime`

					   FROM `branch`,`courier_files`,(SELECT @rownum := 0) r
					   where `branch`.`branchNumber`= `courier_files`.`receiveBranchNumber` AND `courier_files`.`branchNumber`='$pbranch' AND `fileType`='$pFiletype' AND DATE(`createDateTime`) like '$pDate' AND (`stats` ='AB' OR `stats`='OB' OR `stats`='BR' OR `stats`='DR' OR `stats`='PDR' OR `stats`='FDR')", $prop);
		   
//,`receiveBranchNumber`		   CASE `receiveDateTime` WHEN '0000-00-00 00:00:00' THEN ' - ' ELSE `receiveDateTime` END AS `receiveDateTime`
//$pdf->AddPage();
//function AddCol($field=-1,$width=-1,$caption='',$align='L')
//Second table: specify 3 columns
/*$pdf->AddCol('rank',20,'','C');
$pdf->AddCol('name',40,'Country');
$pdf->AddCol('pop',40,'Pop (2001)','R');
$prop=array('HeaderColor'=>array(255,150,100),
            'color1'=>array(210,245,255),
            'color2'=>array(255,255,210),
            'padding'=>2);*/
//$pdf->Table('select name, format(pop,0) as pop, rank from country order by rank limit 0,10',$prop);
$pdf->Output();
?>
