<!DOCTYPE html>
<html>
<head>
	<title>Data Karyawan</title>
	<style type="text/css">
		.center{
			text-align: center;
		}
		.full{
			width: 100%;
		}
		.wrapper{
			padding-left: 30px;
			padding-right: 30px;
		}
		.underline{
			text-decoration: underline;
		}
		.bt-1{
			border-top: 2px solid black;
		}
		.bb-1{
			border-bottom: 2px solid black;
		}
		.mt-1{
			margin-top: 5px;
		}
		.mb-1{
			margin-bottom: 5px;
		}
		table tr th,table tr td{
			text-align: left;
		}
	</style>
</head>
<body>
	<div class="center full">
		<h2 class="underline">Data Diri Karyawan</h2>
	</div>

	<div class="wrapper">
		<strong>Personal Data</strong>
		<div class="bt-1 bb-1">
			<div class="full">
				<div style="display: inline-block;width: 460px;">
					<table class="full mt-1 mb-1" style="margin-top: 50px;">
						<tr>
							<th width="100">Nama Lengkap :</th>
							<td>{{$karyawan->nama}}</td>
						</tr>
						<tr>
							<th>NIK :</th>
							<td>{{$karyawan->nik}}</td>
						</tr>
						<tr>
							<th>Nomor KTP :</th>
							<td>{{$karyawan->nomor_ktp}}</td>
						</tr>
						<tr>
							<th>Telp :</th>
							<td>{{$karyawan->telp}}</td>
						</tr>
						<tr>
							<th>Email :</th>
							<td>{{$karyawan->email}}</td>
						</tr>
						<tr>
							<th>Alamat</th>
							<td>{{$karyawan->detail_alamat}}</td>
						</tr>
						<tr>
							<th>Divisi</th>
							<td>{{$karyawan->nama_organisasi}}</td>
						</tr>
					</table>
				</div>
				<?php
				$foto = storage_path('app/foto/2345678909876543.png');
				if($karyawan->foto!=null) $foto = storage_path('app/'.$karyawan->foto);
				?>
				<img style="width: 150px;margin-top:5px;border: 1px solid lightgray;display: inline-block;float: right;" src="{{$foto}}">
			</div>
		</div>
	</div>
</body>
</html>