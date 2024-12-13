@extends('layout.header')

@section('title', 'Категории')
@section('content')
<table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Название</th>
      
      <th scope="col"></th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    
    @foreach ($categories as $category)
        <tr>
            <td>{{$category->id}}</td>
            <td>{{$category->name}}</td>
            <td></td>
            <td></td>
        </tr>
        
    @endforeach
    
    
  </tbody>
</table>
@endsection