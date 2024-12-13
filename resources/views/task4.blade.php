@extends('layout.header')

@section('title', 'Курьер Иван')
@section('content')
<table class="table">
  <thead>
    <tr>
      <th scope="col">Имя</th>
      <th scope="col">Телефон</th>
      <th scope="col">Статус</th>
    </tr>
  </thead>
  <tbody>
    
    @foreach ($couriers as $courier)
        <tr>
            <td>{{$courier->name}}</td>
            <td>{{$courier->phone}}</td>
            <td>{{$courier->status}}</td>
        </tr>
        
    @endforeach
    
    
  </tbody>
</table>
@endsection