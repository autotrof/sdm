<table>
	<thead>
		<tr>
			<th colspan="2" rowspan="2"></th>
			<th colspan="5" style="text-align: center;"><strong>EXPORT DATA KARYAWAN</strong></th>
		</tr>
		<tr>
			<th></th>
		</tr>
		<tr>
			<th>NAMA</th>
			<th>KTP</th>
			<th>NIK</th>
			<th>TELP</th>
			<th>EMAIL</th>
			<th>DETAIL ALAMAT</th>
			<th>STATUS</th>
			<th>BPJS KESEHATAN</th>
			<th>BPJS KETENAGAKERJAAN</th>
			<th>ORGANISASI_ID</th>
		</tr>
	</thead>
	<tbody>
		@foreach($list_karyawan as $karyawan)
		<tr>
			<td>{{$karyawan->nama}}</td>
			<td>{{$karyawan->nomor_ktp}}</td>
			<td>{{$karyawan->nik}}</td>
			<td>{{$karyawan->telp}}</td>
			<td>{{$karyawan->email}}</td>
			<td>{{$karyawan->detail_alamat}}</td>
			<td>{{$karyawan->status}}</td>
			<td>{{$karyawan->nomor_bpjs_kesehatan}}</td>
			<td>{{$karyawan->nomor_bpjs_ketenagakerjaan}}</td>
			<td>{{$karyawan->organisasi_id}}</td>
		</tr>
		@endforeach
	</tbody>
</table>