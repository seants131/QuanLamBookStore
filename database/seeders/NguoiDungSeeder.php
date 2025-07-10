<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class NguoiDungSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('nguoi_dung')->insert([
            [
                'name' => 'Quản trị viên',
                'username' => 'admin',
                'password' => Hash::make('123456'),
                'role' => 'admin',
                'email' => 'admin@example.com',
                'so_dien_thoai' => '0912345678',
                'dia_chi' => 'Hà Nội',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Nguyễn Văn A',
                'username' => 'nguyenvana',
                'password' => Hash::make('123456'),
                'role' => 'khach',
                'email' => 'vana@example.com',
                'so_dien_thoai' => '0987654321',
                'dia_chi' => 'TP. Hồ Chí Minh',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
