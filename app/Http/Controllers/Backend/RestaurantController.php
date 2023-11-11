<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\MenuCategory;
use App\Models\MenuItem;
use App\Models\RestaurantBanner;
use App\Models\RestaurantCarousel;
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
        $carousel = RestaurantCarousel::latest()->get();
        return view('frontend.restaurant.restaurant', compact('items', 'categories', 'carousel'));
    }

    public function AllMenuBanner() {
        $banners = RestaurantBanner::latest()->get();
        $categories = MenuCategory::latest()->get();
        return view('backend.restaurant.banner.all_banner', compact('banners', 'categories'));
    }

    public function AddMenuBanner() {
        $categories = MenuCategory::orderBy('category_name')->get();
        return view('backend.restaurant.banner.add_banner', compact('categories'));
    }

    public function StoreMenuBanner(Request $request) {
        if (RestaurantBanner::where('category_id', $request->category_id)->first()) {
            $notification = [
                'message' => 'Banner for this category already exists, try different category!',
                'alert-type' => 'error', 
            ];
    
            return redirect()->back()->with($notification);
        }

        $banner = new RestaurantBanner();
        
        if ($request->file('banner')) {
            $img = $request->file('banner');
            $imgName = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
            Image::make($img)->resize(200, 200)->save('upload/restaurant/banner/'.$imgName);
            $banner->banner = 'upload/restaurant/banner/'.$imgName;
        }

        if ($request->file('background')) {
            $img = $request->file('background');
            $imgName = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
            Image::make($img)->resize(1200, 600)->save('upload/restaurant/background/'.$imgName);
            $banner->background = 'upload/restaurant/background/'.$imgName;
        }

        $banner['offer'] = $request->offer;
        $banner['title'] = $request->title;
        $banner['short_description'] = $request->short_description;
        $banner['long_description'] = $request->long_description;
        $banner['category_id'] = $request->category_id;
        $banner->save();

        $notification = [
            'message' => 'Banner Inserted Successfully!',
            'alert-type' => 'success', 
        ];

        return redirect()->route('all.menu.banner')->with($notification);
    }

    public function EditMenuBanner($id) {
        $banner = RestaurantBanner::find($id);
        $categories = MenuCategory::orderBy('category_name')->get();
        return view('backend.restaurant.banner.edit_banner', compact('banner', 'categories'));
    }

    public function UpdateMenuBanner(Request $request, $id) {
        $banner = RestaurantBanner::find($id);
        
        if ($request->file('banner')) {
            $img = $request->file('banner');
            unlink($banner->banner);
            $imgName = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
            Image::make($img)->resize(200, 200)->save('upload/restaurant/banner/'.$imgName);
            $banner->banner = 'upload/restaurant/banner/'.$imgName;
        }

        if ($request->file('background')) {
            $img = $request->file('background');
            unlink($banner->background);
            $imgName = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
            Image::make($img)->resize(1200, 600)->save('upload/restaurant/background/'.$imgName);
            $banner->background = 'upload/restaurant/background/'.$imgName;
        }

        $banner['offer'] = $request->offer;
        $banner['title'] = $request->title;
        $banner['short_description'] = $request->short_description;
        $banner['long_description'] = $request->long_description;
        $banner->update();

        $notification = [
            'message' => 'Banner Updated Successfully!',
            'alert-type' => 'success', 
        ];

        return redirect()->route('all.menu.banner')->with($notification);
    }

    public function DeleteMenuBanner($id) {
        $banner = RestaurantBanner::find($id);
        if (!is_null($banner->banner)) {
            unlink($banner->banner);
        }
        if (!is_null($banner->background)) {
            unlink($banner->background);
        }
        $banner->delete();

        $notification = [
            'message' => 'Banner Deleted Successfully!',
            'alert-type' => 'success', 
        ];

        return redirect()->back()->with($notification);
    }

    public function AllMenuCarousel() {
        $carousel = RestaurantCarousel::latest()->get();
        return view('backend.restaurant.carousel.all_carousel', compact('carousel'));
    }

    public function AddMenuCarousel() {
        return view('backend.restaurant.carousel.add_carousel');
    }

    public function StoreMenuCarousel(Request $request) {
        $img = $request->file('image');
        $imgName = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
        Image::make($img)->resize(1600, 1000)->save('upload/restaurant/carousel/'.$imgName);

        RestaurantCarousel::insert([
            'title' => $request->title,
            'small_title' => $request->short_title,
            'image' => 'upload/restaurant/carousel/'.$imgName,
        ]);

        $notification = [
            'message' => 'Carousel Item Inserted Successfully!',
            'alert-type' => 'success', 
        ];

        return redirect()->route('all.menu.carousel')->with($notification);
    }
}
