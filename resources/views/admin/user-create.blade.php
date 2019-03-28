@extends('admin.layouts.app_admin')

@section('sidebar')

@section('content')

<div class="card">
  <div class="card-header">
    <img class="header-icon" src="/../../icon/add-user.svg">
    <div class="header-title">Регистрация пользователя</div>
    <a class="back-link" href="{{route('users.index')}}" role="button">Назад к списку пользователей</a>
  </div>
  <div class="card-body short">
    <form class="user-form" action="{{route('users.store')}}" method="POST">
      {{ csrf_field() }}

      {{-- Form include --}}
      @include('admin.parts.user_form')

    </form>
</div>
</div>
@endsection
