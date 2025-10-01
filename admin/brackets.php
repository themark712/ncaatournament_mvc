<?php
require '../config/db.php';

$conn = dbconnect();

$teams=[];
$seeds=[];
$regionid = "";

$sqlr = "SELECT * FROM ncaat_regions ORDER BY region_id";
$resultr = $conn->query($sqlr, MYSQLI_STORE_RESULT);

$buttonlist = "";
$region = "";

while ($rowr = mysqli_fetch_array($resultr)) {
    $buttoncolorclass = "btn-primary";
    if (isset($_REQUEST["r"])) {
        $regionid = $_REQUEST["r"];
    }
    if ($rowr["region_id"] == $regionid) {
        $region = $rowr["region_name"];
        $buttoncolorclass = "btn-outline-primary";
    }

    $buttonlist .= '<a class="btn ' . $buttoncolorclass . ' me-4 rounded-4 w-25" href="brackets.php?r=' . $rowr["region_id"] . '">' . $rowr["region_name"] . '</a>';
}

if (isset($_REQUEST["r"])) {
    $regionid = $_REQUEST["r"];
    $sqlb = "SELECT t.TeamName AS Team, b.Seed AS Seed, t.Logo AS Logo FROM ncaat_bracket b LEFT JOIN ncaat_teams t ON t.TeamID=b.team_id WHERE b.region_id=" . $regionid . " ORDER BY b.seed";
    $resultb = $conn->query($sqlb, MYSQLI_STORE_RESULT);
    
    while ($rowb = mysqli_fetch_array($resultb)) {
        $teams[$rowb["Seed"]]=$rowb["Team"];
        $seeds[$rowb["Seed"]]=$rowb["Seed"];
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="../assets/css/bootstrap.css" rel="stylesheet">
    <link href="../assets/css/carousel.css" rel="stylesheet">
    <link href="../assets/css/custom.css" rel="stylesheet">
    <title>Document</title>

</head>

<body>
    <header data-bs-theme="dark">
        <nav class="navbar navbar-expand-lg bg-primary fixed-top mb-5" data-bs-theme="dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Navbar</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarColor01">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Home
                                <span class="visually-hidden">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Features</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Pricing</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">About</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Admin</a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="brackets.php">Bracket Setup</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="teams.php">Teams</a>
                            </div>
                        </li>
                    </ul>
                    <form class="d-flex">
                        <input class="form-control me-sm-2" type="search" placeholder="Search">
                        <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </nav>
    </header>

    <main>

        <!-- Marketing messaging and featurettes
  ================================================== -->
        <!-- Wrap the rest of the page in another container to center all the content. -->

        <div class="container mt-5">
        <h2>Edit Brackets</h2>
            <!-- START THE FEATURETTES -->
            <div class="row featurette">
                <div class="col-md-10 d-flex align-item-left">
                    <?=$buttonlist?>
                    <button class="btn btn-primary me-4 rounded-4 w-25">Sweet 16</button>
                    <button class="btn btn-primary me-4 rounded-4 w-25">Final Four</button>
                </div>
            </div>

            <hr class="featurette-divider">
            <div class="row featurette">
                <div class="col-md-4 round1">
                    <div class="bracket r1">
                        <button class="btn btn-secondary me-4 rounded-4 w-75 text-start"><span class="badge seed"><?=$seeds[1]?></span><?=$teams[1]?></button>
                        <button class="btn btn-secondary me-4 rounded-4 w-75 text-start"><span class="badge seed">16</span><?=$teams[16]?></button>
                    </div>
                    <div class="bracket r1">
                        <button class="btn btn-secondary me-4 rounded-4 w-75 text-start"><span class="badge seed">8</span><?=$teams[8]?></button>
                        <button class="btn btn-secondary me-4 rounded-4 w-75 text-start"><span class="badge seed">9</span><?=$teams[9]?></button>
                    </div>
                    <div class="bracket r1">
                        <button class="btn btn-secondary me-4 rounded-4 w-75 text-start"><span class="badge seed">5</span><?=$teams[5]?></button>
                        <button class="btn btn-secondary me-4 rounded-4 w-75 text-start"><span class="badge seed">12</span><?=$teams[11]?></button>
                    </div>
                    <div class="bracket r1">
                        <button class="btn btn-secondary me-4 rounded-4 w-75 text-start"><span class="badge seed">4</span><?=$teams[4]?></button>
                        <button class="btn btn-secondary me-4 rounded-4 w-75 text-start"><span class="badge seed">13</span><?=$teams[13]?></button>
                    </div>
                    <div class="bracket r1">
                        <button class="btn btn-secondary me-4 rounded-4 w-75 text-start"><span class="badge seed">6</span><?=$teams[6]?></button>
                        <button class="btn btn-secondary me-4 rounded-4 w-75 text-start"><span class="badge seed">11</span><?=$teams[11]?></button>
                    </div>
                    <div class="bracket r1">
                        <button class="btn btn-secondary me-4 rounded-4 w-75 text-start"><span class="badge seed">3</span><?=$teams[3]?></button>
                        <button class="btn btn-secondary me-4 rounded-4 w-75 text-start"><span class="badge seed">14</span><?=$teams[14]?></button>
                    </div>
                    <div class="bracket r1">
                        <button class="btn btn-secondary me-4 rounded-4 w-75 text-start"><span class="badge seed">7</span><?=$teams[7]?></button>
                        <button class="btn btn-secondary me-4 rounded-4 w-75 text-start"><span class="badge seed">10</span><?=$teams[10]?></button>
                    </div>
                    <div class="bracket r1">
                        <button class="btn btn-secondary me-4 rounded-4 w-75 text-start"><span class="badge seed">2</span><?=$teams[2]?></button>
                        <button class="btn btn-secondary me-4 rounded-4 w-75 text-start"><span class="badge seed">15</span><?=$teams[15]?></button>
                    </div>
                </div>
            </div>

            <hr class="featurette-divider">

            <!-- /END THE FEATURETTES -->

        </div><!-- /.container -->


        <!-- FOOTER -->
        <footer class="container fixed-bottom mb-3">
            <p class="float-end"><a href="#">Back to top</a></p>
            <p>&copy; 2017–2024 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
        </footer>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>