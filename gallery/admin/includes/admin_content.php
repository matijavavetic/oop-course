<?php require_once("header.php"); ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">


        <?php
        include("init.php");
/*
        $user = User::find_users_by_id(1);
        $user->first_name= "Okeeeeee";

        $user->update();
*/
        $user = User::find_users_by_id(3);
        $user->delete();

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
