@extends('app')
@section('edit_course')
<!--{{ Form::model($nerd, array('route' => 'nerd.edit', $nerd->id)) }}    

 name 
{{ Form::label('name', 'Name') }}
{{ Form::text('name') }}

 email 
{{ Form::label('email', 'Email') }}
{{ Form::email('email') }}      

{{ Form::submit('Update Nerd!') }}

{{ Form::close() }}-->
@stop