@extends('layouts.master')

@section('title', 'Gestión de Horarios')

@section('topbar-title', 'Configuración de Ambientes')

@section('content')
    <div class="row">
        <!-- Selección de ambientes -->
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header card-header-bordered">
                    <h3 class="card-title">🏢 Tus Ambientes Disponibles</h3>
                </div>
                <div class="card-body">
                    <p class="text-muted">
                        <i class="fa fa-info-circle"></i> Selecciona un ambiente de la lista para gestionar sus horarios.
                        Cada ambiente muestra su capacidad en estudiantes.
                    </p>
                    <div class="list-group">
                        <div class="list-group-item active d-flex justify-content-between">
                            <strong>📍 Ambiente</strong>
                            <strong>👥 Capacidad</strong>
                        </div>
                        @foreach ($ambient as $am)
                            <a href="#" onclick="seleccionambiente('{{ $am->id }}')"
                                class="list-group-item list-group-item-action d-flex justify-content-between">
                                <span>{{ $am->ambiente }}</span>
                                <span class="badge bg-primary rounded-pill">{{ $am->capacidad_ambiente }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Creación de horarios -->
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header card-header-bordered">
                    <h3 class="card-title">⏰ Programación de Horarios</h3>
                </div>
                <div class="card-body">
                    <p class="text-muted">
                        <i class="fa fa-calendar-alt"></i> En esta sección podrás visualizar y crear horarios para el ambiente seleccionado.
                    </p>
                    <p class="text-muted">
                        <i class="fa fa-lightbulb"></i> Recuerda verificar la disponibilidad antes de crear nuevos horarios.
                    </p>
                    <h2 id="nombre_ambiente" class="alert alert-info text-center mb-3">📌 Seleccione un ambiente</h2>

                    @if (session('success'))
                        <div class="alert alert-success">
                            <i class="fa fa-check-circle"></i> {{ session('success') }}
                        </div>
                    @elseif(session('error'))
                        <div class="alert alert-danger">
                            <i class="fa fa-exclamation-triangle"></i> {{ session('error') }}
                        </div>
                    @endif

                    <!-- Botón para abrir el modal -->
                    <button class="btn btn-outline-success w-100 mb-3" data-bs-toggle="modal" data-bs-target="#modal_creacion_horario">
                        <i class="fa fa-plus-circle"></i> Agregar nuevo registro de hora
                    </button>

                    <div class="list-group mt-3">
                        <div class="list-group-item active d-flex justify-content-between">
                            <strong>📅 Días</strong>
                            <strong>⏱️ Horas</strong>
                        </div>
                        <div id="dias-horas-container">
                            @foreach ($dias as $dia)
                                <li class="list-group-item" id="dia-{{ $dia->id }}">
                                    <strong>{{ $dia->dias }}</strong>
                                    <div class="horas-container">
                                        @php
                                            $horas = DB::table('horarios as h')
                                                ->select('r.*')
                                                ->join('dias as d', 'h.id_dia', '=', 'd.id')
                                                ->join('ambientes as a', 'h.id_ambiente', '=', 'a.id')
                                                ->join('horas as r', 'h.id', '=', 'r.id_horario')
                                                ->where('id_planificar_horario', $id_planificar)
                                                ->where('id_dia', $dia->id)
                                                ->where('id_ambiente', Session::get('id_ambiente'))
                                                ->orderBy('r.hora_inicio', 'ASC')
                                                ->get();
                                        @endphp
                                        @foreach ($horas as $r)
                                            <p class="mb-1"><i class="fa fa-clock"></i> {{ $r->hora_inicio }} - {{ $r->hora_fin }}</p>
                                        @endforeach
                                    </div>
                                </li>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal_creacion_horario" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h4 class="modal-title" id="modalLabel"><i class="fa fa-calendar-plus"></i> Nuevo Registro de Horario</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('guardar_horas') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="dias" class="form-label"><i class="fa fa-calendar"></i> Día de la semana:</label>
                            <select class="form-control" id="id_dia" name="id_dia">
                                @foreach ($dias as $dia)
                                    <option value="{{ $dia->id }}">{{ $dia->dias }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="hora_inicio" class="form-label"><i class="fa fa-hourglass-start"></i> Hora de Inicio:</label>
                            <input type="time" class="form-control" id="hora_inicio" name="hora_inicio" required>
                        </div>
                        <div class="mb-3">
                            <label for="hora_fin" class="form-label"><i class="fa fa-hourglass-end"></i> Hora Fin:</label>
                            <input type="time" class="form-control" id="hora_fin" name="hora_fin" required>
                            <input id="id_ambiente" name="id_ambiente" type="hidden" value="">
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
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert@2/dist/sweetalert.min.js"></script>
    <script>
        function seleccionambiente(id) {
            $.post('/seleccioname_ambiente', {
                id: id,
                _token: '{{ csrf_token() }}'
            }, function(data) {
                if (data.success) {
                    swal("✅ NOTA!", "Ambiente seleccionado: " + data.ambiente, "success");

                    // Asigna el valor del ambiente seleccionado al input hidden
                    $("#id_ambiente").val(data.id_ambiente);

                    // Verifica que el valor se asignó correctamente
                    console.log("Valor de id_ambiente actualizado: ", $("#id_ambiente").val());

                    // Actualiza el nombre del ambiente
                    $("#nombre_ambiente").text("🏫 " + data.ambiente);

                    // Cargar horas para este ambiente
                    cargarHorasPorAmbiente(data.id_ambiente);
                } else {
                    swal("❌ Error!", "No se pudo seleccionar el ambiente", "error");
                }
            }).fail(function() {
                swal("❌ Error!", "Hubo un problema con la solicitud", "error");
            });
        }

        function cargarHorasPorAmbiente(id_ambiente) {
            $.post('/obtener_horas_por_ambiente', {
                id_ambiente: id_ambiente,
                _token: '{{ csrf_token() }}'
            }, function(data) {
                if (data.success) {
                    console.log(data);

                    $(".horas-container").empty();

                    // Actualizar horas para cada día
                    $.each(data.horas_por_dia, function(id_dia, horas) {
                        var contenedorHoras = $("#dia-" + id_dia + " .horas-container");
                        contenedorHoras.empty();

                        if (horas.length > 0) {
                            $.each(horas, function(index, hora) {
                                contenedorHoras.append('<p class="mb-1"><i class="fa fa-clock"></i> ' + hora.hora_inicio + ' - ' + hora.hora_fin + '</p>');
                            });
                        } else {
                            contenedorHoras.append('<p class="text-muted"><i class="fa fa-info-circle"></i> No hay horas registradas</p>');
                        }
                    });
                } else {
                    console.error("Error al cargar las horas");
                }
            }).fail(function() {
                console.error("Error en la solicitud para cargar horas");
            });
        }
    </script>
@endsection

@section('scripts')
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Seleccionar el primer ambiente por defecto
            if ($('.list-group-item-action').length > 0) {
                // Obtener el ID del primer ambiente
                var primerAmbienteId = $('.list-group-item-action').first().attr('onclick').match(/'([^']+)'/)[1];

                // Llamar a la función de selección de ambiente con el ID del primer ambiente
                seleccionambiente(primerAmbienteId);
            }
        });
    </script>
@endsection
