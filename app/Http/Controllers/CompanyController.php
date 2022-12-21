<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyCreateRequest;
use App\Models\Address;
use App\Models\Company;
use App\Models\Media;
use Illuminate\Http\Request;

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
        return view('company.show', compact('company'));
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
    public function update(Request $request, Company $company)
    {
        //
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
}
