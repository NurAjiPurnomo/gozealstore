<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Product;
use App\Models\Theme;
use Binafy\LaravelCart\Models\Cart;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    private $themeFolder;

    public function __construct()
    {
        $theme = Theme::where('status', 'active')->first();
        if ($theme) {
            $this->themeFolder = $theme->folder;
        } else {
            $this->themeFolder = 'theme.default';
        }
    }

    public function index()
    {
        $categories = Categories::latest()->take(4)->get();
        $products = Product::paginate(20);

        return view($this->themeFolder.'.homepage', [
            'categories' => $categories,
            'products' => $products,
            'title' => 'Homepage',
        ]);
    }

    public function products(Request $request)
    {
        $title = 'Products';

        $query = Product::whereHas('category', function ($q) {
            $q->whereNotNull('id');
        });

        if ($request->has('search') && $request->search) {
            $query->where('name', 'like', '%'.$request->search.'%');
        }

        $products = $query->paginate(20);

        // Ensure image_url accessor is appended for each product
        $products->getCollection()->transform(function ($product) {
            $product->append('image_url');

            return $product;
        });

        return view($this->themeFolder.'.products', [
            'title' => $title,
            'products' => $products,
        ]);
    }

    public function product($slug)
    {
        $product = Product::whereHas('category', function ($q) {
            $q->whereNotNull('id');
        })->whereSlug($slug)->first();

        if (! $product) {
            return abort(404);
        }

        $relatedProducts = Product::whereHas('category', function ($q) {
            $q->whereNotNull('id');
        })->where('product_category_id', $product->product_category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        return view($this->themeFolder.'.product', [
            'slug' => $slug,
            'product' => $product,
            'relatedProducts' => $relatedProducts,
        ]);
    }

    public function categories()
    {
        $categories = Categories::latest()->paginate(20);

        return view($this->themeFolder.'.categories', [
            'title' => 'Categories',
            'categories' => $categories,
        ]);
    }

    public function category($slug)
    {
        $category = Categories::get()->firstWhere('slug', $slug);

        if ($category) {
            $products = Product::where('product_category_id', $category->id)->paginate(20);

            // Append image_url accessor for each product
            $products->getCollection()->transform(function ($product) {
                $product->append('image_url');

                return $product;
            });

            return view($this->themeFolder.'.category_by_slug', [
                'slug' => $slug,
                'category' => $category,
                'products' => $products,
            ]);
        } else {
            return abort(404);
        }
    }

    public function cart()
    {
        if (! auth()->guard('customer')->check()) {
            return redirect()->route('customer.login'); // arahkan ke halaman login customer jika belum login
        }

        $cart = Cart::query()
            ->with([
                'items',
                'items.itemable',
            ])
            ->where('user_id', auth()->guard('customer')->user()->id)
            ->first();

        return view($this->themeFolder.'.cart', [
            'title' => 'Cart',
            'cart' => $cart,
        ]);
    }

    public function checkout()
    {
        return view($this->themeFolder.'.checkout', [
            'title' => 'Checkout',
        ]);
    }
}
