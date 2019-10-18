@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add Comment</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('comments.store') }}">
                        @csrf

                        <div class="form-group row">
                            <textarea class="form-control" name="comment"></textarea>
                        </div>

                        <div class="form-group row">
                            <button type="submit" class="btn btn-primary">Add Comment</button>
                            <a href="{{ Route('comments.index') }}"><button type="button" class="btn btn-danger">Cancel</button></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
