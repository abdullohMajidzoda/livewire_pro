<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\User\UserList;
use App\Livewire\User\UserCreate;

// Route::get('/', function () {
//     return view('welcome');
// })->name('home');

Route::get('/', UserList::class)->name('home');
Route::get('/user-create', UserCreate::class)->name('user-create');
