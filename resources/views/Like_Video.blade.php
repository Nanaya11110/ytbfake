@extends('layout.master')
@section('title', 'Home')
@section('content')

<div>@if ($errors->any())
    <div class=" w-full bg-red-500">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif</div>
<div class="flex lg:flex-row w-full">
@include('layout.particals.aside')
<!--CONTENT-->
<div class="w-full min-h-2">
    <?php $i=1; ?>
    @if (isset($video))
    @foreach ($video as $item )
    <!--CONTAINER-->
    <div class=" overflow-hidden"><div class=" lg:w-full md:w-full h-36 flex my-5 hover:scale-105 transition-all duration-150 ">
        <!--STT-->
        <div class=" w-1/12 flex items-center justify-center text-white"><p><b><?php echo "$i"?></b></p></div>
        <!--IMAGE-->
        <div class="lg:w-1/5 md:w-3/5 h-full overflow-hidden flex mx-5">
            <a class="" href="{{route('Detail',['id'=>$item['Fullname']])}}"> 
            <img class=" w-full h-full rounded-xl " src="{{ $item['Url'] }}" alt="{{$item['Fullname']}}}"></a>
        </div>
        <!--CONTENT-->
        <div class="w-1/2 h-full  text-white ">
            <p class="text-white text-2xl">{{$item['Fullname']}}</p>
           
            <p class="inline text-gray-300">{{$item['View']}} View</p><span class="ml-5 text-gray-300">{{$item['Times']}}h</span>
            <br>
            
            <a href="{{route('Channel',$item['User_id'])}}"><div class=" flex gap-2">
                <img class=" w-10 h-10 rounded-full object-cover" src="{{$item['Avatar']}}">
                <p>{{$item['User_name']}}</p></div></a>
        </div>
    </div></div>
    <?php $i++?>
    @endforeach
    @else 
    <div class="w-full h-full flex items-center justify-center text-white">There are no Like Video</div>
    @endif  
</div>
</div>
@stop
