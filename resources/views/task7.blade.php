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
        <th scope="col">Сколько раз заказали</th>
        
        </tr>
    </thead>
    <tbody id="fill">

      @foreach ($popular_prods as $pp)
<tr>
            <td>{{$pp->name}}</td>
            <td>{{$pp->weight}}</td>
            <td>{{$pp->current_price}}</td>
            <td>{{$pp->compound}}</td>
            <td>{{$pp->how_much}}</td>
        </tr>
@endforeach

    </tbody>
    </table>


@endsection