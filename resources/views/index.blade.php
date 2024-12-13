@extends('layout.header')
@section('title', 'Главная')
@section('content')
    <div class="empty"></div>
    <ul class="list-group">
      <li class="list-group-item" id="see_form_1" onclick="see_tables()">Написать запросы, позволяющие вводить новые данные в существующие таблицы БД.</li>
      <li class="list-group-item"><a href="{{route('all_products')}}">Вывести список всех товаров, которые в наличие.</a></li>
      <li class="list-group-item"><a href="{{route('discount_product')}}">Найти товары со скидкой больше 20 %.</a></li>
      <li class="list-group-item"><a href="{{route('new_product')}}">Найти все новинки товаров.</a></li>
      <li class="list-group-item"><a href="{{route('wool_product')}}">Вывести все товары, в составе которых есть «шерсть».</a></li>
      <li class="list-group-item"><a href="{{route('min_weight')}}">Вывести все товары с весом меньше 200 г.</a></li>
      <li class="list-group-item"><a href="{{route('wegetables_product')}}">Найти все товары с категорией «Овощи».</a></li>
      <li class="list-group-item"><a href="{{route('categories_product')}}">Вывести список категорий товаров в алфавитном порядке.</a></li>
      <li class="list-group-item"><a href="{{route('change_data_type')}}">Допустим, что изменилась политика компании. Поэтому нужно обновить данные о пользователях: изменить роль с «пользователь» на «клиент».</a></li>
      <li class="list-group-item"><a href="{{route('courier_ivan')}}">Вывести всех курьеров с именем «Иван».</a></li>
      <li class="list-group-item"><a href="{{route('courier_free')}}">Вывести список всех свободных курьеров.</a></li>
      <li class="list-group-item"><a href="{{route('courier_status_change')}}">Изменить статус всех занятых курьеров на «свободен».</a></li>
      
    </ul>

    <script>
        function see_tables(){
            $("#background_modal").css('display','flex');
            div_form =document.createElement(`div`);
            div_form.setAttribute('id','div_form');
            div_form.innerHTML = `
                <form action="{{route('create_something')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <h5 class="modal-title">Создать</h5>
                        <div class="empty1_5"></div>
                        <div class="mb-3">
                            <select required class="form-select" name="aspect">
                                <option selected>Что создаем</option>
                                <option value="categories">Категорию</option>
                                <option value="couriers">Курьера</option>
                                <option value="products">Продукт</option>
                                <option value="users">Пользователя</option>
                            </select>
                            
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">К созданию</button>
                    </form>
            `;
            $("#background_modal").append(div_form);
        }
    </script>
@endsection