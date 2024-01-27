@extends('admin.layout.master')

@section('title', 'Product list')

@section('content')
    {{-- main content --}}
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <a href="{{route('admin#orderList')}}" class="text-dark fw-bolder"><i class="fa-solid fa-caret-left "></i> Back</a>
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Product Order List</h2>
                            </div>
                            <h5 class="text-danger mt-2"><i class="fa-solid fa-triangle-exclamation me-2"></i>Include 2000 MMK delivery fees in total price</h5>
                        </div>
                    </div>

                    <div class="row text-center">
                        <div class="col">User Name | {{ strtoupper($orderList[0]->name)}}</div>
                        <div class="col">Order Code | {{$orderList[0]->order_code}}</div>
                        <div class="col">Total Price | {{$order->total_price}} MMK</div>
                    </div>

                    {{-- order table  --}}

                    <div class="table-responsive table-responsive-data2 mt-2">
                        <table class="table table-data2 text-center">
                            <thead class="bg-dark ">
                                <tr>
                                    <th class="text-white">Product Image</th>
                                    <th class="text-white">Product Name</th>
                                    <th class="text-white">Quantity</th>
                                    <th class="text-white">Amount </th>
                                    <th class="text-white">Order Date</th>
                                </tr>
                            </thead>
                            <tbody id="dataList">
                                @foreach ($orderList as $o)
                                    <tr class="tr-shadow ">
                                        <td class="col-2"><img src="{{asset('storage/'.$o->product_image)}}" class="img-thumbnail"></td>
                                        <td>{{ $o->product_name }}</td>
                                        <td>{{ $o->qty}}</td>
                                        <td class="amount">{{ $o->total }} MMK</td>
                                        <td>{{ $o->created_at->format('j-m-Y') }}</td>
                                    </tr>
                                    <tr class="spacer"></tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


