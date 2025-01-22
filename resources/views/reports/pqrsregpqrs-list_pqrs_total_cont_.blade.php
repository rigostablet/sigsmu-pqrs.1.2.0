
@extends('layouts.report')
@section('content')
<div id="report-title"><h1>bd_total_pqrs </h1></div>
<table class="table table-sm table-striped">
    <thead>
        <tr>
            <th>radicado</th>
            <th>fecha sol</th>
            <th>fec resp</th>
            <th>nombre entid</th>
            <th>nombre pet</th>
            <th>medio solic</th>
            <th>descrip sol</th>
            <th>email</th>
            <th>func notif</th>
            <th>dias resp</th>
            <th>dias pen</th>
            <th>estado pqrs</th>
            <th>usuario activo</th>
            <th>mun pet</th>
            <th>mun activo</th>
            <th>Date Created</th>
            <th>tipo petición</th>
            <th>munic petic</th>
            <th>oficina</th>
        </tr>
    </thead>
    <tbody>
        @foreach($records as $record)
        <tr>
            <td>{{ $record->rad_sol }}</td>
            <td>{{ $record->fec_sol }}</td>
            <td>{{ $record->fecrep_sol }}</td>
            <td>{{ $record->nom_ent_sol }}</td>
            <td>{{ $record->nom_pet_sol }}</td>
            <td>{{ $record->medio_sol }}</td>
            <td>{{ $record->desc_sol }}</td>
            <td>{{ $record->email_sol }}</td>
            <td>{{ $record->id_asig_sol }}</td>
            <td>{{ $record->regsol_dias }}</td>
            <td>{{ $record->diaspen_sol }}</td>
            <td>{{ $record->regsol_est }}</td>
            <td>{{ $record->usu_sol }}</td>
            <td>{{ $record->mun_sol }}</td>
            <td>{{ $record->mun_user_sol }}</td>
            <td>{{ $record->date_created }}</td>
            <td>{{ $record->pqrstipsol_tipsol_nombre }}</td>
            <td>{{ $record->pqrsmun_nom_mun }}</td>
            <td>{{ $record->user_nom_ofic_user }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
