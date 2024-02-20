<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\View\View;
use App\Models\TravelPackage;
use App\Mail\StoreContactMail;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\StoreEmailRequest;
use App\Models\Category;
use App\Models\Coursel;
use App\Models\Car;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home() : View
    {
        $categories = Category::with('travel_packages')->get();
        $posts = Post::get();
        $carouselImages = Coursel::all();


        return view('home', compact('categories', 'posts', 'carouselImages'));
    }

    public function detail(TravelPackage $travelPackage): View
    {
        $cars = Car::all();
        return view('detail', compact('travelPackage','cars'));
    }

    public function package(){
        $travelPackages = TravelPackage::with('galleries')->get();

        return view('package', compact('travelPackages'));
    }

    public function posts(){
        $posts = Post::get();

        return view('posts', compact('posts'));
    }

    public function detailPost(Post $post){
        return view('posts-detail',compact('post'));
    }

    public function contact(){
        return view('contact');
    }

    public function getEmail(StoreEmailRequest $request){
        $detail = [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message
        ];

        Mail::to('azizabdulaziz70932@gmail.com')->send(new StoreContactMail($detail));
        return back()->with('message', 'Terimakasih atas feedbacknya ! kami akan membacanya sesegera mungkin');
    }

    public function invoice($id, Request $request)
    {
        $travelPackage = TravelPackage::findOrFail($id);

        // Check if 'car' input exists
        if ($request->has('car')) {
            // Validate that 'car' input exists in the 'cars' table
            $request->validate([
                'car' => 'exists:cars,id'
            ]);

            // Retrieve the car ID from the request
            $carId = $request->input('car');

            // Fetch the car details based on the provided car ID
            $car = Car::findOrFail($carId);
        } else {
            // If 'car' input is not provided, set $car to null or any default value
            $car = null;
        }

        // Retrieve other values from the request
        $name = $request->input('name');
        $address = $request->input('address');
        $email = $request->input('email');
        $phone = $request->input('phone');

        // Pass the fetched car details and other values to the view
        return view('invoice', compact('travelPackage', 'id', 'name', 'address', 'email', 'phone', 'car'));
    }


}
