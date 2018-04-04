@extends('layouts.restaurants')

@section('content')
         
         


            <div class="inner-page-hero bg-image" data-image-src="/images/profile-banner2.jpeg" style="background: url(&quot;images/profile-banner2.jpeg&quot;) center center / cover no-repeat;">
                <div class="container"> 

                  <div class="row">
                     <a href="/restaurants/{{ App\Models\Restaurant::first()->id }}" class="col-md-3">
                        <img style="width: 280px;" src="/images/adv-img-1.jpg">
                     </a>

                     <a  href="/restaurants/{{ App\Models\Restaurant::first()->id }}" class="col-md-3">
                        <img style="width: 280px;" src="/images/adv-img-2.jpg">
                     </a>

                     <a  href="/restaurants/{{ App\Models\Restaurant::first()->id }}" class="col-md-3">
                        <img style="width: 280px;" src="/images/adv-img-3.jpg">
                     </a>

                     <a  href="/restaurants/{{ App\Models\Restaurant::first()->id }}" class="col-md-3">
                        <img style="width: 280px;" src="/images/adv-img-1.jpg">
                     </a>
                  </div>


                </div>
                <!-- end:Container -->
            </div>


            <div class="result-show">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-3">
                            <p><span class="primary-color"><strong>{{ count($restaurants) }}</strong></span> Results so far </p></div>
                        <p></p>
                        <div class="col-sm-9">
                            <select class="custom-select pull-right">
                                <option selected="">Sort By</option>
                                <option value="1">Distance</option>
                                <option value="2">Delivery Time</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>


            <section class="restaurants-page" style="min-height: 1200px;">
                <div class="container">
                    <div class="row">
                      <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3">
                     <div class="sidebar clearfix m-b-20">
                        <div class="main-block">
                           <div class="sidebar-title white-txt">
                              <h6>Choose Cusine</h6>
                              <i class="fa fa-cutlery pull-right"></i> 
                           </div>
                           <ul>
                              <li><a href="javacript(void)" class="scroll {{ request('cuisine') ==  '' }}">Most Popular</a></li>
                              <li><a href="javacript(void)" class="scroll {{ request('cuisine') ==  '' }}">All Items</a></li>
                              <li><a href="javacript(void)" class="scroll {{ request('cuisine') ==  '' }}">Veg Items</a></li>
                              <li><a href="javacript(void)" class="scroll {{ request('cuisine') ==  '' }}">Non-Veg Items</a></li>
                              @foreach($cuisines as $cuisine)
                              <li><a href="javacript(void)" class="scroll {{ request('cuisine') ==  $cuisine->id ? 'active' : '' }}">{{ $cuisine->name }}</a></li>
                              @endforeach
                           </ul>
                           <div class="clearfix"></div>
                        </div>
                        
                     </div>
                     
                  </div>
                        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-9">

                           @foreach($restaurants as $restaurant)
                               <div class="bg-gray restaurant-entry">
                                   <div class="row">
                                       <div class="col-sm-12 col-md-12 col-lg-8 text-xs-center text-sm-left">
                                           <div class="entry-logo">
                                               <a class="img-fluid" href="#"><img style="height: 120px;" src="{{ url($restaurant->logo) }}" alt="Food logo"></a>
                                           </div>
                                           <!-- end:Logo -->
                                           <div class="entry-dscr">
                                               <h5><a href="#">{{ $restaurant->name }}</a></h5> <span> @foreach($restaurant->cuisines as $cuisine)
                                             {{ $cuisine->name }},  
                                           @endforeach<a href="#">...</a></span>
                                               <ul class="list-inline">
                                                   <li class="list-inline-item"><i class="fa fa-check"></i> Min &#8377; 350</li>
                                                   <li class="list-inline-item"><i class="fa fa-motorcycle"></i> 30 min</li>
                                               </ul>
                                           </div>
                                           <!-- end:Entry description -->
                                       </div>
                                       <div class="col-sm-12 col-md-12 col-lg-4 text-xs-center">
                                           <div class="right-content bg-white">
                                               <div class="right-review">
                                                   <div class="rating-block"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> </div>
                                                   <p> 245 Reviews</p> <a href="/restaurants/{{$restaurant->id}}" class="btn theme-btn-dash">View Menu</a> </div>
                                           </div>
                                           <!-- end:right info -->
                                       </div>
                                   </div>
                                   <!--end:row -->
                               </div>
                           @endforeach 
                            
                        </div>
                    </div>
                </div>
            </section>


@endsection 

