<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\UserPrivilege;
use App\Models\ArchiveCategory;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->superadmin == 1) {
            $user = User::all();
            return view('user.index')->with('users', $user);
        } else {
            return abort(403);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->superadmin == 1) {
            $user = User::all();
            return view('user.create')->with('users', $user);
        } else {
            return abort(403);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::user()->superadmin == 1) {
            $validateData = $request->validate([
                'nama' => 'required',
                'email' => 'required',
                'password' => 'required|confirmed'
            ]);

            $user = new User();
            $user->name = $validateData['nama'];
            $user->email = $validateData['email'];
            $user->password = Hash::make($validateData['password']);

            if($request->superadmin == 1) {
                $user->superadmin = 1;
            } else {
                $user->superadmin = 0;
            }

            $user->save();

            return redirect()->route('user.index')->with('info', "Berhasil menambah pengguna");
        } else {
            return abort(403);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        if(Auth::user()->superadmin == 1) {
            $userPrivilege = UserPrivilege::all()->where('user_id', $user->id);
            return view('user.show', ['user' => $user])->with('userPrivilege', $userPrivilege);
        } else {
            return abort(403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if(Auth::user()->superadmin == 1) {
            $userPrivilege = UserPrivilege::where('user_id', $user->id)->delete();

            $user = User::where('id', $user->id)->delete();

            return redirect('user')->with('info', "Pengguna berhasil dihapus");
        } else {
            return abort(403);
        }
    }

    public function reset(Request $request, User $user) {
        if(Auth::user()->superadmin == 1) {
            $validateData = $request->validate([
                'password' => 'required|confirmed'
            ]);

            $password = Hash::make($validateData['password']);

            User::where('id', $user->id)->update(['password' => $password]);

            return redirect()->route('user.show', $user->id)->with('info', "Berhasil mengubah kata sandi");
        } else {
            return abort(403);
        }
    }

    public function access(User $user)
    {
        if(Auth::user()->superadmin == 1) {
            $archiveCategory = ArchiveCategory::all();
            $userPrivilege = UserPrivilege::all()->where('user_id', $user->id);

            // $filter = DB::select('SELECT * FROM archive_categories, user_privileges WHERE archive_categories.user_id = $user');

            return view('user.privilege')->with('user', $user)->with('userPrivilege', $userPrivilege)->with('archiveCategory', $archiveCategory);
        } else {
            return abort(403);
        }
    }

    public function grant(Request $request, $id)
    {
        if(Auth::user()->superadmin == 1) {
            $validateData = $request->validate([
                'kategori' => 'required'
            ]);

            $userPrivilege = new UserPrivilege();
            $userPrivilege->category_id = $validateData['kategori'];
            
            $userPrivilege->read = 1;

            if($request->create == 1) {
                $userPrivilege->create = 1;
            } else {
                $userPrivilege->create = 0;
            }
            
            if($request->update == 1) {
                $userPrivilege->update = 1;
            } else {
                $userPrivilege->update = 0;
            }

            if($request->delete == 1) {
                $userPrivilege->delete = 1;
            } else {
                $userPrivilege->delete = 0;
            }

            if($request->download == 1) {
                $userPrivilege->download = 1;
            } else {
                $userPrivilege->download = 0;
            }

            $userPrivilege->user_id = $id;

            $userPrivilege->save();

            return redirect()->route('user.show', $id)->with('info', "Berhasil menambah hak akses");
        } else {
            return abort(403);
        }
    }

    public function revoke($id) {
        if(Auth::user()->superadmin == 1) {
            $userPrivilege = UserPrivilege::where('id', $id)->delete();

            return redirect()->route('user.show', $id)->with('info', "Berhasil menghapus hak akses");
        } else {
            return abort(403);
        }
    }

    public function modify($id) {
        if(Auth::user()->superadmin == 1) {
            $userPrivilege = UserPrivilege::where('id', $id)->first();
            return view('user.edit')->with('userPrivilege', $userPrivilege);
        } else {
            return abort(403);
        }
    }

    public function alter(Request $request, $id) {
        if(Auth::user()->superadmin == 1) {
            if($request->create == 1) {
                UserPrivilege::where('id', $id)->update(['create' => 1]);
            } else {
                UserPrivilege::where('id', $id)->update(['create' => 0]);
            }
            
            if($request->update == 1) {
                UserPrivilege::where('id', $id)->update(['update' => 1]);
            } else {
                UserPrivilege::where('id', $id)->update(['update' => 0]);
            }

            if($request->delete == 1) {
                UserPrivilege::where('id', $id)->update(['delete' => 1]);
            } else {
                UserPrivilege::where('id', $id)->update(['delete' => 0]);
            }

            if($request->download == 1) {
                UserPrivilege::where('id', $id)->update(['download' => 1]);
            } else {
                UserPrivilege::where('id', $id)->update(['download' => 0]);
            }

            return redirect()->route('user.show', $id)->with('info', "Berhasil mengubah hak akses");
        } else {
            return abort(403);
        }
    }
}
