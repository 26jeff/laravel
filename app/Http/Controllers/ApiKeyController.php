<?php

namespace App\Http\Controllers;

use App\Models\ApiKey;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ApiKeyController extends Controller
{
    use AuthorizesRequests;
    public function index(Request $request)
    {
        $apiKeys = Auth::user()->apiKeys()->latest()->get();
        if ($request->wantsJson()) {
            return response()->json($apiKeys);
        }
        return inertia('ApiKeys/Index', [
            'apiKeys' => $apiKeys,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $apiKey = ApiKey::create([
            'uuid' => Str::uuid(),
            'user_id' => Auth::id(),
            'name' => $request->name,
            'key' => Str::random(40),
        ]);
        if ($request->wantsJson()) {
            return response()->json($apiKey, 201);
        }
        return redirect()->route('api-keys.index')->with('success', 'Clé API créée !');
    }

    public function show(ApiKey $apiKey)
    {
        $this->authorize('view', $apiKey);
        return response()->json($apiKey);
    }

    public function destroy(ApiKey $apiKey, Request $request)
    {
        $this->authorize('delete', $apiKey);
        $apiKey->delete();
        if ($request->wantsJson()) {
            return response()->json(['message' => 'Clé supprimée']);
        }
        return redirect()->route('api-keys.index')->with('success', 'Clé API supprimée !');
    }
}