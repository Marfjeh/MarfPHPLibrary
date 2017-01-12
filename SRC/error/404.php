<?php
header("HTTP/2.0 404 Not Found");
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 2.0//EN">
<html><head>
<title>404 Not Found</title>
</head><body>
<h1>Not Found</h1>
<p>The requested file: <?php echo($_GET['page'] );  ?> was not found on this server.</p>
<hr>
<address>MarfPHPLibrary</address>
</body></html>

