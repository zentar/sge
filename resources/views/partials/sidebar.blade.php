@inject('request', 'Illuminate\Http\Request')
<!-- Left side column. contains the sidebar -->

<aside class="main-sidebar" style="background-color:rgb(0,0,0); color:white">
 

    
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">   
        <ul class="sidebar-menu" >
            <li class="{{ $request->segment(2) == 'home' ? 'active' : '' }}">
                <a href="{{ url('/') }}">
                    <i class="fa fa-book"></i>
                    <span class="title">@lang('quickadmin.user-management.libros')</span>
                </a>
            </li>


             <li class="{{ $request->segment(1) == 'autor' ? 'active' : '' }}">
                <a href="{{ url('/autor') }}">
                    <i class="fa fa-user"></i>
                    <span class="title">@lang('quickadmin.user-management.autores')</span>
                </a>
            </li>
                       
            @can('user_management_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span class="title">@lang('quickadmin.user-management.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                
                @can('role_access')
                <li class="{{ $request->segment(2) == 'roles' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.roles.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                                @lang('quickadmin.roles.title')
                            </span>
                        </a>
                    </li>
                @endcan
                @can('user_access')
                <li class="{{ $request->segment(2) == 'users' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.users.index') }}">
                            <i class="fa fa-user"></i>
                            <span class="title">
                                @lang('quickadmin.users.title')
                            </span>
                        </a>
                    </li>
                @endcan
                </ul>
            </li>
            @endcan

            @can('user_management_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-cog"></i>
                    <span class="title">@lang('quickadmin.administrador.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                @can('user_access')
                <li class="{{ $request->segment(1) == 'estados' ? 'active active-sub' : '' }}">
                        <a href="{{ route('estados.index') }}">
                            <i class="fa  fa-check"></i>
                            <span class="title">
                               @lang('quickadmin.administrador.fields.estado')
                            </span>
                        </a>
                    </li>
                @endcan

               @can('role_access')
                <li class="{{ $request->segment(1) == 'facultad' ? 'active active-sub' : '' }}">
                        <a href="{{ route('facultad.index') }}">
                            <i class="fa fa-building-o"></i>
                            <span class="title">
                                @lang('quickadmin.administrador.fields.facultad')
                            </span>
                        </a>
                    </li>
                @endcan
                @can('user_access')
                <li class="{{ $request->segment(1) == 'coleccion' ? 'active active-sub' : '' }}">
                        <a href="{{ route('coleccion.index') }}">
                            <i class="fa fa-sitemap"></i>
                            <span class="title">
                               @lang('quickadmin.administrador.fields.coleccion')
                            </span>
                        </a>
                    </li>
                @endcan  

               @can('user_access')
                <li class="{{ $request->segment(1) == 'auditoria' ? 'active active-sub' : '' }}">
                        <a href="{{ route('auditoria.index') }}">
                            <i class="fa fa-archive"></i>
                            <span class="title">
                               @lang('quickadmin.administrador.fields.auditoria')
                            </span>
                        </a>
                    </li>
                @endcan
                </ul>
            </li>
            @endcan


            <li class="{{ $request->segment(1) == 'change_password' ? 'active' : '' }}">
                <a href="{{ route('auth.change_password') }}">
                    <i class="fa fa-key"></i>
                    <span class="title">@lang('quickadmin.qa_change_password')</span>
                </a>
            </li>

            <li>
                <a href="#logout" onclick="$('#logout').submit();">
                    <i class="fa fa-arrow-left"></i>
                    <span class="title">@lang('quickadmin.qa_logout')</span>
                </a>
            </li>        

        </ul>
    </section>
</aside>
{!! Form::open(['route' => 'auth.logout', 'style' => 'display:none;', 'id' => 'logout']) !!}
<button type="submit">@lang('quickadmin.logout')</button>
{!! Form::close() !!}
