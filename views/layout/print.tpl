
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title><?php echo _("app.name"); ?></title>
        <!--link href="http://localhost:8888/vignette/public/assets/css/print.css" rel="stylesheet"-->
        <style>
        
body{
	font-size: 10pt;
	margin: 20px 40px;
	font-family: Helvetica, Verdana, sans-serif;
}

table {
    line-height: 1.2em;
    border: 1px solid black;
    width: 100%;
    /*margin-top: 100px;*/
}

thead>tr>th{
	background-color: #fff;
}
th{
	text-align: left;
	background-color: #EC9B33;
}
tr {
    vertical-align: top;
}
td{
	border-bottom: 1px solid black;
}

.noFormat{
	margin-bottom: 20px;
}

button{
	display: none;
}
img{
	max-width: 200px;
	max-height: 200px;
}
</style>
</head>
<body>
	<?php echo $d['content'] ?>
</body>
</html>