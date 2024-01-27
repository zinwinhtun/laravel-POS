@extends('admin.layout.master')
@section('title', 'Contact list')
@section('content')
     {{-- main content --}}
     <div class="main-content ">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Contact List</h2>
                            </div>
                        </div>
                    </div>

                    {{-- Contact table  --}}

                    <div class="table-responsive table-responsive-data2 mt-2">
                        <p class="mb-3"><i>total contact - {{$contact->total()}}</i></p>
                        <table class="table table-data2 ">
                            <thead class="bg-dark ">
                                <tr>
                                    <th class="text-white">User Name</th>
                                    <th class="text-white">E-Mail</th>
                                    <th class="text-white col-4">Message</th>
                                    <th class="text-white">Time</th>
                                </tr>
                            </thead>
                            <tbody id="dataList">
                                @foreach ($contact as $c)

                                        <tr class="tr-shadow ">
                                            <td>{{ $c->name }}</td>
                                            <td>{{$c->email}}</td>
                                            <td>{{$c->message}}</td>
                                            <td>{{$c->created_at->format('j-m-Y')}}</td>
                                        </tr>
                                        <tr class="spacer"></tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-3">
                            {{$contact->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

