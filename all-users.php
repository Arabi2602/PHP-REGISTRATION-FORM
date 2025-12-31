<?php

session_start();

$id = $_SESSION['id'] ?? '';

if ($id == '') {
  header('location:login.php');
  return;
}

include "config.php";

$query = "SELECT * FROM users WHERE id='$id' ";
$res   = mysqli_query($connection, $query);
$data  = mysqli_fetch_assoc($res);

$allMembers    = "select * from users";
$allMembersres = mysqli_query($connection, $allMembers);

?>

<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="assets/style.css" />
</head>

<div class="allusers">

  <body>


    <?php if (mysqli_num_rows($allMembersres) > 0) { ?>
      <table>
        <tr>
          <th>Email</th>
          <th>Name</th>


          <th>Status</th>
          <?php
          if ($data['status'] == 1 || $data['status'] == 2) { ?>
            <th>Action</th>
          <?php
          }
          ?>
        </tr>



        <?php
        while ($singleMember = mysqli_fetch_assoc($allMembersres)) {
          if ($singleMember['id'] != $data['id']) {
        ?>


            <tr>
              <td><?php echo $singleMember['email']; ?></td>
              <td><?php echo $singleMember['name']; ?></td>


              <?php
              if ($singleMember['status'] == 1 || $singleMember['status'] == 2) { ?>
                <td style="background-color: #ff2929;">Admin</td>
              <?php
              } else {
              ?>
                <td style="background-color: #47cd39;">Member</td>
              <?php } ?>


              <?php if ($data['status'] == 1) { ?>
                <td>

                  <a href="edit.php?editId=<?php echo $singleMember['id']; ?>" class="btn-edit btn-info" style="display:inline-block;">Edit</a>

                  <!--------------Delete member Start ------------->

                  <!-- <a href="#" onclick="return confirm('Are you sure to delete?')" class="btn-delete btn-danger delete" data-taskid="<?php echo $singleMember['id']; ?>">Delete</a> -->
                  <form method="POST" action="task.php" style="display:inline-block;">
                    <input type="hidden" name="action" value="deleteRequest">
                    <input type="hidden" name="taskid" value="<?php echo $singleMember['id']; ?>">
                    <button type="submit" class="btn-delete" onclick="return confirm('Are you sure to delete?')">
                      Delete
                    </button>
                  </form>
                  <!--------------Delete member End ------------->


                  <!--------------Make as admin/member button Start ------------->
                  <?php if ($singleMember['status'] == 2) { ?>
                    <!-- <a href="#" onclick="return confirm('Are you sure to make him as Member?')" class="btn-edit btn-success member" data-taskid="<?php echo $singleMember['id']; ?>">Make as member</a> -->
                    <form method="POST" action="task.php" style="display:inline-block;">
                      <input type="hidden" name="action" value="memberRequest">
                      <input type="hidden" name="taskid" value="<?php echo $singleMember['id']; ?>">
                      <button type="submit" class="btn-edit btn-make"
                        onclick="return confirm('Are you sure to make him as Member?')">
                        Make as member
                      </button>
                    </form>
                  <?php } elseif ($singleMember['status'] == 3) { ?>
                    <!-- <a href="#" onclick="return confirm('Are you sure to make him as Admin?')" class="btn-edit btn-success admin" data-taskid="<?php echo $singleMember['id']; ?>">Make as admin</a> -->
                    <form method="POST" action="task.php" style="display:inline-block;">
                      <input type="hidden" name="action" value="adminRequest">
                      <input type="hidden" name="taskid" value="<?php echo $singleMember['id']; ?>">
                      <button type="submit" class="btn-edit btn-make"
                        onclick="return confirm('Are you sure to make him as Admin?')">
                        Make as admin
                      </button>
                    </form>
                  <?php } ?>
                  <!--------------Make as admin/member button End ------------->

                <?php } ?>
                <?php
                if ($data['status'] == 2) { ?>
                <td>
                  <a href="edit.php?editId=<?php echo $singleMember['id']; ?>" class="btn-edit btn-info">Edit</a>
                </td>
              <?php } ?>
            </tr>
        <?php }
        } ?>
        </tbody>
      </table>
    <?php } ?>

  </body>
</div>

</html>