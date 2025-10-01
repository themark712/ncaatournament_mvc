<?php

// teams class

class Brackets {
    use Controller;
    
    public $r;
    public $s;

    public function index($a="", $b="", $c="") {
        $this->r = $a;
        $this->s = $b;
        $this->view("brackets");
    }
}