<div class="comment mb-3" data-comment-id="{{ $comment->id }}">

    <div class="comment-header mb-2">
        <img src="{{ asset( $comment->profile == null ? 'MasterImage/profile.jpg' : 'ProfileImage/' . $comment->profile ) }}" alt="Image" class="img-fluid rounded-circle mr-3 mt-1"
            style="width: 45px;">
        <?php
            $name = Str::upper($comment->user->name)
        ?>
        <h6 class=" d-inline">{{ $name }} <small><i>{{ $comment->created_at->diffForHumans() }}</i></small></h6>

        @can('update', $comment)
        <button class="btn btn-sm btn-link edit-comment">Edit</button>
        @endcan

        @can('delete', $comment)
        <form class="d-inline" action="{{ route('user#comment#delete', $comment->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-link btn-delete text-danger">Delete</button>
        </form>
        @endcan
    </div>

    <div class="comment-content mb-2">
        {{ $comment->message }}
    </div>

    <button class="btn btn-sm btn-primary btn-link text-white reply-btn mb-3">Reply</button>
        <div class="reply-form" style="display: none;">
            <form action="{{ route('user#comment#reply', $comment) }}" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <input type="hidden" name="lesson_id" value="{{ $comment->lesson_id }}">
                <textarea name="message" class="form-control comment-content mb-2 @error('message') is-invalid @enderror " rows="2"></textarea>
                @error('message')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
                <button type="submit" class="btn btn-primary btn-sm mb-3">Post Reply</button>
            </form>
        </div>

    @if($comment->replies->count() > 0)
        <div class="replies ml-4">
            @foreach($comment->replies as $reply)
                @include('user.comment.comments', ['comment' => $reply])
            @endforeach
        </div>
    @endif
</div>

@section('js-content')

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Reply functionality
        document.querySelectorAll('.reply-btn').forEach(button => {
            button.addEventListener('click', () => {
                const form = button.nextElementSibling;
                form.style.display = form.style.display === 'none' ? 'block' : 'none';
            });
        });

        // Edit functionality
        document.querySelectorAll('.edit-comment').forEach(button => {
            button.addEventListener('click', () => {
                const comment = button.closest('.comment');
                const content = comment.querySelector('.comment-content');
                const originalText = content.textContent.trim();
                const parent = content.parentElement;
                const replyBtn = parent.querySelector('.reply-btn');

                const textarea = document.createElement('textarea');
                textarea.className = 'form-control mb-2';
                textarea.value = originalText;

                const saveButton = document.createElement('button');
                saveButton.className = 'btn btn-primary btn-sm';
                saveButton.textContent = 'Save';

                const cancelButton = document.createElement('button');
                cancelButton.className = 'btn btn-link btn-sm';
                cancelButton.textContent = 'Cancel';

                content.replaceWith(textarea);
                replyBtn.remove();
                parent.append(saveButton, cancelButton);
                // console.log(parent);

                saveButton.addEventListener('click', (e) => {
                    e.preventDefault();
                    const formData = new FormData();


                    formData.append('message', textarea.value);
                    formData.append('_method', 'PUT');

                    fetch(`/user/comment/update/${comment.dataset.commentId}`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        },
                        body: formData
                    }).then(() => window.location.reload())
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Failed to save comment');
                    });
                });

                cancelButton.addEventListener('click', (e) => {
                    e.preventDefault();
                    textarea.replaceWith(content);
                    saveButton.remove();
                    cancelButton.remove();
                });
            });
        });
    });
</script>

@if (Session::has('success'))
<script>
    toastr.options = {
                "progressBar": true,
                "closeButton": true,
            }
            toastr.success("{{ Session::get('success') }}", 'Success!', {
                timeout: 12000
            });
</script>

@endif

@if (Session::has('update'))
<script>
    toastr.options = {
                "progressBar": true,
                "closeButton": true,
            }
            toastr.info("{{ Session::get('update') }}", 'Success!', {
                timeout: 12000
            });
</script>

@endif

@if (Session::has('delete'))
<script>
    toastr.options = {
                "progressBar": true,
                "closeButton": true,
            }
            toastr.error("{{ Session::get('delete') }}", 'Success!', {
                timeout: 12000
            });
</script>

@endif

<script type="text/javascript">
    $(".btn-delete").click(function(e){
        e.preventDefault();
        var form = $(this).parents("form");

        Swal.fire({
          title: "Are you sure?",
          text: "You won't be able to revert this!",
          icon: "error",
          showCancelButton: true,
          confirmButtonColor: "#1D7647",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes, delete it!"
        }).then((result) => {
          if (result.isConfirmed) {
            form.submit();
          }
        });

    });
</script>

@endsection
