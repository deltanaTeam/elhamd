@if(session('success'))

<div class="alert alert-success  alert-dismissible fade show" >
  <button type="button" class="close" data-dismiss="alert">&times;</button>
   <strong>{{__('lang.'.session('success'))}}</strong>
 </div>
@endif
@if(session('status'))

<div class="alert alert-success  alert-dismissible fade show" >
  <button type="button" class="close" data-dismiss="alert">&times;</button>
   <strong>@lang('lang.'.session('status'))</strong>
 </div>
@endif

@if(session('fail'))
<div class="alert alert-danger  alert-dismissible fade show " >
  <button type="button" class="close" data-dismiss="alert">&times;</button>
   <strong>{{__('lang.'.session('fail'))}} </strong>
 </div>
@endif
@if ($errors->any())
@foreach($errors->all() as $error)

<div class="alert alert-danger alert-dismissible fade show " >
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong> {{ $error }} </strong>
</div>

@endforeach


@endif
