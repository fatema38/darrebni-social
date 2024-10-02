<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
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
//
//        // البحث عن الوسوم في حقل tags في جدول posts
//        $postTags = Post::query()
//            ->when($search, function ($query, $search) {
//                return $query->whereRaw('JSON_CONTAINS(tags, \'["' . $search . '"]\')');
//            })
//            ->take(10)
//            ->get(['tags'])
//            ->pluck('tags')
//            ->flatten()
//            ->unique()
//            ->map(function ($tag) {
//                return [
//                    'id' => null,
//                    'name' => $tag,
//                    'source' => 'json'
//                ];
//            });
//
//        // دمج النتائج وإزالة التكرارات
//        $allTags = $tags->merge($postTags)->unique('name');

        return response()->json($tags);
    }

    public function repeat(){

        $posts = Post::all();

        // استخراج جميع التاغات من الحقل JSON
        $tags = [];
        foreach ($posts as $post) {
            $jsonTags = $post->tags;
            if (is_array($jsonTags)) {
                $tags = array_merge($tags, $jsonTags);
            }
        }

        // حساب التكرارات
        $duplicateTags = array_count_values($tags);
        $duplicateTags = array_filter($duplicateTags, function ($count) {
            return $count > 1;
        });

        return view('Pages.tags.duplicates', compact('duplicateTags'));
    }
    public function store($name)
    {    // إنشاء العلامة والحصول على معرّفها مباشرة
        $tag = Tag::create(['name' => $name]);
        $tagId = $tag->id;

        // جلب المنشورات التي تحتوي على العلامة المحددة
        $posts = Post::whereRaw('JSON_CONTAINS(tags, \'["' . $name . '"]\')')->get();

        foreach ($posts as $post) {
            // إرفاق العلامة إذا لم تكن مرفقة مسبقًا

                $post->tags()->attach($tagId);


            // فك ترميز JSON إلى مصفوفة PHP
            $tags = $post->tags;

            // إزالة جميع التكرارات للقيمة المحددة
            $filteredTags = array_filter($tags, function ($tag) use ($name) {
                return $tag !== $name;
            });

            // إعادة فهرسة وتحويل المصفوفة إلى JSON
            $post->tags = array_values($filteredTags);

            // حفظ التغييرات في قاعدة البيانات
            $post->save();
        }
 return redirect()->back();
    }




}
