<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Mendapatkan query pencarian
        $q = $request->get('q', ''); // Menangani parameter pencarian dengan default kosong

        // Mencari produk berdasarkan nama dan deskripsi jika ada pencarian
        $products = Product::when($q, function ($query, $q) {
            return $query->where('name', 'like', "%{$q}%")
                ->orWhere('description', 'like', "%{$q}%");
        })->paginate(10); // Menampilkan hasil produk dengan pagination

        return view('dashboard.products.index', compact('products', 'q'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categories::all();

        return view('dashboard.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    private function generateUniqueSlug($name, $id = null)
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $count = 1;

        while (\App\Models\Product::where('slug', $slug)
            ->when($id, function ($query) use ($id) {
                return $query->where('id', '!=', $id);
            })->exists()) {
            $slug = $originalSlug.'-'.$count;
            $count++;
        }

        return $slug;
    }

    public function store(Request $request)
    {
        if (! $request->filled('slug')) {
            $request->merge(['slug' => $this->generateUniqueSlug($request->name)]);
        }

        // Validasi input produk
        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            // hapus validasi slug karena slug tidak diinput user
            'sku' => 'required|string|unique:products,sku',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'product_category_id' => 'nullable|exists:product_categories,id',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',  // Validasi gambar upload
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with(
                [
                    'errors' => $validator->errors(),
                    'errorMessage' => 'Validasi Error, Silahkan lengkapi data terlebih dahulu',
                ]
            );
        }

        $product = new Product;
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->description = $request->description;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->product_category_id = $request->product_category_id;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'_'.$image->getClientOriginalName();
            $imagePath = $image->storeAs('uploads/products', $imageName, 'public');
            $product->image_url = $imagePath;
        }

        $product->save();

        return redirect()->route('products.index')->with(
            [
                'success' => 'Produk berhasil ditambahkan.',
            ]
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $categories = Categories::all();

        return view('dashboard.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        if (! $request->filled('slug')) {
            $request->merge(['slug' => $this->generateUniqueSlug($request->name, $product->id)]);
        }

        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            // hapus validasi slug karena slug tidak diinput user
            'description' => 'nullable|string',
            'sku' => 'required|string|unique:products,sku,'.$product->id,
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'product_category_id' => 'nullable|exists:product_categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with(
                [
                    'errors' => $validator->errors(),
                    'errorMessage' => 'Validasi Error, Silahkan lengkapi data terlebih dahulu',
                ]
            );
        }

        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->description = $request->description;
        $product->sku = $request->sku;
        $product->product_category_id = $request->product_category_id;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'_'.$image->getClientOriginalName();
            $imagePath = $image->storeAs('uploads/products', $imageName, 'public');
            $product->image_url = $imagePath;
        }

        $product->save();

        return redirect()->route('products.index')
            ->with(
                [
                    'successMessage' => 'Data Berhasil Diupdate',
                ]
            );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        $product->delete();

        return redirect()->route('products.index')
            ->with('successMessage', 'Data Berhasil Dihapus');
    }

    /**
     * Toggle the active status of the product.
     */
    public function toggle(string $id)
    {
        if (request()->method() !== 'PATCH') {
            abort(405, 'Method Not Allowed');
        }

        $product = Product::findOrFail($id);

        return redirect()->back()->with('successMessage', 'Status produk berhasil diubah.');
    }

    /**
 * Toggle the active status and sync status of the product at once.
 */
    public function toggleAll(string $id)
    {
        if (request()->method() !== 'PATCH') {
            abort(405, 'Method Not Allowed');
        }

        $product = Product::findOrFail($id);

        return redirect()->back()->with('successMessage', 'Status produk & sync berhasil diubah.');
    }

    public function sync($id, Request $request)
      {
          $product = Product::findOrFail($id);
  
          $response = Http::post('https://api.phb-umkm.my.id/api/product/sync', [
              'client_id' => env('CLIENT_ID'),
              'client_secret' => env('CLIENT_SECRET'),
              'seller_product_id' => (string) $product->id,
              'name' => $product->name,
              'description' => $product->description,
              'price' => $product->price,
              'stock' => $product->stock,
              'sku' => $product->sku,
              'image_url' => $product->image_url,
              'weight' => $product->weight,
              'is_active' => $request->is_active == 1 ? false : true,
              'category_id' => (string) $product->category->hub_category_id,
          ]);
  
          if ($response->successful() && isset($response['product_id'])) {
              $product->hub_product_id = $request->is_active == 1 ? null : $response['product_id'];
              $product->save();
          }
  
          session()->flash('successMessage', 'Product Synced Successfully');
          return redirect()->back();
      }


}
