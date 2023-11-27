<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=
    , initial-scale=1.0">
    <title>Colors</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
<header>
    <nav>
        <ul>
            <li><a href=<?php echo "colors.php";?> class='active'><?php echo "Визуализация кластеров";?></a></li>
        </ul>
    </nav>
</header>

<div class="box">
    <?php 
    include "connection.php";
    if($mysql!=null){
        $result = mysqli_query($mysql, "SELECT DISTINCT c.label, ce.id_centroid, ce.r, ce.g, ce.b, GROUP_CONCAT(CONCAT('#', LPAD(HEX(c.r), 2, '0'), LPAD(HEX(c.g), 2, '0'), LPAD(HEX(c.b), 2, '0'))) AS colors FROM color c JOIN centroids ce ON c.label = ce.id_centroid GROUP BY c.label");
        while($row = mysqli_fetch_assoc($result)){
            $centroid_color = sprintf("#%02x%02x%02x", $row['r'], $row['g'], $row['b']);
    ?>
    <table class="table">
        <tr>
            <th>Color</th>
            <th>Centroid ID</th>
        </tr>
        <tr>
            <td style="background-color: <?php echo $centroid_color; ?>"></td>
            <td><?php echo $row['id_centroid']; ?></td>
        </tr>
    </table>
    <p>All Colors:</p>
    <table class="table">
        <?php 
        $colors = explode(",", $row['colors']);
        foreach($colors as $color){
        ?>
        <tr>
            <td style="background-color: <?php echo $color; ?>"></td>
        </tr>
        <?php
        }
        ?>
    </table>
    <?php
        }
    }
    ?>
</div
