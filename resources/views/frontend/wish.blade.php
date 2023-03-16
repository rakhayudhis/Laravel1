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
            <a href="{{url('wishlist')}}">
                Wishlist
            </a> 
              
        </h6>
    </div>
</div>

<div class="container my-5">
    <div class="card shadow ">
        <div class="card-body">
            @if($wishlist->count()>0)
                @foreach ($wishlist as $item)
                    <div class="row product_data">
                        <div class="col-md-2 my-auto">
                            <img src="{{ asset('assets/uploads/products/'.$item->products->image)}}" height="70px" width="70px" alt="">
                        </div>
                        <div class="col-md-2 my-auto">
                            <h5>{{$item->products->name}}</h5>
                        </div>
                        <div class="col-md-2 my-auto">
                            {{-- <h5>  {{$item->products->small_description}}</h5> --}}
                        </div>
                        <div class="col-md-2 my-auto">
                            <input type="hidden" value="{{$item->prod_id}}" class="prod_id">
                            @if ($item->products->qty >= $item->prod_qty)
                                <label for="Quantity">Quantity</label>
                                <div class="input-group text-center mb-3" style="130px;">
                                    <button class="input-group-text  decrement-btn">-</button>
                                    <input type="text" name="quantity "  class="form-control qty-input text-center" value="1"/>
                                    <button class="input-group-text  increment-btn">+</button>
                                </div>
                            @else
                                <h5>Stok Habis</h5>
                            @endif
                            
                        </div>
                        <div class="col-md-2 my-auto">
                            <button class="btn btn-success addToCartBtn "> <i class="fa fa-shopping-cart"></i> Add To Cart</button>
                        </div>
                        <div class="col-md-2 my-auto">
                            <button class="btn btn-danger remove-wishlist-item "> <i class="fa fa-trash"></i> Delete</button>
                        </div>
                    </div>
                @endforeach
            @else
                <h4>There are no product in your Wishlist</h4>
            @endif
        </div>
    </div>
</div>

@endsection

