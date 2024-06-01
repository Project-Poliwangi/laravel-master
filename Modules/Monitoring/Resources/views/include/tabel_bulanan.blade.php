{{-- tabel rekapitulasi --}}
<div class="col-lg-12">
    <div class="btn-group" role="group" aria-label="Table toggles">
        <button type="button" class="btn btn-primary" id="btn-table-1">Rekapitulasi Keuangan</button>
        <button type="button" class="btn btn-outline-primary" id="btn-table-2">Rekapitulasi Kendala</button>
        <button type="button" class="btn btn-outline-primary" id="btn-table-3">Rekapitulasi Data</button>
    </div>

    <div id="table-1" class="table-responsive">
        <div class="card">
            <div class="card-body p-0">
                <table class="table table-hover">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>Bulan</th>
                            <th>Target</th>
                            <th>Realisasi</th>
                            <th>%Serapan Akumulatif</th>
                            <th>%Serapan Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>cek</td>
                            <td>cek</td>
                            <td>cek</td>
                            <td>cek</td>
                            <td>cek</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="table-2" class="table-responsive" style="display: none;">
        <div class="card">
            <div class="card-body p-0">
                <table class="table table-hover">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>Bulan</th>
                            <th>Unit</th>
                            <th>Kendala</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>cek</td>
                            <td>cek</td>
                            <td>cek</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="table-3" class="table-responsive" style="display: none;">
        <div class="card">
            <div class="card-body p-0">
                <table class="table table-hover">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>Bulan</th>
                            <th>Unit</th>
                            <th>Realisasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>cek</td>
                            <td>cek</td>
                            <td>cek</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('js')
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const table1 = document.getElementById('table-1');
        const table2 = document.getElementById('table-2');
        const table3 = document.getElementById('table-3');
        const btnTable1 = document.getElementById('btn-table-1');
        const btnTable2 = document.getElementById('btn-table-2');
        const btnTable3 = document.getElementById('btn-table-3');

        btnTable1.addEventListener('click', () => {
            table1.style.display = 'block';
            table2.style.display = 'none';
            table3.style.display = 'none';
            btnTable1.classList.add('btn-primary');
            btnTable1.classList.remove('btn-outline-primary');
            btnTable2.classList.add('btn-outline-primary');
            btnTable2.classList.remove('btn-primary');
            btnTable3.classList.add('btn-outline-primary');
            btnTable3.classList.remove('btn-primary');
        });

        btnTable2.addEventListener('click', () => {
            table1.style.display = 'none';
            table2.style.display = 'block';
            table3.style.display = 'none';
            btnTable1.classList.add('btn-outline-primary');
            btnTable1.classList.remove('btn-primary');
            btnTable2.classList.add('btn-primary');
            btnTable2.classList.remove('btn-outline-primary');
            btnTable3.classList.add('btn-outline-primary');
            btnTable3.classList.remove('btn-primary');
        });

        btnTable3.addEventListener('click', () => {
            table1.style.display = 'none';
            table2.style.display = 'none';
            table3.style.display = 'block';
            btnTable1.classList.add('btn-outline-primary');
            btnTable1.classList.remove('btn-primary');
            btnTable2.classList.add('btn-outline-primary');
            btnTable2.classList.remove('btn-primary');
            btnTable3.classList.add('btn-primary');
            btnTable3.classList.remove('btn-outline-primary');
        });
    });
</script>
@endpush
