<?php
include("includes/includedFiles.php");

if(isset($_GET['id'])) {
    $albumId = $_GET['id'];
}
else {
    header("Location: index.php");
}

$artist = newArtist($con, $artistId);
?>

<div class="entityInfo">
    <div class="centerSection">
        <div class="artistInfo">
            <h1 class="artistName"><?php echo $artist->getName(); ?></h1>
            <div class="headerButtons">
                <button class="button green">Play</button>
            </div>
        </div>
    </div>
</div>