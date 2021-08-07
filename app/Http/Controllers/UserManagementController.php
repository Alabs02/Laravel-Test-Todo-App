<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserManagementController extends Controller
{
    public function showUserDashboard()
    {
        // dd($this->getTodos());
        return view('index', [
            'title' => 'User Dashboard',
            'todos' => $this->getTodos(),
            'user' => $this->getUser()
        ]);
    }

    private static function getUser()
    {
        return Auth::user();
    }

    private static function getTodos()
    {
        return Todo::where([
            ['user_id', Auth::id()],
            ['is_completed', false]
        ])->paginate(5);
    }

}
