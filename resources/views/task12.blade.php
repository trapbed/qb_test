@extends('layout.header')
@section('title', 'Главная')
@section('content')
<table class="table">
    <thead>
        <tr>
        <th scope="col">Название</th>
        <th scope="col">Средняя стоимость товаров в категории</th>
        
        </tr>
    </thead>
    <tbody id="fill">

      @foreach ($avg_cat as $ac)
<tr>
            <td>{{$ac->name}}</td>
            <td>{{$ac->how_much}}</td>
        </tr>
@endforeach

    </tbody>
    </table>


@endsection