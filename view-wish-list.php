<?php
session_start();
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
        <h2>Wish-List Items</h2>
        <?php
               if (isset($_SESSION['wish-list']))
               {
        ?>
        <table>
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Action </th>
                </tr>
        <?php
        foreach($_SESSION['wish-list'] as $value){
            $id = $value[0];
            $name = $value [1];
            $pic = $value[2];
        ?>
                <tr>
                    <td> <img src="images/square-medium/<?php echo $pic ?>.jpg"></td>
                    <td><a  href = "single-painting.php?id=<?php echo $id ?>"> <?php echo utf8_encode($name)?> </a></td>
                    <td><button class = "removeLinkStyle" type="button"> <a href = "remove-wish-list.php?id=<?php echo $id ?>">Remove</a></button></td>
                </tr>
                <br>
            </table>
        <?php
        }
    }
        ?>

            <button class = "removeLinkStyle" type="button"> <a href = "remove-all.php">Remove All Items from wish list</a></button>
        </main>
        <div class = "bottomcontent">
	    <footer>
	    <p> All images are copyright to their owners. This is just a hypothetical site © Copyright Art Store </p>
	    </footer>
	    </div>
    </body>
    </html>