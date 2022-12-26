<?php
@include('header.php');
@include('Database.php');
@include('nav.php');
?>

<?php

$departments = array("IT", "CS", "SC");
$error = '';
$success = '';

if (isset($_POST['submit'])) {
    $name = filter_var($_POST['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $department = filter_var($_POST['department'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if (empty($name) || empty($department) || empty($email) || empty($password)) {
        $error = "Please fill all fields";
    } else {
        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $department = strtoupper($department);
            if (in_array($department, $departments)) {
                if (strlen($password) > 6) {

                    $db = new Database();

                    $newPassword = $db->inc_password($password);

                    $sql = "INSERT INTO `employees` (`name`, `password`, `email`, `department`) VALUES ('$name', '$newPassword', '$email', '$department')";
                    $success = $db->insert($sql);

                    $success = "Data is Valid";
                } else {
                    $error = "Password must be at least 6 characters";
                }
            } else {
                $error = "This department not Found";
            }
        } else {
            $error = "Please enter a valid email address";
        }
    }
}

?>

    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h2 class="p-3 col text-center mt-5 text-white bg-primary"> Add New Employee </h2>
            </div>
                <div class="col-sm-12">
                <?php if($error !=''): ?>
                    <h2 class="p-2 col text-center mt-5  alert alert-danger"> <?php echo $error; ?>  </h2>
                <?php endif; ?>

                <?php if($success !=''): ?>
                    <h2 class="p-2 col text-center mt-5  alert alert-success"> <?php echo $success; ?>  </h2>
                <?php endif; ?>

            </div>

                <div class="col-sm-12">


                        <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Enter name">
                            </div>

                            <div class="form-group">
                                <label for="department">Department</label>
                                <input type="text" name="department" class="form-control" id="department"
                                       placeholder="Enter department">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="text" name="email" class="form-control" id="exampleInputEmail1"
                                       aria-describedby="emailHelp" placeholder="Enter email">
                                <small id="emailHelp" class="form-text text-muted">We'll never share your email with
                                    anyone else.</small>
                            </div>


                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" name="password" class="form-control" id="exampleInputPassword1"
                                       placeholder="Password">
                            </div>

                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
        </div>
    </div>




<?php

@include('footer.php');

?>