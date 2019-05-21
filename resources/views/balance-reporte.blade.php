@extends('layouts.admin')

@section('content')
<iframe src="{{ route('balance.mensual.pdf',[$year,$mes]) }}" width="100%" height="700px" frameborder="0"></iframe>
@endsection
@section('titulo-pagina','Reporte de balance')