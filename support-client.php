<?php

require('database/config.php');
require('database/db.php');

//$date = date('d-m-Y');
//echo "The current date is: " . $date;
//$timezone = date_default_timezone_get();
//echo "The current server timezone is: " . $timezone;

//create Query
$query = 'SELECT * FROM supportcase';

//Get result
$result = mysqli_query($conn, $query);

//Fetch Data
$posts = mysqli_fetch_all($result, MYSQLI_ASSOC);  //associated ['name => 'brad'], (som map i java)
//    var_dump($posts); //printer alt

//Free result
mysqli_free_result($result);  //frigør fra hukommelse???

//close connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Support sager</title>
</head>

<body>
<h1>Mine Support sager</h1>
<table>
    <thead>
    <tr>
        <th>Id</th>
        <th>Status</th>
        <th>Header</th>
        <th>Tekst</th>
        <th>domain</th>
        <th>Browsernavn</th>
        <th>Oprettet dato</th>
        <th>Lukket dato</th>
        <th>Fil sti</th>
    </tr>
    </thead>
    <tbody align="center">
    <?php foreach ($posts as $post) : ?>
        <tr>
            <td><?php echo $post['idsupportcase']; ?></td>
            <td><?php echo $post['status']; ?></td>
            <td><?php echo $post['headertext']; ?></td>
            <td><?php echo $post['problemtext']; ?></td>
            <td><?php echo $post['domainname']; ?></td>
            <td><?php echo $post['browsername']; ?></td>
            <td><?php echo $post['createdate']; ?></td>
            <td><?php echo $post['closedate']; ?></td>
            <td><?php echo $post['file']; ?></td>
        </tr>
    <?php endforeach; ?>



    </tbody>
</table>
</body>
</html>
