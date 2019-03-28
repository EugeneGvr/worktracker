<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Cabinet extends Model
{
      public static function generateCalendar() {

          if (isset($_GET['ym'])) {
            $ym = $_GET['ym'];
          } else {
            $ym = date('Y-m');
          }
          $timestamp = strtotime($ym . '-01');
          $html_title = date('Y/m', $timestamp);
          $prev = date('Y-m', strtotime('-1 month', $timestamp));
          $next = date('Y-m', strtotime('+1 month', $timestamp));
          $day_count = date('t', $timestamp);
          $str = date('w', $timestamp)-1;
          $weeks = [];

          $week = str_repeat('<td class="not_this_month"></td>', $str);
          for ( $day = 1; $day <= $day_count; $day++, $str++) {
            $state = isset($_COOKIE[Auth::id().'/'.$html_title.'/'.$day]) ? $_COOKIE[Auth::id().'/'.$html_title.'/'.$day] : 0;
            $bg_color = isset($_COOKIE[Auth::id().'/'.$html_title.'/'.$day]) ? 'yellow' : 'transparent';
              $week .= '<td class="day" style="background-color: '.$bg_color.';"><input type="hidden" name="'.$html_title.'/'.$day.'" value="'.$state.'">' . $day.'</td>';
              if ($str % 7 == 6 || $day == $day_count) {
                  if ($day == $day_count) {
                    $week .= str_repeat('<td class="day not_this_month"></td>', 6 - ($str % 7));
                  }
                   $weeks[] = '<tr>' . $week . '</tr>';
                  $week = '';
              }
          }
          $return_array = [
            'weeks'       => $weeks,
            'prev'        => $prev,
            'next'        => $next,
            'html_title'  => $html_title
          ];
          return $return_array;
      }
}
