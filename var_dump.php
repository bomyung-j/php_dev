<?php
  session_start();
  echo '<pre>';
  var_dump($_SESSION);
  echo '</pre>';
 echo "session_cache_expire = ".session_cache_expire();
?>
