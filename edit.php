<?php


include "config.php";


$editId = $_GET['editId'] ?? '';
// echo $editId;exit;

$query = "SELECT * FROM users WHERE id='$editId' ";
$res = mysqli_query($connection, $query);
$data = mysqli_fetch_assoc($res);

?>


<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="assets/style.css" />
</head>

<body>

    <?php if (mysqli_num_rows($res) > 0) { ?>
        <form action="task.php?editId=<?php echo $editId ?>" method="post">
            <label for="fname">Email</label>
            <input type="email" value="<?php echo $data['email'] ?>" id="fname" name="email">

            <label for="lname">Name</label>
            <input type="text" value="<?php echo $data['name'] ?>" id="lname" name="name">


            <label for="lname">Password</label>
            <input type="number" value="<?php echo $data['password'] ?>" id="pname" name="password">

             <input type="hidden" name="action" value="editUser">
            <input type="hidden" name="user-id" value="<?php echo $data['id'] ?>">

            <input type="submit" style="margin-top: 6px;" name="submit" value="Update">
           
        </form>
    <?php } ?>


</body>

</html>