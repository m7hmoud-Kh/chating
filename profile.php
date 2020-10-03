<?php
session_start();
include "connect.php";
if (isset($_SESSION["uid"])) {

    $stmt = $con->prepare("SELECT * FROM user WHERE user_id = ?");
    $stmt->execute(array($_SESSION["uid"]));
    $user = $stmt->fetch();
    $path="../chating/upload//";
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../chating/include/template/layout/css/bootstrap.css">
        <link rel="stylesheet" href="../chating/include/template/layout/css/fontawes/font1/css/all.css">
        <link rel="stylesheet" href="../chating/include/template/layout/css/serach.css">
        <title>change profile</title>
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
                                <a href="setting.php">
                                    <i class="fas fa-cogs"></i> All Settings
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <div class="container">
            <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-6 img_chnage">
                    <h1 class="text-center">change profile picture</h1>
                    <form action="" method="POST" enctype="multipart/form-data" id="imageuser">
                        <input type="hidden" name="action" value="sendimage">
                        <div class="img_post">
                            <?php
                            if ($user["user_image"] == 0) {
                                if ($user["user_gender"] == 1) {
                            ?>
                                    <img src="../chating/include/template/layout/img/male.png" alt="">
                                <?php
                                } else {
                                ?>
                                    <img src="../chating/include/template/layout/img/female.png" alt="">
                                <?php
                                }
                            } else {
                                ?>
                                <img src="<?php echo $path.$user["user_image"]; ?>" alt="">
                            <?php
                            }
                            ?>
                            <div class="settinphoto">
                                <span>
                                    <input type="file" name="imguser" class="file-upload">
                                </span>
                                <span>
                                    <button type="submit" class="btn btn-success"> Update Photo </button>
                                </span>
                                <div id="mesagephoto">

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-3"></div>
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
