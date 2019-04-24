
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">


        <?php
        include("init.php");


        $result_set = User::find_all_users();

        while($row = mysqli_fetch_array($result_set)) {

            echo $row['username'] . "<br>";

        }

        /*$found_user = User::find_users_by_id(1);

        echo $found_user['username'];
*/
        ?>
        <div class="col-lg-12">
            <h1 class="page-header">
                ADMIN
                <small>Subheading</small>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                </li>
                <li class="active">
                    <i class="fa fa-file"></i> Blank Page
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->

</div>
