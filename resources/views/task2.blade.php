@extends('layout.header')

@section('title', 'Все продукты')
@section('content')
<table class="table">
  <thead>
    <tr>
      <th scope="col">Название</th>
      <th scope="col">Состав</th>
      <th scope="col">Вес</th>
      <th scope="col">Цена</th>
      <th scope="col"></th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    
    @foreach ($all_products as $product)
        <tr>
            <td>{{$product->name}}</td>
            <td>{{$product->compound}}</td>
            <td>{{$product->weight}}</td>
            <td>{{$product->current_price}}</td>
            @if($product->new == 'yes')
            <td><span class="badge bg-success">Новинка</span></td>
            @elseif($product->hit == 'yes')
            <td><span class="badge bg-warning">Хит</span></td>
            @endif
        </tr>
        
    @endforeach
    
    
  </tbody>
</table>
@endsection