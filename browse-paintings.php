<?php
session_start();
include 'include/config.php';
include 'functions.php';

$conn = getDB();
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Assignment 1 - Page 1</title>
		<link href="css/reset.css" rel="stylesheet">
        <link href="css/styles.css" rel="stylesheet">



    </head>
    <body>
		<div class ="content">
			<ul class = "topList">
				<li class = "blah" ><a>Checkout</a></li>
				<li class = "blah" ><a>Shopping Cart</a></li>
				<li class = "blah" ><a onclick="location.href='view-wish-list.php';">Wishlist</a></li>
				<li class = "blah" ><a>My Account</a></li>
			</ul>
			<h1>
			Art Store
			</h1>
		<ul class = "middleList">
			<li class = "blah2" ><b>Home</b></li>
			<li class = "blah2" ><b>About Us</b></li>
			<li class = "blah2" ><b onclick="location.href='browse-paintings.php';">Art Works</b></li>
			<li class = "blah2" ><b>Artists</b></li>
		</ul>
		</div>
        <main style="overflow:auto;">
		<h3>
		<a href="https://hopper.wlu.ca/~irel9580/a5_irel9580/browse-paintings.php">
		browse-paintings.php </a> <br/>
		<a href="https://hopper.wlu.ca/~irel9580/a5_irel9580/single-painting.php">
		single-painting.php </a> <br/>
		<a href="https://hopper.wlu.ca/~irel9580/a5_irel9580/view-wish-list.php">
		view-wish-list.php </a> <br/>
		</h3>

            <section class="leftsection" style="width=600px;  margin-right:100px;">
                <form class="ui form" method="get" action="browse-paintings.php">
                    <h3>Filters</h3>

                    <div >
                        <label style=" padding-right:22px;">Artist</label>
                        <select name="artist">
                            <option value='0'>Select Artist</option>  
                            <?php  
								$sql = "SELECT LastName FROM artists;";
								$result = runQuery($conn,$sql);
								while($row = mysqli_fetch_array($result))
								{
									?>
									<option><?php echo utf8_encode($row["LastName"]) ?></option>
									<?php
								}
                            ?>
					
                        </select>
                    </div>  
                    <div >
                        <label>Museum</label>
                        <select  name="museum">
                            <option value='0'>Select Museum</option>  
                            <?php  
								$sql = "SELECT GalleryName FROM galleries;";
								$result = runQuery($conn,$sql);
								while($row = mysqli_fetch_array($result))
								{
									?>
									<option><?php echo utf8_encodE($row["GalleryName"]) ?></option>
									<?php
								}
                            ?>
                        </select>
                    </div>   
                    <div >
                        <label style="padding-right:14px;">Shape</label>
                        <select  name="shape">
                            <option value='0'>Select Shape</option>  

                            <?php  
								$sql = "SELECT ShapeName FROM shapes;";
								$result = runQuery($conn,$sql);
								while($row = mysqli_fetch_array($result))
								{
									?>
									<option><?php echo utf8_encode($row["ShapeName"]) ?></option>
									<?php
								}
                            ?>

                        </select>
                    </div>   
                    <p> &nbsp; &nbsp;  &nbsp;   &nbsp; </p>
                    <button type="submit" id="buttons"> Filter  </button>    

                </form>    </section>


            <section class="rightsection" >
                <h1>Paintings</h1>
                <h3>All Paintings [Top 20]</h3>
                <ul id="paintingsList">

                    <?php  

		    	$sql = "SELECT paintings.ArtistID,paintings.PaintingID, paintings.ImageFileName,paintings.GalleryID,paintings.Title,paintings.Excerpt,artists.FirstName,artists.LastName,paintings.MSRP, paintings.Cost, paintings.YearOfWork FROM paintings
                            INNER JOIN artists ON artists.ArtistID=paintings.ArtistID
							ORDER BY paintings.YearOfWork
                            LIMIT 20";
				$result = runQuery($conn,$sql);
				while($row = mysqli_fetch_array($result))
				{
									
		    ?>

                    <li class="item">

                        <div class="figure">

                            <a href="single-painting.php?id=<?php echo $row["PaintingID"] ?>">
                                <img src="images/square-medium/<?php echo $row["ImageFileName"] ?>.jpg">
                            </a>
                        </div>
                        <div class="itemright">
                            <a href="single-painting.php?id=<?php echo $row["PaintingID"] ?>">
                                <?php echo utf8_encode($row["Title"]) ?></a>

                            <div><span><?php echo utf8_encode($row["FirstName"])?> <?php echo utf8_encode($row["LastName"])?></span></div>        


                            <div class="description">
                                <p><?php echo utf8_encode($row["Excerpt"]) ?></p>
                            </div>

                            <div class="meta">     
                                <strong> $<?php echo utf8_encode($row["MSRP"] + 0) ?></strong>        
                            </div>        

                            <div class="extra" >
                                <a class="favorites" href="cart.php?id=<?php echo $row["PaintingID"] ?>">Add to Shopping Cart</a>
                                <span> &nbsp; &nbsp; &nbsp;    </span>
                                <a  class="favorites"   href="addToWishList.php?id=<?php echo $row["PaintingID"] ?>&name=<?php echo urlencode($row["Title"]) ?>&pic=<?php echo $row["ImageFileName"] ?>">	Add to Wish List</i>
                                </a>         
                                <p>&nbsp;</p>
                            </div>       

                        </div>      
                    </li>

                    <?php
		    } 
		    ?>

                </ul>
            </section>

        </main>
	<div class = "bottomcontent">
	<footer>
	<p> All images are copyright to their owners. This is just a hypothetical site © Copyright Art Store </p>
	</footer>
	</div>
    </body>
</html>
