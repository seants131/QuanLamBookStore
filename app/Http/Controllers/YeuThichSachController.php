<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\YeuThichSach;
use App\Models\Sach;
use Illuminate\Support\Facades\Auth;

class YeuThichSachController extends Controller
{
    public function index()
    {
        $user = Auth::guard('khach')->user();
        $favorites = YeuThichSach::where('khach_hang_id', $user->id)
            ->with('sach')
            ->latest()
            ->get();
        return view('user.favorite.index', compact('favorites'));
    }

    public function toggle(Request $request)
    {
        $user = Auth::guard('khach')->user();
        $sachId = $request->input('sach_id');
        $exists = YeuThichSach::where('khach_hang_id', $user->id)->where('sach_id', $sachId)->first();

        if ($exists) {
            $exists->delete();
            return response()->json(['status' => 'removed']);
        } else {
            YeuThichSach::create([
                'khach_hang_id' => $user->id,
                'sach_id' => $sachId
            ]);
            return response()->json(['status' => 'added']);
        }
    }

    public function isFavorite(Request $request)
    {
        $user = Auth::guard('khach')->user();
        $sachId = $request->input('sach_id');
        $exists = YeuThichSach::where('khach_hang_id', $user->id)->where('sach_id', $sachId)->exists();
        return response()->json(['favorite' => $exists]);
    }
}
