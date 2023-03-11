<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Workspace;


class WorkspaceController extends Controller
{

    public function create(Request $request)
    {
       $data =  $request->validate([
            'name' => 'required',
        ]);

        $workspace = new Workspace($data);
        $workspace->associate(auth()->user());
        $workspace->save();


    }
}
