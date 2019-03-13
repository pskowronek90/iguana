<?php namespace App\Http\Controllers\User;


use App\Http\Controllers\Controller;
use App\Interfaces\CrudInterface;

class CommentController extends Controller implements CrudInterface
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //
    }

    public function get()
    {
        //
    }

    public function store()
    {

    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}
