@extends('housekipping.master')
@section('title', 'Order Acquisition | '.$seo->meta_title)
@section('content')
<div class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card printableAreasaveprint">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">All Pending Order</h4>
                        </div>
                        <span class="float-right mr-2">
                            <a href="{{route('admin.acquisition.create')}}" class="btn btn-sm bg-primary">
                                <i class="ri-add-fill"><span class="pl-1">Add Order</span></i>
                            </a>
                        </span>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table data-table table-striped table-bordered">
                                <thead class="text-center">
                                    <tr>

                                        <th>Invoice No</th>
                                        <th>Date</th>
                                        <th>User</th>
                                        <th>Remarks</th>
                                        <th>status</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @foreach($alldata as $key => $data)
                                    <tr class="bg-secondary">

                                        <td>{{$data->invoice_no}}</td>
                                        <td>{{$data->date}}</td>
                                        <td>{{$data->user->username ?? ''}}</td>
                                        <td>{{$data->remarks}}</td>
                                        <td>
                                            @if($data->is_active==1)
                                            <span class=" btn-info btn-sm">Pending</span>
                                            @else
                                            <span class=" btn-danger btn-sm">Close</span>
                                            @endif

                                        </td>

                                    </tr>
                                    @php
                                        $totalqty = 0;
                                    @endphp
                                    @foreach($data->items as $row)
                                    @if($loop->first)
                                    <tr>
                                        <th></th>
                                        
                                        <th class="bg-light">Item</th>
                                        <th class="bg-light">Unit</th>
                                        <th class="bg-light">QTY</th>
                                        <th class="bg-light">Order Balance</th>
                                    </tr>
                                    @endif
                                    <tr>

                                       <td></td>
                                        <td>{{$row->item_name}}</td>
                                        <td>{{$row->qty}}</td>
                                        <td>{{$row->unitname->name ?? ''}}</td>
                                        <td>0.00</td>
                                        @php
                                            $totalqty = $totalqty +$row->qty; 
                                        @endphp
                                    </tr>
                                   
                                    @endforeach
                                    <tr>
                                        <td></td>
                                        <th class="text-primary">Total</th>
                                        <th>{{$totalqty}}</th>
                                        <th></th>
                                        
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row text-center">
            <div class="col-md-12">
                <button type="button" class="btn-sm btn-info savepritbtn">Print</button>
            </div>
        </div>
    </div>
</div>
@endsection