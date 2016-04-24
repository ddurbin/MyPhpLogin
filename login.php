<?php
/**
 * Created by PhpStorm.
 * User: ddurbin
 * Date: 4/8/16
 * Time: 1:48 PM
 */
include_once 'config.php';

$usernameError = "";
$passwordError = "";

$userField = $_POST["username"];
$passwordField = $_POST["password"];

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if ($userField && $passwordField) {
        $conn = getDBConnection();

        if ($conn->connect_error) {
            echo "<p style='color: red;'><strong>Error connecting to Database!</strong></p></html>";
            exit;

        }

        $query = "SELECT * FROM USERS u WHERE u.username=? AND u.password=?";
        $stringType = "s";
        $types = [&$stringType,&$stringType];
        $params = [&$userField, &$passwordField];
        //$result = $conn->query($query);
        $result = executeSQLIStatement($query, $types, $params);
        if($result->num_rows > 0){
            //successful login
            $_SESSION["login_user"] = $userField;
            header('Location: homepage.php');
        }else {
            //login failure
            echo "<p style='color: red;'>Login Failure!</p>";
        }
    }else if (!$userField && !$passwordField) {
        $usernameError = "* Please enter username";
        $passwordError = "* Please enter password";
    }else if (!$passwordField) {
        $passwordError = "* Please enter password";
    }else {
        $usernameError = "* Please enter username";
    }
}
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Login</title>
    </head>
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
    <body>
    <div id="grad">Login</div>
    <div id="content">
        <div class="outer">
            <div class="inner">
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                        <div>
                            <input type="text" name="username" size="30" placeholder="Username">
                            <span class="error"><?php echo $usernameError; ?></span>
                        </div>
                        <br>
                        <div>
                            <input type="password" name="password" size="30" placeholder="Password">
                            <span class="error"><?php echo $passwordError; ?></span>
                        </div>
                        <br>
                        <input type="submit" value="      Login      ">
                </form>
                <br>
                <a href="/createAccount.php">Create Account</a>
            </div>
        </div>
    </div>
    </body>
</html>