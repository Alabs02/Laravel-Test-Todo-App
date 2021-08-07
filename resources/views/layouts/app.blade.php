<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel Todo App</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}">
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>

    @yield('custom_css')

    <script>
        const config = {
            tapToDismiss:true,
            toastClass:'toast',
            debug: false,
            showMethod:'fadeIn',
            showDuration: 300,
            showEasing: 'swing',
            hideMethod:'fadeOut',
            hideDuration: 1000,
            hideEasing:'swing',
            iconClasses: {
                error:'toast-error',
                info:'toast-info',
                success:'toast-success',
                warning:'toast-warning'
            },
            positionClass:'toast-top-right',
            preventDuplicates:true,
            progressBar:true
        }
        class Toast {
            constructor(content, title) {
                this.content = content
                this.title = title
            }
            success() {
                toastr.success(this.content, this.title, config)
            }
            warning() {
                toastr.warning(this.content, this.title, config)
            }
            info() {
                toastr.info(this.content, this.title, config)
            }
            error() {
                toastr.error(this.content, this.title, config)
            }
        }

        function alertMsg(content, title, type) {
            eval(`(new Toast(content, title)).${type}()`)
        }
    </script>

    @stack('toast')

    <style>
        .navbar {

        }
    </style>
</head>
<body>
    <header>
        <nav class="px-4 py-3 shadow navbar bg-primary d-flex justify-content-between">
            <h5 class="m-0 text-white navbar__title">Laravel Todo</h5>

            <form action="{{ route('user.logout') }}" method="GET">
                @csrf
                <button class="btn btn-light" type="submit">Logout</button>
            </form>
        </nav>
    </header>

    <main>
        @yield('main__content')
    </main>


    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/toastr.min.js') }}"></script>

    @stack('scripts')
</body>
</html>
