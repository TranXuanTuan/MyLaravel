<?php
use Illuminate\Database\Seeder;
class CategoriesTableSeeder extends Seeder
{
   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run()
   {
       $dataInsert = [];
       //PHP
       for($i = 1; $i <= 5; $i++) {
               $dataInsert[] = [
                   'name' => 'PHP' . $i
           ];
       }
       //CSS
       for($i = 1; $i <= 5; $i++) {
               $dataInsert[] = [
                   'name' => 'CSS' . $i
           ];
       }
       DB::table('categories')->insert($dataInsert);
   }
}