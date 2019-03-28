@extends('admin.layouts.app_admin')

@section('sidebar')

@section('content')
<div class="card-header">
    <img class="header-icon" src="/../../icon/requests.svg">
    <div class="header-title">Заявки</div>
</div>
  @foreach ($requests as $request)
    {!! $request !!}
  @endforeach
  <script>
  $('.table-header img').click(function() {
    console.log('ffff');
    if($(this).attr('state') == 'closed') {
      $(this).attr('src', '/../../icon/up.svg');
      $(this).attr('state', 'active');
      $('table.requests').show();
    } else if($(this).attr('state') == 'active') {
      $(this).attr('src', '/../../icon/down.svg');
      $(this).attr('state', 'closed');
      $('table.requests').hide();
    }
  });
  </script>
@endsection
