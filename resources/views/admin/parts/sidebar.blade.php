<div class = "account"></div>
<ul id="sidemenu" class="sidebar-nav list-group list-group-flush">
  <li id="users">
    <a href="{{route('users.index')}}">
      <img class="sidebar-icon" src="/../../icon/users.svg">
      <div class="sidebar-title">Пользователи</div>
    </a>
  </li>
  <li id="requests">
    <a href="{{route('requests.index')}}">
      <img class="sidebar-icon" src="/../../icon/requests.svg">
      <div class="sidebar-title">Заявки</div>
    </a>
  </li>
  <li>
    <a class="accordion-toggle collapsed toggle-switch" data-toggle="collapse" href="#submenu-3">
      <img class="sidebar-icon" src="/../../icon/folder.svg">
      <div class="sidebar-title">Итоговые графики</div>
    </a>
  </li>
  <li>
    <a href="#">
      <img class="sidebar-icon" src="/../../icon/folder.svg">
      <div class="sidebar-title">Зарплаты</div>
    </a>
  </li>
</ul>
