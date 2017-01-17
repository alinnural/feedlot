<?php

namespace App\Helpers;

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
            $feeds[$no][1] = $value->dry_matter;
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
            $requirements[1]=$re->dmi;
            $requirements[2]=$re->tdn;
            $requirements[3]=$re->cp;
            $requirements[4]=$re->ca;
            $requirements[5]=$re->p;
        }
        return $requirements;
    }
}