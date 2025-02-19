<?php

namespace App\Constants;

use ReflectionClass;

class Department
{
  public const TATA_USAHA = 'Tata Usaha';
  public const KERJASAMA = 'Kerjasama';
  public const PERENCANAAN = 'Program dan Perencanaan';

  public static function all()
  {
    $class = new ReflectionClass(__CLASS__);
    return collect($class->getConstants());
  }
}
