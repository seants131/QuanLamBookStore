<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SachSeeder extends Seeder
{
    public function run(): void
    {
        // Danh sách bộ sách (danh mục)
        $boSachMap = [
            'Canh-Dieu' => 'Cánh Diều',
            'Chan-Troi' => 'Chân trời sáng tạo',
            'Ket-Noi' => 'Kết nối tri thức với cuộc sống',
            'Tri-Thuc' => 'Kết nối tri thức với cuộc sống', // một số ảnh ghi tắt
            'Ket-noi' => 'Kết nối tri thức với cuộc sống',
            'Ket-Noi-Tri-Thuc' => 'Kết nối tri thức với cuộc sống',
            'Ket-Noi-TriThuc' => 'Kết nối tri thức với cuộc sống',
            'Chan-Troi-Sang-Tao' => 'Chân trời sáng tạo',
            'Canh-Dieu' => 'Cánh Diều',
        ];

        // Danh sách môn học (có thể bổ sung thêm nếu thiếu)
        $monHocList = [
            'Toan' => 'Toán',
            'Tieng-Viet' => 'Tiếng Việt',
            'Ngu-Van' => 'Ngữ văn',
            'Tieng-Anh' => 'Tiếng Anh',
            'Khoa-Hoc' => 'Khoa học',
            'Lich-Su' => 'Lịch sử',
            'Dia-Li' => 'Địa lý',
            'Sinh-Hoc' => 'Sinh học',
            'Vat-Li' => 'Vật lí',
            'Hoa-Hoc' => 'Hóa học',
            'Tin-Hoc' => 'Tin học',
            'Mi-Thuat' => 'Mĩ thuật',
            'Am-Nhac' => 'Âm nhạc',
            'Dao-Duc' => 'Đạo đức',
            'Giao-Duc-Cong-Dan' => 'Giáo dục công dân',
            'Giao-Duc-The-Chat' => 'Giáo dục thể chất',
            'Hoat-Dong-Trai-Nghiem' => 'Hoạt động trải nghiệm',
            'Hoat-Dong-Trai-Nghiem-Huong-Nghiep' => 'Hoạt động trải nghiệm hướng nghiệp',
            'Khoa-Hoc-Tu-Nhien' => 'Khoa học tự nhiên',
            'Lich-Su-Va-Dia-Li' => 'Lịch sử và Địa lí',
            'Tu-Nhien-Va-Xa-Hoi' => 'Tự nhiên và Xã hội',
            'Giao-Duc-Kinh-Te-Va-Phap-Luat' => 'Giáo dục kinh tế và pháp luật',
            // ... bổ sung thêm nếu cần
        ];

        // Lấy danh mục (bộ sách) từ DB
        $danhMucList = DB::table('danh_muc')->pluck('id', 'ten')->toArray();

        // Đọc file ảnh (ví dụ từ file 1.txt)
        $imageFile = base_path('1.txt');
        $lines = file($imageFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($lines as $line) {
            $file = trim($line);
            if (!$file || Str::startsWith($file, 'Name') || Str::startsWith($file, '----')) continue;

            // Tách tên file
            $name = pathinfo($file, PATHINFO_FILENAME);

            // Tìm bộ sách
            $boSach = null;
            foreach ($boSachMap as $key => $val) {
                if (Str::contains($name, $key)) {
                    $boSach = $val;
                    break;
                }
            }

            // Tìm môn học
            $monHoc = null;
            foreach ($monHocList as $key => $val) {
                if (Str::contains($name, $key)) {
                    $monHoc = $val;
                    break;
                }
            }

            // Tìm lớp
            $lop = null;
            if (preg_match('/(\d{1,2})/', $name, $m)) {
                $lop = $m[1];
            }

            // Tên sách
            $tenSach = trim(($monHoc ? $monHoc : 'Sách') . ($lop ? " lớp $lop" : '') . ($boSach ? " - $boSach" : ''));

            // Slug
            $slug = Str::slug($tenSach);

            // Lấy id danh mục
            $danhMucId = $boSach && isset($danhMucList[$boSach]) ? $danhMucList[$boSach] : null;

            // Insert vào DB
            DB::table('sach')->insert([
                'TenSach' => $tenSach,
                'slug' => $slug,
                'LoaiSanPham' => 'sach_giao_khoa',
                'TacGia' => 'Nhiều tác giả',
                'GiaBia' => rand(18, 35)*1000,
                'SoLuong' => rand(50, 300),
                'NamXuatBan' => 2024,
                'MoTa' => "Sách $tenSach theo chương trình GDPT mới.",
                'TrangThai' => 1,
                'LuotMua' => rand(0, 500),
                'HinhAnh' => $file,
                'Lop' => $lop,
                'chiet_khau' => rand(0, 15),
                'danh_muc_id' => $danhMucId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}