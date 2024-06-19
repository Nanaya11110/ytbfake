
@extends('layout.master')
@section('content')
@section('title','Mail')
<div class=" w-full flex justify-center items-center ">  
    <form action="{{route('sendmail')}}" method="get" class=" w-1/2 h-72 flex flex-col justify-center items-center gap-5 ">
        @csrf
            <!--TITLE-->
            <div>
                <span>NAME</span>
                <input class="" id="title" name="title" type="text">
            </div>
            <div>
                <span>CONTENT</span>
                <textarea id="content" name="content"></textarea>
            </div>
            <button class=" bg-white w-20 h-10 rounded-lg">Send Mail</button>
    </form>
</div>
  
@stop
