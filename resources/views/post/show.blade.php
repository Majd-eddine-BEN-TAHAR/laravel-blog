@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <!-- Post Title -->
                <h1 class="fw-bolder mb-4">{{ $post->title }}</h1>

                <!-- Featured Image -->
                @if ($post->featured_image)
                    <div class="text-center mb-4">
                        <img src="{{ Storage::url($post->featured_image) }}" class="img-fluid rounded"
                            alt="{{ $post->title }}" style="max-height: 400px; object-fit: cover;">
                    </div>
                @endif

                <!-- Post Content -->
                <article>
                    <div class="mb-4 text-muted">
                        <small>Published on {{ $post->published_at->format('F d, Y') }}</small>
                    </div>
                    <div class="post-content">
                        {!! $post->content !!}
                    </div>
                </article>

                <!-- Display total likes -->
                <div>
                    <span>Total Likes: {{ $post->totalLikes() }}</span>
                </div>

                <!-- Like/Unlike button -->
                @if (auth()->check())
                    @if (!$post->likes->contains('user_id', auth()->id()))
                        <form action="{{ route('like.store', $post->id) }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-outline-primary">Like</button>
                        </form>
                    @else
                        <form action="{{ route('like.destroy', $post->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-primary">Unlike</button>
                        </form>
                    @endif
                @endif

                <!-- Comments Section -->
                <div class="card mt-5">
                    <div class="card-body">
                        <h2 class="card-title">Comments</h2>
                        <!-- Display existing comments -->
                        @forelse ($post->comments as $comment)
                            <div class="border-bottom mb-3 pb-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>{{ $comment->user->name }}</strong>
                                        <span class="text-muted">{{ $comment->created_at->diffForHumans() }}</span>
                                    </div>
                                    @if (auth()->check() && auth()->id() === $comment->user_id)
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-primary me-2"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editCommentModal{{ $comment->id }}">Edit</button>
                                            <form action="{{ route('comment.destroy', $comment->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                                <p class="mt-2">{{ $comment->content }}</p>
                            </div>

                            <!-- Edit Comment Modal -->
                            <div class="modal fade" id="editCommentModal{{ $comment->id }}" tabindex="-1"
                                aria-labelledby="editCommentModalLabel{{ $comment->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('comment.update', $comment->id) }}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editCommentModalLabel{{ $comment->id }}">Edit
                                                    Comment</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <textarea name="content" rows="3" class="form-control" placeholder="Edit your comment">{{ $comment->content }}</textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p>No comments yet.</p>
                        @endforelse

                        <!-- Comment Form -->
                        @auth
                            <form action="{{ route('comment.store', $post->id) }}" method="post" class="mt-4">
                                @csrf
                                <div class="mb-3">
                                    <textarea name="content" rows="3" class="form-control" placeholder="Add your comment"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Add Comment</button>
                            </form>
                        @else
                            <p class="mt-4">Please <a href="{{ route('login') }}">login</a> to add comments.</p>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
