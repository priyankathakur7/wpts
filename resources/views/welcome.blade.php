@extends('layouts.app')
@section('title', 'Welcome')
@section('content')

            <div class="content">
                
                <div>
                    @guest

                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <h1 class="wc-title mb-4">Women Period Tracking System </h1>
                                <a class="a-green" href="{{ route('login') }}">
                                    <h1 class="wc-title">Please Login First</h1>
                                </a>
                            </div>
                        </div> 

                    @else

                        <h1 class="wc-title">Successful Login</h1>
                        <h1 class="wc-title"> Visit your 
                            <a class="a-green" href="{{url('/dashboard')}}">
                                <span > Dashboard </span>
                            </a>
                        </h1>

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
