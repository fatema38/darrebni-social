<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends BaseController
{
    public function index(Request $request)
    {
        $search = $request->input('q');

        // البحث عن الوسوم في جدول tags
        $tags = Tag::query()
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', '%' . $search . '%' );
            })
            ->take(10)
            ->get(['id', 'name'])

            ->map(function ($tag) {
                return [
                    'id' => $tag->id,
                    'name' => $tag->name,
                    'source' => 'database'
                ];
            });

       if($tags)
        return $this->SendSuccessResponse($tags,'Main Tags');
       else
           return
           $this->SendErrorResponse('error Tags');
    }
}
