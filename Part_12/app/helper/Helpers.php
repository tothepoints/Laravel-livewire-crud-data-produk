<?php

if (!function_exists('currency_IDR')) {
   function currency_IDR($value)
   {
      $fmt = new NumberFormatter('id_ID', NumberFormatter::CURRENCY);
      $fmt->setAttribute(NumberFormatter::FRACTION_DIGITS, 0);
      return $fmt->format($value);
   }
}

if (!function_exists('currencyIDRToNumeric')) {
   function currencyIDRToNumeric($value)
   {
      return preg_replace('/\D/', '', $value);
   }
}
