<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Point;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PharmacyPointController extends Controller
{



    public function updateSettings(Request $request)
    {
        $request->validate([
            'earning_rate' => 'required|numeric|min:0',
            'redeem_rate'  => 'required|numeric|between:0.01,1',
        ]);

        $pharmacy = auth('pharmacist')->user()->pharmacy;

        $point = Point::updateOrCreate(
            [
                'pharmacy_id' => $pharmacy->id,
                'user_id'     => $pharmacy->id, // أو المسؤول عن الصيدلية
                'type'        => 'earned',
            ],
            [
                'earning_rate' => $request->earning_rate,
                'redeem_rate'  => $request->redeem_rate,
                'source_name'  => 'Pharmacy Settings',
                'is_active'    => true,
            ]
        );

        return response()->json(['message' => 'تم حفظ إعدادات النقاط بنجاح']);
    }

    public function getSettings()
    {
        $pharmacy = auth('pharmacist')->user()->pharmacy;

        $point = Point::where('pharmacy_id', $pharmacy->id)
            ->where('type', 'earned')
            ->where('is_active', true)
            ->latest()
            ->first();

        return response()->json([
            'earning_rate' => $point?->earning_rate ?? 1,
            'redeem_rate'  => $point?->redeem_rate ?? 0.5,
        ]);
    }
}
