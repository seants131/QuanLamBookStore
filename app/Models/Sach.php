<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Sach extends Model
{
    use HasFactory;

    protected $table = 'sach';
    protected $primaryKey = 'MaSach';
    public $incrementing = true; 
    protected $keyType = 'int';  // ĐÚNG nếu MaSach là INT


    protected $fillable = [
        'TenSach',
        'slug',
        'LoaiSanPham',
        'TacGia',
        'GiaBia',
        'SoLuong',
        'NamXuatBan',
        'MoTa',
        'TrangThai',
        'LuotMua',
        'HinhAnh',
        'Lop',
        'chiet_khau',
        'nha_xuat_ban_id',
        'danh_muc_id',
    ];
 /**
     * Auto generate slug from TenSach if not provided
     */
    protected static function booted()
    {
        static::creating(function ($sach) {
            if (empty($sach->slug)) {
                $sach->slug = Str::slug($sach->TenSach);
            }
        });

        static::updating(function ($sach) {
            if (empty($sach->slug)) {
                $sach->slug = Str::slug($sach->TenSach);
            }
        });
    }
    public function chiTietHoaDon()
    {
        return $this->hasMany(ChiTietHoaDon::class, 'sach_id', 'MaSach');
    }

    public function chiTietNhapSach()
    {
        return $this->hasMany(ChiTietNhapSach::class, 'sach_id', 'MaSach');
    }

    public function danhMuc()
    {
        return $this->belongsTo(DanhMuc::class, 'danh_muc_id', 'id');
    }
}
