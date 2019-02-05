<?php
    class Album {

        private $con;
        private $id;
        private $title;
        private $artistId;
        private $genre;
        private $artworkPath;

        public function __construct($con, $id) {
            $this->con = $con;
            $this->id = $id;
            
            $query = mysqli_query($this->con, "SELECT * FROM Albums WHERE id='$this->id'");
            $album = mysqli_fetch_array($query);

            $this->title = $album['title'];
            $this->artistId = $album['artist'];
            $this->genre = $album['genre'];
            $this->artworkPath = $album['artworkPath'];
        }

        public function getTitle() {
            return $this->title;
        }

        public function getArtwork() {
            return $this->artworkPath;
        }

        public function getArtist() {
            return new Artist($this->con, $this->artistId);
        }

        public function getArtworkPath() {
            return $album['artworkPath'];
        }

        public function getGenre() {
            return $album['genre'];
        }

        public function getNumberOfSongs() {
            $query = mysqli_query($this->con, "SELECT id FROM Songs WHERE album='$this->id'");
            return mysqli_num_rows($query);
        }
    }
?>