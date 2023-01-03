<?php

namespace App\Traits;

use App\Enums\SkillExperience;
use App\Models\Skill;
use App\Models\SkillUser;
use Error;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;

trait SkillServices
{
    public function getSkills(): Collection
    {
        return Skill::all();
    }

    public function getSkillById(int $id)
    {
        $skill = Skill::find($id);

        if (empty($skill))
            throw new Error(__('messages.errorGetSkill'));
        else
            return $skill;
    }

    public function getAddedSkills(object $skills, int $userId): array
    {
        $addedSkills = [];

        foreach ($skills as $skill) {
            $addedSkill = SkillUser::all()
                ->where('skill_id', $skill->id)
                ->where('user_id', $userId)
                ->toArray();

            $addedSkills[] = array_column($addedSkill, 'skill_id');
        }

        return array_column($addedSkills, 0);
    }

    public function skillSelector(object $skills, array $addedSkills): array
    {
        $skillsArray = $skills->toArray();
        $skillsArray = array_column($skillsArray, 'name', 'id');

        foreach ($addedSkills as $skill) {
            $skillsArray = Arr::except($skillsArray, $skill);
        }

        return $skillsArray;
    }

    public function experienceSelector(): array
    {
        $experiences = [];

        foreach (SkillExperience::cases() as $experience) {
            $experiences[] = $experience->value;
        }

        return $experiences;
    }

    public function createSkillsUsers(array $validated, int $userId): void
    {
        SkillUser::firstOrCreate([
            'skill_id' => $validated['skill_id'],
            'user_id' => $userId,
            'experience' => $validated['experience'],
            'created_at' => now()
        ]);
    }

    public function getSkillUser(int $id)
    {
        $skillUser = SkillUser::find($id);

        if (empty($skillUser))
            throw new Error(__('messages.errorGetSkillUser'));
        else
            return $skillUser;
    }
}
