<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReportRequest;
use Illuminate\Http\Request;

class ReportController extends BaseController
{
    public function store(ReportRequest $request){
        $validated = $request->validated();
        $user=auth()->user();
        $user->postsreports()->syncWithoutDetaching([
            $validated['post_id']=>['note'=>$validated['note']]
        ]);
   return $this->SendSuccessResponse($validated['note'],'report  is stored');
    }
}
