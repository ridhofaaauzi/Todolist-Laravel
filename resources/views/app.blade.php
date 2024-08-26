<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do List</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <!-- 00. Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid col-md-7">
            <div class="navbar-brand">Simple To Do List</div>
            <!--
            <div class="navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Akun Saya
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Logout</a></li>
                            <li><a class="dropdown-item" href="#">Update Data</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        -->
        </div>
    </nav>

    <div class="container mt-4">
        <!-- 01. Content-->
        <h1 class="text-center mb-4">To Do List</h1>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-body">
                        <!-- 02. Form input data -->
                        @if (@session('success'))
                            <div class="alert alert-success">
                                <p>
                                    {{ session('success') }}
                                </p>
                            </div>
                        @elseif (@session('error'))
                            <div class="alert alert-danger">
                                <p>
                                    {{ session('error') }}
                                </p>
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <p>
                                        {{ $error }}
                                    </p>
                                @endforeach
                            </div>
                        @endif
                        <form id="todo-form" action="{{ route('todo.store') }}" method="post">
                            @csrf
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="task" id="todo-input"
                                    placeholder="Tambah task baru" value="{{ old('task') }}">
                                <button class="btn btn-primary" type="submit">
                                    Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <!-- 03. Searching -->
                        <form id="todo-form" action="{{ route('todo.index') }}" method="get">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="search"
                                    value="{{ request('search') }}" placeholder="masukkan kata kunci">
                                <button class="btn btn-secondary" type="submit">
                                    Cari
                                </button>
                            </div>
                        </form>

                        <ul class="list-group mb-4" id="todo-list">
                            @foreach ($todos as $todo)
                                <!-- 04. Display Data -->
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span class="task-text">
                                        @if ($todo->is_done == '1')
                                            <del>{{ $todo->task }}</del>
                                        @else
                                            {{ $todo->task }}
                                        @endif
                                    </span>
                                    <input type="text" class="form-control edit-input" style="display: none;"
                                        value="{{ $todo->task }}">
                                    <div class="btn-group">
                                        <form action="{{ route('todo.delete', $todo->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure to delete this task?')">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger btn-sm delete-btn">✕</button>
                                        </form>
                                        <button class="btn btn-primary btn-sm edit-btn" data-bs-toggle="collapse"
                                            data-bs-target="#collapse-{{ $loop->index }}"
                                            aria-expanded="false">✎</button>
                                    </div>
                                </li>

                                <!-- 05. Update Data -->
                                <li class="list-group-item collapse" id="collapse-{{ $loop->index }}">
                                    <form action="{{ route('todo.update', $todo->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="task"
                                                    value="{{ $todo->task }}">
                                                <button class="btn btn-outline-primary" type="submit">Update</button>
                                            </div>
                                        </div>
                                        <div class="d-flex">
                                            <div class="radio px-2">
                                                <label>
                                                    <input type="radio" value="1" name="is_done"
                                                        {{ $todo->is_done == '1' ? 'checked' : '' }}> Selesai
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" value="0" name="is_done"
                                                        {{ $todo->is_done == '0' ? 'checked' : '' }}> Belum
                                                </label>
                                            </div>
                                        </div>
                                    </form>
                                </li>
                            @endforeach
                        </ul>
                        {{ $todos->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle (popper.js included) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
