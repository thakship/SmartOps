<?php
	session_start();
	include('php_con/includes/db.ini.php');
	include('php_con/includes/seqursub.php');
	if(!isset($_SESSION['lockattamp'])){
		$_SESSION['lockattamp'] = 0;
	}
	if(!isset($_SESSION['numsenddoc'])){
		$_SESSION['numsenddoc'] = 0;
	}
	
	if(!isset($_SESSION['excelFile'])){
		$_SESSION['excelFile'] = "";
	}
	if(!isset($_SESSION['cvsFile'])){
		$_SESSION['cvsFile'] = "";
	}
    
    function getBrowser() { 
        $u_agent = $_SERVER['HTTP_USER_AGENT']; 
        $bname = 'Unknown';
        $platform = 'Unknown';
        $version= "";

        //First get the platform?
        if (preg_match('/linux/i', $u_agent)) {
            $platform = 'linux';
        }elseif(preg_match('/macintosh|mac os x/i', $u_agent)) {
            $platform = 'mac';
        }elseif(preg_match('/windows|win32/i', $u_agent)){
            $platform = 'windows';
        }
    
        // Next get the name of the useragent yes seperately and for good reason
        if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)){ 
            $bname = 'Internet Explorer'; 
            $ub = "MSIE"; 
        }elseif(preg_match('/Firefox/i',$u_agent)) { 
            $bname = 'Mozilla Firefox'; 
            $ub = "Firefox"; 
        }elseif(preg_match('/Chrome/i',$u_agent)) { 
            $bname = 'Google Chrome'; 
            $ub = "Chrome"; 
        }elseif(preg_match('/Safari/i',$u_agent)){ 
            $bname = 'Apple Safari'; 
            $ub = "Safari"; 
        }elseif(preg_match('/Opera/i',$u_agent)){ 
            $bname = 'Opera'; 
            $ub = "Opera"; 
        }elseif(preg_match('/Netscape/i',$u_agent)){ 
            $bname = 'Netscape'; 
            $ub = "Netscape"; 
        } 
    
        // finally get the correct version number
        $known = array('Version', $ub, 'other');
        $pattern = '#(?<browser>' . join('|', $known).')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
        if (!preg_match_all($pattern, $u_agent, $matches)){
            // we have no matching number just continue
        }
    
        // see how many we have
        $i = count($matches['browser']);
        if ($i != 1) {
            //we will have two since we are not using 'other' argument yet
            //see if version is before or after the name
            if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
                $version= $matches['version'][0];
            }else{
                $version= $matches['version'][1];
            }
        }else{
            $version= $matches['version'][0];
        }
        // check if we have a number
        if($version==null || $version==""){
            $version="?";
        }
        return array(
            'userAgent' => $u_agent,
            'name'      => $bname,
            'version'   => $version,
            'platform'  => $platform,
            'pattern'    => $pattern
        );
    } 
    $ua=getBrowser();
    if($ua['name'] == 'Mozilla Firefox'){
        
        
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="icon" href="img/lg_coc.png" type="image/x-icon" />
<title>CDB Smart Operations SYSTEM</title>
<link href="CSS/index.css" type="text/css" rel="stylesheet"/>
<script>
    /*Added by Rizvi On 3:31 PM 11/03/2016 - To set focus the user id*/
    window.onload = function() {
        document.getElementById("txtusername").focus();
    };
    
	function validatePass()
		{
			if(document.getElementById('txtusername').value == '')
				{
					alert("Enter Username ! ");
					document.getElementById('txtusername').focus();
					return false;
				}
			if(document.getElementById('txtpassword').value == false)
				{
					alert("Enter Password");
					document.getElementById('txtpassword').focus();
					return false;
				}
			return true;
		}
</script>
</head>
<body>
	<div id="indexWape">
    	<div id="head">
        	<div id="logo">
      			<img src="img/cdb_logo.gif" style="margin-left:5px; margin-top:5px;"/>
      		</div>
      		<div id="heading">
            	<h1 class="headding">ERP SYSTEM</h1>
      		</div>
        </div>
        <div class="line1">
    
    	</div>
        <div id="bodyTop">
    	
    	</div>
        <div class="box">
        
        </div>
        <div class="indexbody">
        	<form name="frmadd" action="" method="post">
                    <table>
                      <tr>
                        <td class="frm1" style="width: 160px; text-align: right;"><h1 class="name1" style=" margin-right: 5px;">User ID :</h1></td>
                        <td class="frm2"><input type="text" name="txtusername" id="txtusername" value="" style="width:150px; -webkit-box-shadow: 6px 6px 21px rgba(50, 50, 53, 1);-moz-box-shadow:6px 6px 21px rgba(50, 50, 53, 1);box-shadow:6px 6px 21px rgba(50, 50, 53, 1);"/></td>
                      </tr>
                      <tr>
                        <td class="frm1" style="width: 160px; text-align: right;"><h1 class="name1" style=" margin-right: 5px;">Password :</h1></td>
                        <td class="frm2">
                        <input type="password" name="txtpassword" id="txtpassword" value="" style="width:150px;-webkit-box-shadow: 6px 6px 21px rgba(50, 50, 53, 1);-moz-box-shadow:6px 6px 21px rgba(50, 50, 53, 1);box-shadow:6px 6px 21px rgba(50, 50, 53, 1);"/>
                        </td>
                      </tr>
                      
                      <tr>
                        <td class="frm1">&nbsp;</td>
                        <td class="frm2">
                        <input type="submit" class="btn1" name="btnDone" value="Login" onclick="return validatePass()"/>
                        </td>
                      </tr>
                    </table>
        	
          	</form>
        </div>
        <div class="box">
        
        </div>
        <div id="bodyfoot">
    	
    	</div>
    </div>
</body>
</html>
<?php
       
    }else{
         echo 'Browser compatible        : Mozilla Firfox only';
    }
?>

