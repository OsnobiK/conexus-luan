<?php
 
namespace App\Http\Controllers;
use App\Models\Usuario; // Certifique-se de importar o modelo User
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Corrigido de Login para Auth
 
class AuthController extends Controller
{
    // Exibe o formulário de login
    public function showLoginForm()
    {
        return view('login'); // [login.blade.php](http://_vscodecontentref_/1)
    }
 
    // Processa o login
  public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    // Seja explícito, usando o mesmo guarda que configuramos
    if (Auth::guard('web')->attempt($credentials, $request->filled('remember'))) {
        $request->session()->regenerate();
        return redirect()->intended('area-user');
    }

    return back()->withErrors([
        'email' => 'Email ou senha incorretos.',
    ])->withInput();
}
 
    // Faz logout
    public function logout(Request $request)
    {
        Auth::logout(); // Corrigido de Login para Auth
 
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('success', 'Você saiu da conta com sucesso!.');
    }
}
 