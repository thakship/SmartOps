<?php
//error_reporting(0);
$helpdesk = $_REQUEST['getHelp_ID'];
error_reporting(0);
//============================================================+
// File name   : example_061.php
// Begin       : 2010-05-24
// Last Update : 2014-01-25
//
// Description : Example 061 for TCPDF class
//               XHTML + CSS
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: XHTML + CSS
 * @author Nicola Asuni
 * @since 2010-05-25
 */

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');
//.........................................Databse Connection ...............................................................................................
function DatabaseConnection(){
    $conn = mysqli_connect("localhost","root","1234","cdberp");
    return $conn;
}
//------------------------------------------------------------------------------------------------------------------------------------------------------------
// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 061');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 061', PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', '', 10);

// add a page
//$pdf->AddPage();

/* NOTE:
 * *********************************************************
 * You can load external XHTML using :
 *
 * $html = file_get_contents('/path/to/your/file.html');
 *
 * External CSS files will be automatically loaded.
 * Sometimes you need to fix the path of the external CSS.
 * *********************************************************
 */

// define some HTML content with style
/*$html = <<<EOF
<!-- EXAMPLE OF CSS STYLE -->
<style>
	h1 {
		color: navy;
		font-family: times;
		font-size: 24pt;
		text-decoration: underline;
	}
	p.first {
		color: #003300;
		font-family: helvetica;
		font-size: 12pt;
	}
	p.first span {
		color: #006600;
		font-style: italic;
	}
	p#second {
		color: rgb(00,63,127);
		font-family: times;
		font-size: 12pt;
		text-align: justify;
	}
	p#second > span {
		background-color: #FFFFAA;
	}
	table.first {
		color: #003300;
		font-family: helvetica;
		font-size: 8pt;
		border-left: 3px solid red;
		border-right: 3px solid #FF00FF;
		border-top: 3px solid green;
		border-bottom: 3px solid blue;
		background-color: #ccffcc;
	}
	td {
		border: 2px solid blue;
		background-color: #ffffee;
	}
	td.second {
		border: 2px dashed green;
	}
	div.test {
		color: #CC0000;
		background-color: #FFFF66;
		font-family: helvetica;
		font-size: 10pt;
		border-style: solid solid solid solid;
		border-width: 2px 2px 2px 2px;
		border-color: green #FF00FF blue red;
		text-align: center;
	}
	.lowercase {
		text-transform: lowercase;
	}
	.uppercase {
		text-transform: uppercase;
	}
	.capitalize {
		text-transform: capitalize;
	}
</style>

<h1 class="title">Example of <i style="color:#990000">XHTML + CSS</i></h1>

<p class="first">Example of paragraph with class selector. <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sed imperdiet lectus. Phasellus quis velit velit, non condimentum quam. Sed neque urna, ultrices ac volutpat vel, laoreet vitae augue. Sed vel velit erat. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Cras eget velit nulla, eu sagittis elit. Nunc ac arcu est, in lobortis tellus. Praesent condimentum rhoncus sodales. In hac habitasse platea dictumst. Proin porta eros pharetra enim tincidunt dignissim nec vel dolor. Cras sapien elit, ornare ac dignissim eu, ultricies ac eros. Maecenas augue magna, ultrices a congue in, mollis eu nulla. Nunc venenatis massa at est eleifend faucibus. Vivamus sed risus lectus, nec interdum nunc.</span></p>

<p id="second">Example of paragraph with ID selector. <span>Fusce et felis vitae diam lobortis sollicitudin. Aenean tincidunt accumsan nisi, id vehicula quam laoreet elementum. Phasellus egestas interdum erat, et viverra ipsum ultricies ac. Praesent sagittis augue at augue volutpat eleifend. Cras nec orci neque. Mauris bibendum posuere blandit. Donec feugiat mollis dui sit amet pellentesque. Sed a enim justo. Donec tincidunt, nisl eget elementum aliquam, odio ipsum ultrices quam, eu porttitor ligula urna at lorem. Donec varius, eros et convallis laoreet, ligula tellus consequat felis, ut ornare metus tellus sodales velit. Duis sed diam ante. Ut rutrum malesuada massa, vitae consectetur ipsum rhoncus sed. Suspendisse potenti. Pellentesque a congue massa.</span></p>

<div class="test">example of DIV with border and fill.
<br />Lorem ipsum dolor sit amet, consectetur adipiscing elit.
<br /><span class="lowercase">text-transform <b>LOWERCASE</b> Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span>
<br /><span class="uppercase">text-transform <b>uppercase</b> Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span>
<br /><span class="capitalize">text-transform <b>cAPITALIZE</b> Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span>
</div>

<br />

<table class="first" cellpadding="4" cellspacing="6">
 <tr>
  <td width="30" align="center"><b>No.</b></td>
  <td width="140" align="center" bgcolor="#FFFF00"><b>XXXX</b></td>
  <td width="140" align="center"><b>XXXX</b></td>
  <td width="80" align="center"> <b>XXXX</b></td>
  <td width="80" align="center"><b>XXXX</b></td>
  <td width="45" align="center"><b>XXXX</b></td>
 </tr>
 <tr>
  <td width="30" align="center">1.</td>
  <td width="140" rowspan="6" class="second">XXXX<br />XXXX<br />XXXX<br />XXXX<br />XXXX<br />XXXX<br />XXXX<br />XXXX</td>
  <td width="140">XXXX<br />XXXX</td>
  <td width="80">XXXX<br />XXXX</td>
  <td width="80">XXXX</td>
  <td align="center" width="45">XXXX<br />XXXX</td>
 </tr>
 <tr>
  <td width="30" align="center" rowspan="3">2.</td>
  <td width="140" rowspan="3">XXXX<br />XXXX</td>
  <td width="80">XXXX<br />XXXX</td>
  <td width="80">XXXX<br />XXXX</td>
  <td align="center" width="45">XXXX<br />XXXX</td>
 </tr>
 <tr>
  <td width="80">XXXX<br />XXXX<br />XXXX<br />XXXX</td>
  <td width="80">XXXX<br />XXXX</td>
  <td align="center" width="45">XXXX<br />XXXX</td>
 </tr>
 <tr>
  <td width="80" rowspan="2" >XXXX<br />XXXX<br />XXXX<br />XXXX<br />XXXX<br />XXXX<br />XXXX<br />XXXX</td>
  <td width="80">XXXX<br />XXXX</td>
  <td align="center" width="45">XXXX<br />XXXX</td>
 </tr>
 <tr>
  <td width="30" align="center">3.</td>
  <td width="140">XXXX<br />XXXX</td>
  <td width="80">XXXX<br />XXXX</td>
  <td align="center" width="45">XXXX<br />XXXX</td>
 </tr>
 <tr bgcolor="#FFFF80">
  <td width="30" align="center">4.</td>
  <td width="140" bgcolor="#00CC00" color="#FFFF00">XXXX<br />XXXX</td>
  <td width="80">XXXX<br />XXXX</td>
  <td width="80">XXXX<br />XXXX</td>
  <td align="center" width="45">XXXX<br />XXXX</td>
 </tr>
</table>
EOF;

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');*/

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// add a page
/*$pdf->AddPage();

$html = '
<h1>HTML TIPS & TRICKS</h1>

<h3>REMOVE CELL PADDING</h3>
<pre>$pdf->SetCellPadding(0);</pre>
This is used to remove any additional vertical space inside a single cell of text.

<h3>REMOVE TAG TOP AND BOTTOM MARGINS</h3>
<pre>$tagvs = array(\'p\' => array(0 => array(\'h\' => 0, \'n\' => 0), 1 => array(\'h\' => 0, \'n\' => 0)));
$pdf->setHtmlVSpace($tagvs);</pre>
Since the CSS margin command is not yet implemented on TCPDF, you need to set the spacing of block tags using the following method.

<h3>SET LINE HEIGHT</h3>
<pre>$pdf->setCellHeightRatio(1.25);</pre>
You can use the following method to fine tune the line height (the number is a percentage relative to font height).

<h3>CHANGE THE PIXEL CONVERSION RATIO</h3>
<pre>$pdf->setImageScale(0.47);</pre>
This is used to adjust the conversion ratio between pixels and document units. Increase the value to get smaller objects.<br />
Since you are using pixel unit, this method is important to set theright zoom factor.<br /><br />
Suppose that you want to print a web page larger 1024 pixels to fill all the available page width.<br />
An A4 page is larger 210mm equivalent to 8.268 inches, if you subtract 13mm (0.512") of margins for each side, the remaining space is 184mm (7.244 inches).<br />
The default resolution for a PDF document is 300 DPI (dots per inch), so you have 7.244 * 300 = 2173.2 dots (this is the maximum number of points you can print at 300 DPI for the given width).<br />
The conversion ratio is approximatively 1024 / 2173.2 = 0.47 px/dots<br />
If the web page is larger 1280 pixels, on the same A4 page the conversion ratio to use is 1280 / 2173.2 = 0.59 pixels/dots';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');*/

// add a page
$pdf->AddPage();

// define some HTML content with style
$conn = DatabaseConnection();
$sql_helpDeskDtl = "SELECT ch.helpid, ch.cat_code, ch.scat_code_1, ch.scat_code_2, ch.cmb_code, ch.ur_code, ch.pr_code, ch.issue, ch.help_discr, ch.enterBy, ch.enterDateTime, ch.attachment_name, ch.caloser_by, ch.caloser_dateTime, ch.resulution, ch.solution, ch.inner_brCode, ch.inner_dept, ch.inner_user, ch.inner_remark, ch.inner_get, ch.entry_branch, ch.entry_department, ch.solved_by, ch.solved_on, ch.s_type, ch.scat_code_3, ch.asing_by, ch.act_by, ch.act_on, ch.reOpen, ch.ipAddress, ch.ssb_type, ch.ssb_cycle, ch.ssb_facility_amount, ch.ssb_app_number, ch.ssb_app_entry, ch.IsAppValid, ch.facno, ch.curr_stage, ch.assign_to, ch.taken_by, ch.attachment_namesub, ch.isdisbursed, ch.disbdate, ch.isScanned, ch.ScannedDate, ch.scannedBy, ch.cif, ch.lastactivityon, ch.appcrdate, ch.decision_discription, ch.defPassword, ch.facno_stats, ch.attachmentlbl FROM cdb_helpdesk AS ch WHERE ch.helpid = '".$helpdesk."';";
$query_helpDeskDtl = mysqli_query($conn,$sql_helpDeskDtl) or die(mysqli_error($conn));
while($res_helpDeskDtl = mysqli_fetch_assoc($query_helpDeskDtl)){
    $Rowsnos =  50;
    $colsnos =  round ((strlen($res_helpDeskDtl['help_discr']) + 1) / 40,0); //$rec_getHelpdesk['help_discr']
    $Rowsnos = $Rowsnos < 4 ? 4 : $colsnos;
    $issue = $res_helpDeskDtl['issue'];//$rec_getHelpdesk['issue']
    $help_discr = $res_helpDeskDtl['help_discr'] ; 
    $DefaultPswd = $res_helpDeskDtl['defPassword'];
    $protectPassword = substr($DefaultPswd,5,8); //Ecca#3532
}
$v_Sql_tbl_helpNote = "SELECT `note_discr`,`enterBy`,`enterDateTime` FROM `cdb_help_note` WHERE `helpid` = '".$helpdesk."';";
$que_tbl_helpNote = mysqli_query($conn,$v_Sql_tbl_helpNote);
$index = 1;
$str_note = "";
while($REC_tblhelpNote = mysqli_fetch_assoc($que_tbl_helpNote)){  
    $str_note .= "<tr>
            <td style='width: 400px;font-family: Times New Roman; font-size: 12px;'>".$REC_tblhelpNote['note_discr']."</td>
        </tr>";
    $index++;
}  
$Date = date('Y-m-d');
$html = <<<EOF
<div>
    <br />
    <div style='width: 100%;'>
        <div style='float: left; text-align: left;width: 50%;font-family: Times New Roman; font-size: 12px;'>Dear $issue,</div>
        <div style='float: left; text-align: right;width: 50%;font-family: Times New Roman; font-size: 12px;'>Date- $Date</div>
    </div>
    <div style='width: 100%;'>
         <br /><br />
        <label style='margin-left: 10px; font-weight: bold; text-decoration: underline;font-family: Times New Roman; font-size: 12px;'>Welcome to CDB Information Systems!!!</label><br /><br />
        <label style='margin-left: 10px;font-family: Times New Roman; font-size: 12px;'>Please Use the following User Credentials for Your Systems</label><br /><br />
        <div style='font-family: Times New Roman; font-size: 12px;'> 
            <textarea rows='$colsnos' style='width: 400px;padding-left: 10px;font-family: Times New Roman;font-size: 12px;border: none;'>$help_discr</textarea>
        </div>
        <table style='margin-left: 8px;font-family: Times New Roman; font-size: 12px;'>
            <tr>
                <td style='font-family: Times New Roman; font-size: 12px;width:20%'>Password</td>
                <td style='font-family: Times New Roman; font-size: 12px;'>: $DefaultPswd</td>
            </tr>
        </table>
        <br />
        <br />
        <table border='1' cellpadding='0' cellspacing='0' style='margin-left: 10px;'>
               $str_note       
        </table>
        <br />
    </div>
    <div style='width: 100%;text-align: center;'>
        <label style='font-weight: bold; text-decoration: underline;font-family: Times New Roman; font-size: 12px;'>Instructions in Protecting &amp; Using Your Passwords</label>
    </div>
    <div style='width: 100%;text-align: justify;'>
        <p style='font-family: Times New Roman; font-size: 12px; text-align: justify;line-height: 20px;'>
        Please find below instructions with regards to protecting and using the passwords for the user IDs assigned to you. You are required to follow these instructions carefully. Citizens Development Business Finance PLC reserves the right to take disciplinary actions against you for violation of any of these instructions.
        </p>
        <ol style='font-family: Times New Roman; font-size: 12px;line-height: 20px;'>
            <li>Your password is for your personal use only. Do not divulge them to anyone else.</li>
            <li>Your password should be minimum 8 characters in length wherever applicable.</li>
            <li>You should change your Password immediately after logging into all systems at \"First Time\".</li>
            <li>Your password should be formed using the following guide lines.
                <ul style='list-style-type:disc;font-family: Times New Roman; font-size: 12px;line-height: 20px;'>
                    <li>The use of both upper- and lower-case letters (case sensitivity).</li>
                    <li>Inclusion of four or more numerical digits.</li>
                    <li>The use of consonant and  vowel, numbers and special characters in the  formation  of passwords.</li>
                </ul>
            </li>
            <li>You must be alert following practices in using passwords.
                <ul style='list-style-type:disc;line-height: 20px;'>
                    <li>Never use  the same password for more than one account.</li>
                    <li>Do not use remember password option available on applications such as \"Outlook\", Firefox , IE </li>
                    <li>Never write down a password.</li>
                    <li>Never communicate a password by telephone, e-mail or instant messaging.</li>
                    <li>Log off before leaving a computer unattended</li>
                    <li>Changing passwords whenever there is suspicion they may have been compromised.</li>
                    <li>Change your passwords regularly.</li>
                    <li>If your workstation (Ex. Branch/Division/Department) is changed, please inform IT Department trough HR department immediately to do necessary changes to your User credentials</li>
                </ul>
            </li>
            <li>If you feel your password has being obtained by someone else, change it immediately.</li>
            <li>Notify the IT Helpdesk immediately, if you feel your User ID/Password has been used by anyone else..</li>
        </ol>
       	<div style='width: 100%;text-align: center;'>
            <label style='font-family: Times New Roman; font-size: 14px;'>Wishing all the success! for your future career at CDB    ~Team IT~</label>
        </div>
        <div style='width: 100%;text-align: right;'>
            <label style='font-family: Times New Roman; font-size: 12px;margin-right: 20px;'>CONFIDENTIAL</label>
        </div>
    </div>
</div>
EOF;

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// add a page
//$pdf->AddPage();

/* NOTE:
 * *********************************************************
 * You can load external XHTML using :
 *
 * $html = file_get_contents('/path/to/your/file.html');
 *
 * External CSS files will be automatically loaded.
 * Sometimes you need to fix the path of the external CSS.
 * *********************************************************
 */

// define some HTML content with style
$html = <<<EOF
<div style='width: 100%;text-align: center;'>
        <label style='font-weight: bold; text-decoration: underline;font-family: Times New Roman; font-size: 14px; '>User Acknowledgment - CDB Information Systems</label><br /><br />
    </div>
    <div style='width: 100%;'>
        <label style='margin-left: 10px;font-family: Times New Roman; font-size: 12px;'>I ...............................................................................................................................................................................</label><br />
        <div style='width: 100%;text-align: center;'>
            <label style='font-family: Times New Roman; font-size: 12px;'>(Name)</lable>
        </div> 
        <br />
        <label style='margin-left: 10px;font-family: Times New Roman; font-size: 12px;'>Hereby acknowledge that, </label><br />
        <ul style='font-family: Times New Roman; font-size: 12px; line-height: 20px;'>
            <li>I have received the user credentials to the CDB Information systems and</li>
            <li>I have read and understood the CDB IT Policies and Procedures listed below,</li>
        </ul>
        <br/>
         <table style='margin-left: 10px;font-family: Times New Roman; font-size: 12px;'>
            <tr>
                <td style='width: 200px;font-family: Times New Roman; font-size: 12px;  font-weight: bold;'>Policy</td>
                <td style='font-family: Times New Roman; font-size: 12px;font-weight: bold;'>Tick as Appropriate</td>
            </tr>
            <tr>
                <td style='width: 200px;font-family: Times New Roman; font-size: 12px;'>Information Security Policy &amp; Procedure</td>
                <td style='font-family: Times New Roman; font-size: 12px;'><p style='width: 15px; height: 15px; border: #000000 1px solid; margin-left: 30px;'>&nbsp;</p></td>
            </tr>
            <tr>
                <td style='width: 200px;font-family: Times New Roman; font-size: 12px;'>Acceptable Use policy</td>
                <td style='font-family: Times New Roman; font-size: 12px;'><p style='width: 15px; height: 15px; border: #000000 1px solid; margin-left: 30px;'>&nbsp;</p></td>
            </tr>
            <tr>
                <td style='width: 200px;font-family: Times New Roman; font-size: 12px;'>Password Policy</td>
                <td style='font-family: Times New Roman; font-size: 12px;'><p style='width: 15px; height: 15px; border: #000000 1px solid; margin-left: 30px;'>&nbsp;</p></td>
            </tr>
            <tr>
                <td style='width: 200px;font-family: Times New Roman; font-size: 12px;'>Email Policy</td>
                <td style='font-family: Times New Roman; font-size: 12px;'><p style='width: 15px; height: 15px; border: #000000 1px solid; margin-left: 30px;'>&nbsp;</p></td>
            </tr>
            <tr>
                <td style='width: 200px;font-family: Times New Roman; font-size: 12px;'>Internet Policy</td>
                <td style='font-family: Times New Roman; font-size: 12px;'><p style='width: 15px; height: 15px; border: #000000 1px solid; margin-left: 30px;'>&nbsp;</p></td>
            </tr>
         </table>
         <br/>
         <p style='font-family: Times New Roman; font-size: 12px;text-align: justify;line-height: 20px;'>
            Further I agree to comply with the aforesaid CDB IT Policies and procedures (and other associated content) as a condition of employment (or continued employment) with CDB. I consent to the Company monitoring the Systems and monitoring, reviewing and disclosing documents and messages (including personal documents and messages) as provided in Acceptable use Policy, and I agree that I have no expectation of privacy with respect to any documents or messages created, sent, received, retrieved or stored on any of the CDB Systems.   
         </p>
         <p style='font-family: Times New Roman; font-size: 12px;text-align: justify;line-height: 20px;'>
            I agree further that the policies listed above are not exhaustive and the management of the CDB reserve the right to amend/ rescind/ alter the existing policies and impose such other policies as it deems necessary from time to time.
         </p>
         <br/>
        <label style='font-family: Times New Roman; font-size: 12px;'>Date &nbsp;&nbsp;:...............................................</label>
        <label style='font-family: Times New Roman; font-size: 12px;'>Time :...............................................</label><br /><br/>
        <label style='font-family: Times New Roman; font-size: 12px;'>User ID. :.........................................</label> <br /><br/>
        <label style='font-family: Times New Roman; font-size: 12px;'>NIC No:.............................................</label>
        <label style='font-family: Times New Roman; font-size: 12px;'>Signature :...............................................</label><br /><br/>
        <p style='font-family: Times New Roman; font-size: 12px;'>
           <label style='font-family: Times New Roman; font-size: 12px; font-weight: bold;'>Important!</label> - Duly completed 2nd page of this document should be returned to the HR Department within 03 working days.    
        </p>
        <br/>
        <br/>
        <br/>
        <br/>
        <div style='width: 100%;text-align: right;'>
            <label style='font-family: Times New Roman; font-size: 12px;margin-right: 20px;'>CONFIDENTIAL</label>
        </div>
EOF;

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document


//$pdf->Output('example_061.pdf', 'I');
$filename=$helpdesk."NP";
$proctect_filename = $helpdesk;
$filename_exe = ".pdf";
$dir = "doc/"; // full path like C:/xampp/htdocs/file/file/
$pdf->Output($dir.$filename.$filename_exe, 'F');
//$pdf->Output('kuitti'.$ordernumber.'.pdf', 'F');


$password = $protectPassword;
$origFile = $dir.$filename.$filename_exe;
$destFile = $dir.$proctect_filename.$filename_exe;
    
function pdfEncrypt ($origFile, $password, $destFile){

	require_once('fpdi/FPDI_Protection.php');
	$pdf = new FPDI_Protection();

	$pdf->FPDF("P", "in", array('8.27','11.69'));

	$pagecount = $pdf->setSourceFile($origFile);

	for ($loop = 1; $loop <= $pagecount; $loop++) {
   	 	$tplidx = $pdf->importPage($loop);
    	$pdf->addPage();
    	$pdf->useTemplate($tplidx);
	}

	$pdf->SetProtection(array(),$password);
	$pdf->Output($destFile,'F');

	return $destFile;
}

pdfEncrypt($origFile, $password, $destFile);

$fileName = $proctect_filename.$filename_exe;
$pathDir = "genSecPDF/examples/doc/";
echo $helpdesk."|".$fileName."|".$pathDir;

//============================================================+
// END OF FILE
//============================================================+
