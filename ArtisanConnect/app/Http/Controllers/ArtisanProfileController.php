<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArtisanProfileController extends Controller
{
    public function index()
    {

        $portfolios = auth()->user()->portfolios()->latest()->get();

        return view('Artisan.portfolio', compact('portfolios'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:100',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);


        $path = $request->file('image')->store('portfolios', 'public');


        auth()->user()->portfolios()->create([
            'title' => $request->title,
            'image_path' => $path,
            'artisan_id' => auth()->id()
        ]);

        return back()->with('success', 'Image ajoutée au portfolio !');
    }
    public function destroy(Portfolio $portfolio)
    {
        // 1. الأمان: التأكد أن الحرفي يحذف صوره هو فقط
        if ($portfolio->artisan_id !== auth()->id()) {
            abort(403, 'Action غير مصرح بها');
        }

        // 2. حذف ملف الصورة الحقيقي من السيرفر (Storage) لتوفير المساحة
        if (Storage::disk('public')->exists($portfolio->image_path)) {
            Storage::disk('public')->delete($portfolio->image_path);
        }

        // 3. حذف السجل من قاعدة البيانات
        $portfolio->delete();

        return back()->with('success', 'La réalisation a été supprimée !');
    }
}
