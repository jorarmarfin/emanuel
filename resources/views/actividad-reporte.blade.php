@extends('layouts.admin')

@section('content')
<iframe src="{{ route('actividad.balance.pdf',$idactividad) }}" width="100%" height="700px" frameborder="0"></iframe>
@endsection
@section('titulo-pagina','Reporte de balance')