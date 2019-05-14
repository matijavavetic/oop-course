<?php require_once("includes/header.php");
require_once("includes/init.php");

if(!$session->isUserSingedIn()) {
    redirect("login.php");

}

if(empty($_GET['id'])) {
    redirect("users.php");
}

$user = new User();
$user = User::find_by_id($_GET['id']);

if(isset($_POST['update'])) {
    if ($user) {
        $user->username = $_POST['username'];
        $user->password = $_POST['password'];
        $user->first_name = $_POST['first_name'];
        $user->last_name = $_POST['last_name'];

        if (empty($_FILES['userImg'])) {
            $user->save();
        } else {
            $user->setFile($_FILES['userImg']);
            $user->saveUserData();
            $user->save();

            redirect("edit_user.php?id={$user->id}");
        }
    }
}

if(isset($_POST['delete'])) {
    $user = User::find_by_id($_GET['id']);

    if($user) {
        $user->delete();
        redirect("users.php");
    } else {
        redirect("users.php");
    }
}

?>
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" xmlns:http="http://www.w3.org/1999/xhtml"
         xmlns:http="http://www.w3.org/1999/xhtml">
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
                        Edit user
                    </h1>
                    </h1>

                    <div class="col-md-6">
                        <img class="img-responsive" src="<?php echo $user->imagePathAndPlaceholder(); ?>" alt=""/>
                </div>

                    <form action="" method="post" enctype="multipart/form-data">


                        <div class="col-md-6">

                            <div class="form-group">
                                <input type="file" name="userImg" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" class="form-control" value="<?php echo $user->username;?>">
                            </div>


                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" value="<?php echo $user->password; ?>">
                            </div>

                            <div class="form-group">
                                <label for="first_name">First name</label>
                                <input type="text" name="first_name" class="form-control" value="<?php echo $user->first_name;?>">
                            </div>

                            <div class="form-group">
                                <label for="last_name">Last name</label>
                                <input type="text" name="last_name" class="form-control" value="<?php echo $user->last_name;?>">
                            </div>

                            <div class="form-group">

                                <button type="submit" name="delete" class="btn btn-primary pull-left">Delete</button>
                                <input type="submit" name="update" class="btn btn-primary pull-right">
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