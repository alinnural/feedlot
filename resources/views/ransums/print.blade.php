<h1 style="text-align: center;">Dairy Feed Online</h1>
<h2 style="text-align: center;">Sistem Informasi Pakan Sapi Perah</h2>
<p style="text-align: center;">Web: http://dairyfeed.ipb.ac.id&nbsp;&nbsp;&nbsp;&nbsp; Email: dairyfeed@apps.ipb.ac.id</p>
<p style="text-align: center;">&nbsp;</p>
<h2 style="text-align: center;">Formulasi Ransum</h2>
<table style="height: 60px; width: 601.317px;">
<tbody>
<tr>
<td style="width: 101px;">Nama Ransum</td>
<td style="width: 10px;">:</td>
<td style="width: 464.317px;">{{ $forsum->name }}</td>
</tr>
<tr>
<td style="width: 101px;">Pengguna</td>
<td style="width: 10px;">:</td>
<td style="width: 464.317px;">{{ $forsum->user->name }}</td>
</tr>
<tr>
<td style="width: 101px;">Kuantitas</td>
<td style="width: 10px;">:</td>
<td style="width: 464.317px;">{{ $qty }} kg</td>
</tr>
</tbody>
</table>
<h3 style="text-align: center;">Komposisi Ransum</h3>
<table style="height: 100px; width: 700px; border-collapse: collapse;" border="1">
<tbody>
<tr>
<td rowspan=2 style="width: 32px; text-align: center;">No</td>
<td rowspan=2 style="width: 155px; text-align: center;">Bahan Pakan</td>
<td colspan=2 style="width: 100px; text-align: center;">Komposisi</td>
<td rowspan=2 style="width: 131.133px; text-align: center;">Harga (Rp/kg)</td>
<td rowspan=2 style="width: 159px; text-align: center;">Kuantitas (kg)</td>
</tr>
<tr>
<td style="width: 50px; text-align: center;">(%BK)</td>
<td style="width: 50px; text-align: center;">(%BS)</td>
</tr>
@php $no=1; $kuantitas=0; $total_price_kuant = 0; @endphp
@foreach ($forfeeds as $item)
<tr>
<td style="width: 32px; text-align: center;">{{ $no++ }}</td>
<td style="width: 155px;">{{ $item->feed->name }}</td>
<td style="width: 50px; text-align: center;">{{ $item->result }}</td>
<td style="width: 50px; text-align: center;">{{ $item->result_bs }}</td>
<td style="width: 131.133px; text-align: center;">{{ $item->price }}</td>
<td style="width: 159px; text-align: center;">@php $kuant = $item->result_bs*$qty/100; $kuantitas+=$kuant; @endphp {{ $kuant }}</td>
</tr>
@endforeach
<tr>
<td style="width: 32px;">&nbsp;</td>
<td style="width: 155px;">Total</td>
<td style="width: 50px; text-align: center;">100</td>
<td style="width: 50px; text-align: center;">100</td>
<td style="width: 131.133px; text-align: center;">&nbsp;</td>
<td style="width: 159px; text-align: center;">{{ $kuantitas }}</td>
</tr>
<tr>
<td style="width: 32px;">&nbsp;</td>
<td style="width: 155px;">Harga</td>
<td style="width: 50px; text-align: center;">&nbsp;</td>
<td style="width: 50px; text-align: center;">&nbsp;</td>
<td style="width: 131.133px; text-align: center;">Rp {{ $forsum->total_price }}/kg</td>
<td style="width: 159px; text-align: center;">Rp {{ number_format($forsum->total_price*$kuantitas, 2, ',', '.') }}</td>
</tr>
</tbody>
</table>
<h3 style="text-align: center;">Komposisi Nutrien Ransum</h3>
<table style="border-collapse: collapse; height: 100px; width: 700px;" border="1">
<tbody>
<tr>
<td style="width: 32px; text-align: center;">No</td>
<td style="width: 155px; text-align: center;">Nutrien</td>
<td style="width: 162.117px; text-align: center;">Min</td>
<td style="width: 117px; text-align: center;">Max</td>
<td style="width: 117px; text-align: center;">%</td>
</tr>
@php $no=1; @endphp
@foreach ($fornuts as $item)
<tr>
<td style="width: 32px; text-align: center;">{{ $no++ }}</td>
<td style="width: 155px;">{{ $item->nutrient->name }}</td>
<td style="width: 98.8667px; text-align: center;">{{ $item->min }}</td>
<td style="width: 131.133px; text-align: center;">{{ $item->max }}</td>
<td style="width: 159px; text-align: center;">{{ $item->result }}</td>
</tr>
@endforeach
</tbody>
</table>
<p>&nbsp;</p>
<p style="text-align: right;">Dicetak pada tanggal: @php echo date("d/m/Y") @endphp</p>