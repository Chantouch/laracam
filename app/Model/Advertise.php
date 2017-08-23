<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Advertise extends Model
{

    protected $fillable = [
        'slug', 'advertise_type_id', 'provider_name',
        'tracking_code_large', 'tracking_code_tablet',
        'tracking_code_mobile', 'active'
    ];

    //-------Validation-------//

    public static function rule()
    {
        return [
            'advertise_type_id' => 'required',
            'provider_name' => 'required|max:255'
        ];
    }

    public static function message()
    {
        return [
            'advertise_type_id.required' => 'The advertise type field is required'
        ];
    }

    //-------Relationship--------//

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ads_type()
    {
        return $this->belongsTo(AdvertiseType::class,'advertise_type_id');
    }
}
