<?php
session_start();
include 'include/config.php';
include 'functions.php';
$conn = getDB();
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$id = $_GET['id'];
$sql = "SELECT paintings.ArtistID,paintings.PaintingID, paintings.Medium, paintings.Width, paintings.Height, paintings.ImageFileName,paintings.GalleryID,paintings.Title,paintings.Excerpt,artists.FirstName,artists.LastName,paintings.MSRP, paintings.Cost, paintings.YearOfWork, galleries.GalleryCity, galleries.GalleryCountry, galleries.GalleryName FROM paintings
                            INNER JOIN artists ON artists.ArtistID=paintings.ArtistID
							INNER JOIN galleries ON galleries.GalleryID = paintings.GalleryID
							ORDER BY paintings.YearOfWork";
$result = runQuery($conn,$sql);
while($row = mysqli_fetch_array($result))
{
	if($row["PaintingID"] === $id){
		$paint = $row;
		break;
	}
}
	
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/stylesheet.css">
<meta charset="UTF-8">
<title>Assignment 1 - Page 1 </title>
</head>
<body>
<div class ="content">
<ul class = "topList">
  <li><a href="#Checkout">Checkout</a></li>
  <li><a href="#ShoppingCart">Shopping Cart</a></li>
  <li class = "blah" ><a onclick="location.href='view-wish-list.php';">Wishlist</a></li>
  <li><a href="#about">My Account</a></li>
</ul>
<h1>
Art Store
</h1>
<ul class = "middleList">
  <li><b>Home</b></li>
  <li><b>About Us</b></li>
  <li><b onclick="location.href='browse-paintings.php';">Art Works</b></li>
  <li><b>Artists</b></li>
</ul>
</div>
<div class = "content2">
		<h3>
		<a href="https://hopper.wlu.ca/~irel9580/a5_irel9580/browse-paintings.php">
		browse-paintings.php </a> <br/>
		<a href="https://hopper.wlu.ca/~irel9580/a5_irel9580/single-painting.php">
		single-painting.php </a> <br/>
		<a href="https://hopper.wlu.ca/~irel9580/a5_irel9580/view-wish-list.php">
		view-wish-list.php </a> <br/>
		</h3>
<h2>
<?php echo utf8_encode($paint["Title"]) ?>
</h2>
<p>
By <a href=""> <?php echo utf8_encode($paint["FirstName"]) ?> <?php echo utf8_encode($paint["LastName"]) ?> </a>
</p>
<img class = "firstimg" src="images/medium/<?php echo $paint["ImageFileName"] ?>.jpg" alt="portrait" width="300">
<p class = "info"> 
<?php echo utf8_encode($paint["Excerpt"]) ?>
</p>
<p>
</p>
<b class = "price">
$<?php echo utf8_encode($paint["MSRP"] + 0) ?>
</b>
<p>
</p>
<div class = "around">
<p>
</p>
<button class="button1" onclick = "window.location.href='addToWishList.php?id=<?php echo $row["PaintingID"] ?>&name=<?php echo urlencode($row["Title"]) ?>&pic=<?php echo $row["ImageFileName"] ?>'" >Add to Wish List</button>
<button class="button2">Add to Shopping Cart </button>
</div>
<h3>
Product Details
</h3>
<hr>
<table class = "infoTable">
  <tr>
    <td><b>Date:</b></td>
    <td><?php echo utf8_encode($paint["YearOfWork"]) ?></td>
  </tr>
  <tr>
    <td><b>Medium:</b></td>
    <td><?php echo utf8_encode($paint["Medium"]) ?></td>
  </tr>
  <tr>
    <td><b>Dimensions:</b></td>
    <td> <?php echo utf8_encode($paint["Width"]) ?> x <?php echo utf8_encode($paint["Height"]) ?></td>
  </tr>
    <tr>
    <td><b>Home:</b></td>
    <td><a href=""><?php echo utf8_encode($paint["GalleryName"]) ?>, <?php echo utf8_encode($paint["GalleryCity"]) ?>, <?php echo utf8_encode($paint["GalleryCountry"]) ?></a></td>
  </tr>
  <tr>
    <td><b>Genres:</b></td>
    <td><a href="">International Gothics</a>
  </tr>
  <tr>
    <td><b>Subjects:</b></td>
    <td><a href="">Religion</a> , <a href="">People</a></td>
  </tr>
</table>
<br>
<br>
<br>
<h3>
Similar Products
</h3>
<hr> 
<div class = "smallaround">
<img class = "secondimg" src="images/squaresmall/116010.jpg" alt="portrait2">
<br>
<a href="">Arist Holding a Thistle</a>
<button class="buttonEnd">View</button>
<button class="buttonEnd">Wish</button>
<button class="buttonEnd">Cart</button>
</div>
<div class = "smallaround">
<img class = "secondimg" src="images/squaresmall/120010.jpg" alt="portrait3">
<br>
<a href="">Portrait of Eleanor of Toledo</a>
<button class="buttonEnd">View</button>
<button class="buttonEnd">Wish</button>
<button class="buttonEnd">Cart</button>
</div>
<div class = "smallaround">
<img class = "secondimg" src="images/squaresmall/107010.jpg" alt="portrait4">
<br>
<a href="">Madame de Pompadour</a>
<button class="buttonEnd">View</button>
<button class="buttonEnd">Wish</button>
<button class="buttonEnd">Cart</button>
</div>
<div class = "smallaround">
<img  class = "secondimg" src="images/squaresmall/106020.jpg" alt="portrait5">
<br>
<a href="">Girl with a Pearl Earring</a>
<button class="buttonEnd">View</button>
<button class="buttonEnd">Wish</button>
<button class="buttonEnd">Cart</button>
</div>
</div>
<br>
<div class = "bottomcontent">
	<footer>
	<p> All images are copyright to their owners. This is just a hypothetical site © Copyright Art Store </p>
	</footer>
</div>
</body>
</html>


