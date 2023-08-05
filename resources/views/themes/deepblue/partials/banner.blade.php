     <style>
         #page-banner {
             background-image: linear-gradient(90deg, rgba(7,11,40,0.65) 0%, rgba(7,11,40,0.65) 100%), url({{getFile(config('location.logo.path').'banner.jpg')}});
         }
     </style>
     @if(!request()->routeIs('home'))
         <!-- PAGE-BANNER -->
         <section id="page-banner">
             <div class="container">
                 <div class="page-header">
                     <h2 class="fontubonto font-weight-medium text-uppercase wow fadeIn" data-wow-duration="1s" data-wow-delay="0.35s">@yield('title')</h2>
                 </div>
                 <div class="d-flex align-items-center justify-content-center">
                     <div class="col-lg-8 no-gutters">
                         <div class="page-breadcrumb" aria-label="breadcrumb">
                             <ol class="breadcrumb justify-content-center">
                                 <li class="breadcrumb-item wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.5s"><a href="{{route('home')}}">{{trans('Home')}}</a></li>
                                 <li class="breadcrumb-item wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.7s"><a href="javascript:void(0)">@yield('title')</a></li>
                             </ol>
                         </div>
                     </div>
                 </div>
             </div>
         </section>
         <!-- /PAGE-BANNER -->
     @endif
