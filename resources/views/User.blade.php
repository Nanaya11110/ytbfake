@extends('layout.master')
@section('title', 'Edit')
@section('content')


@if(session('error'))
    <div class=" alert alert-error text-center"> {{session()->get('error')}}</div>
@endif
@if(session('success'))
    <div class=" alert alert-success text-center"> {{session()->get('success')}}</div>
@endif
<div class="flex">
@include('layout.particals.aside')
<form class=" w-full h-96 flex" action="{{route('User.update',['id'=>auth()->user()->id])}}" method="post" enctype="multipart/form-data">
    @csrf
    <!--IMAGE-->
    <div class=" w-1/3 h-full  flex flex-col items-center justify-center ">
    <img src="{{auth()->user()->Avatar}}" class=" w-1/2 h-1/2 rounded-full">
    <input type="file" id="avatar" name="avatar" class=" opacity-0 w-0 h-0 overflow-hidden absolute -z-10">
    <label for="avatar" class=" text-white p-5">Choose a image</label>
    @if($errors->has('avatar'))
            <div class=" alert alert-error my-2">{{ $errors->first('avatar') }}</div>
    @endif
    </div>
    <!--PROFILE-->
    <div class=" w-2/3 h-full  flex justify-center items-center ">
        <div class=" w-4/5 h-full  flex flex-col justify-center items-center ">
            <!--NAME-->
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your Name</label>
            <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300
            text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 
            focus:border-primary-600 block w-1/2 p-2.5 dark:bg-gray-700 dark:border-gray-600 
            dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
            placeholder="{{auth()->user()->fullname}}" 
            autocomplete="username">
            @if($errors->has('name'))
            <div class=" alert alert-error my-2">{{ $errors->first('name') }}</div>
            @endif
            <!--PASSWORD-->
            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white mt-5">Your Password</label>
            <div class=" w-1/2 flex items-center justify-between">
            <input type="password" name="password" id="password" class="bg-gray-50 border border-gray-300
            text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
            autocomplete="new-password"> 
            <div class="ml-1">
            <i class="fa-solid fa-eye fa-lg" style="color: #ffffff;" onclick="showPassword()"></i>
            <i class="fa-solid fa-eye-slash fa-lg hidden" style="color: #ffffff;" onclick="hidePassword()"></i></div></div>
            @if($errors->has('password'))
            <div class=" alert alert-error my-2">{{ $errors->first('password') }}</div>
            @endif
            <!--SAVE BUTTON-->
            <div class="flex "><button type="submit" class="mt-6 bg-gray-800 text-white w-36 h-10 rounded-full">Save change</button></div>
        </div>
        <!--CHANNEL BUTTON-->
        <div class="w-1/5    h-full ">
            <a class=" text-white" href="{{route('Channel.show',['id'=>auth()->user()->id])}}"><p class=" m-5 w-36 h-10 bg-gray-800 rounded-full text-center align-middle pt-1.5 float-end">Your chanel</p></a>
        </div>
    </div>
</form>
</div>

<script>
    function showPassword() {
        document.getElementById('password').type = 'text';
        document.querySelector('i.fa-eye').style.display = 'none';
        document.querySelector('i.fa-eye-slash').style.display = 'inline';
    }
    function hidePassword() {
        document.getElementById('password').type = 'password';
        document.querySelector('i.fa-eye-slash').style.display = 'none';
        document.querySelector('i.fa-eye').style.display = 'inline';
    }
</script>
@stop