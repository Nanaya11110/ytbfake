@extends('layout.master')
@section('title', 'Home')
@section('content')

@if(session()->has('error'))
  <div class=" m-10 bg-red-400">
      {{ session()->get('error') }}
  </div>
@endif
@if(session('success'))
    <p class="bg-green-500">{{ session('success') }}</p>
@endif
<div class="flex w-full">
@include('layout.particals.aside')
<!--CONTENT-->
<div class="w-full min-h-2 grid grid-cols-3 gap-9">
    @foreach ($video as $item)
    <!--COMPOMENT 1-->
    <div class=" h-72 ml-5 mt-2">
        <!--IMAGES-->
        <a class=" no-underline" href="{{route('Detail',['id'=>$item['Fullname']])}}">
        <div class=" w-full h-3/5 bg-cover bg-center rounded-3xl" style="background-image: url({{$item['Url']}})"></div></a>
        <!--CONTENT-->
        <div class=" flex justify-normal">
          
            <!--AVATAR-->
            <div class=" w-1/4  min-h-2 flex justify-center items-center">
                <div class=" w-1/2 h-1/2 rounded-full bg-cover bg-center" style="background-image: url({{$item['Avatar']}})"></div>
            </div>

            <!--PROB-->
            <div class="pl-1 w-3/4 min-h-2">
                <p class=" text-white text-2xl w-full break-words">{{$item['Fullname']}}</p>
                <p class="text-gray-500">{{$item['User_name']}}</p>
                <span class=" text-gray-500">{{$item['View']}} view</span>
                <span  class=" text-gray-500 inline-block pl-5">{{$item['Times']}}</span>
            </div>
        </div>
 
    </div>

    @endforeach
</div>
</div>
</div>

@stop
