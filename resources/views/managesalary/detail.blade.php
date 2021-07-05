@extends('managesalary.base')
@section('action-content')

    <style type="text/css">
        #startDate, #startTime, #search {
            width:30%;
            float: left;
        }
        .grid2{
            display: grid;
            grid-template-columns: 2fr 3fr;
            padding-left: 7rem;

        }
        .grid5{
            display: grid;
            grid-template-columns: 1fr 3fr;
            padding-left: 7rem;
            margin-bottom: 1.2rem;

        }
        .grid2 dt{
            margin-bottom: 1rem;
        }
        .grid1{
            display:grid;
            grid-template-columns: 1fr 1fr;
        }

        .grid3{
            display:grid;
            grid-template-columns: 1fr 4fr;
            margin-bottom: 1rem;
        }
        .inputox{
            width: 70% !important;
            border: none !important;
            padding: 6px 12px;
            font-size: 14px;
        }
        .inputwork{
            width: 70% !important;
            border: none !important;
            padding: 6px 12px;
            font-size: 14px;

        }
        .search{
            margin-left: -2rem;
        }
        .grid4{
            display:grid;
            margin-left: 5.7rem
        }
        /*#date,#amount{*/
            /*width: 30%;*/
            /*float: right;*/
        /*}*/
        @media(max-width:567px){
            .grid1{
            display:grid;
            grid-template-columns: 1fr;
        }
        .grid2{
            display: grid;
            grid-template-columns: 2fr 3fr;
            padding-left: 0rem;

        }
        }
    </style>

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
            .advance-pay{
                display: none;
            }
            .managesalary{
                display: none;
            }
            dl.employeedetails{
                border: 1px solid red;
                padding: 35px 70px 50px;
            }
            table.advancepayment{
                border: 1px solid red;
                padding: 35px 70px 50px;
            }
        }
    </style>


    <div class="page-wrapper">


        <div class="container-fluid">
            <div class="">
                <div class="col-md-10">
                    <div class="card">
                        <form action="{{route('manage-salary.detail',$employees->id)}}" method="GET" class="form-horizontal no-print">
                            <div class="card-body">
                                <h4 class="card-title search">Search</h4>
                                <div class=" grid4">
                                    <!-- Date Picker -->
                                    <div class="input-group date " id="startDate">
                                        <strong>From</strong>
                                        <input type='date' value="{{request()->startdate}}" name="startdate" class="form-control" />
                                    </div>
                                    <!-- Time Picker -->
                                    <div class="input-group date" id="startTime">
                                        <strong>To</strong>
                                        <input type='date' value="{{request()->enddate}}" name="enddate" class="form-control" />
                                    </div>

                                    <div class="input-group date no-print" id="search">
                                        <br>
                                        <button class="btn btn-danger" style="margin-right: 1rem" onclick="pdf()"><i class="fa fa-print"></i> Print</button>
                                        <button type="submit" class="btn btn-success" style="margin-right: 1rem">Search</button>
                                        <a href="{{route('manage-salary.detail',$employees->id)}}" class="btn btn-md btn-danger">Clear</a>
                                    </div>
                                </div>
                            </div>
                            <br><br>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row no-print">
                <div>
                    {{--<a href="" id="pdffile" target="-_blank" class="btn btn-default"><i class="fa fa-print"></i>Print </a>--}}
                    {{-- <button class="btn btn-danger" onclick="pdf()" style="margin-left: 9rem;"><i class="fa fa-print"></i> Print</button> --}}
                </div>
            </div>

            <div class="grid1 ">
                <div class="">
                    <div class="card">
                        <form action="{{route('managesalary.store')}}" method="post" class="form-horizontal">
                            @csrf
                            <h4 class="card-title managesalary" style="margin-left: 7rem">Manage salary</h4>
                            <dl class="employeedetails">
                                <div class="grid2">
                                    <dt class="">Employee name:</dt>
                                    <dd class="" name="employee_name" id="employee_name"><strong></strong>{{$employees->firstname}} {{$employees->lastname}}</dd>
                                    <dt class="">Employee designation:</dt>
                                    <dd class="" name="employee_designation" id="employee_designation">{{$des}}</dd>
                                    <dt class="">Employee Salary:</dt>
                                    <dd class="" name="employee_salary" id="employee_salary">{{$amt}}</dd>
                                    <dt class="">Employee leave:</dt>
                                    <dd class="" name="leave_count" id="leave_count">{{$total_leaves}}</dd>
                                    <dt class="">Tax (1%):</dt>
                                    <dd class="" name="tax" id="tax">{{ $tax }}</dd>
                                    <dt class="">Advance payment:</dt>
                                    <dd class="" name="advance" id="advance">{{$advancePayment->total}} </dd>
                                    <dt class="">Total:</dt>
                                    <dd class="" name="total" id="grand-total">{{ $total }} </dd>
                                </div>







                            </dl>
                            {{--<hr>--}}

                            <script>
                                calculate();
                                function calculate(){
                                    var total_salary=$('#employee_salary').text();
                                    var per_day_amount=total_salary/30;
                                    var leave_day=$('#leave_count').text();
                                    var leave_amount= per_day_amount*leave_day;
                                    var tax_percentage=1;
                                    var tax_amount=total_salary*tax_percentage/100;
                                    var advance_payment=$('#advance').text();
                                    var grand_total=total_salary-leave_amount-tax_amount-advance_payment;
                                    $('#tax').text(tax_amount);
                                    $('#grand-total').text(grand_total);
                                    // console.log(grand_total);
                                }
                            </script>
                            <hr>
                            <div class="no-print">
                            <div class="card-body">
                                <h4 class="card-title" style="margin-left: 7rem">Working days</h4>
                                <div class="grid5">
                                    <label for="lname" class="">Total number of working days</label>
                                    <div class="">
                                        <input type="text" name="working_days" id="days" value="30" class="inputwork">
                                    </div>
                                </div>
                                <div class="grid5">
                                    <label for="lname" class="">Employee Name</label>
                                    <div class="">
                                        <input type="text" name="employee_name" class="inputwork" value="{{$employees->firstname}} {{$employees->middlename}} {{$employees->lastname}}">
                                    </div>
                                </div>
                                <div class="grid5">
                                    <label for="lname" class="">Designation Type</label>
                                    <div class="">
                                        <input type="text" name="employee_designation" class="inputwork" value="{{$des}}">
                                    </div>
                                </div>
                                <div class="grid5">
                                    <label for="fname" class="">Rate per day</label>
                                    <div class="">
                                        <input type="number" name="rate_per_day" id="rates" class="inputwork" placeholder="Rate per day">
                                    </div>
                                </div>

                                <div class="grid5">
                                    <label for="fname" class="">Gross pay</label>
                                    <div class="">
                                    <input type="number" name="gross_salary" id="salary" class="inputwork" value="{{$amt}}">
                                    </div>
                                </div>
                            </div>

                            <hr><hr>

                            <div class="card-body">
                                <h4 class="card-title" style="margin-left: 7rem">Deductions</h4>
                                <div class="grid5">
                                    <label for="lname" class="">Tax %</label>
                                    <div class="">
                                        <input type="text" name="tax_deduction"   class="inputwork" value="" placeholder="Tax deduction">
                                    </div>
                                </div>
                            </div>

                            <hr><hr>

                        </div>

                            <div class="border-top no-print" style="margin-left: 7rem; margin-bottom: 2rem">
                                <div class="card-body">
                                    <button type="submit" class="btn btn-primary">Apply</button>
                                    <a href="{{route('managesalary')}}" class="btn btn-md btn-danger">Back</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="">
                    <div class="card">


                        <form action="{{route('managesalary.makeadvance')}}" method="post" class="form-horizontal advance-pay">
                            @csrf
                            <input type="hidden" name="employee_id" value="{{$employees->id}}">
                            <div class="card-body">
                                <h4 class="card-title">Advance payment</h4>
                                <div class=" grid3">
                                    <label for="fname" class=" ">Date</label>
                                    <div class="">
                                        <input type="date" name="date" id="date" class="inputox">
                                    </div>
                                </div>
                                <div class=" grid3">
                                    <label for="lname" class=" ">Amount</label>
                                    <div class="">
                                        <input type="text" name="amount" id="amount" class="inputox" placeholder="Enter amount"/>
                                    </div>
                                </div>
                            </div>

                            <div class="border-top">
                                <div class="card-body">
                                    <button type="submit" class="btn btn-primary">Add</button>
                                    {{-- <a href="#" class="btn btn-md btn-danger">Back</a> --}}
                                </div>
                            </div>
                            <hr><hr>
                        </form>
                        <div class="card-body">
                            <h5 class="card-title">Advance payment lists</h5><hr/>
                            <table id="zero_config advance-payment" class="table table-bordered table-hover dataTable  advancepayment" role="grid" style="width:100%">

                                <thead>
                                <tr>
                                    <th class="text-center">S.N</th>
                                    <th class="text-center">Date</th>
                                    <th class="text-center">Amount(&#8358;)</th>
                                    <th class="no-print text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($advance as $advances)
                                    <tr class="text-center">
                                        <td>{{$loop->index+1 }}</td>
                                        <td>{{$advances->date }}</td>
                                        <td>{{$advances->amount }}</td>
                                        <td class="no-print">Edit</td>

                                    </tr>
                                </tbody>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


            <script>
                 $('#rates').keyup(function(){
                     var days_worked = $('#days').val();
                     var rate_per_day = $(this).val();
                     var total_gross_salary = days_worked * rate_per_day;
                     $('#salary').val(total_gross_salary);
                 })


                $('#tax').keyup(function(){
                    var tax = $(this).val();
                    var salary = $('#salary').val();
                    var tax_amount = salary * tax/100;
                    var total_netpay = salary - tax_amount;
                    $('#net_pay').val(total_netpay);
                })
            </script>

            {{--datatable--}}
            <script>
                $(document).ready(function() {
                    $('#advance-payment').DataTable();
                });
            </script>

            {{--Start-For printing the screen--}}
            <script>
                function pdf() {
                    window.print();
                }
            </script>

            {{--End-For printing the screen--}}

    </div>

@endsection
