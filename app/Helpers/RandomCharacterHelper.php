<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class RandomCharacterHelper
{
  public static function generateOrderCode($length = 6)
  {
      $letters = strtoupper(Str::random(intdiv($length, 2))); // Huruf acak
      $numbers = strval(rand(pow(10, (intdiv($length, 2)) - 1), pow(10, intdiv($length, 2)) - 1)); // Angka acak
      $merged = '';

      for ($i = 0; $i < strlen($letters); $i++) {
          $merged .= $letters[$i];
          if ($i < strlen($numbers)) {
              $merged .= $numbers[$i]; // Sisipkan angka setelah huruf
          }
      }

      return $merged;
  }
}
