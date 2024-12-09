@extends('layouts.app')

@section('titulo')
    Bienvenido a DevStagram
@endsection

@section('contenido')
    <x-listar-post :posts="$posts" />
@endsection
