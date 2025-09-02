@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">📚 Content Dashboard</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="" class="btn btn-primary mb-3">+ Add Content</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Type</th>
                <th>Author</th>
                <th>Created</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($contents as $content)
                <tr>
                    <td>{{ $content->id }}</td>
                    <td>{{ $content->title }}</td>
                    <td>{{ $content->type }}</td>
                    <td>{{ $content->author->name ?? 'Unknown' }}</td>
                    <td>{{ $content->created_at->diffForHumans() }}</td>
                    <td>
                        <a href="" class="btn btn-warning btn-sm">Edit</a>
                        <form action="" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this content?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6">No content found</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-3">
        {{ $contents->links() }}
    </div>
</div>
@endsection
