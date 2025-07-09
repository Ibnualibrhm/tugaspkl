<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\User;
use App\Mail\KategoriNotificationMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
class Admin_CategoryController extends Controller
{
        public function index()
    {
        $data = category::select('id','name','is_publish')
        ->orderBy('id','DESC')
        ->get();

        return view('layout-dashboard.category.index', [
            'title' => 'Data Category'
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
            $kategori = Category::create([
                'name'       => $validated['name'],
                'is_publish' => $validated['is_publish']
            ]);

            $users = User::all();
            foreach ($users as $user) {
                Mail::to($user->email)->queue(new KategoriNotificationMail($kategori, 'tambah'));
            }

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
            $category = Category::find($request->id);

            if (!$category) {
                return redirect()->back()->with('error', 'Kategori tidak ditemukan atau sudah dihapus.');
            }

            $categoryData = [
                'name'       => $category->name,
                'is_publish' => $category->is_publish
            ];

            $category->delete();

            $users = User::all();
            foreach ($users as $user) {
                Mail::to($user->email)->queue(new KategoriNotificationMail($categoryData, 'hapus'));
            }

            DB::commit();
            return redirect()->back()->with('success', 'Kategori berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
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