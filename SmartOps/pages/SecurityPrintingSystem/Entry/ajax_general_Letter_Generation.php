<?php

include('../../../php_con/includes/db.ini.php');
// ---------------- set parameter Header General -------------------------
if(isset($_REQUEST['get_let_id_header'])){ 
  //  echo $_REQUEST['get_let_id_header'];
  General_Letter_Generation(trim($_REQUEST['get_let_id_header']),$conn);
}

function General_Letter_Generation($get_let_id_header,$dbConn){
    
    //  echo $get_let_id_header;
      
        $sql = "select s.Letter_body from sps_general_letter_gen s 
                where s.LET_ID = '".$get_let_id_header."'
                  AND s.letter_status = 1";
        $query = mysqli_query($dbConn, $sql) or die(mysqli_error($dbConn));
        while($result = mysqli_fetch_array($query)){
            echo $result[0];
        }
                
}
?>