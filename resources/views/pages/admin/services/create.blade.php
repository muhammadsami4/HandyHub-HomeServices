@include('layouts.admin.head')

<body>

    <!-- Overlay -->
    <div class="overlay" id="overlay" onclick="closeMobileSidebar()"></div>

    @include('layouts.admin.sidebar')

    <!-- Main -->
    <div class="main-wrap" id="mainWrap">

        @include('layouts.admin.header')

        <!-- Content -->
        <main class="content">

            <h1 class="page-title">Services</h1>
            <p class="breadcrumb-text">Home / Services</p>

            {{-- SUCCESS MESSAGE --}}
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            {{-- ADD SERVICE --}}
            <div class="card p-4 mt-4">

                <h4 class="mb-4">Add New Service</h4>

                <form action="{{ route('services.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label>Service Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Description</label>
                        <textarea name="description" class="form-control" rows="4"></textarea>
                    </div>

                    <div class="mb-3">
                        <label>Font Awesome Icon</label>
                        <input type="text" name="icon" class="form-control" placeholder="fas fa-tools">
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Add Service
                    </button>

                </form>

            </div>

            {{-- SERVICES TABLE --}}
            <div class="card p-4 mt-5">

                <h4 class="mb-4">All Services</h4>

                <table class="table table-bordered align-middle">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Icon</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th width="220">Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($services as $service)

                            <tr>

                                <td>{{ $loop->iteration }}</td>

                                <td>
                                    <i class="{{ $service->icon }}"></i>
                                </td>

                                <td>{{ $service->name }}</td>

                                <td>{{ $service->description }}</td>

                                <td>

                                    {{-- EDIT BUTTON --}}
                                    <button
                                        class="btn btn-warning btn-sm"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editModal{{ $service->id }}">
                                        Edit
                                    </button>

                                    {{-- DELETE FORM --}}
                                    <form action="{{ route('services.delete', $service->id) }}"
                                          method="POST"
                                          class="d-inline">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure?')">

                                            Delete

                                        </button>

                                    </form>

                                </td>

                            </tr>

                            {{-- EDIT MODAL --}}
                            <div class="modal fade"
                                 id="editModal{{ $service->id }}"
                                 tabindex="-1">

                                <div class="modal-dialog">

                                    <div class="modal-content">

                                        <div class="modal-header">

                                            <h5 class="modal-title">
                                                Edit Service
                                            </h5>

                                            <button type="button"
                                                    class="btn-close"
                                                    data-bs-dismiss="modal">
                                            </button>

                                        </div>

                                        <form action="{{ route('services.update', $service->id) }}"
                                              method="POST">

                                            @csrf
                                            @method('PUT')

                                            <div class="modal-body">

                                                <div class="mb-3">
                                                    <label>Service Name</label>

                                                    <input type="text"
                                                           name="name"
                                                           class="form-control"
                                                           value="{{ $service->name }}"
                                                           required>
                                                </div>

                                                <div class="mb-3">
                                                    <label>Description</label>

                                                    <textarea name="description"
                                                              class="form-control"
                                                              rows="4">{{ $service->description }}</textarea>
                                                </div>

                                                <div class="mb-3">
                                                    <label>Icon</label>

                                                    <input type="text"
                                                           name="icon"
                                                           class="form-control"
                                                           value="{{ $service->icon }}">
                                                </div>

                                            </div>

                                            <div class="modal-footer">

                                                <button type="button"
                                                        class="btn btn-secondary"
                                                        data-bs-dismiss="modal">

                                                    Close

                                                </button>

                                                <button type="submit"
                                                        class="btn btn-primary">

                                                    Update Service

                                                </button>

                                            </div>

                                        </form>

                                    </div>

                                </div>

                            </div>

                        @empty

                            <tr>
                                <td colspan="5" class="text-center">
                                    No Services Found
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </main>

    </div>

    @include('layouts.admin.script')

</body>