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
<?php

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $formerr = array();

    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $forgott = filter_var($_POST["forgott"], FILTER_SANITIZE_NUMBER_INT);

    if (empty($email)) {
        $formerr[] = "email can't be <b>empty</b>";
    }
    if (empty($forgott)) {
        $formerr[] = "forgotten password can't be <b>empty</b>";
    }
    if (empty($formerr)) {
        $stmt = $con->prepare("SELECT user_email FROM user WHERE user_email = ?");
        $stmt->execute(array($email));
        $count = $stmt->rowCount();
        if ($count == 0) {

            $formerr[] = "no email with this <b>name</b>";
        } else {
            $stmt = $con->prepare("SELECT * FROM user WHERE user_forgot = ? AND user_email = ?");
            $stmt->execute(array($forgott, $email));
            $user = $stmt->fetch();
            $check = $stmt->rowCount();
            if ($check == 0) {
                $formerr[] = "forgotten password <b> not correct </b>";
            } else {
                if ($forgott == 0) {
                    $formerr[] = "You do not have the forgotten password";
                } else {
                    $_SESSION["uid"] = $user["user_id"];
                    header("location:changepass.php");
                }
            }
        }
    }
}
?>

<body>
    <div class="formchat">
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
            <div class="form_header text-center">
                <h1>forgotten password</h1>
            </div>
            <div class="form_body">
                <div class="form-grpup">
                    <label for=""> <i class="fas fa-envelope-open"></i> Email</label>
                    <input type="email" class="form-control" placeholder="type your email" name="email" required autocomplete="off">
                </div>
                <div class="form-grpup">
                    <label for=""> <i class="fa fa-lock"></i> forgotten password</label>
                    <input type="text" class="form-control" placeholder="what is your favourite number ...??" name="forgott" required autocomplete="off">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-success btn-block" value="Recovery Password">
                </div>
                <span> Sorry, I remembered the password <a href="login.php">back to login</a> </span>
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