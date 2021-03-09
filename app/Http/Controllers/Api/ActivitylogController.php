<?php

namespace App\Http\Controllers\Api;

use App\Models\Local\Activitylog;
use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
use App\Http\Resources\Activitylog as ActivitylogResource;

class ActivitylogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize("admin.logviewer");
        $activitylog = Activitylog::orderBy('created_at', 'desc')
            ->with('user')
            ->get();

        return ActivitylogResource::collection($activitylog);
    }
}
