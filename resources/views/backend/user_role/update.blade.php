@extends('layouts.admin')
@section('title', 'All User-Role| '.$seo->meta_title)
@section('content')

<div class="content-page">
      <div class="container-fluid">
         <div class="row">
            <div class="col-sm-12">
            <div class="card">
                     <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                           <h4 class="card-title">Admin</h4>
                        </div>
                     </div>
                     <div class="card-body">
                        <div class="custom-control custom-checkbox custom-checkbox-color-check custom-control-inline">
                           <input type="checkbox" class="custom-control-input bg-primary" id="customCheck-1" checked="">
                           <label class="custom-control-label" for="customCheck-1"> Primary</label>
                        </div>
                        <div class="custom-control custom-checkbox custom-checkbox-color-check custom-control-inline">
                           <input type="checkbox" class="custom-control-input bg-success" id="customCheck-2" checked="">
                           <label class="custom-control-label" for="customCheck-2">Success</label>
                        </div>
                        <div class="custom-control custom-checkbox custom-checkbox-color-check custom-control-inline">
                           <input type="checkbox" class="custom-control-input bg-danger" id="customCheck-3" checked="">
                           <label class="custom-control-label" for="customCheck-3">Danger</label>
                        </div>
                        <div class="custom-control custom-checkbox custom-checkbox-color-check custom-control-inline">
                           <input type="checkbox" class="custom-control-input bg-warning" id="customCheck-4" checked="">
                           <label class="custom-control-label" for="customCheck-4">Warning</label>
                        </div>
                        <div class="custom-control custom-checkbox custom-checkbox-color-check custom-control-inline">
                           <input type="checkbox" class="custom-control-input bg-dark" id="customCheck-5" checked="">
                           <label class="custom-control-label" for="customCheck-5">Dark</label>
                        </div>
                        <div class="custom-control custom-checkbox custom-checkbox-color-check custom-control-inline">
                           <input type="checkbox" class="custom-control-input bg-info" id="customCheck-6" checked="">
                           <label class="custom-control-label" for="customCheck-6">Info</label>
                        </div>
                     </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
@ensection