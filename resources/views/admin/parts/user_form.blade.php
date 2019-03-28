    <div class="form-group">
      <label for="name">Имя</label>
      <input type="text" class="form-control" name="name" id="name"
            value="{{isset($user->name) ? $user->name : ''}}">
    </div>
    <div class="form-group">
      <label for="surname">Фамилия</label>
      <input type="text" class="form-control" name="surname" id="surname"
            value="{{isset($user->surname) ? $user->surname : ''}}">
    </div>
    <div class="form-group">
      <label for="center">Центр</label>
      <select id="center" class="form-control" name="center">
          <option value="{{isset($user->center) ? $user->center : 0}}" >Не выбрано</option>
          @foreach ($centers as $center)
          <option value="{{ $center->id}}" >{{$center->name}}</option>
          @endforeach
      </select>
    </div>
    <div class="form-group">
    <label for="">Slug</label>
    <input class="form-control" type="text" name="slug" placeholder="Автоматическая генерация" value="" readonly="">
    </div>

    <div class="form-group">
      <div class="form-check">
        <input type="checkbox" id="status" class="form-check-input" name="status"
              value="{{isset($user->status) ? $user->status : 0}}"
              {{isset($user->status) && $user->status ? 'checked' : ''}}>
        <label class="form-check-label" for="status">
          Администратор
        </label>
      </div>
      <input type="submit" class="btn btn-primary" value="{{isset($user) ? 'Изменить' : 'Добавить'}}">
  </div>
  </div>
  <script>
    $("#status").click(function () {
      if ($(this).prop("checked")) {
          $("#status").val("1");
      }
      else {
          $("#status").val("0");
      }
    });
  </script>
