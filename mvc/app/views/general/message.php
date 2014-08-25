<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo $error['title']; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<link rel="icon" href="<?php echo URL; ?>/images/favicon.png" />
<style type="text/css">
*{
	margin:0;
	padding:0;
	border:0;
}
body {
	background:#ededed;
	font-family:sans-serif;
	margin: 40px 0 10px;
	color: #555;
}
hr {
    border-bottom: 1px solid #eee;
}
a {
	color: #000;
	font-weight: normal;
	text-decoration:none;
}
a:hover, a:active {
	text-decoration:underline;
}
h1 {
	border-bottom: 1px solid #ccc;
	font-size: 19px;
	font-weight: normal;
	padding: 14px 15px 10px;
	background-color:#f5f5f5;
}

.container {
	width:90%;
	margin:auto;
	border:1px solid #ccc;
	background-color:#f5f5f5;
}

p {
	background-color:#fff;
	padding: 12px 15px;
}
p.error { color:#840000; }
p.success { color:#006700; }
p.warning { color:#767000; }
p.message { color:#006767; }
</style>
</head>
<body>
    <div class="container">
        <h1><?php echo $error['title']; ?></h1>
        <p class="error">
            <?php echo $error['message']; ?>
        </p>
        <hr />
        <p>
            <a href="javascript:history.go(-1)">Go Back</a>
        </p>
    </div>
</body>
</html>