<aside class="sidebar">
    <h1 class="sidebar-header">CMS</h1>
    <nav class="sidebar-nav">
        <a href="/dashboard" class="{{ request()->is('dashboard') ? 'active' : '' }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        <a href="/content" class="{{ request()->is('content') ? 'active' : '' }}"><i class="fas fa-file-alt"></i> Content</a>
        <a href="#" class="{{ request()->is('users') ? 'active' : '' }}"><i class="fas fa-users"></i> Users</a>
        <a href="/categories" class="admin-only {{ request()->is('categories') ? 'active' : '' }}" style="display: none;"><i class="fas fa-tags"></i> Categories</a>
        <a href="#" class="{{ request()->is('settings') ? 'active' : '' }}"><i class="fas fa-cog"></i> Settings</a>
    </nav>
    <button id="logoutButton" class="logout-btn">Logout</button>
</aside>

<style>
    .sidebar {
        width: 250px;
        background-color: var(--sidebar-bg);
        color: var(--sidebar-text);
        height: 100vh;
        padding: 2rem 1rem;
        position: fixed;
        display: flex;
        flex-direction: column;
    }
    .sidebar-header {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--secondary-color);
        text-align: center;
        margin-bottom: 3rem;
    }
    .sidebar-nav a {
        display: flex;
        align-items: center;
        gap: 10px;
        color: var(--sidebar-text);
        text-decoration: none;
        padding: 1rem;
        border-radius: 8px;
        margin-bottom: 0.5rem;
        transition: background-color 0.3s, color 0.3s;
    }
    .sidebar-nav a:hover, .sidebar-nav a.active {
        background-color: var(--primary-color);
        color: var(--sidebar-active);
    }
    .logout-btn {
        margin-top: auto;
        background: none;
        border: 1px solid var(--primary-color);
        color: var(--primary-color);
        padding: 0.8rem;
        border-radius: 8px;
        cursor: pointer;
        font-size: 1rem;
        transition: background-color 0.3s, color 0.3s;
    }
    .logout-btn:hover {
        background-color: var(--primary-color);
        color: var(--sidebar-active);
    }
</style> 