<?php
session_start();
include "connect.php";
if (isset($_SESSION["email"])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../chating/include/template/layout/css/bootstrap.css">
        <link rel="stylesheet" href="../chating/include/template/layout/css/fontawes/font1/css/all.css">
        <link rel="stylesheet" href="../chating/include/template/layout/css/serach.css">
        <title>serach friiends</title>
    </head>
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
                                <i class="fas fa-user-cog"></i> Settings
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-6 text-right">
                    <form action="" method="POST" id="serachmember">
                        <input type="hidden" name="action" value="ser">
                        <input type="text" name="ser" placeholder="serach with name .. " class="form-control checkjs" autocomplete="off">
                        <button type="submit" class="btn btn-success"> <i class="fas fa-search"></i> Serach </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>
    <div class="text-center" id="ser"></div>
    <?php
    $stmt = $con->prepare("SELECT * FROM user WHERE user_id != ?");
    $stmt->execute(array($_SESSION["uid"]));
    $allusers = $stmt->fetchAll();
    $path = "../chating/upload//";
    ?>
    <div class="container-fluid allfriends">
        <div class="row">
            <?php
            foreach ($allusers as $user) {
            ?>
                <div class="col-lg-4 card">
                    <div class="img_user text-center">
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
                        }
                        else {
                            ?>
                            <img src="<?php echo $path.$user["user_image"]; ?>" style="height: 85px;" alt="">
                        <?php
                        }
                        ?>
                    </div>
                    <div class="img_info">
                        <ul class="list-unstyled">
                            <li>
                                <i class="fa fa-user"></i> Name: <span><?php echo $user["user_name"]; ?></span>
                            </li>
                            <li>
                                <i class="fas fa-venus-mars"></i> Gender: <span>
                                    <?php if ($user["user_gender"] == 1) {
                                        echo "Male";
                                    } else {
                                        echo "Female";
                                    } ?>
                                </span>
                            </li>
                            <li>
                                <i class="fas fa-flag"></i> Country: <span>
                                    <?php if ($user["user_country"] == 1) {
                                        echo "Egypt";
                                    } elseif ($user["user_country"] == 2) {
                                        echo "India";
                                    } elseif ($user["user_country"] == 3) {
                                        echo "USA";
                                    } elseif ($user["user_country"] == 4) {
                                        echo "France";
                                    } elseif ($user["user_country"] == 5) {
                                        echo "Saudi";
                                    } elseif ($user["user_country"] == 6) {
                                        echo "Brazil";
                                    }  ?>
                                </span>
                            </li>
                        </ul>
                        <a href="fri.php?friends=<?php echo $user["user_id"]; ?>">
                            <button class="btn btn-success btn-block">
                                start chating with <?php echo ucfirst($user["user_name"]); ?>
                                <i class="fa fa-comments"></i> </button>
                        </a>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>

    <body>
        <script src="../chating/include/template/layout/js/jquery-3.5.0.min.js"></script>
        <script src="../chating/include/template/layout/js/bootstrap.min.js"></script>
        <script src="../chating/include/template/layout/js/front.js"></script>
    </body>

    </html>
<?php
} else {
    header("location:login.php");
}
