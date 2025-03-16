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
                    <h3 class="card-title">Lista de Usuarios</h3>
                </div>
                <div class="card-body">
                    <p class="text-muted"><strong>Datatables</strong> has most features enabled by default, so all you need
                        to do to use it with your own tables is to call the construction function:
                        <code>$().DataTable()</code>. Searching, ordering and paging goodness will be immediately added to
                        the table, as shown in this example.
                    </p>

                    <table id="datatable" class="table table-hover table-bordered table-striped dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Correo</th>
                                <th>Roles</th>
                                <th>Fecha actualizacion</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if ($user->roles->isNotEmpty())
                                            @foreach ($user->roles as $rol)
                                                <span class="badge btn btn-info">{{ $rol->name }}</span>
                                            @endforeach
                                        @else
                                            <span class="badge bg-secondary">Sin roles</span>
                                        @endif
                                    </td>
                                    <td style="width: 100px">
                                        {{-- <a class="btn btn-primary btn-sm edit" title="Edit">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a> --}}
                                        <button type="button" class="btn btn-link text-dark px-3 mb-0"
                                            data-bs-toggle="modal" data-bs-target="#editRolesModal-{{ $user->id }}">
                                            <i class="fas fa-user-edit text-dark me-2"></i>Editar Roles
                                        </button>
                                        {{-- <form action="{{ route('usuarios.eliminar', $usuario->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('¿Estás seguro de que deseas eliminar este usuario?')">
                                                <i class="fas fa-trash-alt"></i>Eliminar
                                            </button>
                                        </form> --}}

                                        {{-- <a class="btn btn-success btn-sm update" title="Update">
                                            <i class="fas fa-sync-alt"></i>
                                        </a> --}}
                                    </td>
                                </tr>
                                <div class="modal fade" id="editRolesModal-{{ $user->id }}" tabindex="-1"
                                    aria-labelledby="editRolesModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editRolesModalLabel">Editar Roles de
                                                    {{ $user->name }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('asignar_rol', $user->id) }}" method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="roles" class="form-label">Roles
                                                            disponibles</label>
                                                        <div>
                                                            @foreach ($roles as $rol)
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        id="rol_{{ $rol->id }}" name="roles[]"
                                                                        value="{{ $rol->name }}"
                                                                        @if ($user->hasRole($rol->name)) checked @endif>
                                                                    <label class="form-check-label"
                                                                        for="rol_{{ $rol->id }}">
                                                                        {{ $rol->name }}
                                                                    </label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cerrar</button>
                                                    <button type="submit" class="btn btn-primary">Guardar
                                                        cambios</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <tr>
                                    No existen usuarios
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
            {{-- <div class="card border">
                <div class="card-header card-header-bordered">
                    <h3 class="card-title">Color</h3>
                </div>
                <div class="card-body">
                    <p class="text-muted">By default, the <code>placeholder</code> uses <code>currentColor</code>. This can
                        be overridden with a custom color or utility class.</p>
                    <div class="card border mb-0">
                        <div class="card-body"><span class="placeholder col-12"></span> <span
                                class="placeholder col-12 bg-primary"></span> <span
                                class="placeholder col-12 bg-secondary"></span> <span
                                class="placeholder col-12 bg-success"></span> <span
                                class="placeholder col-12 bg-danger"></span> <span
                                class="placeholder col-12 bg-warning"></span> <span
                                class="placeholder col-12 bg-info"></span> <span class="placeholder col-12 bg-light"></span>
                            <span class="placeholder col-12 bg-dark"></span>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header card-header-bordered">
                    <h3 class="card-title">Crear un nuevo Usuario</h3>
                </div>
                <div class="card-body">
                    <p class="text-muted">More complex forms can be built using our grid classes. Use these for form
                        layouts that require multiple columns, varied widths, and additional alignment options.</p>

                    <form class="row g-3" method="POST" action="{{ route('crear_usuario') }}">
                        @csrf
                        <div class="col-12"><label for="name" class="form-label">Nombre de Usuario</label> <input
                                type="text" class="form-control" id="name" name="name"
                                placeholder="Ingrese nombre de usuario" />
                        </div>
                        <div class="col-12"><label for="email" class="form-label">Correo</label> <input type="email"
                                class="form-control" id="email" name="email" placeholder="Ingrese correo" />
                        </div>
                        <div class="col-md-6"><label for="password" class="form-label">Contraseña</label> <input
                                type="password" class="form-control" id="password" name="password" /></div>
                        <div class="col-md-6"><label for="password_confirmation" class="form-label">Confirmar
                                contraseña</label>
                            <input type="password" class="form-control" id="password_confirmation"
                                name="password_confirmation" />
                        </div>

                        {{-- <div class="col-12"><label for="inputAddress2" class="form-label">Address 2</label> <input
                                type="text" class="form-control" id="inputAddress2"
                                placeholder="Apartment, studio, or floor" /></div>
                        <div class="col-md-6"><label for="inputCity" class="form-label">City</label> <input
                                type="text" class="form-control" id="inputCity" /></div>
                        <div class="col-md-4">
                            <label for="inputState" class="form-label">State</label>
                            <select id="inputState" class="form-select">
                                <option selected="selected">Choose...</option>
                                <option>...</option>
                            </select>
                        </div>
                        <div class="col-md-2"><label for="inputZip" class="form-label">Zip</label> <input type="text"
                                class="form-control" id="inputZip" /></div>
                        <div class="col-12">
                            <div class="form-check"><input class="form-check-input" type="checkbox" id="gridCheck" />
                                <label class="form-check-label" for="gridCheck">Check me out</label>
                            </div>
                        </div> --}}
                        <div class="col-12"><button type="submit" class="btn btn-primary">Enviar</button></div>
                    </form>
                </div>
            </div>

            {{-- <div class="card">
                <div class="card-header card-header-bordered">
                    <h3 class="card-title">Animation</h3>
                </div>
                <div class="card-body">
                    <p class="text-muted">Animate placeholders with <code>.placeholder-glow</code> or
                        <code>.placeholder-wave</code> to better convey the perception of something being <em>actively</em>
                        loaded.
                    </p>
                    <div class="card border mb-0">
                        <div class="card-body">
                            <div class="placeholder-glow"><span class="placeholder col-12"></span></div>
                            <div class="placeholder-wave"><span class="placeholder col-12"></span></div>
                        </div>
                    </div>
                </div>
            </div> --}}
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
