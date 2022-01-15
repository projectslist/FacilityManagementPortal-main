<?php

namespace Tests\Feature;

use App\Models\Job;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class JobTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_display_jobs()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/jobs');

        $response->assertStatus(200);
    }

    public function test_add_new_job()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/jobs',[
            'summary' => 'Job Summary',
            'description' => 'Job Description',
            'property_id' => 3,
            'status' => 'open',
            'user_id' => 2,
        ]);


        $response->assertStatus(201);

    }

    public function test_edit_job(){

        $user = User::factory()->create();

        $job = Job::factory()->create();
        $this->actingAs($user)->put('jobs/'.$job->id,[
            'summary' => 'Job Summary',
            'description' => 'Job Description',
            'property_id' => 3,
            'status' => 'open',
            'user_id' => $user->id,
        ]);

        $this->assertDatabaseHas('jobs',['id'=> $job->id ,
            'summary' => 'Job Summary',
            'description' => 'Job Description',
            'property_id' => 3,
            'status' => 'open',
            'user_id' => $user->id,]);


    }
    public function test_delete_job()
    {

        $user = User::factory()->create();



        $job = Job::factory()->create();


        $this->actingAs($user)->delete('jobs/' . $job->id);

        $expectedCount = 0;
        $result = Job::where('id',$job->id)->count();
        $this->assertEquals(
            $expectedCount,
            $result
        );
    }
}
