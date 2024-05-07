<?php

namespace App\Utils;

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

  public static function echo($data)
  {
    if ($data) {
      return $data;
    }

    return view('components.main.null')->render();;
  }

  public static function digits($number, $digit)
  {
    return str_pad($number, $digit, '0', STR_PAD_LEFT);
  }
}
