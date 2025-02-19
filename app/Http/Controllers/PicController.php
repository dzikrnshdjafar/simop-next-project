<?php

namespace App\Http\Controllers;

use App\Constants\Department;
use App\Http\Requests\StorePicRequest;
use App\Http\Requests\UpdatePicRequest;
use App\Models\Pic;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class PicController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::query();
            $data->whereHas('pic');

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '
                        <a href="' . route('dashboard.master.pics.show', $row->uuid) . '" class="btn btn-primary btn-sm">
                            <i class="bi bi-list-ul"></i>
                            Detail
                        </a> 
                        ';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.dashboard.master.pics.index');
    }

    public function create()
    {
    	$departments = Department::all();

        return view('pages.dashboard.master.pics.create', compact('departments'));
    }

    public function store(StorePicRequest $request)
    {
        try {
            $user = User::create([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'phone' => $request->phone,
                'birthday' => $request->birthday,
                'gender' => $request->gender,
                'password' => Hash::make($request->username)
            ]);

            Pic::create([
                'user_id' => $user->id,
                'department' => $request->department
            ]);

            return redirect()->back()->with('success', 'Data berhasil ditambahkan.');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage())->withInput();
        }
    }

    public function show($uuid)
    {
        $user = User::where('uuid', $uuid)->first();

        return view('pages.dashboard.master.pics.show', compact('user'));
    }

    public function edit($uuid)
    {
        $user = User::where('uuid', $uuid)->first();
    	$departments = Department::all();

        return view('pages.dashboard.master.pics.edit', compact('user', 'departments'));
    }

    public function update(UpdatePicRequest $request, $uuid)
    {
        try {
            $user = User::where('uuid', $uuid)->first();

            $user->name = $request->name;
            $user->phone = $request->phone;
            $user->birthday = $request->birthday;
            $user->gender = $request->gender;
            $user->save();

            $user->pic->department = $request->department;
            $user->pic->save();

            return redirect()->back()->with('success', 'Data berhasil diperbarui.');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage())->withInput();
        }
    }

    public function destroy($uuid)
    {
        $user = User::where('uuid', $uuid)->first();
        $user->delete();

        return redirect()->route('dashboard.master.pics.index')->with('success', 'Data berhasil dihapus.');
    }
}
