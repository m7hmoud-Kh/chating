<?php
session_start();
include "connect.php";
if (isset($_SESSION["email"])) {
    if (isset($_GET["friends"]) && is_numeric($_GET["friends"])) {
        $friend = filter_var($_GET["friends"], FILTER_SANITIZE_NUMBER_INT);
        $stmt = $con->prepare("SELECT * FROM user WHERE user_id = ? ");
        $stmt->execute(array($friend));
        $count = $stmt->rowCount();
        $userfriend = $stmt->fetch();
        $path = "../chating/upload//";
        if ($count  > 0) {
            $stmt = $con->prepare("SELECT * FROM user WHERE user_id = ?");
            $stmt->execute(array($_SESSION["uid"]));
            $info = $stmt->fetch();
?>
            <!DOCTYPE html>
            <html lang="en">

            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="../chating/include/template/layout/css/bootstrap.css">
                <link rel="stylesheet" href="../chating/include/template/layout/css/fontawes/font1/css/all.css">
                <link rel="stylesheet" href="../chating/include/template/layout/css/home.css">
                <title>chat</title>
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
                                    <img src="<?php echo $path.$info["user_image"]; ?>" alt="">
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
                        $stmt = $con->prepare("SELECT * FROM user WHERE user_id != ? ORDER BY `login` DESC LIMIT 5 ");
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
                                                    <img src="<?php echo $path.$fri["user_image"]; ?>" 
                                                    style="height: 85px;" alt="">
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
                        <div class="col-lg-9">
                            <div class="chatbody">
                                <?php
                                $userid = $_SESSION["uid"];

                                $stmt = $con->prepare("SELECT * FROM `message` WHERE sender = ? AND other = ? OR sender = ? AND other = ? ");
                                $stmt->execute(array($userid, $friend, $friend, $userid));
                                $allmessage = $stmt->fetchAll();
                                $count = $stmt->rowCount();
                                if ($count > 0) {
                                ?>
                                    <div class="row">
                                        <?php
                                        foreach ($allmessage as $mess) {
                                            if ($mess["sender"] == $userid) {
                                        ?>
                                                <div class="col-lg-12 messageofme">
                                                    <div>
                                                        <span><small> <?php echo $mess["meg_date"]; ?> </small></span>
                                                        <span class="nameofchat"> <?php echo $info["user_name"]; ?> </span>
                                                    </div>
                                                    <p class="content">
                                                        <?php echo $mess["content"]; ?>
                                                    </p>
                                                </div>
                                            <?php
                                            }
                                            if ($mess["sender"] == $friend) {
                                            ?>
                                                <div class="col-lg-12 messageofother text-right">
                                                    <div>
                                                        <span> <small> <?php echo $mess["meg_date"]; ?> </small></span>
                                                        <span class="nameofchat"> <?php echo $userfriend["user_name"]; ?> </span>
                                                    </div>
                                                    <p class="content2">
                                                        <?php echo $mess["content"]; ?>
                                                    </p>
                                                </div>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                <?php
                                } else {
                                ?>
                                    <h1 class="alert alert-info text-center berforemessage"> No Messages Until </h1>
                                <?php
                                }
                                ?>
                            </div>
                            <form action="" method="POST" id="sendmessage">
                                <input type="hidden" name="action" value="send">
                                <input type="hidden" name="friend" value="<?php echo $friend; ?>">
                                <input type="text" name="message" placeholder="type any message..." class="form-control sendcomm" autocomplete="off">
                                <button type="submit" class="btn btn-success"><i class="fas fa-paper-plane"></i> Send </button>
                            </form>
                        </div>
                    </div>
                </div>
                <script src="../chating/include/template/layout/js/jquery-3.5.0.min.js"></script>
                <script src="../chating/include/template/layout/js/bootstrap.min.js"></script>
                <script src="../chating/include/template/layout/js/front.js"></script>
            </body>

            </html>
<?php
        }
    } else {
        header("location:index.php");
    }
} else {
    header("location:login.php");
}
