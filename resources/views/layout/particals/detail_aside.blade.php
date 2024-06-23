<aside class=" lg:w-2/5 md:w-full float-right mr-5 bg-slate-900">
    <!--CONTAINER-->
    @foreach ($aside_video as  $item)
    <a href="{{route('Detail',['id'=>$item->FullName])}}" class=" w-full flex mt-2 hover:scale-105 transition-all duration-150">
        <!--IMAGE-->
        <div class=" w-3/4 flex justify-center items-center">
            <img src="/{{$item->Url}}" class=" w-4/5 h-4/5 bg-cover rounded-2xl">
        </div>
        <!--CONTENT-->
        <div class=" w-4/6 h-40  ml-2 pt-5">
            <h1 class=" text-xl break-words text-white">{{$item->FullName}}</h1>
            <div class=" text-gray-500">
                <p></p>
                <span class="mr-5">{{$item->View}} View</span>
                <span>{{$item->Times}}</span>
            </div>
        </div>
    </a>
    @endforeach
    
    
</aside>