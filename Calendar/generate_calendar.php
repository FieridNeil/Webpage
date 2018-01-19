<?php 

date_default_timezone_set('America/Los_Angeles');

function get_numeric_month($month){
    switch($month){
            case 'January':
            $month = 1;
            break;
            
            case 'February':
            $month = 2;
            break;
            
            case 'March':
            $month = 3;
            break;
            
            case 'April':
            $month = 4;
            break;
            
            case 'May':
            $month = 5;
            break;
            
            case 'June':
            $month = 6;
            break;
            
            case 'July':
            $month = 7;
            break;
            
            case 'August':
            $month = 8;
            break;
            
            case 'September':
            $month = 9;
            break;
            
            case 'October':
            $month = 10;
            break;
            
            case 'November':
            $month = 11;
            break;
            
            case 'December':
            $month = 12;
            break;
        }
        return $month;
}



function generate_month($month, $year){
    // Calculate the number of days in a given month
        $month = get_numeric_month($month);
        $current_days_in_month = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        
        $day = 1;
        $loop = 0;
        // Get an assoc array of all the information about a particular day
        $day_info = getdate(mktime(0,0,0,$month,1,$current_year));

        echo '<div class="row">';
        for(; $loop < $day_info['wday']; $loop++){
            echo '<div class="col-md alert alert-warning"></div>';
        }

        while($day <= $current_days_in_month){

            if($loop == 7){
                $loop = 0;
                echo '</div><div class="row">';
            }


            echo '<div class="col-md alert alert-warning">'. $day . '</div>';
            $day++;
            $loop++;
        }
        for(;$loop != 7; $loop++){
            echo '<div class="col-md alert alert-warning"></div>';
        }
        echo '</div>';
}





?>