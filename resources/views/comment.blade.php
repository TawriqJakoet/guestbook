<div class="row @if($style == 'reply') justify-content-end @endif">
    <div class="mb-2 pb-2 rounded @if($style == 'comment') col-sm @elseif($style == 'reply') col-sm-10 bg-secondary text-white @endif">
        <small class="@if($style == 'comment') text-muted @endif"><i>{{ ucfirst($style) }} by {{ $comment->user->name }} on {{ \Carbon\Carbon::parse($comment->created_at)->format('F jS, Y - g:i a') }}</i></small>
        <p>{!! nl2br(e($comment->comment)) !!}</p>
        <p>
        @if($style == 'comment')
            @can('admin-user')
                <a href="{{ route('comments.reply', $comment->id) }}"><button type="button" class="btn btn-success float-left mr-1">Reply</button></a>
            @endcan
        @endif
        @can('update-comment', $comment)
            <a href="{{ route('comments.edit', $comment->id) }}"><button type="button" class="btn btn-primary float-left mr-1">Edit</button></a>
        @endcan
        @can('delete-comment', $comment)
            <form method="POST" action="{{ route('comments.destroy', $comment->id) }}" class="float-left mr-1">
                @csrf
                {{ method_field('DELETE') }}
                <button type="submit" class="btn btn-danger float-left" onclick="if (!confirm('Are you sure you want to delete {{ $comment->user->name }}\'s comment ?')) { return false }">Delete</button>
            </form>
        @endcan
        </p>
    </div>
</div>

