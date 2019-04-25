<?php
//**************************Start Mysql Database Connection ***********************************************************************************
 function DatabaseConnection(){
        $conn = mysqli_connect("localhost","root","1234","cdberp");
        return $conn;
 }
 //*************************** End Mysql Database Connection **************************************************************************


?>