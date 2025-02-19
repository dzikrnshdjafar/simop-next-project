<?php

namespace App\Utils;

use Carbon\Carbon;

class FormatUtils
{
  public static function phoneNumber($phoneNumber)
  {
    if ($phoneNumber) {
      $formattedPhone = substr($phoneNumber, 0, 4) . '-' . substr($phoneNumber, 4, 4) . '-' . substr($phoneNumber, 8, 4);
      return $formattedPhone;
    }
    return null;
  }

  public static function dateIndo($date)
  {
    if ($date) {
      return Carbon::createFromFormat('Y-m-d', $date)->format('d/m/Y');
    }
    return null;
  }

  public static function chatTime($timestamp)
  {
    return Carbon::parse($timestamp)->diffForHumans();
  }
}
