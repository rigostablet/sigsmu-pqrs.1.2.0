
@extends('layouts.report')
@section('content')
<div id="report-title"><h1>listado pqrs</h1></div>
<table class="table table-sm table-striped">
    <thead>
        <tr>
            <th>rad</th>
            <th>fecSol</th>
            <th>fecResp</th>
            <th>Pqrstipsol Tipsol Nombre</th>
            <th>entidad solic</th>
            <th>nombre petic</th>
            <th>Medio Sol</th>
            <th>descripción</th>
            <th>email</th>
            <th>soporte</th>
            <th>mun pecti</th>
            <th>func notif</th>
            <th>dias asignados</th>
            <th>dias pend</th>
            <th>estado pqrs</th>
            <th>oficina</th>
            <th>mun activo</th>
            <th>usuario activo</th>
            <th>Date Created</th>
        </tr>
    </thead>
    <tbody>
        @foreach($records as $record)
        <tr>
            <td>{{ $record->rad_sol }}</td>
            <td>{{ $record->fec_sol }}</td>
            <td>{{ $record->fecrep_sol }}</td>
            <td>{{ $record->pqrstipsol_tipsol_nombre }}</td>
            <td>{{ $record->nom_ent_sol }}</td>
            <td>{{ $record->nom_pet_sol }}</td>
            <td>{{ $record->medio_sol }}</td>
            <td>{{ $record->desc_sol }}</td>
            <td>{{ $record->email_sol }}</td>
            <td>{{ $record->regsol_photo }}</td>
            <td>{{ $record->pqrsmun_nom_mun }}</td>
            <td>{{ $record->id_asig_sol }}</td>
            <td>{{ $record->regsol_dias }}</td>
            <td>{{ $record->diaspen_sol }}</td>
            <td>{{ $record->regsol_est }}</td>
            <td>{{ $record->user_nom_ofic_user }}</td>
            <td>{{ $record->mun_user_sol }}</td>
            <td>{{ $record->usu_sol }}</td>
            <td>{{ $record->date_created }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
