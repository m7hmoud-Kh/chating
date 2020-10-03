<?php
session_start();
include "connect.php";
if ($_SERVER["REQUEST_METHOD"] == 'POST') {

    $stmt = $con->prepare("SELECT * FROM user WHERE user_id = ?");
    $stmt->execute(array($_SESSION["uid"]));
    $userinfo = $stmt->fetch();
    $path = "../chating/upload//";

    if ($_POST["action"] == "send") {
        $meg = filter_var($_POST["message"], FILTER_SANITIZE_STRING);
        $friend = filter_var($_POST["friend"], FILTER_SANITIZE_NUMBER_INT);

        if (!empty($meg) && !empty($friend)) {
            $stmt = $con->prepare("INSERT INTO `message` (`sender`, `other`, `content`, `status`, `meg_date`) VALUES ( ? , ? , ? , '0' , current_timestamp())");
            $stmt->execute(array($_SESSION["uid"], $friend, $meg));
        }
    }
    if ($_POST["action"] == "ser") {
        $ser = filter_var($_POST["ser"], FILTER_SANITIZE_STRING);

        $stmt = $con->prepare("SELECT * FROM user WHERE user_name LIKE ? ");
        $stmt->execute(array('%' . $ser . '%'));
        $count = $stmt->rowCount();
        if ($count > 0) {
            $friends = $stmt->fetchAll();
            foreach ($friends as $fri) {
?>
                <div class="col-lg-4 card">
                    <div class="img_user text-center">
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
                            <img src="<?php echo $path.$fri["user_image"]; ?>" alt="">
                        <?php
                        }
                        ?>
                    </div>
                    <div class="img_info">
                        <ul class="list-unstyled">
                            <li>
                                <i class="fa fa-user"></i> Name: <span><?php echo $fri["user_name"]; ?></span>
                            </li>
                            <li>
                                <i class="fas fa-venus-mars"></i> Gender: <span>
                                    <?php if ($fri["user_gender"] == 1) {
                                        echo "Male";
                                    } else {
                                        echo "Female";
                                    } ?>
                                </span>
                            </li>
                            <li>
                                <i class="fas fa-flag"></i> Country: <span>
                                    <?php if ($fri["user_country"] == 1) {
                                        echo "Egypt";
                                    } elseif ($fri["user_country"] == 2) {
                                        echo "India";
                                    } elseif ($fri["user_country"] == 3) {
                                        echo "USA";
                                    } elseif ($fri["user_country"] == 4) {
                                        echo "France";
                                    } elseif ($fri["user_country"] == 5) {
                                        echo "Saudi";
                                    } elseif ($fri["user_country"] == 6) {
                                        echo "Brazil";
                                    }  ?>
                                </span>
                            </li>
                        </ul>
                        <a href="fri.php?friends=<?php echo $fri["user_id"]; ?>">
                            <button class="btn btn-success btn-block">
                                start chating with <?php echo ucfirst($fri["user_name"]); ?>
                                <i class="fa fa-comments"></i> </button>
                        </a>
                    </div>
                </div>
            <?php
            }
        } else {
            ?>
            <div class="alert alert-danger">NO user With This Name</div>
            <?php
        }
    }
    if ($_POST["action"] == "editper") {

        $formerr = array();

        $user = filter_var($_POST["user"], FILTER_SANITIZE_STRING);
        $email = filter_var($_POST["email"], FILTER_SANITIZE_STRING);
        $gender = filter_var($_POST["gender"], FILTER_SANITIZE_NUMBER_INT);
        $country = filter_var($_POST["country"], FILTER_SANITIZE_NUMBER_INT);

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
        if ($country == 0) {
            $formerr[] = "country can't be <b>empty</b>";
        }
        if ($gender == 0) {
            $formerr[] = "gender can't be <b>empty</b>";
        }

        if (empty($formerr)) {
            $stmt = $con->prepare("SELECT * FROM user WHERE user_email = ? AND user_id != ?");
            $stmt->execute(array($email, $_SESSION["uid"]));
            $count = $stmt->rowCount();
            if ($count > 0) {
                $formerr[] = "email is already <b>exist</b>";
            } else {
                $stmt = $con->prepare("UPDATE user SET user_name = ? , user_email = ? ,  user_country = ?  , user_gender = ?  WHERE user_id = ? ");
                $stmt->execute(array($user, $email, $country, $gender, $_SESSION["uid"]));
                if ($stmt) {
            ?>
                    <div class="alert alert-success meg">
                        well Done your information is Updated...!! <br>
                        <?php
                        if ($gender == 1) {
                            echo "Mr " . ucfirst($user);
                        } else {
                            echo "Mrs " .  ucfirst($user);
                        }
                        ?>
                    </div>
                <?php
                }
            }
        }
        if (!empty($formerr)) {
            foreach ($formerr as $err) {
                ?>
                <div class="alert alert-danger meg"> <?php echo $err; ?> </div>
                <?php
            }
        }
    }
    if ($_POST["action"] == "change") {
        $formerr = array();

        if ($userinfo["user_forgot"] == 0) {
            $forgott = filter_var($_POST["forgotten"], FILTER_SANITIZE_NUMBER_INT);

            if (empty($forgott)) {
                $formerr[] = "forgotten password can't be <b>empty</b>";
            }

            if (empty($formerr)) {
                $stmt = $con->prepare("UPDATE user SET user_forgot = ?  WHERE user_id = ?");
                $stmt->execute(array($forgott, $_SESSION["uid"]));
                if ($stmt) {
                ?>
                    <div class="alert alert-success meg">
                        forgotten password is submit Successfully
                    </div>
                <?php
                }
            }
        } else {
            $oldforgott = filter_var($_POST["oldforgotten"], FILTER_SANITIZE_NUMBER_INT);
            $newforgott = filter_var($_POST["newforgotten"], FILTER_SANITIZE_NUMBER_INT);

            if (empty($oldforgott)) {
                $formerr[] = "old forgotten password can't be <b>empty</b>";
            }
            if (empty($newforgott)) {
                $formerr[] = "new forgotten password can't be <b>empty</b>";
            }
            if (!empty($oldforgott)) {
                if ($userinfo["user_forgot"] !==  $oldforgott) {
                    $formerr[] = "old forgotten password <b>is not correct</b>";
                }
            }

            if (empty($formerr)) {
                $stmt = $con->prepare("UPDATE user SET user_forgot = ?  WHERE user_id = ?");
                $stmt->execute(array($newforgott, $_SESSION["uid"]));
                if ($stmt) {
                ?>
                    <div class="alert alert-success meg">
                        forgotten password is submit Successfully
                    </div>
                <?php
                }
            }
        }
        if (!empty($formerr)) {
            foreach ($formerr as $err) {
                ?>
                <div class="alert alert-danger meg"> <?php echo $err; ?> </div>
            <?php
            }
        }
    }
    if ($_POST["action"] == "changepass") {

        $formerr = array();

        $oldpass = filter_var($_POST["oldpassowrd"], FILTER_SANITIZE_STRING);
        $newpass = filter_var($_POST["newpass"], FILTER_SANITIZE_STRING);
        $newpass2 = filter_var($_POST["newpass2"], FILTER_SANITIZE_STRING);

        if (empty($oldpass)) {
            $formerr[] = "old password can't be <b>empty</b>";
        }
        if (empty($newpass)) {
            $formerr[] = "new password can't be <b>empty</b>";
        }
        if (!empty($newpass)) {
            if ($newpass !== $newpass2) {
                $formerr[] = "password is not <b>match</b>";
            }
        }
        if ($userinfo["user_pass"] !== $oldpass) {
            $formerr[] = "old password is not <b>correct</b>";
        }

        if (empty($formerr)) {
            $stmt = $con->prepare("UPDATE user SET user_pass = ?  WHERE user_id = ?");
            $stmt->execute(array($newpass, $_SESSION["uid"]));
            if ($stmt) {
            ?>
                <div class="alert alert-success meg">
                    password changed Successfully...!
                </div>
            <?php
            }
        }
        if (!empty($formerr)) {
            foreach ($formerr as $err) {
            ?>
                <div class="alert alert-danger meg"> <?php echo $err; ?> </div>
            <?php
            }
        }
    }
    if($_POST["action"] == "sendimage")
    {
        $formerr = array();

        $fname = $_FILES["imguser"]["name"];
        $ftmp  = $_FILES["imguser"]["tmp_name"];
        $fsize = $_FILES["imguser"]["size"];
        
        $allowextions = array("png","jpeg","jpg");
        $extion = explode(".",$fname);
        $extion = end($extion);
        $extion = strtolower($extion);

        if(empty($fname))
        {
            $formerr[] = "image can't be <b>empty</b>";
        }
        if(!empty($fname))
        {
            if(!in_array($extion,$allowextions))
            {
                $formerr[] = "this file not <b>allowed</b>";
            }
            if($fsize > 4202500)
            {
                $formerr[] = "this image greater than <b>4MB</b>";
            }
        }
        if(empty($formerr))
        {
            $image = rand(0,1000)."_".$fname;
            $path = "C:\\xampp\\htdocs\\php_mah\\chating\\upload\\";
            move_uploaded_file($ftmp,$path.$image);

            $stmt = $con->prepare("UPDATE user SET  user_image = ? WHERE user_id = ?");
            $stmt->execute(array($image,$_SESSION["uid"]));
            $count = $stmt->rowCount();
            if($count > 0)
            {
                ?>
                <div class="alert alert-success meg">
                    image Updated Successfully...!
                </div>
            <?php
            }
        }
        if (!empty($formerr)) {
            foreach ($formerr as $err) {
            ?>
                <div class="alert alert-danger meg"> <?php echo $err; ?> </div>
            <?php
            }
        }
    }
}
