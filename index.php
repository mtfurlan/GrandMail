<html>
	<head>
		<title>
			<?PHP 
				switch((isset($_GET["Page"]) ? $_GET["Page"] : "" )){
					case "form":
						echo "Send a tattooed dead tree";
						break;
					default:
						echo "GrandMail";
				}
			?>
			</title>
		<link href="css.css" media="all" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<a href="?"><img id="logo" src="img/grandmail.png"></a>
		<h2><?PHP $f_contents = file("randomHeadings.txt"); echo substr($f_contents[rand(0, count($f_contents) - 1)],0,-1); ?></h2>
			<article id="main">
				<?PHP
					switch((isset($_GET["Page"]) ? $_GET["Page"] : "" )){
						case "form":
							include("mailform.php");
							break;
						default:
							echo "GrandMail facilitates interaction between the youthful and the pre-grave. In a world where communication becomes more and more open between people, there is one segmented audience that is getting shafted by this.";
					}
				?>
			</article>
	</body>
</html>