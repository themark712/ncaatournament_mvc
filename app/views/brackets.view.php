<?php
$regionid = "";
$teamtable = "";
$nextseed = 0;
$seed = 0;
$region = "";
$e = "";

$team = new Team;
$regions = new Region;
$bracket = new Bracket;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $e = "";

    $regionid = $this->r;
    $seed = "";

    if (isset($_POST['team'])) {
        $team = $_POST['team'];
        //echo $team . "<br>";
    }
    if (isset($_POST['seed'])) {
        $seed = $_POST['seed'];
        //echo $seed . "<br>";
    }

    $isff = 0;
    if (isset($_POST['isff'])) {
        $isff = $_POST['isff'];
    }
    //echo $isff . "<br>";

    // $arrb["regionid"] = $regionid;
    // $arrb["seed"] = $seed;
    // $arrn["seed"] = 16;
    // $resultb = $bracket->first($arrb, $arrn);

    // if ($resultb) {
    //     $e = "Seed already exists in this region<br>";
    // }

    if ($e == "") {
        $aryi["regionid"] = $regionid;
        $aryi["teamid"] = $team;
        $aryi["seed"] = $seed;

        $resulti = $bracket->insert($aryi);

        $seed++;
        $this->s = $seed;

        if ($resulti) {
            header('Location: ' . ROOT . "/brackets/" . $regionid . '/' . $seed);
        }
    } 
}

$sqlr = "SELECT * FROM ncaat_regions ORDER BY regionid";
$resultr = $regions->findAll($sqlr);

$buttonlist = "";

foreach ($resultr as $x => $y) {

    if (isset($this->r)) {
        $regionid = $this->r;
    }
    $buttoncolorclass = "btn-primary";

    if ($y->regionid == $regionid) {
        $region = $y->regionname;
        $buttoncolorclass = "btn-outline-primary";
    }

    $buttonlist .= '<a class="btn ' . $buttoncolorclass . ' me-4 rounded-4 w-25" href="' . ROOT . '/brackets/' . $y->regionid . '">' . $y->regionname . '</a>';
}


if (isset($this->r)) {
    $regionid = $this->r;

    $bracket = new Bracket;

    $sqlt = "SELECT * FROM ncaat_bracket WHERE regionid=" . $regionid;
    $resultt = $bracket->findAll($sqlt);

    if ($this->s) {
        $nextseed = $this->s;
    }

    // get team list for dropdown
    $teams = new Team;

    $sqlt = "SELECT * FROM ncaateams WHERE bbclass != '0' ORDER BY name";
    $resultt = $teams->findAll($sqlt);
    $teamlist = "";

    foreach ($resultt as $x => $y) {
        $teamlist .= ' <option value="' . $y->id . '">' . $y->name . '</option>';
    }
    // get teams in region
    $sqlb = "SELECT b.id AS bid, t.name AS Team, b.seed AS Seed, t.logo AS Logo FROM ncaat_bracket b LEFT JOIN ncaateams t ON t.id=b.teamid WHERE b.regionid=" . $regionid . " ORDER BY b.seed";
    
    $resultb = $bracket->findAll($sqlb);

    if ($resultb) {
        foreach ($resultb as $x => $y) {
            $teamtable .= "<tr>";
            $teamtable .= "<td>" . $y->Seed . "</td>";
            $teamtable .= "<td>" . $y->Team . "</td>";
            $teamtable .= "<td><img src='" . ROOT . "/assets/img/logos/" . $y->Logo . ".png' class='logo-sm' /></td>";
            $teamtable .= "<td><a href='" . ROOT . "/bracketsd/" . $regionid . "/" . $y->bid . "'>Delete</td>";
            $teamtable .= "</tr>";
        }
    }
}
require_once "inc/header.php"
?>
<section id="about" class="section about mt-0">

    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <h2>Edit Teams</h2>
        <!-- START THE FEATURETTES -->
        <div class="row mb-3">
            <?=$e?>
            <div class="col-md-12 d-flex align-item-left">
                <?= $buttonlist ?>
            </div>
        </div>
        <div class="row gy-4">
            <div class="col-md-12">
                <table class="table table-striped table-sm">
                    <tr>
                        <th>Seed</th>
                        <th>Team</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                    </tr>
                    <?= $teamtable ?>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                Add Team (<?= $region ?>):
                <form class="row gy-1 gx-3 align-items-center" name="addteam" action="<?= ROOT ?>/brackets/<?= $regionid ?>/<?= $this->s ?>" method="post">
                    <div class="col-auto">
                        <label class="visually-hidden" for="autoSizingSelect">Team</label>
                        <select class="form-select" name="team" id="team">
                            <option value="">Choose...</option>
                            <?= $teamlist ?>
                        </select>
                    </div>
                    <div class="col-auto">
                        <label class="visually-hidden" for="autoSizingInput">Seed</label>
                        <select class="form-select" name="seed" id="seed">
                            <option value="">Choose...</option>

                            <?php
                            for ($s = 1; $s <= 16; $s++) {
                            ?><option value=<?= $s ?> <?php if ($s == $nextseed) {
                                                        echo " selected";
                                                    } ?>><?= $s ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-auto">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="isff" id="isff" value="1">
                            <label class="form-check-label" for="autoSizingCheck">
                                Plays FF Winner
                            </label>
                        </div>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</section>

<?php
require_once "inc/footer.php"
?>