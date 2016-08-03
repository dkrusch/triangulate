<?php


$configs = include("config.php");

include("db.php");

$cookie_name = "username";
$username = "";

if(isset($_COOKIE[$cookie_name])) 
{
    $username = $_COOKIE[$cookie_name];
} 
else if (isset($_POST["username"])) 
{
    $username = $_POST["username"];
    echo "username = $username\n";
// Look up user in the database
    $user = get_user_by_username($username);
    echo "got user: $user\n";
    var_dump($user);
    if (!$user)
    {    
        create_user($username);
        $user = get_user_by_username($username);
        echo "created user: $user\n";
        var_dump($user);
    } 

    /* Cookie expires when browser closes */
    setcookie($cookie_name, $username, false, "", $configs["DOMAIN"]);
    header("Location: index.php");
    
}
?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title>Triangulate</title>
    
        <link rel="icon" href="img/favicon.ico">
        <link rel="stylesheet" type="text/css"
              href="https://fonts.googleapis.com/css?family=Bitter">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <link rel="stylesheet" href="css/base.css">
    </head>
    <body>
        <?php if ($username) { ?>
            <p>Logged in as: <? echo $username ?></p>
            <a href="/map.php" class="btn btn-primary">Set up a meeting</a>
            <a href="" class="btn btn-primary">Join a meeting</a>
        <?php } else { ?>
            <form method="post">
              <label for="username">Username</label> <input type="text" name="username" placeholder="Username">
              <input type="submit" class="btn btn-primary" value="Submit">
            </form>
        <?php } ?>

                
    
    <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>
</html>
