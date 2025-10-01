<?
function GetUserXP($conn, $userid)
{
    $query = "SELECT xp FROM sgr_user WHERE user_id=" . $userid ;

    $result = $conn->query($query, MYSQLI_STORE_RESULT);
    $xp = 0;

    while ($row = mysqli_fetch_array($result)) {
        $xp = $row["xp"];
    }

    return $xp;
}

function GetUserLevel($conn, $userxp)
{
    $query = "SELECT * FROM sgr_level WHERE xpreq < " . $userxp  . " ORDER BY level";

    $result = $conn->query($query, MYSQLI_STORE_RESULT);
    $level = 0;

    while ($row = mysqli_fetch_array($result)) {
        $level = $row["level"];
    }

    return $level;
}
