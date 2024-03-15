<?php include 'includes/headers.php';
    $id = $_SESSION['id'];
    if(!isset($_SESSION['auth'])){
        redirect('index.php', 'Please login to continue');
        exit();
    }
?>
    <div class="wrapper">
        <div class="box">
            <?php showMessage();?>
            <div class="boxes">
                <h3 class="email-profile">Welcome: <?= $_SESSION['user']['email']?></h3>
                <?php 
                    $_SESSION['total'] = null;
                    $myId = $id;
                    $sql = "SELECT * FROM requests INNER JOIN users ON requests.idFrom = users.id WHERE requests.friend_status = 0 && users.id != $myId";
                    $all = mysqli_query($conn, $sql);
                    if($all){
                        $count = mysqli_num_rows($all);
                        if($count > 0){
                            $_SESSION['total'] = $count;
                            foreach($all as $items){
                                // Check if the friend request has been accepted
                                $checkSql = "SELECT * FROM friend_requests WHERE (sender_id = '$myId' AND receiver_id = '{$items['id']}' AND status = 1) OR (sender_id = '{$items['id']}' AND receiver_id = '$myId' AND status = 1)";
                                $checkResult = mysqli_query($conn, $checkSql);
                                $requestAccepted = (mysqli_num_rows($checkResult) > 0);
                                ?>
                                <div class="friend">
                                    <div class="img">
                                    <img src="uploads/<?= $items['image']?>" alt="">
                                    </div>
                                    <?php if (!$requestAccepted): ?>
                                        <h3 class="nm">Name: <?= $items['name'];?></h3>
                                        <h3 class="nm">E-Mail: <?= $items['email'];?></h3>
                                        <ul>
                                            <h3 class="nm">Teaching Subjects</h3>
                                            <li class="subj"><?= $items['main_subject']?></li>
                                            <li class="subj"><?= $items['second_subject']?></li>
                                        </ul>
                                    <?php endif; ?>
                                    <div class="btn">
                                        <form action="code.php" method="post">
                                            <div>
                                                <input type="hidden" name="id_from" value="<?php echo $_SESSION['id'];?>">
                                                <input type="hidden" name="id_to" value="<?= $items['id']?>">
                                                <input type="submit" name="accept_friend" value="Accept Friend">
                                            </div>
                                        </form>
                                        <form action="code.php" method="post">
                                            <div>
                                                <input type="hidden" name="id_from" value="<?php echo $_SESSION['id'];?>">
                                                <input type="hidden" name="id_to" value="<?= $items['id']?>">
                                                <input type="submit" class="delete" name="delete_profile" value="Cancel Request">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <?php
                            }
                        } else {
                            // redirect('friend.php','Something went wrong');
                        }
                    } else {
                        ?>
                        <div class="friend">
                            <h3 class="nm" style="text-align: center;">Sorry, No Search Friend</h3>
                        </div>
                        <?php
                    }
                ?>
            </div>
        </div>
    </div>
<?php include 'includes/footer.php'?>