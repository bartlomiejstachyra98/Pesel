<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php

        function PeselValidation($pesel) {

            
            if(preg_match('/^[0-9]{11}$/', $pesel)==false){
                return false;
            };
            $pesela = str_split($pesel);
            $arrWag = array(1, 3, 7, 9, 1, 3, 7, 9, 1, 3);
            $suma = 0;
            $arrMonthAddValue = array(80, 0, 20, 40, 60);
            $arrMonth = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12);

            for ($i = 0; $i < 10; $i++) {
                $suma += $arrWag[$i] * $pesela[$i];
            }
            $sumaa = 10 - $suma %10;
            if ($sumaa != $pesela[10]) {
                return false;
            } 

            for ($i = 0; $i < 5; $i++) {
                for ($n = 0; $n < 12; $n++) {
                    $ArrPossibleValue[] = $arrMonthAddValue[$i] + $arrMonth[$n];
                }
            }

            $peselMonth = substr($pesel, 2, 2);
            $peselDay = substr($pesel, 4, 2);

            foreach ($ArrPossibleValue as $value)   
            if (!in_array($peselMonth, $ArrPossibleValue)) {
                return false;
            }
            if (substr($peselMonth, 0, 1) == '0' || substr($peselMonth, 0, 1) == '1')
                $century = 1900;
            if (substr($peselMonth, 0, 1) == '8' || substr($peselMonth, 0, 1) == '9')
                $century = 1800;
            if (substr($peselMonth, 0, 1) == '2' || substr($peselMonth, 0, 1) == '3')
                $century = 2000;
            if (substr($peselMonth, 0, 1) == '5' || substr($peselMonth, 0, 1) == '4')
                $century = 2100;
            if (substr($peselMonth, 0, 1) == '6' || substr($peselMonth, 0, 1) == '7')
                $century = 2200;
            if ($century == '2000')
                $peselMonth = $peselMonth - 20;
            if ($century == '1800')
                $peselMonth = $peselMonth - 80;
            if ($century == '2100')
                $peselMonth = $peselMonth - 40;
            if ($century == '2200')
                $peselMonth = $peselMonth - 60;

            $year = $century + substr($pesel, 0, 2);

            $maxDays = cal_days_in_month(CAL_GREGORIAN, $peselMonth, $year);
            if ($peselDay > $maxDays) {
                return false;
            }

            $today = date("Y-m-d");
            $birthDate = $year . "-" . $peselMonth . "-" . $peselDay;
            $birthDate = date_create($birthDate);
            $today = date_create($today);
            $interval = date_diff($today, $birthDate)->format('%R%a');
            if ($interval > 0) {
                return false;
            } else {
                return true;;
            }
        }
        $Pesele = Array('98122504993','98222504993','9812250499','30122504993','98125504993');
                foreach($Pesele as $p){
        if(PeselValidation($p)===true){
            echo "Pesel Poprawny";
        }
        else{
            echo "Pesel Niepoprawny";
        }
                }
        ?>
    </body>
</html>
