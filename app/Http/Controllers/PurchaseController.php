<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Vehicle;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function store(Request $request, Vehicle $vehicle): RedirectResponse
    {
        $user = $request->user();

        Purchase::create([
            'user_id' => $user->id,
            'vehicle_id' => $vehicle->id,
            'purchased_at' => now(),
        ]);

        return redirect()->route('vehicles.index')
            ->with('success', 'purchase_ok');
    }
}
