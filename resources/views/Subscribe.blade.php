@extends('layout.master')
@section('title', 'Subscribe Channel')
@section('content')

<div>@if ($errors->any())
    <div class=" w-full bg-red-500">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
</div>
<div class="flex w-full">
@include('layout.particals.aside')
<!--CONTENT-->
<div class="w-full min-h-2 ">
    <!--CONTAINER-->
    @if (isset($sub))
    @foreach ($sub as $item)
    <div class=" w-full h-36  flex my-5">
        <!--IMAGE-->
        <div class="w-1/5 h-full overflow-hidden flex mx-5">
            <a class="" href="{{route('Channel',['id'=>$item['sub_id']])}}"> 
            <img class=" w-2/3 h-full rounded-full object-cover " src="{{$item['Avatar']}}" alt=""></a>
        </div>
        <!--CONTENT-->
        <div class="w-1/2 h-full  text-white ">
            <p class="text-white text-2xl">{{$item['sub_name']}}</p>
            <p class="inline text-gray-300"></p>{{$item['sub_amount']}}<span class="ml-1 mr-5 text-gray-300">Subscribe</span>
            <p class="inline text-gray-300"></p>{{$item['video']}}<span class="ml-1 text-gray-300">Video</span>
            <br>
            <a href="#"><p></p></a>
        </div>
    </div>
    @endforeach
    @else
    <div class="w-full h-full text-white flex justify-center items-center"> There are no Sub Channel</div>
    @endif
   
    
</div>
@stop
