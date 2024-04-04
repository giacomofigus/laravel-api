@extends('layouts.app')

@section('content')
    <main>
        <div class=" container d-flex justify-content-center">
            <div class="mt-5 border w-50 p-5">
                <h1>Crea il tuo progetto:</h1>
                <form 
                    action="{{ route('dashboard.projects.store') }}" 
                    method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    
                    <div>
                        <label for="name" class="form-label">Nome</label>
                        <input name="name" type="text" class="form-control">
                    </div>

                    <div class="mt-3">
                        <label for="description" class="form-label">Descrizione</label>
                        <textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
                    </div>

                    <div class="mt-3">
                        <label for="cover_image" class="form-label">Inserisci file</label>
                        <input type="file" name="cover_image" id="cover_image" class="form-control">
                    </div>

                    <div class="mt-3">
                        <div class="mb-3">
                            <label for="type_id" class="form-label">
                                Tipo
                            </label>
                            <select
                                class="
                                    form-select 
                                    form-select-lg
                                    {{-- Inserire validazione --}}
                                    "
                                name="type_id"
                                id="type_id"
                            >
                                <option selected value="">Select one</option>

                                @foreach ($types as $item)
                                <option 
                                value="{{ $item->id }}"
                                {{ $item->id == old('type_id') ? 'selected' : '' }}
                                >
                                    {{ $item->name }}
                                </option>
                                @endforeach

                            </select>
                        </div>
                    </div>

                    {{-- Aggiungere tecnologie --}}
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
                        Crea
                    </button>

                </form>
            </div>
        </div>
    </main>
@endsection