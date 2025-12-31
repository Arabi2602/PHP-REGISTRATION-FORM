<?php
include "config.php";
session_start();

if ($_POST["action"] == "mini-address") {

    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];

    $query = "INSERT into address(name,email,phone) values ('$name','$email','$phone')";
    $push = mysqli_query($connection, $query);
    header("Location: all-users.php");
}

if ($_POST["action"] == "marks") {

    $name = $_POST["name"];
    $sub1 = $_POST["subject-1"];
    $sub2 = $_POST["subject-2"];
    $sub3 = $_POST["subject-3"];
    $sub4 = $_POST["subject-4"];
    $sub5 = $_POST["subject-5"];


    $query = "INSERT into register(name,sub1,sub2,sub3,sub4,sub5) values ('$name','$sub1','$sub2','$sub3','$sub4','$sub5')";
    $push = mysqli_query($connection, $query);
    header("Location: all-users.php");
} else if ($_POST['action'] == 'editUser') {
    $email = $_POST['email'] ?? '';
    $name = $_POST['name'] ?? '';
    $password = $_POST["password"] ?? '';
    $id = $_POST['user-id'] ?? '';

    $query = "UPDATE users SET email='$email', name='$name', password='$password' WHERE id = '$id' ";
    $res = mysqli_query($connection, $query);

    // $status = "Information Updated Successfully";
    header("Location: all-users.php");
} else if ($_POST['action'] == 'register') {

    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $age = $_POST['age'] ?? '';

    if ($email && $password) {

        $check = "SELECT * FROM users WHERE email='$email' LIMIT 1";
        $checkRes = mysqli_query($connection, $check);



        if (mysqli_num_rows($checkRes) > 0) {
            $status = "Duplicate Email entered";
        } else {
            $password = password_hash($password, PASSWORD_BCRYPT);
            $query = "INSERT into users(name,email,password,age) VALUES ('$name','$email','$password','$age')";
            $res = mysqli_query($connection, $query);
            if ($res) {
                $status = "Information saved successfully ";
            } else {
                $status = "Database error: " . mysqli_error($connection);
            }
        }
    } else {
        $status = "email or password is empty";
    }
    // var_dump($password);exit;
    header("location:registration.php?status={$status}");
}

//     else if ($_POST['action'] == 'register') {

//     $name     = $_POST['name'] ?? '';
//     $email    = $_POST['email'] ?? '';
//     $password = $_POST['password'] ?? '';
//     $age      = $_POST['age'] ?? '';

//     if ($email && $password) {

//         // Hash password securely
//         $passwordHash = password_hash($password, PASSWORD_BCRYPT);

//         // Use prepared statement to prevent SQL injection
//         $stmt = $connection->prepare("INSERT INTO users (name, email, password, age) VALUES (?, ?, ?, ?)");
//         $stmt->bind_param("ssss", $name, $email, $passwordHash, $age);

//         if ($stmt->execute()) {
//             $status = "Information saved successfully";
//         } else {
//             // Check for duplicate email error (MySQL error code 1062)
//             if ($connection->errno == 1062) {
//                 $status = "Duplicate Email entered";
//             } else {
//                 $status = "Database error: " . $connection->error;
//             }
//         }

//         $stmt->close();

//     } else {
//         $status = "Email or password is empty";
//     }

//     header("Location: registration.php?status=" . urlencode($status));
//     exit;
// }


else if ($_POST['action'] == 'login') {
    $email    = $_POST['email'];
    $password = $_POST['password'];


    if ($email && $password) {

        $q    = "SELECT * FROM users WHERE email='$email' ";

        $info = mysqli_query($connection, $q);

        $res  = mysqli_num_rows($info);

        $data = mysqli_fetch_assoc($info);

        $pass = $data['password'];

        if ($res > 0) {
            if (password_verify($password, $pass)) {
                $_SESSION['id'] = $data['id'];
                $status         = "Logged in successfully";
                header("location:home.php?status={$status}");
                return;
            } else {
                $status = "email and password didn't match";
            }
        } else {
            $status = "user doesn't exists";
        }
    } else {
        $status = "email or password is empty";
    }
    header("location:login.php?status={$status}");
} else if ($_POST['action'] == 'editProfile') {
    $email = $_POST['email'] ?? '';

    $password = $_POST["password"] ?? '';

    $age = $_POST["age"] ?? '';

    $id = $_SESSION['id'] ?? '';

    $query = "UPDATE users SET email='$email', password='$password', age='$age' WHERE id = '$id' ";
    $res = mysqli_query($connection, $query);
    $status = "Updated successfully";
    header("location:home.php?status={$status}");
}
else if ($_POST['action'] == 'deleteRequest') {
    $id =$_POST['taskid'];
    $query ="DELETE FROM users WHERE id='$id' ";
    $res = mysqli_query($connection, $query);
    header('location:all-users.php');
}
else if ($_POST['action'] == 'memberRequest') {
    $id =$_POST['taskid'];
    $query = "UPDATE users SET status=3 where id='$id' ";
     $res = mysqli_query($connection, $query);
    header('location:all-users.php');
}
else if ($_POST['action'] == 'adminRequest') {
    $id =$_POST['taskid'];
    $query = "UPDATE users SET status=2 where id='$id' ";
     $res = mysqli_query($connection, $query);
    header('location:all-users.php');
}
