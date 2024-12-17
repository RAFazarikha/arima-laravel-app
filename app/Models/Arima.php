<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Arima extends Model
{
    public function calculate($data, $p, $d, $q)
    {
        $n = count($data);

        if ($n <= max($p, $d, $q)) {
            throw new \Exception("Data tidak cukup untuk model ARIMA.");
        }

        // Tahap 1: Differencing
        $differenced = $data;
        for ($i = 0; $i < $d; $i++) {
            $differenced = $this->difference($differenced);
        }

        // Tahap 2: Estimasi parameter AR dan MA (sederhana dengan rata-rata)
        $ar_coeffs = $this->estimateAR($differenced, $p);
        $ma_coeffs = $this->estimateMA($differenced, $q);

        // Tahap 3: Forecasting
        $forecast = $this->forecast($data, $ar_coeffs, $ma_coeffs, $p, $q);

        // Tambahkan 12 bulan prediksi ke depan
        $extended_forecast = $this->forecastNextPeriods($data, $forecast, $ar_coeffs, $ma_coeffs, $p, $q, 12);

        return $extended_forecast;
    }

    private function difference($data)
    {
        $diff = [];
        for ($i = 1; $i < count($data); $i++) {
            $diff[] = $data[$i] - $data[$i - 1];
        }
        return $diff;
    }

    private function estimateAR($data, $p)
    {
        $coeffs = array_fill(0, $p, 0.5); // Dummy coefficients (harus dihitung lebih kompleks)
        return $coeffs;
    }

    private function estimateMA($data, $q)
    {
        $coeffs = array_fill(0, $q, 0.5); // Dummy coefficients (harus dihitung lebih kompleks)
        return $coeffs;
    }

    private function forecast($data, $ar_coeffs, $ma_coeffs, $p, $q)
    {
        $n = count($data);
        $forecast = [];

        for ($i = 0; $i < $n; $i++) {
            $ar_term = 0;
            for ($j = 1; $j <= $p; $j++) {
                if ($i - $j >= 0) {
                    $ar_term += $ar_coeffs[$j - 1] * $data[$i - $j];
                }
            }

            $ma_term = 0;
            for ($j = 1; $j <= $q; $j++) {
                if ($i - $j >= 0) {
                    $ma_term += $ma_coeffs[$j - 1] * ($data[$i - $j] - ($forecast[$i - $j] ?? 0));
                }
            }

            $forecast[] = $ar_term + $ma_term;
        }

        return $forecast;
    }

    private function forecastNextPeriods($data, $forecast, $ar_coeffs, $ma_coeffs, $p, $q, $periods)
    {
        $n = count($data);
        $extended_forecast = $forecast;

        for ($i = 0; $i < $periods; $i++) {
            $ar_term = 0;
            for ($j = 1; $j <= $p; $j++) {
                $index = $n + $i - $j;
                if ($index >= 0) {
                    $ar_term += $ar_coeffs[$j - 1] * ($extended_forecast[$index] ?? $data[$index]);
                }
            }

            $ma_term = 0;
            for ($j = 1; $j <= $q; $j++) {
                $index = $n + $i - $j;
                if ($index >= 0) {
                    $ma_term += $ma_coeffs[$j - 1] * (0); // Asumsikan noise = 0 untuk prediksi ke depan
                }
            }

            $extended_forecast[] = $ar_term + $ma_term;
        }

        return $extended_forecast;
    }
}
