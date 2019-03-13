<?php namespace App\Interfaces;

interface CrudInterface
{
    public function index();
    public function get();
    public function store();
    public function update();
    public function destroy();
}
