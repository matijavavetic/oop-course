<?php

require_once("admin/includes/init.php");
include("includes/header.php");

if(empty($_GET['id'])) {
    redirect("index.php");
}

$photo = Photo::find_by_id($_GET['id']);

echo $photo->title;

if(isset($_POST['submit'])) {
    $author = trim($_POST['author']);
    $body = trim($_POST['body']);

    $newComment = Comment::createComment($photo->id, $author, $body);

    if ($newComment && $newComment->save()) {
        redirect("photo.php?id={$photo->id}");
    } else {
        $message = "There was a problem submitting";

    }
} else {
    $author = "";
    $body = "";
}

$comment = Comment::findComment($photo->id);


    ?>

<div class="row">
            <!-- Blog Post Content Column -->
            <div class="col-lg-12">

                <!-- Blog Post -->

                <!-- Title -->
                <h1><?php echo $photo->title; ?></h1>

                <!-- Author -->
                <p class="lead">
                    by <a href="#">Matija</a>
                </p>

                <hr>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on August 24, 2013 at 9:00 PM</p>

                <hr>

                <!-- Preview Image -->
                <img class="" src="admin/<?php echo $photo->picturePath(); ?>" alt="Text">

                <hr>

                <!-- Post Content -->
                <p class="lead"><?php echo $photo->caption; ?></p>
                <p><?php echo $photo->description; ?></p>

                <hr>

                <!-- Blog Comments -->

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" method="post">
                        <div class="form-group">
                            <label for="author">Author</label>
                            <input type="text" name="author" class="form-control">
                        </div>
                        <div class="form-group">
                            <textarea name="body" class="form-control" rows="3"></textarea>
                        </div>

                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

                <!-- Comment -->


            <?php foreach($comment as $commentShow):
                ?>
            <div class="media">
                <a class="pull-left" href="#">
                    <img class="media-object" src="http://placehold.it/64x64" alt="">
                </a>

                <div class="media-body">
                    <h4 class="media-heading"><?php echo $commentShow->author; ?>
                        <small>August 25, 2030 at 9:30 PM</small>
                    </h4>
                    <?php echo $commentShow->body; ?>
                </div>
            </div>

                <?php endforeach; ?>

            </div>

<!-- Blog Sidebar Widgets Column -->
<!--<div class="col-md-4">


    <?php //include("includes/sidebar.php"); ?>



</div> -->
<!-- /.row -->
</div>

<?php include("includes/footer.php"); ?>
