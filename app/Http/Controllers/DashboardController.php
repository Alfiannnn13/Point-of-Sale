<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Supplier;
use App\Models\Member;
use App\Models\Penjualan;
use App\Models\Pembelian;
use App\Models\Pengeluaran;

class DashboardController extends Controller
{
    public function index()
    {
        $kategori = Kategori::count();
        $produk  = Produk::count();
        $supplier = Supplier::count();
        $member = Member::count();

        $tanggal_awal= date('Y-m-01');
        $tanggal_akhir= date('Y-m-d');
        $data_tanggal = array();
        $data_pendapatan = array();

        while (strtotime($tanggal_awal) <= strtotime($tanggal_akhir)) {
            $data_tanggal []= (int) substr($tanggal_awal, 8, 2);
            

            $total_penjualan = Penjualan::where('created_at', 'LIKE', "%$tanggal_awal%")->sum('bayar');
            $total_pembelian = Pembelian::where('created_at', 'LIKE', "%$tanggal_awal%")->sum('bayar');
            $total_pengeluaran = Pengeluaran::where('created_at', 'LIKE', "%$tanggal_awal%")->sum('nominal');
            $pendapatan = $total_penjualan;
            $data_pendapatan[] +=($pendapatan);

            $tanggal_awal = date('Y-m-d', strtotime("+1 day", strtotime($tanggal_awal)));
        }

        if (auth()->user()->level == 1) {
            return view('admin.dashboard', compact('kategori', 'produk', 'supplier', 'member', 'tanggal_awal', 'tanggal_akhir', 'data_tanggal', 'data_pendapatan'));
        } else {
            return view('kasir.dashboard');
        }
    }
}
