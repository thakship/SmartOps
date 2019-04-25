<?php
class ora_database
{
    private static $db_username = "cdberp";
    private static $db_password = "cdberp";
    private static $db = "oci:dbname=cdbprod";

    private static $dbConn  = null;
     
    public function __construct() {
        die('Init function is not allowed');
    }
     
    public static function connect()
    {
       // One connection through whole application
       if ( null == self::$dbConn )
       {     
        try
        {
          $dbstr1 = "(DESCRIPTION =(ADDRESS = (PROTOCOL = TCP)(HOST = cmbproda-scan.cdb.lk)(PORT = 1521))
                        (CONNECT_DATA =
                        (SERVER = DEDICATED)
                        (SERVICE_NAME = cdbprod)))";
          self::$dbConn = oci_connect('cdberp','cdberp',$dbstr1); //'localhost/XE'
          
        }
        catch(PDOException $e)
        {
          die($e->getMessage()); 
        }
       }
       return self::$dbConn;
    }
     
    public static function disconnect()
    {
        self::$dbConn = null;
    }
}
?>
