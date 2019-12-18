<?php

use Illuminate\Database\Seeder;

class StemsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('stems')->delete();

        \DB::table('stems')->insert(array (
            0 =>
            array (
                'id' => 1,
                'artist_id' => 1,
                'title' => 'I\'m Ok Oh Right Stems',
                'permalink' => 'I m Ok Oh Right Stems',
                'catalog' => 'SCR001',
                'upc' => '811868723402',
                'isrc' => 'USLZJ1589610',
                'released_at' => '2015-07-17',
                'genre' => 'House',
                'time' => '06:15',
                'bpm' => '128',
                'key' => 'C maj',
                'secondary_genre' => 'Tech House',
                'coverart' => 'sonusbeat-im-ok-oh-right-stems-20191217111207',
                'coverart_alt' => 'Sonusbeat - I\'m Ok Oh Right Stems',
                'description' => 'I\'m ok oh right is the latest Sonusbeat\'s Tech House Release and now you can purchase this great STEM song',
                'beatport' => 'https://www.beatport.com/stem/im-ok-oh-right/803',
                'traxsource' => NULL,
                'juno' => NULL,
                'meta_title' => 'Sonusbeat - I\'m Ok Oh Right Tech House Song',
                'meta_robots' => 'index, follow',
                'meta_description' => 'I\'m ok oh right is the latest Sonusbeat\'s Tech House Release and now you can purchase this great STEM song',
                'active' => 0,
                'created_at' => '2019-12-17 17:11:09',
                'updated_at' => '2019-12-17 17:11:09',
            ),
        ));


    }
}
