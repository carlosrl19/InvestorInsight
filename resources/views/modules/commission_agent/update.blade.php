@extends('layout.admin')

@section('pretitle')
Comisionistas
@endsection

@section('title')
Editar información /&nbsp;<b class="text-muted">{{ $commission_agent->commissioner_name }}<b/>
@endsection

@section('content')
    <div class="container-xl">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('commission_agent.update', ['commission_agent' => $commission_agent]) }}" novalidate>
                    @method('PUT')
                    @csrf
                    <div class="row mb-3 align-items-end">
                        <div class="col">
                            <label class="form-label" for="commissioner_name">Nombre del comisionista</label>
                            <input type="text" maxlength="55" value="{{ $commission_agent->commissioner_name }}" name="commissioner_name" id="commissioner_name" class="form-control @error('commissioner_name') is-invalid @enderror" placeholder="Ingrese el nombre del comisionista" autocomplete="off"/>
                            @error('commissioner_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col">
                            <label class="form-label" for="commissioner_dni">Nº identidad</label>
                            <input type="text" maxlength="13" value="{{ $commission_agent->commissioner_dni }}" name="commissioner_dni" id="commissioner_dni" class="form-control @error('commissioner_dni') is-invalid @enderror" placeholder="Ingrese el número de identidad" autocomplete="off"/>
                            @error('commissioner_dni')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <input type="hidden" name="commissioner_status" value="1">
                    </div>
                    <div class="row mb-3 align-items-end">
                        <div class="col">
                            <label class="form-label" for="commissioner_phone">Nº teléfono</label>
                            <input type="text" name="commissioner_phone" value="{{ $commission_agent->commissioner_phone }}" id="commissioner_phone" class="form-control @error('commissioner_phone') is-invalid @enderror" data-mask="00000000" data-mask-visible="true" placeholder="00000000" autocomplete="off"/>
                            @error('commissioner_phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col">
                            <label class="form-label" for="commissioner_reference">Recomendado por</label>
                            <input type="text" maxlength="55" value="{{ $commission_agent->commissioner_reference }}" name="commissioner_reference" id="commissioner_reference" class="form-control @error('commissioner_reference') is-invalid @enderror" placeholder="Ingrese el nombre del recomendor" autocomplete="off"/>
                            @error('commissioner_reference')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <a href="{{ route('commission_agent.index') }}" class="btn btn-dark me-auto">Volver</a>
                    <button type="submit" class="btn btn-teal">Guardar cambios</button>
                </form>
            </div>
        </div>
    </div>
@endsection