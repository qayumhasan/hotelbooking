@extends('hotelbooking.master')
@section('title', 'Checking | '.$seo->meta_title)

@section('content')
<div class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Voucher</h4>
                        </div>


                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 col-lg-12">

                <div class="card">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="modal-footer">
                                <span class="btn btn-secondary mr-auto">Voucher No: MA/505</span>

                                <button type="button" class="btn btn-primary">
                                    <input type="date" class="form-control" value="01/01/2021" />
                                </button>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="bg-light">
                                <div class="row p-4">
                                    <div class="col-sm-1">
                                        <span>Dr/Cr:</span>
                                    </div>
                                    <div class="col-sm-2">
                                        <span>Particulars:</span>
                                    </div>
                                    <div class="col-sm-2"></div>
                                    <div class="col-sm-3 text-center">
                                        Debit(KHS)
                                    </div>
                                    <div class="col-sm-3 text-center">
                                        Credit(KHS)
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="row p-4">
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <select class="form-control" id="exampleFormControlSelect1">
                                            <option>Dr.</option>
                                            <option>Cr.</option>
                                        </select>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <select class="form-control" id="exampleFormControlSelect1">
                                            <option>Dr.</option>
                                            <option>Cr.</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="form-group">

                                        <select class="form-control" id="exampleFormControlSelect1">
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                        </select>
                                    </div>
                                    <br>

                                    <div class="form-group">

                                        <select class="form-control" id="exampleFormControlSelect1">
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="row p-4">
                                <div class="col-sm-6">
                                    <div class="form-group">

                                        <input type="text" class="form-control" id="exampleFormControlInput1">
                                    </div>
                                    <br>
                                    <div class="form-group">

                                        <input type="text" class="form-control" id="exampleFormControlInput1">
                                    </div>

                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">

                                        <input type="text" class="form-control" id="exampleFormControlInput1">
                                    </div>
                                    <br>
                                    <div class="form-group">

                                        <input type="text" class="form-control" id="exampleFormControlInput1">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row p-4">
                        <div class="col-sm-8">
                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Narration :</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="staticEmail">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection