<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AgentController extends Controller
{
    public function AgentIndex(Request $request) : View
    {
        return view('agent.index');
    }
}
