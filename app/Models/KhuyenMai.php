<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
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
       $now = Carbon::now();

    if ($this->trang_thai === 'tat') {
        return 'Tạm dừng';
    }

    if ($now < $this->ngay_bat_dau) {
        return 'Chưa bắt đầu';
    }

    if ($now > $this->ngay_ket_thuc) {
        return 'Hết hạn';
    }

    return 'Kích hoạt';
    }

}
