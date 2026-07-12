<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class JadwalSholatController extends Controller
{
    public function index()
    {
        $kota    = 'Bekasi';
        $negara  = 'ID';
        $tanggal = now()->format('d-m-Y');

        try {
            $response = Http::timeout(5)->get("https://api.aladhan.com/v1/timingsByCity", [
                'city'    => $kota,
                'country' => $negara,
                'method'  => 4, // Kemenag Indonesia
            ]);

            $timings = $response->json()['data']['timings'] ?? null;
        } catch (\Exception $e) {
            $timings = null;
        }

        $jadwal = null;
        if ($timings) {
            $jadwal = [
                'Subuh'   => $timings['Fajr']    ?? '-',
                'Dzuhur'  => $timings['Dhuhr']   ?? '-',
                'Ashar'   => $timings['Asr']     ?? '-',
                'Maghrib' => $timings['Maghrib'] ?? '-',
                'Isya'    => $timings['Isha']    ?? '-',
            ];
        }

        return view('home.jadwal-sholat', compact('jadwal', 'tanggal', 'kota'));
    }
}
