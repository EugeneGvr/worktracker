@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                  <form class="form-horizontal" method="POST" action="{{ route('cabinet.store') }}">
                    {{ csrf_field() }}
                    <input id="user-id" type="hidden" value="{{Auth::id()}}">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div>
                      <div class="cal-controller">
                        <a href="?ym={{$prev}}">&lt;</a>
                        <div class="cal-current-month">{{$html_title}} </div>
                        <a href="?ym={{$next}}">&gt;</a>
                      </div>
                      <table class="table table-bordered">
                        <thead>
                          <th>Пн.</th>
                          <th>Вт.</th>
                          <th>Ср.</th>
                          <th>Чт.</th>
                          <th>Пт.</th>
                          <th>Сб.</th>
                          <th>Вс.</th>
                        </thead>
                        <tbody>
                            @foreach ($weeks as $week)
                              {!! $week !!}
                            @endforeach
                        <tbody>
                      </table>
                      <button type="submit" class="btn btn-primary">
                          Сохранить
                      </button>
                    </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
