<!DOCTYPE html>
<html>

<head>
<style> 
  ::-webkit-scrollbar{background-color: rgb(51, 65, 85);}
  ::-webkit-scrollbar-thumb{ background-color: white; }
</style>  
    <title>@yield('title')</title>
    <link rel="icon" href="/images/1715501544.jpg">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://kit.fontawesome.com/f622638057.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    @vite('resources/css/app.css')
</head>

<body class="text-gray-800 antialiased bg-slate-900">
    <nav class=" bg-slate-950 w-full h-20 flex items-center justify-around">
      <!--LOGO-->
        <div class=" w-52 h-10 float-start flex justify-center items-center text-slate-100 text-xl font-serif"> 
           <i class="fa-brands fa-youtube" style="color: #e00000;"></i>
           <a href="{{route('home')}}"><p class="ml-2">YOUTUBE</p></a>
        </div>
        <!--SEARCH BAR-->
        <form class=" w-6/12 h-10 flex text-slate-50 items-center justify-center" action="{{route('search')}}" method="GET">
          <input type="text" 
          name="search" id="search"
          placeholder="Search"
          class="h-full w-4/5 bg-inherit border border-slate-700 focus: outline-none focus:border-blue-700 rounded-full rounded-r-none placeholder: pl-5">
          <button class="h-full w-1/12 bg-slate-900 border border-slate-700 rounded-r-3xl pl-2 flex justify-center items-center">
          <i class="fa-solid fa-magnifying-glass" style="color: #ffffff;"></i></button>
        </form>
        <!--USER SIDE-->
        <div class=" w-36 h-10 flex justify-evenly items-center font-serif text-slate-50">
          <i class="fa-solid fa-bell" style="color: #ffffff;"></i>
          @if (!auth()->user())
                    
                      <span>
                        <a href="{{route('login')}}"><img src="/images/1715501544.jpg" class="w-10 h-10 rounded-full object-cover"> </a>
                      </span>
       
                    @else
                    <a href="/logout">
                      <img src="{{auth()->user()->Avatar}}" class="w-10 h-10 rounded-full object-cover"> </a>
                    </a>
                    @endif
          
          </div>
        </div>
    </nav> 
</body>

</html>
