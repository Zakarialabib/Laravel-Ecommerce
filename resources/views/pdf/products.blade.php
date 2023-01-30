@section('title', __('Products'))

@extends('layouts.print')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <table>
                    <thead>
                        <tr>
                            <th>{{ __('Code') }}</th>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Price') }}</th>
                            <th>{{ __('Old price') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $row)
                            <tr>
                                <td>{{ $row->code  }}</td>
                                <td>{{ $row->name  }}</td>
                                <td>{{ $row->price  }}</td>
                                <td>{{ $row->old_price }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="footer">
            {{--  --}}
        </div>
    </div>
@endsection
