@if(!env('USER_VERIFIED'))
<div class="hero v1 section-padding" style="background-image: url('{{asset('images/header/hero_1.jpg')}}')">
@else
<div class="hero v1 section-padding" style="background-image: url('{{asset('images/header/hero_2.jpg')}}')">
@endif

    <div class="overlay op-3"></div>

    <!--Listing filter starts-->

    <div class="hero-filter">

        <div class="row d-none d-md-block">

            <h1>{{isset($siteInfo->title) ? $siteInfo->title : 'SarchHolm'}}</h1>

        </div>

        <form class="hero__form v1 filter listing-filter" action="{{route('search.property')}}" method="GET">

            <div class="row">

                <div class="col-xl-5 col-lg-6 col-md-6 col-sm-12 col-12 py-3 pl-30 pr-0">

                    <div class="input-search">

                        <input type="text" name="title" id="place-event" placeholder="Enter Property, Location, Landmark ...">

                    </div>

                </div>

                <div class="col-xl-2 col-lg-6 col-md-6 col-sm-12 col-12 py-3 pl-30 pr-0">

                    <select name="state_id" class="hero__form-input  form-control custom-select" id="state">

                        <option value="">Select Area</option>

                        @foreach($states as $state)

                            <option value="{{$state->id}}">{{$state->stateTranslation->name ?? $state->stateTranslationEnglish->name ?? null}}</option>

                        @endforeach

                    </select>

                </div>

                <div class="col-xl-2 col-lg-6 col-md-6 col-sm-12 col-12 py-3 pl-30 pr-0">

                    <select name="city_id" class="hero__form-input  form-control custom-select" id="city">

                    </select>

                </div>

                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12 py-3 pl-30 pr-0">

                    <div class="submit_btn">

                        <button class="btn v3" type="submit">Search</button>

                    </div>

                    <div class="dropdown-filter"><i class="las la-sliders-h"></i></div>

                </div>

                <div class="explore__form-checkbox-list full-filter">

                    <div class="row">

                        <div class="col-lg-4 col-md-6 py-1 pr-30">

                            <select class="hero__form-input  form-control custom-select mb-20" name="type">

                                <option value="">Property Status</option>
                                <option value="rent">For Rent</option>

                                <option value="sale">For Sale</option>

                            </select>

                        </div>

                        <div class="col-lg-4 col-md-6 py-1 pr-30 pl-0 ">

                            <select name="category_id" class="hero__form-input  form-control custom-select  mb-20">

                                <option value="">Property Type</option>

                                @foreach($categories as $category)

                                    <option value="{{$category->id}}">{{$category->categoryTranslation->name ?? $category->categoryTranslationEnglish->name ?? null}}</option>

                                @endforeach

                            </select>

                        </div>

                        <div class="col-lg-4 col-md-6 py-1 pl-0">

                            <select class="hero__form-input  form-control custom-select  mb-20">

                                <option value="">Max rooms</option>

                                <option value="1">1</option>

                                <option value="2">2</option>

                                <option value="3">3</option>

                                <option value="4">4</option>

                                <option value="5">5</option>

                                <option value="6">6</option>

                                <option value="7">7</option>

                            </select>

                        </div>

                        <div class="col-lg-4 col-md-6 py-1 pr-30 ">

                            <select class="hero__form-input  form-control custom-select  mb-20" name="bed">

                                <option value="">Bed</option>

                                <option value="1">1</option>

                                <option value="2">2</option>

                                <option value="3">3</option>

                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>

                            </select>

                        </div>

                        <div class="col-lg-4 col-md-6 py-1 pr-30 pl-0">

                            <select class="hero__form-input  form-control custom-select  mb-20" name="bath">

                                <option value="">Bath</option>

                                <option value="1">1</option>

                                <option value="2">2</option>

                                <option value="3">3</option>

                                <option value="4">4</option>

                            </select>

                        </div>

                        <div class="col-lg-4 col-md-6 py-1 pl-0">

                            <select class="hero__form-input  form-control custom-select  mb-20" name="agent_id">

                                <option>Agents</option>

                                @foreach($agents as $agent)

                                    <option value="{{$agent->id}}">{{$agent->f_name}} {{$agent->l_name}}</option>

                                @endforeach

                            </select>

                        </div>

                    </div>

                </div>

            </div>

        </form>


    </div>

    <!--Listing filter ends-->

</div>
