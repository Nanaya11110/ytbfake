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
<div class="flex w-full">
@include('layout.particals.aside')
<!--CONTENT-->

<div class="w-full min-h-2  flex">
   <div class="w-full">
    <div class="w-full ">
        @foreach ($video as $item)
        <!--COMPOMENT 1-->
        <div class=" w-11/12 h-72  ml-3 mt-2 inline-block ">
            <!--CONTAINER-->
            <div class="w-full h-full flex">
                <!--IMAGE-->
                <div class="w-1/2 h-full overflow-hidden flex justify-center mr-5">
                    <a class="no-underline ml-16" href="{{route('Detail',['id'=>$item['Fullname']])}}"> 
                        <img class=" w-full h-full object-cover rounded-xl" src="{{ $item['Url'] }}" alt="{{$item['Fullname']}}}"></a>
                </div>
                <!--CONTENT-->
                <div class="w-1/2 h-full ">
                    <p class="text-white text-2xl">{{$item['Fullname']}}</p>
                    <p class="inline text-gray-300">{{$item['View']}}K View</p><span class="ml-5 text-gray-300">{{$item['Times']}}h</span>
                    <br>
                    <a href="#"><img src="{{$item['Avatar']}}" class="w-10 h-10 mt-3 rounded-full object-cover inline"> </a>
                    <span class="text-gray-300"></span>
                    <div class=" pl-2 text-white mt-5 p-2">{{\Illuminate\Support\Str::limit($item['Des'], 100)}}</div>
                </div>
            </div>
        </div>
        @endforeach
    
    </div>



   </div>
</div>
@stop
