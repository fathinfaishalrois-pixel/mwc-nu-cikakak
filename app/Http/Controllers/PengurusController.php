<?php
namespace App\Http\Controllers;

use App\Models\Pengurus;

class PengurusController extends Controller
{
    public function index()
    {
        $items = Pengurus::where('status', true)->orderBy('urutan')->orderBy('nama')->get();

        $root = $items->firstWhere('parent_id', null);
        $level2 = $root ? $items->where('parent_id', $root->id)->values() : collect();
        $level3 = $level2->flatMap(fn ($parent) => $items->where('parent_id', $parent->id))->values();
        $level4 = $level3->flatMap(fn ($parent) => $items->where('parent_id', $parent->id))->values();

        return view('public.pengurus', [
            'items' => $items,
            'root' => $root,
            'level2' => $level2,
            'level3' => $level3,
            'level4' => $level4,
        ]);
    }

    public function show(string $slug)
    {
        $pengurus = Pengurus::where('status', true)->where('slug', $slug)->firstOrFail();
        return view('public.pengurus-detail', compact('pengurus'));
    }
}
