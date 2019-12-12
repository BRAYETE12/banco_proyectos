@extends('layouts.admin')
@section('title', 'Dashboard' )

@section('content')

    <div class="row">
        <div class="col card m-3 p-3 bg-white">
            <p>
                <i class="fas fa-project-diagram" style="font-size: 3rem;" ></i>
                Bienvenido a <b>SISBANPROYEC {{env('MUNICIPIO')}}</b>, el sistema de información para la gestión del banco de proyectos
            </p>

        </div>
    </div>

@endsection

@section('style')
    <style> 
    </style>
@endsection

@section('script')
    <script>
    </script>
@endsection