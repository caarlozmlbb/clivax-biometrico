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
        <div class="col-xl-12   ">
            <div class="card">
                <div class="card-header card-header-bordered">
                    <h3 class="card-title">Lista de Ambientes planificados</h3>
                </div>
                <div class="card-body">
                    <p class="text-muted">
                        A continuación, se muestra la lista de ambientes planificados en la universidad. Estos ambientes incluyen aulas, laboratorios, clínicas y otros espacios destinados a facilitar las actividades académicas y prácticas. Cada ambiente tiene especificaciones como su nombre, ubicación, tipo y capacidad.
                    </p>
                    @dump($docentes)

                    <table id="datatable" class="table table-hover table-bordered table-striped dt-responsive nowrap"
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
