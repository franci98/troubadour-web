<?php

namespace App\Http\Controllers\API\v3;

use App\Http\Controllers\Controller;
use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function store(Request $request)
    {
        $this->authorize('create', Game::class);
        $data = $request->validate([
            'difficulty_id' => 'required|exists:difficulties,id'
        ]);

    }
}
