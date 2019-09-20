<?php

use Illuminate\Database\Seeder;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataInsert = [
            [
                'name' => 'Cơ sở dữ liệu',
                'publisher' => 'NXB Giáo dục',
                'author' => 'Ðỗ Trung Tấn',
                'num_of_page' => '200',
                'maxdate' => '3',
                'num' => '3',
                'summary' => 'Thiết kế CSDL',
            ],
            [
                'name' => 'SQL Server 7.0',
                'publisher' => 'NXB Ðồng Nai',
                'author' => 'Elicom',
                'num_of_page' => '200',
                'maxdate' => '3',
                'num' => '2',
                'summary' => 'Thiết CSDL và sử dụng SQL Server',
            ],
        ];

        // get list category id
        $categories = DB::table('categories')->select('id')->get();
        foreach ($categories as $category) {
            foreach ($dataInsert as $data) {
                $data['category_id'] = $category->id;
                DB::table('books')->insert($data);
            }
        }

    }
}
