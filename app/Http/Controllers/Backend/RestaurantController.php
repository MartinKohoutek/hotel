<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\MenuCategory;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

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

    public function AllMenuItems() {
        $items = MenuItem::latest()->get();
        return view('backend.restaurant.menu.all_items', compact('items'));
    }
    
    public function AddMenuItem() {
        $categories = MenuCategory::orderBy('category_name')->get();
        return view('backend.restaurant.menu.add_item', compact('categories'));
    }

    public function StoreMenuItem(Request $request) {
        $menuItem = New MenuItem();
        if ($request->file('image')) {
            $img = $request->file('image');
            $imgName = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
            Image::make($img)->resize(400, 400)->save('upload/menu/'.$imgName);
            $menuItem->image = 'upload/menu/'.$imgName;
        }

        $menuItem['title'] = $request->title;
        $menuItem['category_id'] = $request->category_id;
        $menuItem['ingredients'] = $request->ingredients;
        $menuItem['price'] = $request->price;
        $menuItem->save();

        $notification = [
            'message' => 'Menu Item Inserted Successfully!',
            'alert-type' => 'success', 
        ];

        return redirect()->route('all.menu.items')->with($notification);
    }

    public function EditMenuItem($id) {
        $menuItem = MenuItem::find($id);
        $categories = MenuCategory::orderBy('category_name')->get();
        return view('backend.restaurant.menu.edit_item', compact('menuItem', 'categories'));
    }

    public function UpdateMenuItem(Request $request, $id) {
        $menuItem = MenuItem::find($id);
        if ($request->file('image')) {
            $img = $request->file('image');
            unlink($menuItem->image);
            $imgName = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
            Image::make($img)->resize(400, 400)->save('upload/menu/'.$imgName);
            $menuItem->image = 'upload/menu/'.$imgName;
        }

        $menuItem['title'] = $request->title;
        $menuItem['category_id'] = $request->category_id;
        $menuItem['ingredients'] = $request->ingredients;
        $menuItem['price'] = $request->price;
        $menuItem->save();

        $notification = [
            'message' => 'Menu Item Updated Successfully!',
            'alert-type' => 'success', 
        ];

        return redirect()->route('all.menu.items')->with($notification);
    }

    public function DeleteMenuItem($id) {
        $menuItem = MenuItem::find($id);
        if (!is_null($menuItem->image)) {
            unlink($menuItem->image);
        }
        $menuItem->delete();

        $notification = [
            'message' => 'Menu Item Deleted Successfully!',
            'alert-type' => 'success', 
        ];

        return redirect()->back()->with($notification);
    }

    public function ShowRestaurant() {
        $items = MenuItem::latest()->get();
        $categories = MenuCategory::orderBy('category_name')->get();
        return view('frontend.restaurant.restaurant', compact('items', 'categories'));
    }
}
