<?php
include 'codetest_functions.php';
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Codetest for Studio - Tyler Rivers</title>
<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,400i,700,700i|Roboto:400,400i,700,700i,900,900i&display=swap" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="reset.css">
<link rel="stylesheet" type="text/css" href="codetest_style.css">
</head>

<body>
<div class="container">
	<div class="row">
	    <div class="col areaUnknown">
	        <h2>Unmeasured Units <span class="subhead"><em>("area" = 1)</em></span></h2>
	        <?php outputArea($list1); ?>
	    </div>
	    <div class="col areaMeasured">
	        <h2>Measured Units</h2>
	        <?php outputArea($list2); ?>
	    </div>
	</div>
</div>
</body>
</html>
<?php ?>