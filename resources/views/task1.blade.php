@extends('layout.header')


@if(isset($errors) && $errors->any())
    <script>alert('{{$errors->first()}}')</script>
    <?php
        unset($errors);
    ?>
@endif
<?php
        print_r($type[0]);
    
?>
@section('title', 'Добавление в {{$aspect}}')
@section('content')
<span class="lh-lg fs-4">Добавление в таблицу {{$aspect}}</span>
<form action="{{route('create_row')}}" method="POST" enctype='multipart/form-data'>
    @csrf
    <input type="hidden" name="aspect" value={{$aspect}}>
    <input type="hidden" name="json_for_controller" value={{$json_for_controller}}>
    @for ($i = 0 ; $i<count($row); $i++)
        
            @if(is_string($type[$i]))
                @if($type[$i] != 'checkbox')
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">{{$labels[$i]}}</label>
                        <input required type="{{$type[$i]}}" name="{{$row[$i]}}" class="form-control" id="exampleInputPassword1">
                    </div>  
                @else
                    <div class="mb-3">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked type="{{$type[$i]}}" name="{{$row[$i]}}">
                        <label for="exampleInputPassword1" class="form-label">{{$labels[$i]}}</label>
                    </div>  
                @endif            
            @elseif(!is_string($type[$i]))
            <div class="mb-3">
                
                <label for="exampleInputPassword1" class="form-label">{{$labels[$i]}}</label>
                <select required class="form-select" name="{{$row[$i]}}" aria-label="Default select example">
                    <option selected>{{$labels[$i]}}</option>
                    @foreach ($type[$i] as $option)
                        @if(isset($option->id))
                            <option value="{{$option->id}}">{{$option->name}}</option> 
                        @else
                            <option value="{{$option}}">{{$option}}</option> 
                        @endif
                    @endforeach
                </select>
            </div>
            @endif
        
        
    @endfor
    
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection