<?php

use Illuminate\Database\Seeder;

class ClientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //client seeds starts.
        // comments
        //iOS
        
        DB::table('clients')->insert([
            'client_id' => 'carbnb-app-ios',
            'client_secret' => 'c3ltby1hcHAtaW9zOmE4ODI4NjY1LTU1MzgtNGNlYy1hYzU4LWE0YmU0NmE1Y2Y3OA==',
        ]);

        //Android
        DB::table('clients')->insert([
            'client_id' => 'carbnb-app-android',
            'client_secret' => 'c3ltby1hcHAtYW5kcm9pZDphODgyODY2NS01NTM4LTRjZWMtYWM1OC1hNGJlNDZhNWNmNzg=',
        ]);

        //Admin
        DB::table('clients')->insert([
            'client_id' => 'carbnb-app-admin',
            'client_secret' => 'YWhsYW0tYXBwLWFkbWluOmUwNWY5MjUzLTU3NzctNDY1NS1iOTYwLTU0ZWNkZDVhNWVmNg==',
        ]);

        //client seeds end.
    }
}
