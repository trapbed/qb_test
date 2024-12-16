@extends('layout.header')
@section('title', 'Главная')
@section('content')
<table class="table">
    <thead>
        <tr>
        <th scope="col">Название категории</th>
        <th scope="col">Сколько товаров в категории</th>
        
        </tr>
    </thead>
    <tbody id="fill">

      @foreach ($prod_cat_count as $pcc)
<tr>
            <td>{{$pcc->name}}</td>
            <td>{{$pcc->how_much}}</td>
        </tr>
@endforeach

    </tbody>
    </table>


@endsection