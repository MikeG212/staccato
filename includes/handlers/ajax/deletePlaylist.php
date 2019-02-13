<?php
include("../../config.php");

if(isset($_GET['playlistId '])) {
    $playlistId = $_GET['playlistId'];

    $playlistQuery = mysqli_query($con, "DELETE FROM playlists WHERE id='playlistId'");
    $songsQuery = mysqli_query($con, "DELETE FROM playlistSongs WHERE playlistId='playlistId'");
} else {
    echo "PlaylistId was not passed into deletePlaylist.php";
}
?>