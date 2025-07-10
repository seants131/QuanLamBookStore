<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class DanhMucSeeder extends Seeder
{
    public function run(): void
    {
        $boSachList = [
            'Cánh Diều',
            'Chân trời sáng tạo',
            'Cùng học để phát triển năng lực',
            'Kết nối tri thức với cuộc sống',
            'Vì sự bình đẳng và dân chủ trong giáo dục',
        ];

        foreach ($boSachList as $boSach) {
            DB::table('danh_muc')->updateOrInsert(
                ['ten' => $boSach],
                [
                    'slug' => Str::slug($boSach),
                    'mo_ta' => "Bộ sách $boSach theo chương trình GDPT mới",
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
