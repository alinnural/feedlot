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

    public static function array_transpose($array, $selectKey = false) 
    {
        if (!is_array($array)) return false;
        $return = array();
        foreach($array as $key => $value) {
            if (!is_array($value)) return $array;
            if ($selectKey) {
                if (isset($value[$selectKey])) $return[] = $value[$selectKey];
            } else {
                foreach ($value as $key2 => $value2) {
                    $return[$key2][$key] = $value2;
                }
            }
        }
        return $return;
    } 

    public static function modified_feed($array)
    {
        $feed = [
            [
                'name' =>'Total Digestible Nutrient',
                'singkatan'=>'TDN',
                'satuan'=>'%DM',
                'jumlah'=> number_format((float)$array->total_digestible_nutrients,2,'.',''),
            ],
            [
                'name' =>'Crude Protein',
                'singkatan'=>'CP',
                'satuan'=>'%DM',
                'jumlah'=>number_format((float)$array->crude_protein,2,'.',''),
            ],
            [
                'name' =>'Calcium',
                'singkatan'=>'Ca',
                'satuan'=>'%DM',
                'jumlah'=>number_format((float)$array->calcium,2,'.',''),
            ],
            [
                'name' =>'Phosphorus',
                'singkatan'=>'P',
                'satuan'=>'%DM',
                'jumlah'=>number_format((float)$array->phosphorus,2,'.',''),
            ],
            [
                'name' =>'Dry Matter',
                'singkatan'=>'DM',
                'satuan'=>'%',
                'jumlah'=> number_format((float)$array->dry_matter,2,'.',''),
            ],
            [
                'name' =>'Mineral',
                'singkatan'=>'Ash',
                'satuan'=>'%DM',
                'jumlah'=>number_format((float)$array->mineral,2,'.',''),
            ],
            [
                'name' =>'Organic Matter',
                'singkatan'=>'OM',
                'satuan'=>'%DM',
                'jumlah'=>number_format((float)$array->organic_matter,2,'.',''),
            ],
            [
                'name' =>'Lignin',
                'singkatan'=>'Lig',
                'satuan'=>'%DM',
                'jumlah'=>number_format((float)$array->lignin,2,'.',''),
            ],
            [
                'name' =>'Neutral Detergent Fiber',
                'singkatan'=>'NDF',
                'satuan'=>'%DM',
                'jumlah'=>number_format((float)$array->neutral_degergent_fiber,2,'.',''),
            ],
            [
                'name' =>'Ether Extract',
                'singkatan'=>'EE',
                'satuan'=>'%DM',
                'jumlah'=>number_format((float)$array->ether_extract,2,'.',''),
            ],
            [
                'name' =>'Metabolizable Energy',
                'singkatan'=>'ME',
                'satuan'=>'Mcal/kg',
                'jumlah'=> number_format((float)$array->metabolizable_energy,2,'.',''),
            ],
            [
                'name' =>'Rumen Degradable Protein',
                'singkatan'=>'RDN',
                'satuan'=>'%DM',
                'jumlah'=>number_format((float)$array->rumen_degradable_dm,2,'.',''),
            ],
            [
                'name' =>'Rumen Degradable Protein',
                'singkatan'=>'RDN',
                'satuan'=>'%CP',
                'jumlah'=>number_format((float)$array->rumen_degradable_cp,2,'.',''),
            ],
            [
                'name' =>'Rumen Undergradable Protein',
                'singkatan'=>'RUP',
                'satuan'=>'%DM',
                'jumlah'=> number_format((float)$array->rumen_undergradable_dm,2,'.',''),
            ],
            [
                'name' =>'Rumen Undergradable Protein',
                'singkatan'=>'RUP',
                'satuan'=>'%DM',
                'jumlah'=> number_format((float)$array->rumen_undergradable_cp,2,'.',''),
            ],
            [
                'name' =>'Rumen Soluble Protein Fraction A',
                'singkatan'=>'CP A',
                'satuan'=>'%CP',
                'jumlah'=> number_format((float)$array->rumen_soluble,2,'.',''),
            ],
            [
                'name' =>'Rumen Insoluble Protein Fraction B',
                'singkatan'=>'CP B',
                'satuan'=>'%CP',
                'jumlah'=> number_format((float)$array->rumen_insoluble,2,'.',''),
            ],
            [
                'name' =>'Degradation Rate of Fraction B',
                'singkatan'=>'CP kd',
                'satuan'=>'%',
                'jumlah'=> number_format((float)$array->degradation_rate,2,'.',''),
            ],
            [
                'name' =>'Metabolizable Protein',
                'singkatan'=>'MP',
                'satuan'=>'%DM',
                'jumlah'=> number_format((float)$array->metabolizable_protein,2,'.',''),
            ],
            [
                'name' =>'Magnesium',
                'singkatan'=>'Mg',
                'satuan'=>'%DM',
                'jumlah'=> number_format((float)$array->magnesium,2,'.',''),
            ],
            [
                'name' =>'Potassium',
                'singkatan'=>'K',
                'satuan'=>'%DM',
                'jumlah'=>number_format((float)$array->total_digestible_nutrients,2,'.',''),
            ],
            [
                'name' =>'Sodium',
                'singkatan'=>'Na',
                'satuan'=>'%DM',
                'jumlah'=>number_format((float)$array->sodium,2,'.',''),
            ],
            [
                'name' =>'Sulfur',
                'singkatan'=>'S',
                'satuan'=>'%DM',
                'jumlah'=> number_format((float)$array->sulfur,2,'.',''),
            ],
            [
                'name' =>'Cobalt',
                'singkatan'=>'Co',
                'satuan'=>'mg/kg',
                'jumlah'=>number_format((float)$array->cobalt,2,'.',''),
            ],
            [
                'name' =>'Copper',
                'singkatan'=>'Cu',
                'satuan'=>'mg/kg',
                'jumlah'=>number_format((float)$array->copper,2,'.',''),
            ],
            [
                'name' =>'Iodine',
                'singkatan'=>'I',
                'satuan'=>'mg/kg',
                'jumlah'=>number_format((float)$array->iodine,2,'.',''),
            ],
            [
                'name' =>'Manganese',
                'singkatan'=>'Mn',
                'satuan'=>'mg/kg',
                'jumlah'=>number_format((float)$array->manganese,2,'.',''),
            ],
            [
                'name' =>'Selenium',
                'singkatan'=>'Se',
                'satuan'=>'mg/kg',
                'jumlah'=>number_format((float)$array->selenium,2,'.',''),
            ],
            [
                'name' =>'Zinc',
                'singkatan'=>'Zn',
                'satuan'=>'mg/kg',
                'jumlah'=>number_format((float)$array->zinc,2,'.',''),
            ]
        ];

        return $feed;
    }
}