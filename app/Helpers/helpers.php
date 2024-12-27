<?php

// Get Money Format 

use App\Models\Setting;

if (!function_exists('currencyName')) {
    function currencyName($currency = '$ ')
    {
        $content = '$';
        return $content;
    }
}

// Get Money Format 
if (!function_exists('moneyFormat')) {
    function moneyFormat($money = '')
    {
        $content = '';

        if ($money != '') {
            $content .= siteSettings('site_currency') . ' ';
            $content .=  number_format($money, 2, '.', ',');
        }
        return $content;
    }
}

// Show Product Price 
if (!function_exists('showProductPrice')) {
    function showProductPrice($regular_price, $sale_price = '')
    {
        $content = '';

        $sale_content = !empty($sale_price) ? sprintf('<br /><del class="text-danger">%s</del>', moneyFormat($regular_price)) : '';
        $content .= !empty($sale_content) ? moneyFormat($sale_price) . $sale_content : moneyFormat($regular_price);

        return $content;
    }
}

// Show Product Rating
if (!function_exists('showRating')) {
    function showRating($rating = 0)
    {
        $content = '<div class="ratings">';
        for ($i = 0; $i < 5; $i++) {
            $content .= ($i < $rating) ? '<i class="fa fa-star rating-color"></i>' : '<i class="fa fa-star"></i>';
        }
        $content .= '</div>';
        return $content;
    }
}
// Get site Settings
if (!function_exists('siteSettingsData')) {
    function siteSettingsData()
    {
        $setting_data = [];
        $settings = \App\Models\Setting::all()->toArray();
        if ($settings) {
            foreach ($settings as $setting) {
                $setting_data[$setting['key']] = $setting['value'];
            }
        }
        return $setting_data;
    }
}

// Get site Settings
if (!function_exists('siteSettings')) {
    function siteSettings($key)
    {

        $siteSettings = Cache::get('siteSettings');

        if (is_null($siteSettings)) {
            $siteSettings = Cache::remember('siteSettings', 24 * 60 * 60, function () {
                return siteSettingsData();
            });
        }
        return (is_array($key)) ? array_only($siteSettings, $key) : $siteSettings[$key];
    }
}

// Get Product Badges
if (!function_exists('productBadge')) {
    function productBadge($product)
    {
        $content = '';

        if ($product->prod_new_arrival == '1') {
            $content .= '<span class="new">New</span>';
        } else if ($product->prod_featured == '1') {
            $content .= '<span class="out-of-stock">Hot</span>';
        }

        return $content;
    }
}

// Get Cart DropDown Items for header
/*
if (!function_exists('cartInfoDropDown')) {
    function cartInfoDropDown(){        
         $guest_id = $_COOKIE['guest_auth_token'];
        $cartDropDown = Cache::get($guest_id);
        return $cartDropDown; 
    }
}
*/



function getSetting()
{

    return Setting::pluck('value', 'key')->toArray();
}
