<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Create roles
        Role::firstOrCreate(['name' => 'admin']);
        Role::firstOrCreate(['name' => 'staff']);
        Role::firstOrCreate(['name' => 'mahasiswa']);
    }

    public function test_admin_can_access_projects_index()
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $response = $this->actingAs($admin)->get(route('admin.projects.index'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.projects.index');
    }

    public function test_admin_can_create_project()
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        $staff = Staff::factory()->create();

        $projectData = [
            'title' => 'Test Project',
            'mahasiswa_name' => 'John Doe',
            'description' => 'Test description',
            'status' => 'pending',
            'start_date' => '2024-01-01',
            'end_date' => '2024-12-31',
            'assigned_staff_id' => $staff->id,
        ];

        $response = $this->actingAs($admin)->post(route('admin.projects.store'), $projectData);

        $response->assertRedirect(route('admin.projects.index'));
        $this->assertDatabaseHas('projects', $projectData);
    }

    public function test_admin_can_update_project()
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        $staff = Staff::factory()->create();
        $project = Project::factory()->create(['assigned_staff_id' => $staff->id]);

        $updatedData = [
            'title' => 'Updated Project',
            'mahasiswa_name' => 'Jane Doe',
            'description' => 'Updated description',
            'status' => 'in_progress',
            'start_date' => '2024-02-01',
            'end_date' => '2024-11-30',
            'assigned_staff_id' => $staff->id,
        ];

        $response = $this->actingAs($admin)->put(route('admin.projects.update', $project), $updatedData);

        $response->assertRedirect(route('admin.projects.index'));
        $this->assertDatabaseHas('projects', $updatedData);
    }

    public function test_admin_can_delete_project()
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        $project = Project::factory()->create();

        $response = $this->actingAs($admin)->delete(route('admin.projects.destroy', $project));

        $response->assertRedirect(route('admin.projects.index'));
        $this->assertDatabaseMissing('projects', ['id' => $project->id]);
    }

    public function test_staff_can_access_assigned_projects()
    {
        $user = User::factory()->create();
        $user->assignRole('staff');
        $staff = Staff::factory()->create(['user_id' => $user->id]);
        $project = Project::factory()->create(['assigned_staff_id' => $staff->id]);

        $response = $this->actingAs($user)->get(route('admin.projects.index'));

        $response->assertStatus(200);
        $response->assertViewHas('projects', function ($projects) use ($project) {
            return $projects->contains($project);
        });
    }

    public function test_staff_can_update_assigned_project()
    {
        $user = User::factory()->create();
        $user->assignRole('staff');
        $staff = Staff::factory()->create(['user_id' => $user->id]);
        $project = Project::factory()->create(['assigned_staff_id' => $staff->id]);

        $updatedData = [
            'title' => 'Updated by Staff',
            'mahasiswa_name' => $project->mahasiswa_name,
            'description' => $project->description,
            'status' => 'completed',
            'start_date' => $project->start_date,
            'end_date' => $project->end_date,
            'assigned_staff_id' => $staff->id,
        ];

        $response = $this->actingAs($user)->put(route('admin.projects.update', $project), $updatedData);

        $response->assertRedirect(route('admin.projects.index'));
        $this->assertDatabaseHas('projects', ['status' => 'completed']);
    }

    public function test_staff_cannot_create_project()
    {
        $user = User::factory()->create();
        $user->assignRole('staff');

        $response = $this->actingAs($user)->get(route('admin.projects.create'));

        $response->assertStatus(403);
    }

    public function test_staff_cannot_delete_project()
    {
        $user = User::factory()->create();
        $user->assignRole('staff');
        $project = Project::factory()->create();

        $response = $this->actingAs($user)->delete(route('admin.projects.destroy', $project));

        $response->assertStatus(403);
    }

    public function test_unauthenticated_user_cannot_access_projects()
    {
        $response = $this->get(route('admin.projects.index'));

        $response->assertRedirect(route('login'));
    }
}
