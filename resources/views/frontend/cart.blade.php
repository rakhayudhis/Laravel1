@extends('layouts.front')

@section('title')
    Keranjang Saya
@endsection

@section('content')

<div class="py-3 mb-4 shadow-sm bg-warning border-top">
    <div class="container">
        <h6 class="mb-0">
            <a href="{{url('/')}}">
                Home
            </a> /
            <a href="{{url('cart')}}">
                Cart
            </a> 
              
        </h6>
    </div>
</div>

<div class="container my-5">
    <div class="card shadow ">
        @if ($cartitems->count() > 0)   
            <div class="card-body">
                @php $total = 0;    @endphp
                @foreach ($cartitems as $item)
                    <div class="row product_data">
                        <div class="col-md-2 my-auto">
                            <img src="{{ asset('assets/uploads/products/'.$item->products->image)}}" height="70px" width="70px" alt="">
                        </div>
                        <div class="col-md-3 my-auto">
                            <h5>{{$item->products->name}}</h5>
                        </div>
                        <div class="col-md-2 my-auto">
                            <h5> Rp {{$item->products->selling_price}}</h5>
                        </div>
                        <div class="col-md-2 my-auto">
                            <input type="hidden" value="{{$item->prod_id}}" class="prod_id">
                            @if ($item->products->qty >= $item->prod_qty)
                                <label for="Quantity">Quantity</label>
                                <div class="input-group text-center mb-3" style="130px;">
                                    <button class="input-group-text changeQuantity decrement-btn">-</button>
                                    <input type="text" name="quantity "  class="form-control qty-input text-center" value="{{$item->prod_qty}}"/>
                                    <button class="input-group-text changeQuantity increment-btn">+</button>
                                </div>
                                @php $total += $item->products->selling_price * $item->prod_qty ;    @endphp
                            @else
                                <h5>Stok Habis</h5>
                            @endif
                            
                        </div>
                        <div class="col-md-3 my-auto">
                            <button class="btn btn-danger delete-cart-item"> <i class="fa fa-trash"></i> Delete</button>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="card-footer">
                <h5> Total Harga :{{$total}}
                    <a href="{{url('checkout')}}" class="btn btn-outline-success float-end">Checkout</a href="{{url('checkout')}}">
                </h5>    
            </div>
        @else
            <div class="card-body text-center">
                <h2>Your <i class="fa fa-shopping-cart"> Keranjang Kosong</i></h2>
                <a href="{{url('category')}}" class="btn btn-outline-primary float-end">Lanjut Belanja</a>
            </div>
        @endif
    </div>
</div>

@endsection

