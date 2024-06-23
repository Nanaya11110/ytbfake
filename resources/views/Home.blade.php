@extends('layout.master')
@section('title', 'Home')
@section('content')

@if(session()->has('error'))
  <div class=" m-10 bg-red-400">
      {{ session()->get('error') }}
  </div>
@endif
@if(session('success'))
    <div class=" alert alert-success text-center">{{session()->get('success')}}</div>
@endif
<div class="flex lg:flex-row md:flex-col sm:flex-col w-full">
@include('layout.particals.aside')
<!--CONTENT-->
<div class="w-full min-h-2 grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2">
    @foreach ($video as $item)
    <!--COMPOMENT 1-->
    <div class=" lg:w-80 md:w-80 sm:w-4/5 h-72 hover:scale-105 transition-all duration-100 m-2 ml-5  ">
        <!--IMAGES-->
        <a class=" no-underline" href="{{route('Detail',['id'=>$item['Fullname']])}}">
        <div class=" mt-5 w-full h-3/5 bg-cover bg-center rounded-3xl" style="background-image: url({{$item['Url']}})"></div></a>
        <!--CONTENT-->
        <div class=" flex justify-normal mt-5">
          
            <!--AVATAR-->
            <div class=" w-1/4  min-h-2 flex justify-center items-center">
                <div class=" lg:w-2/3 lg:h-2/3 sm:w-20 sm:h-20 rounded-full bg-cover bg-center" style="background-image: url({{$item['Avatar']}})"></div>
            </div>

            <!--PROB-->
            <div class="pl-1 w-3/4 min-h-2">
                <p class=" text-white text-2xl w-full break-words">{{$item['Fullname']}}</p>
                <p class="hover:text-white transition-all duration-150 text-gray-500">{{$item['User_name']}}</p>
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
