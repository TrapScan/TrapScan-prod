<?php

namespace App\Imports;

use App\Models\Project;
use App\Models\Trap;
use App\Models\TrapLine;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TrapImport implements ToCollection, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public $headings = [
        "Project",
        "Trap_line",
        "Trap ID",
        "Main trap ID",
        "Number/Code",
        "Installed",
        "Installed by",
        "Trap_type",
        "Trap_sub_type",
        "Latitude",
        "Lon",
        "Notes",
        "Retired",
        "Total kills",
        "Last Record"
    ];

    public int $notes_added;
    public int $trap_lines_created;
    public int $traps_added_to_lines;

    public function stats() {
        return ['notes_added' => $this->notes_added,
            'trap_lines_created' => $this->trap_lines_created,
            'traps_added_to_lines' => $this->traps_added_to_lines
        ];
    }

    public function collection(Collection $collection)
    {
        $this->notes_added = 0;
        $this->trap_lines_created = 0;
        $this->traps_added_to_lines = 0;
        foreach ($collection as $row) {
            $trap = Trap::where('nz_trap_id', $row['main_trap_id'])->first();
            if($trap) {
                if(!$trap->notes) {
                    $this->notes_added+=1;
                }
                $trap->notes = $row['notes'];
                if($row['trap_line']){
                    $trap_line = TrapLine::where('name', $row['trap_line'])->first();
                    if(! $trap_line) {
                        $project = Project::where('name', $row['project'])->first();
                        if($project) {
                            $trap_line = TrapLine::create([
                               'project_id' => $project->id,
                               'name' => $row['trap_line']
                            ]);
                            $this->trap_lines_created+=1;
                        }
                    }
                    if($trap->trapline?->name !== $row['trap_line']) {
                        $trap->trapline()->associate($trap_line);
                        $trap->save();
                        $this->traps_added_to_lines+=1;
                    }
                }
            }
        }
    }
}
