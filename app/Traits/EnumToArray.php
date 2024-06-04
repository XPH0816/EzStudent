<?php
namespace App\Traits;
use Illuminate\Support\Collection;
trait EnumToArray
{

  public static function names(): Collection
  {
    return collect(array_column(self::cases(), 'name'));
  }

  public static function values(): Collection
  {
    return collect(array_column(self::cases(), 'value'));
  }

  public static function collection(): Collection
  {
    return collect(array_combine(self::values(), self::names()));
  }

}
