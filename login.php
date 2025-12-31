<!DOCTYPE html>
<html>
  <head>
     <link rel="stylesheet" href="assets/style.css" />
</head>
<body>

<!-- <h5>Login Forms</h2> -->
<p>
        <?php

                                $status = $_GET['status'] ?? '';
                                if ($status) {
                                    echo $status;
                                }

                            ?>
    </p>

<form action="task.php" method="POST">

<h3>Login Forms</h2>
  <label>email:</label><br>
  <input type="email" name="email"><br>
  <label> password:</label><br>
  <input type="password" name="password"><br><br>
  <input type="hidden" name="action" value="login">

  <input type="submit" value="Submit">
</form> 

</body>
</html>