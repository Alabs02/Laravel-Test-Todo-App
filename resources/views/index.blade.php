@extends('layouts.app')

@section('custom_css')

@endsection

@section('main__content')
    @if (Session::has('message'))
        <script>
            $(() => {
                alertMsg({!! json_encode(Session::get('message')) !!}, 'Alert', 'success')
            })
        </script>

        @php
            Session::forget('message');
        @endphp
    @endif

    @if (Session::has('errors'))
        @foreach ($errors->all() as $error)
            <script>
                $(() => {
                    alertMsg({!! json_encode($error) !!}, 'Alert', 'error')
                })
            </script>
        @endforeach

        @php
            Session::forget('errors');
        @endphp
    @endif
@endsection

@push('scripts')

@endpush
