<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Map;
use App\Models\Playlist;
use App\Models\Suggestion;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $userCount = User::count();
        $mapCount = Map::count();
        $playlistCount = Playlist::count();
        $suggestionCount = Suggestion::count();
        return view('admin.dashboard', compact('userCount', 'mapCount', 'playlistCount', 'suggestionCount'));
    }
}
