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

<div class="flex">
@include('layout.particals.aside')
<form class=" w-full" action="{{route('Channel.edit',['id'=>auth()->user()->id])}}" method="post" enctype="multipart/form-data">
  @csrf
  <table class="w-full text-white mb-5">
      <tr class=" h-10">
        <th class=" w-2/5 ">Video</th>
        <th class=" w-1/5 ">Name</th>
        <th class=" w-1/5 ">View</th>
        <Th class=" w-1/5 ">Times</Th> 
      </tr>
      @foreach ( $data as $item )
      <tr class=" text-lg">
        <td class="flex flex-col justify-center items-center">
          <a class="w-3/5" href="{{route('Detail',['id'=>$item->FullName])}}"><img src="/{{$item->Url}}"></a>
          <div>
            <a href="{{route('Channel.delete',['id'=>$item->Id])}}" class="text-red-500 hover:text-red-700 ml-2">Delete</a>
            <a href="{{route('Channel.edit',['id'=>$item->Id])}}" class="text-green-500 hover:text-red-700 ml-2">Edit</a>
          </div>
        </td>
        <td class=" text-center"><p>{{$item->FullName}}</p></td>
        <td class=" text-center"><p>{{$item->View}} View</p></td>
        <td class=" text-center"><p>{{$item->Times}} Hours</p></td>
      </tr>
    @endforeach
  </table>
</form>
</div>
<div class=" w-fitflex justify-center items-center float-end mr-5"><a href="{{route('Channel.create')}}"><p class="h-10 w-40 bg-slate-800 hover:bg-slate-600 text-center text-white pt-2 rounded-full">Add new</p></a></div>
@stop