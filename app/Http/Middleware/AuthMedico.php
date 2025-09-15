<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AuthMedico
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 👇 CORREÇÃO AQUI 👇
        if (!Auth::guard('medicos')->check()) {
            // Sugestão: Adicionar uma mensagem de erro para o usuário entender o que aconteceu.
            return redirect('/login')->with('error', 'Acesso negado. Você precisa ser um médico autenticado para ver esta página.');
        }

        return $next($request);
    }
}