<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Address;
use App\Models\Education;
use App\Models\Media;
use App\Models\Profile;
use App\Models\SocialMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ProfileController extends Controller
{
    public function detail()
    {
        $user = Auth::user();
        return view('profile.detail', compact('user'));
    }

    public function store(ProfileRequest $request)
    {
        $user = Auth::user();

        if ($user->profile) {
            $data = [
                'phone' => $request->phone,
                'gender' => $request->gender,
                'birth_date' => $request->birth_date,
                'about_me' => $request->about_me,
            ];

            $user->profile->address->update([
                'description' => $request->address,
                'province' => $request->province,
                'city' => $request->city,
                'postal_code' => $request->postal_code,
            ]);

            $media = null;
            if ($request->hasFile('foto')) {
                $image = $request->file('foto');
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

            $education = $user->profile->education->update([
                'tingkat_pendidikan' => $request->tingkat_pendidikan,
                'institusi' => $request->institusi,
                'jurusan' => $request->jurusan,
                'nilai_akhir' => $request->nilai_akhir,
                'tanggal_masuk' => $request->tanggal_masuk,
                'tanggal_lulus' => $request->tanggal_lulus,
            ]);

            $socialMedia = $user->profile->socialMedia->update([
                'instagram' => $request->instagram,
                'facebook' => $request->facebook,
                'linkedin' => $request->linkedin,
            ]);

            $user->profile->update($data);

        } else {
            $address = Address::create([
                'description' => $request->address,
                'province' => $request->province,
                'city' => $request->city,
                'postal_code' => $request->postal_code,
            ]);

            $image = $request->file('foto');
            $name = time() . '-' . uniqid() . '.' . $image->extension();
            $image->storeAs('images', $name, 'public');
            $media = Media::create([
                'name' => $image->getClientOriginalName(),
                'url' => asset('storage/images/' . $name),
                'type' => $image->getMimeType(),
                'size' => $image->getSize(),
            ]);

            $education = Education::create([
                'tingkat_pendidikan' => $request->tingkat_pendidikan,
                'institusi' => $request->institusi,
                'jurusan' => $request->jurusan,
                'nilai_akhir' => $request->nilai_akhir,
                'tanggal_masuk' => $request->tanggal_masuk,
                'tanggal_lulus' => $request->tanggal_lulus,
            ]);

            $socialMedia = SocialMedia::create([
                'instagram' => $request->instagram,
                'facebook' => $request->facebook,
                'linkedin' => $request->linkedin,
            ]);

            Profile::create([
                'phone' => $request->phone,
                'gender' => $request->gender,
                'birth_date' => $request->birth_date,
                'about_me' => $request->about_me,
                'user_id' => $user->id,
                'address_id' => $address->id,
                'foto_id' => $media->id,
                'social_media_id' => $socialMedia->id,
                'education_id' => $education->id,
            ]);
        }
        return to_route('profile.detail');
    }

    /**
     * Display the user's profile form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function edit(Request $request)
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     *
     * @param  \App\Http\Requests\ProfileUpdateRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileUpdateRequest $request)
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
