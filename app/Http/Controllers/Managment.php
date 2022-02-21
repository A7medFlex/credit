<?php

namespace App\Http\Controllers;

use App\Models\aboutPage;
use App\Models\childrenModel;
use App\Models\diseasedPage;
use App\Models\FAQsPage;
use App\Models\homelessModel;
use App\Models\landingPage;
use App\Models\storiesPage;
use App\Models\User;
use Illuminate\Http\Request;

class Managment extends Controller
{
    public function index()
    {
        $allusers = User::latest()->get();
        $intro = landingPage::where('sec_title','like','intro')->first();
        $landing = landingPage::all();
        $diseased = diseasedPage::all();
        $homeless = homelessModel::all();
        $children = childrenModel::all();
        $stories = storiesPage::all();
        $FAQs = FAQsPage::all();
        $about = aboutPage::all();
        return view('adminManagment',
                        compact(
                            'allusers',
                            'intro',
                            'landing',
                            'diseased',
                            'homeless',
                            'children',
                            'stories',
                            'FAQs',
                            'about'
                        )
                     );
    }
    // manage landing page
    public function landing(Request $request)
    {
        if($request->has('intro_text')){
            $path = $request->image->store('public/landingPage');

            $landing = landingPage::create([
                'sec_title'=>'intro',
                'sec_text'=>$request->intro_text,
                'images'=>$path
            ]);
        }
        if($request->has('sec_title')){
            $path = $request->image->store('public/landingPage');

            $landing = landingPage::create([
                'sec_title'=>$request->sec_title,
                'sec_text'=>$request->sec_text,
                'images'=>$path
            ]);
        }
        return redirect()->back();
    }
    // manage diseased page
    public function diseased(Request $request)
    {
        if($request->has('sec_title')){
            $path = $request->image->store('public/diseasedPage');

            $diseased = diseasedPage::create([
                'sec_title'=>$request->sec_title,
                'sec_text'=>$request->sec_text,
                'images'=>$path
            ]);
        }
        return redirect()->back();
    }
    // manage homeless page
    public function homeless(Request $request)
    {
        if($request->has('sec_title')){
            $path = $request->image->store('public/homelessPage');

            $homeless = homelessModel::create([
                'sec_title'=>$request->sec_title,
                'sec_text'=>$request->sec_text,
                'images'=>$path
            ]);
        }
        return redirect()->back();
    }
    // manage children page
    public function children(Request $request)
    {
        if($request->has('sec_title')){
            $path = $request->image->store('public/childrenPage');

            $children = childrenModel::create([
                'sec_title'=>$request->sec_title,
                'sec_text'=>$request->sec_text,
                'images'=>$path
            ]);
        }
        return redirect()->back();
    }
    // manage stories page
    public function stories(Request $request)
    {
        if($request->has('sec_title')){
            $path = $request->image->store('public/storiesPage');

            $stories = storiesPage::create([
                'sec_title'=>$request->sec_title,
                'sec_text'=>$request->sec_text,
                'images'=>$path
            ]);
        }
        return redirect()->back();
    }
    // manage FAQs page
    public function FAQs(Request $request)
    {
        if($request->has('sec_title')){
            $path = $request->image->store('public/FAQsPage');

            $FAQs = FAQsPage::create([
                'sec_title'=>$request->sec_title,
                'sec_text'=>$request->sec_text,
                'images'=>$path
            ]);
        }
        return redirect()->back();
    }
    // manage about page
    public function about(Request $request)
    {
        if($request->has('sec_title')){
            $path = $request->image->store('public/aboutPage');

            $about = aboutPage::create([
                'sec_title'=>$request->sec_title,
                'sec_text'=>$request->sec_text,
                'images'=>$path
            ]);
        }
        return redirect()->back();
    }
    public function editIntro(Request $request)
    {
        if($request->has('intro_text')){
            $intro = landingPage::where('sec_title','like','intro')->first();
            $intro->update([
                'sec_title'=>'intro',
                'sec_text'=>$request->intro_text,
            ]);
            if($request->has('image')){
                $path = $request->image->store('public/landingPage');
                $intro->update([
                    'images' => $path,
                ]);
            }
        }
        return redirect()->back();

    }
    public function editLanding(Request $request, $id)
    {
        if($request->has('sec_title')){
            $landing = landingPage::where('id','like',$id)->first();
            $landing->update([
                'sec_title'=>$request->sec_title,
                'sec_text'=>$request->sec_text,
            ]);
            if($request->has('image')){
                $path = $request->image->store('public/landingPage');
                $landing->update([
                    'images' => $path,
                ]);
            }
        }
        return redirect()->back();
    }
    public function editDiseased(Request $request, $id)
    {
        $diseased = diseasedPage::where('id','like',$id)->first();
        $diseased->update([
            'sec_title'=>$request->sec_title,
            'sec_text'=>$request->sec_text,
        ]);
        if($request->has('image')){
            $path = $request->image->store('public/diseasedPage');
            $diseased->update([
                'images' => $path,
            ]);
        }
        return redirect()->back();
    }
    public function editHomeless(Request $request, $id)
    {
        $homeless = homelessModel::where('id','like',$id)->first();
        $homeless->update([
            'sec_title'=>$request->sec_title,
            'sec_text'=>$request->sec_text,
        ]);
        if($request->has('image')){
            $path = $request->image->store('public/homelessPage');
            $homeless->update([
                'images' => $path,
            ]);
        }
        return redirect()->back();
    }
    public function editChildren(Request $request, $id)
    {
        $children = childrenModel::where('id','like',$id)->first();
        $children->update([
            'sec_title'=>$request->sec_title,
            'sec_text'=>$request->sec_text,
        ]);
        if($request->has('image')){
            $path = $request->image->store('public/childrenPage');
            $children->update([
                'images' => $path,
            ]);
        }
        return redirect()->back();
    }
    public function editFAQs(Request $request, $id)
    {
        $FAQs = FAQsPage::where('id','like',$id)->first();
        $FAQs->update([
            'sec_title'=>$request->sec_title,
            'sec_text'=>$request->sec_text,
        ]);
        if($request->has('image')){
            $path = $request->image->store('public/FAQsPage');
            $FAQs->update([
                'images' => $path,
            ]);
        }
        return redirect()->back();
    }
    public function editStories(Request $request, $id)
    {
        $stories = storiesPage::where('id','like',$id)->first();
        $stories->update([
            'sec_title'=>$request->sec_title,
            'sec_text'=>$request->sec_text,
        ]);
        if($request->has('image')){
            $path = $request->image->store('public/storiesPage');
            $stories->update([
                'images' => $path,
            ]);
        }
        return redirect()->back();
    }
    public function editAbout(Request $request, $id)
    {
        $about = aboutPage::where('id','like',$id)->first();
        $about->update([
            'sec_title'=>$request->sec_title,
            'sec_text'=>$request->sec_text,
        ]);
        if($request->has('image')){
            $path = $request->image->store('public/aboutPage');
            $about->update([
                'images' => $path,
            ]);
        }
        return redirect()->back();
    }
}
