<?php
	session_start();
	include('php_con/includes/db.ini.php');
	include('php_con/includes/sequr.php');
	/*if(!isset($_SESSION['lockattamp'])){
		$_SESSION['lockattamp'] = 0;
	}*/
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
    //echo "Platform : ". $ua['platform'];
    if($ua['name'] == 'Mozilla Firefox'){
        //echo $ua['version'];
        //&& $ua['version'] >=29.0
        if($ua['version'] < 129.0){
            $IP = $_SERVER["REMOTE_ADDR"];
            //$sql_select_ip = "SELECT COUNT(`ip`) FROM `version_expire_ip` WHERE `ip` = '".$IP."';";
            //$query_select_ip = mysqli_query($conn,$sql_select_ip) or die(mysqli_error($conn));
            //while($result_select_ip = mysqli_fetch_array($query_select_ip)){
                //if($result_select_ip[0] == 0){
                    
                    $sql_insert_ip = "INSERT INTO `version_expire_ip`(`ip`, `version`,`devtype`) VALUES ('".$IP."','".$ua['version']."','".$ua['platform']."');";
                    mysqli_query($conn,$sql_insert_ip) or die(mysqli_error($conn));
                   // echo "<script>alert('To update your Mozilla Firefox Version immediately. Contact IT.');<script/>";
                //}
            //}
            
        }            
        
?>
<!doctype html>
<html class="no-js" lang="en"><!--<![endif]-->
<head>
<meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <!-- /Meta Data -->
        <!-- Site Icon -->
        <link rel="shortcut icon" href="images/icons/favicon.ico" />
        <!-- /Site Icon -->
        <!-- Stylesheets -->
        <link href="CSS/bootstrap.css" rel="stylesheet" type='text/css' media="screen, all" />
        <link href="CSS/fonts.css" rel="stylesheet" type='text/css' media="screen, all" />
        <link href="CSS/smart_stayl.css" rel="stylesheet" type='text/css' media="screen, all" />
        <!-- /Stylesheets -->
        <!-- Top Load Java Scripts -->
        <script type="text/javascript" src="javascript/modernizr.js"></script>
        <!-- /Top Load Java Scripts -->
        <!-- /Make HTML5 Elements Work in IE 6/7/8  -->
        <!--[if lt IE 9]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
                <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        <!-- /Make HTML5 Elements Work in Old IE 6/7/8 -->
        <script type="text/javascript" src="javascript/jquery.js"></script>
        <script type="text/javascript" src="javascript/bootstrap.js"></script>
<title>CDB Smart Operations</title>
<link href="CSS/index.css" type="text/css" rel="stylesheet"/>
<script>
	var ffversion = '18';
	var is_firefox = navigator.userAgent.toLowerCase().indexOf('firefox/'+ffversion) > -1;
	//alert(navigator.userAgent.toLowerCase().indexOf('firefox/'+ffversion));
	
    function validateForm() {
        var u = document.forms["myForm"]["txtusername"].value;
        var x = document.forms["myForm"]["txtpassword"].value;
        
        
        if (x == null || x == "") {
            alert("Password cannot be blank!");
            document.getElementById("txtpassword").focus();
            return false;
        }
    }
    
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
<!-- Added by Rizvi 10:07 AM 26/12/2017 for implement the snow fall effect
<script type="text/javascript" src="snowstorm.js"></script>	
 -->
</head>
<body class="login-body">
		
        <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4 login-wrap">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <form method="post" action="" name="myForm" onsubmit="return validateForm()">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="User ID" name="txtusername"  id="txtusername" value="" autofocus="autofocus" />
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="password" placeholder="Password" name="txtpassword" id="txtpassword" value="" />
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <input type="submit" class="btn btn-md btn-success btn-block" name="btnLogin" value="Login" onclick="return validatePassword()" />
                                <!--<a href="include/sequr.php?" class="btn btn-lg btn-success btn-block" onclick="return validatePassword()">Login</a>-->
                                <div class="form-group">
                                   
                                </div>
                                <div class="form-group">
                                 <a href="mypasswordRest.php" style="font-size: 12px;">Forgot Password(Only Locked Accounts)</a>    
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php
       
    }else{
         echo 'Browser compatible        : Mozilla Firfox only';
    }
?>

