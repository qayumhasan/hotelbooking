@extends('restaurant.chui.master')
@section('title', 'Waiter QTR Reports | '.$seo->meta_title)
@section('content')



<div class="content-page">
    <div class="container-fluid">


        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Waiter Sale Performance Current Qtr</h4>
                        </div>
                    </div>
                    <div class="card-body ">
                        <div class="table-responsive fast_moving_item">
                            <table class="table table-bordered">
                                @if(count($employees) > 0)
                                <thead>
                                @php
                                    $month = [];
                                @endphp
                                    <tr>
                                        <th scope="col">Waiter</th>
                                        @foreach($employees as $key=>$row)
                                        <th scope="col">Total Sale {{$key}}</th>
                                        @php
                                            array_push($month,$key);
                                        @endphp
                                        @endforeach
                                        <th scope="col">Total Qtr.</th>
                                        <th scope="col">% of Total</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($employees as $key=>$row)
                                        @foreach($row as $data)
                                        <tr>
                                        <th scope="row">{{$data->waiter_id}}</th>
                                            
                                            @if($data->month_name == $month[$loop->index])
                                                <th>{{$data->slae_amount}}</th>
                                            @else
                                                <th></th>
                                                <th>{{$data->slae_amount}}</th>
                                            @endif
                                            
                                        </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                                @endif
                            </table>





                        </div>

                    </div>
                </div>
            </div>
        </div>


    </div>
</div>


@endsection