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

                <div class="search">
                    
                    <form action="friend.php" method="post">
                        <input type="text" name="search" value="<?php if(isset($_POST['search_btn'])){echo $_POST['search'];}?>" placeholder = "Search for a Subject or Location">
                        <input type="submit" name="search_btn" value="Search for a potential transfer">
                    </form>
                </div>
                <h3 class="email-profile">Welcome: <?= $_SESSION['user']['username']?></h3>
                <?php 
                    
                    $myId = $id;
                    
                    
                    if(isset($_POST['search_btn'])){
                        $search = mysqli_real_escape_string($conn, $_POST['search']);
                        $sql = "SELECT * FROM users WHERE CONCAT(main_subject, second_subject, work_place) LIKE '%$search%' && id != '$myId'";
                    }else{
                        $sql = "SELECT * FROM users  WHERE id != '$myId'";
                    }
                    $all = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($all);
                    if($count > 0){
                    if($all){
                        foreach($all as $items){
                            // Check if a friend request has already been sent
                            $checkSql = "SELECT * FROM friend_requests WHERE (sender_id = '$myId' AND receiver_id = '{$items['id']}') OR (sender_id = '{$items['id']}' AND receiver_id = '$myId')";
                            $checkResult = mysqli_query($conn, $checkSql);
                            $requestExists = (mysqli_num_rows($checkResult) > 0);
                            ?>
                            <div class="friend">
                                <div class="img">
                                <img src="uploads/<?= $items['image']?>" alt="">
                                </div>
                                <h3 class="nm">Name: <?= $items['name'];?></h3>
                                <h3 class="nm">E-Mail: <?= $items['email'];?></h3>
                                <ul>
                                    <h3 class="nm">Teaching Subjects</h3>
                                    <li class="subj"><?= $items['main_subject']?></li>
                                    <li class="subj"><?= $items['second_subject']?></li>
                                </ul>
                                
                                    <div class="btn">
                                    <?php if (!$requestExists): ?>
                                    <form action="code.php" method="post">
                                        <div>
                                            <input type="hidden" name="id_from" value="<?php echo $_SESSION['id'];?>">
                                            <input type="hidden" name="id_to" value="<?= $items['id']?>">
                                            <input type="submit" name="add_friend" value="Add Friend">
                                        </div>
                                    </form>
                                    <?php else: ?>
                                        <span>Friend request already sent</span>
                                    <?php endif; ?>
                                    <form action="view-profile.php" method="post">
                                        <div>
                                            <input type="hidden" name="id_to_search" value="<?= $items['id']?>">
                                            <input type="submit" class="profi" name="view_profile" value="View Profile">
                                        </div>
                                    </form>
                                    </div>
                                
                            </div>
                            
                            
                            
                            <?php
                        }
                       
                    }else{
                        // redirect('friend.php','Something went wrong');
                    }
                }
                else{
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