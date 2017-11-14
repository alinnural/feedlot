<?php

namespace App\Helpers;

use App\Feed;
use App\Requirement;
use App\FeedNutrient;

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

    public static function mapping_feed_id_result($feeds_id,$feed_price,$result,$harga_terakhir)
    {
        $percent = array();
        $no = 1;
        foreach($feeds_id as $key => $value)
        {            $feeds = Feed::find($value);
            $percent[$no]['name'] = $feeds->name;
            $percent[$no]['result'] = round($result[$no]*100,2);
            $percent[$no]['price'] = $feed_price[$key];            
            $no++;
        }
        return $percent;
    }

    public static function mapping_nutrient_id_result($feeds,$requirement,$result)
    {
        $no=0;
        foreach($requirement as $req)
        {
            $nutrient[$no]['name'] = $req['name'];
            $nutrient[$no]['min_composition'] = $req['min_composition'];
            $nutrient[$no]['max_composition'] = $req['max_composition'];
            $sum_comp = 0;
            if($req['min_composition'] != 0 || $req['max_composition'] != 0){
                foreach($feeds as $key => $value)
                {
                    $feednuts = FeedNutrient::SearchByNutrientAndFeed($req['id'],$value)->first(); 
                    $temp = $result[$key+1]*$feednuts->composition;
                    $sum_comp += $temp;
                }
            }           
            $nutrient[$no]['result'] = round($sum_comp);
            $no++;
        }
        //print_r($nutrient); exit;
        return $nutrient;
    }
}