@extends('layouts.app')

@section('title', 'Accedi')

@section('content')
    <section class="section">
        <div class="container-elegant max-w-md">
            <div class="bg-white rounded-elegant shadow-card p-8">
                <h1 class="font-display text-display-md text-content text-center mb-8">Accedi</h1>

                <form action="#" method="POST" class="space-y-6">
                    @csrf

                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" required class="form-input">
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" name="password" required class="form-input">
                    </div>

                    <div class="flex items-center justify-between">
                        <label class="flex items-center">
                            <input type="checkbox" name="remember" class="rounded border-primary-500 text-secondary-500 focus:ring-secondary-400">
                            <span class="ml-2 text-sm text-content-light">Ricordami</span>
                        </label>
                        <a href="#" class="text-sm text-secondary-700 hover:text-secondary-800">Password dimenticata?</a>
                    </div>

                    <button type="submit" class="btn-primary w-full">Accedi</button>
                </form>

                <div class="mt-6 text-center">
                    <p class="text-content-light">
                        Non hai un account?
                        <a href="#" class="text-secondary-700 hover:text-secondary-800 font-medium">Registrati</a>
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
