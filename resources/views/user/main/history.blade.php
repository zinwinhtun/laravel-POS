@extends('user.layout.master')

@section('content')
    <!-- Cart Start -->
    <div class="container-fluid" >
        <div class="row px-xl-5" style="height: 450px">
            <div class="col-lg-8 offset-2 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0" id="dataTable" >
                    <thead class="thead-dark">
                        <tr>
                            <th>Date</th>
                            <th>Order Code</th>
                            <th>Price</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($order as $o)
                            <tr>
                                <td class="align-middle fw-bold">{{ $o->created_at->format('j . m . Y') }}</td>
                                <td class="align-middle">{{ $o->order_code }}</td>
                                <td class="align-middle">{{ $o->total_price }}</td>
                                <td class="align-middle">
                                    @if ( $o->status == 0)
                                        <span class="text-warning"><i class="fa-solid fa-hourglass-half me-1"></i>Waiting...</span>
                                    @elseif ( $o->status == 1)
                                        <span class="text-success"><i class="fa-solid fa-check me-1"></i>Success...</span>
                                    @elseif ( $o->status == 2)
                                        <span class="text-danger"><i class="fa-solid fa-xmark me-1"></i>Reject...</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-3">
                    {{$order->links()}}
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection
