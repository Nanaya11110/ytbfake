<html>

<head>
    <style>
        .position-sticky {
            position: -webkit-sticky;
            position: sticky;
            top: 0px;
        }

        tr:hover {
            background-color: rgb(30 41 59);
        }
    </style>
</head>
<aside class=" h-96 flex justify-center items-center  position-sticky mt-5 ">
    <div class=" w-full">
        <!--1ST TABLE-->
        <div class="flex flex-col justify-center items-center w-full ">
            <table class="w-full  h-44  text-slate-50 ">
                <tr>
                    <td class="w-1/3 "><i class="fa-solid fa-house fa-lg" style="color: #ffffff;"></i></td>
                    <td><a href="{{route('home')}}">Home</a></td>
                    </a>
                </tr>
                <tr>
                    <td><i class="fa-brands fa-square-youtube fa-2xl" style="color: #ffffff;"></i></td>
                    <td><a href="{{ route('sub_channel') }}">Subscribed Channel</a></td>
                </tr>
                <tr>
                    <td><i class="fa-solid fa-user-tie fa-xl" style="color: #ffffff;"></i></td>
                    @if (!auth()->user())
                        <td><a href="{{ route('login') }}">User</a></td>
                    @else
                        <td><a href="{{ route('User.show') }}">User</a></td>
                    @endif
                </tr>
            </table>
            <br>
            <hr class=" border border-gray-50 md:w-60">
            <br>
            <!--2ND TABLE-->
            <table class="w-full h-44   text-slate-50">
                <tr>
                    <td><i class="fa-solid fa-table-list fa-xl" style="color: #ffffff;"></i></td>
                    <td>Video List</td>
                </tr>
                <tr>
                    <td><i class="fa-solid fa-thumbs-up fa-xl" style="color: #ffffff;"></i></td>
                    <td><a href="{{ route('like_video') }}">Video liked</a></td>
                </tr>
            </table>
        </div>
    </div>
</aside>
</html>

</aside>

</html>
