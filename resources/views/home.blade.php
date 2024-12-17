<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="w-full max-w-4xl bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-center mb-6">Grafik Pengunjung</h2>
        <canvas id="lineChart" class="w-full h-64 relative"></canvas>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Data dari Laravel Controller
        const labels = @json($label); // Labels (bulan)
        const dataAktual = @json($data); // Data Pengunjung Domestik
        const dataForecast = @json($hasil); // Data Pengunjung Internasional

        // Inisialisasi Chart.js
        const ctx = document.getElementById('lineChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Data Pengunjung Aktual',
                        data: dataAktual,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderWidth: 2,
                        tension: 0.3,
                    },
                    {
                        label: 'Data Pengunjung Forecast',
                        data: dataForecast,
                        borderColor: 'rgba(255, 99, 132, 1)',
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderWidth: 2,
                        tension: 0.3,
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                    },
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Tahun-Bulan',
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Jumlah Pengunjung',
                        },
                        beginAtZero: true,
                    }
                }
            }
        });
    </script>
</x-layout>
