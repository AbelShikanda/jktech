@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="mb-2 page-title">Service faqs Table</h2>
                <div class="row">
                    <div class="col-md-6">
                        <p class="card-text">
                            faqs of Services available in the organization
                        </p>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ route('faqs.create') }}" type="button"
                            class=" float-right btn mb-2 btn-outline-primary">Add FAQ</a>
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
                                            <th>Question</th>
                                            <th>Answer</th>
                                            <th>Active</th>
                                            <th>updated at</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($faqs as $item)
                                            <tr>
                                                <td>{{ $item->id }}</td>
                                                <td>{{ Str::words($item->question, 4, '...') }}</td>
                                                <td>{{ Str::words($item->answer, 4, '...') }}</td>
                                                <td>
                                                    @if ($item->is_active)
                                                        <span class="badge bg-success">Active</span>
                                                    @else
                                                        <span class="badge bg-warning">inactive</span>
                                                    @endif

                                                </td>
                                                <td>{{ $item->updated_at }}</td>
                                                <td><button class="btn btn-sm dropdown-toggle more-horizontal"
                                                        type="button" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        <span class="text-muted sr-only">Action</span>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item"
                                                            href="{{ route('faqs.edit', $item->id) }}">Edit</a>

                                                        <a class="dropdown-item"
                                                            href="{{ route('faqs.destroy', $item->id) }}"
                                                            onclick="event.preventDefault();
                                                            document.getElementById('destroy-faqs').submit();">
                                                            {{ __('Remove') }}
                                                        </a>

                                                        <form id="destroy-faqs"
                                                            action="{{ route('faqs.destroy', $item->id) }}" method="POST"
                                                            class="d-none">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
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
