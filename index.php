<html>
	<head>
		<title>GrandMail</title>
		<link href="css.css" media="all" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<img id="logo" src="img/grandmail.png">
		<h2><?PHP $f_contents = file("randomHeadings.txt"); echo substr($f_contents[rand(0, count($f_contents) - 1)],0,-1); ?></h2>
			<div id="description">
				<div class="half" style="float:left; margin-right:2%;">
					<img src="img/grandma.jpg" style="width:100%;">
				</div>
				<div class="half" id="description">
					GrandMail facilitates interaction between the youthful and the pre-grave. In a world where communication becomes more and more open between people, there is one segmented audience that is getting shafted by this.
				</div>
			</div>
	</body>
</html>