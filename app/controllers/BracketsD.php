<?php

// teams class

class BracketsD {
    use Controller;
    
    public $r;
    public $id;

    public function index($a="", $b="", $c="") {
        $this->r = $a;
        $this->id = $b;
        $this->view("bracketsd");
    }
}