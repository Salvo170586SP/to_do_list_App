@extends('home')

@section('contain')
    <div class="row">
        <div class=" offset-3 col-6 mt-3 mb-1 d-flex justify-content-between align-items-center">
            <h2>TO DO LIST</h2>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Add To-Do
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Crea nuova to-do</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('posts.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Scrivi To-Do</label>
                                    <input type="text" name="description" class="form-control"
                                        aria-describedby="emailHelp">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" hidden>Immagine</label>
                                    <input type="url" name="image" hidden class="form-control">
                                </div>
                                <button type="submit" class="btn btn-primary">Crea</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('includes.filter_menu')
        <div class="offset-3 col-6">
            <div class="my-1">
                <a class="btn btn-sm btn-outline-primary" href="{{ route('posts.selectAll') }}"><i
                        class="fa-solid fa-circle-check me-1"></i> Seleziona tutti</a>
                <a class="btn btn-sm btn-outline-secondary" href="{{ route('posts.deselectAll') }}"><i
                        class="fa-regular fa-circle-check me-1"></i> Deseleziona tutti</a>
            </div>
            <table class="table rounded-4 shadow mt-4">
                <tbody>
                    @forelse ($posts as $post)
                        <tr>
                            <td class="d-flex align-items-center">
                                <a href="{{ route('checkTodo', $post->id) }}">
                                    @if ($post->is_checked == 0)
                                        <i class="fa-regular fa-circle-check"></i>
                                    @else
                                        <i class="fa-solid fa-circle-check"></i>
                                    @endif
                                </a>
                            </td>
                            <td>
                                <img width="70" height="70" class="rounded" src="{{ $post->image }}" alt="">
                            </td>
                            <td>
                                <p class="{{ $post->is_checked == 1 ? 'text-decoration-line-through' : '' }}">
                                    {{ $post->description }}</p>
                            </td>
                            <td>
                                <div class="d-flex justify-content-end">
                                    {{-- <a class="btn" href="{{ route('posts.edit', $post->id) }}"><i
                                            class="fa-solid fa-pencil text-primary"></i></a> --}}

                                    {{-- EDIT --}}
                                    <div>
                                        <!-- Button trigger modal -->
                                        <a href="{{ route('posts.edit', $post->id) }}" class="btn" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal-{{ $post->id }}">
                                            <i class="fa-solid fa-pencil text-primary"></i>
                                        </a>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal-{{ $post->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel1" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('posts.update', $post->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="mb-3">
                                                                <label class="form-label">Descrivi</label>
                                                                <input type="text" name="description"
                                                                    value="{{ old('description', $post->description) }}"
                                                                    class="form-control" aria-describedby="emailHelp">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Immagine</label>
                                                                <input type="url"
                                                                    value="{{ old('image', $post->image) }}" name="image"
                                                                    class="form-control">
                                                            </div>

                                                            <button type="submit" class="btn btn-primary">Modifica</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    {{-- DELETE --}}
                                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn"><i
                                                class="fa-solid fa-trash text-muted"></i></button>
                                    </form>
                                </div>
                            </td>
                        @empty
                            <td>Non ci sono to do</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div>

                {{ $posts->links() }}

            </div>
        </div>


    </div>
@endsection
