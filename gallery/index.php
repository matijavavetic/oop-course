<?php include("includes/header.php");

$photos = Photo::find_all();

$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;

$itemsPerPage = 4;
$itemsTotalCount = Photo::COUNT_ALL();

$paginate = new Paginate($page, $itemsPerPage, $itemsTotalCount);

$sql = "SELECT * FROM photo ";
$sql .= "LIMIT {$itemsPerPage} ";
$sql .= "OFFSET {$paginate->offset()} ";
$photos = Photo::find_by_query($sql);

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

                <div class="row">
                    <ul class="pager">

                        <?php

                        if($paginate->pageTotal() > 1) {
                            if($paginate->hasNext()) {
                                echo "<li class='next'><a href='index.php?page={$paginate->next()}'>Next</a></li>";
                            }
                            if($paginate->hasPrevious()) {
                                echo "<li class='previous'><a href='index.php?page={$paginate->previous()}'>Previous</a></li>";

                            }
                        }


                        for ($i=1; $i <= $paginate->pageTotal(); $i++) {
                            if($i == $paginate->currentPage) {
                                echo "<li class='active'><a href='index.php?page={$i}'>{$i}</a></li>";
                            } else {
                                echo "<li class=''><a href='index.php?page={$i}'>{$i}</a></li>";

                            }
                        }

                            ?>
                    </ul>
                </div>




            <!-- Blog Sidebar Widgets Column -->
           <!-- <div class="col-md-4">-->


            <!--  <?php  //include("includes/sidebar.php"); ?>



        </div> -->
        <!-- /.row -->

        <?php include("includes/footer.php"); ?>
