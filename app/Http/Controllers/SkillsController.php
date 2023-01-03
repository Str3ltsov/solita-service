<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSkillRequest;
use App\Http\Requests\UpdateSkillRequest;
use App\Models\Skill;
use App\Traits\SkillServices;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class SkillsController extends Controller
{
    use SkillServices;

    public function index(): Factory|View|Application
    {
        return view('skills.index')->with('skills', $this->getSkills());
    }

    public function create(): Factory|View|Application
    {
        return view('skills.create')
            ->with('skills', $this->getSkills());
    }

    public function store(CreateSkillRequest $request): RedirectResponse
    {
        try {
            $validated = $request->validated();
            Skill::firstOrCreate($validated);

            return redirect()
                ->route('skills.index')
                ->with('success', __('messages.successCreateSkill'));
        }
        catch (\Throwable $exc) {
            return back()->with('error', $exc->getMessage());
        }
    }

    public function edit($id): Factory|View|Application
    {
        return view('skills.edit')->with('skill', $this->getSkillById($id));
    }

    public function update($id, UpdateSkillRequest $request)
    {
        try {
            $skill = $this->getSkillById($id);
            $skill->name = $request->validated()['name'];
            $skill->save();

            return redirect()
                ->route('skills.index')
                ->with('success', __('messages.successUpdateSkill'));
        }
        catch (\Throwable $exc) {
            return back()->with('error', $exc->getMessage());
        }
    }

    public function destroy($id): RedirectResponse
    {
        try {
            $skill = $this->getSkillById($id);
            $skill->delete();

            return back()->with('success', __('messages.successDeleteSkill'));
        }
        catch (\Throwable $exc) {
            return back()->with('error', $exc->getMessage());
        }
    }
}
