<?php

namespace App\Helpers;

use App\Feed;
use App\Requirement;

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

    public static function generate_requirements_using_regression($requirement)
    {
        $requirements = array();

        $requirements[1]=1; //$re->dmi;
        $requirements[2]=$requirement['tdn'];
        $requirements[3]=$requirement['cp'];
        $requirements[4]=$requirement['ca'];
        $requirements[5]=$requirement['p'];
        
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

    public static function mapping_feed_id_result($feeds_id,$feed_price,$result)
    {
        $feeds = Feed::whereIn('id',$feeds_id)->get();
        
        $percent = array();
        $no = 1;
        foreach($feeds as $fee)
        {
            $percent[$no]['name'] = $fee->feed_stuff;
            $percent[$no]['result'] = $result[$no];
            $percent[$no]['price'] = $feed_price[$fee->id];
            $no++;
        }
        return $percent;
    }

    public static function mapping_nutrient_id_result($requirement_id,$result)
    {
        $data = array('Satuan','Total Digestible Nutrient(TDN)','Crude Protein (CP)','Calcium (Ca)','Phosphorus (P)');
        $nutrient = array();
        $no=0;
        foreach($data as $r)
        {
            $nutrient[$no]['name'] = $data[$no];
            $nutrient[$no]['result'] = $result[$no+1];
            $no++;
        }
        return $nutrient;
    }
}