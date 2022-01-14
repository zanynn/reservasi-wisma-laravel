<?php 
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Slide;
class SlideController extends Controller
{
	public function getSlide()
	{
		$slide=Slide::all();
		return view('admin.slide.list',['slide'=>$slide]);
	}
	public function Edit($id)
	{
		$slide=Slide::find($id);
		return view('admin.slide.edit',['slide'=>$slide]);
	}
	public function EditPost(Request $request,$id)
	{
		$this->validate($request,
        [
            
            'caption'=>'required',
            
        ],
        [   
            
            'caption.required'=>"Anda belum memasukkan keterangan gambar",
           
        ]);
        
        $slide=Slide::find($id);
       // $slide->link=$request->link;
        $slide->caption=$request->caption;
        $slide->link="images/" . $request->image->getClientOriginalName();
       
    
        $slide->save(); 


        return redirect('admin/slide/list')->with('annoucement','Informasi slide berhasil diedit');
      
	}

    public function Add()
    {
        return view('admin.slide.add');
    }
    public function AddPost(Request $request)
    {
       $this->validate($request,
        [
            'link'=>'required',
            'caption'=>'required',
            
        ],
        [   
            'link.required'=>"Anda belum memasukkan tautan gambar",
            'caption.required'=>"Anda belum memasukkan keterangan gambar",
           
        ]);
        
        $slide=new Slide;
        $slide->link=$request->link;
        $slide->caption=$request->caption;
      
       
    
        $slide->save(); 


        return redirect('admin/slide/list')->with('annoucement','Berhasil menambahkan slide');
      
    }
    public function Delete($id)
    {
        $slide=Slide::find($id);
        $slide->delete();
        return redirect('admin/slide/list')->with('annoucement','Hapus slide dengan sukses');
     }

}
