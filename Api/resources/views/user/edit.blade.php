@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-lg bg-gray-200">Editar al usuario {{$user->name}}</div>

                    <div class="card-body">
                        <div class="row">
                            

                            <main role="main" class="col-md-12 ml-sm-auto col-lg-12 ">
                               

                                <form class="needs-validation" novalidate action="{{route('user.update', $user)}}" method="POST">
                                    @csrf
                                    @method('put')

                                    <div class="row">
                                        <div class="col-6 mb-3">
                                            <label for="inputName">Nombre</label>
                                            <!-- adding the class is-invalid to the input, shows the invalid feedback below -->
                                            <input type="text" class="form-control " id="inputName" name="name" placeholder="" value="{{$user->name}}">
                                            @error('name')
                                                <small>*{{$message}}</small><br>
                                            @enderror
                                        </div>

                                        <div class="col-6 mb-3">
                                            <label for="inputSlug">Email</label>
                                            <input type="text" class="form-control" id="inputSlug" placeholder="" name="email" value="{{$user->email}}">
                                            @error('email')
                                                <small>*{{$message}}</small><br>
                                            @enderror
                                        </div>
                                    </div>                
                                    <br>
                                    <div class="text-right">
                                        <button class="btn btn-primary" type="submit">Guardar</button>
                                        <a href="{{route('user.index')}}" class="btn btn-link">Cancel</a>                                    
                                    </div>
                                </form>

                            </main>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
