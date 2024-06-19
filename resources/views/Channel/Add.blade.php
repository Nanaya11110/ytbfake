
@extends('layout.master')
@section('content')
@section('title','New page')

@if(session()->has('error'))
  <div class=" m-10 bg-red-400">
      {{ session()->get('error') }}
  </div>
@endif
@if(session('success'))
    <p class="bg-green-500">{{ session('success') }}</p>
@endif

<div class=" flex">
@include('layout.particals.aside')
<div  class=" flex flex-col">
<form id="myForm" class="w-fit flex my-5 ml-10" action="{{route('Channel.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class=" w-1/2  flex flex-col justify-center items-center">
        <label for="Name" class=" mr-72 ml-14 mb-2 text-white">Video Title (required)</label>
        <input type="text" id="Name" name="Name" class=" w-3/4 h-14 mb-10 bg-inherit border border-gray-500 text-white">
        <label for="Des" class=" mr-72 ml-12 mb-2 text-white">Video Description</label>
        <textarea class=" w-3/4 h-72 bg-inherit border border-gray-500 text-white" id="Des" name="Des"></textarea>  
    </div>
    <div class=" w-1/2 flex flex-col justify-center items-center">
        <input type="file" class=" hidden" id="Avatar" name="Avatar">
            <p class="text-2xl my-5 text-white">Thumnail:</p>
            <a href="#" id="test" onclick="changeAvatar()" class="w-4/5 h-4/5"> 
            <img src="/images/1715501544.jpg" class="w-full h-full"></a>
        <input type="file" class=" hidden" id="Video" name="Video">
            <p class="text-2xl my-5 text-white">Video:</p>
            <a href="#" id="test" onclick="changeVideo()" class="w-4/5 h-4/5"> 
            <img src="/images/1715501544.jpg" class="w-full h-full"></a>
    </div>
</form>
<button form="myForm" class=" w-20 h-12 rounded-full flex justify-center items-center float-end mr-5 bg-slate-800 hover:bg-slate-500 transition-all duration-200 font-bold text-white ml-24">Add</button>
</div>
</div>

<script>
    function changeAvatar()
    {
        event.preventDefault();
        document.getElementById('Avatar').click();
    }
    function changeVideo()
    {
        event.preventDefault();
        document.getElementById('Video').click();
    }
  
</script>
@stop