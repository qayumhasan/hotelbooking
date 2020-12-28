<div class="row">

    <!-- <div class="img-item" onclick="uploadimg(this)">
                                   <img src="{{asset('public/backend/assets/images/blog/01.jpg')}}" alt="" class="w-100" >
                                   <div class="select_overlay">
                                        
                                    </div>
                               </div> -->

    <ul id="imagemanager">
        @foreach($images as $image)
        <li><input type="checkbox" onclick="uploadimg(this)" id="cb{{$image->id}}" value="{{$image->id}}" />
            <label for="cb{{$image->id}}"><img src="{{asset('public/uploads/imagemanager/')}}/{{$image->image}}" /></label>
        </li>
        @endforeach
        
    </ul>
    <script>
        $('input[type="checkbox"]').on('change', function() {
            $('input[type="checkbox"]').not(this).prop('checked', false);
        });
    </script>

</div>