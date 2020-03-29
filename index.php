<!-- 
    
Created by Umair Abbas
CRUD (Create, Read, Update, Delete) using PDO (PHP Data Objects) and following MVC (Model, View, Controller) Arcitecture 

If you want CRUD using MySQLi and non MVC way (which is easier than PDO)
then check out my this github repo https://github.com/UmairKing/MySQL_CRUD_MySQLI

-->

<?php
include('includes/UserModel.php'); //Model
include('includes/UserController.php'); //Controller
include('includes/UserView.php'); //View
$msg = NULL;
$alClass = NULL;
if (isset($_POST['isubmit'])) {
    $name = htmlentities($_POST['name']);
    $email = htmlentities($_POST['email']);
    $zipcode = htmlentities($_POST['zipcode']);

    $ContObj = new UserContoller();
    if ($ContObj->Continsert($name, $email, $zipcode)) {
        $alClass = "alert alert-success text-center";
        $msg = "User Inserted";
    } else {
        $alClass = "alert alert-success text-center";
        $msg = "User Insertion Failed";
    }
}

if (isset($_POST['delete'])) {
    $ContObj = new UserContoller();
    $delId = $_POST['delId'];
    if ($ContObj->Contdelete($delId)) {
        $alClass = "alert alert-success text-center";
        $msg = "Record Deleted Successfully!";
    } else {
        $alClass = "alert alert-success text-center";
        $msg = "Record Deletion Failed";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MySQL CRUD with PDO and MVC Arcitecture</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>


    <div class="container">
        <div class="<?php echo $alClass; ?> my-4"><?php echo $msg; ?></div>


        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="my-4">
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" class="form-control">
            </div>
            <div class="form-group">
                <label>Email address</label>
                <input type="email" name="email" class="form-control">
            </div>
            <div class="form-group">
                <label>zipcode</label>
                <input type="number" name="zipcode" class="form-control">
            </div>
            <button type="submit" name="isubmit" class="btn btn-primary">Insert</button>
        </form>
    </div>



    <div class="container my-5">
        <table class="table table-dark">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Zipcode</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php

                $viewObj = new UserView();
                $rows = $viewObj->getUsers();

                foreach ($rows as $row) {
                    echo "<tr>
                    <th>{$row['id']}</th>
                    <td>{$row['name']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['zipcode']}</td>
                    <td>
                    <form action='updateuser.php' method='POST' class='d-inline'>
                    <input type='hidden' name='editId' value={$row['id']}>
                    <button type='submit' name='edit' class='btn btn-primary'>Edit</button>
                    </form>
                    <form action='{$_SERVER['PHP_SELF']}' method='POST' class='d-inline'>
                    <input type='hidden' name='delId' value={$row['id']}>
                    <button type='submit' name='delete' class='btn btn-danger'>Delete</button>
                    </form>
                    </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>