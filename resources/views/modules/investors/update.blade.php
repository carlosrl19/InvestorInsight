@extends('layout.admin')

@section('pretitle')
Inversionistas
@endsection

@section('title')
Editar información /&nbsp;<b class="text-muted">{{ $investor->investor_name }}<b/>
@endsection

@section('content')
    <div class="container-xl">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('investor.update', ['investor' => $investor]) }}" novalidate>
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
                        <div class="col">
                            <label class="form-label" for="investor_balance">Saldo monetario</label>
                            <input type="number" value="{{ $investor->investor_balance }}" name="investor_balance" id="investor_balance" class="form-control @error('investor_balance') is-invalid @enderror"/>
                            @error('investor_balance')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <input type="hidden" name="investor_status" value="1">
                    </div>
                    <div class="row mb-3 align-items-end">
                        <div class="col">
                            <div class="form-label">Estado / Disposición a proyectos</div>
                            <div>
                                <label class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="investor_status" value="1" {{ $investor->investor_status == 1 ? 'checked' : '' }}>
                                    <span class="form-check-label">Disponible</span>
                                </label>
                                <label class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="investor_status" value="0" {{ $investor->investor_status == 0 ? 'checked' : '' }}>
                                    <span class="form-check-label">No disponible</span>
                                </label>
                            </div>
                            @error('investor_status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
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