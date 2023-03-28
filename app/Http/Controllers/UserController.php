<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Enums\SkillExperience;
use App\Http\Requests\AddSkillsRequest;
use App\Models\Skill;
use App\Models\SkillUser;
use App\Models\User;
use App\Models\UserStatus;
use App\Traits\SkillServices;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Flash;

class UserController extends Controller
{
    use forSelector, SkillServices;

    private function getSkills(): Collection
    {
        return Skill::select('id', 'name')->get();
    }

    private function getAddedSkills(object $skills): array
    {
        $addedSkills = [];

        foreach ($skills as $skill) {
            $addedSkill = SkillUser::all()
                ->where('skill_id', $skill->id)
                ->where('user_id', auth()->user()->id)
                ->toArray();

            $addedSkills[] = array_column($addedSkill, 'skill_id');
        }

        return array_column($addedSkills, 0);
    }

    private function skillSelector(object $skills, array $addedSkills): array
    {
        $skillsArray = $skills->toArray();
        $skillsArray = array_column($skillsArray, 'name', 'id');

        foreach ($addedSkills as $skill) {
            $skillsArray = Arr::except($skillsArray, $skill);
        }

        return $skillsArray;
    }

//    private function experienceSelector(): array
//    {
//        $experiences = [];
//
//        foreach (SkillExperience::cases() as $experience) {
//            $experiences[$experience->value] = $experience->value;
//        }
//
//        return $experiences;
//    }

    /**
     * Show the profile for a given user.
     */
    public function show(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $user = auth()->user();
        $skills = $this->getSkills();
        $addedSkills = $this->getAddedSkills($skills);

        if (!$user)
            return redirect('/products')->with('error', __('errorGetUser'));

        return view('user_views.user.profile')
            ->with([
                'user' => $user,
                'experiences' => $this->experienceForSelector(),
                'skills' => $this->skillSelector($skills, $addedSkills),
                'skillExperiences' => $this->experienceForSelector(),
            ]);
    }

    /*
     * Form that updates user profile information.
     */
    public function store($prefix, Request $request)
    {
        $request->validate(User::$rules);

        $user = User::find(Auth::user()->id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->company_code = $request->company_code;
        $user->vat_code = $request->vat_code;
        $user->street = $request->street;
        $user->house_flat = $request->house_flat;
        $user->post_index = $request->post_index;
        $user->city = $request->city;
        $user->phone_number = $request->phone_number;
        $user->work_info = $request->work_info ?? null;
        $user->hourly_price = $request->hourly_price ?? null;
        $user->status_id = $request->status_id ?? UserStatus::APPROVED;
        $user->experience_id = $request->experience ?? null;
        $user->save();

        return back()->with('success', __('messages.userupdated'));
    }

    /*
     * Form that updates user password.
     */
    public function changePassword($prefix, Request $request)
    {
        $validateData = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|confirmed'
        ]);

        $id = Auth::user()->id;
        $hashedPassword = Auth::user()->password;

        if (Hash::check($request->current_password, $hashedPassword)) {
            $user = User::find($id);
            $user->password = Hash::make($request->new_password);
            $user->save();

            Flash::success(__('messages.changedpassword'));

//            return redirect(route('userprofile'));
        }
        else {
            Flash::error(__('messages.incorrectpassword'));

//            return redirect(route('userprofile'));
        }
        return redirect(route('userprofile', $prefix));
    }

    /**
     * Deleting account will not delete it entirely, but block it from access.
     */
    public function deleteAccount(): \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        try {
            $user = auth()->user();

            $user->status_id = UserStatus::BLOCKED;
            $user->updated_at = now();
            $user->save();

            Auth::logout();
            return redirect('/products')->with('success', __('messages.successDeletedAccount'));
        }
        catch (\Throwable $exc) {
            return back()->with('error', $exc->getMessage());
        }
    }

    private function createSkillsUsers(array $validated, object $user): void
    {
        SkillUser::firstOrCreate([
            'skill_id' => $validated['skill_id'],
            'user_id' => $user->id,
            'experience' => $validated['experience'],
            'created_at' => now()
        ]);
    }

    /*
     * Skill selection for specialists and employees
     */
    public function addSkill(AddSkillsRequest $request): \Illuminate\Http\RedirectResponse
    {
        try {
            $validated = $request->validated();

            $this->createSkillsUsers($validated, auth()->user());

            return back()->with('success', __('messages.successAddSkill'));
        }
        catch (\Throwable $exc) {
            return back()->with('error', $exc->getMessage());
        }
    }

    /*
     * Form that removes a skill from user.
     */
    public function removeSkill($id): \Illuminate\Http\RedirectResponse
    {
        try {
            $skillUser = $this->getSkillUser($id);
            $skillUser->delete();

            return back()->with('success', __('messages.successRemoveSkill'));
        }
        catch (\Throwable $exc) {
            return back()->with('error', $exc->getMessage());
        }
    }
}
