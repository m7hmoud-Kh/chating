<?php
include "connect.php";
session_start();
if(isset($_SESSION["uid"]))
{
    ?>
    >
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

    $newpass = filter_var($_POST["newpass"], FILTER_SANITIZE_STRING);
    $newpass1 = filter_var($_POST["newpass1"], FILTER_SANITIZE_STRING);

    if (empty($newpass)) {
        $formerr[] = "new password can't be <b>empty</b>";
    }
    if (!empty($newpass)) {
        if ($newpass !== $newpass1) {
            $formerr[] = "passwords is not <b>match</b>";
        }
    }
    if (empty($formerr)) {
        $stmt = $con->prepare("UPDATE user SET user_pass = ? WHERE user_id = ?");
        $stmt->execute(array($newpass, $_SESSION["uid"]));
        if ($stmt) {

            $suc = "<div class='alert alert-success errmeg'>password changed Successfully...! </div>";
        }
    }
}
?>

<body>
    <div class="formchat">
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
            <div class="form_header text-center">
                <h1>change password</h1>
            </div>
            <div class="form_body">
                <div class="form-grpup">
                    <label for=""> <i class="fa fa-lock"></i> new password</label>
                    <input type="password" class="form-control" placeholder="type new password" name="newpass" required autocomplete="new-password">
                </div>
                <div class="form-grpup">
                    <label for=""> <i class="fa fa-lock"></i> confirm password</label>
                    <input type="password" class="form-control" placeholder="confirm new password" name="newpass1" required autocomplete="new-password">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-success btn-block" value="change Password">
                </div>
                <span> when password changed <a href="login.php">back to login</a> </span>
                <?php
                if (!empty($formerr)) {
                    foreach ($formerr as $err) {
                ?>
                        <div class="alert alert-danger text-center errmeg"><?php echo $err; ?></div>
                <?php
                    }
                }
                if(isset($suc))
                {
                    echo $suc;
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
    <?php
}
else
{
    header("location:forgotpass.php");
}