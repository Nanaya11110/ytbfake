@extends('layout.master')
@section('title', 'Channel')
@section('content')

@if(session()->has('error'))
  <div class=" m-10 bg-red-400">
      {{ session()->get('error') }}
  </div>
@endif
@if(session('success'))
    <p class="bg-green-500">{{ session('success') }}</p>
@endif

<!--1ST SECTION-->
<div class=" w-full flex my-5">
    <!--CHANNEL AVATAR-->
    <div class=" w-1/3  h-60 flex justify-center items-center"><img class="rounded-full object-cover w-1/2 h-full" src="{{$user->Avatar}}"></div>
    <!--CHANNEL PROB-->
    <div class=" w-2/3  h-60 mx-5 ">
    <p class="text-5xl text-white">{{$user->fullname}}</p>
    <p class=" my-2 text-gray-500">{{$sub}} Subscriber</p>
    @if ($sub == 1)
    <form action="{{route('unSub',['id'=>$user->id])}}" method="GET">
        @csrf
        <button class=" w-24 h-12 bg-slate-50 rounded-full text-center"><p>Subscribed</p></button>
    </form>
    @else
    <form action="{{route('subscribe',['id'=>$user->id])}}" method="GET">
        @csrf
        <button class=" w-24 h-12 bg-slate-50 rounded-full text-center"><p>Subscribe</p></button>
    </form>
    @endif
    </div>
</div>

<!--2ND SECTION-->
<hr>
<div class=" w-full my-3 grid grid-cols-3 gap-1">
    @foreach ($video as $video )
    <a href="{{route('Detail',$video->FullName)}}">
    <div class=" w-full  h-72 ">
        <div class=" w-4/5w-full h-4/5">
            <img src="/{{$video->Url}}" class="w-full h-full object-cover rounded-xl">
        </div>
        <div class=" text-white mx-5">
        <p class="my-2 text-xl">{{$video->FullName}}</p>
        <span>{{$video->Times}}</span> <span>{{$video->View}} View</span></div>
    </div></a>
    @endforeach
</div>
@stop

