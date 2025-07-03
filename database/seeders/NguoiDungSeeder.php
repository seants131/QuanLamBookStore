<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NguoiDungSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('nguoi_dung')->insert([
            [
                'name' => 'Admin',
                'username' => 'admin',
                'password' => bcrypt('admin123'),
                'role' => 'admin',
                'email' => 'admin@example.com',
                'so_dien_thoai' => '0900000000',
                'dia_chi' => '123 Đường Nguyễn Trãi, Phường 1, Quận 5, TP. Hồ Chí Minh',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Khách hàng',
                'username' => 'khach1',
                'password' => bcrypt('123456'),
                'role' => 'khach',
                'email' => 'khach1@example.com',
                'so_dien_thoai' => '0911111111',
                'dia_chi' => '456 Đường Lê Lợi, Phường Bến Thành, Quận 1, TP. Hồ Chí Minh',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
