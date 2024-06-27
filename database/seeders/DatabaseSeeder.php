<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Employee;
use App\Models\Product;
use App\Models\Spko;
use App\Models\SpkoItem;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Employee::create([
            'id_employee' => 1,
            'entry_date' => '2020-04-01 05:35:00',
            'nama' => 'Ahmad Husaini',
            'rank' => 'Operator',
            'gender' => 'L'
        ]);
        Employee::create([
            'id_employee' => 2,
            'entry_date' => '2020-01-25 04:56:00',
            'nama' => 'Maya Sofa Nata',
            'rank' => 'Operator',
            'gender' => 'P'
        ]);
        Employee::create([
            'id_employee' => 3,
            'entry_date' => '2020-01-25 05:04:00',
            'nama' => 'Rizal Ardiyansah Bintoro',
            'rank' => 'Operator',
            'gender' => 'L'
        ]);
        Employee::create([
            'id_employee' => 275,
            'entry_date' => '2020-01-25 05:04:00',
            'nama' => 'Syafiq',
            'rank' => 'Operator',
            'gender' => 'L'
        ]);
        Employee::create([
            'id_employee' => 1606,
            'entry_date' => '2020-01-25 05:04:00',
            'nama' => 'Fuadi',
            'rank' => 'Operator',
            'gender' => 'L'
        ]);
        Employee::create([
            'id_employee' => 1710,
            'entry_date' => '2020-01-25 05:04:00',
            'nama' => 'Rayyan',
            'rank' => 'Operator',
            'gender' => 'L'
        ]);
        Employee::create([
            'id_employee' => 1270,
            'entry_date' => '2020-01-25 05:04:00',
            'nama' => 'Budi',
            'rank' => 'Operator',
            'gender' => 'L'
        ]);
        Employee::create([
            'id_employee' => 1377,
            'entry_date' => '2020-01-25 05:04:00',
            'nama' => 'David',
            'rank' => 'Operator',
            'gender' => 'L'
        ]);

        Product::create([
            'id_product' => 247,
            'sub_category' => 'CALP1',
            'serial_no' => 10043,
            'description' => 'Cincin Anak Laki Putus 1 gr-10043-20K',
            'carat' => '20K-875'
        ]);
        Product::create([
            'id_product' => 260,
            'sub_category' => 'LT1',
            'serial_no' => 10237,
            'description' => 'Liontin 1 gr-10152-16K',
            'carat' => '17K-750'
        ]);
        Product::create([
            'id_product' => 246,
            'sub_category' => 'CWTMT',
            'serial_no' => 10152,
            'description' => 'Cincin Wanita Mata-10152-16K',
            'carat' => '16K-700'
        ]);
        Product::create([
            'id_product' => 2232,
            'sub_category' => 'GPMA2',
            'serial_no' => 10125,
            'description' => 'Gelang Pipa  Mata Anak 2 gr-10125',
            'carat' => '08K.-375P'
        ]);
        Product::create([
            'id_product' => 2470,
            'sub_category' => 'KCCBM2',
            'serial_no' => 10047,
            'description' => 'Kepala Cor Cincin Bangkok Metro 2 gr-10047',
            'carat' => '20K-875'
        ]);


        Spko::create([
            'employee' => 275,
            'trans_date' => '2020-02-08',
            'process' => 'Brush',
            'sw' => '2201480010'
        ]);
        Spko::create([
            'employee' => 1606,
            'trans_date' => '2020-05-04',
            'process' => 'Var P',
            'sw' => '2201480034'
        ]);
        Spko::create([
            'employee' => 1710,
            'trans_date' => '2020-01-24',
            'process' => 'Enamel',
            'sw' => '2201530020'
        ]);
        Spko::create([
            'employee' => 1270,
            'trans_date' => '2020-11-24',
            'process' => 'Giling Tarik',
            'sw' => '2201530006'
        ]);
        Spko::create([
            'employee' => 1377,
            'trans_date' => '2020-12-03',
            'process' => 'Potong Cor',
            'sw' => '2201120181'
        ]);

        SpkoItem::create([
            'idm' => 1,
            'ordinal' => 1,
            'id_product' => 247,
            'qty' => 46
        ]);
        SpkoItem::create([
            'idm' => 2,
            'ordinal' => 1,
            'id_product' => 247,
            'qty' => 55
        ]);
        SpkoItem::create([
            'idm' => 3,
            'ordinal' => 1,
            'id_product' => 260,
            'qty' => 3
        ]);
        SpkoItem::create([
            'idm' => 3,
            'ordinal' => 2,
            'id_product' => 260,
            'qty' => 1
        ]);
        SpkoItem::create([
            'idm' => 4,
            'ordinal' => 1,
            'id_product' => 246,
            'qty' => 48
        ]);
        SpkoItem::create([
            'idm' => 4,
            'ordinal' => 2,
            'id_product' => 246,
            'qty' => 2
        ]);
        SpkoItem::create([
            'idm' => 5,
            'ordinal' => 1,
            'id_product' => 246,
            'qty' => 100
        ]);
        SpkoItem::create([
            'idm' => 5,
            'ordinal' => 2,
            'id_product' => 2232,
            'qty' => 150
        ]);
    }
}
