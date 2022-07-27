<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Feedback
 *
 * @property int $id
 * @property string $type
 * @property int|null $recorded_by
 * @property string $name
 * @property mixed $data
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Feedback newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Feedback newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Feedback query()
 * @method static \Illuminate\Database\Eloquent\Builder|Feedback whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Feedback whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Feedback whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Feedback whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Feedback whereRecordedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Feedback whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Feedback whereUpdatedAt($value)
 */
	class Feedback extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Inspection
 *
 * @package App\Models
 * @mixin Eloquent
 * @property int $id
 * @property string $date
 * @property int $trap_id
 * @property int|null $recorded_by
 * @property int $strikes
 * @property string $species_caught
 * @property string $status
 * @property int $rebaited
 * @property string $bait_type
 * @property string $trap_condition
 * @property string $notes
 * @property string $words
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $anon
 * @property int $upload_to_nz
 * @property-read \App\Models\Trap $trap
 * @property-read \App\Models\User|null $user
 * @method static \Database\Factories\InspectionFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Inspection newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Inspection newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Inspection query()
 * @method static \Illuminate\Database\Eloquent\Builder|Inspection whereAnon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inspection whereBaitType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inspection whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inspection whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inspection whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inspection whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inspection whereRebaited($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inspection whereRecordedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inspection whereSpeciesCaught($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inspection whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inspection whereStrikes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inspection whereTrapCondition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inspection whereTrapId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inspection whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inspection whereUploadToNz($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inspection whereWords($value)
 */
	class Inspection extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Kpi
 *
 * @property int $id
 * @property int $total_inspections
 * @property int $total_catches
 * @property int $total_traps
 * @property int $total_projects
 * @property int $total_users
 * @property float $average_catches_per_user
 * @property float $average_inspections_per_user
 * @property float $average_trap_per_project
 * @property float $average_project_per_user
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Kpi newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Kpi newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Kpi query()
 * @method static \Illuminate\Database\Eloquent\Builder|Kpi whereAverageCatchesPerUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kpi whereAverageInspectionsPerUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kpi whereAverageProjectPerUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kpi whereAverageTrapPerProject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kpi whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kpi whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kpi whereTotalCatches($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kpi whereTotalInspections($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kpi whereTotalProjects($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kpi whereTotalTraps($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kpi whereTotalUsers($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kpi whereUpdatedAt($value)
 */
	class Kpi extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Profile
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $public_name
 * @property string|null $my_bait
 * @property int $total_scans
 * @property int $catches_total
 * @property string|null $last_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\ProfileFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Profile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Profile query()
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereCatchesTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereLastActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereMyBait($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile wherePublicName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereTotalScans($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereUserId($value)
 */
	class Profile extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Project
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $nz_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Inspection[] $inspections
 * @property-read int|null $inspections_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\TrapLine[] $traplines
 * @property-read int|null $traplines_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Trap[] $traps
 * @property-read int|null $traps_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Database\Factories\ProjectFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Project newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Project newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Project query()
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereNzId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereUpdatedAt($value)
 */
	class Project extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Provider
 *
 * @property int $id
 * @property string $provider
 * @property string $provider_id
 * @property int $user_id
 * @property string|null $avatar
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Provider newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Provider newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Provider query()
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereProvider($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereProviderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereUserId($value)
 */
	class Provider extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\QR
 *
 * @property int $id
 * @property string $qr_code
 * @property int|null $trap_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Trap|null $trap
 * @method static \Illuminate\Database\Eloquent\Builder|QR newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QR newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QR query()
 * @method static \Illuminate\Database\Eloquent\Builder|QR whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QR whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QR whereQrCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QR whereTrapId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QR whereUpdatedAt($value)
 */
	class QR extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\TrapLine
 *
 * @property int $id
 * @property int|null $project_id
 * @property string $name
 * @property string|null $sponsored_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Project|null $project
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Trap[] $traps
 * @property-read int|null $traps_count
 * @method static \Database\Factories\TrapLineFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|TrapLine newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TrapLine newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TrapLine query()
 * @method static \Illuminate\Database\Eloquent\Builder|TrapLine whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrapLine whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrapLine whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrapLine whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrapLine whereSponsoredBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrapLine whereUpdatedAt($value)
 */
	class TrapLine extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string|null $password
 * @property string|null $remember_token
 * @property array $settings
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Inspection[] $inspections
 * @property-read int|null $inspections_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Project[] $projects
 * @property-read int|null $projects_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Project[] $projectsAll
 * @property-read int|null $projects_all_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Provider[] $providers
 * @property-read int|null $providers_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Trap[] $traps
 * @property-read int|null $traps_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSettings($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserProject
 *
 * @property array catch_filter
 * @method static \Illuminate\Database\Eloquent\Builder|UserProject newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserProject newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserProject query()
 */
	class UserProject extends \Eloquent {}
}

