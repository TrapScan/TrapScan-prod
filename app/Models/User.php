<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    const ADMIN_ROLE = 'admin';
    const DEFAULT_SETTINGS = [
        'theme' => 'default',
        'dark_mode' => false,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'settings',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'settings' => 'array'
    ];

    public function projects() {
        return $this->belongsToMany(Project::class)->using(UserProject::class);
    }

    public function projectsAll() {
        return $this->belongsToMany(Project::class)
            ->using(UserProject::class)
            ->withPivot('coordinator', 'notify_catches', 'notify_inspections', 'notify_problems', 'catch_filter');
    }

    public function traps() {
        return $this->hasMany(Trap::class);
    }

    public function inspections() {
        return $this->hasMany(Inspection::class, 'recorded_by', 'id');
    }

    public function providers() {
        return $this->hasMany(Provider::class, 'user_id', 'id');
    }

    public function catches() {
        return $this->inspections()->where('species_caught', '!=', 'None')->count();
    }

    public function catches_per_day() {
        $data = $this->inspections()
            ->where('species_caught', '!=', 'None')
            ->whereDate('created_at', Carbon::today())
            ->get()
            ->countBy('species_caught')
            ->sortDesc();

        return (count($data) == 0 ? null : $data);
    }
    /*
     * Returns the simple project and inspection count for each of a users projects
     */
    public function inspectionCountPerProject() {
        $project_ids = $this->projects->pluck('id');
        $user_id = $this->id;
        $data = Project::select('id', 'name')->whereIn('id', $project_ids)->withCount(['inspections' => function ($query) use($user_id) {
           $query->where('recorded_by', $user_id);
        }])->get();
        return $data;
    }

    public function isCoordinator() {
        return $this->projects()
            ->wherePivot('coordinator', '=', true)
            ->withPivot(Project::USER_PROJECT_COORDINATOR_SETTINGS)
            ->with(['traps' => function ($q) {
                return $q->whereNull('qr_id');
            }])
            ->get();
    }

    public function isInProject() {
        return $this->projects()
            ->withPivot(Project::USER_PROJECT_COORDINATOR_SETTINGS)
            ->with(['traps' => function ($q) {
                return $q->whereNull('qr_id');
            }])
            ->get();
    }

    public function isCoordinatorOf(Project $project) {
        return $this->projects()->wherePivot('coordinator', '=', true)
            ->where('project_id', $project->id)
            ->exists();
    }

    public function setting($name, $default = null) {
        if(array_key_exists($name, $this->settings)) {
            return $this->settings[$name];
        }
        return $default;
    }

    public function setSetting(array $revisions) {
        $this->settings = array_merge($this->settings, $revisions);
        $this->save();
        return $this;
    }

    public function setCoordinatorSettings(array $revision) {
        $valid_keys = Project::USER_PROJECT_COORDINATOR_SETTINGS;
        $project = Project::find($revision['project_id']);
        // Check if it's a valid key
        if (in_array($revision['key'], $valid_keys)) {
            // Update the value
            $this->projects()->updateExistingPivot($project, [$revision['key'] => $revision['value']]);
            return true;
        } else {
            return false;
        }
    }

    public function updateCatchFilter(array $revision) {
        $project = Project::find($revision['project_id']);
        $valid_species = Inspection::VALID_SPECIES;
        $new_catch_filter = $revision['catch_filter'] ?? [];
        $validated_catch_entices = [];
        foreach ($new_catch_filter as $filter_item) {
            if (in_array($filter_item, $valid_species)){
                $validated_catch_entices[] = $filter_item;
            }
        }
        if (count($validated_catch_entices) <= 0) {
            $validated_catch_entices = null;
        }
        $this->projects()->updateExistingPivot($project, ['catch_filter' => $validated_catch_entices]);
        return true;
    }
}
