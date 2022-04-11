<?php
class Avion extends Vehicule{
    public function decoller() {
        echo "Décollage<br>";
    }

    public function atterir(){
        echo "Atterissage<br>";
    }

    public function looping() {
        echo "Looping<br>";
    }
}