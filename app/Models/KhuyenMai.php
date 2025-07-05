<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KhuyenMai extends Model
{
    protected $table = 'khuyen_mai';

    protected $fillable = [
        'ten',
        'phan_tram_giam',
        'ngay_bat_dau',
        'ngay_ket_thuc',
        'trang_thai',
    ];

    public function hoaDon()
    {
        return $this->hasMany(DonHang::class, 'khuyen_mai_id');
    }
   
    public function getTrangThaiHienThiAttribute()
    {
        $today = \Carbon\Carbon::today();
        $ngayKetThuc = \Carbon\Carbon::parse($this->ngay_ket_thuc);

        if ($today->gt($ngayKetThuc)) return 'Tạm dừng';
        if ($this->trang_thai === 'kich_hoat') return 'Kích hoạt';

        return 'Tạm dừng';
    }

}
