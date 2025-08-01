<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Categories::query()
            ->when($request->filled('q'), function ($query) use ($request) {
                $query->where('name', 'like', '%'.$request->q.'%')
                    ->orWhere('description', 'like', '%'.$request->q.'%');
            })
            ->paginate(10);

        return view('dashboard.categories.index', [
            'categories' => $categories,
            'q' => $request->q,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with(
                [
                    'errors' => $validator->errors(),
                    'errorMessage' => 'Validasi Error, Silahkan lengkapi data terlebih dahulu',
                ]
            );
        }

        $category = new Categories;
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->description = $request->description;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'_'.$image->getClientOriginalName();
            $imagePath = $image->storeAs('uploads/categories', $imageName, 'public');
            $category->image = $imagePath;
        }

        $category->save();

        return redirect()->back()
            ->with(
                [
                    'successMessage' => 'Data Berhasil Disimpan',
                ]
            );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Categories::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Categories::find($id);

        return view('dashboard.categories.edit', [
            'category' => $category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with(
                [
                    'errors' => $validator->errors(),
                    'errorMessage' => 'Validasi Error, Silahkan lengkapi data terlebih dahulu',
                ]
            );
        }

        $category = Categories::find($id);
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->description = $request->description;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'_'.$image->getClientOriginalName();
            $imagePath = $image->storeAs('uploads/categories', $imageName, 'public');
            $category->image = $imagePath;
        }

        $category->save();

        return redirect()->back()
            ->with(
                [
                    'successMessage' => 'Data Berhasil Disimpan',
                ]
            );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Categories::find($id);

        $category->delete();

        return redirect()->back()
            ->with(
                [
                    'successMessage' => 'Data Berhasil Dihapus',
                ]
            );
    }

    /**
     * Toggle the active status of the category.
     */
    public function toggle(string $id)
    {
        if (request()->method() !== 'PATCH') {
            abort(405, 'Method Not Allowed');
        }

        $category = Categories::findOrFail($id);

        return redirect()->back()->with('successMessage', 'Status kategori berhasil diubah.');
    }

    public function sync($id, Request $request)
      {
          $category = Categories::findOrFail($id);
          
          $response = Http::post('https://api.phb-umkm.my.id/api/product-category/sync', [
              'client_id' => env('CLIENT_ID'),
              'client_secret' => env('CLIENT_SECRET'),
              'seller_product_category_id' => (string) $category->id,
              'name' => $category->name,
              'description' => $category->description,
              'is_active' => $request->is_active == 1 ? false : true,
          ]);
  
          if ($response->successful() && isset($response['product_category_id'])) {
              $category->hub_category_id = $request->is_active == 1 ? null : $response['product_category_id'];
              $category->save();
          }
  
          session()->flash('successMessage', 'Category Synced Successfully');
          return redirect()->back();
      }
}
