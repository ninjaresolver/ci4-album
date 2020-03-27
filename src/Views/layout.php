<!doctype html>
<html>
<head>
	<title>CI4 App - <?php echo $this->getData()['title'] ?? ''; ?> </title>
	<style type="text/css">
		/** ref https://www.w3schools.com/css/tryit.asp?filename=trycss_table_fancy **/
		.table {
			font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
			border-collapse: collapse;
			width: 100%;
		}

		.table td, .table th {
			border: 1px solid #ddd;
			padding: 8px;
		}

		.table tr:nth-child(even){background-color: #f2f2f2;}

		.table tr:hover {background-color: #ddd;}

		.table th {
			padding-top: 12px;
			padding-bottom: 12px;
			text-align: left;
			background-color: #4CAF50;
			color: white;
		}
	</style>
</head>
<body>
	<?= $this->renderSection('content') ?>
</body>
</html>
