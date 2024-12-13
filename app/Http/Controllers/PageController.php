<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use stdClass;

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
            $cat = (array) json_decode(DB::table('categories')->select('id', 'name')->distinct()->get());
            $obj_y_n = new stdClass();
            
            $type = [$cat, 'string', 'numeric', 'file', 'numeric', 'textarea',['yes', 'no'], ['yes', 'no'],   'numeric'];
            $row = ['category_id', 'name', 'current_price', 'image', 'weight', 'compound','new','hit', 'discount'];
            $labels = ['Категория',"Название", "Цена", "Изображение", "Вес (гр)", "Состав","Новинка","Хит", "Скидка"];
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
        try {
            $create_row = DB::table($request->aspect)->insert($array_for_create);
            return redirect('/')->with('mess', 'Данные сохранены!');
        } catch (QueryException $e) {
            return redirect('/')->with('error', 'Не удалось создать!');
        }
    }

    public function all_products(){
        $all_products = DB::table('products')->select('name', 'current_price', 'weight', 'compound', 'new', 'hit')->get();
        return view('task2', ['all_products'=>$all_products]);
    }
    public function discount_product(){
        $all_products = DB::table('products')->select('name', 'current_price', 'weight', 'compound', 'discount', 'new', 'hit')->where('discount', '>', '20')->get();
        return view('task3', ['all_products'=>$all_products]);
    }
    
    public function new_product(){
        $all_products = DB::table('products')->select('name', 'current_price', 'weight', 'compound', 'discount', 'new', 'hit')->where('new', '=', 'yes')->get();
        return view('task2', ['all_products'=>$all_products]);
    }

    public function wool_product(){
        $all_products = DB::table('products')->select('name', 'current_price', 'weight', 'compound', 'discount', 'new', 'hit')->where('compound', 'LIKE', '%шерсть%')->get();
        return view('task2', ['all_products'=>$all_products]);
    }
    public function min_weight(){
        $all_products = DB::table('products')->select('name', 'current_price', 'weight', 'compound', 'discount', 'new', 'hit')->where('weight', '<', '200')->get();
        return view('task2', ['all_products'=>$all_products]);
    }
    public function wegetables_product(){
        $category_id = DB::table('categories')->select('id')->where('name', '=', 'Овощи')->get()[0]->id;
        $all_products = DB::table('products')->select('name', 'current_price', 'weight', 'compound', 'discount', 'new', 'hit')->where('category_id', '=', $category_id)->get();
        return view('task2', ['all_products'=>$all_products]);
    }
    public function categories_product(){
        $categories = DB::table('categories')->select('id', 'name')->orderBy('name', 'ASC')->get();
        return view('task3', ['categories'=>$categories]);
    }
    public function change_data_type(){
        $change = DB::table('users')->where('role', '=', 'user')->update(['role'=> 'client']);    
        return back()->with(['mess'=>'Тип данных изменен (состав)']);
    }
    public function courier_ivan(){
        $courier_ivan = DB::table('couriers')->select('name', 'phone', 'status')->where('name', 'LIKE', '%иван')->get();
        return view('task4', ['couriers'=>$courier_ivan]);
    }
    public function courier_free(){
        $couriers = DB::table('couriers')->select('name', 'phone', 'status')->where('status', '=', 'Свободен')->get();
        return view('task4', ['couriers'=>$couriers]);
    }
    public function courier_status_change(){
        $couriers = DB::table('couriers')->where('status', '=', 'Занят')->update(['status'=> 'Свободен']);
        return back()->with('mess', 'Статус курьеров изменен!');
    }
}
