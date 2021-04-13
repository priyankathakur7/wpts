@extends('layouts.app')

@section('content')
<div class="container home-wrapper">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div style="text-align:center"; class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{url('/periods')}}" method="post" enctype="multipart/form-data">
                        @csrf
                            <legend>Track your period</legend>

                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control" id="name" placeholder="Enter your Name" name="name">
                            </div>

                            <div class="form-group">
                                <label for="name">cycle Length:</label>
                                <input type="number" class="form-control" id="C_length" placeholder="Enter your cycle Length" name="C_length">
                            </div>

                            <div class="form-group">
                                <label for="name">Period Length:</label>
                                <input type="number" class="form-control" id="P_length" placeholder="Enter your period length" name="P_length">
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Submit</button>
                            
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
