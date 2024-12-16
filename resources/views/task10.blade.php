@extends('layout.header')
@section('title', 'Главная')
@section('content')
<table class="table">
    <thead>
        <tr>
        <th scope="col">Декабрь</th>
        <th scope="col">Ноябрь</th>
        <th scope="col">Октябрь</th>
        <th scope="col">Сентябрь</th>
        <th scope="col">Август</th>
        <th scope="col">Июль</th>
        <th scope="col">Июнь</th>
        <th scope="col">Май</th>
        <th scope="col">Апрель</th>
        <th scope="col">Март</th>
        <th scope="col">Февраль</th>
        <th scope="col">Январь</th>
        </tr>
    </thead>
    <tbody id="fill">
      @foreach ($q as $qq)
<tr>
            <td>{{$qq->december}}</td>
            <td>{{$qq->november}}</td>
            <td>{{$qq->october}}</td>
            <td>{{$qq->september}}</td>
            <td>{{$qq->august}}</td>
            <td>{{$qq->july}}</td>
            <td>{{$qq->june}}</td>
            <td>{{$qq->may}}</td>
            <td>{{$qq->april}}</td>
            <td>{{$qq->march}}</td>
            <td>{{$qq->february}}</td>
            <td>{{$qq->january}}</td>
        </tr>
@endforeach

    </tbody>
    </table>


@endsection