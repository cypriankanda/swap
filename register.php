<?php 
      include 'includes/header.php';
?>
    <div class="container">
        <?php showMessage();?>
        <form action="code.php" method="POST" enctype="multipart/form-data">
            <h1>Sign Up</h1>
            <div class="input-box">
                <input type="text" name="name" placeholder="Name"><i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="text" name="username" placeholder="Username "><i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="text" name="email" placeholder="Email Address"required><i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="text" name="phone" placeholder="Enter Mobile Number"><i class='bx bxs-user'></i>
            </div>
            <div class="input-file">
            <label for="">Upload Photo</label><br>
                    <input type="file" name="image" class="file-input">
            </div>
            <div class="input-box">
                
                <input type="text" name="main_subject" placeholder="Enter Main Subject"required><i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="text" name="second_subject" placeholder="Enter Second Subject"required><i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="text" name="tsc" placeholder="Enter TSC Number"required><i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="text" name="work_place" placeholder="Enter Constituency"required><i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="date" name="dod" placeholder="Date of deployment"required><i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <textarea name="bio" placeholder="Write Your Bio"></textarea>
            </div>
            <div class="input-box">
                <input type="password" name="pwd" placeholder="Password"><i class='bx bxs-lock-alt'></i>
            </div>
            <div class="input-box">
                <input type="password" name="cpwd" placeholder="Confirm Password"><i class='bx bxs-lock-alt'></i>
            </div>
            
            <button type="submit" name="register" class="btn">Sign Up</button>
            <div class="register-link">
                <p>Already have an account yet? <a href="index.php">Sign In</a></p>
            </div>
        </form>
        
    </div>
<?php include 'includes/footer.php'?>