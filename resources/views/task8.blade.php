@extends('layout.header')
@section('title', 'Главная')
@section('content')
<table class="table">
    <thead>
        <tr>
        <th scope="col">Название</th>
        <th scope="col">Общая сумма товаров в категории</th>
        
        </tr>
    </thead>
    <tbody id="fill">

      @foreach ($general_price_cat as $g)
<tr>
            <td>{{$g->name}}</td>
            <td>{{$g->how_much}}</td>
        </tr>
@endforeach

    </tbody>
    </table>


@endsection