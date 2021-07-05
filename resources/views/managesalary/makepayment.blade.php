@extends('managesalary.base')

@section('action-content')

    <style>
        @media print  {
            .page-breadcrumb{
                display: none;
            }
            .sidebar-nav{
                display: none;
            }
            .no-print {
                display: none;
            }
            .text-center{
                display: none;
            }
            #advance-pay{
                display: none;
            }
        }
    </style>

    <div id="main-wrapper">



        <div id="main-wrapper">

            <div class="page-wrapper">



                <div class="container-fluid">

                    <div class="row">
                        <div class="col-md-6">
                                <h3> &nbsp;<b class="text-danger">Invoice payment</b></h3>

                                <p class="text-muted float-right">
                                    <br/> <b>Invoice Number:</b> </p> {{ $invoice_no }}
                                </p>
                                <p class="text-muted m-l-5">
                                    <br/> <b>Employee name:</b> </p> {{ $user->employee_name }}
                        </div>


                        <div class="col-md-6">
                            <br><br><br>
                                <p class="text-muted m-l-5">
                                    <br/> <b>Designation:</b></p> {{ $user->designation_type }}

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                                <h4 class="card-title">Earning</h4>

                                <div class="form-group row">
                                    <label class="col-sm-3  control-label col-form-label">Basic salary</label>
                                    <div class="col-sm-7">
                                        <input type="text" name="basic_salary" id="basic_salary" class="form-control" value="{{ $user->gross_salary }}" disabled>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div class="pull-right m-t-30 text-right">
                            <p><b>Total amount:</b> &#8358;{{ $user->gross_salary }}</p>
                            <p><b>Tax (1%) :</b> &#8358;{{$tax}} </p>
                            <hr>
                        <h3><b>Total :</b> &#8358;{{$total}}</h3>
                        </div>
                        <div class="clearfix"></div>
                        <hr>
                        {{--<div class="text-right">--}}
                            {{--<button class="btn btn-danger" type="submit"> Print </button>--}}
                        {{--</div>--}}
                    </div>
                </div>

                <div class="row no-print">
                    <div class="col-md-10 col-lg-10 col-lg-offset-1 col-md-offset-1">
                        {{--<a href="" id="pdffile" target="-_blank" class="btn btn-default"><i class="fa fa-print"></i>Print </a>--}}
                        <button class="btn btn-primary" onclick="pdf()">Print</button>
                        <a href="{{route('managesalary.salarylist')}}" class="btn btn-success">Back</a>

                    </div>
                </div>

                <script>
                    function pdf() {
                        window.print();
                    }
                </script>


            </div>
        </div>
    </div>

@endsection
