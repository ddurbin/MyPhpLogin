<!DOCTYPE HTML>
<html>
  <head>
    <title>Create Account</title>
  </head>
  <link rel="stylesheet" type="text/css" href="stylesheet.css">
  <body>
    <?php
    /**
     * Created by PhpStorm.
     * User: ddurbin
     * Date: 4/10/16
     * Time: 11:21 AM
     */
        include_once ('config.php');

        $usernameError = "";
        $passwordError = "";
        $verifyPasswordError = "";
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            $usernameField = $_POST["username"];
            $passwordField = $_POST["password"];
            $verifyPasswordField = $_POST["verifypassword"];

            if ($usernameField && $passwordField && $verifyPasswordField) {
                $conn = getDBConnection();
                if ($conn->connect_error) {
                    echo "<p style='color: red;'><strong>Error connecting to Database!</strong></p></html>";
                    exit;
                }

                $query = "INSERT into Users VALUES(NULL,'$usernameField', '$passwordField', 'Y', 'N')";
                $result = $conn->query($query);
                if (!$result){
                    echo "<p style='color: red;'><strong>Error creating new User!</strong></p></html>";
                    exit;
                }else {
                    header('Location: localhost/login.php');
                }
            }else if (!$usernameField || !$passwordField || !$verifyPasswordField){
                if (!$usernameField) {
                    $usernameError = "* Please enter a username";
                }
                if (!$passwordField) {
                    $passwordError = "* Please enter a password";
                }
                if (!$verifyPasswordField) {
                    $verifyPasswordError = "* Please re-enter password";
                }
            }
        }
    ?>
    <div id="grad">Create Account</div>
    <div id="content">
    <div class="outer">
        <div class="inner">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <div>
                    <input type="text" name="username" size="30" placeholder="Enter Username">
                    <span class="error"><?php echo $usernameError; ?></span>
                </div>
                <br>
                <div>
                    <input type="password" name="password" size="30" placeholder="Enter Password">
                    <span class="error"><?php echo $passwordError; ?></span>
                </div>
                <br>
                <div>
                    <input type="password" name="verifypassword" size="30" placeholder="Re-enter Password">
                    <span class="error"><?php echo $verifyPasswordError; ?></span>
                </div>
                <br>
                <input type="submit" value="     Create     ">
            </form>
        </div>
    </div>
    </div>
  </body>
</html>
