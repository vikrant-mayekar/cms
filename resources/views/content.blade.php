@extends('layouts.app')

@section('title', 'Content Management - Modern CMS')

@section('content')
    <header>
        <h2 id="page-title">Content Management</h2>
        <button class="btn-primary" id="addArticleBtn">Add New Article</button>
    </header>

    <div class="filter-container">
        <select id="category-filter"><option value="">All Categories</option></select>
        <select id="status-filter">
            <option value="">All Statuses</option>
            <option value="draft">Draft</option>
            <option value="published">Published</option>
            <option value="archived">Archived</option>
        </select>
        <input type="date" id="start-date-filter">
        <input type="date" id="end-date-filter">
        <button id="filter-btn" class="btn-primary">Filter</button>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Status</th>
                    <th>Published Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="articles-table-body">
                <!-- Articles will be loaded here -->
            </tbody>
        </table>
    </div>
    
    <!-- Modal for Add/Edit Article -->
    <div id="articleModal" class="modal">
      <div class="modal-content">
        <div class="modal-header">
            <h2 id="modal-title">Add New Article</h2>
            <span class="close">&times;</span>
        </div>
        <form id="articleForm">
            <!-- Form content will be dynamically injected here -->
        </form>
      </div>
    </div>
@endsection

@push('styles')
<style>
    /* Add all the specific styles for the content page here */
</style>
@endpush

@push('scripts')
<script>
    // Add all the specific scripts for the content page here
</script>
@endpush 