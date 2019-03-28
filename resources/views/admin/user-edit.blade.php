@extends('admin.layouts.app_admin')

@section('sidebar')

@section('content')

<div class="card">
  <div class="card-header">
    <img class="header-icon" src="/../../icon/edit-user.svg">
    <div class="header-title">Редактирование пользователя</div>
    <a class="back-link" href="{{route('users.index')}}" role="button">Назад к списку пользователей</a>
  </div>
  <div class="card-body short">
    <form class="user-form" action="{{route('users.update', $user)}}" method="POST">
      <input type="hidden" name="_method" value="put">
      {{ csrf_field() }}

      {{-- Form include --}}
      @include('admin.parts.user_form')

    </form>
</div>
</div>
@endsection
