<?php

class Region {
    use Model;

    protected $table = "ncaat_regions";
    protected $allowedColumns = [
        'regionid','regionname'
    ];
}