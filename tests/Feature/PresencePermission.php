<?php

namespace Tests\Feature;

use App\Models\Presence;
use App\Models\PresenceAttachment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class PresencePermission extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_get_permission_type()
    {
        $user = User::factory()->create();
        $token = $user->createToken($user->sdm_name)->plainTextToken;

        $response = $this->withToken($token)->getJson('/api/permission/type');
        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    '1' => 'Tidak Masuk',
                    '2' => 'Izin Berkegiatan Diluar 1/2 Hari',
                    '3' => 'Izin Berkegiatan Diluar 1 Hari',
                    '4' => 'Izin Sakit',
                    '5' => 'Terkendala Absen Masuk',
                    '6' => 'Terkendala Absen Pulang'
                ]
            ]);
    }

    /** @test */
    public function it_can_get_user_permission()
    {
        $user = User::factory()->create();
        $token = $user->createToken($user->sdm_name)->plainTextToken;

        $presence = Presence::factory()->create(['sdm_id' => $user->id]);
        $presenceAtt = PresenceAttachment::factory()->create(['presence_id' => $presence->id]);
        $response = $this->withToken($token)->getJson('/api/permission/me');
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'sdm_id',
                        'sdm_name',
                        'created_at',
                        'attachment' => [
                            'id',
                            'presence_id',
                            'detail',
                            'attachment'
                        ]
                    ]
                ]
            ]);
    }

    /** @test */
    public function it_can_post_permission_tidak_masuk()
    {
        $user = User::factory()->create();
        $token = $user->createToken($user->sdm_name)->plainTextToken;

        $file = UploadedFile::fake()->create('test.jpg');
        $form = [
            'jenis_izin' => 1,
            'detail' => 'contoh detail 1',
            'attachment' => $file
        ];
        $response = $this->withToken($token)->postJson('/api/permission', $form);
        $response->assertCreated();
    }

    /** @test */
    public function it_can_post_permission_berkegiatan_diluar_sehari()
    {
        $user = User::factory()->create();
        $token = $user->createToken($user->sdm_name)->plainTextToken;

        $file = UploadedFile::fake()->create('test.jpg');
        $form = [
            'jenis_izin' => 2,
            'detail' => 'contoh detail 2',
            'attachment' => $file
        ];
        $response = $this->withToken($token)->postJson('/api/permission', $form);
        $response->assertCreated();
    }

    /** @test */
    public function it_can_post_permission_berkegiatan_diluar_setengah_hari()
    {
        $user = User::factory()->create();
        $token = $user->createToken($user->sdm_name)->plainTextToken;

        $file = UploadedFile::fake()->create('test.jpg');
        $form = [
            'jenis_izin' => 3,
            'detail' => 'contoh detail 3',
            'attachment' => $file
        ];
        $response = $this->withToken($token)->postJson('/api/permission', $form);
        $response->assertCreated();
    }

    /** @test */
    public function it_can_post_permission_sakit()
    {
        $user = User::factory()->create();
        $token = $user->createToken($user->sdm_name)->plainTextToken;

        $file = UploadedFile::fake()->create('test.jpg');
        $form = [
            'jenis_izin' => 4,
            'detail' => 'contoh detail 4',
            'attachment' => $file
        ];
        $response = $this->withToken($token)->postJson('/api/permission', $form);
        $response->assertCreated();
    }

    /** @test */
    public function it_can_post_permission_kendala_absen_masuk()
    {
        $user = User::factory()->create();
        $token = $user->createToken($user->sdm_name)->plainTextToken;

        $file = UploadedFile::fake()->create('test.jpg');
        $form = [
            'jenis_izin' => 5,
            'detail' => 'contoh detail 5',
            'attachment' => $file
        ];
        $response = $this->withToken($token)->postJson('/api/permission', $form);
        $response->assertCreated();
    }

    /** @test */
    public function it_can_post_permission_kendala_absen_pulang()
    {
        $user = User::factory()->create();
        $token = $user->createToken($user->sdm_name)->plainTextToken;

        $file = UploadedFile::fake()->create('test.jpg');
        $form = ['jenis_izin' => 6];

        $presence = Presence::factory()->create([
            'sdm_id' => $user->id,
            'check_out_time' => NULL
        ]);
        PresenceAttachment::factory()->create(['presence_id' => $presence->id]);

        $response = $this->withToken($token)->postJson('/api/permission', $form);
        $response->assertCreated();
    }

    /** @test */
    public function it_can_delete_permission()
    {
        $user = User::factory()->create();
        $token = $user->createToken($user->sdm_name)->plainTextToken;

        $presence = Presence::factory()->create([
            'sdm_id' => $user->id,
            'check_out_time' => NULL
        ]);
        PresenceAttachment::factory()->create(['presence_id' => $presence->id]);

        $response = $this->withToken($token)->deleteJson('/api/permission/' . $presence->id);
        $response->assertOk();
    }

    /** @test */
    public function it_throws_error_when_post_approve_permission()
    {
        $user = User::factory()->create();
        $token = $user->createToken($user->sdm_name)->plainTextToken;

        $presence = Presence::factory()->create([
            'sdm_id' => $user->id,
            'check_out_time' => NULL
        ]);
        PresenceAttachment::factory()->create(['presence_id' => $presence->id]);

        $response = $this->withToken($token)->postJson('/api/permission/' . $presence->id);
        $response->assertOk();
    }

    /** @test */
    public function it_throws_error_when_post_approve_permission_without_structure()
    {
        $user = User::factory()->create();
        $token = $user->createToken($user->sdm_name)->plainTextToken;

        $presence = Presence::factory()->create([
            'sdm_id' => $user->id,
            'check_out_time' => NULL
        ]);
        PresenceAttachment::factory()->create(['presence_id' => $presence->id]);

        $response = $this->withToken($token)->postJson('/api/permission/' . $presence->id);
        // var_dump($response->getContent());
        $response->assertUnprocessable()
            ->assertJsonFragment(['error' => 'Anda tidak dapat memberikan izin']);
    }

    /** @test */
    public function it_throws_error_when_form_is_missing()
    {
        $user = User::factory()->create();
        $token = $user->createToken($user->sdm_name)->plainTextToken;

        $response = $this->withToken($token)->postJson('/api/permission', []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors([
                'jenis_izin',
                'detail',
                'attachment'
            ])
            ->assertJson([
                'message' => 'The jenis izin field is required. (and 2 more errors)',
                'errors' => [
                    'jenis_izin' => [
                        'The jenis izin field is required.'
                    ],
                    'detail' => [
                        'The detail field is required.'
                    ],
                    'attachment' => [
                        'The attachment field is required.'
                    ]
                ]
            ]);
    }

    /** @test */
    public function it_throws_error_when_user_post_permission_but_has_not_presence_today()
    {
        $user = User::factory()->create();
        $token = $user->createToken($user->sdm_name)->plainTextToken;

        $form = ['jenis_izin' => 6];

        $response = $this->withToken($token)->postJson('/api/permission', $form);
        $response->assertUnprocessable()
            ->assertJsonFragment(['error' => 'Anda belum absen masuk hari ini']);
    }

    /** @test */
    public function it_throws_error_when_user_post_permission_but_already_checkou_presence_today()
    {
        $user = User::factory()->create();
        $token = $user->createToken($user->sdm_name)->plainTextToken;

        $form = ['jenis_izin' => 6];
        $presence = Presence::factory()->create([
            'sdm_id' => $user->id,
        ]);
        PresenceAttachment::factory()->create(['presence_id' => $presence->id]);

        $response = $this->withToken($token)->postJson('/api/permission', $form);
        $response->assertUnprocessable()
            ->assertJsonFragment(['error' => 'Anda sudah mengisi absen pulang hari ini']);
    }
}
