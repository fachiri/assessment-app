<?php

namespace App\Http\Controllers;

use App\Exports\UsersExampleExport;
use App\Exports\UsersExport;
use App\Http\Requests\ImportUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserPasswordRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Imports\UsersImport;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::query();
            $data->whereHas('student');

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('student_nisn', function ($row) {
                    return $row->student->nisn;
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '
                        <a href="' . route('dashboard.master.user.show', $row->uuid) . '" class="btn btn-primary btn-sm">
                            <i class="bi bi-list-ul"></i>
                            Detail
                        </a> 
                        ';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.dashboard.master.users.index');
    }

    public function create()
    {
        return view('pages.dashboard.master.users.create');
    }

    public function store(StoreUserRequest $request)
    {
        try {
            $user = User::create($request->only([
                'nis', 'nisn', 'name', 'gender', 'phone', 'birthday', 'username', 'email'
            ]) + [
                'password' => Hash::make($request->username)
            ]);

            Student::create($request->only([
                'nis', 'nisn'
            ]) + [
                'user_id' => $user->id
            ]);

            return redirect()->back()->with('success', 'Data berhasil ditambahkan.');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage())->withInput();
        }
    }

    public function show(User $user)
    {
        return view('pages.dashboard.master.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('pages.dashboard.master.users.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        try {
            $user->student->nis = $request->nis;
            $user->student->nisn = $request->nisn;
            $user->name = $request->name;
            $user->gender = $request->gender;
            $user->phone = $request->phone;
            $user->birthday = $request->birthday;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->save();
            $user->student->save();

            return redirect()->back()->with('success', 'Data berhasil diperbarui.');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage())->withInput();
        }
    }

    public function update_password(UpdateUserPasswordRequest $request, User $user)
    {
        try {
            $user->password = Hash::make($request->new_password);
            $user->save();

            return redirect()->back()->with('success', 'Password berhasil diperbarui.');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage())->withInput();
        }
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('dashboard.master.user.index')->with('success', 'Data berhasil dihapus');
    }

    public function import(ImportUserRequest $request)
    {
        try {
            Excel::import(new UsersImport, $request->file('file'));

            return redirect()->back()->with('success', 'Data berhasil ditambahkan.');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage())->withInput();
        }
    }

    public function import_example()
    {
        return Excel::download(new UsersExampleExport, 'contoh_file_import_siswa.xlsx');
    }

    public function export()
    {
        return Excel::download(new UsersExport, 'Daftar_Siswa_' . now()->format('Ymd_His') . '.xlsx');
    }
}
