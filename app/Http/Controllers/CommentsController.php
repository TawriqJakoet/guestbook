<?php

namespace App\Http\Controllers;

use App\Comment;
use Auth;
use Gate;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    protected $redirectTo = '/comments';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'comment' => ['required'],
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('comments.index')->with('comments', Comment::where('reply_to_comment_id', null)->orderBy('created_at', 'desc')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('comments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Comment::create([
            'user_id' => Auth::user()->id,
            'comment' => $request['comment'],
            // 'reply_to_comment_id' => $request['reply_to_comment_id'],
        ]);

        return redirect()->route('comments.index')->with('success','Comment added successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        return view('comments.edit')->with([
            'comment' => $comment,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        if (Gate::allows('update-comment', $comment)) {
            $comment->comment = $request['comment'];
            $comment->save();

            return redirect()->route('comments.index')->with('success','Comment updated successfully!');
        }

        return redirect()->route('comments.index')->with('error','Error, please try again.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        if (Gate::allows('delete-comment', $comment)) {
            $comment->delete();

            return redirect()->route('comments.index')->with('success','Comment deleted successfully!');
        }

        return redirect()->route('comments.index')->with('error','Error, please try again.');
    }

    /**
     * Show the form for adding the reply.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function reply(Comment $comment)
    {
        return view('comments.reply')->with([
            'comment' => $comment,
        ]);
    }

    /**
     * Store the reply in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function storeReply(Request $request, Comment $comment)
    {
        if (Gate::allows('admin-user', $comment)) {
            Comment::create([
                'user_id' => Auth::user()->id,
                'comment' => $request['comment'],
                'reply_to_comment_id' => $comment->id,
            ]);
        
            return redirect()->route('comments.index')->with('success','Reply added successfully!');
        }

        return redirect()->route('comments.index')->with('error','Error, please try again.');
    }
}
