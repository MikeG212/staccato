var currentPlaylist = [];
var shuffledPlaylist = [];
var tempPlaylist = [];
var audioElement;
var mouseDown = false;
var currentIndex = 0;
var repeat = false;
var shuffle = false;
var userLoggedIn;

function openPage(url) {
    if (url.indexOf("?") == -1) {
        url += "?";
    }
    var encodedURL = encodeURI(`${url}&userLoggedIn=${userLoggedIn}`);
    $("#mainContent").load(encodedURL);
    $("#body").scrollTop(0);
    history.pushState(null, null, url);
}

function playFirstSong() {
    setTrack(tempPlaylist[0], tempPlaylist, true);
}

function formatTime(seconds) {
    let time = Math.round(seconds);
    let min = Math.floor(time / 60);
    let sec = time % 60;

    if (sec < 10) {
        sec = "0" + sec;
    }

    return `${min}:${sec}`;
}

function updateTimeProgressBar(audio) {
    $(".progressTime.current").text(formatTime(audio.currentTime));
    $(".progressTime.remaining").text(formatTime(audio.duration - audio.currentTime));

    let progressPercentage = (audio.currentTime / audio.duration * 100) + "%";
    $(".playbackBar .progress").css("width", progressPercentage);

}

function updateVolumeProgressBar(audio) {
    let volume = audio.volume * 100 + "%";
    $(".volumeBar .progress").css("width", volume);
}

function Audio() {

    this.currentlyPlaying;
    this.audio = document.createElement('audio');

    this.audio.addEventListener("ended", function () {
        nextSong();
    });

    this.audio.addEventListener("canplay", function() {
        let duration = formatTime(this.duration);
        $('.progressTime.remaining').text(duration);
    });

    this.audio.addEventListener("timeupdate", function() {
        if (this.duration) {
            updateTimeProgressBar(this)
        }
    });

    this.audio.addEventListener("volumechange", function() {
        updateVolumeProgressBar(this);
    });

    
    this.setTrack = function(track) {
        this.currentlyPlaying = track;
        this.audio.src = track.path;
    };

    this.play = function() {
        this.audio.play();
    };

    this.pause = function() {
        this.audio.pause();
    };

    this.setTime = function(seconds) {
        this.audio.currentTime = seconds;
    };
}