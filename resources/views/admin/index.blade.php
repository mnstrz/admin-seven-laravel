@extends('layouts.admin_page')

@section('content')

    @if(isset($page))
      @include($page)
    @endif

    @if(isset($livewire))
      @livewire($livewire)
    @endif
    
@stop