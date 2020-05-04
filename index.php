

<!DOCTYPE html>
<html>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<body>

<h1>The iframe element</h1>

<?php 
    if(isset($_POST['run'])) {
        // echo'<pre>'.print_r($_GET, 1).'</pre>';
        var_dump($_POST);
    }
?>
    <form action="" method="POST">
        <input type="password" name="pass" value="" />
        <input type="submit" value="run" />
    </form>

</body>
</html>


