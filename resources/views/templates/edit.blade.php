@extends('layouts.main')

@section('content')
  
<div class="flex items-center justify-between mb-3">
  <h1 class="text-gray-700 text-2xl py-4" >Edit template: {{ $template->name }}</h1>
</div>

<form action="{{ route('templates.update', $template->id) }}" method="POST" >
<input type="hidden" name="_method" value="PUT">
@csrf   

<input type="text" name="name" value="{{ $template->name }}" class="border p-2 bg-gray-200" > 

<textarea name="content" id="" cols="30" rows="10" class="block bg-gray-200 p-2 m-2">{{ $template->content }}</textarea>

<input type="submit" value="Save" class="bg-blue-500 text-white px-3 py-2" >

</form>

@endsection