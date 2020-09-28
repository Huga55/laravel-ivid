<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TariffTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tariffs')->insert([
	        [
	        	'name' => 'none',
	        	'1' => 0,
	        	'3' => 0,
	        	'6' => 0,
	        ],
	    	[
	    		'name' => 'Эконом',
	        	'1' => 299,
	        	'3' => 799,
	        	'6' => 1599,
	        ],
	        [
	    		'name' => 'Стандарт',
	        	'1' => 499,
	        	'3' => 1299,
	        	'6' => 2599,
	        ],
	        [
	    		'name' => 'Супер',
	        	'1' => 999,
	        	'3' => 2699,
	        	'6' => 5299,
	        ],
	        [
	    		'name' => 'Мега',
	        	'1' => 1499,
	        	'3' => 3999,
	        	'6' => 7999,
	        ],
	        [
	    		'name' => 'Космос',
	        	'1' => 1999,
	        	'3' => 5399,
	        	'6' => 10699,
	        ],
	        [
	    		'name' => 'Тест',
	        	'1' => 1,
	        	'3' => 1,
	        	'6' => 1,
	        ],
    	]);
    }
}
