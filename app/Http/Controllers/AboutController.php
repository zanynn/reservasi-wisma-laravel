<?php 
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\About;
class AboutController extends Controller
{
	public function getAbout()
	{
		$about=About::all();
		return view('admin.about.list',['about'=>$about]);
	}
	public function edit()
	{
		$about=About::find(1);
		return view('admin.about.edit',['about'=>$about]);
	}
	public function editPost(Request $request)
	{
		 $this->validate($request,
        [
            'body'=>'required',
            'image'=>'required',
            'video'=>'required',
            
        ],
        [
            'body.required'=>"Anda tidak memasukkan konten",
            'image.required'=>"Anda belum mengimpor gambar",
            'video.required'=>"Anda belum mengimpor video",
            
           

        ]);
        
        $about=About::find(1);
        $about->body=$request->body;
        $about->image="images/" . $request->image->getClientOriginalName();
        $about->video=$request->video;
    
        $about->save(); 


        return redirect('admin/about/list')->with('annoucement','Edit informasi hotel berhasil');
      
	}
}
