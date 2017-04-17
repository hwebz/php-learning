<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>CodeIgniter</title>
</head>
<body>

<div id="container">
    <ul>
        <li><a href="<?php echo $_SERVER['REQUEST_URI'] ?>welcome">Home page</a></li>
        <li><a href="<?php echo $_SERVER['REQUEST_URI'] ?>welcome/hello">Greet user</a></li>
        <li><a href="<?php echo $_SERVER['REQUEST_URI'] ?>welcome/buy/sandals/123">Buy product</a></li>

        <li><a href="<?php echo $_SERVER['REQUEST_URI'] ?>shoes">Shoes product</a></li>
        <li><a href="<?php echo $_SERVER['REQUEST_URI'] ?>shoes/12321">Show details</a></li>

        <li><a href="<?php echo $_SERVER['REQUEST_URI'] ?>page/">Show page</a></li>
        <li><a href="<?php echo $_SERVER['REQUEST_URI'] ?>page/data_returned">Show page - data returned</a></li>

        <li><a href="<?php echo $_SERVER['REQUEST_URI'] ?>blog/">Blog list</a></li>
    </ul>
</div>

</body>
</html>