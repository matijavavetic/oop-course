<?php include("includes/header.php");

$photos = Photo::find_all();

$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;

$itemsPerPage = 4;
$itemsTotalCount = Photo::COUNT_ALL();

?>


        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-12">

            <?php foreach ($photos as $photo): ?>
            
          <div class="thumbnails row">

            <div class="col-xs-6 col-md-3">

                <a class="thumbnail" href="photo.php?id=<?php echo $photo->id; ?>">

                    <img class="img-responsive home_page_photo" src="admin/<?php echo $photo->picturePath(); ?>" alt="">
                </a>
            </div>

            <?php endforeach; ?>

            </div>




            <!-- Blog Sidebar Widgets Column -->
           <!-- <div class="col-md-4">-->


            <!--  <?php  //include("includes/sidebar.php"); ?>



        </div> -->
        <!-- /.row -->

        <?php include("includes/footer.php"); ?>
