<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
class Admin_CategoryController extends Controller
{
        public function index()
    {
        $data = category::select('id','name','is_publish')
        ->orderBy('id','DESC')
        ->get();

        return view('layout-dashboard.category.index', [
            'title' => 'Ini Category'
        ], compact('data'));
    }

    public function tambahDataCategory(Request $request)
    {
        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'is_publish' => 'required|boolean'
        ]);

        DB::beginTransaction();
        try {
            Category::create([
                'name'       => $validated['name'],
                'is_publish' => $validated['is_publish']
            ]);

            DB::commit();

            return redirect()->back()->with('success', 'Data kategori berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal menambahkan kategori: ' . $e->getMessage());
        }
    }

    public function hapusDataCategory(Request $request)
    {
        DB::beginTransaction();
        try {
            $category = Category::findOrFail($request->id);
            $category->delete();

            DB::commit();
            return redirect()->back()->with('success', 'Data kategori berhasil dihapus.');
        } 
        catch (\Exeption $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal menghapus kategori: ' . $e->getMessage());
        }
    }

    public function editDataCategory(Request $request)
    {
        $validated = $request->validate([
            'id'         => 'required|exists:category,id',
            'name'       => 'required|string|max:255',
            'is_publish' => 'required|boolean'
        ]);

        DB::beginTransaction();
        try {
            $category = Category::findOrFail($validated['id']);
            $category->update([
                'name'       => $validated['name'],
                'is_publish' => $validated['is_publish']
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Data kategori berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal memperbarui kategori: ' . $e->getMessage());
        }
    }
}