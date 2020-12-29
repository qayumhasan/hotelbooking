<style>
  

    .img_fotter .pagination {
        display: flex;
        width: 100%;
        align-items: center;
        justify-content: center;
    }

    .img_fotter .pagination .pagination-item {
        text-decoration: none;
        position: relative;
        margin: 0 10px;
        width: 45px;
        height: 45px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.3), inset 0 -5px 0px rgba(80, 80, 80, 0.1), inset 0 -10px 0px rgba(150, 150, 150, 0.1);
        overflow: hidden;
        color: #093170;
        cursor: pointer;
        transition: 0.3s ease-in-out;
        background-color: #efefef;
    }

    .img_fotter .pagination .pagination-item:before,
    .img_fotter .pagination .pagination-item:after {
        content: "";
        display: flex;
        justify-content: center;
        align-items: center;
        position: absolute;
        width: 100%;
        height: 100%;
        z-index: 11;
        background-image: linear-gradient(135deg, #01579b, #0091ea);
        transform: translateX(-100px);
        transition: 0.3s ease-in-out;
    }

    .img_fotter .pagination .pagination-item:after {
        content: "click";
        color: #fff;
        background-image: linear-gradient(135deg, #093170, #01579b);
        transition-delay: 0.25s;
        transform: translateY(100px);
    }

    .img_fotter .pagination .pagination-item:hover {
        box-shadow: 0 0px 20px rgba(0, 0, 0, 0.4), inset 0 -5px 0px rgba(80, 80, 80, 0), inset 0 -10px 0px rgba(150, 150, 150, 0);
    }

    .img_fotter .pagination .pagination-item:hover:before,
    .img_fotter .pagination .pagination-item:hover:after {
        transform: translateY(0);
    }

    .img_fotter .pagination .pagination-item:active {
        box-shadow: none;
    }

    .img_fotter .pagination .pagination-item.active {
        color: #fff;
        background-image: linear-gradient(135deg, #008094, #18ffff);
    }
</style>
<div class="modal-body">
                        

                    
<div class="row">

    <!-- <div class="img-item" onclick="uploadimg(this)">
                                   <img src="{{asset('public/backend/assets/images/blog/01.jpg')}}" alt="" class="w-100" >
                                   <div class="select_overlay">
                                        
                                    </div>
                               </div> -->

    <ul id="imagemanager">
        @foreach($images as $image)
        <li><input type="checkbox" class="myCheckbox" onclick="uploadimg(this)" id="cb{{$image->id}}" value="{{$image->image}}" />
            <label for="cb{{$image->id}}"><img src="{{asset('public/uploads/imagemanager/')}}/{{$image->image}}" /></label>
        </li>
        @endforeach

    </ul>
    @php
        $total_row = count($paginate);
        $total_page = ceil($total_row / 28)+1;
    @endphp
    <div class="img_fotter m-auto">
    <div class="pagination">
        
        <a href="{{route('admin.media.manager.pagination',1)}}" class="pagination-item ">First</a>
        @for($i = 1; $i < $total_page; $i++)
            <a href="{{route('admin.media.manager.pagination',$i)}}" class="pagination-item active">{{$i}}</a>
        @endfor
        
       
        <a href="{{route('admin.media.manager.pagination',$total_page -1)}}" class="pagination-item ">Last</a>
    </div>
    </div>
    <script>
        $('input[type="checkbox"]').on('change', function() {
            $('input[type="checkbox"]').not(this).prop('checked', false);
        });
    </script>

</div>
</div>