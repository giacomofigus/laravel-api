@extends('layouts.app')

@section('content')
<main>
    <div class=" container d-flex justify-content-center">
        <div class="mt-5 border w-50 p-5">
            <h1>Modifica il progetto</h1>
            <form 
            action="{{ route('dashboard.projects.update', $project->slug)  }}" 
            method="POST"
            enctype="multipart/form-data"
            >

                @csrf
                @method('put')

                <div class="my-4">
                    <label for="name" class="form-label text-bold">Nome</label>
                    <input name="name" type="text" class="form-control" value="{{ old('name') ?? $project->name }}">
                </div>

                <div>
                    <label for="description" class="form-label text-bold">Descrizione</label>
                    <textarea name="description" id="description" cols="30" rows="10" class="form-control">{{ old('description') ?? $project->description }}</textarea>
                </div>

                
                <div class="mt-3">
                    <label for="cover_image" class="form-label">Inserisci file</label>
                    <input type="file" name="cover_image" id="cover_image" class="form-control">
                </div>

                <div class="border p-3 mt-4">
                    <label for="technologies" class="form-label">
                        Select Technology
                    </label>

                    <select 
                        multiple
                        name="technologies[]" 
                        id="technologies"
                        class="form-select form-select-lg"
                    >
                        @forelse ($technologies as $item)
                            <option value="{{ $item->id }}">
                                {{ $item->name }}
                            </option>
                        @empty
                            <option value="">
                                Non ci sono tecnologie
                            </option>
                        @endforelse
                    </select>

                </div>

                <button type="submit" class="btn btn-primary mt-4">
                    Modifica
                </button>

            </form>
        </div>
    </div>
</main>
@endsection