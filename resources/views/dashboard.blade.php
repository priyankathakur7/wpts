@php use Carbon\Carbon; @endphp
@extends('layouts.app')

@section('content')

{{-- {{dd($datas)}} --}}

    <div class="container home-wrapper">

        @guest

            <div class="row justify-content-center">
                <div class="col-md-8">
                    <h1>Home Page</h1>
                    <h1>Please Login First</h1>
                </div>
            </div>
            

        @else

        
            <div class="row mx-0">
            
                <div class="col-md-6">
                    <h2>Welcome</h2>
                    <h3>{{ Auth::user()->name }}</h3>
                </div>
                <div class="col-md-6 result-data">
                    @if ($datas)
                        <legend class="title">Recent tracked Dates</legend>
                        <ul>
                            @foreach ($datas as $data)
                                <li>{{\Carbon\Carbon::parse($data->result_date)->format('d M Y')}}</li>
                                {{-- <li>{{$data->result_date}}</li> --}}
                            @endforeach
                        </ul>
                    @else
                        <h1>No Post Found</h1>
                    @endif
                </div>

            </div>


       @endguest

    </div>

@endsection

    {{-- CSS
    ----------------------------------------------------------------------------------------------------------------------------
    ----------------------------------------------------------------------------------------------------------------------------}}

    @section('css')

        <style>

            /* Data ------------------------- */
            .result-data ul {
                list-style-type: none;
                background: #ffffffbf;
                border-radius: 33px;
                padding: 44px 47px 33px 47px;
                box-shadow: -1px 1px 10px 1px #d5d4d4d6;
                max-height: 445px;
                overflow: auto;
            }
            .result-data ul li{
                font-size: 16px;
            }
            

        </style>

    @endsection
