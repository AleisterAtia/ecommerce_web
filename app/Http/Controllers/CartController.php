<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ArhabProduct; // Pastikan model Product Anda di-import

class CartController extends Controller
{
    /**
     * Menambahkan produk ke dalam keranjang (session).
     */
    public function add($productId)
    {
        // 1. Cari produk berdasarkan ID
        $product = Product::findOrFail($productId);

        // 2. Ambil data keranjang yang sudah ada dari session
        // Jika tidak ada, buat array kosong
        $cart = session()->get('cart', []);

        // 3. Cek apakah produk sudah ada di keranjang
        if (isset($cart[$productId])) {
            // Jika sudah ada, tambahkan quantity-nya
            $cart[$productId]['quantity']++;
        } else {
            // Jika belum ada, tambahkan produk baru ke keranjang
            $cart[$productId] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image
            ];
        }

        // 4. Simpan kembali data keranjang yang sudah diperbarui ke dalam session
        session()->put('cart', $cart);

        // 5. Kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function remove($id)
    {
        // 1. Ambil data keranjang dari session
        $cart = session()->get('cart');

        // 2. Cek apakah item dengan ID tersebut ada di keranjang
        if (isset($cart[$id])) {
            // 3. Hapus item dari array cart
            unset($cart[$id]);

            // 4. Simpan kembali array cart yang sudah diperbarui ke session
            session()->put('cart', $cart);
        }

        // 5. Kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Product removed successfully');
    }

    // Anda bisa menambahkan method lain seperti remove, update, clear di sini nanti
}