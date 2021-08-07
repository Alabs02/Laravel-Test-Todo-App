@extends('layouts.app')

@section('custom_css')
    <style>
        .btn-delete {
            color: #f44336;
            cursor: pointer;
            font-size: 1.2rem;
            transition: cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .btn-delete:hover {
            transform: scale(1.05);
            color: #f44336;
        }
    </style>
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

   <div>
       <div class="container py-4">
           <div class="mb-3 d-flex justify-content-end">
               <button class="btn btn-primary" data-toggle="modal" data-target="#addTodoModal">Add Todo Item</button>

               <!-- Add Modal   -->
               <div class="modal fade" id="addTodoModal" tabindex="-1" aria-labelledby="upadteTodoLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="" method="POST" class="modal-content">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="upadteTodoLabel">Add Todo Item</h5>
                            </div>

                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <label class="form-label">Todo Name</label>
                                        <input type="text" name="add-todo-name" id="add-todo-name" class="form-control" />
                                    </div>

                                    <div class="col-md-12 col-sm-12">
                                        <label class="form-label">Todo Description</label>
                                        <textarea rows="4" cols="30" name="add-todo-desc" id="add-todo-desc" class="form-control">
                                        </textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button onclick="addTodo(`/api/todos`, {{ $user->id }})" type="button" class="btn btn-success">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
               <!-- End Add Modal   -->
           </div>
           <div class="row">
                @foreach ($todos as $todo)
                    <div class="col-md-4 col-sm-12">
                        <div class="mb-3 shadow card">
                            <div class="card-header d-flex justify-content-between">
                                <h5 class="m-0 card-title">{{ $todo->name }}</h5>
                                <i onclick="deleteTodo(`/api/todos/`+ {{ $todo->id }})" class="btn-delete bi bi-trash-fill"></i>
                            </div>
                            <div class="card-body">
                                <p class="card-content">{{ $todo->description }}</p>
                            </div>

                            <div class="card-footer d-flex justify-content-between">
                                <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#updateTodoModal{{ $todo->id }}">Update</button>
                                <button onclick="completedTodo(`/api/todo/completed/`+ {{ $todo->id }})" class="btn btn-primary btn-sm">Completed</button>

                                <div class="modal fade" id="updateTodoModal{{ $todo->id }}" tabindex="-1" aria-labelledby="upadteTodoLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form action="" method="POST" class="modal-content">
                                            @csrf
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="upadteTodoLabel">Update Todo Item</h5>
                                            </div>

                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="mb-3 col-md-12 col-sm-12">
                                                        <label class="form-label">Todo Name</label>
                                                        <input type="text" name="todo-name" value="{{ $todo->name }}" id="todo-name" class="form-control" />
                                                    </div>

                                                    <div class="mb-3 col-md-12 col-sm-12">
                                                        <label class="form-label">Todo Description</label>
                                                        <textarea name="todo-desc" id="todo-desc" cols="30" rows="4" class="form-control">
                                                            {{ $todo->description }}
                                                        </textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button onclick="updateTodo(`/api/todos/`+ {{ $todo->id }})" type="button" class="btn btn-success">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- End Update Modal-->
                            </div>
                        </div>
                    </div>
                @endforeach
           </div>

           <div class="mt-3 d-flex justify-content-center">
                <div>
                    {{ $todos->render() }}
                </div>
           </div>

       </div>
   </div>
@endsection

@push('scripts')
<script src="{{ asset('call/call.js') }}"></script>
    {{-- <script src="{{ mix('js/vue.js') }}"></script> --}}
@endpush
