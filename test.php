<?PHP
echo "<pre>";
file_put_contents("testPOST.txt","POST:\n" . print_r($_POST,true));