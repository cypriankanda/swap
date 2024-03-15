<?php
// Authentication and Database Connection
include 'includes/headers.php'; // Assuming headers.php contains database connection, sessions, etc.

if (!isset($_SESSION['auth'])) {
    redirect('index.php', 'Please login to continue');
    exit();
}

$id = $_SESSION['id'];

// Form Submission Handling
if (isset($_POST['update_profile'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $subject1 = mysqli_real_escape_string($conn, $_POST['main_subject']);
    $subject2 = mysqli_real_escape_string($conn, $_POST['second_subject']);

    // Image Upload Handling
    if ($_FILES['image']['size'] > 0) {
        $target_dir = "uploads/";
        $imageFileType = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));

        // Basic Validation (You should add more robust validation)
        $allowedTypes = ['jpg', 'jpeg', 'png'];
        if (!in_array($imageFileType, $allowedTypes)) {
            $errorMessage = "Sorry, only JPG, JPEG, and PNG files are allowed.";
        } else {
            $newImageName = $id . '.' . $imageFileType;
            $target_file = $target_dir . $newImageName;

            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $sql = "UPDATE users SET name = '$name', main_subject = '$subject1', second_subject= '$subject2', image = '$newImageName' WHERE id = '$id'";
            } else {
                $errorMessage = "Error uploading image file.";
            }
        }
    } else {
        // Update without image change
        $sql = "UPDATE users SET name = '$name', main_subject = '$subject1', second_subject= '$subject2' WHERE id = '$id'"; 
    }

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        $successMessage = 'Profile updated successfully!';
    } else {
        $errorMessage = 'Error updating profile. Please try again.';
    }
}

// Fetch Existing Data 
$sql = "SELECT * FROM users WHERE id = '$id'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
} else {
    $errorMessage = 'User not found.'; 
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Profile</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div class="wrapper">
    <h2>Update Profile</h2>

    <?php  
        if (isset($successMessage)) {
            echo '<div class="success-message">' . $successMessage . '</div>';
        }
        if (isset($errorMessage)) {
            echo '<div class="error-message">' . $errorMessage . '</div>';
        }
    ?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data"> 
        <div class="form-group"> 
            <label for="image">Upload Photo:</label>
            <input type="file" id="image" name="image" class="file-input">
        </div>
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo isset($user) ? $user['name'] : ''; ?>" required>
        </div>
       <div class="form-group">
            <label for="main_subject">Main Subject:</label>
            <input type="text" id="main_subject" name="main_subject" value="<?php echo isset($user) ? $user['main_subject'] : ''; ?>" required>
        </div>
        <div class="form-group">
            <label for="second_subject">Second Subject:</label>
            <input type="text" id="second_subject" name="second_subject" value="<?php echo isset($user) ? $user['second_subject'] : ''; ?>"> 
        </div>
        <button type="submit" name="update_profile">Update Profile</button>
    </form>
</div>

</body>
</html>
