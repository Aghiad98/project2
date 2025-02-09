@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Admin Dashboard</h2>

    <!-- قسم إدارة المستخدمين -->
    <div class="card mb-4">
        <h4 class="card-header bg-primary text-white">Users</h4>
        <div class="card-body">
            @foreach ($users as $user)
                <div class="mb-4 p-3 border rounded">
                    <h5 class="card-title">{{ $user->name }}</h5>
                    <p class="card-text">{{ $user->email }}</p>

                    <!-- زر حذف المستخدم -->
                    <form action="{{ route('admin.deleteUser', $user->id) }}" method="post" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>

                    <!-- تعيين الأدوار -->
                    <form action="{{ route('admin.assignRoles', $user->id) }}" method="post" class="mt-2">
                        @csrf
                        <div class="input-group">
                            <select class="form-select form-select-sm" name="role">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-primary btn-sm">Assign Role</button>
                        </div>
                    </form>
                </div>
            @endforeach
        </div>
    </div>

    <!-- قسم إدارة الأدوار -->
    <div class="card mb-4">
        <h4 class="card-header bg-success text-white">Roles</h4>
        <div class="card-body">
            @foreach ($roles as $role)
                <div class="mb-4 p-3 border rounded">
                    <h5 class="card-title">{{ $role->name }}</h5>

                    <!-- زر حذف الدور -->
                    <form action="{{ route('admin.deleteRoles', $role->id) }}" method="post" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete Role</button>
                    </form>

                    <!-- تعيين الصلاحيات -->
                    <form action="{{ route('admin.assignPermissionToRoles', $role->id) }}" method="post" class="mt-2">
                        @csrf
                        <label for="permissions" class="form-label">Assign Permissions:</label>
                        <select name="permissions[]" class="form-select form-select-sm" multiple required>
                            @foreach ($permissions as $permission)
                                @if (!$role->hasPermissionTo($permission))
                                    <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                                @endif
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-secondary btn-sm mt-2">Assign Permission</button>
                    </form>

                    <!-- إزالة الصلاحيات -->
                    <form action="{{ route('admin.removePermissionFromRoles', $role->id) }}" method="post" class="mt-2">
                        @csrf
                        <label for="permissions" class="form-label">Remove Permissions:</label>
                        <select name="permissions[]" class="form-select form-select-sm" multiple required>
                            @foreach ($role->permissions as $permission)
                                <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-warning btn-sm mt-2">Remove Permission</button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>

    <!-- قسم إنشاء أدوار جديدة -->
    <div class="card mb-4">
        <h4 class="card-header bg-info text-white">Create Role</h4>
        <div class="card-body">
            <form action="{{ route('admin.createRoles') }}" method="post">
                @csrf
                <div class="input-group">
                    <input type="text" name="name" class="form-control" placeholder="Role Name" required>
                    <button type="submit" class="btn btn-outline-secondary">Create Role</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
