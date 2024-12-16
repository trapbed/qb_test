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
      @foreach ($expensive as $ex)
<tr>
            <td>{{$ex->name}}</td>
            <td>{{$ex->weight}}</td>
            <td>{{$ex->current_price}}</td>
            <td>{{$ex->compound}}</td>
        </tr>
        @break
@endforeach

    </tbody>
    </table>


@endsection