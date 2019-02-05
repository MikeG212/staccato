<?php include("includes/header.php");

if(isset($_GET['id'])) {
    $albumId = $_GET['id'];
}
else {
    header("Location: index.php");
}

$albumQuery = mysqli_query($con, "SELECT * FROM Albums WHERE id='$albumId'");
$album = new Album($con, $albumId);
$artist = $album->getArtist();

echo $album->getTitle() . "<br>";
echo $artist->getName();
?>


<?php include("includes/footer.php"); ?>