<?php

use GuzzleHttp\Client;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountriesTableSeeder extends Seeder
{
    public function run()
    {
        $client = new Client();
        $res = $client->request('GET', 'https://restcountries.eu/rest/v2/all');
        $data = json_decode($res->getBody());
        $dataInsert = [];
        if (!empty($data)){
            foreach ($data as $item){
                $country = [];
                $country['name'] = $item->name;
                $country['created_at'] = date('Y/m/d H:i:s');
                $country['updated_at'] = date('Y/m/d H:i:s');
                array_push($dataInsert, $country);
            }
        }

        DB::table('countries')->insert($dataInsert);
    }
}
