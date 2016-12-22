<?php 

namespace App;
 
use Illuminate\Database\Eloquent\Model;
 
class Feed extends Model 
{
    protected $fillable = [
        'feed_stuff',
        'group_feed_id',
        'dry_matter',
        'mineral',
        'organic_matter',
        'lignin',
        'neutral_detergent_fiber',
        'ether_extract',
        'nonfiber_carbohydrates',
        'total_digestible_nutrients',
        'metabolizable_energy',
        'rumen_undergradable_cp',
        'rumen_undegradable_dm',
        'rumen_degradable_cp',
        'rumen_degradable_dm',
        'rumen_soluble',
        'rumen_insoluble',
        'degradation_rate',
        'crude_protein',
        'metabolizable_protein',
        'calcium',
        'phosphorus',
        'magnesium',
        'potassium',
        'sodium',
        'sulfur',
        'cobalt',
        'copper',
        'iodine',
        'manganese',
        'selenium',
        'zinc',
        ];

    public function groupfeed()
    {
        return $this->belongsTo('App\GroupFeed','group_feed_id','id');
    }
}
 