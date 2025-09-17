<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryItemsQuery;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ItemResource;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        return CategoryResource::collection(Category::query()->orderBy('name')->get());
    }

    public function items(CategoryItemsQuery $request, string $slug)
    {
        $category = Category::where('slug', $slug)->first();
        if (!$category) {
            return response()->json(['status'=>'error','message'=>'Category not found'], 404);
        }

        $data = $request->validated();
        $perPage = $data['per_page'] ?? 10;
        $query = $category->items()->with('category');

        if (!empty($data['q'])) {
            $query->where('name', 'like', '%' . $data['q'] . '%');
        }
        if (isset($data['min_price'])) {
            $query->where('price', '>=', $data['min_price']);
        }
        if (isset($data['max_price'])) {
            $query->where('price', '<=', $data['max_price']);
        }

        $sortMap = [
            'price_asc' => ['price','asc'],
            'price_desc'=> ['price','desc'],
            'name_asc'  => ['name','asc'],
            'name_desc' => ['name','desc'],
        ];
        if (!empty($data['sort'])) {
            $query->orderBy($sortMap[$data['sort']][0], $sortMap[$data['sort']][1]);
        } else {
            $query->orderBy('id','desc');
        }

        $paginated = $query->paginate($perPage)->withQueryString();

        return ItemResource::collection($paginated);
    }
}
