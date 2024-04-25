<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Image;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $data = Category::where('status', '<>', '2')->orderBy('id', 'ASC')->get();
        if ($request->ajax()) {
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    if ($row->status == '1') {
                        $checked = 'checked';
                    } else {
                        $checked = '';
                    }
                    $status = '<div class="form-check form-switch form-switch-md d-flex justify-content-center p-1" dir="ltr">
                                    <input type="checkbox" onclick="status(this)" class="form-check-input statusBtn s' . $row->id . '" id="' . $row->id . '" ' . $checked . '>
                                </div>';
                    return $status;
                })
                ->addColumn('image', function ($row) {
                    $status = '<img class="rounded-circle" width="35" src="' . asset('admin/images/category/' . $row->img) . '" alt="">';
                    return $status;
                })
                ->addColumn('action', function ($row) {
                    $action = '<ul class="list-inline mb-0 d-flex justify-content-center align-middle p-2">
                                    <li class="list-inline-item">
                                        <a class="text-warning editItem" data-bs-toggle="modal"
                            data-bs-target="#UpdateCategory" href="javascript:void(0)" id="' . $row->id . '">
                                            <i class="fas fa-pencil-alt p-2 bg-soft-warning border border-warning rounded-circle"></i>
                                        </a>

                                    </li>';
                    return $action;
                })
                ->rawColumns(['status', 'action', 'image'])
                ->make('true');
        }
        return view('admin.category.index');
    }

    public function addNewCategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'message' => $validator->fails()->first()
            ]);
        }

        if ($request->file('image')) {

            $image = $request->file('image');

            $filename = $image->getClientOriginalName();
            $request->file('image')->move(public_path('admin/images/category'), $filename);
        }

        //Slug Converting from here
        $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $request->name);

        // Convert to lowercase
        $slug = strtolower($slug);

        // Remove leading and trailing hyphens
        $slug = trim($slug, '-');

        // Replace multiple consecutive hyphens with a single hyphen
        $slug = preg_replace('/-+/', '-', $slug);

        $data = Category::create([
            'name' => $request->name,
            'description' => isset($request->description) ? $request->description : '',
            'img' => isset($filename) ? 'admin/images/category/' . $filename : "",
            'status' => true,
            'slug' => $slug,
        ]);

        if ($data) {
            return response()->json([
                'status' => 1,
                'message' => 'Successfully added'
            ]);
        }
    }

    public function categoryStatus(Request $request)
    {
        if ($request->ajax()) {
            if (isset($request->isChecked)) {
                $id = $request->id;

                $category = Category::find($id);
                if ($category) {
                    $category->update([
                        'status' => $request->isChecked == 'true' ? true : false,
                    ]);

                    if ($request->isChecked == 'true') {
                        return response()->json([
                            'status' => true,
                            'message' => 'Successfully activated the Category'
                        ]);
                    } else {
                        return response()->json([
                            'status' => true,
                            'message' => 'Successfully deactivated the Category'
                        ]);
                    }
                } else {
                    return response()->json([
                        'status' => false,
                        'message' => 'Category id not found'
                    ]);
                }
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'isChecked field is not found. ERROR'
                ]);
            }
        }
    }

    public function categoryUpdate(Request $request)
    {
        if ($request->ajax() && isset($request->id)) {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 0,
                    'message' => $validator->errors()->first(),
                ]);
            }

            $category = Category::find($request->id);

            if (!$category) {
                return response()->json([
                    'status' => 0,
                    'message' => 'Category id not found',
                ]);
            }
            //Slug Converting from here
            $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $request->name);

            // Convert to lowercase
            $slug = strtolower($slug);

            // Remove leading and trailing hyphens
            $slug = trim($slug, '-');

            // Replace multiple consecutive hyphens with a single hyphen
            $slug = preg_replace('/-+/', '-', $slug);

            $dataToUpdate = [
                'name' => $request->name,
                'description' => $request->filled('description') ? $request->description : $category['description'],
                'slug' => $slug,
            ];

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = $image->getClientOriginalName();

                $fileMoved = $image->move(public_path('admin/images/category'), $filename);

                if (!$fileMoved) {
                    return response()->json([
                        'status' => false,
                        'message' => 'File failed to upload',
                    ]);
                }

                $dataToUpdate['img'] = $filename;
            }

            $category->update($dataToUpdate);

            return response()->json([
                'status' => true,
                'message' => 'Category updated successfully',
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Invalid request',
        ]);
    }

    public function getData(Request $request)
    {
        if ($request->ajax() && isset($request->id)) {
            $data = Category::where('id', $request->id)->first();

            return response()->json([
                'status' => 1,
                'data' => $data
            ]);
        }
    }
}
