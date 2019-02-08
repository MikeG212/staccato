<?php
$songQuery = mysqli_query($con, "SELECT id FROM songs ORDER BY RAND() LIMIT 10");

$resultArray = array();

while($row = mysqli_fetch_array($songQuery)) {
    array_push($resultArray, $row['id']);
}

$jsonArray = json_encode($resultArray);
?>

<script>


$(document).ready(function() {
    var newPlaylist = <?php echo $jsonArray; ?>;
    audioElement = new Audio();
    setTrack(newPlaylist[0], newPlaylist, false);
    updateVolumeProgressBar(audioElement.audio);
    $("#nowPlayingBarContainer").on("mousedown touchstart mousemove touchmove", function(e) {
        e.preventDefault();
    });

    $(".playbackBar .progressBar").mousedown(function() {
        mouseDown = true;
    });

    $(".playbackBar .progressBar").mousemove(function(e) {
        if (mouseDown) {
            timeFromOffset(e, this);
        }
    });

    $(".playbackBar .progressBar").mouseup(function(e) {
        timeFromOffset(e, this);
    });

    $(".volumeBar .progressBar").mousedown(function() {
        mouseDown = true;
    });

    $(".volumeBar .progressBar").mousemove(function(e) {
        if (mouseDown) {

            let percentage = e.offsetX / $(this).width();
            if (percentage >= 0 && percentage <= 1) {
                audioElement.audio.volume = percentage;
            }
        }
    });

    $(".volumeBar .progressBar").mouseup(function(e) {
        let percentage = e.offsetX / $(this).width();
        if (percentage >= 0 && percentage <= 1) {
            audioElement.audio.volume = percentage;
        };
    });

    $(document).mouseup(function() {
        mouseDown = false;
    });
});

function timeFromOffset(e, progressBar) {
    let percentage = e.offsetX / $(progressBar).width() * 100;
    let seconds = audioElement.audio.duration * (percentage / 100)
    audioElement.setTime(seconds);
}

function prevSong() {
    if (audioElement.currentTime >= 3 || currentIndex === 0) {
        audioElement.setTime(0);
    } else {
        currentIndex--;
        setTrack(currentPlaylist[currentIndex], currentPlaylist, true);
    }
}

function nextSong() {
    var trackToPlay;
    if (repeat) {
        audioElement.setTime(0);
        playSong();
        return;
    }
    
    if (currentIndex === currentPlaylist.length - 1) {
        currentIndex = 0;
    }
    else {
        currentIndex++;
    }

    if (shuffle) {
        trackToPlay = shuffledPlaylist[currentIndex]
    } else {
        trackToPlay = currentPlaylist[currentIndex];
    }
    setTrack(trackToPlay, currentPlaylist, true);
}

function toggleMute() {
    audioElement.audio.muted = !audioElement.audio.muted
    let imageName = audioElement.audio.muted ? "volume-mute.png" : "volume.png";
    $(".controlButton.volume img").attr("src", "assets/images/icons/" + imageName);
}

function toggleShuffle() {
    shuffle = !shuffle;
    let imageName = shuffle ? "shuffle-active.png" : "shuffle.png";
    $(".controlButton.shuffle img").attr("src", "assets/images/icons/" + imageName);

    if (shuffle) {
        shuffleArray(shuffledPlaylist);
        currentIndex = shuffledPlaylist.indexOf(audioElement.currentlyPlaying.id);
    } else {

    }
}

function shuffleArray(a) {
    for (let i = a.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [a[i], a[j]] = [a[j], a[i]];
    }
    return a;
}

function setTrack(trackId, newPlaylist, play) {
    if(newPlaylist != currentPlaylist) {
        currentPlaylist = newPlaylist.slice();
        shuffledPlaylist = newPlaylist.slice();
        shuffleArray(shuffledPlaylist);
    }

    if (shuffle) {
        currentIndex = shuffledPlaylist.indexOf(trackId);
    } else {
        currentIndex = currentPlaylist.indexOf(trackId);
    }
    
    pauseSong();
	$.post("includes/handlers/ajax/getSongJson.php", { songId: trackId }, function(data) {	
        var track = JSON.parse(data);
        $('.content .trackName').text(track.title);

        $.post("includes/handlers/ajax/getArtistJson.php", { artistId: track.artist }, function(data) {
			var artist = JSON.parse(data);

			$('.content .artistName').text(artist.name);
		});

        $.post("includes/handlers/ajax/getAlbumJson.php", { albumId: track.album }, function(data) {
            var album = JSON.parse(data);
		    $(".albumLink img").attr("src", album.artworkPath);
        });

        audioElement.setTrack(track);

    });
		
	

	if(play == true) {
		audioElement.play();
	}
}

function toggleRepeat() {
    repeat = !repeat;
    let imageName = repeat ? "repeat-active.png" : "repeat.png";
    $(".controlButton.repeat img").attr("src", "assets/images/icons/" + imageName);
}

function playSong() {
    if (audioElement.audio.currentTime == 0) {
        $.post("includes/handlers/ajax/updatePlays.php", { songId: audioElement.currentlyPlaying.id });
    }
    $(".controlButton.play").hide();
    $(".controlButton.pause").show();
    audioElement.play();
}

function pauseSong() {
    $(".controlButton.pause").hide();
    $(".controlButton.play").show();
    audioElement.pause();
}

</script>

<div id="nowPlayingBarContainer">
    <div id="nowPlayingBar">
        <div id="nowPlayingLeft">
            <div class="content">
                <span class="albumLink">
                    <img class="albumArtwork" alt="Album Art">
                <span>
                <div class="trackInfo">
                    <span class="trackName"></span>
                    <span class="artistName"></span>
                </div>
            </div>
        </div>
        <div id="nowPlayingCenter">
            <div class="content playerControl">
                <div class="buttons">

                    <button class="controlButton shuffle" title="Shuffle button" onclick="toggleShuffle()">
                        <img src="assets/images/icons/shuffle.png" alt="Shuffle">
                    </button>

                    <button class="controlButton previous" title="Previous button" onclick="prevSong()">
                        <img src="assets/images/icons/previous.png" alt="Previous">
                    </button>

                    <button class="controlButton play" title="Play button" onclick="playSong()">
                        <img src="assets/images/icons/play.png" alt="Play">
                    </button>

                    <button class="controlButton pause" title="Pause button" style="display: none" onclick="pauseSong()">
                        <img src="assets/images/icons/pause.png" alt="Pause">
                    </button>

                    <button class="controlButton next" title="Next button">
                        <img src="assets/images/icons/next.png" alt="Next" onclick="nextSong()">
                    </button>

                    <button class="controlButton repeat" title="Repeat button">
                        <img src="assets/images/icons/repeat.png" alt="Repeat" onclick="toggleRepeat()">
                    </button> 
                </div>
                <div class="playbackBar">

                    <span class="progressTime current">0:00</span>
                    <div class="progressBar">
                        <div class="progressBarBg">
                            <div class="progress"></div>
                        </div>
                    </div>
                    <span class="progressTime remaining">0:00</span>
                
                </div>
            </div>
        </div>
        <div id="nowPlayingRight">
            <div class="volumeBar">
                <button class="controlButton volume" title="Volume button" onclick="toggleMute()">
                    <img src="assets/images/icons/volume.png" alt="Volume"> 
                    
                </button>
                
                <div class="progressBar">
                    <div class="progressBarBg">
                        <div class="progress"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>