@extends('restaurant.chui.master')
@section('title', 'Menu Inventory | '.$seo->meta_title)
@section('content')



<div class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Menu Inventory</h4>
                        </div>
                        <span class="float-right mr-2">
                            <a data-toggle="modal" data-target="#billing" data-whatever="@mdo" class="btn btn-sm bg-primary">
                                <i class="ri-add-fill"><span class="pl-1">Add Bill of Materials</span></i>
                            </a>
                        </span>
                    </div>
                    <div class="card-body">

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">SL</th>
                                    <th scope="col">Finished Goods</th>
                                    <th class="text-center" scope="col">Edit Configartation</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="bg-light">
                                    <th scope="row">1</th>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <th>Row Materials</th>
                                    <th class="text-right">Quantity</th>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Beer</td>
                                    <td class="text-right">1 Ltr</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>



<div class="modal fade" id="billing" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Bill of Material</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-0">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card pl-5 pr-5 m-0 border">
                            <form>
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Finished Goods:</label>
                                    <select class="form-control form-control-sm" id="exampleFormControlSelect1">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Raw Material:</label>
                                    <select class="form-control form-control-sm" id="exampleFormControlSelect1">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Unit:</label>
                                    <select class="form-control form-control-sm" id="exampleFormControlSelect1">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Qty:</label>
                                    <input type="number" class="form-control form-control-sm" id="recipient-name">
                                </div>
                                <div class="form-group text-center p-2">
                                    <button type="button" class="btn btn-sm btn-primary mr-auto">Add To Grid</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div id="billing_materails">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">SL</th>
                                    <th scope="col">Item Name</th>
                                    <th scope="col">Unite Name</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                    <td>@mdo</td>
                                </tr>
                               
                            </tbody>
                        </table>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>


@endsection