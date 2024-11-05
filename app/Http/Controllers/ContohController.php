<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use ArielMejiaDev\LarapexCharts\Facades\LarapexChart;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContohController extends Controller
{
    public function TampilContoh()
    {
        // Apakah user adalah admin
        $isAdmin = Auth::user()->role === 'admin';

        // Ambil produk dari database dan kelompokkan berdasarkan tanggal
        $produkPerHariQuery = Produk::selectRaw('DATE(created_at) as date, COUNT(*) as total')
            ->groupBy('date')
            ->orderBy('date', 'asc');

    // Filter by user_id jika user bukan admin
    if (!$isAdmin) {
        $produkPerHariQuery->where('user_id', Auth::id());
    }

    $produkPerHari = $produkPerHariQuery->get();

        // Memisahkan data untuk grafik
        $dates = [];
        $totals = [];

        foreach ($produkPerHari as $item) {
            $dates[] = Carbon::parse($item->date)->format('Y-m-d'); // Format tanggal
            $totals[] = $item->total;
        }

        // Membuat grafik menggunakan data yang diambil
        $chart = LarapexChart::barChart()
            ->setTitle('Produk Ditambahkan Per Hari')
            ->setSubtitle('Data Penambahan Produk Harian')
            ->addData('Jumlah Produk', $totals)
            ->setXAxis($dates);

        // Data tambahan untuk view
        $totalProductsQuery = Produk::query();

        // Filter by user_id if the user is not an admin
        if (!$isAdmin) {
            $totalProductsQuery->where('user_id', Auth::id());
        }

        // Data tambahan untuk view
        $data = [
            'totalProducts' => $totalProductsQuery->count(), // Total produk sesuai role
        ];


        // Data tambahan untuk view
        $data = [
            'totalProducts' => Produk::count(), // Total produk
            'salesToday' => 130, // Contoh data lainnya
            'totalRevenue' => 'Rp 75,000,000',
            'registeredUsers' => 350,
            'chart' => $chart // Pass chart ke view
        ];

        return view('contoh', $data);
    }
}
