{{-- row atas --}}

<div class="col-md-8">
    <p class="text-center">
        <strong id="yearText">Realisasi Tahun:  {{date('Y')}}</strong>
    </p>
    <!-- chart-->
    <div class="chart">
        <!-- Sales Chart Canvas -->
        <canvas id="lineChart" style="max-height: 700px; max-width: 100%;"></canvas>
    </div>
    <!-- end-->
</div>

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var yearSelect = document.getElementById('yearSelect');
            var currentYear = new Date().getFullYear();

            // Populate the yearSelect dropdown with options
            for (var i = currentYear; i >= currentYear - 4; i--) {
                var option = document.createElement('option');
                option.value = i;
                option.textContent = i;
                yearSelect.appendChild(option);
            }

            var ctx = document.getElementById('lineChart').getContext('2d');
            var barChart;

            function updateChart(year) {
                fetch(`/api/financial-data?year=${year}`)
                    .then(response => response.json())
                    .then(data => {
                        if (barChart) {
                            barChart.destroy(); // Destroy the old chart instance
                        }
                        barChart = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep',
                                    'Okt', 'Nov', 'Des'
                                ],
                                datasets: [{
                                        label: 'Target Keuangan',
                                        data: data.monthlyTarget,
                                        backgroundColor: 'rgba(0, 0, 255, 0.5)',
                                        borderColor: 'rgba(0, 0, 255, 0.5)',
                                        pointBorderWidth: 1,
                                        borderWidth: 1,
                                        tension: 0.5,
                                        fill: true
                                    },
                                    {
                                        label: 'Realisasi Keuangan',
                                        data: data.monthlyRealization,
                                        backgroundColor: 'rgba(255, 0, 0, 0.5)',
                                        borderColor: 'rgba(255, 0, 0, 0.5)',
                                        borderWidth: 1,
                                        tension: 0.5,
                                        fill: true
                                    }
                                ]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                },
                                plugins: {
                                    legend: {
                                        labels: {
                                            boxWidth: 15,
                                            padding: 20
                                        }
                                    },
                                }
                            }
                        });
                    })
                    .catch(error => console.error('Error fetching financial data:', error));
            }

            yearSelect.addEventListener('change', function() {
                var selectedYear = this.value;
                updateChart(selectedYear);
            });

            // Initialize chart with default year
            updateChart(currentYear);
        });
    </script>
@endpush
