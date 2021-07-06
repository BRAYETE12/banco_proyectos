@extends('layouts.admin')
@section('app', 'ng-app=AppReportes')
@section('controller','ng-controller=ReporteCtrl')
@section('title', $titulo )

@section('content')

    <input type="hidden" id="reporte" value="{{$reporte}}">

    <div class="row">
        <div class="col card m-3 p-3 bg-white">
            <div id="output"></div>
        </div>
    </div>
    
@endsection


@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pivottable/2.13.0/pivot.min.css">
    <style> 
        #output{ overflow: auto; }
        select.pvtRenderer, select.pvtAggregator {
            width: 100px;
        }
    </style>
@endsection

@section('script')
    <script src="{{ asset('js/reportes/app.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
    <script src="https://pivottable.js.org/dist/pivot.js"></script>
    <script src="https://pivottable.js.org/dist/plotly_renderers.js" ></script>
@endsection