<?php
	session_start();
	include('php_con/includes/db.ini.php');
    
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
        
<title>CDB SmartOps SYSTEM</title>
<link href="CSS/index.css" type="text/css" rel="stylesheet"/>
</head>
<body class="login-body">
        <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4 login-wrap">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Reset Management </h3>
                    </div>
                    <div class="panel-body">
                        <form method="post" action="" name="myForm" >
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="User ID" name="txtUserID"  id="txtUserID" value="" autofocus="autofocus" />
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="Telephone Number" name="txtGSM" id="txtGSM" value="" />
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="NIC" name="txtNIC" id="txtNIC" value="" />
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <input type="button" class="btn btn-md btn-success btn-block" name="btnLogin" value="Login" onclick="validateLogin()" />
                                <!--<a href="include/sequr.php?" class="btn btn-lg btn-success btn-block" onclick="return validatePassword()">Login</a>-->
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function validateLogin(){
            var txtUserID = document.getElementById('txtUserID').value;
            var txtGSM = document.getElementById('txtGSM').value;
            var txtNIC = document.getElementById('txtNIC').value;
            if(txtUserID == ""){
                alert('Missing User ID');
            }else if(txtGSM == ""){
                 alert('Missing Telephone Number');
            }else if(txtNIC == ""){
                alert('Missing NIC');
            }else{
                    $.ajax({ 
                    type:'POST', 
       				data: {gettxtUserID : txtUserID , gettxtGSM : txtGSM , gettxtNIC : txtNIC }, 
       				url: 'php_con/ajaxResetPasswrod.php', 
       				success: function(val_retn) { 
                          alert(val_retn);
                          pageRef();
                        //document.getElementById('aaaa').innerHTML = val_retn; 
                       
     				}
      			});
            }
        }
        
        function pageRef(){
           window.open('http://cdberp:8080/cdb/index.php','_self');
        }
    </script>
</body>
</html>

<?php
       
    }else{
         echo 'Browser compatible        : Mozilla Firfox only';
    }
?>

