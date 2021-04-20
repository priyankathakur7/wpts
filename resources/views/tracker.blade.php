

@extends('layouts.app')
@section('title','Period Tracker')


{{-- Content
----------------------------------------------------------------------------------------------------------------------------
----------------------------------------------------------------------------------------------------------------------------}}

@section('content')

    <div class="container tracker">


        {{-- ************** Error Validation ******************* --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- **************  Validation Message after submit ******************* --}}

        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif

        {{-- ********************** Form  ******************* --}}
        {{-- Error --}}
        <div class="error" id="#success_message">
            <ul class="check">

            </ul>
        </div>

        {{-- Success --}}
        {{-- Toast --}}
        <div role="alert" aria-live="assertive" aria-atomic="true" class="toast" data-autohide="false">
            <div class="toast-header">
                {{-- <span class="rounded mr-2 bg-success">&nbsp;&nbsp;</span> --}}
                <strong class="mr-auto">Information saved</strong>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body">
               Your period query is saved :)
            </div>
        </div>




        {{-- Popup Predicted Date
        -------------------------------------------------------- --}}
        <div class="popup">
            <h5>Your Predicted date is : <span class="show-date"></span></h5>
        </div>

        <div class="row mx-auto">

            {{-- Image
            -------------------------------------------------------- --}}
            <div class="col-md-6 col-left flex-center pl-md-0">
                <img src="{{asset('images/calendar.svg')}}" alt="">
            </div>

            {{-- Form
            -------------------------------------------------------- --}}
            <div class="col-md-6 col-right">
                <form id="tracker" class="form-tracker">
                {{-- <form action="{{url('/posts')}}" method="POST" enctype="multipart/form-data" class="form-tracker"> --}}
                    @csrf
                    <div class="form-group row">
                        <div class="col-12 mx-auto">
                            
                            <legend class="title">Period Tracker</legend>
        
                            {{-- Input Fields
                            -------------------------------------------------------- --}}
                            <div class="form-group">
                                {{-- <label for="p-startdate">Period start date :</label> --}}
                                <input type="date"  class="form-control p-startdate" id="p-startdate" name="p-startdate" placeholder="Period start Date">
                            </div>
        
                            <div class="form-group">
                                {{-- <label for="flowdays">Total Flow day :</label> --}}
                                <input type="number" class="form-control" id="flowdays" name="flowdays" placeholder="Enter total flow days">
                            </div>
        
                            <div class="form-group">
                                {{-- <label for="age"> Age</label> --}}
                                <input  type="number" class="form-control" name="age" id="age" placeholder="Enter your age">
                            </div>
        
                            <div class="result-date form-group">
                                <label>Your Predicted date is : <span class="show-date"></span></label>
                            </div>
        
                            <div class="error form-group">
                                <label>Please enter your period details</label>
                            </div>
                            
        
                            {{-- Submit button
                            -------------------------------------------------------- --}}
                            <div class="form-group">
                                <button id="track" class="btn btn-pink mx-auto">Track</button>
                                <button type="submit" id="submit" class="btn btn-green mx-auto">Save Prediction</button>
                            </div>
        
                        </div>
                    </div>
                </form>
            </div>
        
        </div>

    </div>

    {{-- CSS
    ----------------------------------------------------------------------------------------------------------------------------
    ----------------------------------------------------------------------------------------------------------------------------}}

    @section('css')

        <style>
            /* Form  ------------------------- */

            .result-date{
                display: none;
            }
            .result-date label{
                font-size: 16px;
            }
            .result-date .show-date{
                color: #e91e63;
            }
            .error {
                display: none;
            }
            .error label{
                color: #ea75ce;
                font-size: 17px;
                padding-left: 6px;
                font-weight: 700;
            }
            .popup {
                position: fixed;
                top: 50%;
                left: 50%;
                width: 500px;
                margin-top: -31.5px;
                margin-left: -250px;
                padding: 29px 20px 20px 20px;
                background: #e91e63;
                color: #fff;
                border-radius: 20px;
                box-shadow: 0px 1px 12px 1px #e91e63a8; 
                display: none;
                text-align: center;
                z-index: 1;
            }
            .btn22{
                background: lightseagreen !important;
                color: #fff;
            }

            .home-wrapper .btn {
                background: lightseagreen;
            }

            .form-tracker {
                background: #ffffffbf;
                border-radius: 33px;
                padding: 44px 47px 33px 47px;
                box-shadow: -1px 1px 10px 1px #edededd6;
            }
            button#track {
                margin-right: 3px !important;
            }
            #submit{
                display: none;
            }

            /* Responsive
            -------------------------------------------------------- */
            @media (min-width: 768px) {
                .col-left {
                    padding-right: 38px;
                }
            }
            
            

        </style>

    @endsection


    {{-- Scripts
    -----------------------------------------------------------------------------------------------------------------------------------------------------------------------------}}
    {{-- ------------------------------------------------------------------------------------------------------------------------------------------------------------------------}} 
    
    <script>

        $(document).ready(function () {

            // Defining global variable  ----------------------------------
            var period_startdate;
            var formated_period_startdate;
            var total_flowdays;
            var total_days;
            var finaldate; 

            var popup = $('.popup');
            var result_date = $('.result-date');
            var show_date = $('.show-date');
            
            var submit_btn = $('#submit');

            var error = $('.error'); 

            // Calculate Period date on click  ----------------------------------
            $('#track').click(function (e) {
                e.preventDefault(); 
                
                track_period();
            });

            //Track Period function  ----------------------------------
            function track_period() {
                // Get value from Period start date input field
                period_startdate = new Date($('#p-startdate').val());
                total_flowdays = $('#flowdays').val();

                age = $('#age').val();
                formated_period_startdate = period_startdate.toInputFormat();
                // Get value from Total flow days input field

                // alert (period_startdate)

                if (period_startdate && total_flowdays) {

                    // Covert string to integer
                    total_flowdays = parseInt(total_flowdays, 10);
                    // Adding total flowday to 1 period cycle
                    total_days = total_flowdays + 28;
                    // Set final date after adding total days
                    period_startdate.setDate(period_startdate.getDate() + total_days);
                    //Convert date format to dd-mm-yy & store in finaldate variable
                    finaldate = period_startdate.toInputFormat();
                    //Send final date inside popup / result date label
                    show_date.text(finaldate);

                    //Show popup $ result date DIV
                    // popup.fadeIn();
                    result_date.show();
                    
                    //Hide Error message if any
                    error.hide();
                    
                    //Hide popup after timeout
                    // setTimeout(() => {
                    //     popup.fadeOut();
                    // }, 3000);

                    //Show Submit Button
                    submit_btn.fadeIn();

                } else {
                    error.show();
                    result_date.hide();
                }
            }

            // Flat Picker ----------------------------------------------------------------------
            flatpickr('.p-startdate', {
                 altInput: true,
                 altFormat: "F j, Y",
                 dateFormat: 'Y-m-d'
            });


            // FUNCTION -- change date to dd-mm-yyy format  ----------------------------------
            Date.prototype.toInputFormat = function() {
            var yyyy = this.getFullYear().toString();
            var mm = (this.getMonth()+1).toString(); // getMonth() is zero-based
            var dd  = this.getDate().toString();
            return (dd[1]?dd:"0"+dd[0]) + "-" + (mm[1]?mm:"0"+mm[0]) + "-" + yyyy; // padding
            };

            // Hide popup on body click  --------------------------------------------------
            $(document).click(function () { 
                // popup.fadeOut();
            });
            
            // Form Submit  -----------------------------------------------------
            $.ajaxSetup({
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
                });

             // Form Submit  -----------------------------------------------------
            $('#tracker').submit(function(e){
                    e.preventDefault()
                    $.post('/periods',{
                        user_id: {{auth()->user()->id}} ,
                        pstart_date:formated_period_startdate,
                        flowdays:total_flowdays,
                        age: age,
                        result_date:finaldate,
                    },function(res){
                        submit_btn.fadeOut();
                        result_date.fadeOut();
                        $("#tracker")[0].reset();
                        $('.toast').fadeIn(1000);
                        function redirect(){
                          $('.toast').fadeOut();
                        }
                        setTimeout(redirect, 5000);
                    })
            });
            
        });
    </script>
    
@endsection

 