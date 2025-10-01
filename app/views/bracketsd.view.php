<?php
if (isset($this->id)) {

    $regionid = $this->r;
    $bracket = new Bracket;

    $arrb["bracketid"] = $this->id;
    $resultb = $bracket->delete($this->id);

    if ($resultb) {
        $e = "Seed already exists in this region<br>";
    }

    header('Location: ' . ROOT . "/brackets/" . $regionid);
}
