@extends('layout.admin')

@section('pretitle')
Inversionistas
@endsection

@section('title')
Editar información /&nbsp;<b class="text-muted">{{ $project->project_name }}<b/>
@endsection

@section('content')
    <div class="container-xl">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('project.update', ['project' => $project]) }}" novalidate>
                    @method('PUT')
                    @csrf
                    <div class="row mb-3 align-items-end">
                        <div class="col">
                            <label class="form-label" for="project_name">Nombre del inversionista</label>
                            <input type="text" maxlength="55" value="{{ $project->project_name }}" name="project_name" id="project_name" class="form-control @error('project_name') is-invalid @enderror" placeholder="Ingrese el nombre del inversionista" autocomplete="off"/>
                            @error('project_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col">
                            <label class="form-label" for="project_dni">Nº identidad</label>
                            <input type="text" maxlength="13" value="{{ $project->project_dni }}" name="project_dni" id="project_dni" class="form-control @error('project_dni') is-invalid @enderror" placeholder="Ingrese el número de identidad" autocomplete="off"/>
                            @error('project_dni')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <input type="hidden" name="project_status" value="1">
                    </div>
                    <div class="row mb-3 align-items-end">
                        <div class="col">
                            <label class="form-label" for="project_phone">Nº teléfono</label>
                            <input type="text" name="project_phone" value="{{ $project->project_phone }}" id="project_phone" class="form-control @error('project_phone') is-invalid @enderror" data-mask="00000000" data-mask-visible="true" placeholder="00000000" autocomplete="off"/>
                            @error('project_phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col">
                            <label class="form-label" for="project_reference">Recomendado por</label>
                            <input type="text" maxlength="55" value="{{ $project->project_reference }}" name="project_reference" id="project_reference" class="form-control @error('project_reference') is-invalid @enderror" placeholder="Ingrese el nombre del recomendor" autocomplete="off"/>
                            @error('project_reference')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <a href="{{ route('project.index') }}" class="btn btn-dark me-auto">Volver</a>
                    <button type="submit" class="btn btn-teal">Guardar cambios</button>
                </form>
            </div>
        </div>
    </div>
@endsection