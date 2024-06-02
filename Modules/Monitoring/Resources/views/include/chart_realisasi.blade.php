{{-- row atas --}}

<div class="col-md-8">
    <p class="text-center">
        <strong id="yearText">Realisasi Tahun: {{ date('Y') }}</strong>
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
            var unitSelect = document.getElementById('unitSelect');
            var currentYear = new Date().getFullYear();

            // Populate the yearSelect dropdown with options
            for (var i = currentYear; i >= currentYear - 4; i--) {
                var option = document.createElement('option');
                option.value = i;
                option.textContent = i;
                yearSelect.appendChild(option);
            }

            function fetchUnits() {
                fetch('/api/financial-data?year=' + currentYear)
                    .then(response => response.json())
                    .then(data => {
                        // Clear existing options
                        unitSelect.innerHTML = '';

                        var allOption = document.createElement('option');
                        allOption.value = '';
                        allOption.textContent = 'All Units';
                        unitSelect.appendChild(allOption);

                        // Populate options with fetched data
                        data.units.forEach(unit => {
                            var option = document.createElement('option');
                            option.value = unit.id;
                            option.textContent = unit.nama;
                            unitSelect.appendChild(option);
                        });

                        // Trigger chart update with default year and selected unit
                        var selectedYear = yearSelect.value;
                        var selectedUnit = unitSelect.value;
                        updateChart(selectedYear, selectedUnit);
                    })
                    .catch(error => console.error('Error fetching units:', error));
            }

            // Populate unitSelect dropdown on page load
            fetchUnits();

            // Event listener for year select dropdown
            yearSelect.addEventListener('change', function() {
                var selectedYear = this.value;
                var selectedUnit = unitSelect.value;
                updateChart(selectedYear, selectedUnit);
            });

            // Event listener for unit select dropdown
            unitSelect.addEventListener('change', function() {
                var selectedYear = yearSelect.value;
                var selectedUnit = this.value;
                updateChart(selectedYear, selectedUnit);
            });

            function updateChart(year, unit) {
                // Fetch data from API
                fetch(`/api/financial-data?year=${year}&unit=${unit}`)
                    .then(response => response.json())
                    .then(data => {
                        // Update chart with new data
                        var ctx = document.getElementById('lineChart').getContext('2d');
                        if (window.myChart) {
                            window.myChart.destroy();
                        }
                        window.myChart = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep',
                                    'Oct', 'Nov', 'Dec'
                                ],
                                datasets: [{
                                    label: 'Monthly Target',
                                    data: data.monthlyTarget,
                                    backgroundColor: 'rgba(0, 0, 255, 0.5)',
                                    borderColor: 'rgba(0, 0, 255, 0.5)',
                                    fill: true,
                                    borderWidth: 1,
                                    tension: 0.5
                                }, {
                                    label: 'Monthly Realization',
                                    data: data.monthlyRealization,
                                    backgroundColor: 'rgba(255, 0, 0, 0.5)',
                                    borderColor: 'rgba(255, 0, 0, 0.5)',
                                    fill: true,
                                    borderWidth: 1,
                                    tension: 0.5
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    })
                    .catch(error => console.error('Error fetching financial data:', error));
            }
        });
    </script>
@endpush
