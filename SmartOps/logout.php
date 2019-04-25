 <?php
   // Initialize the session.
   session_start();
   // Unset all of the session variables.
   $_SESSION = array();
   session_unset();
   // Finally, destroy the session.
   session_destroy();
   header('Location:index.php');
    $_SESSION['lockattamp'] = "";
?>