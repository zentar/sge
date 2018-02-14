<header class="main-header">
    <!-- Logo -->
    <a href="{{ url('/admin/home') }}" class="logo" style=" background-color:#A61E4A; color:white">
        <!-- mini logo for sidebar mini 50x50 pixels --> 
      <!--    <img src="{{URL::asset('logos/dpB.png')}}">-->
        <span class="logo-mini ">       
          {{-- <img src="{{URL::asset('logos/dpB-small-white.png')}}" alt="SGD" height="50%" width="70%"></span>  --}}
          <img src="{{URL::asset('logos/DP4.png')}}" alt="SGD" height="50%" width="70%"></span> 
        <!-- logo for regular state and mobile devices -->
       <span class="logo-lg">
         {{--  <img src="{{URL::asset('logos/dpB-big-white.png')}}" alt="SGD"></span> --}}

         

         <img class="col-md-*" src="{{URL::asset('logos/DP2.png')}}" alt="SGD" height="80%" width="80%"></span> 

    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" style="background-color:#A61E4A; color:white;">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>
        <h3 style="text-align:right; margin-right:50px; margin-top:10px;">{{\Auth::User()->name}} - {{\Auth::User()->role->title}}</h3>
    </nav>
</header>



