<?php
    class Artist {

        private $con;
        private $id;

        public function __construct($con, $id) {
            $this->con = $con;
            $this->id = $id;
        }

        public function getName() {
            $artistQuery = mysqli_query($this->con, "SELECT * FROM Artists WHERE artist='$this->id'");
            $artist = mysqli_fetch_array($artistQuery);
            return $artist['name'];
        }
    }
?>