<?php

namespace App\Constants;

use ReflectionClass;

class ActivityStatus
{
  public const PENDING = 'Pending';
  public const CONFIRMED = 'Selesai';

  public static function all()
  {
    $class = new ReflectionClass(__CLASS__);
    return collect($class->getConstants());
  }
}
