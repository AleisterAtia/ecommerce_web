<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua produk, beserta relasi kategorinya untuk efisiensi
        $products = Product::with('category')->latest()->get();

        // Ambil semua kategori untuk filter dropdown
        $categories = Category::all();

        // Ambil satu produk untuk dijadikan hero product (contoh: produk terbaru)
        $heroProduct = Product::latest()->first();
        // Anda bisa mengganti ini dengan logika lain, misal ->where('is_bestseller', true)->first()

        // Kirim semua data ke view
        return view('product.index', [
            'products' => $products,
            'categories' => $categories,
            'heroProduct' => $heroProduct,
        ]);
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart!');
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('product.show', compact('product'));
    }

    public function addToCart($id)
    {
        $product = Product::findOrFail($id);

        // Cari order "pending" milik user
        $order = Order::firstOrCreate(
            ['user_id' => Auth::id(), 'status' => 'pending'],
            ['total' => 0]
        );

        // Cek apakah item sudah ada di keranjang
        $orderItem = OrderItem::where('order_id', $order->id)
            ->where('product_id', $product->id)
            ->first();

        if ($orderItem) {
            // Jika sudah ada, tambahkan quantity
            $orderItem->quantity += 1;
            $orderItem->save();
        } else {
            // Jika belum ada, buat baru
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'price' => $product->price,
                'quantity' => 1,
            ]);
        }

        return redirect()->back()->with('success', 'Produk ditambahkan ke keranjang.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
