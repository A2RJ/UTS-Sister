<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ChangePasswordRequest;
use App\Http\Requests\Auth\ChangePasswordSDM;
use App\Http\Requests\Auth\ChangePasswordStudent;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RequestToken;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Http\Requests\Auth\StudentRequest;
use App\Models\HumanResource;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Error;
use Exception;
use stdClass;

class SanctumAuthController extends Controller
{
    public function user(Request $request)
    {
        try {
            return response([
                'data' => [
                    'sdm_name' => $request->user()->sdm_name,
                    'sdm_id' => $request->user()->sdm_id,
                    'email' => $request->user()->email,
                    'nidn' => $request->user()->nidn,
                    'nip' => $request->user()->nip,
                    'is_lecturer' => $request->user()->sdm_type == 'Dosen' ? true : false
                ]
            ]);
        } catch (Exception $th) {
            throw $th;
        }
    }

    public function token(RequestToken $request)
    {
        try {
            $user = User::where('email', $request->email)->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                throw ValidationException::withMessages([
                    'email' => ['The provided credentials are incorrect.'],
                ]);
            }

            return response([
                'data' => [
                    'access_token' => $user->createToken($user->sdm_name)->plainTextToken,
                    'sdm_id' => $user->sdm_id,
                ]
            ]);
        } catch (Exception $th) {
            throw $th;
        }
    }

    public function changePasswordSDM(ChangePasswordSDM $request)
    {
        try {
            $sdm = HumanResource::where('sdm_id', $request->user()->sdm_id)->first();
            $sdm->update([
                'password' => Hash::make($request->password)
            ]);
            return response()->json(true, 204);
        } catch (Exception $th) {
            throw $th;
        }
    }

    public function studentAuth(StudentRequest $request)
    {
        $student = Student::where('nim', $request->nim)->first();

        if (!$student || !Hash::check($request->password, $student->password)) {
            throw ValidationException::withMessages([
                'nim' => ['The provided credentials are incorrect.'],
            ]);
        }

        return response([
            'data' => [
                'access_token' => $student->createToken($student->nim)->plainTextToken,
                'student_id' => $student->student_id
            ]
        ]);
    }

    public function student(Request $request)
    {
        return response([
            'data' => [
                'nama lengkap' => $request->user()->nama_lengkap,
                'student_id' => $request->user()->student_id,
                'gender' => $request->user()->gender,
                'nim' => $request->user()->nim,
                'prodi' => $request->user()->program_studi_id,
            ]
        ]);
    }

    public function changePasswordStudent(ChangePasswordStudent $request)
    {
        try {
            $student = Student::where('student_id', $request->user()->student_id)->first();
            if (!$student) return response()->json([
                'message' => 'Data not found.',
            ], 404);

            $student->update([
                'password' => Hash::make($request->password)
            ]);
            return $this->responseMessage(true, 204);
        } catch (Exception $th) {
            throw $th;
        }
    }

    public function findUserOrStudent($username)
    {
        $user = User::where('email', $username)
            ->orWhere('nidn', $username)
            ->first();
        if ($user) {
            $result = new stdClass();
            $result->role = 'dosen';
            $result->user = $user;
            $result->id = $user->sdm_id;
            return $result;
        }

        $student = Student::where('nim', $username)->first();
        if ($student) {
            $result = new stdClass();
            $result->role = 'mahasiswa';
            $result->user = $student;
            $result->id = $student->student_id;
            return $result;
        }

        return false;
    }

    public function login(LoginRequest $request)
    {
        try {
            $userInfo = $this->findUserOrStudent($request->username);
            if (!$userInfo) throw new Error('Your account is not registered.', 404);
            if (!Hash::check($request->password, $userInfo->user->password)) throw new Error('The provided credentials are incorrect.', 422);

            return response([
                'data' => [
                    'role' => $userInfo->role,
                    'id' => $userInfo->id,
                    'access_token' => $userInfo->user->createToken($userInfo->id)->plainTextToken,
                ]
            ]);
        } catch (Exception $th) {
            throw $th;
        }
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        try {
            $role = $request->role;

            if ($role === 'dosen') {
                $model = HumanResource::class;
                $id_field = 'sdm_id';
            } elseif ($role === 'mahasiswa') {
                $model = Student::class;
                $id_field = 'student_id';
            } else {
                return response()->json([
                    'message' => 'Invalid role.',
                ], 400);
            }

            $record = $model::where($id_field, $request->id_user)->first();
            if (!$record) {
                return response()->json([
                    'message' => 'Data not found.',
                ], 404);
            }

            $record->update([
                'password' => Hash::make($request->password)
            ]);

            return response()->json(true, 204);
        } catch (Exception $th) {
            return $this->responseError($th, 500);
        }
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        try {
            $role = $request->role;

            if ($role === 'dosen') {
                $model = HumanResource::class;
                $id_field = 'sdm_id';
                $reset = 'nidn';
            } elseif ($role === 'mahasiswa') {
                $model = Student::class;
                $id_field = 'student_id';
                $reset = 'nim';
            } else {
                return response()->json([
                    'message' => 'Invalid role.',
                ], 400);
            }

            $record = $model::where($id_field, $request->id_user)->first();
            if (!$record) {
                return response()->json([
                    'message' => 'Data not found.',
                ], 404);
            }

            $record->update([
                'password' => Hash::make($record->$reset)
            ]);

            return response()->json(true, 204);
        } catch (Exception $th) {
            throw $th;
        }
    }

    public function changePasswordOpsi(ChangePasswordRequest $request)
    {
        try {
            $user = $request->user();

            if ($user instanceof HumanResource) {
                $model = HumanResource::class;
                $id_field = 'sdm_id';
            } elseif ($user instanceof Student) {
                $model = Student::class;
                $id_field = 'student_id';
            } else {
                return response()->json([
                    'message' => 'Invalid user type.',
                ], 400);
            }

            $record = $model::where($id_field, $user->$id_field)->first();
            if (!$record) {
                return response()->json([
                    'message' => 'Data not found.',
                ], 404);
            }

            $record->update([
                'password' => Hash::make($request->password)
            ]);

            return response()->json(true, 204);
        } catch (Exception $th) {
            throw $th;
        }
    }
}
