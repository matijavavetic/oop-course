<?php require_once("includes/header.php");
require_once("includes/init.php");

if(!$session->isUserSingedIn()) {
    redirect("login.php");

}

$user = new User();

if(isset($_POST['create'])) {
    if($user) {
        $user->username = $_POST['username'];
        $user->password = $_POST['password'];
        $user->first_name = $_POST['first_name'];
        $user->last_name = $_POST['last_name'];
        $user->setFile($_FILES['userImg']);
        $user->saveUserData();

    }

}

/*
if(empty($_GET['id'])) {
    redirect("users.php");
} else {
    $user = User::find_by_id($_GET['id']);
    if(isset($_POST['update'])) {
        if($user) {
            $user->title = $_POST['title'];
            $user->caption = $_POST['caption'];
            $user->alternate_text = $_POST['alternate_text'];
            $user->description = $_POST['description'];
        }
    }
}

$user->save();
*/
?>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->


        <?php include("includes/top_nav.php"); ?>







        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->

        <?php include("includes/side_nav.php") ?>

        <!-- /.navbar-collapse -->

    </nav>





    <div id="page-wrapper">
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Add user
                        <small>Subheading</small>
                    </h1>

                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="col-md-6 col-md-offset-3">

                            <div class="form-group">
                                <input type="file" name="userImg" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" class="form-control">
                            </div>


                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="text" name="password" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="first_name">First name</label>
                                <input type="text" name="first_name" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="last_name">Last name</label>
                                <input type="text" name="last_name" class="form-control">
                            </div>

                            <div class="form-group">
                                <input type="submit" name="create" class="btn btn-primary pull-right">
                            </div>

                        </div>


                    </form>
                </div>


            </div>
        </div>
        <!-- /.row -->

    </div>


    </div>
    <!-- /#page-wrapper -->

<?php include("includes/footer.php"); ?>