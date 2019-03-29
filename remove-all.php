<?php
session_start();
session_destroy();
header('Location: view-wish-list.php')
?>