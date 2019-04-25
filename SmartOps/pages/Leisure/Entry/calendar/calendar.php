<?php
require_once dirname(__FILE__) . '/monthCalendar.php';
$month = date('m');
$year = date('Y');
if(!empty($_GET['month'])) $month = $_GET['month'];
if(!empty($_GET['year'])) $year = $_GET['year'];
echo showMonth($month,$year);
?>