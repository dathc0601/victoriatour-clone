<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Table Columns
    |--------------------------------------------------------------------------
    */

    'column.name' => 'Tên',
    'column.guard_name' => 'Guard',
    'column.team' => 'Nhóm',
    'column.roles' => 'Vai trò',
    'column.permissions' => 'Quyền',
    'column.updated_at' => 'Cập nhật lúc',

    /*
    |--------------------------------------------------------------------------
    | Form Fields
    |--------------------------------------------------------------------------
    */

    'field.name' => 'Tên',
    'field.guard_name' => 'Guard',
    'field.permissions' => 'Quyền',
    'field.team' => 'Nhóm',
    'field.team.placeholder' => 'Chọn nhóm...',
    'field.select_all.name' => 'Chọn tất cả',
    'field.select_all.message' => 'Bật/Tắt tất cả quyền cho vai trò này',

    /*
    |--------------------------------------------------------------------------
    | Navigation & Resource
    |--------------------------------------------------------------------------
    */

    'nav.group' => 'Quản trị',
    'nav.role.label' => 'Vai trò',
    'nav.role.icon' => 'heroicon-o-shield-check',
    'resource.label.role' => 'Vai trò',
    'resource.label.roles' => 'Vai trò',

    /*
    |--------------------------------------------------------------------------
    | Section & Tabs
    |--------------------------------------------------------------------------
    */

    'section' => 'Thực thể',
    'resources' => 'Tài nguyên',
    'widgets' => 'Widget',
    'pages' => 'Trang',
    'custom' => 'Quyền tùy chỉnh',

    /*
    |--------------------------------------------------------------------------
    | Messages
    |--------------------------------------------------------------------------
    */

    'forbidden' => 'Bạn không có quyền truy cập',

    /*
    |--------------------------------------------------------------------------
    | Resource Permissions Labels
    |--------------------------------------------------------------------------
    */

    'resource_permission_prefixes_labels' => [
        'view' => 'Xem',
        'view_any' => 'Xem tất cả',
        'create' => 'Tạo mới',
        'update' => 'Cập nhật',
        'delete' => 'Xóa',
        'delete_any' => 'Xóa tất cả',
        'force_delete' => 'Xóa vĩnh viễn',
        'force_delete_any' => 'Xóa vĩnh viễn tất cả',
        'restore' => 'Khôi phục',
        'reorder' => 'Sắp xếp',
        'restore_any' => 'Khôi phục tất cả',
        'replicate' => 'Nhân bản',
    ],
];
