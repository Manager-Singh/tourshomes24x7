<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Property;
use App\Models\PropertyTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class PropertyController extends Controller
{
    public function index()
    {
        App::setLocale(Session::get('currentLocal'));
        Session::get('currentLocal');
        $properties = Property::with(['propertyDetails','user','category.categoryTranslation','country.countryTranslation','state.stateTranslation','city.cityTranslation','propertyTranslation','image'])
            ->where('moderation_status',1)
            ->where('status',1)
            ->orderBy('id','desc')
            ->paginate(4);
        return view('frontend.properties',compact('properties'));
    }

    public function singleProperty(Property $property)
    {

        $properties = Property::with(['facilities.facilityTranslation','user','category.categoryTranslation','country.countryTranslation','state.stateTranslation','city.cityTranslation','propertyTranslation','propertyTranslationEnglish','image','propertyDetails'])->where('moderation_status',1)->get();
        $locale   = Session::get('currentLocal');
        $propertyTranslation = PropertyTranslation::where('locale',$locale)->get()->keyBy('property_id');
        $propertyTranslationEnglish = PropertyTranslation::where('locale','en')->get()->keyBy('property_id');
        return view('frontend.property',compact('property','properties','propertyTranslation','propertyTranslationEnglish'));
    }

    public function searchProperties(Request $request)
    {
        $properties = Property::whereHas('propertyTranslation', function($query) use ($request){
                $query->where('title','LIKE','%'.$request->search.'%');
            })
            ->where('moderation_status',1)
            ->orderBy('id','desc')
            ->get();
    if(count($properties)>0)
    {
        foreach($properties as $property)
        {
            $html = '
            <div class="single-property-box">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="property-item">
                            <a class="property-img" href="'.route('front.property',['property'=>$property->id]).'">
                                <img src="storage/thumbnail/'.$property->thumbnail.'">
                            </a>
                            <ul class="feature_text">
                                '.($property->is_featured == 1 ? "<li class=\"feature_cb\"><span> Featured</span></li>" : "").'
                                '.($property->type == "sale" ? "<li class=\"feature_or\"><span>For Sale</span></li>" : "").'
                                '.($property->type == "rent" ? "<li class=\"feature_or\"><span>For Rent</span></li>" : "").'
                            </ul>
                            <div class="property-author-wrap">
                                <a href="#" class="property-author">
                                   <img src="images/agents/agent_1.jpg">
                                    <span>'.$property->user->f_name.' '.$property->user->l_name.'</span>
                                </a>
                                <ul class="save-btn">
                                    <li data-toggle="tooltip" data-placement="top" title="Photos"><a href=".photo-gallery" class="btn-gallery"><i class="lnr lnr-camera"></i></a></li>
                                    <li data-toggle="tooltip" data-placement="top" title="" data-original-title="Bookmark"><a href="#"><i class="lnr lnr-heart"></i></a></li>
                                </ul>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="property-title-box">
                            <h4><a href="'.route('front.property',['property'=>$property->id]).'">'.$property->propertyTranslation->title
                .'</a></h4>
                            <div class="property-location">
                                <i class="la la-map-marker-alt"></i>
                                <p>'.$property->country->countryTranslation->name.','.$property->state->stateTranslation->name.','.$property->city->cityTranslation->name.'</p>
                            </div>
                            <ul class="property-feature">
                                <li> <i class="las la-bed"></i>
                                    <span>'.$property->propertyDetails->bed.' Bedrooms</span>
                                </li>
                                <li> <i class="las la-bath"></i>
                                    <span>'.$property->propertyDetails->bath.' Bath</span>
                                </li>
                                <li> <i class="las la-arrows-alt"></i>
                                    <span>'.$property->propertyDetails->room_size.' sq ft</span>
                                </li>
                                <li> <i class="las la-car"></i>
                                    <span>'.$property->propertyDetails->garage.' Garage</span>
                                </li>
                            </ul>
                            <div class="trending-bottom">
                                <div class="trend-left float-left">
                                    <ul class="product-rating">
                                        <li><i class="las la-star"></i></li>
                                        <li><i class="las la-star"></i></li>
                                        <li><i class="las la-star"></i></li>
                                        <li><i class="las la-star-half-alt"></i></li>
                                        <li><i class="las la-star-half-alt"></i></li>
                                    </ul>
                                </div>
                                <a class="trend-right float-right">
                                    <div class="trend-open">
                                        <p><span class="per_sale">starts from</span>$'.$property->price.'</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            ';

            echo $html;
        }
    }else{
        $html = '<div class="row">
                <h3>No Results Found!</h3>
                 </div>
                ';
        echo $html;
    }

    }

    public function rent()
    {
        App::setLocale(Session::get('currentLocal'));
        Session::get('currentLocal');
        $properties = Property::with(['propertyDetails','user','category.categoryTranslation','country.countryTranslation','state.stateTranslation','city.cityTranslation','propertyTranslation','image'])
            ->where('moderation_status',1)
            ->where('type','rent')
            ->orderBy('id','desc')
            ->paginate(4);
        return view('frontend.properties-sale-rent',compact('properties'));
    }
    public function sale()
    {
        App::setLocale(Session::get('currentLocal'));
        Session::get('currentLocal');
        $properties = Property::with(['propertyDetails','user','category.categoryTranslation','country.countryTranslation','state.stateTranslation','city.cityTranslation','propertyTranslation','image'])
            ->where('moderation_status',1)
            ->where('type','sale')
            ->orderBy('id','desc')
            ->paginate(4);
        return view('frontend.properties-sale-rent',compact('properties'));
    }

    public function getAllProperties()
    {
        $properties = Property::with(['propertyDetails','user','category.categoryTranslation','country.countryTranslation','state.stateTranslation','city.cityTranslation','propertyTranslation','image'])
            ->where('moderation_status',1)
            ->orderBy('id','desc')
            ->get();

        return $properties;
    }

    public function city(City $city)
    {
//        dd($city->properties);
        return view('frontend.properties-city',compact('city'));
    }
}
