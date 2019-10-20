@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Guestbook Comments</div>

                <div class="card-body">
                    @foreach($comments as $comment)
                        @component('comment', [
                            'style' => 'comment',
                            'comment' => $comment,
                        ])@endcomponent

                        @foreach($comment->replies as $reply)
                            @component('comment', [
                                'style' => 'reply',
                                'comment' => $reply
                            ])@endcomponent
                        @endforeach
                    @endforeach
                    
                    <div class="row">
                        <div class="col-sm">
                            <a href="{{ route('comments.create') }}"><button type="button" class="btn btn-primary float-right">Add Comment</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
