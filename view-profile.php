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
                    if(isset($_POST['view_profile'])){
                        $id = mysqli_real_escape_string($conn, $_POST['id_to_search']);
                        $sql = "SELECT * FROM users WHERE id = $id";
                        $query = mysqli_query($conn, $sql);
                        $count = mysqli_num_rows($query);

                    if($query){
                        if($count > 0){
                            foreach($query as $items){
                                ?>
                                <div class="friends">
                                    <div class="img">
                                    <img src="uploads/<?= $items['image']?>" alt="">
                                    </div>
                                    <h3 class="nm">Name: <?= $items['name'];?></h3>
                                    <h3 class="nm">E-Mail: <?= $items['email'];?></h3>
                                    <h3 class="nm">Mobile Number: <?= $items['phone'];?></h3>
                                    <ul>
                                        <h3 class="nm">Teaching Subjects: </h3>
                                        <li class="subj"><?= $items['main_subject']?></li>
                                        <li class="subj"><?= $items['second_subject']?></li>
                                    </ul>
                                    <h3 class="nm">TSC Number: <?= $items['tsc'];?></h3>
                                    <h3 class="nm">Designation : <?= $items['work_place'];?></h3>
                                    <h3 class="nm">Date of Deployment: <?= date('Y-m-d', strtotime($items['dod']));?></h3>
                                    <h3 class="nm">Bio : <?= $items['bio'];?></h3>


                                    <div class="btn btn-view">
                                        <div>
                                             <a href="friend.php" class="back">Back</a>
                                        </div>
                                        <form action="code.php" method="post">
                                            <div>
                                                <input type="hidden" name="id_from" value="<?php echo $_SESSION['id'];?>">
                                                <input type="hidden" name="id_to" value="<?= $items['id']?>">
                                                <input type="submit" name="add_friend" value="Add Friend">
                                            </div>
                                        </form>
                                    </div>

                                    
                                    </div>
                                    
                                </div>
                                
                                
                                
                                <?php
                            }
                        }else{
                        // redirect('friend.php','There are no friends to add');
                        }
                    }else{
                        // redirect('friend.php','Something went wrong');
                    }
               

                    }
                   
                ?>
            </div>
        </div>
    </div>
<?php include 'includes/footer.php'?>