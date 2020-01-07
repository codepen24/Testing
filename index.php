<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">

    <title></title>
  <link rel="stylesheet" href="css/style.css" type="text/css" media="all">  
 <script src="js/scripts.js"></script>
</head>
<body>

<?php 




if(isset($_POST['sub'])) {

$username = $_POST['user']; 
$email = $_POST['email']; 
$password = $_POST['pass']; 

echo'<pre>'.print_r($_REQUEST, 1).'</pre>';

}


?>


<form action="#" method="POST">
    <input type="text" name="user">
    <input type="email" name="email">
    <input type="password" name="pass">
    <input type="submit" name="sub">
</form>





</body>
</html>


