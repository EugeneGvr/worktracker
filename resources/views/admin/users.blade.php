@extends('admin.layouts.app_admin')

@section('sidebar')

@section('content')
<div class="card-header">
    <img class="header-icon" src="/../../icon/users.svg">
    <div class="header-title">Пользователи</div>
    <a class="btn btn-primary" href="{{route('users.create')}}" role="button">Создать</a>
</div>
<div class="card-body">
  <div class="table-header">
    <img class="table-icon" src="/../../icon/registr-users.svg">
    <div class="table-title">Зарегистрированые пользователи</div>
  </div>
  <table class="table users">
      <thead>
        <th>Статус</th>
        <th>Имя</th>
        <th>Email</th>
        <th></th>
      </thead>
      <tbody>
        @forelse ($registrated_users as $user)
          @if ($user->status != 2)
            <tr>
              @if ($user->status === 1)
                <td>Администратор</td>
              @elseif ($user->status ===0)
                <td>Пользователь</td>
              @endif
              <td>{{$user->name." ".$user->surname}}</td>
              <td>{{$user->email}}</td>
              <td>
                <a class="delete" user="{{$user->id}}">
                  <img src="/../../icon/delete.svg">
                </a>
                <a href="{{route('users.edit', ['id'=>$user->id])}}">
                  <img src="/../../icon/edit.svg">
                </a>
              </td>
            </tr>
            <div class = "popup"id="popup-{{$user->id}}">
              <div class="content">
                Вы уверены что хотите удалить пользователя с именем <br><b>{{$user->name." ".$user->surname}}</b>?
              </div>
              <div class="action">
                <form class="" action="{{route('users.destroy', $user)}}" method="post">
                  <input type="hidden" name="_method" value="DELETE">
                  {{csrf_field()}}
                  <button type="submit" class="btn btn-primary yes">Да</button>
                </form>
                <button class="btn btn-primary">Нет</button>
              </div>
            </div>
          @endif
        @empty
          <tr>
            <td colspan="3" class="text-center"><h2>Данные отсутствуют</h2></td>
          </tr>
        @endforelse
      </tbody>
  </table>
</div>
@if(count($invited_users))
<div class="card-body">
  <div class="table-header">
    <img class="table-icon" src="/../../icon/unregistr-users.svg">
    <div class="table-title">Незарегистрированые пользователи</div>
  </div>
  <table class="table users">
      <thead>
        <th>Статус</th>
        <th>Имя</th>
        <th>Ссылка для регистрации</th>
        <th></th>
      </thead>
      <tbody>
        @forelse ($invited_users as $user)
          @if ($user->status != 2 && !$user->registrated)
            <tr>
              @if ($user->status === 1)
                <td>Администратор</td>
              @elseif ($user->status ===0)
                <td>Пользователь</td>
              @endif
              <td>{{$user->name." ".$user->surname}}</td>
              <td class="invitation-url">
                <input type="button" class="btn btn-light" value="копировать">
                <div class="link">http://{{$_SERVER['HTTP_HOST']."/register/".$user->slug}}</div>

              </td>
              <td>
                <a class ="delete" user="{{$user->id}}">
                  <img src="/../../icon/delete.svg">
                </a>
                <a href="{{route('users.edit', $user)}}">
                  <img src="/../../icon/edit.svg">
                </a>
              </td>
            </tr>
            <div class = "popup"id="popup-{{$user->id}}">
              <div class="content">
                Вы уверены что хотите удалить пользователя с именем <br><b>{{$user->name." ".$user->surname}}</b>?
              </div>
              <div class="action">
                <form class="" action="{{route('users.destroy', $user)}}" method="post">
                  <input type="hidden" name="_method" value="DELETE">
                  {{csrf_field()}}
                  <button type="submit" class="btn btn-primary yes">Да</button>
                </form>
                <button class="btn btn-primary">Нет</button>
              </div>
            </div>
          @endif
        @empty
          <tr>
            <td colspan="3" class="text-center"><h2>Данные отсутствуют</h2></td>
          </tr>
        @endforelse
      </tbody>
    </table>
</div>
@endif
<script>
  $('input[type="button"]').click(function() {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val($(this).closest("td").text()).select();
    document.execCommand("copy");
    $temp.remove();
  });
  $('table tr td a img').hover(function() {
    let iconUrl = $(this).attr('src');
    iconUrl = iconUrl.indexOf('-hover') != -1 ?
      iconUrl.replace('-hover.svg', '.svg') :
      iconUrl.replace('.svg', '-hover.svg');
    $(this).attr("src",iconUrl);
  });
  $('table tr td a.delete').click(function() {
    $('.popup-background').show();
    $('#popup-'+$(this).attr('user')).show();
  });
  $('.popup .action button').click(function() {
    $('.popup-background').hide();
    $('.popup').hide();
  });
</script>
@endsection
