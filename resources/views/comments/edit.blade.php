@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit User {!! $comment->user->name !!}'s Comment</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('comments.update', $comment) }}">
                        @csrf
                        {{ method_field('PUT') }}

                        <div class="form-group row">
                            <textarea class="form-control" name="comment">{!! $comment->comment !!}</textarea>
                        </div>

                        <div class="form-group row">
                            <button type="submit" class="btn btn-primary">Edit</button>
                            <a href="{{ Route('comments.index') }}"><button type="button" class="btn btn-danger">Cancel</button></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
