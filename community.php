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
                    
                    $sql = "SELECT * FROM requests INNER JOIN users ON requests.idFrom = users.id WHERE requests.friend_status = 1 && users.id != $myId";
                   
                    $all = mysqli_query($conn, $sql);
                    if($all){
                    $count = mysqli_num_rows($all);
                    
                    if($count > 0){
                        $_SESSION['total'] = $count;
                    
                        foreach($all as $items){
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
                                    
                        <h3 class="nm" style="text-align: center;">Sorry, No Search available</h3>
                        
                        
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
<?php include 'includes/footer.php'?>