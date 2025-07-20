@if(session('success'))

<div class="alert alert-success alert-dismissible ">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
   <strong>@lang('lang.'.session('success')) </strong>
 </div>
@endif
@if(session('status'))

<div class="alert alert-success alert-dismissible ">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
   <strong>@lang('lang.'.session('status')) </strong>
 </div>
@endif
@if(session('fail'))

<div class="alert alert-danger alert-dismissible  " >
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
   <strong> {{ __('lang.'.session('fail'))}}</strong>
 </div>
@endif
@if ($errors->any())

@foreach($errors->all() as $error)
<div class="alert alert-danger alert-dismissible  " >
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong> {{ $error }} </strong>
</div>

@endforeach


@endif
