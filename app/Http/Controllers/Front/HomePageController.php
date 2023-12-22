<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\Facility;
use App\Models\Image;
use App\Models\OurPartner;
use App\Models\Package;
use App\Models\Property;
use App\Models\PropertyDetail;
use App\Models\PropertyTranslation;
use App\Models\SiteInfo;
use App\Models\State;
use App\Models\Testimonial;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class HomePageController extends Controller
{
    public function __construct()
    {
        Session::put('currentLocal', 'en');
        App::setLocale('en');
    }

    public function index()
    {
        App::setLocale(Session::get('currentLocal'));
        $locale   = Session::get('currentLocal');

        $properties = Property::where('moderation_status',1)
                        ->where('status',1)
                        ->get();
        foreach ($properties as $row)
        {
            $currentTime = Carbon::now();
            $end_time = new Carbon($row->package->expire_at);
            if($currentTime > $end_time)
            {
                $row->status = 0;
                $row->save();
            }
        }
        $propertyDetails = PropertyDetail::get()->keyBy('property_id');
        $country = Country::with('countryTranslation')->get()->keyBy('id');
        $city = City::with('cityTranslation')->get()->keyBy('id');
        $agents = User::get()->keyBy('id');
        $users = User::where('type','user')->get()->keyBy('id');
        $states = State::with('stateTranslation')->where('status',1)->get()->keyBy('id');
        $propertyTranslation = PropertyTranslation::where('locale',$locale)->get()->keyBy('property_id');
        $propertyTranslationEnglish = PropertyTranslation::where('locale','en')->get()->keyBy('property_id');
        $categories = Category::with('categoryTranslation')->where('status',1)->get()->keyBy('id');
        $image = Image::get()->keyBy('property_id');
        $facilities = Facility::get();
        $siteInfo = SiteInfo::first();
        $newses = Blog::with('blogTranslation','user')->where('status','approved')->orderBy('id','desc')->paginate(4);
        $popularTopics = BlogCategory::with('blogCategoryTranslation','blogs')->where('status',1)->get()->keyBy('id');
        return view('frontend.index',compact('properties','propertyDetails','country','city','agents','users','states','categories','propertyTranslation','propertyTranslationEnglish','image','locale','facilities','siteInfo','newses','popularTopics'));
    }

    public function about()
    {
        $testimonials = Testimonial::with(['testimonialTranslation','testimonialTranslationEnglish'])
            ->orderBy('id','DESC')
            ->get();
        $partners = OurPartner::all();
        $agents = User::where('type','user')->get();
        return view('frontend.about',compact('testimonials','partners','agents'));
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function errorPage()
    {
        return view('frontend.404-page');
    }


    public function membershipPackage()
    {
        $packages = Package::with('packageTranslation')->orderBy('id','DESC')->get();
        return view('frontend.membership-package',compact('packages'));
    }


    public function addListing()
    {
        return view('frontend.add-listing');
    }

    public function getCity(Request $request)
    {
        $cities = City::where('state_id',$request->state)->get();
        echo '<option value="0">Select City</option>';
        foreach ($cities as $city){
            echo '<option value="'.$city->id.'">'.$city->name.'</option>';
        }
    }

    public function searchProperty(Request $request)
    {
      Session::get('currentLocal');
      $title = $request->input('title');
      $state = $request->input('state_id');
      $city = $request->input('city_id');
      $type = $request->input('type');
      $bed = $request->input('bed');
      $bath = $request->input('bath');
      $agent = $request->input('agent_id');
      $price['minPrice'] = $request->input('minval');
      $price['maxPrice'] = $request->input('maxval');

      $properties = Property::with('propertyTranslation','propertyDetails','country.countryTranslation','state.stateTranslation','city.cityTranslation','category.categoryTranslation')
      ->when($agent,function($query,$agent){
          return $query->where('user_id',$agent);
      })
      ->when($title,function($query,$title){
           $query->whereHas('propertyTranslation',function($query) use($title){
            return $query->where('title','LIKE','%'.$title.'%')->where('locale',Session::get('currentLocal'));
          });
      })
      ->when($state,function($query,$state){
          $query->whereHas('state', function($query) use ($state){
              $query->whereHas('stateTranslation',function($query) use ($state){
                return  $query->where('state_id',$state);
              });
          });
      })
      ->when($city,function($query,$city){
          $query->whereHas('city', function($query) use ($city){
              $query->whereHas('cityTranslation',function($query) use ($city){
                  return  $query->where('city_id',$city);
              });
          });
      })
      ->when($type,function($query,$type){
          return $query->where('type',$type);
      })
      ->when($bed,function($query,$bed){
         $query->whereHas('propertyDetails',function($query) use($bed){
            return $query->where('bed',$bed);
        });
      })
      ->when($bath,function($query,$bath){
          $query->whereHas('propertyDetails',function($query) use($bath){
              return $query->where('bath',$bath);
          });
      })
      ->when($price,function($query,$price){
          return $query->whereBetween('price',[$price['minPrice'],$price['maxPrice']]);
      })
      ->where('moderation_status',1)->get();

        $selected_id = [];
        $selected_id['state_id'] = $request->state_id;
        $selected_id['city_id'] = $request->city_id;

        return view('frontend.get-property',compact('properties','selected_id'));
    }

    public function photo()
    {
        if (file_exists( public_path().'/storage/thumbnail/'.$this->thumbnail)) {
            return 'images/property/property_1.jpg';
        } else {
            return 'images/property/property_1.jpg';
        }
    }
}
