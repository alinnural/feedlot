<html>
    <header>
    </header>
    <body style="margin:10px">
        <h1>Formulasi Ransum</h1>
        <hr>
        <table cellpadding=10>
            <tr>
                <th width="100px" style="text-align:left">Nama Ransum</th>
                <td width="150px" >{{ $forsum->name }}</td>
                <th width="300px" style="text-align:left">Keterangan</th>
                <td rowspan=2 valign="top">{{ $forsum->explanation }}</td>
            </tr>
            <tr>
                <th width="100px" style="text-align:left">Kuantitas Ransum</th>
                <td>{{ $kuantitas }} kg</td>
            </tr>
        </table>
        <br><br>
        <table cellpadding="10">
            <tr>
                <th style="border-style: solid; border-width: 0px 1px 1px 0px; text-align:left;">Pakan</th>
                <th style="border-style: solid; border-width: 0px 1px 1px 0px; text-align:left">Persentase</th>
                <th style="border-style: solid; border-width: 0px 1px 1px 0px; text-align:left">Harga</th>
                <th style="border-style: solid; border-width: 0px 1px 1px 0px; text-align:left">Kuantitas</th>
                <th style="border-style: solid; border-width: 0px 1px 1px 0px; text-align:left">Total Harga</th>
            </tr>
            @php $kuantitas=0; $total_price_kuant = 0; @endphp   
            @foreach ($forfeeds as $item)
            <tr>
                <td style="border-style: solid; border-width: 0px 1px 0px 0px; text-align:left">{{ $item->feed->name }}</td>
                <td style="border-style: solid; border-width: 0px 1px 0px 0px; text-align:left"><span class='align-center'>{{ $item->result }} %</span></td>
                <td style="border-style: solid; border-width: 0px 1px 0px 0px; text-align:left"><span class='pull-left'>IDR</span> <span class='pull-right'>{{ $item->price }} / kg</span></td>
                <td style="border-style: solid; border-width: 0px 1px 0px 0px; text-align:left"><span class='pull-right'>@php $kuant = $item->result*1000/100; $kuantitas+=$kuant; @endphp {{ $kuant }} kg</span></td>
                <td style="border-style: solid; border-width: 0px 1px 0px 0px; text-align:left"><span class='pull-left'>IDR</span><span class='pull-right'>@php $price_kuant = $item->price*$kuant; $total_price_kuant+=$price_kuant; @endphp {{ number_format($price_kuant, 2, ',', '.') }}</span></td>
            </tr>
            @endforeach
            <tr>
                <td style="border-style: solid; border-width: 1px 1px 0px 0px; text-align:left"><strong><h4>{!! Form::label('var', 'Harga Terakhir', ['class' => 'control-label']) !!}</strong></h4></td>
                <td style="border-style: solid; border-width: 1px 1px 0px 0px; text-align:left">&nbsp;</td>
                <td style="border-style: solid; border-width: 1px 1px 0px 0px; text-align:left"><strong><h4><span class='pull-left'>IDR</span> <span class='pull-right'>{{ round($forsum->total_price) }} /kg</span></h4></strong></td>
                <td style="border-style: solid; border-width: 1px 1px 0px 0px; text-align:left"><span class='pull-right'><h4>{{ $kuantitas }} kg</h4></span></td>
                <td style="border-style: solid; border-width: 1px 1px 0px 0px; text-align:left"><strong><h4><span class='pull-left'>IDR</span><span class='pull-right'>{{ number_format($total_price_kuant, 2, ',', '.') }}</h4></span></td>
            </tr>
        </table>
    </body>
</html>