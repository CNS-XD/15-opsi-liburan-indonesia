<?php

namespace App\Http\Controllers\Backsite;

use App\Http\Requests\Backsite\UserRequest;
use Yajra\DataTables\Facades\DataTables;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    use \App\Traits\AjaxTrait;
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($role)
    {
        if (!empty(session('error_msg')))
            Alert::error('Failed !', session('error_msg'))->persistent('Tutup');
        if (!empty(session('success')))
            Alert::success('Success !', session('success'));

        $dataRole = $this->_getRole($role);
        $data['role'] = $dataRole;

        return view('pages.backsite.user.index', $data);
    }

    public function _getRole($role)
    {
        $dataRole['id_role'] = User::ROLE_INDEX[$role];
        $dataRole['index_role'] = $role;
        $dataRole['role'] = User::ROLE_NAME[$dataRole['id_role']];

        return $dataRole;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function datatable($role)
    {
        $idRole = User::ROLE_INDEX[$role];
        $data = User::where('role', $idRole);

        return DataTables::of($data)->addIndexColumn()->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($role)
    {
        if (!empty(session('error_msg')))
            Alert::error('Failed !', session('error_msg'))->persistent('Tutup');
        if (!empty(session('success')))
            Alert::success('Success !', session('success'));

        $dataRole = $this->_getRole($role);
        $data['role'] = $dataRole;

        return view('pages.backsite.user.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($role, UserRequest $request)
    {
        DB::beginTransaction();
        try {
            $dataRole = $this->_getRole($role);
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'plain_text' => $request->password,
                'phone' => $request->phone,
                'nationality' => $request->nationality,
                'role' => $dataRole['id_role'],
                'status' => $request->status,
            ]);
            DB::commit();
            
            return redirect()->route('backsite.user.index', $role)->withSuccess('Data Successfully Created!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("ERROR APP : " . $e->getMessage());
            return redirect()->back()->with('error_msg', 'Failed to add data: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($role, $id)
    {
        try {
            $data = User::findOrFail($id);

            return response()->json([
                'data' => $data,
                'message' => 'Successfully Get Data',
                'success' => true,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'data' => null,
                'message' => 'Failed to Get Data' . $e->getMessage(),
                'success' => false,
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($role, $id)
    {
        $this->authorize('validate-resource', [(new User), $id]);

        if (!empty(session('error_msg')))
            Alert::error('Failed !', session('error_msg'))->persistent('Tutup');
        if (!empty(session('success')))
            Alert::success('Success !', session('success'));

        $dataRole = $this->_getRole($role);
        $data['data'] = User::findOrFail($id);
        $data['role'] = $dataRole;

        return view('pages.backsite.user.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($role, $id, UserRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = User::findOrFail($id);

            $user->name = $request->name;
            $user->email = $request->email;
            if (!empty($request->password)) {
                $user->password = bcrypt($request->password);
                $user->plain_text = $request->password;
            }
            $user->phone = $request->phone;
            $user->nationality = $request->nationality;
            $user->status = $request->status;
            $user->save();
            DB::commit();
    
            return redirect()->route('backsite.user.index', $role)->withSuccess('Successfully changed data!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("ERROR APP : " . $e->getMessage());
            return redirect()->back()->with('error_msg', 'Oops An Error Occurred: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($role, $id)
    {
        $this->authorize('validate-resource', [(new User), $id]);

        DB::beginTransaction();
        try {
            $data = User::findOrFail($id);
            
            if (!empty($data->photo)) {
                $this->removeFile($data->photo, 'photo-profile');
            }

            $data->delete();
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Successfully deleted data!',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("ERROR APP : " . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Oops An Error Occurred: ' . $e->getMessage(),
            ]);
        }
    }

    public function setStatus($role, $id)
    {
        DB::beginTransaction();
        try {
            $data = User::findOrFail($id);
            $data->update([
                'status' => $data->status == User::STATUS['active'] ? User::STATUS['pending'] : User::STATUS['active']
            ]);
            DB::commit();

            $this->success = \Illuminate\Http\Response::HTTP_OK;
            $this->message = 'Status updated successfully!';
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("ERROR APP : " . $e->getMessage());
            $this->success = \Illuminate\Http\Response::HTTP_INTERNAL_SERVER_ERROR;
            $this->message = 'Failed!';
        }

        return $this->json();
    }
}
