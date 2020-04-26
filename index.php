

<!DOCTYPE html>
<html>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<body>

<h1>The iframe element</h1>

    <form action="#" method="GET">
        <input type="password" name="pass" value="" />
        <input type="submit" value="run" />
    </form>

</body>
</html>



<?php 
    if(isset($_GET['name'])) {
        echo'<pre>'.print_r($_POST, 1).'</pre>';
    }
?>
