<?php
session_start();
include "connect.php";
if (isset($_SESSION["email"])) {
    if (isset($_GET["user"]) && is_numeric($_GET["user"])) {
        if ($_SESSION["uid"] == $_GET["user"]) {
            $stmt = $con->prepare("SELECT * FROM user WHERE user_id = ?");
            $stmt->execute(array($_SESSION["uid"]));
            $info = $stmt->fetch();
            $path = "../chating/upload//";
?>
            <!DOCTYPE html>
            <html lang="en">

            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="../chating/include/template/layout/css/bootstrap.css">
                <link rel="stylesheet" href="../chating/include/template/layout/css/fontawes/font1/css/all.css">
                <link rel="stylesheet" href="../chating/include/template/layout/css/home.css">
                <title>home</title>
            </head>

            <body>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-3 serach">
                            <a href="serachfri.php">
                            <button class="btn btn-secondary">Add New User</button>
                            </a>
                        </div>
                        <div class="col-lg-6 info_user">
                            <div class="img_user">
                                <?php
                                if ($info["user_image"] == 0) {
                                    if ($info["user_gender"] == 1) {
                                ?>
                                        <img src="../chating/include/template/layout/img/male.png" alt="">
                                    <?php
                                    } else {
                                    ?>
                                        <img src="../chating/include/template/layout/img/female.png" alt="">
                                <?php
                                    }
                                }
                                else {
                                    ?>
                                    <img src="<?php echo $path.$info["user_image"]; ?>"  alt="">
                                <?php
                                }
                                ?>
                            </div>
                            <span class="username"><?php echo $info["user_name"]; ?></span>
                        </div>
                        <div class="col-lg-3 logout">
                            <form action="logout.php" method="POST">
                                <a href="logout.php">
                                    <button class="btn btn-danger" type="submit">
                                        <i class="fas fa-door-open"></i> logout</button>
                                </a>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <?php
                        $stmt = $con->prepare("SELECT * FROM user WHERE user_id != ? ORDER BY `login` DESC LIMIT 5");
                        $stmt->execute(array($_SESSION["uid"]));
                        $allfriends = $stmt->fetchAll();
                        ?>
                        <div class="allfriends col-lg-3">
                            <ul class="list-unstyled">
                                <?php
                                foreach ($allfriends as $fri) {
                                ?>
                                    <a href="fri.php?friends=<?php echo $fri["user_id"] ?>">
                                        <li>
                                            <div class="img_friends">
                                                <?php
                                                if ($fri["user_image"] == 0) {
                                                    if ($fri["user_gender"] == 1) {
                                                ?>
                                                        <img src="../chating/include/template/layout/img/male.png" alt="">
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <img src="../chating/include/template/layout/img/female.png" alt="">
                                                    <?php
                                                    }
                                                }
                                                else {
                                                    ?>
                                                    <img src="<?php echo $path.$fri["user_image"]; ?>" style="height: 85px;" alt="">
                                                <?php
                                                }
                                                if ($fri["login"] == "offline") {
                                                    ?>
                                                    <span class="login">
                                                        <i class="far fa-circle"></i> offline
                                                    </span>
                                                <?php
                                                } else {
                                                ?>
                                                    <span class="login">
                                                        <i class="fas fa-circle"></i> online
                                                    </span>
                                                <?php
                                                }
                                                ?>
                                                <p class="text-center user"> <?php echo $fri["user_name"]; ?> </p>
                                            </div>
                                        </li>
                                    </a>
                                <?php
                                }
                                ?>
                            </ul>
                        </div>
                        <div class="col-lg-9 chating">
                            <div class="row">
                                <div class="col-lg-5">
                                    <div class="imgcontact">
                                        <img src="../chating/include/template/layout/img/link.jpg" alt="">
                                    </div>
                                </div>
                                <div class="col-lg-4 stmt">
                                    <h3>select online friend and start chating</h3>
                                </div>
                            </div>
                        </div>
                    </div>
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
    }
} else {
    header("location:login.php");
}
