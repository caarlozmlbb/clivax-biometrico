@extends('layouts.master')

@section('title')
    Lista
@endsection

@section('topbar-title')
    Docentes
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
        <div class="col-xl-12   ">
            <div class="card">
                <div class="card-header card-header-bordered d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Lista de Docentes</h3>
                    <button class="btn btn-success" title="Agregar nuevo docente" data-bs-toggle="modal" data-bs-target="#registro_horario">
                        <i class="mdi mdi-plus-circle"></i> Agregar nuevo registro de horario
                    </button>
                </div>
                <div class="card-body">
                    <p class="text-muted">
                        📚 A continuación, se muestra la lista completa de horarios asignados a los docentes universitarios.
                        Esta tabla presenta la programación semanal de cada docente, detallando los días (lunes a sábado),
                        ambientes utilizados y horas de clase. 📅 Además, incluye información relevante como identificación
                        del docente, nivel-turno-paralelo, materia impartida y categoría profesional. ✏️
                    </p>
                    {{-- @dump($docentes) --}}

                    <table id="datatable" class="table table-hover table-bordered table-striped dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Asignar</th>
                                <th>LUNES</th>
                                <th>MARTES</th>
                                <th>MIERCOLES</th>
                                <th>JUEVES</th>
                                <th>VIERNES</th>
                                <th>SABADO</th>
                                <th>DOCENTE</th>
                                <th>CI</th>
                                <th>N-T-P</th>
                                <th>MATERIA</th>
                                <th>CATEGORIA</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($docentes as $c => $d)
                                <tr>
                                    <td scope="row">
                                        {{$c+1}}

                                    </td>

                                     <!-- Modal -->
                                     <td>
                                        <button class="btn btn-primary btn-sm" title="Asignar horas al docente"
                                            data-bs-toggle="modal" data-bs-target="#asignar_horario_{{$d->asignacion_id}}">
                                            <i class="mdi mdi-calendar-plus"></i> Asignar
                                        </button>
                                    </td>

                                    <!-- Modal con ID único por docente -->

                                    @foreach([1 => 'Lunes', 2 => 'Martes', 3 => 'Miércoles', 4 => 'Jueves', 5 => 'Viernes', 6 => 'Sábado'] as $dia_id => $dia_nombre)
                                        <td>
                                            @php
                                                $horarios_dia = $d->horarios->where('dia_id', $dia_id);
                                            @endphp
                                            @foreach($horarios_dia as $h)
                                                <code>{{$h->dias}}</code>
                                                <p>{{$h->ambiente}}</p>
                                                <p>{{$h->horas}}</p>
                                                <button class="btn btn-danger btn-sm" onclick="anular_registro('{{$h->id}}')" title="Anular registro">
                                                    <i class="bi bi-x-circle"></i> Anular
                                                </button>

                                            @endforeach
                                            @if($horarios_dia->isEmpty())
                                                <p>—</p>
                                            @endif
                                        </td>
                                    @endforeach

                                    <td>{{$d->docente}}</td>
                                    <td>{{$d->ci}}</td>
                                    <td>{{$d->nivel}}</td>
                                    <td>{{$d->materia}}</td>
                                    <td>{{$d->categoria}}</td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>

   <!-- Modal -->
<div class="modal fade" id="registro_horario" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h4 class="modal-title" id="modalLabel"><i class="fa fa-calendar-plus"></i> Nuevo Registro de Horario</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('guardar_horas') }}">
                    @csrf
                    <!-- Campo CI arriba independiente -->
                    <div class="mb-3">
                        <label for="ci_docente" class="form-label"><i class="fa fa-id-card"></i> Número de Carnet Docente:</label>
                        <input type="text" class="form-control" id="ci_docente" name="ci_docente" required>
                    </div>

                    <!-- Campos en dos columnas -->
                    <div class="row">
                        <!-- Columna izquierda -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="asignatura" class="form-label"><i class="fa fa-book"></i> Asignatura:</label>
                                <select class="form-control" id="asignatura" name="asignatura">
                                    {{-- @foreach ($asignaturas as $asignatura)
                                        <option value="{{ $asignatura->id }}">{{ $asignatura->nombre }}</option>
                                    @endforeach --}}
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="id_dia" class="form-label"><i class="fa fa-calendar"></i> Días:</label>
                                <select class="form-control" id="id_dia" name="id_dia">
                                    {{-- @foreach ($dias as $dia)
                                        <option value="{{ $dia->id }}">{{ $dia->dias }}</option>
                                    @endforeach --}}
                                </select>
                            </div>
                        </div>

                        <!-- Columna derecha -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="ambiente" class="form-label"><i class="fa fa-building"></i> Ambiente:</label>
                                <select class="form-control" id="ambiente" name="ambiente">
                                    {{-- @foreach ($ambientes as $ambiente)
                                        <option value="{{ $ambiente->id }}">{{ $ambiente->nombre }}</option>
                                    @endforeach --}}
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="horario" class="form-label"><i class="fa fa-clock"></i> Horario:</label>
                                <select class="form-control" id="horario" name="horario">
                                    {{-- @foreach ($horarios as $horario)
                                        <option value="{{ $horario->id }}">{{ $horario->hora_inicio }} - {{ $horario->hora_fin }}</option>
                                    @endforeach --}}
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="asignar_horario_{{$d->asignacion_id}}" tabindex="-1" aria-labelledby="modalLabel_{{$d->asignacion_id}}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalLabel_{{$d->asignacion_id}}">
                    <i class="mdi mdi-calendar-clock me-2"></i> Asignación de Horario
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('guardar_horas') }}">
                    @csrf
                    <input type="hidden" name="asignacion_id" value="{{$d->asignacion_id}}">

                    <!-- Información del docente -->
                    <div class="card mb-3 bg-light">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center mb-2">
                                <i class="mdi mdi-account-circle text-primary me-2" style="font-size: 24px;"></i>
                                <h5 class="mb-0">{{$d->docente}}</h5>
                            </div>
                            <div class="row g-2">
                                <div class="col-sm-4">
                                    <div class="small text-muted">CI:</div>
                                    <div class="fw-bold">{{$d->ci}}</div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="small text-muted">Materia:</div>
                                    <div class="fw-bold">{{$d->materia}}</div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="small text-muted">Categoría:</div>
                                    <div class="fw-bold">{{$d->categoria}}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Formulario de asignación -->
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <select class="form-select" id="id_dia_{{$d->asignacion_id}}" name="id_dia" required>
                                    <option value="" selected disabled>Seleccione...</option>
                                    <option value="1">Lunes</option>
                                    <option value="2">Martes</option>
                                    <option value="3">Miércoles</option>
                                    <option value="4">Jueves</option>
                                    <option value="5">Viernes</option>
                                    <option value="6">Sábado</option>
                                </select>
                                <label for="id_dia_{{$d->asignacion_id}}">
                                    <i class="mdi mdi-calendar me-1"></i> Día
                                </label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <select class="form-select" id="ambiente_{{$d->asignacion_id}}" name="ambiente" required>
                                    <option value="" selected disabled>Seleccione...</option>
                                    <!-- Aquí deberías iterar sobre los ambientes disponibles -->
                                    <option value="A101">Aula A101</option>
                                    <option value="A102">Aula A102</option>
                                    <option value="LAB1">Laboratorio 1</option>
                                </select>
                                <label for="ambiente_{{$d->asignacion_id}}">
                                    <i class="mdi mdi-domain me-1"></i> Ambiente
                                </label>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-floating mb-3">
                                <select class="form-select" id="horario_{{$d->asignacion_id}}" name="horario" required>
                                    <option value="" selected disabled>Seleccione...</option>
                                    <!-- Aquí deberías iterar sobre los horarios disponibles -->
                                    <option value="1">07:00 - 08:30</option>
                                    <option value="2">08:30 - 10:00</option>
                                    <option value="3">10:15 - 11:45</option>
                                    <option value="4">11:45 - 13:15</option>
                                </select>
                                <label for="horario_{{$d->asignacion_id}}">
                                    <i class="mdi mdi-clock-outline me-1"></i> Horario
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-3">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                            <i class="mdi mdi-close me-1"></i> Cancelar
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="mdi mdi-content-save me-1"></i> Guardar
                        </button>
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

{{--
@extends('layouts.master')

@section('title')
    Buttons Extension
@endsection

@section('topbar-title')
    Datatable
@endsection

@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('build/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- buttons datatable -->
    <link href="{{ URL::asset('build/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable -->
    <link href="{{ URL::asset('build/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}" rel="stylesheet"
        type="text/css" />
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Datatable buttons extension</h4>
                </div>
                <div class="card-body">
                    <p>As part of the Datatable constructor, the <code>buttons</code> option can be given as an array of the
                        button name.</p>

                    <table id="datatable-buttons"
                        class="table table-hover table-bordered table-striped dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>LUNES</th>
                                <th>MARTES</th>
                                <th>MIERCOLES</th>
                                <th>JUEVES</th>
                                <th>VIERNES</th>
                                <th>SABADO</th>
                                <th>DOCENTE</th>
                                <th>CI</th>
                                <th>N-T-P</th>
                                <th>MATERIA</th>
                                <th>CATEGORIA</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($docentes as $c => $d)
                            <tr>
                                <td scope="row">
                                    {{$c+1}}
                                    <button class="btn btn-primary btn-sm" onclick="asignar_horas_docente('{{$d->asignacion_id}}')" title="Asignar horas al docente">
                                        <i class="mdi mdi-account-plus"></i> +
                                    </button>

                                </td>

                                @foreach([1 => 'Lunes', 2 => 'Martes', 3 => 'Miércoles', 4 => 'Jueves', 5 => 'Viernes', 6 => 'Sábado'] as $dia_id => $dia_nombre)
                                    <td>
                                        @php
                                            $horarios_dia = $d->horarios->where('dia_id', $dia_id);
                                        @endphp
                                        @foreach($horarios_dia as $h)
                                            <code>{{$h->dias}}</code>
                                            <p>{{$h->ambiente}}</p>
                                            <p>{{$h->horas}}</p>
                                            <button class="btn btn-danger btn-sm" onclick="anular_registro('{{$h->id}}')" title="Anular registro">
                                                <i class="bi bi-x-circle"></i> Anular
                                            </button>

                                        @endforeach
                                        @if($horarios_dia->isEmpty())
                                            <p>—</p>
                                        @endif
                                    </td>
                                @endforeach

                                <td>{{$d->docente}}</td>
                                <td>{{$d->ci}}</td>
                                <td>{{$d->nivel}}</td>
                                <td>{{$d->materia}}</td>
                                <td>{{$d->categoria}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
    <!-- end row -->
@endsection

@section('scripts')
    <!-- Required datatable js -->
    <script src="{{ URL::asset('build/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>

    <!-- buttons examples -->
    <script src="{{ URL::asset('build/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/jszip/dist/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/pdfmake/build/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('build/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>

    <!-- Responsive examples -->
    <script src="{{ URL::asset('build/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>

    <!-- Datatable init js -->
    <script src="{{ URL::asset('build/js/pages/datatables-extension.init.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection --}}
