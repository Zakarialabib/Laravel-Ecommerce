@extends('layouts.app')

@section('title', __('Catalog'))

@section('content')
      <section class="py-10 bg-gray-100">
        <livewire:front.catalog />
      </section>
 @endsection