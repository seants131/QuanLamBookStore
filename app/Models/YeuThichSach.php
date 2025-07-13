<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class YeuThichSach extends Model
{
    protected $table = 'yeu_thich_sach';
    protected $fillable = ['khach_hang_id', 'sach_id'];

    public function sach()
    {
        return $this->belongsTo(Sach::class, 'sach_id', 'MaSach');
    }

    public function khachHang()
    {
        return $this->belongsTo(KhachHang::class, 'khach_hang_id', 'id');
    }
}
