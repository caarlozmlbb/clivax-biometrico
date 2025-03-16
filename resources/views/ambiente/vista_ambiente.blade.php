@extends('layouts.master')

@section('title')
    Lista
@endsection

@section('topbar-title')
    Usuarios
@endsection

@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('build/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet"
        type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{ URL::asset('build/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}"
        rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <!-- end row -->

    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header card-header-bordered">
                    <h3 class="card-title">Lista de Ambientes planificados</h3>
                </div>
                <div class="card-body">
                    <p class="text-muted">
                        A continuación, se muestra la lista de ambientes planificados en la universidad. Estos ambientes incluyen aulas, laboratorios, clínicas y otros espacios destinados a facilitar las actividades académicas y prácticas. Cada ambiente tiene especificaciones como su nombre, ubicación, tipo y capacidad.
                    </p>

                    <table id="datatable" class="table table-hover table-bordered table-striped dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>Orden</th>
                                <th>Ambiente</th>
                                <th>Edificio</th>
                                <th>Piso</th>
                                <th>Tipo ambiente</th>
                                <th>Capacidad</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($ambientes as $c => $ambiente)
                                <tr>
                                    <td>{{ $c + 1 }}</td>
                                    <td>{{ $ambiente->ambiente }}</td>
                                    <td>{{ $ambiente->edificio }}</td>
                                    <td>{{ $ambiente->piso }}</td>
                                    <td>{{ $ambiente->tipo_ambiente }}</td>
                                    <td>{{ $ambiente->capacidad_ambiente }}</td>
                                    <td>{{ $ambiente->estado == '1' ? 'Activo' : 'Inactivo' }}</td>
                                    <td style="width: 150px">
                                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalEditar{{ $ambiente->id }}">
                                            Editar
                                        </button>
                                        <form action="{{ route('eliminar_ambiente', $ambiente->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>

                                <!-- Modal de edición -->
                                <div class="modal fade" id="modalEditar{{ $ambiente->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $ambiente->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalLabel{{ $ambiente->id }}">Editar Ambiente</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('actualizar_ambiente', $ambiente->id) }}" method="POST">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label for="ambiente" class="form-label">Ambiente</label>
                                                        <input type="text" class="form-control" name="ambiente" value="{{ $ambiente->ambiente }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="edificio" class="form-label">Edificio</label>
                                                        <select name="edificio" class="form-select">
                                                            @foreach ($edificio as $ed)
                                                                <option value="{{ $ed->id }}" {{ $ambiente->id_edificio == $ed->id ? 'selected' : '' }}>{{ $ed->edificio }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="piso" class="form-label">Piso</label>
                                                        <input type="text" class="form-control" name="piso" value="{{ $ambiente->piso }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="tipo" class="form-label">Tipo Ambiente</label>
                                                        <select name="tipo" class="form-select">
                                                            <option value="AULA" {{ $ambiente->tipo_ambiente == 'AULA' ? 'selected' : '' }}>Aula</option>
                                                            <option value="LABORATORIO" {{ $ambiente->tipo_ambiente == 'LABORATORIO' ? 'selected' : '' }}>Laboratorio</option>
                                                            <option value="CLINICA" {{ $ambiente->tipo_ambiente == 'CLINICA' ? 'selected' : '' }}>Clínica</option>
                                                            <option value="SALON" {{ $ambiente->tipo_ambiente == 'SALON' ? 'selected' : '' }}>Salón</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="capacidad" class="form-label">Capacidad</label>
                                                        <input type="number" class="form-control" name="capacidad" value="{{ $ambiente->capacidad_ambiente }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="estado" class="form-label">Estado</label>
                                                        <select name="estado" class="form-select">
                                                            <option value="1" {{ $ambiente->estado == '1' ? 'selected' : '' }}>Activo</option>
                                                            <option value="0" {{ $ambiente->estado == '0' ? 'selected' : '' }}>Inactivo</option>
                                                        </select>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @empty
                                <tr>
                                    <td colspan="8">No existen ambientes registrados</td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>
            </div>

        </div>
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header card-header-bordered">
                    <h3 class="card-title">Crear un nuevo Ambiente</h3>
                </div>
                <div class="card-body">



                    <form class="row g-3" method="POST" action="{{ route('guardar_ambiente') }}">
                        @csrf
                        <div class="col-12">
                            <label for="ambiente" class="form-label">Ambiente</label>
                            <input type="text" class="form-control" id="ambiente" name="ambiente" placeholder="Ingrese nombre de ambiente" />
                        </div>
                        <div class="col-12">
                            <label for="edificio" class="form-label">Edificio</label>
                            <select name="edificio" id="edificio" class="form-select">
                                <option value="" selected disabled>Seleccione un Edificio</option>
                                @foreach ($edificio as $ed)
                                    <option value="{{$ed->id}}">{{$ed->edificio}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="piso" class="form-label">Piso</label>
                            <input type="text" class="form-control" id="piso" name="piso" placeholder="Ingrese el piso" />
                        </div>
                        <div class="col-md-6">
                            <label for="tipo" class="form-label">Tipo Ambiente</label>
                            <select name="tipo" id="tipo" class="form-select">
                                <option value="" selected disabled>Seleccione un Ambiente</option>
                                <option value="AULA">Aula</option>
                                <option value="LABORATORIO">Laboratorio</option>
                                <option value="CLINICA">Clinica</option>
                                <option value="SALON">Salon</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="capacidad" class="form-label">Capacidad Ambiente</label>
                            <input type="number" class="form-control" id="capacidad" name="capacidad" placeholder="Ingrese capacidad" />
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <!-- Required datatable js -->
    <script src="{{ URL::asset('build/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>

    <!-- Responsive examples -->
    <script src="{{ URL::asset('build/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>

    <!-- Datatable init js -->
    <script src="{{ URL::asset('build/js/pages/datatables-base.init.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
