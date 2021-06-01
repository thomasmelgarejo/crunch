<?php

require('database/config.php');
require('database/db.php');


$idusers = 1; //TODO HARDCODED, should catch loggedin user id


//create Query for dropdown menu browser
$queryBrowser = 'SELECT browsername FROM browser';

//Get resultSet for browsers
$resultBrowser = mysqli_query($conn, $queryBrowser);

//create Query for dropdown menu domain
$queryDomain = 'SELECT domainname FROM domains WHERE idusers='.$idusers;

//Get resultSet for domains
$resultDomain = mysqli_query($conn, $queryDomain);

//check before summit
if (isset($_POST['submit'])){

    $status = 'Venter';
    $headertext = mysqli_real_escape_string($conn, $_POST['headertext']);
    $problemtext = mysqli_real_escape_string($conn, $_POST['problemtext']);
    $domainname = mysqli_real_escape_string($conn, $_POST['domainname']);
    $browser = mysqli_real_escape_string($conn, $_POST['browsername']);
    $createdate = date('Y-m-d');
    $file = mysqli_real_escape_string($conn, $_POST['file']);
    $employeename = 'afventer';
    //$idusers = 3; //hardcoded, should catch loggedin user id

    $query = "INSERT INTO supportcase(status, headertext, problemtext, domainname,browsername, createdate, file, idusers, employeename) VALUES ('$status', '$headertext','$problemtext', '$domainname','$browser', '$createdate', '$file', '$idusers','$employeename')";

    //Get result
    if (mysqli_query($conn, $query)){
        header('Location: ' .ROOT_URL. '/support-client.php');
    }else{
        echo 'ERROR: ' . mysqli_error($conn);
    }

}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Opret ny sag</title>
</head>

<body>
<h1>Opret ny sag</h1>

<div class="container">
    <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">

        <div>
            <label>Title</label>
            <input type="text" name="headertext" >
        </div>
        <div>
            <select name="browsername">
                <?php
                    while ($rows = $resultBrowser-> fetch_assoc()){
                        $browsername = $rows['browsername'];
                        echo "<option value='$browsername'> $browsername</option>";
                    }

                ?>
            </select>
        </div>
        <div>
            <select name="domainname">
                <?php
                while ($rows = $resultDomain-> fetch_assoc()){
                    $domainname = $rows['domainname'];
                    echo "<option value='$domainname'> $domainname</option>";
                }

                ?>
            </select>
        </div>
        <div>
            <label>Tekst</label>
            <input type="text" name="problemtext" >
        </div>
        <div>
            <label>Eventuel fil</label>
            <input type="text" name="file" >
        </div>

        <input type="submit" name="submit" value="Opret supportcase">
    </form>

</div>

</body>
</html>
