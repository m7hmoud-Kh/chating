<?php
session_start();
include "connect.php";
if (isset($_SESSION["uid"])) {

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../chating/include/template/layout/css/bootstrap.css">
        <link rel="stylesheet" href="../chating/include/template/layout/css/fontawes/font1/css/all.css">
        <link rel="stylesheet" href="../chating/include/template/layout/css/serach.css">
        <title>Settings Account</title>
    </head>

    <body>
        <nav>
            <div class="container">
                <div class="row">
                    <div class="col-lg-2 brand">
                        <h3>chat<span>ing</span> </h3>
                    </div>
                    <div class="col-lg-4">
                        <ul class="list-unstyled links">
                            <li>
                                <a href="index.php?user=<?php echo $_SESSION["uid"]; ?>">
                                    <i class="fa fa-home"></i> Home
                                </a>
                            </li>
                            <li>
                                <a href="serachfri.php">
                                    <i class="fas fa-search"></i> search Friends
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <?php
        $stmt = $con->prepare("SELECT * FROM user WHERE user_id = ?");
        $stmt->execute(array($_SESSION["uid"]));
        $userinfo = $stmt->fetch();
        ?>
        <div class="container">
            <table class="table table-bordered">
                <tr>
                    <td class="text-center head">Setting Account</td>
                </tr>
                <table class="perinfo table table-bordered">
                    <tr>
                        <td> personle information </td>
                    </tr>
                    <form action="" method="POST" id="editpersonle">
                        <tr>
                            <td> change your name </td>
                            <td> <input class="form-control" type="text" name="user" value="<?php echo $userinfo["user_name"]; ?>"> </td>
                        </tr>
                        <tr>
                            <td> change your photo </td>
                            <td> <a href="profile.php">change profile</a> </td>
                        </tr>
                        <tr>
                            <td> change your email </td>
                            <td> <input class="form-control" type="email" name="email" value="<?php echo $userinfo["user_email"]; ?>"> </td>
                        </tr>
                        <tr>
                            <td> change your gender </td>
                            <td> <select name="gender" class="form-control">
                                    <option value="0">select your gender</option>
                                    <option value="1" <?php if ($userinfo["user_gender"] == 1) {
                                                            echo "selected";
                                                        } ?>>male</option>
                                    <option value="2" <?php if ($userinfo["user_gender"] == 2) {
                                                            echo "selected";
                                                        } ?>>female</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td> change your Country </td>
                            <td> <select name="country" class="form-control">
                                    <option value="0">select your Country</option>
                                    <option value="1" <?php if ($userinfo["user_country"] == 1) {
                                                            echo "selected";
                                                        } ?>>Egypt</option>
                                    <option value="2" <?php if ($userinfo["user_country"] == 2) {
                                                            echo "selected";
                                                        } ?>>India</option>
                                    <option value="3" <?php if ($userinfo["user_country"] == 3) {
                                                            echo "selected";
                                                        } ?>>USA</option>
                                    <option value="4" <?php if ($userinfo["user_country"] == 4) {
                                                            echo "selected";
                                                        } ?>>France</option>
                                    <option value="5" <?php if ($userinfo["user_country"] == 5) {
                                                            echo "selected";
                                                        } ?>>Saudi</option>
                                    <option value="6" <?php if ($userinfo["user_country"] == 6) {
                                                            echo "selected";
                                                        } ?>>Brazil</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td> <input type="hidden" name="action" value="editper">
                                <button type="submit" class="btn btn-success btn-block">
                                    <i class="fa fa-edit"></i> Edit</button>
                            </td>
                            <td id="message"></td>
                        </tr>
                    </form>
                </table>
                <table class="perinfo table table-bordered">
                    <form action="" method="POST" id="forgotten">
                        <tr>
                            <td> <i class="fa fa-lock"></i> Security information </td>
                        </tr>
                        <tr>
                            <td> <strong>forgotten password </strong>
                                <pre>ask the question because we ask you when you <br> forgotten passwprd</pre>
                            </td>
                            <td>
                                <?php
                                if ($userinfo["user_forgot"] == 0) {
                                ?>
                                    <input type="text" name="forgotten" placeholder="what is your favourite number ...??" class="form-control">
                                <?php
                                } else {
                                ?>
                                    <input type="text" name="oldforgotten" placeholder="old answer ...??" class="form-control oldfor">
                                    <input type="text" name="newforgotten" placeholder="what is your favourite number ...??" class="form-control">
                                <?php
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <input type="hidden" name="action" value="change">
                            <td> <button type="submit" class="btn btn-info btn-block">
                                    <i class="fas fa-check"></i> submit</button> </td>
                            <td id="forgott">

                            </td>
                        </tr>
                    </form>
                    <tr>
                        <td> Change Password </td>
                        <td>
                            <button class="btn btn-primary buttonpass">
                                <i class="fa fa-lock"></i> Change Password</button>
                            <i class="crross fas fa-times"></i>
                        </td>
                    </tr>
                    <form action="" method="POST" id="changepass">
                            <input type="hidden" name="action" value="changepass">
                            <tr class="passwordinfo">
                                <td>current passowrd</td>
                                <td> <input type="password" name="oldpassowrd" class="form-control" autocomplete="new-password" placeholder="type current passowrd ..."> </td>
                            </tr>
                            <tr class="passwordinfo">
                                <td>new password</td>
                                <td> <input type="password" name="newpass" class="form-control" placeholder="type new passowrd ..." autocomplete="new-password"> </td>
                            </tr>
                            <tr class="passwordinfo">
                                <td>confirm password</td>
                                <td> <input type="password" name="newpass2" class="form-control" placeholder="type confirm passowrd ..." autocomplete="new-password"> </td>
                            </tr>
                            <tr class="passwordinfo">
                                <td> <button type="submit" class="btn btn-danger btn-block"><i class="fas fa-key"></i> Save.. </button> </td>
                                <td id="mesgpass"> </td>
                            </tr>
                    </form>
                </table>
        </div>
        <script src="../chating/include/template/layout/js/jquery-3.5.0.min.js"></script>
        <script src="../chating/include/template/layout/js/bootstrap.min.js"></script>
        <script src="../chating/include/template/layout/js/front.js"></script>
    </body>

    </html>
<?php
} else {
    header("location:login.php");
}
