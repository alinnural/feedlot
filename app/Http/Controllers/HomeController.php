<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Feed;
use App\Requirement;

use App\Library\SimplexMethod;
use App\Library\Minimization;
use App\Library\Maximization;

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

    protected $requirement_id;

    public function __construct()
    {
        //$this->middleware('auth');
        $this->requirement_id = "";
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('formula.index');
    }

    public function home()
    {
        return view('home');
    }

    public function input(Request $request)
    {
        $this->requirement_id = $request->session()->get('requirement_id');
        $feeds = Feed::pluck('feed_stuff','id')->all();
        return View('formula.input-feed')->with(compact('feeds'));
    }

    public function calculate_using_minimization_class(Request $request)
    {
        $pakan = $request->input('feeds');
        $feeds = Feed::WhereIn('id',$pakan)->get();

        // $this->print_dump($feeds->);

        foreach($feeds as $f)
        {
            echo $f->id; echo "&nbsp;"; 
            echo $f->feed_stuff; echo "&nbsp;";
            echo $f->dry_matter; echo "&nbsp;";
            echo $f->mineral; echo "&nbsp;";
            echo $f->organic_matter; echo "&nbsp;";
            echo $f->lignin; echo "&nbsp;";
            echo $f->neutral_detergent_fiber; echo "&nbsp;";
            echo $f->ether_extract; echo "&nbsp;";
            echo $f->nonfiber_carbohydrates; echo "&nbsp;";
            echo $f->total_digestible_nutrients; echo "&nbsp;";
            echo $f->metabolizable_energy; echo "&nbsp;";
            echo $f->rumen_undergradable_cp; echo "&nbsp;";
            echo $f->rumen_undergradable_dm; echo "&nbsp;";
            echo $f->rumen_degradable_cp; echo "&nbsp;";
            echo $f->rumen_degradable_dm; echo "&nbsp;";
            echo $f->rumen_soluble; echo "&nbsp;";
            echo $f->rumen_insoluble; echo "&nbsp;";
            echo $f->degradation_rate; echo "&nbsp;";
            echo $f->crude_protein; echo "&nbsp;";
            echo $f->metabolizable_protein; echo "&nbsp;";
            echo $f->calcium; echo "&nbsp;";
            echo $f->phosphorus; echo "&nbsp;";
            echo $f->magnesium; echo "&nbsp;";
            echo $f->potassium; echo "&nbsp;";
            echo $f->sodium; echo "&nbsp;";
            echo $f->sulfur; echo "&nbsp;";
            echo $f->cobalt; echo "&nbsp;";
            echo $f->copper; echo "&nbsp;";
            echo $f->iodine; echo "&nbsp;";
            echo $f->manganese; echo "&nbsp;";
            echo $f->selenium; echo "&nbsp;";
            echo $f->zinc; echo "&nbsp;";
            echo "<br>";
        }

        echo "<br>";
        $this->requirement_id = $request->session()->get('requirement_id');
        $requirement = Requirement::where('id',$this->requirement_id)->get();
        //$this->print_dump($requirement);
        
        foreach($requirement as $req)
        {
            echo $req->animal_type; echo "&nbsp;";
            echo $req->finish; echo "&nbsp;";
            echo $req->current; echo "&nbsp;";
            echo $req->adg; echo "&nbsp;";
            echo $req->dmi; echo "&nbsp;";
            echo $req->tdn; echo "&nbsp;";
            echo $req->nem; echo "&nbsp;";
            echo $req->neg; echo "&nbsp;";
            echo $req->cp; echo "&nbsp;";
            echo $req->ca; echo "&nbsp;";
            echo $req->p; echo "&nbsp;";
            echo $req->month_pregnant; echo "&nbsp;";
            echo $req->month_calvin; echo "&nbsp;";
            echo $req->peak_milk; echo "&nbsp;";
            echo $req->current_milk; echo "&nbsp;";
            echo "<br>";
        }
    }

    /* Sample Optimization using Simplex Method --------------------------------------------*/
    public function sampleIndex()
    {
        return view('sample.index');
    }

    public function SampleInput(Request $request)
    {
        $data = ['var' => $request->get('var'), 'cons'=> $request->get('cons')];
        return view('sample.input')->with('data',$data);
    }

    public function sampleCalculate(Request $request)
    {
        if($request->input('category') == 'maximization')
        {
            $maximization = new Maximization;
            $initial_tableau = $maximization->optimize($request);

            return view('sample.result-maximization',[
                'maximization'=> $maximization 
                ])->with('initial_tableau',$initial_tableau);
        }
        else
        {
            $minimization = new Minimization;
            $initial_tableau = $minimization->optimize($request);

            return view('sample.result-minimization',[
                'minimization'=> $minimization 
                ])->with('initial_tableau',$initial_tableau);
        }
    }

    public function sampleSimplexMethod()
    {
        //$FmyFunctions1 = new SimplexMethod;
        $FmyFunctions1 = new Maximization;
        $is_ok = $FmyFunctions1->index();
        echo $is_ok;
    }
   
    private function print_dump($array)
    {
        echo "<pre>";
        print_r($array);
        die();
    }
}
