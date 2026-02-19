<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class VehicleController extends Controller
{
    public function index(Request $request): Response
    {
        $query = Vehicle::query()->orderBy('created_at', 'desc');

        // FILTRO POR TIPO
        $type = $request->string('type')->toString();
        if ($type && in_array($type, ['car', 'motorcycle'], true)) {
            $query->where('type', $type);
        }

        // FILTRO POR BUSQUEDA
        $search = $request->string('q')->toString();
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('brand', 'like', "%{$search}%")
                    ->orWhere('model', 'like', "%{$search}%");
            });
        }

        // FILTRO PRECIO MINIMO
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        // FILTRO PRECIO MAXIMO
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        return Inertia::render('Vehicles/Index', [
            'filters' => [
                'type' => $request->get('type'),
                'q' => $request->get('q'),
                'min_price' => $request->get('min_price'),
                'max_price' => $request->get('max_price'),
            ],
            'vehicles' => $query->paginate(10)->withQueryString(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Vehicles/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'brand' => 'required',
            'model' => 'required',
            'price' => 'required|numeric',
            'type' => 'required|in:car,motorcycle',
        ]);

        Vehicle::create($validated);

        return redirect()->route('vehicles.index');
    }

    public function edit(Vehicle $vehicle)
    {
        return Inertia::render('Vehicles/Edit', [
            'vehicle' => $vehicle
        ]);
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        $validated = $request->validate([
            'brand' => 'required',
            'model' => 'required',
            'price' => 'required|numeric',
            'type' => 'required|in:car,motorcycle',
        ]);

        $vehicle->update($validated);

        return redirect()->route('vehicles.index');
    }

    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();

        return redirect()->route('vehicles.index');
    }
}
