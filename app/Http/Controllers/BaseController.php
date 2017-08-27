<?php
/**
 * Created by PhpStorm.
 * User: Chantouch
 * Date: 8/27/2017
 * Time: 12:34 PM
 */

namespace App\Http\Controllers;


use App\Model\Advertise;

class BaseController extends Controller
{

    /**
     * BaseController constructor.
     */
    public function __construct()

    {
        $top_ads = Advertise::with(['ads_type', 'media'])
            ->where('advertise_type_id', 1)->get()->random(1);
        $top_right_ads = Advertise::with(['ads_type', 'media'])
            ->where('advertise_type_id', 3)->get()->random(2);
        view()->share([
            'top_ads' => $top_ads,
            'top_right_ads' => $top_right_ads
        ]);
    }

}