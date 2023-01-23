@extends('admin.base.layout', [
    'plugins' => ['chartjs'],
    'js' => ['dashboard.index']
])
@section('title', 'Dashboard')

@section('navbar')

@endsection

@section('content')
    Dashboard
@endsection
