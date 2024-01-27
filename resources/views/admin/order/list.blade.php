@extends('admin.layout.master')

@section('title', 'Order list')

@section('content')
    {{-- main content --}}
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Order List</h2>
                            </div>

                        </div>
                    </div>
                    {{-- search key  --}}
                    <div class="row mb-4">
                        <div class="col-4">
                            <form action="{{ route('admin#changeStatus') }}" method="GET">
                                @csrf
                                <div class="input-group">
                                    {{-- <span class="me-2">Find Order Status</span> --}}
                                    <button type="submit" class="btn btn-success bg-success text-white input-group-text"><i
                                        class="fa-solid fa-magnifying-glass me-2"></i>Search Status</button>
                                    <select name="orderStatus" class="d-flex form-control " id="orderStatus" >
                                        <option value="all">All</option>
                                        <option value="0" @if (request('orderStatus') == '0') selected @endif
                                            class="text-warning">Pending</option>
                                        <option value="1" @if (request('orderStatus') == '1') selected @endif
                                            class="text-success">Accept</option>
                                        <option value="2" @if (request('orderStatus') == '2') selected @endif
                                            class="text-danger">Reject</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                        <div class="col-3">
                            <h4 class="text-muted">Total Order<i class="fa-solid fa-caret-right ms-1"></i>
                                {{ count($order) }} </h4>
                        </div>
                        <div class="col-5">
                            <form action=" {{ route('admin#orderList') }} " method="GET">
                                @csrf
                                <div class="d-flex">
                                    <input type="text" name="key" class="form-control"
                                        placeholder="Find order code..." value="{{ request('key') }}">
                                    <button type="submit" class="btn btn-success "><i
                                            class="fa-solid fa-magnifying-glass me-2"></i>Search</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    {{-- order table  --}}

                    <div class="table-responsive table-responsive-data2 mt-2">
                        <table class="table table-data2 text-center">
                            <thead class="bg-dark ">
                                <tr>
                                    <th class="text-white">Order Code</th>
                                    <th class="text-white">User Name</th>
                                    <th class="text-white">User ID</th>
                                    <th class="text-white">Amount </th>
                                    <th class="text-white">Order Date</th>
                                    <th class="text-white">Status</th>
                                </tr>
                            </thead>
                            <tbody id="dataList">
                                @foreach ($order as $o)
                                    <tr class="tr-shadow ">
                                        <input type="hidden" class="orderId" value="{{ $o->id }}">
                                        <td>
                                            <a href="{{route('admin#listInfo',$o->order_code)}}" class="fw-bold text-primary">{{ $o->order_code }}</a>
                                        </td>
                                        <td>{{ $o->user_name }}</td>
                                        <td>{{ $o->user_id }}</td>
                                        <td class="amount">{{ $o->total_price }} MMK</td>
                                        <td>{{ $o->created_at->format('j-m-Y') }}</td>
                                        <td>
                                            <select name="select" id="" class="form-control statusChange">
                                                <option value="0" @if ($o->status == 0) selected @endif>
                                                    Pending</option>
                                                <option value="1" @if ($o->status == 1) selected @endif>
                                                    Accept</option>
                                                <option value="2" @if ($o->status == 2) selected @endif>
                                                    Reject</option>
                                            </select>
                                        </td>
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

{{-- js function  --}}
@section('scriptSection')

    <script>
        $(document).ready(function() {
            //change status
            $('.statusChange').change(function() {
                $currentStatus = $(this).val();
                $parentNode = $(this).parents("tr");
                $orderId = $parentNode.find(".orderId").val();

                $data = {
                    'status': $currentStatus,
                    'orderId': $orderId
                }
                $.ajax({
                    type: 'get',
                    url: '/order/ajax/status/change',
                    data: $data,
                    dataType: 'json',
                }); //ajax end

            })
        });
    </script>

@endsection
