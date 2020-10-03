<?php
include "connect.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../chating/include/template/layout/css/bootstrap.css">
    <link rel="stylesheet" href="../chating/include/template/layout/css/fontawes/font1/css/all.css">
    <link rel="stylesheet" href="../chating/include/template/layout/css/login.css">
    <title>Login to Your Account</title>
</head>

<body>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == 'POST') {
        $formerr = array();

        $email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
        $pass = filter_var($_POST["pass"], FILTER_SANITIZE_STRING);

        if (empty($email)) {
            $formerr[] = "email can't be <b>empty</b>";
        }
        if (empty($pass)) {
            $formerr[] = "password can't be <b>empty</b>";
        }

        if (empty($formerr)) {
            $stmt = $con->prepare("SELECT * FROM user WHERE user_email = ? AND user_pass = ?");
            $stmt->execute(array($email, $pass));
            $count = $stmt->rowCount();
            $info = $stmt->fetch();
            if ($count == 0) {
                $formerr[] = "The email or password is <b> incorrect  <b>";
            } else {
                $stmt = $con->prepare("UPDATE user SET `login` = ?  WHERE user_email = ? AND user_pass = ? ");
                $stmt->execute(array("online",$email, $pass));
                $_SESSION["uid"] = $info["user_id"];
                $_SESSION["email"] = $info["user_email"];
                header("location:index.php?user=" . $_SESSION["uid"]);
            }
        }
    }

    ?>
    <div class="formchat">
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
            <div class="form_header text-center">
                <h1>sign in</h1>
                <p>login to my chat</p>
            </div>
            <div class="form_body">
                <div class="form-grpup">
                    <label for=""> <i class="fas fa-envelope-open"></i> Email</label>
                    <input type="email" class="form-control" placeholder="type your email" name="email" required autocomplete="off">
                </div>
                <div class="form-grpup">
                    <label for=""> <i class="fa fa-lock"></i> Password</label>
                    <input type="password" class="form-control" placeholder="type your password" name="pass" required autocomplete="new-password">
                </div>
                <span>forgot password ? <a href="forgotpass.php">click here</a></span>
                <div class="form-group">
                    <input type="submit" class="btn btn-success btn-block" value="sign in">
                </div>
                <span> don't have an account ? <a href="signup.php">creat one</a> </span>
                <?php
                if (!empty($formerr)) {
                    foreach ($formerr as $err) {
                ?>
                        <div class="alert alert-danger text-center errmeg"><?php echo $err; ?></div>
                <?php
                    }
                }
                ?>
            </div>
        </form>
    </div>
    <script src="../chating/include/template/layout/js/jquery-3.5.0.min.js"></script>
    <script src="../chating/include/template/layout/js/bootstrap.min.js"></script>
    <script src="../chating/include/template/layout/js/front.js"></script>
</body>

</html>