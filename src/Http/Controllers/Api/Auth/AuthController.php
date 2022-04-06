<?php

namespace LaravelReady\ThemeStore\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Config;
use Illuminate\Validation\ValidationException;

use LaravelReady\ThemeStore\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function __construct() {
        $this->user = Config::get('theme-store.user', User::class);
    }

    /**
     * Login with sanctum
     *
     * @param Request $request
     * @return Response
     */
    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $clientUserAgent = $request->header('User-Agent');

        if (!$clientUserAgent) {
            throw ValidationException::withMessages([
                'client' => ['Unknown client. Please retry on another device or client.'],
            ]);
        }

        $user = $this->user::select('id', 'name', 'email', 'password')
            ->where('email', $request->email)
            ->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }


        // clean previous tokens on this client
        $this->logoutOnThisDevice($user, $clientUserAgent);

        return [
            'user' => $user,
            'token' => explode('|', $user->createToken($clientUserAgent)->plainTextToken)[1],
        ];
    }

    /**
     * Logout on this device
     *
     * @param Request $request
     * @return Response
     */
    public function logout(Request $request){
        $clientUserAgent = $request->header('User-Agent');

        $this->logoutOnThisDevice(Auth::use(), $clientUserAgent);

        return [
            'success' => true,
        ];
    }

    /**
     * Show authenticated user
     *
     * @return Response
     */
    public function me(){
        return Auth::user();
    }

    private function logoutOnThisDevice($user, string $clientUserAgent): bool{
        return $user->tokens()->where('name', $clientUserAgent)->delete();
    }
}
