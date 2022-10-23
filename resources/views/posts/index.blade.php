@extends('home')

@section('contain')
   <div class="row">
        <div class="col-12 offset-md-3 col-md-6 mt-3 mb-1 d-flex justify-content-center align-items-center">
            

            {{-- CREATE --}}
            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="fa-solid fa-plus"></i>  Aggiungi To-Do
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
                            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Scrivi To-Do</label>
                                    <input type="text" name="description" class="form-control"
                                        aria-describedby="emailHelp">
                                </div>
                                <div class="mb-3">
                                    <label for="formFileSm" class="form-label">Small file input example</label>
                                    <input class="form-control form-control-sm" name="image" id="formFileSm"
                                        type="file">
                                </div>

                                <button type="submit" class="btn btn-secondary">Crea</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('includes.filter_menu')
        <div class="col-12 offset-md-3 col-md-6">
            <div class="my-1">
                <a class="btn btn-sm btn-outline-secondary {{ Request::route('selectAll') ? 'active' : '' }}"
                    href="{{ route('selectAll') }}"><i class="fa-solid fa-circle-check me-1"></i> Seleziona tutti</a>
                <a class="btn btn-sm btn-outline-secondary" href="{{ route('deselectAll') }}"><i
                        class="fa-regular fa-circle-check me-1"></i> Deseleziona tutti</a>
            </div>
            <table class="table bg-light rounded shadow mt-4">
                <tbody>
                    @forelse ($posts as $post)
                        <tr>
                            <td class="d-flex justify-content-center align-items-center">
                                <a href="{{ route('checkTodo', $post->id) }}">
                                    @if ($post->is_checked == 0)
                                        <i class="fa-regular fa-circle-check text-secondary"></i>
                                    @else
                                        <i class="fa-solid fa-circle-check text-secondary"></i>
                                    @endif
                                </a>
                            </td>
                            <td>
                                @if (!$post->img_path)
                                    <img class="rounded border"
                                        src="https://wopart.eu/wp-content/uploads/2021/10/placeholder-7.png" alt="no-image"
                                        width="80">
                                @else
                                    <img class="rounded border" src="{{ asset('storage') . '/' . $post->img_name }}"
                                        alt="{{ $post->description }}" width="80">
                                @endif
                              
                            </td>
                            <td>
                                <p class="{{ $post->is_checked == 1 ? 'text-decoration-line-through' : '' }}">
                                    {{ $post->description }}</p>
                            </td>
                            <td>
                                <div class="d-flex justify-content-end">
                                    {{-- EDIT --}}
                                    <div>
                                        <!-- Button trigger modal -->
                                        <a href="{{ route('posts.edit', $post->id) }}" class="btn" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal-{{ $post->id }}">
                                            <i class="fa-solid fa-pencil text-secondary"></i>
                                        </a>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal-{{ $post->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel1-{{ $post->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel-{{ $post->id }}">Modifica il to-do</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form
                                                            action="{{ route('posts.update', $post->id) }}" enctype="multipart/form-data"
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
                                                                <label for="formFileSm" class="form-label">Small file input
                                                                    example</label>
                                                                <input class="form-control form-control-sm" name="image"
                                                                    id="formFileSm-{{ $post->id }}" type="file">
                                                            </div>
                                                            <button type="submit" class="btn btn-primary">Modifica</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    {{-- DELETE --}}
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal2-{{ $post->id }}">
                                        <i class="fa-solid fa-trash text-danger"></i>
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal2-{{ $post->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel2-{{ $post->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel2">Sei sicuro di
                                                        eliminare questo to-do?</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('posts.destroy', $post->id) }}"
                                                        method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <div>
                                                            <button type="submit" class="btn btn-danger">Elimina
                                                                definitivamente</button>
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Annulla</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
