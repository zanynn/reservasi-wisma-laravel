<?php 
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Room;
use App\CategoryRoom;
class CategoryRoomController extends Controller
{
	public function getRoom()
	{
		$room=CategoryRoom::all();
		return view('admin.room_category.list',['category_room'=>$room]);
	}
	public function Edit($id)
	{
        //$categoryRoom=CategoryRoom::all();
		$room=CategoryRoom::find($id);
		return view('admin.room_category.edit',['category_room'=>$room]);
	}

	public function EditPost(Request $request,$id)
	{
		$this->validate($request,
        [
            
            'name'=>'required',
            'price'=>'required',
            'description'=>'required',
            
        ],
        [   
            
            'name.required'=>"Anda belum memasukkan nama tipe kamar",
            'price.required'=>"Anda belum memasukkan harga tipe kamar",
            'description.required'=>"Anda belum memasukkan deskripsi tipe kamar",
           
        ]);
        
        $room=CategoryRoom::find($id);
       // $room->link=$request->link;
        $room->name=$request->name;
        $room->price=$request->price;
        $room->description=$request->description;
        if ($request->image) $room->image="images/" . $request->image->getClientOriginalName();
      
       
    
        $room->save(); 


        return redirect('admin/category_room/list')->with('annoucement','Berhasil mengedit informasi kamar');
      
	}

    public function Add()
    {
        $categoryRoom=CategoryRoom::all();
        return view('admin.room_category.add',['categoryRoom'=>$categoryRoom]);
    }
    public function AddPost(Request $request)
    {
      $this->validate($request,
        [
            
            'name'=>'required',
            'price'=>'required',
            'description'=>'required',
            'image' => 'required'
            
        ],
        [   
            
            'name.required'=>"Anda belum memasukkan nama tipe kamar",
            'price.required'=>"Anda belum memasukkan harga tipe kamar",
            'description.required'=>"Anda belum memasukkan deskripsi tipe kamar",
            'image.required'=>"Anda belum mengimpor foto",
           
        ]);
        
        $room=new CategoryRoom;
       // $room->link=$request->link;
        $room->name=$request->name;
        $room->price=$request->price;
        $room->description=$request->description;
        $room->image="images/" . $request->image->getClientOriginalName();
      
       
    
        $room->save(); 


        return redirect('admin/category_room/list')->with('annoucement','berhasil menambahkan tipe kamar');
      
      
    }
    public function Delete($id)
    {
        $room=CategoryRoom::find($id);
        $room->delete();
        return redirect('admin/category_room/list')->with('annoucement','Berhasil menghapus tipe kamar');
     }

}
