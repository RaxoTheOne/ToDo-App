<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuestVerifyEmailController extends Controller
{
    public function __invoke(Request $request, string $id, string $hash): RedirectResponse
    {
        $user = User::findOrFail($id);

        $expectedHash = sha1($user->email);
        if (! hash_equals($expectedHash, (string) $hash)) {
            abort(403, 'Ungültiger Verifizierungs-Hash.');
        }

        if (! $user->hasVerifiedEmail()) {
            if ($user->markEmailAsVerified()) {
                event(new Verified($user));
            }
        }

        // Wenn Nutzer eingeloggt ist, leite ins Dashboard, sonst zur Login-Seite
        if (Auth::check() && Auth::id() === $user->id) {
            return redirect()->intended(route('dashboard') . '?verified=1');
        }

        return redirect()->route('login')->with('status', 'verified');
    }
}
