<table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Stok Pangan</th>
                <th>Stok Pangan Keluar</th>
                <th>Stok Sekarang</th>
                <th>Ternak yang sedang berlangsung</th>
                <th>Diupdate oleh</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($pangan as $kolom_pangan)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $kolom_pangan->created_at }}</td>
                  <td>{{ $kolom_pangan->pemasukan_stok }}</td>
                  <td>{{ $kolom_pangan->pengeluaran_stok }}</td>
                  <td>{{ $kolom_pangan->stok_sekarang }}</td>
                  <td>{{ $kolom_pangan->id_ternak }}</td>
                  <td>{{ $kolom_pangan->updated_by }}</td>
                </tr>
              @endforeach
            </tbody>
</table>