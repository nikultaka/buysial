<?php

namespace App\Helpers;
use Illuminate\Support\Facades\DB;

class GlobalHelper
{
    /**
     * Get all countries from the 'countries' table.
     *
     * @return \Illuminate\Support\Collection
     */
    public static function getAllCountries()
    {
        return DB::table('countries')->select('id', 'code', 'name')->orderBy('name')->get();
    }

    public static function getAllStates()
    {
        return DB::table('states')
            ->select('id', 'name', 'country_id')
            ->orderBy('name')
            ->get();
    }
    public static function getAllCities()
    {
        return DB::table('cities')
            ->select('id', 'name', 'state_id', 'country_id')
            ->orderBy('name')
            ->get();
    }

    public static  function getStatesByCountry($country_id)
    {
        return DB::table('states')
            ->where('country_id', $country_id)
            ->get();
    }
    public static function getCitiesByState($state_id)
    {
        return DB::table('cities')
            ->where('state_id', $state_id)
            ->get();
    }
}
