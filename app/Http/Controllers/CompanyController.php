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
use Illuminate\Support\Facades\Hash;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::all();
        return view('company.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company.create');
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
        $users = User::where('role', 'COMPANY')->whereHas('company', function ($q) use ($company) {
            $q->where('company_id', $company->id);
        })->get();

        return view('company.show', compact('company', 'users'));
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
        Address::find($company->with('address')->first()->id)->update([
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
        return to_route('company');
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
        return view('company.user.create');
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

        return to_route('company.show', $company);
    }

    public function userShow(Request $request, Company $company, User $user)
    {
        $check = Company::whereHas('users', function ($q) use ($user, $company) {
            $q
                ->where('user_id', $user->id)
                ->where('company_id', $company->id);
        })->get();
        if (!count($check)) {
            return abort('404');
        }
        return view('company.user.show', compact('user'));
    }
}
