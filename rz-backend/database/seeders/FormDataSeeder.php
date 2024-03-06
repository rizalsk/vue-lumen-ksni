<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FormData;

class FormDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $formdata = [
            [
                //"id"    => 1,
                "title"         => "Fullname",
                "datasource"    => "text",
                "datatype"      => "string",
                "value"         => "",
                //"data_parameter"  => [],
                "data_table"    => "",
                "sorting"       => 1
            ],
            [
                //"id"    => 2,
                "title"         => "Date Of Birth",
                "datasource"    => "date",
                "datatype"      => "date",
                "value"         => "",
                "data_table"    => "",
                //"data_parameter"  => [],
                "sorting"       => 2
            ],
            [
                //"id"          => 3,
                "title"         => "Address",
                "datasource"    => "text-area",
                "datatype"      => "string",
                "value"         => "",
                "data_table"    => "",
                //"data_parameter"  => [],
                "sorting"   => 3
            ],
            [
                //"id"    => 4,
                "title"         => "Phone Number",
                "datasource"    => "text",
                "datatype"      => "number",
                "value"         => "",
                "data_table"    => "",
                //"data_parameter"  => [],
                "sorting"       => 4
            ],
            [
                //"id"    => 5,
                "title"         => "Country",
                "datasource"    => "combobox",
                "datatype"      => "select",
                "value"         => "",
                "data_table"    => "country",
                //"data_parameter"  => [{"id" => "IDN", "name" => "Indonesia"}, {"id"   => "BRA", "name"   => "Brazil"}, {"id"    =>"AGO", "name" => "Angola"}],
                "sorting"       => 5
            ],
            [
                //"id"          => 6,
                "title"         => "Gender",
                "datasource"    => "radiobox",
                "datatype"      => "radio",
                "value"         => "",
                "data_table"    => "gender",
                //"data_parameter"  => [{"id" => "M", "name"   => "Male"}, {"id"  => "F", "name"    => "Female"}]
                "sorting"       => 6
            ]
        ];

        FormData::insert($formdata);

    }
}
