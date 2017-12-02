<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests;
use Spatie\Analytics\Period;
use Analytics;
use Carbon\Carbon;
use App\Post;
use App\Page;
use App\Menu;
use App\Album;
use App\Image;
use App\Social;
use App\Library\Curl;

class HomeController extends Controller
{
    /**
   * Display a listing of the posts.
   */
    public function index()
    {
        $post = Post::count();
        $page = Page::count();
        $menu = Menu::count();
        $album = Album::count();
        $image = Image::count();
        $social = Social::count();
        return view('admin.home.index')
            ->with(compact('post'))
            ->with(compact('page'))
            ->with(compact('menu'))
            ->with(compact('album'))
            ->with(compact('image'))
            ->with(compact('social'));
    }

    public function AjaxGetVisitorAndViews()
    {
        /*
        [{
            label: 'PageViews',
            data: [{
                x: 1,
                y: 0
            }, {
                x: 2,
                y: 10
            }, {
                x: 3,
                y: 5
            }]
        },
        {
            label: 'Visitor',
            data: [{
                x: 1,
                y: 1
            }, {
                x: 2,
                y: 3
            }, {
                x: 3,
                y: 4
            }]
        }]
        */
        $startDate = Carbon::now()->subMonth();
        $endDate = Carbon::now();
        $period = Period::create($startDate, $endDate);
        $periode = Analytics::fetchTotalVisitorsAndPageViews($period);
        $visitor = array();
        foreach($periode as $key => $b)
        {
            $visitor['visitor'][$key]['x'] = $b['date']->toDateString();
            $visitor['pageViews'][$key]['x'] = $b['date']->toDateString();
            $visitor['visitor'][$key]['y'] = $b['visitors'];
            $visitor['pageViews'][$key]['y'] = $b['pageViews'];
        }
        

        $hasil = [
            [
                'label'=> 'Visitors',
                'data' => $visitor['visitor'],
                'backgroundColor' => "rgba(179,181,198,0.2)",
                'borderColor' => "rgba(179,181,198,1)"
            ],
            [
                'label'=> 'PageViews',
                'data' => $visitor['pageViews'],
                'backgroundColor'=> "rgba(255,99,132,0.2)",
                'borderColor'=> "rgba(255,99,132,1)",
            ]
        ];
        return json_encode($hasil);
    }

    public function changelog()
    {
        // a simple way to get a user's repo
        $res = Curl::curl_get_contents("https://api.github.com/repos/ihsanarifr/manajemen/releases");
        $res = json_decode($res);
        return view('admin.home.changelog')->with(compact('res'));
    }
}
