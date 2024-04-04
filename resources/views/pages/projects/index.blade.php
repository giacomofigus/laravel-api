@extends('layouts.app')

@section('content')
    <main class="container">
        <h1 class="pt-3">Lista dei progetti:</h1>

        {{-- Create Project --}}
        <a 
        href="{{ route('dashboard.projects.create') }}"
        class="btn btn-primary"
        role="button"
        >
        Crea
        </a>

        <div
            class="table-responsive py-3"
        >
            <table
                class="table table-primary"
            >
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Description</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Cover Images</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($projects as $item)
                        <tr>
                            <td>
                                <a href="{{ route('dashboard.projects.show', $item->slug) }}">
                                    {{ $item->name }}
                                </a>
                            </td>
                            <td>{{  $item->type_id  }}</td>
                            <td>{{ $item->description }}</td>
                            <td>{{ $item->slug }}</td>
                            <td>{{ $item->cover_image }}</td>
                            <td >
                                {{-- Delete --}}
                                <form action="{{ route('dashboard.projects.destroy', $item->slug ) }}" method="post">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger">
                                        Delete
                                    </button>
                                </form>

                                {{-- Edit --}}
                                <a href="{{ route('dashboard.projects.edit', $item->slug ) }}" class="btn btn-primary">
                                    Edit
                                </a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        
    </main>
@endsection
