<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show()
    {
        return view('perfil', ['user' => Auth::user()]);
    }

    public function edit()
    {
        return view('perfil-edit', ['user' => Auth::user()]);
    }

    public function update(ProfileUpdateRequest $request)
    {
        $user = $request->user();
        
        // Pega apenas os dados que passaram na validação (ou seja, os que foram enviados)
        $validatedData = $request->validated();

        // Atualiza os campos apenas se eles existirem nos dados validados
        if (isset($validatedData['name'])) {
            $user->name = $validatedData['name'];
        }
        if (isset($validatedData['email'])) {
            $user->email = $validatedData['email'];
        }
        if (isset($validatedData['telefone'])) {
            $user->telefone = $validatedData['telefone'];
        }
        if (isset($validatedData['cidade'])) {
            $user->cidade = $validatedData['cidade'];
        }

        // Se uma nova senha foi enviada, atualize-a
        if (!empty($validatedData['password'])) {
            $user->password = Hash::make($validatedData['password']);
        }
        
        // Lógica para salvar a imagem de perfil, se uma nova foi enviada
        if ($request->hasFile('profile_image')) {
            if ($user->profile_image) {
                Storage::disk('public')->delete($user->profile_image);
            }
            $path = $request->file('profile_image')->store('profile-images', 'public');
            $user->profile_image = $path;
        }

        $user->save();

        return redirect()->route('perfil.edit')->with('success', 'Perfil atualizado com sucesso!');
    }
}
