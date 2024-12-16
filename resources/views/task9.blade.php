@extends('layout.header')
@section('title', 'Главная')
@section('content')
<table class="table">
    <thead>
        <tr>
        <th scope="col">Название</th>
        <th scope="col">Вес</th>
        <th scope="col">Цена</th>
        <th scope="col">Состав</th>
        </tr>
    </thead>
    <tbody id="fill">
      @foreach ($prods as $prod)
<tr>
            <td>{{$prod->name}}</td>
            <td>{{$prod->weight}}</td>
            <td>{{$prod->current_price}}</td>
            <td>{{$prod->compound}}</td>
        </tr>
@endforeach

    </tbody>
    </table>


@endsection