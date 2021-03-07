<?php
namespace App\Traits;

use Carbon\Carbon;
use DateTime;

class CalculateRoomDay{

    function calculateDay($checkingdate){
        
        $origin = new DateTime(Carbon::parse("{$checkingdate->checkin_date}")->toFormattedDateString());
        
    }
}

?>