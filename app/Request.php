<?php

namespace App;

use DB;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
  public static function create($request, $id) {
    foreach ($request as $date => $value) {
      if(preg_match('/\d*\/\d*\/\d*/', $date) && $value) {
        $splitted_date = explode('/', $date);
        $request = array(
          'user_id'     => $id,
          'year'        => $splitted_date[0],
          'month'       => $splitted_date[1],
          'day'         => $splitted_date[2],
          'value'       => $value,
          'created_at'  => date('Y-m-d H:i:s'),
          'updated_at'  => date('Y-m-d H:i:s'),
        );
        if (!self::checkDataAvail($request)) {
          DB::table('requests')->insert($request);
        }
      }
    }
  }

  public static function checkDataAvail($request) {
      return count(DB::table('requests')->get()
        ->where('user_id', '=', $request['user_id'])
        ->where('year', '=', $request['year'])
        ->where('month', '=', $request['month'])
        ->where('day', '=', $request['day']));
  }

  public static function generateRequestTable() {
      $ym = date('Y-m');
      $timestamp = strtotime($ym . '-01');
      $html_title = date('Y/m', $timestamp);
      $prev = date('Y-m', strtotime('-1 month', $timestamp));
      $next = date('Y-m', strtotime('+1 month', $timestamp));
      $day_count = date('t', $timestamp);
      $str = date('w', $timestamp)-1;

      $requests = [];
      $users = DB::table('requests')
        ->where('year', 2019)
        ->where('month', 03)
        ->groupBy('user_id')
        ->join('users', 'users.id', '=', 'requests.user_id')
        ->get(['requests.user_id', 'users.name', 'users.surname']);
      foreach ($users as $user) {
        $request = '<div class="card-body">
          <div class="table-header">
            <img class="table-icon" state="closed" src="/../../icon/down.svg"
              style="width:10px;height:10px;margin: 19px;
              background-size: 10px;">
            <div class="table-title">'.$user->name.' '.$user->surname.'</div>
            <div class="table-actions">
              <input type="submit" class="btn btn-primary" value="Подтвердить">
              <input type="submit" class="btn btn-danger" value="Отклонить">
            </div>
          </div>
          <table class="table requests">';
          $request .=
          '<thead>
            <th>Пн.</th>
            <th>Вт.</th>
            <th>Ср.</th>
            <th>Чт.</th>
            <th>Пт.</th>
            <th>Сб.</th>
            <th>Вс.</th>
          </thead>';
        //for ( $day = 1; $day <= $day_count; $day++, $str++) {
        $days = DB::table('requests')
          ->where('year', 2019)
          ->where('month', 03)
          ->where('user_id', $user->user_id)
          ->pluck('day')
          ->toArray();
          $week = str_repeat('<td class="not_this_month"></td>', $str);
        for ($day=1; $day <= $day_count; $day++, $str++) {
          $state = in_array($day, $days) ? 'checked' : '';
          $week .= '<td class="day day-'.$day.' '.$state.'">'.$day.'</td>';
          // $request .= in_array($day, $days) ?
          //   '<td class="day day-'.$day.'" style="background-color: #ccc">'.$day.'</td>' :
          //   '<td class="day day-'.$day.'">'.$day.'</td>';
          if ($str % 7 == 6 || $day == $day_count) {
              if ($day == $day_count) {
                $week .= str_repeat('<td class="day not_this_month"></td>', 6 - ($str % 7));
              }
              $request .= '<tr>' . $week . '</tr>';
              $week = '';
          }
        }
        $request .= '</table></div>';
        $requests[] = $request;
        $request = '';
      }
      error_log($request);
      return $requests;
    }
}
