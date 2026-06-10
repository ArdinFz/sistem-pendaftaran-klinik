<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $adminsQuery = DB::table('admins')
            ->select('id_admin as id', 'Nama as name', 'email', 'no_hp', DB::raw("'admin' as role"), DB::raw("'aktif' as status"), DB::raw("NULL as foto"), 'created_at');
            
        $pegawaisQuery = DB::table('pegawais')
            ->select('id_pegawai as id', 'nama_pegawai as name', 'email', 'no_hp', DB::raw("'pegawai' as role"), DB::raw("'aktif' as status"), DB::raw("NULL as foto"), 'created_at');

        if ($search) {
            $adminsQuery->where(function($q) use ($search) {
                $q->where('Nama', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('id_admin', 'like', "%{$search}%");
            });
            $pegawaisQuery->where(function($q) use ($search) {
                $q->where('nama_pegawai', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('id_pegawai', 'like', "%{$search}%");
            });
        }

        $unionQuery = $adminsQuery->unionAll($pegawaisQuery);

        $users = DB::table(DB::raw("({$unionQuery->toSql()}) as combined"))
            ->mergeBindings($unionQuery)
            ->orderBy('created_at', 'desc')
            ->paginate(5)
            ->withQueryString();

        return view('backend.admin.users.index', compact('users', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $role = $request->role;
        $uniqueTable = ($role === 'admin') ? 'admins' : 'pegawais';

        $request->validate([
            'role' => 'required|in:admin,pegawai',
            'nik' => 'nullable|string|max:20',
            'email' => 'required|string|email|max:255|unique:' . $uniqueTable . ',email',
            'password' => 'required|string|min:6',
            'name' => 'required|string|max:255',
            'jenis_kelamin' => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',
            'no_hp' => 'required|string|max:20',
            'foto' => 'nullable',
        ]);

        if ($role === 'admin') {
            $latest = Admin::orderBy('id_admin', 'desc')->first();
            $num = $latest ? ((int) substr($latest->id_admin, 3) + 1) : 1;
            $newId = 'ADM' . str_pad($num, 3, '0', STR_PAD_LEFT);

            Admin::create([
                'id_admin' => $newId,
                'email' => $request->email,
                'password' => $request->password, // Mutator hashes this via casts
                'Nama' => $request->name,
                'no_hp' => $request->no_hp,
            ]);
        } else {
            $latest = Pegawai::orderBy('id_pegawai', 'desc')->first();
            $num = $latest ? ((int) substr($latest->id_pegawai, 3) + 1) : 1;
            $newId = 'PEG' . str_pad($num, 3, '0', STR_PAD_LEFT);

            Pegawai::create([
                'id_pegawai' => $newId,
                'email' => $request->email,
                'password' => $request->password, // Mutator hashes this via casts
                'nama_pegawai' => $request->name,
                'no_hp' => $request->no_hp,
            ]);
        }

        return redirect()->route('admin.users.index')->with('success', 'Akun berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (str_starts_with($id, 'ADM')) {
            $user = Admin::findOrFail($id);
            $user->role = 'admin';
        } else {
            $user = Pegawai::findOrFail($id);
            $user->role = 'pegawai';
        }

        $user->nik = '1234567890123456';
        $user->status = 'aktif';
        $user->jenis_kelamin = 'L';
        $user->tanggal_lahir = '2000-01-01';
        $user->foto = null;

        return view('backend.admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (str_starts_with($id, 'ADM')) {
            $user = Admin::findOrFail($id);
            $user->role = 'admin';
        } else {
            $user = Pegawai::findOrFail($id);
            $user->role = 'pegawai';
        }

        $user->nik = '1234567890123456';
        $user->status = 'aktif';
        $user->jenis_kelamin = 'L';
        $user->tanggal_lahir = '2000-01-01';
        $user->foto = null;

        return view('backend.admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $oldRole = str_starts_with($id, 'ADM') ? 'admin' : 'pegawai';
        $newRole = $request->role;
        $uniqueTable = ($newRole === 'admin') ? 'admins' : 'pegawais';
        $uniqueIdColumn = ($newRole === 'admin') ? 'id_admin' : 'id_pegawai';
        
        $excludeId = ($newRole === $oldRole) ? $id : null;

        $request->validate([
            'role' => 'required|in:admin,pegawai',
            'status' => 'required|in:aktif,nonaktif',
            'nik' => 'nullable|string|max:20',
            'email' => 'required|string|email|max:255|unique:' . $uniqueTable . ',email,' . ($excludeId ? "'$excludeId'" : 'NULL') . ',' . $uniqueIdColumn,
            'name' => 'required|string|max:255',
            'jenis_kelamin' => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',
            'no_hp' => 'required|string|max:20',
            'foto' => 'nullable',
        ]);

        if ($newRole !== $oldRole) {
            if ($newRole === 'admin') {
                $oldUser = Pegawai::findOrFail($id);
                $latest = Admin::orderBy('id_admin', 'desc')->first();
                $num = $latest ? ((int) substr($latest->id_admin, 3) + 1) : 1;
                $newId = 'ADM' . str_pad($num, 3, '0', STR_PAD_LEFT);

                Admin::create([
                    'id_admin' => $newId,
                    'email' => $request->email,
                    'password' => $oldUser->password, // preserve hashed password
                    'Nama' => $request->name,
                    'no_hp' => $request->no_hp,
                ]);
                $oldUser->delete();
            } else {
                $oldUser = Admin::findOrFail($id);
                $latest = Pegawai::orderBy('id_pegawai', 'desc')->first();
                $num = $latest ? ((int) substr($latest->id_pegawai, 3) + 1) : 1;
                $newId = 'PEG' . str_pad($num, 3, '0', STR_PAD_LEFT);

                Pegawai::create([
                    'id_pegawai' => $newId,
                    'email' => $request->email,
                    'password' => $oldUser->password, // preserve hashed password
                    'nama_pegawai' => $request->name,
                    'no_hp' => $request->no_hp,
                ]);
                $oldUser->delete();
            }
        } else {
            if ($oldRole === 'admin') {
                $user = Admin::findOrFail($id);
                $user->update([
                    'email' => $request->email,
                    'Nama' => $request->name,
                    'no_hp' => $request->no_hp,
                ]);
            } else {
                $user = Pegawai::findOrFail($id);
                $user->update([
                    'email' => $request->email,
                    'nama_pegawai' => $request->name,
                    'no_hp' => $request->no_hp,
                ]);
            }
        }

        return redirect()->route('admin.users.index')->with('success', 'Akun berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Check if admin is deleting themselves
        if (Auth::guard('admin')->check() && Auth::guard('admin')->id() === $id) {
            return redirect()->route('admin.users.index')->with('error', 'Anda tidak dapat menghapus akun Anda sendiri yang sedang aktif.');
        }

        if (str_starts_with($id, 'ADM')) {
            $user = Admin::findOrFail($id);
        } else {
            $user = Pegawai::findOrFail($id);
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Akun berhasil dihapus.');
    }
}
