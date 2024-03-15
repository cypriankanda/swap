<?php
     include 'includes/headers.php';
     if(!isset($_SESSION['auth'])){
        redirect('index.php', 'Please login to continue');
        exit();
    }
?>
    <div class="wrapper">
    <h3 class="email-profile">Welcome: <?= $_SESSION['user']['email']?></h3>
        
    </div>
<?php include 'includes/footer.php'?>