<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    //
    public function create_something(Request $request){
        // dd($request);
        $aspect = isset($request->aspect) && $request->aspect!= null ? $request->aspect : false;
        if($aspect == 'categories'){
            $type = ['string'];
            $row = ['name'];
            $labels = ['Имя'];
        }
        else if($aspect == 'couriers'){
            $type = ['string', 'string', ['Свободен','Занят']];
            $row = ['name', 'phone', 'status'];
            $labels = ['Имя',"Номер телефона", "Статус"];
        }
        else if($aspect == 'products'){
            $cat = DB::table('categories')->select('id', 'name')->get();
            $type = [$cat, 'string', 'numeric', 'file', 'numeric', 'textarea', 'numeric'];
            $row = ['categories', 'name', 'current_price', 'image', 'weight', 'compound', 'discount'];
            $labels = ['Категория',"Имя", "Цена", "Изображение", "Вес", "Состав", "Скидка"];
        }
        else if($aspect == 'users'){
            $type = ['string', 'email', 'string', 'password', ['admin', 'user']];
            $row = ['name', 'email', 'phone', 'password', 'role'];
            $labels = ['Имя',"Почта", "Номер телефона", "Пароль", "Роль"];
        }
        $json_for_controller = json_encode($row);
        return view('task1', ['aspect'=>$aspect, 'type'=>$type, 'row'=>$row, 'labels'=>$labels, 'json_for_controller'=>$json_for_controller]);
    }

    public function create_row(Request $request){
        

        $array_for_create = [];
        foreach(json_decode($request->json_for_controller) as $name_row){
            if($name_row == 'password'){
                $array_for_create[$name_row] = Hash::make($request->$name_row);
            }
            else{
                $array_for_create[$name_row] = $request->$name_row;
            }
        }
        $create_row = DB::table($request->aspect)->insert($array_for_create);
        dd(json_decode( $create_row));
        // return
    }
}
