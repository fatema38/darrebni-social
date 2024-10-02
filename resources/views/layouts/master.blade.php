<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        @keyframes slide-in {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .motivational-text h3 {
            font-size: 1.5rem;
            font-weight: bold;
            animation: slide-in 2s ease-in-out;
            line-height: 2;
        }
    </style>


    <meta charset="utf-8" />
    <title>Darrebni</title>
    <meta name="description" content="Admin, Dashboard, Bootstrap, Bootstrap 4, Angular, AngularJS" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimal-ui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- for ios 7 style, multi-resolution icon of 152x152 -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-barstyle" content="black-translucent">
    <link rel="apple-touch-icon" href="{{ asset('assets/images/logo.png') }}">
    <meta name="apple-mobile-web-app-title" content="Flatkit">
    <!-- for Chrome on Android, multi-resolution icon of 196x196 -->
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="shortcut icon" sizes="196x196" href="{{ asset('assets/images/logo.png') }}">


    <!-- style -->
    <!-- style -->
    <link rel="stylesheet" href="{{ asset('assets/animate.css/animate.min.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/glyphicons/glyphicons.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/font-awesome/css/font-awesome.min.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/material-design-icons/material-design-icons.css') }}" type="text/css" />

    <link rel="stylesheet" href="{{ asset('assets/bootstrap/dist/css/bootstrap.min.css') }}" type="text/css" />
    <!-- build:css ../assets/styles/app.min.css -->
    <link rel="stylesheet" href="{{ asset('assets/styles/app.css') }}" type="text/css" />
    <!-- endbuild -->
    <link rel="stylesheet" href="{{ asset('assets/styles/font.css') }}" type="text/css" />

    <!-- تضمين CSS الخاص بـ select2 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"/>



</head>
<body>
<div class="app" id="app">

    <!-- ############ LAYOUT START-->

    <!-- aside -->
    <div id="aside" class="app-aside modal nav-dropdown ">
        <!-- fluid app aside -->
        <div class="left navside dark dk" data-layout="column" style="background-color: grey ;color:white">
            <div class="navbar no-radius" >
                <!-- brand -->
                <a class="navbar-brand mr-3 " style="max-width: 400px;max-height: 200px;" >
                    <div ui-include="'{{ asset('assets/images/logo.svg') }}'"></div>
                    <img src="{{ asset('assets/images/logo.png') }}" alt="." class="hide">
                    <span class="m-r-md" ><img src="{{asset('images/logo.jpg')}}" width="100%" height="auto" > </span>
                    <hr style="color:black">
                    <span ><b style="color:#6f2877">Darrebni_Social</b></span>
                </a>

                <!-- / brand -->
            </div>
            <div class="hide-scroll" data-flex>
                <nav class="scroll nav-light">

                    <ul class="nav" ui-nav>



                        @if(!auth()->user())
                            <div class="motivational-text" style="padding: 20px; text-align: center; background-color:grey; color: #fff; margin-top: 20px">
                                <h3 id="animate-text">Discover and learn... The future starts here!</h3>
                            </div>
                            <div>
                                <img src="images/darrebni2.png" style="max-width: 100%; /* ضمان أن الصورة لا تتعدى عرض العنصر الحاوي */
    height: auto; /* الحفاظ على نسبة العرض إلى الارتفاع */
    display: block; /* إزالة المسافة السفلية تحت الصورة */
    margin: 0 auto;
     margin-top: 100px
    ">
                            </div>
                        @endif
           @if(auth()->user())
                                <li class="nav-header hidden-folded">
                                    <small class="text-muted">Main</small>
                                </li>
                            <li>
                                <a href="{{route('posts')}}" >
                    <span class="nav-icon">
                      <i class="material-icons">&#xe3fc;
                         <span ui-include="'{{ asset('assets/images/i_0.svg') }}'"></span>
                      </i>
                    </span>
                                    <span class="nav-text">Feeds</span>
                                </a>
                            </li>
           @if(auth()->user()->role->name=="superAdmin" || auth()->user()->role->name=="admin")
                                <li>
                                    <a href="{{route('create-user')}}" >
                                <span class="nav-icon">
                           <i class="material-icons">&#xe3fc;
                          <span ui-include="'{{ asset('assets/images/i_0.svg') }}'"></span>
                            </i>
                                 </span>
                                        <span class="nav-text">User register</span>
                                    </a>
                                </li>
                            @endif
@if(auth()->user()->role->name=="superAdmin")

<li>
    <a href="{{route('users.all')}}" >
<span class="nav-icon">
<i class="material-icons">&#xe3fc;
<span ui-include="'{{ asset('assets/images/i_0.svg') }}'"></span>
</i>
</span>
        <span class="nav-text">All Users</span>
    </a>
</li>

@endif

    @if(auth()->user()->role->name=="admin")
                   <li>
                       <a href="{{route('posts.repeat')}}" >
     <span class="nav-icon">
     <i class="material-icons">&#xe3fc;
     <span ui-include="'{{ asset('assets/images/i_0.svg') }}'"></span></i>
     </span>
                           <span class="nav-text">Duplicate Tags</span>
                       </a>
                   </li>
        <li>
            <a href="{{route('coaches-and-trainees')}}" >
<span class="nav-icon">
<i class="material-icons">&#xe3fc;
<span ui-include="'{{ asset('assets/images/i_0.svg') }}'"></span>
</i>
</span>
                <span class="nav-text">Coaches and Trainees</span>
            </a>
        </li>
    @endif


               <li>
                   <a href="{{route('reports')}}" >
<span class="nav-icon">
<i class="material-icons">&#xe3fc;
<span ui-include="'{{ asset('assets/images/i_0.svg') }}'"></span>
</i>
</span>
                       <span class="nav-text">Reports</span>
                   </a>
               </li>

               <li>
                   <a href="add-group" >
<span class="nav-icon">
<i class="material-icons">&#xe3fc;
<span ui-include="'{{ asset('assets/images/i_0.svg') }}'"></span>
</i>
</span>
                       <span class="nav-text">Add Group</span>
                   </a>
               </li>


               <li>
                   <a href="{{route('groups')}}" >
<span class="nav-icon">
<i class="material-icons">&#xe3fc;
 <span ui-include="'{{ asset('assets/images/i_0.svg') }}'"></span>
</i>
</span>
                       <span class="nav-text">Groups</span>
                   </a>
               </li>
               <li>
                   <a href="{{route('logout')}}" >
<span class="nav-icon">
<i class="material-icons">&#xe3fc;
 <span ui-include="'{{ asset('assets/images/i_0.svg') }}'"></span>
</i>
</span>
                       <span class="nav-text">Logout</span>
                   </a>
               </li>
                        @endif




{{--                        <li>--}}
{{--                            <a>--}}
{{--                    <span class="nav-caret">--}}
{{--                      <i class="fa fa-caret-down"></i>--}}
{{--                    </span>--}}
{{--                                <span class="nav-label">--}}
{{--                      <b class="label rounded label-sm primary">5</b>--}}
{{--                    </span>--}}
{{--                                <span class="nav-icon">--}}
{{--                      <i class="material-icons">&#xe5c3;--}}
{{--                        <span ui-include="'../assets/images/i_1.svg'"></span>--}}
{{--                      </i>--}}
{{--                    </span>--}}
{{--                                <span class="nav-text">Apps</span>--}}
{{--                            </a>--}}
{{--                            <ul class="nav-sub">--}}
{{--                                <li>--}}
{{--                                    <a href="inbox.html" >--}}
{{--                                        <span class="nav-text">Inbox</span>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <a href="contact.html" >--}}
{{--                                        <span class="nav-text">Contacts</span>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <a href="calendar.html" >--}}
{{--                                        <span class="nav-text">Calendar</span>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </li>--}}

</ul>
</nav>
</div>
<div class="b-t">
@if(auth()->user())
<div class="nav-fold">
<a href="{{route('profile',auth()->id())}}">
<span class="pull-left">
<img src="{{asset(auth()->user()->profile_picture)}}" alt="..." class="w-40 img-circle">
</span>
<span class="clear hidden-folded p-x">
<span class="block _500">{{auth()->user()->name}}</span>
<small class="block text-muted"><i class="fa fa-circle text-success m-r-sm"></i>online</small>
</span>
</a>
</div>
@endif
</div>
</div>
</div>
<!-- / -->

<!-- content -->
<div id="content" class="app-content box-shadow-z0" role="main">
<div class="app-header white box-shadow">
<div class="navbar navbar-toggleable-sm flex-row align-items-center">
<!-- Open side - Naviation on mobile -->
<a data-toggle="modal" data-target="#aside" class="hidden-lg-up mr-3">
<i class="material-icons">&#xe5d2;</i>
</a>
<!-- / -->

<!-- Page title - Bind to $state's title -->
<div class="mb-0 h5 no-wrap" ng-bind="$state.current.data.title" id="pageTitle"></div>

<!-- navbar collapse -->
<div class="collapse navbar-collapse" id="collapse">
<!-- link and dropdown -->


<div ui-include="'{{ asset('views/blocks/navbar.form.html') }}'"></div>
<!-- / -->
</div>
<!-- / navbar collapse -->

<!-- navbar right -->
    <ul class="nav navbar-nav ml-auto flex-row">
        <li class="nav-item">
            @if(!auth()->user())

                <div class="d-flex align-items-center">

                    <a href="{{ route('login') }}" style="background-color: #6f2877; color: white; margin-right: 10px;" class="btn btn-sm">Login</a>
                    <a href="{{ route('register') }}" style="background-color: #6f2877; color: white;" class="btn btn-sm">Register</a>
                </div>
            @endif
        </li>
{{--<li class="nav-item dropdown pos-stc-xs">--}}
{{--<a class="nav-link mr-2" href data-toggle="dropdown">--}}
{{--    <i class="material-icons">&#xe7f5;</i>--}}
{{--    <span class="label label-sm up warn">3</span>--}}
{{--</a>--}}
{{--<div ui-include="{{ asset('views/blocks/dropdown.notification.html')}}"></div>--}}
{{--</li>--}}
    @if(auth()->user())
<li class="nav-item dropdown">
<a class="nav-link p-0 clear" href="#" data-toggle="dropdown">
<span class="avatar w-32">
<img src="{{asset(auth()->user()->profile_picture)}}" alt="...">
<i class="on b-white bottom"></i>
</span>
</a>
<div ui-include="'{{ asset('views/blocks/dropdown.user.html') }}'"></div>

</li>
    @endif
<li class="nav-item hidden-md-up">
<a class="nav-link pl-2" data-toggle="collapse" data-target="#collapse">
    <i class="material-icons">&#xe5d4;</i>
</a>
</li>

</ul>
<!-- / navbar right -->
</div>
</div>
<div class="app-footer">
<div class="p-2 text-xs">
<div class="pull-right text-muted py-1">
&copy; Copyright <strong>Flatkit</strong> <span class="hidden-xs-down">- Built with Love v1.1.3</span>
<a ui-scroll-to="content"><i class="fa fa-long-arrow-up p-x-sm"></i></a>
</div>
<div class="nav">
<a class="nav-link" href="../">About</a>
<a class="nav-link" href="http://themeforest.net/user/flatfull/portfolio?ref=flatfull">Get it</a>
</div>
</div>
</div>
<div ui-view class="app-body" id="view">
<div class="padding">
<div class="row">
@yield('content')
</div>
</div>
</div>
</div>

<!-- theme switcher -->
<div id="switcher">
<div class="switcher box-color dark-white text-color" id="sw-theme">
<a href ui-toggle-class="active" target="#sw-theme" class="box-color dark-white text-color sw-btn">
<i class="fa fa-gear"></i>
</a>
<div class="box-header">
<a href="https://themeforest.net/item/flatkit-app-ui-kit/13231484?ref=flatfull" class="btn btn-xs rounded danger pull-right">BUY</a>
<h2>Theme Switcher</h2>
</div>
<div class="box-divider"></div>
<div class="box-body">
<p class="hidden-md-down">
<label class="md-check m-y-xs"  data-target="folded">
    <input type="checkbox">
    <i class="green"></i>
    <span class="hidden-folded">Folded Aside</span>
</label>
<label class="md-check m-y-xs" data-target="boxed">
    <input type="checkbox">
    <i class="green"></i>
    <span class="hidden-folded">Boxed Layout</span>
</label>
<label class="m-y-xs pointer" ui-fullscreen>
    <span class="fa fa-expand fa-fw m-r-xs"></span>
    <span>Fullscreen Mode</span>
</label>
</p>
<p>Colors:</p>
<p data-target="themeID">
<label class="radio radio-inline m-0 ui-check ui-check-color ui-check-md" data-value="{primary:'primary', accent:'accent', warn:'warn'}">
    <input type="radio" name="color" value="1">
    <i class="primary"></i>
</label>
<label class="radio radio-inline m-0 ui-check ui-check-color ui-check-md" data-value="{primary:'accent', accent:'cyan', warn:'warn'}">
    <input type="radio" name="color" value="2">
    <i class="accent"></i>
</label>
<label class="radio radio-inline m-0 ui-check ui-check-color ui-check-md" data-value="{primary:'warn', accent:'light-blue', warn:'warning'}">
    <input type="radio" name="color" value="3">
    <i class="warn"></i>
</label>
<label class="radio radio-inline m-0 ui-check ui-check-color ui-check-md" data-value="{primary:'success', accent:'teal', warn:'lime'}">
    <input type="radio" name="color" value="4">
    <i class="success"></i>
</label>
<label class="radio radio-inline m-0 ui-check ui-check-color ui-check-md" data-value="{primary:'info', accent:'light-blue', warn:'success'}">
    <input type="radio" name="color" value="5">
    <i class="info"></i>
</label>
<label class="radio radio-inline m-0 ui-check ui-check-color ui-check-md" data-value="{primary:'blue', accent:'indigo', warn:'primary'}">
    <input type="radio" name="color" value="6">
    <i class="blue"></i>
</label>
<label class="radio radio-inline m-0 ui-check ui-check-color ui-check-md" data-value="{primary:'warning', accent:'grey-100', warn:'success'}">
    <input type="radio" name="color" value="7">
    <i class="warning"></i>
</label>
<label class="radio radio-inline m-0 ui-check ui-check-color ui-check-md" data-value="{primary:'danger', accent:'grey-100', warn:'grey-300'}">
    <input type="radio" name="color" value="8">
    <i class="danger"></i>
</label>
</p>
<p>Themes:</p>
<div data-target="bg" class="row no-gutter text-u-c text-center _600 clearfix">
<label class="p-a col-sm-6 light pointer m-0">
    <input type="radio" name="theme" value="" hidden>
    Light
</label>
<label class="p-a col-sm-6 grey pointer m-0">
    <input type="radio" name="theme" value="grey" hidden>
    Grey
</label>
<label class="p-a col-sm-6 dark pointer m-0">
    <input type="radio" name="theme" value="dark" hidden>
    Dark
</label>
<label class="p-a col-sm-6 black pointer m-0">
    <input type="radio" name="theme" value="black" hidden>
    Black
</label>
</div>
</div>
</div>

<div class="switcher box-color black lt" id="sw-demo">
<a href ui-toggle-class="active" target="#sw-demo" class="box-color black lt text-color sw-btn">
<i class="fa fa-list text-white"></i>
</a>
<div class="box-header">
<h2>Demos</h2>
</div>
<div class="box-divider"></div>
<div class="box-body">
<div class="row no-gutter text-u-c text-center _600 clearfix">
<a href="dashboard.html"
   class="p-a col-sm-6 primary">
    <span class="text-white">Default</span>
</a>
<a href="dashboard.0.html"
   class="p-a col-sm-6 success">
    <span class="text-white">Zero</span>
</a>
<a href="dashboard.1.html"
   class="p-a col-sm-6 blue">
    <span class="text-white">One</span>
</a>
<a href="dashboard.2.html"
   class="p-a col-sm-6 warn">
    <span class="text-white">Two</span>
</a>
<a href="dashboard.3.html"
   class="p-a col-sm-6 danger">
    <span class="text-white">Three</span>
</a>
<a href="dashboard.4.html"
   class="p-a col-sm-6 green">
    <span class="text-white">Four</span>
</a>
<a href="dashboard.5.html"
   class="p-a col-sm-6 info">
    <span class="text-white">Five</span>
</a>
<div
    class="p-a col-sm-6 lter">
    <span class="text">...</span>
</div>
</div>
</div>
</div>
</div>
<!-- / -->

<!-- ############ LAYOUT END-->

</div>
<!-- build:js ../assets/scripts/app.html.js -->
<!-- jQuery -->
<script src="{{asset('../libs/jquery/jquery/dist/jquery.js')}}"></script>
<!-- Bootstrap -->
<script src="{{asset('../libs/jquery/tether/dist/js/tether.min.js')}}"></script>
<script src="{{asset('../libs/jquery/bootstrap/dist/js/bootstrap.js')}}"></script>
<!-- core -->
<script src="{{asset('../libs/jquery/underscore/underscore-min.js')}}"></script>
<script src="{{asset('../libs/jquery/jQuery-Storage-API/jquery.storageapi.min.js')}}"></script>
<script src="{{asset('../libs/jquery/PACE/pace.min.js')}}"></script>
<script src="{{asset('scripts/palette.js')}}"></script>
<script src="{{asset('scripts/ui-load.js')}}"></script>
<script src="{{asset('scripts/ui-jp.js')}}"></script>
<script src="{{asset('scripts/ui-include.js')}}"></script>
<script src="{{asset('scripts/ui-device.js')}}"></script>
<script src="{{asset('scripts/ui-form.js')}}"></script>
<script src="{{asset('scripts/ui-nav.js')}}"></script>
<script src="{{asset('scripts/ui-screenfull.js')}}"></script>
<script src="{{asset('scripts/ui-scroll-to.js')}}"></script>
<script src="{{asset('scripts/ui-toggle-class.js')}}"></script>

<!-- تضمين ملفات JS الخاصة بـ select2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<!-- App -->
<script src="scripts/app.js"></script>
<script src="scripts/ajax.js"></script>
<script>
    const messages = [
        "Discover and learn... The future starts here!",
        "Start your journey in learning IT now!",
        "Every minute of learning is a step toward success!",
        "Education is your passport to the future!"
    ];

    let index = 0;
    const textElement = document.getElementById("animate-text");

    setInterval(() => {
        textElement.textContent = messages[index];
        index = (index + 1) % messages.length; // يعيد الحلقة على النصوص
    }, 3000); // تغيير كل 3 ثوانٍ
</script>

<!-- End of JS Files -->
<!-- endbuild -->

@stack('scripts')

</body>
</html>
