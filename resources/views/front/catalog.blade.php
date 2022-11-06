@extends('layouts.app')

@section('title', __('Catalog'))

@section('content')
      <section class="py-5 bg-gray-100">
        <livewire:front.catalog />
      </section>
 @endsection