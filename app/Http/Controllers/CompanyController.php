<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyCreateRequest;
use App\Http\Requests\CompanyCreateUserRequest;
use App\Http\Requests\CompanyUpdateRequest;
use App\Models\Address;
use App\Models\Company;
use App\Models\Media;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, DataTables $dataTables)
    {
        switch (Auth::user()->role) {
            case 'ADMIN':
                $companies = Company::query();
                if ($request->ajax()) {
                    return $dataTables->eloquent($companies)->addColumn('action', function ($companies) {
                        return '<a href="' . route('admin.company.show', $companies->id) . '">Detail</a>';
                    })->toJson();
                }
                $companies = $companies->get();
                return view('admin.company.index', compact('companies'));
                break;
            case 'COMPANY':
                $company = Auth::user()->company[0];
                $users = $company->users;
                return view('company.company.show', compact('company', 'users'));
                break;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.company.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyCreateRequest $request)
    {
        $address = Address::create([
            'description' => $request->address,
            'province' => $request->province,
            'city' => $request->city,
            'postal_code' => $request->postal_code,
        ]);

        $image = $request->file('companyLogo');
        $name = time() . '-' . uniqid() . '.' . $image->extension();
        $image->storeAs('images', $name, 'public');
        $media = Media::create([
            'name' => $image->getClientOriginalName(),
            'url' => asset('storage/images/' . $name),
            'type' => $image->getMimeType(),
            'size' => $image->getSize(),
        ]);

        $company = Company::create([
            'address_id' => $address->id,
            'foto_id' => $media->id,
            'name' => $request->companyName,
            'email' => $request->companyEmail,
            'phone' => $request->companyPhone,
            'url' => $request->companyWeb,
        ]);

        return to_route('company');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        $users = $company->users;
        return view('admin.company.show', compact('company', 'users'));
    }

    public function show2()
    {
        $company = Auth::user()->company[0];
        $users = $users = $company->users;
        return view('company.company.show', compact('company', 'users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyUpdateRequest $request, Company $company)
    {
        Address::find($company->address->id)->update([
            'description' => $request->address,
            'province' => $request->province,
            'city' => $request->city,
            'postal_code' => $request->postal_code,
        ]);
        $data = [
            'name' => $request->companyName,
            'email' => $request->companyEmail,
            'phone' => $request->companyPhone,
            'url' => $request->companyWeb,
        ];
        if ($request->hasFile('companyLogo')) {
            $image = $request->file('companyLogo');
            $name = time() . '-' . uniqid() . '.' . $image->extension();
            $image->storeAs('images', $name, 'public');
            $media = Media::create([
                'name' => $image->getClientOriginalName(),
                'url' => asset('storage/images/' . $name),
                'type' => $image->getMimeType(),
                'size' => $image->getSize(),
            ]);
            $data['foto_id'] = $media->id;
            $data['foto_id'] = $media->id;
        }
        $company->update($data);

        return to_route('admin.company.show', $company);
    }

    public function update2(CompanyUpdateRequest $request)
    {
        $company = Auth::user()->company[0];
        Address::find($company->address->id)->update([
            'description' => $request->address,
            'province' => $request->province,
            'city' => $request->city,
            'postal_code' => $request->postal_code,
        ]);
        $data = [
            'name' => $request->companyName,
            'email' => $request->companyEmail,
            'phone' => $request->companyPhone,
            'url' => $request->companyWeb,
        ];
        if ($request->hasFile('companyLogo')) {
            $image = $request->file('companyLogo');
            $name = time() . '-' . uniqid() . '.' . $image->extension();
            $image->storeAs('images', $name, 'public');
            $media = Media::create([
                'name' => $image->getClientOriginalName(),
                'url' => asset('storage/images/' . $name),
                'type' => $image->getMimeType(),
                'size' => $image->getSize(),
            ]);
            $data['foto_id'] = $media->id;
        }
        $company->update($data);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        //
    }

    public function userRegister(Request $request)
    {
        return view('admin.company.user.create');
    }

    public function userRegister2(Request $request)
    {
        return view('company.company.user.create');
    }

    public function userStore(CompanyCreateUserRequest $request, Company $company)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('123'),
            'role' => 'COMPANY',
        ]);

        $company->users()->attach($user);

        return to_route('admin.company.show', $company);
    }

    public function userStore2(CompanyCreateUserRequest $request)
    {
        $company = Auth::user()->company[0];
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('123'),
            'role' => 'COMPANY',
        ]);

        $company->users()->attach($user);

        return to_route('company', $company);
    }

    public function userShow(Request $request, Company $company, User $user)
    {
        if ($user->company[0]->id !== $company->id) {
            return abort('404');
        }
        return view('admin.company.user.show', compact('user'));
    }

    public function userShow2(Request $request, User $user)
    {
        if ($user->company[0]->id !== Auth::user()->company[0]->id) {
            return abort('404');
        }
        return view('company.company.user.show', compact('user'));
    }

    public function getAllCompanies()
    {
        $company = DB::table('companies')
            ->select(
                'id as id',
                'name as name',
                'email as email',
                'phone as phone',

            )
            ->get();

        return Datatables::of($company)
            ->addColumn('action', function ($company) {
                $html = '
            <a href ="' . url('company.show') . "/" . $company->id . '">
            <i class="fa fa-edit"></i>
            </a>';
                return $html;
            })
            ->make(true);
    }
}
