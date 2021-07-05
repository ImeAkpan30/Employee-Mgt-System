@extends('calendar-mgt.base')

@section('action-content')
    <!-- Main content -->
    <section class="content">

    <div class="box-header">
      <div class="row">
          <div class="col-sm-8">
            <h3 class="box-title">calendar</h3>
          </div>
          <div class="col-sm-4">
            @if(Auth::user()->role=='admin')
            <a class="btn btn-primary" href="{{ route('fullcalendareventmaster.create') }}">Add Events</a>
            @endif
          </div>
      </div>
    </div>
    <!-- /.box-header -->
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" style="background: #2e642e; color: white">
                    Full calendar
                </div>
                {{-- <div class="panel-body">
                    {!! $calendar->calendar() !!}
                    {!! $calendar->script() !!}
                </div> --}}
            </div>
        </div>
    </div>


</section>
<!-- /.content -->

@endsection
