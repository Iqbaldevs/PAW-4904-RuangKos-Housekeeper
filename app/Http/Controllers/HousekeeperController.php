<?php

namespace App\Http\Controllers;

use App\Models\Housekeeper;
use Illuminate\Http\Request;

class HousekeeperController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->query('search', ''));
        $selectedArea = trim((string) $request->query('area', ''));

        $housekeepers = Housekeeper::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($subQuery) use ($search) {
                    $subQuery->where('nama_staff', 'like', "%{$search}%")
                        ->orWhere('tugas', 'like', "%{$search}%")
                        ->orWhere('area', 'like', "%{$search}%");
                });
            })
            ->when($selectedArea !== '', function ($query) use ($selectedArea) {
                $query->where('area', $selectedArea);
            })
            ->latest()
            ->get();

        $allStaff = Housekeeper::all();

        return view('housekeepers.index', [
            'housekeepers' => $housekeepers,
            'totalStaff' => $allStaff->count(),
            'totalAreas' => $allStaff->pluck('area')->unique()->count(),
            'totalTasks' => $allStaff->pluck('tugas')->unique()->count(),
            'areas' => $allStaff->pluck('area')->unique()->sort()->values(),
            'search' => $search,
            'selectedArea' => $selectedArea,
        ]);
    }

    public function create()
    {
        return view('housekeepers.form', [
            'housekeeper' => new Housekeeper(),
            'pageTitle' => 'Tambah staf housekeeper',
            'submitLabel' => 'Simpan staf',
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_staff' => ['required', 'string', 'max:255'],
            'tugas' => ['required', 'string', 'max:255'],
            'area' => ['required', 'string', 'max:255'],
        ]);

        Housekeeper::create($validated);

        return redirect()
            ->route('housekeepers.index')
            ->with('success', 'Staf housekeeper berhasil ditambahkan.');
    }

    public function show(Housekeeper $housekeeper)
    {
        return view('housekeepers.show', compact('housekeeper'));
    }

    public function edit(Housekeeper $housekeeper)
    {
        return view('housekeepers.form', [
            'housekeeper' => $housekeeper,
            'pageTitle' => 'Ubah data housekeeper',
            'submitLabel' => 'Simpan perubahan',
        ]);
    }

    public function update(Request $request, Housekeeper $housekeeper)
    {
        $validated = $request->validate([
            'nama_staff' => ['required', 'string', 'max:255'],
            'tugas' => ['required', 'string', 'max:255'],
            'area' => ['required', 'string', 'max:255'],
        ]);

        $housekeeper->update($validated);

        return redirect()
            ->route('housekeepers.index')
            ->with('success', 'Data staf housekeeper berhasil diperbarui.');
    }

    public function destroy(Housekeeper $housekeeper)
    {
        $housekeeper->delete();

        return redirect()
            ->route('housekeepers.index')
            ->with('success', 'Data staf housekeeper berhasil dihapus.');
    }
}