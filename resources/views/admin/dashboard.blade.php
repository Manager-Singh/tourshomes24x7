@extends('admin.main')
@section('content')
<!-- Dashboard Statistics starts-->
<div class="statistic-wrap mt-60">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-3 col-md-6 col-12">
                <div class="statistic__item item--red">
                    <h2 class="counter-value">{{$propertyCount}}</h2>
                    <span class="desc">Published Property</span>
                    <div class="icon">
                        <img loading="lazy" src="{{asset('images/dashboard/home.png')}}" alt="...">
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-12">
                <div class="statistic__item item--blue">
                    <h2 class="counter-value">90</h2>
                    <span class="desc">Total Reviews</span>
                    <div class="icon">
                        <img loading="lazy" src="{{asset('images/dashboard/review.png')}}" alt="...">
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-12">
                <div class="statistic__item item--orange">
                    <h2 class="counter-value">result->sum('pageViews')</h2>
                    <span class="desc">Total Views</span>
                    <div class="icon">
                        <img loading="lazy" src="{{asset('images/dashboard/bar-chart.png')}}" alt="...">
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-12">
                <div class="statistic__item item--green">
                    <h2 class="counter-value">{{$newsCount}}</h2>
                    <span class="desc">Published News</span>
                    <div class="icon">
                        <img loading="lazy" src="{{asset('images/dashboard/like.png')}}" alt="...">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Dashboard Statistics ends-->
<!--Dashboard content starts-->
<div class="dash-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-6 col-lg-12">
                <div class="act-title">
                    <h5>Property view Statistics</h5>
                </div>

                    <canvas id="canvas"></canvas>

            </div>
            <div class="col-xl-6 col-lg-12">
                <div class="popular-listing">
                    <div class="act-title">
                        <h5>Popular Properties</h5>
                    </div>
                    <div class="viewd-item-wrap">
                        @foreach($properties->take(3) as $recentlyAddedProperty)
                        <div class="most-viewed-item">
                            <div class="most-viewed-img">
                                <a href="{{route('front.property',['property'=>$recentlyAddedProperty->id])}}">
                                    @if(file_exists( public_path() . '/images/thumbnail/'.$recentlyAddedProperty->thumbnail))
                                        <img loading="lazy" src="{{ URL::asset('/images/thumbnail/'.$recentlyAddedProperty->thumbnail) }}" alt="">
                                    @else
                                        <img loading="lazy" src="{{asset('images/property/property_1.jpg')}}" alt="#">
                                    @endif
                                </a>
                                <ul class="feature_text v2">
                                    <li class="feature_or"><span>{{$recentlyAddedProperty->type == 'sale' ? 'For Sale' : 'For Rent'}}</span></li>
                                </ul>
                            </div>
                            <div class="most-viewed-detail">
                                <h3><a href="{{route('front.property',['property'=>$recentlyAddedProperty->id])}}">{{$recentlyAddedProperty->propertyTranslation->title ?? $recentlyAddedProperty->propertyTranslationEnglish->title  ?? null }}</a></h3>
                                <p class="list-address"><i class="las la-map-marker-alt"></i>{{$recentlyAddedProperty->state->stateTranslation->name ?? $recentlyAddedProperty->state->stateTranslationEnglish->name  ?? null }}, {{$recentlyAddedProperty->city->cityTranslation->name ?? $recentlyAddedProperty->city->cityTranslationEnglish->name  ?? null }}</p>
                                <div class="trend-open">
                                    @if($recentlyAddedProperty->type == 'sale') <p><span class="per_sale">starts from</span>${{$recentlyAddedProperty->price}}</p> @endif
                                    @if($recentlyAddedProperty->type == 'rent') <p>${{$recentlyAddedProperty->price}}<span class="per_month">month</span></p> @endif
                                </div>
                                <div class="ratings">
                                    <i class="ion-ios-star"></i>
                                    <i class="ion-ios-star"></i>
                                    <i class="ion-ios-star"></i>
                                    <i class="ion-ios-star"></i>
                                    <i class="ion-ios-star-half"></i>
                                </div>
                                <div class="views">Views : <span>178</span></div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Dashboard content ends-->
@endsection
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js" charset="utf-8"></script>
<script>
    var url = "{{route('admin.dashboard.chart')}}";
    var Months = new Array();
    var Labels = new Array();
    var PageViews = new Array();
    (function($){
        "use strict";
        $.get(url, function(response){
            response.forEach(function(data){
                const date = new Date(data.date);  // 2009-11-10
                const month = date.toLocaleString('default', { month: 'long' });
                Months.push(month);
                Labels.push(data.pageTitle);
                PageViews.push(data.pageViews);
            });
            var ctx = document.getElementById("canvas").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels:Months,
                    datasets: [{
                        label: 'Page Views',
                        data: PageViews,
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
            });
        });
    })(jQuery);
</script>
@endpush