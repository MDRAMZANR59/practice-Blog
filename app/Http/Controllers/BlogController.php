<?php
namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;

class BlogController extends Controller
{
    /**
     * Display a listing of the blog posts.
     *
     * @return \Illuminate\Http\Response
     */

    //for user Validation
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = DB::table('blogs')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('image', function ($row) {
                    $url = asset($row->image);
                    return "<img src='$url' width='100'>";
                })
                ->addColumn('action', function ($row) {
                    $edit   = '<a href="' . route('editBlog', $row->id) . '" class="edit d-inline btn btn-primary btn-sm">Edit</a>';
                    $delete = '<a href="' . route('deleteBlog', $row->id) . '"class="delete d-inline btn btn-danger btn-sm">Delete</a>';
                    return $edit . '' . $delete;
                })

            // ->addColumn('df',function($row){})

                ->rawColumns(['image', 'action'])
                ->make(true);
        }
        Log::info("this user is", [Auth::id()]);
        return view('backend.layout.home');
    }
    //blog form
    public function create()
    {
        return view('backend.layout.addblog');
    }
    //store Blog
    public function store(Request $request)
    {
        $validation = $request->validate([
            'title'       => 'required|unique:blogs',
            'description' => 'required',
            'image'       => 'nullable|image|mimes:jpeg,jpg,png,gif|max:10240',
        ]);

        // $images = null;
        if ($request->image) {
            $images = 'images/' . time() . '.' . $request->image->extension();
            $images=Image::make($images)->resize(300, 300);
            $request->image->save(public_path('images'), $images);
            $fimage = $images;
        }

        $data = [
            'title'       => $request->title,
            'description' => $request->description,
            'image'       => $fimage,
        ];
        DB::table('blogs')->insert($data);
        return redirect()->route('admin')->with('success', 'Data Save Successfull');

    }
    //edit Blog
    public function edit($id)
    {
        $data = DB::table('blogs')->find($id);
        // return view('backend.layout.editBlog', ['olddatas' => $data]);
        return view('backend.layout.editBlog', compact('data'));
    }
    //update Blog
    public function update(Request $request, $id)
    {
        $validation = $request->validate([
            'title'       => 'required',
            'description' => 'required',
            'image'       => 'nullable|image|mimes:jpeg,jpg,png,gif|max:10240',
        ]);

        $model = DB::table('blogs')->where('id', $id)->first();
        if ($request->hasFile('image')) {
            if ($model->image && file_exists(public_path($model->image))) {
                unlink(public_path($model->image));
            }

            $newImage = 'images/' . time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $newImage);
            $image = $newImage;
        } else {
            $image = null;
        }
        $data = [
            'title'       => $request->title,
            'description' => $request->description,
            'image'       => $image,
        ];

        DB::table('blogs')->where('id', $id)->update($data);

        return redirect()->route('admin')->with('update', 'Data Updated Successfully');

    }
    //delete blog
    public function distroy($id)
    {
        // try {
        $model = DB::table('blogs')->where('id', $id)->first();
        if ($model->image) {
            $imagePath = public_path($model->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            } else {
                \Log::error('Image file not found: ' . $imagePath);
            }
        }

        DB::table('blogs')->where('id', $id)->delete();

        return redirect()->route('admin')->with('delete', 'Data Deleted Successfully');
        // } catch (\Exception $e) {
        //     \Log::error('Error deleting blog: ' . $e->getMessage());
        //     return redirect()->route('admin')->with('error', 'Failed to delete the blog');
        // }
    }

    //Change Pass
    // public function resetForm()
    // {
    //     return view('backend.layout.resetPass');
    // }
    //store password
    public function storepassword(Request $request)
    {
        $request->validate([
            'oldPassword' => 'required',
            'newPassword' => 'required|string|min:2|max:16|confirmed',
        ]);

        $user = Auth::user();
        if (Hash::check($request->oldPassword, $user->password)) {
            $user->password = Hash::make($request->newPassword);
            $user->save();
            return redirect()->route('admin')->with('success', 'Password Updated');
        } else {
            return redirect()->back()->with('error', 'Password does not match');
        }
    }

}
