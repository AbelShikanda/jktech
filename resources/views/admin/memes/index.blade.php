@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="mb-2 page-title">Memes Table</h2>
                <div class="row">
                    <div class="col-md-6">
                        <p class="card-text">
                            meme available in the organization
                        </p>
                    </div>
                    <div class="col-md-6">
                        @if(auth('admin')->user()?->can('admin.content.manage'))
                        <a href="{{ route('memes.create') }}" type="button"
                            class=" float-right btn mb-2 btn-outline-primary">Add memes</a>
                        @endif
                    </div>
                </div>

                @if (Session('success'))
                    <div class="text-success text-center">
                        <strong>{{ Session('success') }}</strong>
                    </div>
                @endif

                <div class="row my-4">
                    <!-- Small table -->
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-body">
                                <!-- table -->
                                <table class="table datatables" id="dataTable-1">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Ur;</th>
                                            <th>Updated_on</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse (($memes ?? collect()) as $w)
                                            <tr>
                                                <td>{{ $w->id }}</td>
                                                <td>{{ $w->heading ?? 'N/A' }}</td>
                                                <td>{{ \Illuminate\Support\Str::limit($w->description ?? '', 40) }}</td>
                                                <td>{{ optional($w->created_at)->format('Y-m-d H:i') ?? 'N/A' }}</td>
                                                <td>
                                                    <button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <span class="text-muted sr-only">Action</span>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="{{ route('memes.show', $w->id) }}">View</a>
                                                        @if(auth('admin')->user()?->can('admin.content.manage'))
                                                        <a class="dropdown-item" href="{{ route('memes.edit', $w->id) }}">Edit</a>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr><td colspan="5" class="text-muted text-center">No memes found.</td></tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> <!-- simple table -->
                </div> <!-- end section -->
            </div> <!-- .col-12 -->
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->
    @include('admin.layouts.partials.modals')
@endsection
