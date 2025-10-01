<?php

class Bracket {
    use Model;

    protected $table = "ncaat_bracket";
    protected $allowedColumns = [
        'teamid','seed','regionid'
    ];
}