<?php

namespace App\Helpers;

use App\Feed;
use App\Requirement;
use App\FeedNutrient;
use App\Nutrient;
use Session;

class Calculate{
    /*
     * Generate Array price matching to feed_id
     * $price is array
     * $feed_id is array
     */
    public static function generate_feeds_price($price,$feed_id) 
    {
        $feed_price_id = array();
        for($i=0;$i<count($price);$i++)
        {
            $feed_price_id[$feed_id[$i]] = $price[$i];
        }
        return $feed_price_id;
    }

    public static function generate_feeds($feed)
    {
        $feeds = array();
        $no=1;
        foreach($feed as $value)
        {
            $feeds[$no][1] = 1;//$value->dry_matter;
            $feeds[$no][2] = $value->total_digestible_nutrients;
            $feeds[$no][3] = $value->crude_protein;
            $feeds[$no][4] = $value->calcium;
            $feeds[$no][5] = $value->phosphorus;
            $no++;
        }
        return $feeds;
    }

    public static function generate_requirements($requirement)
    {
        $requirements = array();
        foreach($requirement as $key=>$re)
        {
            $requirements[1]=1; //$re->dmi;
            $requirements[2]=$re->tdn;
            $requirements[3]=$re->cp;
            $requirements[4]=$re->ca;
            $requirements[5]=$re->p;
        }
        return $requirements;
    }

    public static function generate_sign()
    {
        // <option value='lessThan'><=</option>
        // <option value='greaterThan'>>=</option>
        $sign[1] = 'lessThan';
        $sign[2] = 'greaterThan';
        $sign[3] = 'greaterThan';
        $sign[4] = 'greaterThan';
        $sign[5] = 'greaterThan';
        return $sign;
    }

    public static function mapping_feed_id_result($harga_terakhir)
    {
        $max_feed = Session::get('max_feed');
        $min_feed = Session::get('min_feed');
        $feeds_id = Session::get('feeds'); 
        $feed_price = Session::get('harga');
        $result = Session::get('results');        

        $no = 1;
        $total_result_bs = 0;
        foreach($feeds_id as $key => $value)
        {            
            $nilai_bk = FeedNutrient::SearchByNutrientAndFeed(1,$value)->first();            
            $result_bs[$no] = ($result[$no]*100)*100/$nilai_bk->composition;
            $total_result_bs += $result_bs[$no];    
            $no++;
        }

        $percent = array();
        $no = 1;
        $harga_terakhir = 0;
        foreach($feeds_id as $key => $value)
        {            
            $feeds = Feed::find($value);
            $percent[$no]['id'] = $feeds->id;
            $percent[$no]['name'] = $feeds->name;
            $percent[$no]['result'] = round($result_bs[$no]/$total_result_bs*100,2);
            $percent[$no]['price'] = $feed_price[$key]; 
            $harga_terakhir += $percent[$no]['result']/100*$feed_price[$key];   
            $percent[$no]['max_feed'] = $max_feed[$key];   
            $percent[$no]['min_feed'] = $min_feed[$key];     
            $no++;
        }
        Session::put('harga_terakhir',$harga_terakhir);
        return $percent;
    }

    public static function mapping_nutrient_id_result()
    {
        $feeds = Session::get('feeds'); 
        $requirement = Session::get('requirement');
        $result = Session::get('results');
        
        $all_nutrient = Nutrient::all();

        foreach($requirement as $req)
        {
            $reqnut[$req['id']]['min_composition'] = $req['min_composition'];
            $reqnut[$req['id']]['max_composition'] = $req['max_composition'];
        }
        $no=0;
        foreach($all_nutrient as $nut)
        {
            $nutrient[$no]['id'] = $nut['id'];
            $nutrient[$no]['name'] = $nut['name'];
            
            if(empty($reqnut[$nut['id']]))
            {
                $nutrient[$no]['min_composition'] = '-';
                $nutrient[$no]['max_composition'] = '-';
            }
            else
            {
                $nutrient[$no]['min_composition'] = $reqnut[$nut['id']]['min_composition'];
                $nutrient[$no]['max_composition'] = $reqnut[$nut['id']]['max_composition'];
            }

            $sum_comp = 0;
            foreach($feeds as $key => $value)
            {
                $feednuts = FeedNutrient::SearchByNutrientAndFeed($nut['id'],$value)->first(); 
                $temp = $result[$key+1]*$feednuts->composition;
                $sum_comp += $temp;
            }        
            $nutrient[$no]['result'] = round($sum_comp,2);
            $no++;
        }
        //print_r($nutrient); exit;
        Session::put('nutrientresult',$nutrient);  
        return $nutrient;
    }
}