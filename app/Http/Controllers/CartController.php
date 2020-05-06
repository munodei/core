<?php

namespace App\Http\Controllers;

use App\ShoppingCart;
use App\ShoppingCartItem;
use App\ShoppingItem;
use App\Product;
use App\Item;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct(){

      $this->middleware('auth');

    }

    public function index(Request $request)
    {

        $id         = $request->user()->id;
        $page_title = 'Shopping Cart';

        return view('custom.cart.index',compact('page_title'));


    }

    public function clear(Request $request)
    {
      $cart    = ShoppingCart::where([['status',1],['user_id',$request->user()->id]])->first();
      Item::where([['user_id',$request->user()->id],['cart_id',$cart->id]])->delete();
      return redirect()->back()->with('success','Cart successfully cleared!');
    }

    public function itemClear(Request $request,$id)
    {
      $cart    = ShoppingCart::where([['status',1],['user_id',$request->user()->id]])->first();

      if(Item::where([['id',$id],['cart_id',$cart->id]])->exists()){
          Item::where([['id',$id],['cart_id',$cart->id]])->delete();
          return redirect()->back()->with('success','Item removed Out of Cart!');
      }
      return redirect()->back()->with('error','Error occured!');
    }
    public function create(Request $request)
    {
      $request->validate(['id'=>'required'],['id.required'=>'The Shopping Item is required']);
      extract($_POST);
      $user_id = $request->user()->id;
      $cart    = ShoppingCart::where([['status',1],['user_id',$user_id]])->first();


      if($shopping_item==='1')
      $item = ShoppingItem::find($id);
      else
      $item = Product::find($id);

      Item::create([
                    'cart_id'=>$cart->id,
                    'user_id'=>$request->user()->id,
                    'item_name'=>$item->shopping_item_name ?? $item->product_name ?? '',
                    'item_description'=>$item->shopping_item_description ?? $item->product_description ?? '',
                    'item_outlets'=>$item->shopping_item_outlets ?? $item->product_outlets  ?? '',
                    'item_quantity'=>$item_quantity,
                    'item_price'=>$item->shopping_item_price ?? $item->product_price  ?? '',
                    'item_brand'=>$item->shopping_item_brand ?? $item->product_brand ?? '',
                    'slug'=>$item->slug ?? $item->slug ?? '',
                    'photo'=>$item->photo ?? $item->photo ?? '',
      ]);

      return redirect()->back()->with('success','You have successfully added item to cart!');
    }

    public function store(Request $request)
    {
        $request->validate(['id'=>'required'],['id.required'=>'The Shopping Item is required']);
        extract($_POST);
        $user_id = $request->user()->id;
        $cart    = ShoppingCart::where([['status',1],['user_id',$user_id]])->first();


        if($shopping_item==='1')
        $item = ShoppingItem::find($id);
        else
        $item = Product::find($id);

        Item::create([
                      'cart_id'=>$cart->id,
                      'user_id'=>$request->user()->id,
                      'item_name'=>$item->shopping_item_name ?? $item->product_name ?? '',
                      'item_description'=>$item->shopping_item_description ?? $item->product_description ?? '',
                      'item_outlets'=>$item->shopping_item_outlets ?? $item->product_outlets  ?? '',
                      'item_quantity'=>$item_quantity,
                      'item_price'=>$item->shopping_item_price ?? $item->product_price  ?? '',
                      'item_brand'=>$item->shopping_item_brand ?? $item->product_brand ?? '',
                      'slug'=>$item->slug ?? $item->slug ?? '',
                      'photo'=>$item->photo ?? $item->photo ?? '',
        ]);

        return redirect()->route('cart.index');

    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
