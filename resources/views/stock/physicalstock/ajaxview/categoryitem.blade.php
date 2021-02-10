<div class="row">
@if($allcategoryitem->count() > 0)
    @foreach($allcategoryitem as $key => $cateitem)
    <div class="col-md-12">
        <div class="custom-control custom-checkbox custom-checkbox-color-check custom-control-inline">
            <input type="checkbox" class="custom-control-input bg-success" id="customCheck-{{$key}}" name="cate_item" value="{{$cateitem->id}}">
            <label class="custom-control-label" for="customCheck-{{$key}}"> {{$cateitem->item_name}}</label>
        </div>
    </div>
    @endforeach
 
@else
    <p>No Item In This Category</p>
@endif
</div>