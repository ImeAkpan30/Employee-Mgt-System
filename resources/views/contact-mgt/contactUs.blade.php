@extends('contact-mgt.base')
@section('title', 'EM | Contact Management')

@section('stylesheets')


<script src="//cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'summary-ckeditor' );


    $(document).ready(function(){
  //Select2
  $(".multipleSelect2").select2({
		placeholder: "What's your rating" //placeholder
	});
    })

</script>


@endsection

@section('action-content')

<div class="container">
   <div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default" style="margin-top: 20px">
            <div class="panel-heading text-center text-bold text-danger text">Contact Us</div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="POST" action="{{ route('contact-us') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-4 control-label">Name</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Name" required autofocus>

                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Email</label>
                        <div class="col-md-6">
                            <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email" required autofocus>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Phone Number</label>
                        <div class="col-md-6">
                            <input id="phone_number" type="text" class="form-control" name="phone_number" value="{{ old('phone_number') }}" placeholder="Phone Number" autofocus>

                            @if ($errors->has('phone_number'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('phone_number') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Subject</label>
                        <div class="col-md-6">
                            <input id="subject" type="text" class="form-control" name="subject" value="{{ old('subject') }}" placeholder="Subject" autofocus>

                            @if ($errors->has('subject'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('subject') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Message</label>
                        <div class="col-md-6">
                            <textarea class="form-control textarea ckeditor @error('message') is-invalid @enderror"  name="message" id="summary-ckeditor"  style="height: 300px"></textarea>
                            @if ($errors->has('message'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('message') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary btn-round">Send</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

           </form>
         </div>
       </div>
     </div>
   </div>
</div>

@endsection
