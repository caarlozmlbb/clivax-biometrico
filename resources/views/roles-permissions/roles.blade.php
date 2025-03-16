@extends('layouts.master')

@section('title')
    Roles de
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
                    <h3 class="card-title">Lista de Roles</h3>
                </div>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @elseif(session('error'))
                    <div class="alert alert-danger">
                        {{ success('error') }}
                    </div>
                @endif
                <div class="card-body">
                    <p class="text-muted"><strong>Datatables</strong> has most features enabled by default, so all you need
                        to do to use it with your own tables is to call the construction function:
                        <code>$().DataTable()</code>. Searching, ordering and paging goodness will be immediately added to
                        the table, as shown in this example.
                    </p>
                    <div class="row">
                        <div class="col-sm-8 col-lg-10">
                            <div class="mb-2"><button class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#modal8">Crear nuevo rol</button></div>
                        </div>
                    </div>
                    <table id="datatable" class="table table-hover table-bordered table-striped dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Nombre Rol</th>
                                <th>Permisos</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($roles as $rol)
                                <tr>
                                    <td>{{ $rol->id }}</td>
                                    <td>{{ $rol->name }}</td>
                                    <td>
                                        @if ($rol->permissions->isNotEmpty())
                                            @foreach ($rol->permissions as $permission)
                                                <span class="badge bg-primary">{{ $permission->name }}</span>
                                            @endforeach
                                        @else
                                            <span class="text-muted">Sin permisos</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="#editRoleModal-{{ $rol->id }}" class="btn btn-warning btn-sm"
                                            data-bs-toggle="modal">
                                            Editar
                                        </a>
                                        <form action="{{ route('roles.destroy', $rol->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('¿Estás seguro de eliminar este rol?')">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                            @endforelse
                </div>
                </tbody>
                </table>
            </div>
        </div>

    </div>
    <div class="col-xl-6">
        <div class="card">
            <div class="card-header card-header-bordered">
                <h3 class="card-title">Crear un nuevo Usuario</h3>
            </div>
            <div class="card-body">
                <p class="text-muted">More complex forms can be built using our grid classes. Use these for form
                    layouts that require multiple columns, varied widths, and additional alignment options.</p>

                <form class="row g-3" method="POST" action="{{ route('roles.store') }}">
                    @csrf
                    <div class="col-12"><label for="name" class="form-label">Nombre de Usuario</label> <input
                            type="text" class="form-control" id="name" name="name"
                            placeholder="Ingrese nombre de usuario" />
                    </div>
                    <div class="col-12"><label for="email" class="form-label">Correo</label> <input type="email"
                            class="form-control" id="email" name="email" placeholder="Ingrese correo" />
                    </div>
                    <div class="col-md-6"><label for="password" class="form-label">Contraseña</label> <input type="password"
                            class="form-control" id="password" name="password" /></div>
                    <div class="col-md-6"><label for="password_confirmation" class="form-label">Confirmar
                            contraseña</label>
                        <input type="password" class="form-control" id="password_confirmation"
                            name="password_confirmation" />
                    </div>
            </div>
        </div>

        {{-- MODAL PARA AGREGAR UN NUEVO ROL --}}
        <div class="modal fade" id="modal8">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('roles.store') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title">Crear nuevo Rol</h5>
                            <button type="button" class="btn btn-sm btn-label-danger btn-icon" data-bs-dismiss="modal">
                                <i class="mdi mdi-close"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div>
                                <label class="form-label" for="nombre">Nombre del Rol</label>
                                <input class="form-control" id="nombre" type="text" name="nombre" required>
                                <small class="form-text">Escriba el nuevo nombre de rol que desea agregar</small>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" type="submit">Guardar</button>
                            <button class="btn btn-outline-danger" type="reset">Restablecer</button>
                        </div>
                    </form>

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
