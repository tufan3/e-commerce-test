@extends('home')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('All Category') }}
                        <a style="float: right;" href="{{ route('categories.create') }}" class="btn btn-success btn-sm">Add
                            Category</a>
                    </div>
                    <div class="card-body">
                        @if (session()->has('success'))
                            <strong class="text-success">{{ session()->get('success') }}</strong>
                        @endif
                        <table class="table table-responsive">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Category Name</th>
                                    <th>Slug</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($category as $key => $row)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $row->category_name }}</td>
                                        <td>{{ $row->category_slug }}</td>
                                        <td>
                                            <a href="{{ route('categories.edit', $row->category_slug) }}"
                                                class="btn btn-info btn-sm">Edit</a>

                                            <form action="{{ route('categories.destroy', $row->category_slug) }}"method="POST"
                                                style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this category?');">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
