<?php ob_start();?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <style>
        .container {
            
            margin: -20px auto;
        }
        .list-inline {
            text-align: center;
            margin-bottom: -10px;
        }
        .title {
            font-size: 26px;
        }
        th {
            text-align: center;
        }
        td {
            height: 100px;
        }
        
        .today {
            background-color: rgb(220,220,220);
        }
        .title{
            color:#FFFFFF;
        }
    </style>
</head>
<body style="background-color:#333333">
    <div class="container">
        <ul class="list-inline" style="height:55px">
            <li class="list-inline-item"><a href="index.php?page=calendar&an=<?= $moisav; ?>"  class="btn btn-default" style="font-size: 20px">&lt; </a></li>
            <li class="list-inline-item"><div class="container" style="width:400px;height:55px"><span class="title"><?= $now; ?></span></div></li>
            <li class="list-inline-item"><a href="index.php?page=calendar&an=<?= $moisap; ?>" class="btn btn-default" style="font-size: 20px" > &gt;</a></li>
        </ul>
        <br>
        <p class="text-center"><a href="index.php?page=calendar" class="btn btn-primary">Actuel</a></p>
        <table class="table table-bordered" style="background-color:#FFFFFF;border:0px solid white;max-height:400px;">
            <thead>
                <tr>
                    <th style="background-color:#708090;color:#FFFFFF">Lundi</th>
                    <th style="background-color:#708090;color:#FFFFFF">Mardi</th>
                    <th style="background-color:#708090;color:#FFFFFF">Mercredi</th>
                    <th style="background-color:#708090;color:#FFFFFF">Jeudi</th>
                    <th style="background-color:#708090;color:#FFFFFF">Vendredi</th>
                    <th style="background-color:#708090;color:#FFFFFF">Samedi</th>
                    <th style="background-color:#708090;color:#FFFFFF">Dimanche</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($weeks as $x) {
                        echo $x;
                    }
                ?>
            </body>
        </table>
    </div>
    <?php $content = ob_get_clean();?>
</body>
</html>