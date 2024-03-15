<?php include 'includes/header.php';
    if(isset($_SESSION['auth'])){
        redirect('', 'You are already logged in');
    }
?>
    <div class="container">
    <?php showMessage();?>
        <form action="code.php" method="post">
            <h1>Sign In</h1>
            <div class="input-box">
                <input type="text" name="email" placeholder="Email Address"><i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="password" name="pwd" placeholder="Password"><i class='bx bxs-lock-alt'></i>
            </div>
            <div class="remember-forgot">
                <label><input type="checkbox" name="">Remember Me</label>
                <a href="#">Forgot Password</a>
            </div>
            <button type="submit" name="login" class="btn">Sign In</button>
            <div class="register-link">
                <p>Don't have an account yet? <a href="register.php">Sign Up</a></p>
            </div>
        </form>
        
    </div>
<?php include 'includes/footer.php'?>