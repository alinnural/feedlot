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
        $harga_terakhir_bs = 0;
        foreach($feeds_id as $key => $value)
        {            
            $feeds = Feed::find($value);
            $percent[$no]['id'] = $feeds->id;
            $percent[$no]['name'] = $feeds->name;
            $percent[$no]['result'] = round($result[$no]*100,5);
            $percent[$no]['result_bs'] = round($result_bs[$no]/$total_result_bs*100,5);
            $percent[$no]['price'] = $feed_price[$key]; 
            $harga_terakhir_bs += $percent[$no]['result_bs']/100*$feed_price[$key];   
            $percent[$no]['max_feed'] = $max_feed[$key];   
            $percent[$no]['min_feed'] = $min_feed[$key];     
            $no++;
        }
        Session::put('harga_terakhir',$harga_terakhir);
        Session::put('harga_terakhir_bs',$harga_terakhir_bs);
        
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
                if($feednuts!=null)
                    $temp = $result[$key+1]*$feednuts->composition;
                else
                    $temp = 0;
                $sum_comp += $temp;
            }        
            $nutrient[$no]['result'] = round($sum_comp,2);
            $no++;
        }
        //print_r($nutrient); exit;
        Session::put('nutrientresult',$nutrient);  
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