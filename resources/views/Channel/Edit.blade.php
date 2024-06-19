@extends('layout.master')
@section('title', $data->FullName)
@section('content')

@if(session()->has('error'))
  <div class=" m-10 bg-red-400">
      {{ session()->get('error') }}
  </div>
@endif
@if(session('success'))
    <p class="bg-green-500">{{ session('success') }}</p>
@endif

<div class="flex mb-5">
@include('layout.particals.aside')
<form class=" w-full  ml-2" action="{{route('Channel.update',['id'=>$data->Id])}}" method="post" enctype="multipart/form-data">
  @csrf
  <!--TITLE AND BUTTON-->
    <div class="w-full h-20  flex">
        <h1 class="text-3xl text-white w-4/5 flex justify-center items-center"><p>Video Information</p></h1>
        <div class="w-1/5 h-full  flex justify-center items-center">
                @csrf
                <button class=" w-1/2 h-1/2 bg-slate-800 hover:bg-slate-700 rounded-full text-white" >Save</button>
        </div>
    </div>
    <!--PROB-->
    <div class="w-full h-fit flex gap-2">
        <!--IMAGE-->
        <div class="w-2/4 h-full ml-5">
            <input type="file" class=" hidden" id="Avatar" name="Avatar">
            <p class="text-2xl my-5 text-white">Thumnail:</p>
           <a href="#" id="test" onclick="changeAvatar()"> <img src="/{{$data->Url}}" class="w-full h-full"></a></div>
        <!--VIDEO PROB-->
        <div class="w-2/4 h-full flex flex-col justify-center items-center my-5 ">
            <!--CHANGE NAME AND DES-->
            <label for="Name" class=" mr-80 ml-5 mb-2 text-white">Video Title</label>
            <input type="text" id="Name" name="Name" class=" w-3/4 h-14 mb-10 bg-inherit border border-gray-500 text-white">
            <label for="Des" class=" mr-80 ml-16 mb-2 text-white">Video Description</label>
            <textarea class=" w-3/4 h-72 bg-inherit border border-gray-500 text-white" id="Des" name="Des"></textarea>
        </div>
    </div>
</form>
</div>
<script>
     $(document).ready(function() {
        $("#Des").val("{{$data->Des}}");
        $("#Name").val("{{$data->FullName}}");
    });
    function changeAvatar()
    {
        event.preventDefault();
        document.getElementById('Avatar').click();
    }

  
</script>
@stop