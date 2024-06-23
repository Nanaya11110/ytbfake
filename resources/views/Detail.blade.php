
@extends('layout.master')
@section('content')
@section('title',$video->FullName)


<!--CONTAINER-->
<div class=" lg:flex md:flex-col lg:flex-row pb-10  ">
<div class=" w-4/5">
    <!-- VIDEO-->
    <div class="w-auto min-h-2 flex">
        <div class=" lg:w-4/5 md:w-full min-h-2 mt-2 ml-8">
            <video width="1000" height="563" controls class=" rounded-xl">
                <source src="/{{$video->VideoUrl}}" type="video/mp4">
            </video>
        </div>
    </div>
    <!--CONTENT-->
    <h1 class=" ml-8 text-3xl break-words text-white">{{$video->FullName}}</h1>
    <div class="  flex justify-normal items-center mt-2">
        <!--AVATAR-->
        <div class=" w-36 h-24 flex justify-center items-center ">
            <div class=" w-1/2 h-1/2 rounded-full bg-cover bg-center" style="background-image: url('{{$user->Avatar}}')"></div>
        </div>
        <!--PROB-->
        <div class="pl-1 text-white w-2/5 h-24 flex pt-3 ">
            <div class=" w-full break-words ">
                <p class=" text-2xl">{{$user->fullname}}</p>
                <p>{{$sub}} sub</p>
                <span>{{$user->subscribe}}</span>
            </div>
        </div>
        <!--BUTTON-->
        <div class="pl-1 text-white w-full h-auto flex mb-2 ">
            <!--SUBSCRIBE-->
            @if (Auth::check())
            @if ($user->id == auth()->user()->id)
                <!--HIDE THE SUB BUTTON IF THIS IS UR CHANNEL-->
            <div class=" w-24 h-12 bg-slate-800 rounded-full text-center hidden">Subscribe</div>
            @else 
            @if ($sub == 1)
                <!--HAD SUB-->
            <form action="{{route('unSub',['id'=>$user->id])}}" method="GET">
                @csrf
                <button id="sub" onclick="Subscribe({{$user->id}},{{$sub}})"  class=" w-24 h-12 bg-slate-800 rounded-full text-center">Subscribed</button>
            </form>
            @else
            <!--HAVENT SUB-->
            <form action="{{route('subscribe',['id'=>$user->id])}}" method="GET">
                @csrf
                <button id="sub" onclick="Subscribe({{$user->id}},{{$sub}})"  class=" w-24 h-12 bg-slate-800 rounded-full text-center">Subscribe</button>
            </form>
            @endif
            @endif   
            @endif
            
            
        
            <!--LIKE AND DISLIKE-->
            <form action="{{route('like',['id'=>$video->Id])}}" method="GET">
                @csrf
                <button id="like" data-like={{$like['like']}} onclick="Like({{$video->Id}})" class=" hover:bg-slate-700 transition-all ml-10 w-24 h-12 bg-slate-800 rounded-full rounded-r-none text-center border-r-2 border-r-gray-600">
                    {{$like['like']}}<p class=" inline ml-2">Like</p></button>
            </form>
            <form action="{{route('dislike',['id'=>$video->Id])}}" method="GET">
                @csrf
                <button id="dislike" data-dislike={{$like['dislike']}}  onclick="Dislike({{$video->Id}})" class="hover:bg-slate-700 transition-all w-24 h-12 bg-slate-800 rounded-full text-center rounded-l-none">{{$like['dislike']}}<p class=" inline ml-2">Dislike</p></button>
            </form>
            <button class=" w-24 h-12 ml-1 bg-slate-800 rounded-full text-center" onclick="Share()"><p>Share</p></button>
            <a href="/{{$video->VideoUrl}}" download class=" w-24 h-12 ml-1 bg-slate-800 rounded-full pt-2.5 text-center"><p>Dowload</p></a>
        </div>
    </div>
    <!--DESCRIPTION-->
    <div class=" pl-2 text-white mt-5 ml-4 p-2 " id="description" style="width:64%">
        <span class="text-white">{{$video->View}} View</span>
        <span class="text-white">{{$video->Times}}</span>
        <div >
            <p id="description-content">{{\Illuminate\Support\Str::limit($video->Des, 100)}}</p>
        </div>
        <button type="button" class=" text-gray-500 see-more-btn" onclick="seemore()"> See more</button>
    </div>
    <!--COMMENT-->
        <div class=" min-h-2 ml-5 w-5/6">
        <!--TOTAL COMMENT-->
        @if(isset($comment))
    
            <div class=" mt-2 w-full h-16">
                <p class="text-white pt-3 text-2xl" id="TotalComment" data-total={{count($comment)}}>{{count($comment)}} Comment</p></div> 
        @else <div class=" mt-2 w-full h-16">
            <p class="text-white pt-3 text-2xl">0 Comment</p></div> 
        @endif
        <!--COMMENT INPUT-->
        <div class="flex w-full min-h-2 ">
                <div class=" w-16 h-16 flex justify-center items-center ">
                    @if (!auth()->user())
                    <div class=" w-2/3 h-2/3 rounded-full bg-cover bg-center" style="background-image: url('/images/1715501544.jpg')"></div>
                    @else <div class=" w-2/3 h-2/3 rounded-full bg-cover bg-center" style="background-image: url('{{auth()->user()->Avatar}}')"></div>
                    @endif
                </div>
                <form  class="w-4/6 h-full flex" action="{{route('comment',['comment'=>$video->Id])}}" method="POST"> 
                    @csrf
                    <input  placeholder="Comment Here" 
                            type="text" 
                            name="content" id="content"
                            class="w-full h-10 bg-inherit border-b-2 border-black text-white 
                            focus: outline-none focus:border-b-green-100  transition-colors duration-150 ">
                    <button id="CommentBtn" class="w-24 h-12 bg-gray-600 rounded-full text-white">Comment</button>
                </form>
                <div class=" w-auto h-16  flex justify-center items-center ">
                
                </div>
            </div>
            <!--THE COMMENTS-->
        @if(isset($comment))
            @foreach ($comment as $comment)
                <div  class="w-full min-h-2">
                    <!--A COMMENT-->
                    <div class=" w-full min-h-2 mt-5" id="Comment{{$comment['Id']}}" >
                        <div class="flex">
                        <!--USER AVATAR COMMENT-->
                        <div class=" w-16 h-16 flex justify-center items-center ">
                            <img class=" w-2/3 h-2/3 rounded-full bg-cover bg-center" src="{{$comment['Avatar']}}">
                        </div>
                    
                        <div class="w-4/5 min-h-2 ">
                            <!--COMMENT INFO-->
                            <div class="text-white">
                                <span class=" text-xl">{{$comment['Name']}}</span>      
                                <span class="pl-5"></span>
                            </div>
                            <!--COMMENT CONTENT-->
                            
                            <div class="w-full min-h-2 text-gray-500">{{$comment['comment']}}</div>
                            <!--DELETE BUTTON-->
                        @if (Auth::check() && auth()->user()->fullname == $comment['Name'])
                            <form action="{{route('comment.delete',$comment['Id'])}}" method="GET">
                                @csrf 
                                <a id="DeleteComment" data-id={{$comment['Id']}} href="javascript:void(0)" onclick="DeleteComment({{$comment['Id']}})">Delete</a>
                            </form>
                        @endif
                        </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else <p>No comment here</p>
        @endif
    <div id="AddComment"></div>
    </div>
    
</div>
    @include('layout.particals.detail_aside')
</div>
<script>
    function seemore()
    {
        const descriptionContent = document.getElementById('description-content');
        const seeMoreBtn = document.querySelector('.see-more-btn');
        if (descriptionContent.innerHTML == "{{\Illuminate\Support\Str::limit($video->Des, 100)}}") 
        {
            descriptionContent.innerHTML = "{{$video->Des}}";
            seeMoreBtn.innerHTML ="See less";
           
        } 
        else 
        {
            descriptionContent.innerHTML = "{{\Illuminate\Support\Str::limit($video->Des, 100)}}";
            seeMoreBtn.innerHTML ="See more";
           
        }};

        //COMMENT INPUT
        

    $('#CommentBtn').click(function(e) {
        @if (Auth::check())
        e.preventDefault();
        const content = document.getElementById('content').value;
        var TotalComment = $('#TotalComment').data('total') + 1;
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });
        $.ajax({
            
            method: "POST",
            url: "{{route('comment',['comment'=>$video->Id])}}",
            data: { 'content': content },
            success: function(data) {
                var id= data.comment['id']
                let url = `<form action="{{route('comment.delete','Id')}}" method="GET">`;
                url = url.replace('Id', id);
                //alert(url)
                let html = `<div  class="w-full min-h-2">\
                    <div class=" w-full min-h-2 mt-5" id="Comment${id}">\
                    <div class="flex">\
                    <!--USER AVATAR COMMENT-->\
                    <div class=" w-16 h-16 flex justify-center items-center ">\
                        <img class=" w-2/3 h-2/3 rounded-full bg-cover bg-center" src="${data.userComment['Avatar']}"></div>\
                    <div class="w-4/5 min-h-2 ">\
                        <!--COMMENT INFO-->\
                        <div class="text-white">\
                            <span class="text-xl">${data.userComment['fullname']}</span>\
                            <span class="pl-5"></span>\
                        </div>\
                        <!--COMMENT CONTENT-->\
                        <div class="w-full min-h-2 text-gray-500">${data.comment['Content']}</div>\
                        <!--DELETE BUTTON-->`;
                    html += `${url}`;   
                   
                    html +=` @csrf \
                    <a id="DeleteComment" data-id=${id} href="javascript:void(0)" onclick="DeleteComment(${id})">Delete</a>\
                        </form>\</div>\
                    </div>\
                </div>`;
                   
                $('#AddComment').append(html);
                $('#TotalComment').html(TotalComment++ + ' Comment');
                $('#content').val('');
            }
        });
        @else
            window.location.href={{route('login')}};
        @endif
    });

    function DeleteComment(id)
    {
        console.log(id);
        var TotalComment = $('#TotalComment').data('total') - 1;


        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });


        $.ajax({
            method: "GET",
            url: "/Deletecomment/"+id,
            data: { 'id': id},
            success: function(data) 
            {
                $("#Comment" +id).slideUp();
                $('#TotalComment').html(TotalComment-- + ' Comment');
            }
        });
    };
    
    function Subscribe(id,sub)
    { 
        var button = document.getElementById('sub');   
        console.log(id,sub);
        event.preventDefault();
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });
        //HAD SUBED
        if (sub ==1)
        {
            $.ajax({
            method: "GET",
            url: "/unSub/" +id,
            data: { 'id': id},
            success: function(data) 
            {
                alert(data.mes);
                button.innerHTML = 'Subscribe';
                button.setAttribute("onclick",`Subscribe(${id},0)`);
            }
        });
        }
        //HAVENT SUB
        else 
        {
            $.ajax({
            method: "GET",
            url: "/subscribe/" + id,
            data: { 'id': id},
            success: function(data) 
            {
                button.innerHTML = 'Subscribed';
                button.setAttribute("onclick",`Subscribe(${id},1)`);
                
                alert(data.mes);
               
            }
        });
        }

       
    };

    function Like(id)
    {
        var button = document.querySelector("#like");
        var like = document.querySelector("#like").dataset.like;
        like = Number(like);
        console.log(id,like);
        event.preventDefault();
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });
        $.ajax({
            method: "GET",
            url: "/like/" +id,
            data: { 'id': id, 'like':like},
            success: function(data) 
            {
                button.innerHTML = data.count + '  Like';
                button.setAttribute('data-like', data.count);
                alert(data.mes);
            }
            })
    };

    function Dislike(id)
    {
        var button = document.querySelector("#dislike");
        var dislike = document.querySelector("#dislike").dataset.dislike;
        dislike = Number(dislike) ;
        console.log(id,dislike);
        event.preventDefault();
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });
        $.ajax({
            method: "GET",
            url: "/dislike/" +id,
            data: { 'id': id,'dislike':dislike},
            success: function(data) 
            {
                button.innerHTML = data.count + '  Dislike';
                button.setAttribute('data-dislike', data.count);
                alert(data.mes);

            }
            })
    };
    function Share()
    {
        var copyText = window.location.href;
        navigator.clipboard.writeText(copyText); 
        alert("Link Copied");
    }
</script>
@stop
