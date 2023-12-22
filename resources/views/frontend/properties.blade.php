@extends('frontend.main')
@section('title','SarchHolm-Properties')
@push('styles')
<link href="{{asset('css/leaflet.css')}}" rel="stylesheet" />
<style>
    .load-overlay{
        display: none;
        position: fixed;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        z-index: 999;
        background: rgba(255,255,255,0.8) url({{asset('images/breadcrumb/loader3.gif')}}) center no-repeat;
    }
    /* Turn off scrollbar when body element has the loading class */
    body.loading{
        overflow: hidden;
    }
    /* Make spinner image visible when body element has the loading class */
    body.loading .load-overlay{
        display: block;
    }
</style>
@endpush
@section('content')
    <!--Listing section starts-->
    <div class="filter-wrapper style1 mt-115 half-map">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-7 col-lg-12">
                    <div class="map-sidebar-content">
                        <div class="row align-items-center">
                            <div class="col-lg-3 col-sm-5 col-5 d-none d-md-block">
                                <div class="item-view-mode res-box">
                                    <!-- item-filter-list Menu starts -->
                                    <ul class="nav item-filter-list" role="tablist">
                                        <li><a data-toggle="tab" href="#grid-view"><i class="las la-th-large"></i></a></li>
                                        <li><a class="active" data-toggle="tab" href="#list-view"><i class="las la-list"></i></a></li>
                                    </ul>
                                    <!-- item-filter-list Menu ends -->
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-7 col-7">
                                <select class="listing-input hero__form-input  form-control custom-select">
                                    <option>Sort by Newest</option>
                                    <option>Sort by Oldest</option>
                                    <option>Sort by Featured</option>
                                    <option>Sort by Price(Low to High)</option>
                                    <option>Sort by Price(Low to High)</option>
                                </select>
                            </div>
                            <div class="col-lg-5 col-sm-12">
                                <div class="item-element res-box  text-right sm-left">
                                    <p>Showing <span> {{($properties->currentPage()-1)* $properties->perPage()+($properties->total() ? 1:0)}} to {{($properties->currentPage()-1)*$properties->perPage()+count($properties)}}  of  {{$properties->total()}}</span>  Listings</p>
                                </div>
                            </div>
                        </div>
                        <form class="hero__form v1 filter map-filter pt-30     ">
                            <div class="row">
                                <div class="col-lg-8 col-md-7 col-sm-6 col-12">
                                    <div class="input-search">
                                        <input type="text" name="place-event" id="place-event" placeholder="Search by city or Address...">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-4 col-10 pl-0">
                                    <select class="hero__form-input  form-control custom-select">
                                        <option>For Rent </option>
                                        <option>For Sale </option>
                                        <option>All </option>
                                    </select>
                                </div>
                                <div class="col-lg-1 col-md-2 col-sm-2 col-2 pl-0">
                                    <div class="filter-sub-menu style1 v1">
                                        <div class="dropdown-filter"><i class="las la-cog"></i></div>
                                    </div>
                                </div>
                                <div class="explore__form-checkbox-list full-filter">
                                    <div class="row">
                                        <div class="col-md-4 col-sm-12 mb-15 pr-0">
                                            <select class="hero__form-input  form-control custom-select">
                                                <option>Property Type</option>
                                                <option>Residential</option>
                                                <option>Commercial</option>
                                                <option>Land</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 col-sm-6 mb-15 pr-0">
                                            <select class="hero__form-input  form-control custom-select  ">
                                                <option>Bed</option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 col-sm-6 mb-15">
                                            <select class="hero__form-input  form-control custom-select  ">
                                                <option>Baths</option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="filter-sub-area style1">
                                                <div class="filter-title mb-10">
                                                    <p>Price : <span><input type="text" id="amount_two"></span></p>
                                                </div>
                                                <div id="slider-range_two" class="price-range mb-30">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="filter-sub-area style1">
                                                <div class="filter-title  mb-10">
                                                    <p>Area : <span><input type="text" id="amount_one"></span></p>
                                                </div>
                                                <div id="slider-range_one" class="price-range mb-30">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="filter-checkbox mb-3">
                                                <p>Sort By Features</p>
                                                <ul>
                                                    <li>
                                                        <input id="check-a" type="checkbox" name="check">
                                                        <label for="check-a">Air Condition</label>
                                                    </li>
                                                    <li>
                                                        <input id="check-b" type="checkbox" name="check">
                                                        <label for="check-b">Swimming Pool</label>
                                                    </li>
                                                    <li>
                                                        <input id="check-c" type="checkbox" name="check">
                                                        <label for="check-c">Laundry Room</label>
                                                    </li>
                                                    <li>
                                                        <input id="check-d" type="checkbox" name="check">
                                                        <label for="check-d">Free Wifi</label>
                                                    </li>
                                                    <li>
                                                        <input id="check-e" type="checkbox" name="check">
                                                        <label for="check-e">Window Covering</label>
                                                    </li>
                                                    <li>
                                                        <input id="check-f" type="checkbox" name="check">
                                                        <label for="check-f">Central Heating </label>
                                                    </li>
                                                    <li>
                                                        <input id="check-g" type="checkbox" name="check">
                                                        <label for="check-g">24 hour security</label>
                                                    </li>
                                                    <li>
                                                        <input id="check-h" type="checkbox" name="check">
                                                        <label for="check-h">Lawn</label>
                                                    </li>
                                                    <li>
                                                        <input id="check-i" type="checkbox" name="check">
                                                        <label for="check-i">Gym</label>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <a href="#" class="btn v3">Apply Filters</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="item-wrapper pt-20">
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade  property-grid" id="grid-view">
                                    <div class="row">
                                        @foreach($properties as $property)

                                            <div class="col-md-6 col-sm-12">
                                                <div class="single-property-box">
                                                    <div class="property-item">
                                                        <a class="property-img" href="{{route('front.property',['property'=>$property->id])}}">
                                                            <img loading="lazy" src="{!! $property->photo() !!}" alt="">
                                                        </a>
                                                        <ul class="feature_text">
                                                            @if($property->is_featured == 1)<li class="feature_cb"><span> Featured</span></li>@endif
                                                            @if($property->type == 'sale')<li class="feature_or"><span>For Sale</span></li>@endif
                                                            @if($property->type == 'rent')<li class="feature_or"><span>For Rent</span></li>@endif
                                                        </ul>
                                                        <div class="property-author-wrap">
                                                            <a href="{{route('agents.show',$property->user_id)}}" class="property-author">
                                                                <img loading="lazy" src="{!! $property->user->photo() !!}" alt="">
                                                                <span>{{$property->user->f_name}} {{$property->user->l_name}}</span>
                                                            </a>
                                                            <a href=".photo-gallery" class="btn-gallery" data-toggle="tooltip" data-placement="top" title="Photos"><i class="lnr lnr-camera"></i></a>
                                                            <div class="hidden photo-gallery">
                                                                @php
                                                                    $pic = json_decode($property->image->name);
                                                                @endphp
                                                                @foreach($pic as $p)
                                                                    <a href="{{ URL::asset("storage/images/".$p)}}"></a>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="property-title-box">
                                                        <h4><a href="{{route('front.property',['property'=>$property->id])}}">{{isset($property->propertyTranslation->title) ? $property->propertyTranslation->title : 'title'}}</a></h4>
                                                    </div>
                                                    <div class="property-location">
                                                        <i class="las la-map-marker-alt"></i>
                                                        <p>{{$property->country->countryTranslation->name ?? $property->country->countryTranslationEnglish->name ?? null}} , {{$property->state->stateTranslation->name ?? $property->state->stateTranslationEnglish->name ?? null}}, {{$property->city->cityTranslation->name ?? $property->city->cityTranslationEnglish->name ?? null}}</p>
                                                    </div>
                                                    <ul class="property-feature">
                                                        <li> <i class="las la-bed"></i>
                                                            <span>{{$property->propertyDetails->bed}} Bedrooms</span>
                                                        </li>
                                                        <li> <i class="las la-bath"></i>
                                                            <span>{{$property->propertyDetails->bath}} Bath</span>
                                                        </li>
                                                        <li> <i class="las la-arrows-alt"></i>
                                                            <span>{{$property->propertyDetails->room_size}} sq ft</span>
                                                        </li>
                                                        <li> <i class="las la-car"></i>
                                                            <span>{{$property->propertyDetails->garage}} Garage</span>
                                                        </li>
                                                    </ul>
                                                    <div class="trending-bottom trend-open">
                                                        @if($property->type == 'sale') <p><span class="per_sale">starts from</span>${{$property->price}}</p> @endif
                                                        @if($property->type == 'rent') <p>${{$property->price}}<span class="per_month">month</span></p> @endif
                                                    </div>
                                                </div>
                                            </div>

                                        @endforeach
                                    </div>
                                </div>
                                <div class="tab-pane fade show active  property-list get-properties" id="list-view">
                                    @foreach($properties as $property)
                                        <div class="single-property-box">
                                            <div class="row">
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="property-item">
                                                        <a class="property-img" href="{{route('front.property',['property'=>$property->id])}}">
                                                            <img loading="lazy" src="{!! $property->photo() !!}" alt="">
                                                        </a>
                                                        <ul class="feature_text">
                                                            @if($property->is_featured == 1)<li class="feature_cb"><span> Featured</span></li>@endif
                                                            @if($property->type == 'sale')<li class="feature_or"><span>For Sale</span></li>@endif
                                                            @if($property->type == 'rent')<li class="feature_or"><span>For Rent</span></li>@endif
                                                        </ul>
                                                        <div class="property-author-wrap">
                                                            <a href="{{route('agents.show',$property->user_id)}}" class="property-author">
                                                                <img loading="lazy" src="{!! $property->user->photo() !!}" alt="">
                                                                <span>{{$property->user->f_name}} {{$property->user->l_name}}</span>
                                                            </a>
                                                            <a href=".photo-gallery" class="btn-gallery" data-toggle="tooltip" data-placement="top" title="Photos"><i class="lnr lnr-camera"></i></a>
                                                            <div class="hidden photo-gallery">
                                                                @php
                                                                    $pic = json_decode($property->image->name);
                                                                @endphp
                                                                @foreach($pic as $p)
                                                                    <a href="{{ URL::asset("storage/images/".$p)}}"></a>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="property-title-box">
                                                        <h4><a href="{{route('front.property',['property'=>$property->id])}}">{{$property->propertyTranslation->title ?? $property->propertyTranslationEnglish->title ?? null}}</a></h4>
                                                        <div class="property-location no-pad-lr">
                                                            <i class="las la-map-marker-alt"></i>
                                                            <p>{{$property->country->countryTranslation->name ?? $property->country->countryTranslationEnglish->name ?? null}} , {{$property->state->stateTranslation->name ?? $property->state->stateTranslationEnglish->name ?? null}}, {{$property->city->cityTranslation->name ?? $property->city->cityTranslationEnglish->name ?? null}}</p>
                                                        </div>
                                                        <ul class="property-feature no-pad-lr">
                                                            <li> <i class="las la-bed"></i>
                                                                <span>{{$property->propertyDetails->bed}} Bedrooms</span>
                                                            </li>
                                                            <li> <i class="las la-bath"></i>
                                                                <span>{{$property->propertyDetails->bath}} Bath</span>
                                                            </li>
                                                            <li> <i class="las la-arrows-alt"></i>
                                                                <span>{{$property->propertyDetails->room_size}} sq ft</span>
                                                            </li>
                                                            <li> <i class="las la-car"></i>
                                                                <span>{{$property->propertyDetails->garage}} Garage</span>
                                                            </li>
                                                        </ul>
                                                        <div class="trending-bottom trend-open no-pad-lr">
                                                            @if($property->type == 'sale') <p><span class="per_sale">starts from</span>${{$property->price}}</p> @endif
                                                            @if($property->type == 'rent') <p>${{$property->price}}<span class="per_month">month</span></p> @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <!--pagination starts-->
                            {{ $properties->links('vendor.pagination.custom') }}
                            <!--pagination ends-->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="explore__map-side">
                    <!--Leaflet Map starts-->
                    <div id="map-container" class="fullwidth-home-map">
                        <div id="map" data-map-scroll="false">
                            <!-- map goes here -->
                        </div>
                    </div>
                    <!--Leaflet Map ends-->
                </div>
            </div>
        </div>
    </div>
    <!--Listing section ends-->
    <!--Blog section ends-->
    <div class="load-overlay"></div>
@endsection
@push('script')
<!-- Leaflet js -->
    <script src="{{asset('js/leaflet.min.js')}}"></script>
    <!-- Leaflet Maps Scripts -->
    <script src="{{asset('js/leaflet-markercluster.min.js')}}"></script>
    <script src="{{asset('js/leaflet-gesture-handling.min.js')}}"></script>
    <script src="{{asset('js/leaflet-custom.js')}}"></script>
    <script src="{{asset('js/leaflet-autocomplete.js')}}"></script>
    <script src="{{asset('js/leaflet-control-geocoder.js')}}"></script>


    <script>
        $('#place-event').on('keyup',function(){
            var search = $(this).val();
            $.ajax({
                method:'post',
                url: '{{route('search.properties')}}',
                data: {search:search,"_token":"{{csrf_token()}}"},
                dataType:'html',
                success:function(response){
                    $('.get-properties').html(response);
                }
            });
        });

        // Add remove loading class on body element based on Ajax request status
        $(document).on({
            ajaxStart: function(){
                $("body").addClass("loading");
            },
            ajaxStop: function(){
                $("body").removeClass("loading");
            }
        });
    </script>
@endpush
