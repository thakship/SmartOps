<?php
$conn=mysqli_connect("localhost","root","1234","cdberp");
// Check connection
if (mysqli_connect_errno($conn)){
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$r = 1;
$q = 10;
for ($i=0; $i<5; $i++) {
    // open ten processes
    $sql_mail_dtl = "SELECT `emailjobID` 
                 FROM `mail_queue` WHERE `stat`= 0 and `sendDateTime` = '0000-00-00 00:00:00' limit ".$r.",".$q.";";
    $que_mail_dtl = mysqli_query($conn , $sql_mail_dtl) or die(mysqli_error($conn));
    while($rec_mail_dtl = mysqli_fetch_array ($que_mail_dtl)){
        isTest($rec_mail_dtl[0]);
    }
    $r = $r + 10;
    $q = $q + 10;
    echo "<br/>----------------------------------------------------------------------------------------<br/>";
    //for ($j=0; $j<10; $j++) {
        //$pipe[$j] = popen('normalSendMail'.($j+1).'.php', 'r');
        //$pipe[$j] = $rec_mail_dtl[0];
    //}
    
    // wait for them to finish
   /* for ($j=0; $j<10; ++$j) {
       isTest($pipe[$j]);
    }*/
}

function isTest($x){
    echo "A - ".$x."<br/>";
}

?>


<!DOCTYPE html>
<html class="full" lang="en">
<!-- Make sure the <html> tag is set to the .full CSS class. Change the background image in the full.css file. -->
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>

    <title>IT Help desk Issues</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />

    <!-- Custom CSS -->
    <link href="css/full.css" rel="stylesheet" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
        <style type="text/css">
    .glyphicon {
    font-size: 50px;
}
    </style>
    <script type="text/javascript">
      /*  window.setTimeout(function(){ document.location.reload(true); }, 90000);
        
        function showIt() {
            window.open('http://cdberp:8080/cdb/index.php','_blank');
          
        }
        setTimeout("showIt()", 15000); // after 1 sec
        
        function showIt4() {
            window.open('http://cdberp:8080/cdb/index.php','_blank');
        }
        
        setTimeout("showIt4()", 50000); // after 5 secs
        
        function showIt2() {
             window.open('http://cdberp:8080/cdb/index.php','_blank');
        }
        
        setTimeout("showIt2()", 65000); // after 5 secs
        
        function showIt3() {
            window.open('http://cdberp:8080/cdb/index.php','_blank');
        }
        setTimeout("showIt3()", 80000); // after 5 secs  */
           
    </script>
</head>
<body>


</body>

</html>
