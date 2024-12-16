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
        return view('task2', ['all_products'=>$all_products]);
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
        $category_id = DB::table('categories')->select('id')->where('name', '=', 'Овощи')->get()[0]->id;
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
        if($change){
            return back()->with(['mess'=>'Роль изменена!']);
        }  
        else{
            return back()->with(['error'=>'Не удалось изменить роль!']);
        }
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
    public function weight(){
        $weight = DB::table('products')->select('products.*')->where('weight', '=', 800)->where('date_remove', '=', NULL)->get();
        return view('task2', ['all_products'=>$weight]);
    }
    public function prod_cat_count(){
        $prod_cat_count = DB::table('categories')->select("categories.*", DB::raw("count(products.id) as how_much"))->join('products', 'categories.id', '=', 'products.category_id', 'left outer')->groupBy('categories.id')->get();
        return view('task6', ['prod_cat_count'=>$prod_cat_count]);
    }
    public function popular_prods(){
        $popular_prods = DB::table('products')->select("products.*", DB::raw("count(order_products.id) as how_much"))->join('order_products', 'products.id', '=', 'order_products.product_id', 'left outer')->groupBy('products.id')->orderBy( DB::raw("count(order_products.id)"), 'DESC')->get(); ;
        return view('task7', ['popular_prods'=>$popular_prods]);
    }
    public function more_one(){
        $more_one = DB::table('products')->select("products.*", DB::raw("count(order_products.id) as how_much"))->join('order_products', 'products.id', '=', 'order_products.product_id', 'left outer')->groupBy('products.id')->having(DB::raw("count(order_products.id)"), '>', 1)->get();
        return view('task7', ['popular_prods'=>$more_one]);
    }
    public function general_price(){
        $general_price_cat = DB::table('categories')->select("categories.*", DB::raw("sum(products.current_price) as how_much"))->join('products', 'categories.id', '=', 'products.category_id', 'left outer')->groupBy('categories.id')->get();
        return view('task8', ['general_price_cat'=>$general_price_cat]);
    }
    public function expensive_limit(){
        $expensive_5 = DB::table('products')->select('products.*')->orderBy('products.current_price', 'DESC')->limit(5)->get(); 
        return view('task9', ['prods'=>$expensive_5]);
    }
    public function no_order(){
        $no_order = DB::table('products')->select('products.*', DB::raw('count(order_products.product_id)'))->join('order_products', 'products.id', '=', 'order_products.product_id', 'left outer')->groupBy('products.id')->having(DB::raw('count(order_products.product_id)'), '=', 0)->get(); 
        return view('task9', ['prods'=>$no_order]);
    }
    public function order_month(){
        $orders =  DB::table('orders')->select(DB::raw("(count(CASE 
            WHEN created_at <= '2024-12-31' AND created_at >= '2024-12-01' THEN 1 
            ELSE NULL 
            END)) as december"), DB::raw("
            (count(CASE 
            WHEN created_at <= '2024-11-30' AND created_at >= '2024-11-01' THEN 1 
            ELSE NULL 
            END)) as november, 
            (count(CASE 
            WHEN created_at <= '2024-10-31' AND created_at >= '2024-10-01' THEN 1 
            ELSE NULL 
            END)) as 'october',  
            (count(CASE 
            WHEN created_at <= '2024-09-30' AND created_at >= '2024-09-01' THEN 1 
            ELSE NULL 
            END)) as 'september',  
            (count(CASE 
            WHEN created_at <= '2024-08-31' AND created_at >= '2024-08-01' THEN 1 
            ELSE NULL 
            END)) as 'august',  
            (count(CASE 
            WHEN created_at <= '2024-07-31' AND created_at >= '2024-07-01' THEN 1 
            ELSE NULL 
            END)) as 'july',  
            (count(CASE 
            WHEN created_at <= '2024-06-30' AND created_at >= '2024-06-01' THEN 1 
            ELSE NULL 
            END)) as 'june',  
            (count(CASE 
            WHEN created_at <= '2024-05-31' AND created_at >= '2024-05-01' THEN 1 
            ELSE NULL 
            END)) as 'may',  
            (count(CASE 
            WHEN created_at <= '2024-05-31' AND created_at >= '2024-04-01' THEN 1 
            ELSE NULL 
            END)) as 'april',  
            (count(CASE 
            WHEN created_at <= '2024-03-31' AND created_at >= '2024-03-01' THEN 1 
            ELSE NULL 
            END)) as 'march',  
            (count(CASE 
            WHEN created_at <= '2024-02-29' AND created_at >= '2024-02-01' THEN 1 
            ELSE NULL 
            END)) as 'february',  
            (count(CASE 
            WHEN created_at <= '2024-01-31' AND created_at >= '2024-01-01' THEN 1 
            ELSE NULL 
            END)) as 'january'"))->get(); 
        return view('task10', ['q'=>$orders]);
    }
    public function avg_sum(){
        $avg_sum = DB::table('orders')->select(DB::raw('avg(orders.sum) as how_much'))->where('created_at', '<=', '2024-12-31')->where('created_at', '>=', '2024-10-01')->get(); 
        return view('task11', ['avg_sum'=>$avg_sum]);
    }
    public function avg_cat(){
        $avg_cat = DB::table('products')->select('categories.*', DB::raw('avg(products.current_price) as how_much'))->join('categories', 'products.category_id', '=', 'categories.id', 'left outer')->groupBy('categories.id')->get();
        return view('task12', ['avg_cat'=> $avg_cat]);
    }
    public function expensive(){
        $expensive = DB::table('products')->select('products.*')->orderBy('products.current_price', 'DESC')->get(); 
        return view('task13', ['expensive'=>$expensive]);
    }
    public function order_courier(){
        $order_courier = DB::table('orders')->select("couriers.name as c_name", DB::raw('count(orders.id) as how_much'))->join('couriers', 'couriers.id', '=', 'orders.courier_id', 'left outer')->where('courier_id', '=', 1)->where('orders.created_at', '<=', '2024-12-31')->where('orders.created_at', '>=', '2024-12-01')->groupBy('couriers.id')->get();
        return view('task14', ['order_courier'=>$order_courier]);
    }
    // Route::get('/q24', function(){
    //     $query24 = DB::table('orders')->select("couriers.name as c_name", DB::raw('count(orders.id) as how_much'))->join('couriers', 'couriers.id', '=', 'orders.courier_id', 'left outer')->where('courier_id', '=', 1)->where('orders.created_at', '<=', '2024-12-31')->where('orders.created_at', '>=', '2024-12-01')->groupBy('couriers.id')->get();
    //     return view('q24', ['q' => $query24]);})->name('q24');



    // $query18 = DB::table('products')->select('products.*')->orderBy('products.current_price', 'DESC')->limit(5);
    // $query19 = DB::table('products')->select('products.*', 'count(order_products.product_id)')->join('order_products', 'products.id', '=', 'order_products.product_id')->groupBy('product.id')->having('count(order_products.product_id)', '=', 0);
    // $query20 = DB::table('orders')->select((count(CASE
    // WHEN created_at <= '2024-12-31' AND created_at >= '2024-12-01' THEN 1
    // ELSE NULL
    // END)) as 'december', 
    // (count(CASE
    // WHEN created_at <= '2024-11-30' AND created_at >= '2024-11-01' THEN 1
    // ELSE NULL
    // END)) as 'november',
    // (count(CASE
    // WHEN created_at <= '2024-10-31' AND created_at >= '2024-10-01' THEN 1
    // ELSE NULL
    // END)) as 'october', 
    // (count(CASE
    // WHEN created_at <= '2024-09-30' AND created_at >= '2024-09-01' THEN 1
    // ELSE NULL
    // END)) as 'september', 
    // (count(CASE
    // WHEN created_at <= '2024-08-31' AND created_at >= '2024-08-01' THEN 1
    // ELSE NULL
    // END)) as 'august', 
    // (count(CASE
    // WHEN created_at <= '2024-07-31' AND created_at >= '2024-07-01' THEN 1
    // ELSE NULL
    // END)) as 'july', 
    // (count(CASE
    // WHEN created_at <= '2024-06-30' AND created_at >= '2024-06-01' THEN 1
    // ELSE NULL
    // END)) as 'june', 
    // (count(CASE
    // WHEN created_at <= '2024-05-31' AND created_at >= '2024-05-01' THEN 1
    // ELSE NULL
    // END)) as 'may', 
    // (count(CASE
    // WHEN created_at <= '2024-05-31' AND created_at >= '2024-04-01' THEN 1
    // ELSE NULL
    // END)) as 'april', 
    // (count(CASE
    // WHEN created_at <= '2024-03-31' AND created_at >= '2024-03-01' THEN 1
    // ELSE NULL
    // END)) as 'march', 
    // (count(CASE
    // WHEN created_at <= '2024-02-29' AND created_at >= '2024-02-01' THEN 1
    // ELSE NULL
    // END)) as 'february', 
    // (count(CASE
    // WHEN created_at <= '2024-01-31' AND created_at >= '2024-01-01' THEN 1
    // ELSE NULL
    // END)) as 'january')->get();
    // $query21 =  DB::table('orders')->select('avg()')->get();
}
