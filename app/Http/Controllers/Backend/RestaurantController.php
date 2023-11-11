<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\MenuCategory;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function AllMenuCategory() {
        $categories = MenuCategory::latest()->get();
        return view('backend.restaurant.menu.all_menu_category', compact('categories'));
    }

    public function StoreMenuCategory(Request $request) {
        MenuCategory::insert([
            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
        ]);

        $notification = [
            'message' => 'Menu Category Inserted Successfully!',
            'alert-type' => 'success', 
        ];

        return redirect()->back()->with($notification);
    }

    public function EditMenuCategory($id) {
        $category = MenuCategory::find($id);
        return response()->json($category);
    }

    public function UpdateMenuCategory(Request $request) {
        $category = MenuCategory::find($request->cat_id);
        $category->update([
            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
        ]);

        $notification = [
            'message' => 'Menu Category Updated Successfully!',
            'alert-type' => 'success', 
        ];

        return redirect()->back()->with($notification);
    }

    public function DeleteMenuCategory($id) {
        MenuCategory::find($id)->delete();
        $notification = [
            'message' => 'Menu Category Deleted Successfully!',
            'alert-type' => 'success', 
        ];

        return redirect()->back()->with($notification);
    }
}
