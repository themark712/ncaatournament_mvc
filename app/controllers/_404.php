<?php

// home class

class _404 {
    use Controller;
    
    public function index() {
        $this->view("_404");
    }
}