<?php

class dbCrud{
    
    public $con;
    public $user;
    public $password;
    public $host;
    public $database;
     // ------- Call Construct ---------------------------------
    public function __construct($dbHost, $dbUser, $dbPassword, $dbName){
        
        // Database Connection ------------------------
        $this->user = $dbUser;
        $this->host = $dbHost;
        $this->password = $dbPassword;
        $this->database = $dbName;
        
        // Create connection ---------------------------
        $this->con = new mysqli($this->host, $this->user, $this->password, $this->database);
        
        // Check connection ----------------------------
        if ($this->con->connect_error){
            die("Connection failed: " . $this->con->connect_error);
        }
    }
    
    /*public function TestClassFunction(){
        echo "<br/><b>Class Function OK... </b></br/>";
    }*/
    
    // --------------- Finction excute Queary -------------------------------
    public function excuteQuery($sql){
        $query = $this->con->query($sql) or die($this->con->error);
        return $query;
    }
    
    // ----------------------- End Comment Insert Function   -----------------------------------
public function dbRowInsert($table_name, $form_data){
        date_default_timezone_set('Asia/Colombo');
        // retrieve the keys of the array (column titles)
        $fields = array_keys($form_data);
        // build the query
    
        $sql = "INSERT INTO ".$table_name."
        (`".implode('`,`', $fields)."`)
        VALUES(";
    
        $qq = "DESCRIBE ".$table_name.";";
        
        $q = $this->con->query($qq) or die($this->con->error);
        
        $arrCount = 0;
        $sets = array();
        while($row = mysqli_fetch_array($q)) {
            $DataType = explode("(",$row[1]);
            $column = $row[0];
            if($DataType[0] == "tinyint" || $DataType[0] == "smallint" || $DataType[0] == "mediumint" || $DataType[0] == "int" || $DataType[0] == "bigint" || $DataType[0] == "bit" || $DataType[0] == "float" || $DataType[0] == "double" || $DataType[0] == "decimal"){
                     if(isset($form_data[$column])){
                        $sets[] = $form_data[$column];
                     }
                     
            }else{
                 if(isset($form_data[$column])){
                    $sets[] = "'".$form_data[$column]."'";
                 }
            }
            $arrCount++;
            
        }
        $sql .= implode(', ', $sets);
        $sql .= ");";
    
        $query_run = $this->con->query($sql) or die($this->con->error);
        return $query_run;
        
    }
// ----------------------- End Comment Insert Function   -----------------------------------
// ----------------------- Start Comment Update Function   -----------------------------------
public function dbRowUpdate($table_name, $set_data, $where_clause){
    // check for optional where clause
    $whereSQL = '';
    if(!empty($where_clause)){
        // check to see if the 'where' keyword exists
        if(substr(strtoupper(trim($where_clause)), 0, 5) != 'WHERE'){
            // not found, add key word
            $whereSQL = " WHERE ".$where_clause;
        }else{
            $whereSQL = " ".trim($where_clause);
        }
    }
    // start the actual SQL statement
    $sql = "UPDATE ".$table_name." SET ";
    
    
    $qq = "DESCRIBE ".$table_name.";";
   // $q = mysqli_query($conn,$qq);
    $q = $this->con->query($qq) or die($this->con->error);
    $arrCount = 0;
    $sets = array();
    while($row = mysqli_fetch_array($q)) {
        $DataType = explode("(",$row[1]);
        $column = $row[0];
        if($DataType[0] == "tinyint" || $DataType[0] == "smallint" || $DataType[0] == "mediumint" || $DataType[0] == "int" || $DataType[0] == "bigint" || $DataType[0] == "bit" || $DataType[0] == "float" || $DataType[0] == "double" || $DataType[0] == "decimal"){
                 if(isset($set_data[$column])){
                    //$sets[] = $set_data[$column];
                     $sets[] = "`".$column."` = ".$set_data[$column];
                 }
                 
        }else{
             if(isset($set_data[$column])){
                $sets[] =  "`".$column."` = '".$set_data[$column]."'";
             }
        }
        $arrCount++;
        
    }
    
    
    
    
    // loop and build the column /
    /*$sets = array();
    foreach($set_data as $column => $value){
         $sets[] = "`".$column."` = '".$value."'";
    }*/
    $sql .= implode(', ', $sets);
    // append the where statement
    $sql .= $whereSQL;
    // run and return the query result
    
    //echo $sql;
    $query_run = $this->con->query($sql) or die($this->con->error);
    return $query_run;
    /*$query_run = mysqli_query($conn,$sql) or die (mysqli_error($conn));
    if($query_run){
        return 1;
    }else{
        return 0;
    }*/
}
// ----------------------- End Comment Update Function   -----------------------------------
    
}


?>