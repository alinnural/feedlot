@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row">
        @include('layouts.menu')
      <div class="col-md-9">
        <ul class="breadcrumb">
          <li><a href="{{ url('/') }}">Dashboard</a></li>
          <li><a href="{{ url('/feed') }}">Jenis Pakan</a></li>
          <li class="active">Lihat Jenis Pakan</li>
        </ul>
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="btn-group pull-right">
                    <a class="btn btn-primary btn-sm" href="{{ route('feed.list') }}"><i class="fa fa-arrow-left"></i> Kembali</a>
                    <a href="#" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-download"></i> Unduh Nutrisi Pakan</a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('feed.download.excel', $feed->id) }}"><i class="fa fa-excel"></i> Excel</a></li>
                        <li><a href="{{ route('feed.download.pdf', $feed->id) }}"><i class="fa fa-pdf"></i> PDF</a></li>
                    </ul>
                </div>
                <h2 class="panel-title" style="padding-bottom:5px;padding-top:5px;">&nbsp;</h2>
            </div>
            <div class="panel-body">
            <table class="table table-hover">
                <tr>
                    <td>Nama Pakan</td>
                    <td><b>{{ strtoupper($feed->feed_stuff)}}</b></td>
                </tr>
                <tr>
                    <td>Kelompok Pakan</td>
                    <td>{{ $feed->groupfeed->name }}</td>
                </tr>
            </table>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-striped table-responsive">
                        <thead>
                            <tr>
                                <th>Nutrisi</th>
                                <th>Singkatan</th>
                                <th>Satuan</th>
                                <th class="text-right">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Total Digestibel Nutrients</td>
                                <td>TDN</td>
                                <td>%DM</td>
                                <td class="text-right">{{ number_format((float)$feed->total_digestible_nutrients,2,'.','')}}</td>
                            </tr>
                            <tr>
                                <td>Crude Protein</td>
                                <td>CP</td>
                                <td>%DM</td>
                                <td class="text-right">{{ number_format((float)$feed->crude_protein,2,'.','')}}</td>
                            </tr>
                            <tr>
                                <td>Calsium</td>
                                <td>Ca</td>
                                <td>%DM</td>
                                <td class="text-right">{{ number_format((float)$feed->calcium,2,'.','')}}</td>
                            </tr>
                            <tr>
                                <td>Phosphorus</td>
                                <td>P</td>
                                <td>%DM</td>
                                <td class="text-right">{{ number_format((float)$feed->phosphorus,2,'.','')}}</td>
                            </tr>
                            <tr>
                                <td>Dry Matter Intake</td>
                                <td>DM</td>
                                <td>%</td>
                                <td class="text-right">{{ number_format((float)$feed->dry_matter,2,'.','')}}</td>
                            </tr>
                            <tr>
                                <td>Mineral</td>
                                <td>Ash</td>
                                <td>%DM</td>
                                <td class="text-right">{{ number_format((float)$feed->mineral,2,'.','')}}</td>
                            </tr>
                            <tr>
                                <td>Organic Matter</td>
                                <td>OM</td>
                                <td>%DM</td>
                                <td class="text-right">{{ number_format((float)$feed->organic_matter,2,'.','')}}</td>
                            </tr>
                            <tr>
                                <td>Lignin</td>
                                <td>Lig</td>
                                <td>%DM</td>
                                <td class="text-right">{{ number_format((float)$feed->lignin,2,'.','')}}</td>
                            </tr>
                            <tr>
                                <td>Neutral Detergent Fiber</td>
                                <td>NDF</td>
                                <td>%DM</td>
                                <td class="text-right">{{ number_format((float)$feed->neutral_detergent_fiber,2,'.','')}}</td>
                            </tr>
                            <tr>
                                <td>Ether Extract</td>
                                <td>EE</td>
                                <td>%DM</td>
                                <td class="text-right">{{ number_format((float)$feed->ether_extract,2,'.','')}}</td>
                            </tr>
                            <tr>
                                <td>Non Fiber Carbohydrates</td>
                                <td>NFC</td>
                                <td>%DM</td>
                                <td class="text-right">{{ number_format((float)$feed->nonfiber_carbohydrates,2,'.','')}}</td>
                            </tr>
                            <tr>
                                <td>Metabolizable Energy</td>
                                <td>ME</td>
                                <td>Mcal/kg</td>
                                <td class="text-right">{{ number_format((float)$feed->metabolizable_energy,2,'.','')}}</td>
                            </tr>
                            <tr>
                                <td>Rumen Degradable Protein</td>
                                <td>RDP</td>
                                <td>%DM</td>
                                <td class="text-right">{{ number_format((float)$feed->rumen_degradable_dm,2,'.','')}}</td>
                            </tr>
                            <tr>
                                <td>Rumen Degradable Protein</td>
                                <td>RDP</td>
                                <td>%CP</td>
                                <td class="text-right">{{ number_format((float)$feed->rumen_degradable_cp,2,'.','')}}</td>
                            </tr>
                            <tr>
                                <td>Rumen Undergradable Protein</td>
                                <td>RUP</td>
                                <td>%DM</td>
                                <td class="text-right">{{ number_format((float)$feed->rumen_undergradable_dm,2,'.','')}}</td>
                            </tr>
                            <tr>
                                <td>Rumen Undergradable Protein</td>
                                <td>NDF</td>
                                <td>%CP</td>
                                <td class="text-right">{{ number_format((float)$feed->rumen_undergradable_cp,2,'.','')}}</td>
                            </tr>
                            <tr>
                                <td>Rumen Soluble Protein fraction A</td>
                                <td>CP A</td>
                                <td>%CP</td>
                                <td class="text-right">{{ number_format((float)$feed->rumen_soluble,2,'.','')}}</td>
                            </tr>
                            <tr>
                                <td>Rumen Insoluble Protein Fraction B</td>
                                <td>CP B</td>
                                <td>%CP</td>
                                <td class="text-right">{{ number_format((float)$feed->rumen_insoluble,2,'.','')}}</td>
                            </tr>
                            <tr>
                                <td>Degradation rate of fraction B</td>
                                <td>CP kd</td>
                                <td>%</td>
                                <td class="text-right">{{ number_format((float)$feed->degradation_rate,2,'.','')}}</td>
                            </tr>
                            <tr>
                                <td>Metabolizable Protein</td>
                                <td>MP</td>
                                <td>%DM</td>
                                <td class="text-right">{{ number_format((float)$feed->metabolizable_protein,2,'.','')}}</td>
                            </tr>
                            <tr>
                                <td>Magnesium</td>
                                <td>Mg</td>
                                <td>%DM</td>
                                <td class="text-right">{{ number_format((float)$feed->magnesium,2,'.','')}}</td>
                            </tr>
                            <tr>
                                <td>Potassium</td>
                                <td>K</td>
                                <td>%DM</td>
                                <td class="text-right">{{ number_format((float)$feed->potassium,2,'.','')}}</td>
                            </tr>
                            <tr>
                                <td>Sodium</td>
                                <td>Na</td>
                                <td>%DM</td>
                                <td class="text-right">{{ number_format((float)$feed->sodium,2,'.','')}}</td>
                            </tr>
                            <tr>
                                <td>Sulfur</td>
                                <td>S</td>
                                <td>%DM</td>
                                <td class="text-right">{{ number_format((float)$feed->sulfur,2,'.','')}}</td>
                            </tr>
                            <tr>
                                <td>Cobalt</td>
                                <td>Co</td>
                                <td>mg/kg</td>
                                <td class="text-right">{{ number_format((float)$feed->cobalt,2,'.','')}}</td>
                            </tr>
                            <tr>
                                <td>Copper</td>
                                <td>Cu</td>
                                <td>mg/kg</td>
                                <td class="text-right">{{ number_format((float)$feed->copper,2,'.','')}}</td>
                            </tr>
                            <tr>
                                <td>Iodine</td>
                                <td>I</td>
                                <td>mg/kg</td>
                                <td class="text-right">{{ number_format((float)$feed->iodine,2,'.','')}}</td>
                            </tr>
                            <tr>
                                <td>Manganese</td>
                                <td>Mn</td>
                                <td>mg/kg</td>
                                <td class="text-right">{{ number_format((float)$feed->manganese,2,'.','')}}</td>
                            </tr>
                            <tr>
                                <td>Selenium</td>
                                <td>Se</td>
                                <td>mg/kg</td>
                                <td class="text-right">{{ number_format((float)$feed->selenium,2,'.','')}}</td>
                            </tr>
                            <tr>
                                <td>Zinc</td>
                                <td>Zn</td>
                                <td>mg/kg</td>
                                <td class="text-right">{{ number_format((float)$feed->zinc,2,'.','')}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection