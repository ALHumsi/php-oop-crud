<?php
@include('header.php');
@include('Database.php');
@include('nav.php');
?>
<?php
$db = new Database();
$row = $db->find('employees',$_GET['id']); ?>
<?php if(isset($_GET['id']) && is_numeric($_GET['id']) && $row):  ?>

    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h2 class="p-3 text-center mt-5 text-white bg-primary">Delete Employees</h2>

                    <h2 class="p-2 col text-center mt-5  alert alert-success"> <?php echo $db->delete("employees", $row['id']); ?>  </h2>

            </div>
        </div>

        <?php endif;?>



<?php

@include('footer.php');

?>