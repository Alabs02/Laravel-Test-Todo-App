@extends('layouts.auth')

@section('custom_css')
    <style>
        .wrapper {
            min-height: 100vh;
            background: #ECEFF1;
        }

        .container {
            display: grid;
            place-items: center;
        }
        .card {
            width: 50%;
        }
        .form-label {
            letter-spacing: 2pt;
            font-size: .8rem !important;
        }

        .form-control {
            font-size: .9rem;
            font-weight: 400;
        }
    </style>
@endsection

@section('main__content')
    @if (Session::has('message'))
        <script>
            $(() => {
                alertMsg({!! json_encode(Session::get('message')) !!}, 'User Login', 'success')
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
                    alertMsg({!! json_encode($error) !!}, 'User Login', 'error')
                })
            </script>
        @endforeach

        @php
            Session::forget('errors');
        @endphp
    @endif

    <div class="wrapper">
        <div class="container pb-5">
            <div class="mt-5 rounded card">
                <div class="px-4 py-4 card-body">
                    <h4 class="mt-2 text-center text-primary fs-5">USER LOGIN</h4>

                    <form action="{{ route('user.login.post') }}" method="POST" class="mt-3">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-12">
                                <label class="m-0 text-muted fs-6 text-uppercase form-label" for="user-email">Your Email</label>
                                <input type="text" name="user-email" id="user-email" placeholder="johnsnow@gmail.com" class="form-control form-control-lg" requried />
                            </div>

                            <div class="mb-3 col-12">
                                <label class="m-0 text-muted fs-6 text-uppercase form-label" for="user-password">Your Password</label>
                                <input type="password" placeholder="*******" name="user-password" id="user-password" class="form-control form-control-lg" requried />
                            </div>
                        </div>

                        <div class="mt-4 d-flex justify-content-end">
                            <button type="submit" class="px-4 btn btn-primary">Login</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="mt-2 text-center">
                <p class="text-muted">Don't have an account?</p>
                <a href="{{ route('user.register') }}" class="rounded btn btn-light text-capitalise">Register Now</a>
            </div>
        </div>
    </div>
@endsection
