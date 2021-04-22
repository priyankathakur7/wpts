@extends('layouts.app')

@section('content')

            <div class="content">
                
                <div>
                    @guest

                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <h1 class="wc-title mb-4">Women Period Tracking System </h1>
                                <h1 class="wc-title">Please Login First</h1>
                            </div>
                        </div> 

                    @else

                        <h1 class="wc-title">Successfull Login<br>
                        Visit your Dashboard</h1>

                    @endguest

                </div>

               
            </div>
@endsection

@section('css')

            <style>
                .wc-title {
                    text-align: center;
                    font-size: 54px;
                    color: #757978;
                    font-weight: 600;
                    margin-top: 20px;
                }
            </style>

@endsection
