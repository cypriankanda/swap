<?php
    include 'config/fun.php';
    $myId = $_SESSION['id'];
    $_SESSION['total'] = null;
    if(isset($_POST['register'])){
        $name = validateInput($_POST['name']);
        $username = validateInput($_POST['username']);
        $email = validateInput($_POST['email']);
        $phone = validateInput($_POST['phone']);	
        $image = $_FILES['image'];
        $main_subject = validateInput($_POST['main_subject']);
        $second_subject = validateInput($_POST['second_subject']);
        $tsc = validateInput($_POST['tsc']);
        $work_place = validateInput($_POST['work_place']);
        $dod = date('Y-m-d', strtotime(validateInput($_POST['dod'])));
        $pwd = validateInput($_POST['pwd']);
        $cpwd = validateInput($_POST['cpwd']);
        $bio = validateInput($_POST['bio']);

        

        
        if($pwd != $cpwd){
            redirect('register.php',"Password don't match");
        }
           
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            redirect('register.php',"Enter a valid email address");
        }
        $pwd = password_hash($pwd, PASSWORD_DEFAULT);
            $path = "uploads/";
            $fileName = $image['name'];
            $fileTmp = $image['tmp_name'];
    
            $fileext = pathinfo($fileName, PATHINFO_EXTENSION);
            $fileactext = strtolower($fileext);
            $fileupload = time().'.'.rand().'.'.$fileactext;
            
            
            
            								
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $run = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($run);
            if($count > 0) {
                redirect("register.php", "Email already exists");
            }
            else{
                $sql_tsc = "SELECT * FROM users WHERE tsc = '$tsc'";
                $run_tsc = mysqli_query($conn, $sql_tsc);
                $count_tsc = mysqli_num_rows($run_tsc);
                if($count_tsc > 0) {
                    redirect("register.php", "TSC Number already exists");
                }else{
                    $data = [
                        'name'=>$name,
                        'username'=>$username,
                        'email'=>$email,
                        'phone'=>$phone,
                        'image'=>$fileupload,
                        'main_subject'=>$main_subject,
                        'second_subject'=>$second_subject,
                        'tsc'=>$tsc,
                        'work_place'=>$work_place,
                        'dod'=>$dod,
                        'bio'=>$bio,
                        'pwd'=>$pwd
                    ];
                    $registerUser = insertRecord('users', $data);
                    if($registerUser){
                        if($image['size'] > 0 ){
                            move_uploaded_file($fileTmp, $path.$fileupload);
                        }
                        redirect('index.php',"Sign Up Success");
                    }
                    else{
                        redirect('register.php',"Sign Up Failed");
                    }
                }
                
            }
            } 
            else if(isset($_POST['login'])){
                $pwd = validateInput($_POST['pwd']);
                $email = validateInput($_POST['email']);
                if(empty($email) || empty($pwd)){
                    redirect('index.php',"Please enter your email address and password");

                }
                else{
                    $sql = "SELECT * FROM users WHERE email = '$email'";
                    $query = mysqli_query($conn,$sql);
                    if($query){
                         $count = mysqli_num_rows($query);
                        if($count == 1){
                            $row = mysqli_fetch_assoc($query);
                            $rowpwd = $row['pwd'];
                            $password_verified = password_verify($pwd, $rowpwd);
                            $id = $row['id'];
                            if($password_verified){
                                $id = $row['id'];
                                $_SESSION['auth']= true;
                                $_SESSION['id'] = $id;
                                $_SESSION['user']=[
                                    'email'=>$row['email'],
                                    'username'=>$row['username'],
                                    'name'=>$row['name'],
                                    'id'=>$id
                                ];
                                redirect('friend.php', 'Login successful');
                                
                            }else{
                                redirect('index.php', 'Password is Incorrect');
                            }
                        }else{
                            redirect('index.php',"Email address don't exist");
                        }
                }
                else {
                    redirect('index.php',"Please Enter correct email address and password");
                }
                
            }
        }else if(isset($_POST['add_friend'])){
            $id_from = validateInput($_POST['id_from']);
            $id_to = validateInput($_POST['id_to']);

            $sql = "SELECT * FROM requests WHERE (idFrom = '$id_from' && idTo = '$id_to') || (idTo = '$id_from' && idFrom = '$id_to')";
            $query = mysqli_query($conn, $sql);
            if($query){
                $count = mysqli_num_rows($query);
                if($count > 0){
                    redirect('friend.php',"Sorry Friend request already sent");
                }else{
                    $data = [
                        'idFrom'=>$id_from,
                        'idTo'=>$id_to
                    ];
                    $send_request = insertRecord('requests', $data);
                    if($send_request){
                        redirect('friend.php',"Friend Request sent successfully");
                    }else{
                    redirect('friend.php',"Sorry Friend request Not Sent");

                    }
                }
            }else{
                redirect('friend.php',"Something went wrong"); 
            }

        } else if(isset($_POST['accept_friend'])){
            $id_from = validateInput($_POST['id_from']);
            $id_to = validateInput($_POST['id_to']);
            
            $sql_accept = "UPDATE requests SET friend_status = '1' WHERE (idFrom = '$id_from' && idTo = '$id_to') || (idTo = '$id_from' && idFrom = '$id_to')";
            $friend_accept = mysqli_query($conn, $sql_accept);
            if($friend_accept){
                    redirect("request_friend.php", "Friend request Accepted");
            }else{
                redirect('request_friend.php',"Sorry already a  Friend "); 
            }
               
        }else if(isset($_POST['delete_profile'])){
            $id_from = validateInput($_POST['id_from']);
            $id_to = validateInput($_POST['id_to']);
            $sql = "DELETE FROM requests WHERE (idFrom = '$id_from' && idTo = '$id_to') || (idTo = '$id_from' && idFrom = '$id_to')";
            $query = mysqli_query($conn, $sql);
            if($query){
                redirect("request_friend.php", "Friend Rejected");
            }else{
                redirect("request_friend.php", "Something went wrong");
            }

        }
    

      
?>