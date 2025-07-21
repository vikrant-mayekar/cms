@extends('layouts.app')

@section('title', 'Category Management - Modern CMS')

@section('content')
    <header>
        <h2>Category Management</h2>
        <button class="btn-primary" onclick="showCategoryModal()">Add New Category</button>
    </header>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="categories-table-body">
                <!-- Categories will be loaded here -->
            </tbody>
        </table>
    </div>

    <!-- Modal for categories -->
    <div id="categoryModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="document.getElementById('categoryModal').style.display='none'">&times;</span>
            <h2 id="category-modal-title">Add Category</h2>
            <form id="categoryForm">
                <input type="hidden" id="categoryId">
                <input type="text" id="categoryName" placeholder="Category Name">
                <button type="submit" class="btn-primary">Save</button>
            </form>
        </div>
    </div>
@endsection

@push('styles')
<style>
    /* Add all the specific styles for the category page here */
</style>
@endpush

@push('scripts')
<script>
    // Add all the specific scripts for the category page here
</script>
@endpush 