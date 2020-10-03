<?php include "connect.php"; ?>
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

        $user = filter_var($_POST["user"], FILTER_SANITIZE_STRING);
        $email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
        $pass = filter_var($_POST["pass"], FILTER_SANITIZE_STRING);
        $country = filter_var($_POST["country"], FILTER_SANITIZE_NUMBER_INT);
        $gender = filter_var($_POST["gender"], FILTER_SANITIZE_NUMBER_INT);

        if (empty($user)) {
            $formerr[] = "username can't be <b>empty</b>";
        }
        if (!empty($user)) {
            if (strlen($user) < 3) {
                $formerr[] = "username must be greater than <b>3 char</b>";
            }
            if (strlen($user) > 20) {
                $formerr[] = "username must be less than <b>20 char</b>";
            }
        }
        if (empty($email)) {
            $formerr[] = "email can't be <b>empty</b>";
        }
        if (empty($pass)) {
            $formerr[] = "password can't be <b>empty</b>";
        }
        if ($country == 0) {
            $formerr[] = "country can't be <b>empty</b>";
        }
        if ($gender == 0) {
            $formerr[] = "gender can't be <b>empty</b>";
        }

        if (empty($formerr)) {
            $stmt = $con->prepare("SELECT user_email FROM user WHERE user_email = ? ");
            $stmt->execute(array($email));
            $check = $stmt->rowCount();
            if ($check > 0) {
                $formerr[] = "already email is exist try anthor <b>email<b>";
            } else {
                $stmt = $con->prepare("INSERT INTO `user` ( `user_name`, `user_email`, `user_pass`, `user_image`, `user_forgot`, `user_country`, `user_gender`, `user_date`, `login`) VALUES ( :n , :e , :p , '0', '0',:c  ,  :g , now() , '0')");
                $stmt->execute(array(
                    'n' => $user,
                    'e' => $email,
                    'p' => $pass,
                    'c' => $country,
                    'g' => $gender
                ));
                $count = $stmt->rowCount();
                if ($count > 0) {
                    $suc =
                        "<div class='alert alert-success text-center'> Well Done..!! $user your are signUp :) </div>";
                }
            }
        }
    }
    ?>
    <div class="formchat">
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
            <div class="form_header text-center">
                <h1>sign up</h1>
                <p>fill out this form and start chating with <br> your friends</p>
            </div>
            <div class="form_body">
                <div class="form-grpup">
                    <label for=""> <i class="fas fa-user"></i> user</label>
                    <input type="text" class="form-control" placeholder="type your user" name="user" autocomplete="off">
                </div>
                <div class="form-grpup">
                    <label for=""> <i class="fas fa-envelope-open"></i> Email</label>
                    <input type="email" class="form-control" placeholder="type your email" name="email" autocomplete="off">
                </div>
                <div class="form-grpup">
                    <label for=""> <i class="fa fa-lock"></i> Password</label>
                    <input type="password" class="form-control" placeholder="type your password" name="pass" autocomplete="new-password">
                </div>
                <div class="form-group">
                    <label for="">country</label>
                    <select name="country" class="form-control">
                        <option value="0">select your country</option>
                        <option value="1">Egypt</option>
                        <option value="2">India</option>
                        <option value="3">USA</option>
                        <option value="4">France</option>
                        <option value="5">Saudi</option>
                        <option value="6">Brazil</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Gender</label>
                    <select name="gender" class="form-control">
                        <option value="0">select your gender</option>
                        <option value="1">male</option>
                        <option value="2">female</option>
                    </select>
                </div>
                <label for="">
                    <input type="checkbox">
                    <span style="display: inline;">I accept the <a href="#">terms of user</a> &amp; <a href="#"> privacy policy </a> </span>
                </label>
                <div class="form-group">
                    <input type="submit" class="btn btn-success btn-block" value="sign in">
                </div>
                <span> already have an account ? <a href="login.php">sign in</a> </span>
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