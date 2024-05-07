@extends('layout.admin')

@section('pretitle')
Inversionistas
@endsection

@section('title')
Editar información
@endsection

@section('content')

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" style="margin-left: 18vh; margin-right: 18vh; font-size: clamp(0.6rem, 3.2vw, 0.8rem);" role="alert" data-auto-dismiss="4000">
        <strong>{{ session('success') }}</strong>
    </div>
    @endif
    
    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible" alert-dismissible fade show" style="margin-right: 10vh; margin-left: 10vh; font-size: clamp(0.6rem, 3.2vw, 0.8rem);" role="alert" data-auto-dismiss="10000">
        <strong>El formulario contiene los siguientes errores:</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="container-xl">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('investor.update', ['investor' => $investor->id]) }}" novalidate>
                    @method('PUT')
                    @csrf
                    <div class="row mb-3 align-items-end">
                        <div class="col">
                            <label class="form-label" for="investor_name">Nombre del inversionista</label>
                            <input type="text" maxlength="55" value="{{ $investor->investor_name }}" name="investor_name" id="investor_name" class="form-control @error('investor_name') is-invalid @enderror" placeholder="Ingrese el nombre del inversionista" autocomplete="off"/>
                            @error('investor_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col">
                            <label class="form-label" for="investor_dni">Nº identidad</label>
                            <input type="text" maxlength="13" value="{{ $investor->investor_dni }}" name="investor_dni" id="investor_dni" class="form-control @error('investor_dni') is-invalid @enderror" placeholder="Ingrese el número de identidad" autocomplete="off"/>
                            @error('investor_dni')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <input type="hidden" name="investor_status" value="1">
                    </div>
                    <div class="row mb-3 align-items-end">
                        <div class="col">
                            <label class="form-label" for="investor_phone">Nº teléfono</label>
                            <input type="text" name="investor_phone" value="{{ $investor->investor_phone }}" id="investor_phone" class="form-control @error('investor_phone') is-invalid @enderror" data-mask="00000000" data-mask-visible="true" placeholder="00000000" autocomplete="off"/>
                            @error('investor_phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col">
                            <label class="form-label" for="investor_reference">Referido por</label>
                            <input type="text" maxlength="55" value="{{ $investor->investor_reference }}" name="investor_reference" id="investor_reference" class="form-control @error('investor_reference') is-invalid @enderror" placeholder="Ingrese el nombre del recomendor" autocomplete="off"/>
                            @error('investor_reference')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <a href="{{ route('investor.index') }}" class="btn btn-dark me-auto">Volver</a>
                    <button type="submit" class="btn btn-teal">Guardar cambios</button>
                </form>
            </div>
        </div>
    </div>
@endsection