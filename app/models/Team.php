<?php

class Team {
    use Model;

    protected $table = "ncaateams";
    protected $allowedColumns = [
        'name','mascot','bbclass','bbconferenceid','logo','location','color','bbrank'
    ];
}