<?php

namespace App\Http\Controllers;

use PDF;
use Auth;
use Session;
use App\Feed;
use App\Post;
use App\Forsum;
use App\Slider;
use App\Setting;
use App\GroupFeed;
use Carbon\Carbon;
use App\ForsumFeed;
use App\Requirement;
use App\FeedNutrient;
use App\Helpers\Curl;
use App\ForsumNutrient;
use App\Helpers\Calculate;
use App\RequirementNutrient;
use Illuminate\Http\Request;
use App\Library\Minimization;
use App\Library\Maximization;
use App\Library\SimplexMethod;
use App\Library\MinimizationFeedlot;

/*
source : https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md
Aturan Pembuatan Program
1. Methode harus menggunakan style camelcase example : indahnyaKebersamanaan
2. Class harus menggungakan style camelcase example : HomeController
3. Penggunaan variable harus menggunakan style underscore
*/

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home.index');
    }

    public function beranda()
    {
        $sliders = Slider::where('is_active',1)->orderBy('id','desc')
                        ->take(config('configuration.paging_slider'))
                        ->get();

        $posts = Post::where('is_draft',0)
                    ->orderBy('published_at', 'desc')
                    ->paginate(config('configuration.paging_news'))
                    ->setPath('post');

        return view('home.beranda')
                    ->with(compact('posts'))
                    ->with(compact('sliders'));
    }

    public function home()
    {
        return view('home.index');
    }

    public function about()
    {
        return view('home.about');
    }

    public function contact()
    {
        return view('home.contact');
    }

    public function changelog()
    {
        // a simple way to get a user's repo
        $res = Curl::curl_get_contents("https://api.github.com/repos/ihsanarifr/feedlot/releases");
        $res = json_decode($res);
        return view('home.changelog')->with(compact('res'));
    }  

    //====================================================================================
    /*
        using nutrient group show
    */
    public function groupFeeds($id)
    {
        $groupfeed = GroupFeed::find($id);
        $feeds = $groupfeed->feeds()->where('is_public',1)->orderBy('urutan','asc')->paginate(5);
        
        return view('feeds.group-feeds')
            ->with(compact('feeds'))
            ->with(compact('groupfeed'));
    }

    public function explore()
    {
        $feeds = Feed::where('is_public',1)->orderBy('urutan','asc')->paginate(5);
        return view('feeds.explore')
                ->with(compact('feeds'));
    }

    public function showFeed($id)
    {
        $feed = Feed::find($id);
        $nutrients = $feed->feednutrients()->with('nutrient')->get();

        return view('feeds.show')
                ->with(compact('feed'))
                ->with(compact('nutrients'));
    }
}
