<?php require_once("header.php"); ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">


        <?php
        include("init.php");

        $user = new User();

        $user->username = "radibrt";
        $user->password = "sd";
        $user->first_name = "assa";
        $user->last_name = "ass";

        $user->create();

/*
        $user = User::find_users_by_id(4);
        $user->username = "waitamin";
        $user->password = "oof";
        $user->first_name = "yeet";
        $user->last_name = "spicy";

        $user->update();
        /*
                $user = User::find_users_by_id(2);
                $user->delete();

                $user = User::find_users_by_id(6);
                $user->password = "Ae";
                $user->save();
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
