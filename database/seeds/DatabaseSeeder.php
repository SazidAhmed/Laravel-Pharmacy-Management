<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Medicine;
use App\Category;
use App\Manufacturer;
use App\Customer;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create(['username'=>'Admin','email'=>'admin@gmail.com','password' => Hash::make('123456'), 'created_at' => now(),'updated_at' => now()]);
        Customer::create(['name'=>'Jeams Bond','phone'=>'01688899900','address' => 'Caligfornia, USA']);
        Customer::create(['name'=>'Eric Clapton','phone'=>'01755544411','address' => 'London, UK']);
        Customer::create(['name'=>'Jimmy Hendrix','phone'=>'01855544400','address' => 'Berlin, Germany']);
        Category::create(['name'=>'Tablet','slug'=>'tablet','image' => 'default.jpg']);
        Category::create(['name'=>'Vaccine','slug'=>'vaccine','image' => 'default.jpg']);
        Manufacturer::create(['name'=>'Incepta','image' => 'default.jpg']);
        Manufacturer::create(['name'=>'Sanofi','image' => 'default.jpg']);
        Medicine::create(['name'=>'Napa','category_id'=>'1','manufacturer_id' => '1', 'price'=>'20', 'stock'=>'100', 'expire'=>'2021-06-20 20:09:29','description'=>'For Fever', 'image'=>'default.jpg']);
        Medicine::create(['name'=>'MaxPro','category_id'=>'1','manufacturer_id' => '1', 'price'=>'200', 'stock'=>'500', 'expire'=>'2021-04-10 20:09:29','description'=>'For Gastric', 'image'=>'default.jpg']);
        Medicine::create(['name'=>'Uriset','category_id'=>'2','manufacturer_id' => '2', 'price'=>'250', 'stock'=>'50', 'expire'=>'2021-05-15 20:09:29','description'=>'For Urine', 'image'=>'default.jpg']);
    }
}
