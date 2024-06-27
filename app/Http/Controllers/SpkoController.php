<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Product;
use App\Models\Spko;
use App\Models\SpkoItem;
use Illuminate\Http\Request;

class SpkoController extends Controller
{
    function index ()
    {

        $spkos = Spko::all();

        return view('home', [
            'title' => 'Home',
            'spkos' => $spkos
        ]);
    }

    function createGet() 
    {

        $employees = Employee::all();
        $products = Product::all();
        $process = [
            'Cor',
            'Brush',
            'Bombing',
            'Slep',
        ];

        return view('create', [
            'title' => 'create',
            'employees' => $employees,
            'products' => $products,
            'process' => $process
        ]);
    }

    function createPost(Request $request)
    {
        $sw = "SPKO" . date('ym');

        $last_digit_spko = Spko::select('sw')
        ->where('sw', 'LIKE', "%$sw%")
        ->orderBy('created_at', 'desc')
        ->limit(1)->get()->first();

        if($last_digit_spko == null){
            $sw = $sw . "001";
            $spko = Spko::create([
                'remarks' => $request->remarks,
                'employee' => $request->id_employee,
                'trans_date' => date('Y-m-d'),
                'process' => $request->process,
                'sw' => $sw
            ]);
        } else {
            $digit = (int)substr($last_digit_spko['sw'], 8);
            $digit++;

            if ($digit < 10) {
                $sw = $sw .  '00' . $digit;
            } elseif ($digit < 100) {
                $sw = $sw .  '0' . $digit;
            } else {
                $sw = $sw .  (string)$digit;
            }

            $spko = Spko::create([
                'remarks' => $request->remarks,
                'employee' => $request->id_employee,
                'trans_date' => date('Y-m-d'),
                'process' => $request->process,
                'sw' => $sw
            ]);

        }

        $products = json_decode($request->products);
        
        foreach ($products as $key => $product) {

            SpkoItem::create([
                'idm' => $spko->id_spko,
                'ordinal' => $key + 1,
                'id_product' => $product->id,
                'qty' => $product->qty
            ]);
        }
        
        return redirect("/");
    }

    function updateGet(String $id) 
    {
        $spko = Spko::find($id);
        $spko_items = SpkoItem::where('idm', $spko->id_spko)->get();

        $product_selected = [];

        foreach ($spko_items as $item) 
        {
            $product = $item->product;
            $product->qty = $item->qty;
            array_push($product_selected, $product);
        }
     
        $employees = Employee::all();
        $products = Product::all();
        $process = [
            'Cor',
            'Brush',
            'Bombing',
            'Slep',
        ];

        return view('update', [
            'title' => 'update',
            'spko' => $spko,
            'spko_items' => $spko_items,
            'employees' => $employees,
            'products' => $products,
            'process' => $process,
            'product_selected' => $product_selected,
        ]);
    }

    function updatePost(Request $request, String $id)
    {
        $spko = Spko::find($id);

        $spko->update([
            'remarks' => $request->remarks,
            'employee' => $request->id_employee,
            'trans_date' => $request->trans_date,
            'process' => $request->process,
        ]);

        SpkoItem::where('idm', $spko->id_spko)->delete();

        $products = json_decode($request->products);
        
        foreach ($products as $key => $product) {

            SpkoItem::create([
                'idm' => $spko->id_spko,
                'ordinal' => $key + 1,
                'id_product' => $product->id,
                'qty' => $product->qty
            ]);
        }

        return redirect("/");
    }

    function print(String $id) 
    {
        $spko = Spko::find($id);
        $spko_items = SpkoItem::where('idm', $spko->id_spko)->get();

        $spko_items = $spko_items->map(function ($item) {
            $item->sku = $item->product->sub_category . "." . $item->product->serial_no . "." . $item->product->carat;
            return $item;
        });
        return view('print', [
            'title' => $spko->description,
            'spko' => $spko,
            'spko_items' => $spko_items,
        ]);
    }
}
