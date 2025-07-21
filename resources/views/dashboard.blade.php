@extends('layouts.app')

@section('title', 'Dashboard - Modern CMS')

@section('content')
    <header>
        <h2 id="welcome-message">Loading...</h2>
    </header>
    <div class="card-container">
        <div class="card"><h3>Total Posts</h3><p>42</p></div>
        <div class="card"><h3>Users Online</h3><p>5</p></div>
        <div class="card"><h3>New Comments</h3><p>12</p></div>
    </div>
@endsection

@push('styles')
<style>
    header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }
    #welcome-message {
        font-size: 1.8rem;
        font-weight: 600;
    }
    .card-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.5rem;
    }
    .card {
        background-color: var(--secondary-color);
        padding: 1.5rem;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        animation: popIn 0.5s ease-out forwards;
        opacity: 0;
    }
    .card:nth-child(1) { animation-delay: 0.1s; }
    .card:nth-child(2) { animation-delay: 0.2s; }
    .card:nth-child(3) { animation-delay: 0.3s; }

    @keyframes popIn {
        from { transform: scale(0.9); opacity: 0; }
        to { transform: scale(1); opacity: 1; }
    }
</style>
@endpush 