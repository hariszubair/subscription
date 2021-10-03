<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailJob;
use App\Mail\SendMail;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Models\UserSubscription;
use App\Models\Website;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function subscribe()
    {
        $websites = Website::all();
        return view('subscribe', compact('websites'));
    }
    public function subscribe_user(Request $request)
    {
        return 1;
        $count = UserSubscription::where('website_id', $request->website)->where('user_id', Auth::id())->count();
        if ($count == 0) {
            UserSubscription::create([
                'user_id' => Auth::id(),
                'website_id' => $request->website
            ]);
            return back()->with('status', 'Website is successfully subscribed.');
        } else {
            return back()->with('status', 'Website is already subscribed.');
        }
    }
    public function publish_post()
    {
        $websites = Website::all();
        return view('publish_post', compact('websites'));
    }
    public function submit_post(Request $request)
    {

        try {
            $post = Post::create([
                'title' => $request->title,
                'description' => $request->description,
                'user_id' => Auth::id()
            ]);

            $website = Website::find($request->website);
            $user = UserSubscription::where('website_id', $request->website)->with('user')->get(['user_id']);
            $details['title'] = $request->title;
            $details['description'] = $request->description;
            $details['website'] = $website->name;
            $details['post_id'] = $post->id;


            foreach ($user as $user) {
                $details['user_name'] = $user->user->name;
                $details['user_id'] = $user->user->id;
                $details['email'] = $user->user->email;
                dispatch(new SendEmailJob($details));
            }
            return back()->with('status', 'Post added successfully.');
        } catch (\Throwable $th) {
            return $th;
            return back()->with('status', 'Somethig went wrong');
        }
    }
}
