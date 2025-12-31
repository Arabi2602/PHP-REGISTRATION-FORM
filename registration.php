<!DOCTYPE html>
<html>

<head>
     <link rel="stylesheet" href="assets/style.css" />
</head>
<body>

<form action="task.php" method='POST'>
  <div class="container">
    <h1>Registration Form</h1>
    <p>
        <?php

                                $status = $_GET['status'] ?? '';
                                if ($status) {
                                    echo $status;
                                }

                            ?>
    </p>
    <hr>

    <label for="name"><b>Name</b></label>
    <input type="text" placeholder="Enter Name" name="name" id="email" required>

    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="email" id="email" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" id="psw" required>

    <label for="psw-repeat"><b>Age</b></label>
    <input type="number" placeholder="Your age" name="age" id="psw-repeat" required>

     <input type="hidden" name="action" value="register">

    <hr>
    <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>

    <button type="submit" class="registerbtn">Register</button>
  </div>


</form>

    
</body>
</html>