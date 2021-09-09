@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
            
        
        <div class="col-md-12">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <div class="btn-toolbar mb-2 mb-md-0">
                        
                    </div>
                </div>
            <div class="card">
                <div class="card-header bg-gray-200 text-lg" >Usuarios
                        <div class="btn-group mr-2 float-right">
                            <a href="{{ route('user.create') }}" class="btn btn-sm btn-outline-secondary bg-blue-500 text-white">Crear nuevo usuario</a>
                        </div>
                </div>

                <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                        <th scope="row">{{$user->id}}</th>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                            <div class="btn-group mr-3">
                                <a href="{{ route('user.show', $user) }}" class="btn btn-sm btn-outline-secondary mr-2 bg-blue-500" alt="ver">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
</svg>
                                </a>
                                <a href="{{ route('user.edit', $user) }}" class="btn btn-sm btn-outline-secondary mr-2 bg-green-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
</svg>
                                </a>
                               

                                <form action="{{ route('user.destroy', $user) }}" method="POST">
                                    @csrf
                                    @method('delete')   
                                    <button type="submit"  class="btn btn-sm btn-outline-secondary  bg-red-500" >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                        </tr>
                    @endforeach
                   
                      
                    </tbody>
                    </table>
                    {{$users->links()}}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
