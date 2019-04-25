
<?php
$host="172.16.41.1";

exec("ping -n 1 " . $host, $output, $result);

//print_r($output);

if ($result == 0)

echo "$host Ping successful!";

else

echo "$host Ping unsuccessful!";

?>