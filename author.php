<?php include 'header.php'; ?>
    <div id="main-content">
      <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
                    <?php
                                        

                    ?>
                 
                  <?php
                    include 'config.php';
                    if(isset($_GET['aid'])){
                        $author_id=$_GET['aid'];
                        $sql1 = "SELECT * FROM post JOIN user 
                        ON post.author=user.user_id 
                        WHERE post.author='$author_id'";
                                        $result1 = mysqli_query($conn, $sql1);
                                        $row1=mysqli_fetch_assoc($result1);
    
                    }
                    ?>
                    <h2 class="page-heading"><?php echo $row1["username"]; ?></h2>
                    <?php
                    
                    $limit = 3;
                    if (isset($_GET['page'])) {
                        $page = $_GET['page'];
                    } else {
                        $page = 1;
                    }

                    //   echo $page;
                    $offset = ($page - 1) * $limit;
                    $sql = "SELECT post.post_id,post.title,post.description,post.post_date,post.author,category.category_name, user.username,post.category,post.post_img,category.category_id FROM post 
                  LEFT JOIN category ON post.category=category.category_id
                  LEFT JOIN user ON post.author=user.user_id
                  WHERE post.author=$author_id
                  ORDER BY post.post_id
                  DESC LIMIT {$offset},{$limit} ";
                    $result = mysqli_query($conn, $sql);
                    $num = mysqli_num_rows($result);
                    if ($num > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {



                    ?>
                            <div class="post-content">
                                <div class="row">
                                    <div class="col-md-4">
                                        <a class="post-img" href="single.php?id=<?php echo $row['post_id']; ?>"><img src="admin/upload/<?php echo $row['post_img']; ?>" alt="" /></a>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="inner-content clearfix">
                                            <h3><a href='single.php?id=<?php echo $row['post_id']; ?>'><?php echo $row['title']; ?></a></h3>
                                            <div class="post-information">
                                                <span>
                                                    <i class="fa fa-tags" aria-hidden="true"></i>
                                                    <a href='category.php'><?php echo $row['category_name']; ?></a>
                                                </span>
                                                <span>
                                                    <i class="fa fa-user" aria-hidden="true"></i>
                                                    <a href='author.php?aid=<?php echo $row['author']; ?>'><?php echo $row['username']; ?></a>
                                                </span>
                                                <span>
                                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                                    <?php echo $row['post_date']; ?>
                                                </span>
                                            </div>
                                            <p class="description">
                                               <?php echo substr($row['description'],0,130)."..."; ?>
                                            </p>
                                            <a class='read-more pull-right' href='single.php?id=<?php echo $row['post_id']; ?>'>read more</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    } else {
                        echo 'No Record Found';
                    }
                    ?>

                    <?php


                    if (mysqli_num_rows($result1) > 0) {
                        $total_records = mysqli_num_rows($result1);

                        $total_pages = ceil($total_records / $limit);
                        echo "<ul class='pagination admin-pagination'>";
                        if ($page > 1) {
                            echo '<li><a href="index.php?aid='.$author_id.'&page=' . ($page - 1) . '">Previous</a></li>';
                        }

                        for ($i = 1; $i <= $total_pages; $i++) {
                            if ($i == $page) {
                                $active = "active";
                            } else {
                                $active = "";
                            }

                            echo  '<li class=' . $active . '><a href="index.php?aid='.$author_id.'&page=' . $i . '">' . $i . '</a></li>';
                        }
                        if ($total_pages > $page) {
                            echo '<li><a href="index.php?aid='.$author_id.'&page=' . ($page + 1) . '">Next</a></li>';
                        }


                        echo '</ul>';
                    }

                    ?>
                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
      </div>
    </div>
<?php include 'footer.php'; ?>
