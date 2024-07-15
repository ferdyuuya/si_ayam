<table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>No</th>
                <th>Ayam Mati</th>
                <th>Ayam Sakit</th>
                <th>Ayam Berhasil</th>
                <th>Total Ayam</th>
                <th>Total Awal Ayam</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($ternak as $kolom_ternak)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $kolom_ternak->ayam_mati }} Ekor</td>
                <td>{{ $kolom_ternak->ayam_sakit }} Ekor</td>
                <td>{{ $kolom_ternak->ayam_berhasil }} Ekor</td>
                <td>{{ $kolom_ternak->total_ayam }} Ekor</td>
                <td>{{ $kolom_ternak->total_awal_ayam }} Ekor</td>
                <td>{{ $kolom_ternak->is_ongoing }}</td> 
              </tr>
              @endforeach
            </tbody>
          </table>