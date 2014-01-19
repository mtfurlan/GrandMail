<?PHP
error_reporting(E_STRICT | E_ALL | E_DEPRECATED);
ini_set("display_errors", 1);
?>
<html>
	<head>
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">
<title>
			<?PHP 
				switch((isset($_GET["Page"]) ? $_GET["Page"] : "" )){
					case "form":
						echo "Send a tattooed dead tree";
						break;
					case "db":
						echo "Add a user";
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
						case "db":
							include("dbform.php");
							break;
						default:
							echo "GrandMail facilitates interaction between the youthful and the pre-grave. " . 
							"In a world where communication becomes more and more open between people, there is one segmented " .
							"audience that is getting shafted by this.The form link is for directly mailing notes.<br>" . 
"<a href=\"?Page=form\">Form</a><br>The other link is for the actually interesting part, which is how you add addresses you can email. On that form you put the email you would be sending things from in, and put an ID for each address. You then email *ID*@grandmail.bymail.in<br>The subject line is currently not used, but will be used for templates in the future. The body of the email is what is printed out and sent.<a href=\"?Page=db\">Add email option stuff</a><br>Also, special shenanagans allow for multiple people to use the same ID for different addresses. There is no way for you to accidentally send a letter to an address someone else entered.";
					}
				?>
			</article>
	</body>
</html>
