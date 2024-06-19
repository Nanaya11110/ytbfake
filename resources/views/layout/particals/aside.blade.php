<html>
    <head>
        <style>
            .position-sticky {
                position: -webkit-sticky;
                position: sticky;
                top: 0px;
            }
        </style>
    </head>
<aside class=" w-72 h-96 flex justify-center items-center float-left position-sticky mt-5">
    <div class=" w-full" style="min-height:20px">
        <!--FIRST ASIDE-->
        <table class="w-full h-44  text-slate-50">
            <tr class="bg-gray-800">
               <td class="w-1/3 "><i class="fa-solid fa-house fa-lg" style="color: #ffffff;"></i></td>
               <td><a href="{{route('home')}}">Home</a></td>
            </tr>
            <tr>
                <td><i class="fa-brands fa-square-youtube fa-2xl" style="color: #ffffff;"></i></td>
                <td><a href="{{route('sub_channel')}}">Subscribed Channel</a></td>
            </tr>
            <tr>
                <td><i class="fa-solid fa-user-tie fa-xl" style="color: #ffffff;"></i></td>
                @if (!auth()->user())
                <td><a href="{{route("login")}}">User</a></td>
                @else <td><a href="{{route("User.show")}}">User</a></td>
                @endif
               
            </tr>
        </table>
        <br>
        <hr class=" border border-gray-50">
        <br>
        <table class="w-full h-44 text-slate-50">
            <tr>
               <td class=" w-1/3"><i class="fa-regular fa-clock fa-xl" style="color: #ffffff;"></i></td>
               <td><a href="{{route('mail')}}">Send Mail</a></td>
            </tr>
            <tr>
                <td><i class="fa-solid fa-table-list fa-xl" style="color: #ffffff;"></i></td>
                <td>Video List</td>
            </tr>
            <tr>
                <td><i class="fa-solid fa-thumbs-up fa-xl" style="color: #ffffff;"></i></td>
                <td><a href="{{route('like_video')}}">Video liked</a></td>
            </tr>
        </table>
    </div>
    </aside>
    </html>