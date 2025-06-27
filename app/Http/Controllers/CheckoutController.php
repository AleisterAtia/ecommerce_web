<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\ArhabOrderItem;  // Pastikan Model di-import
use App\Models\ArhabOrder;       // Pastikan Model di-import

class CheckoutController extends Controller
{
    /**
     * Memproses keranjang dan menyimpan pesanan ke database.
     */
    public function store(Request $request)
    {

        // 1. Ambil data keranjang dari session
        $cart = session('cart');

        // 2. Jika keranjang kosong, kembalikan dengan error
        if (!$cart) {
            return redirect()->route('home')->with('error', 'Your cart is empty.');
        }

        // Memulai Database Transaction
        // Ini untuk memastikan semua query berhasil, atau tidak sama sekali.
        // Mencegah data order dibuat tapi item-nya gagal dibuat.
        DB::beginTransaction();

        try {
            // dd(session('cart'), Auth::user());
            // 3. Hitung total harga dari keranjang
            $totalPrice = 0;
            foreach ($cart as $item) {
                $totalPrice += $item['price'] * $item['quantity'];
            }

            // 4. Buat entri baru di tabel 'arhab_orders'
            $order = new Order();
            $order->user_id = Auth::id(); // Mengambil ID user yang sedang login
            $order->order_number = 'ORD-' . Carbon::now()->format('YmdHis') . Auth::id(); // Membuat nomor order unik
            $order->status = 'pending'; // Status awal
            $order->total_price = $totalPrice;
            $order->save();

            // 5. Looping setiap item di keranjang dan simpan ke 'arhab_order_items'
            foreach ($cart as $productId => $item) {
                $orderItem = new OrderItem();
                $orderItem->order_id = $order->id; // ID dari order yang baru saja kita buat
                $orderItem->product_id = $productId;
                $orderItem->quantity = $item['quantity'];
                $orderItem->price = $item['price']; // Harga produk saat di-checkout
                $orderItem->save();

                // Di sini Anda bisa menambahkan logika untuk mengurangi stok produk jika perlu
                // DB::table('arhab_products')->where('id', $productId)->decrement('stock', $item['quantity']);
            }

            // Jika semua proses di atas berhasil, konfirmasi transaksi
            DB::commit();

            // 6. Hapus keranjang dari session setelah checkout berhasil
            session()->forget('cart');

            // 7. Arahkan ke halaman sukses dengan pesan
            return redirect()->route('checkout.success')->with('success', 'Your order has been placed successfully!');

        } catch (\Exception $e) {
            // Jika terjadi error di tengah jalan, batalkan semua query database
            DB::rollBack();

            // Arahkan kembali dengan pesan error
            // Sebaiknya log error ini untuk debugging: \Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred during checkout. Please try again.');
        }
    }

    /**
     * Menampilkan halaman setelah checkout berhasil.
     */
    public function success()
    {
        // Pastikan halaman ini hanya bisa diakses setelah redirect dari proses checkout
        if (!session('success')) {
            return redirect()->route('home');
        }

        return view('checkout-success'); // Kita akan buat view ini
    }
}