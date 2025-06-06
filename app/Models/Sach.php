<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Sach extends Model
{
    use HasFactory;

    protected $table = 'sach'; // tên bảng

    // Không cần khai báo MaSach nữa vì nó sẽ tự động tăng
    public $incrementing = true; 

    // Khóa chính mặc định là 'id' vì MaSach đã là khóa tự tăng
    protected $primaryKey = 'MaSach';  // Nếu cần chỉ định rõ khóa chính

    protected $fillable = [
        'TenSach',
        'slug',
        'category_id',
        'TacGia',
        'GiaNhap',
        'GiaBan',
        'SoLuong',
        'NamXuatBan',
        'MoTa',
        'TrangThai',
        'LuotMua',
        'HinhAnh',
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

    /** Relationships */
    public function DanhMuc()
    {
        return $this->belongsTo(DanhMuc::class, 'category_id');
    }

}
