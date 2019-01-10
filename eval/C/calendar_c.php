<?php
    setlocale(LC_ALL, 'fra');
    if (isset($_GET['an'])) {
        $an = $_GET['an'];
    } else {
        $an = date('Y-m');
    }
    $dt = strtotime($an . '-01');  
    if ($dt === false) {
        $an = date('Y-m');
        $dt = strtotime($an . '-01');
    }

    $current = date('Y-m-j');
    $now = utf8_encode(ucfirst(strftime('%b  %Y', $dt)));
    $moisav = date('Y-m', strtotime('-1 month', $dt));
    $moisap = date('Y-m', strtotime('+1 month', $dt));
    $daysCount = date('t', $dt);
    $str = date('N', $dt);
    //var_dump($str);

    $week = '';

    for($x = 0; $x < ($str -1); $x++){
        $week .= '<td></td>';
    }


    for ($day = 1; $day <= $daysCount; $day++, $str++) {
        $date = "$an-$day";
        if ($current == $date) {
            $week .= '<td class="today" title="now">';
        } else {
            $week .= '<td>';
        }

        if (isset($_GET['an'])) {
            if ($day < 10) {
                $occup = $_GET['an']."-0".$day;
            }
            else {
                $occup = $_GET['an']."-".$day;
            }
        } else {
            if ($day < 10) {
                $occup = date('Y-m')."-0".$day;
            }
            else {
                $occup = date('Y-m')."-".$day;
            }
        }
        $occup2 = checkrdv2_SELECT($_SESSION['id'], $occup);
        if (isset($occup2['0'])) {
            $occup2 = '<a style="color: #00cc00" href="index.php?page=rdv&action=voir&date='.$occup.'"><b>Voir les rdv<b></a>';
        }
        else {
            $occup2 = "Pas de rdv";
        }
        

         
        $week = "$week<div class='row'><div class='col-lg-12' style='font-size: 21px;text-align: right'><b>$day</b></div></div><div class='row'><div class='col-lg-12'>
        ".$occup2."</div></td>";
        if ($str % 7 == 0 || $day == $daysCount) {
            if ($day == $daysCount && $str % 7 != 0) {
                $week = $week.str_repeat('<td></td>', 7 - $str % 7);
            }
            $weeks[] = "<tr>$week</tr>";
            $week = '';
        }
    }
    require_once('./V/calendar_v.php');
    require_once('./V/template.php');
?> 