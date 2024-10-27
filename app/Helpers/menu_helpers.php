<?php
// app/Helpers/menu_helpers.php
if (!function_exists('renderMenu')) {
    function renderMenu($menu, $indent = '')
    {
        $output = '<tr>';
        $output .= '<td>' . $indent . htmlspecialchars($menu->menutitle) . '</td>';
        $output .= '<td>' . ($menu->parent_id ? htmlspecialchars(\App\Models\Admin\Menu::find($menu->parent_id)->menutitle) : 'Root Category') . '</td>';
        $output .= '<td>' . getMenuType($menu->texttype) . '</td>';
        $output .= '<td>' . getMenuPosition($menu->txtpostion) . '</td>';
        $output .= '<td class="gap-3"><a href="' . route('admin.menus.edit', $menu->id) . '" class="btn bg-success text-white btn-sm">Edit</a> &nbsp;<a href="' . route('admin.menus.delete', $menu->id) . '" class="btn btn-sm btn-primary text-white">Delete</a></td>';
        $checked = $menu->menu_status ? 'checked' : '';
        $output .= '<td><label class="switch">
            <input type="checkbox" class="status-toggle" data-id="' . $menu->id . '" ' . $checked . '>
            <span class="slider round"></span>
            </label></td>';

        // Render child menus
        foreach ($menu->children as $child) {
            $output .= renderMenu($child, $indent . '--- '); // Increase indent for child items
        }

        return $output;
    }
}

if (!function_exists('getMenuType')) {
    function getMenuType($texttype)
    {
        switch ($texttype) {
            case 1: return 'Content';
            case 2: return 'PDF File';
            case 3: return 'Website URL';
            default: return 'Unknown';
        }
    }
}

if (!function_exists('getMenuPosition')) {
    function getMenuPosition($txtpostion)
    {
        switch ($txtpostion) {
            case 1: return 'Header Menu';
            case 2: return 'Bottom Menu';
            case 3: return 'Footer Menu';
            case 4: return 'Director Message Menu';
            case 5: return 'Life Academy Menu';
            case 6: return 'Other Pages';
            case 7: return 'Latest Updates';
            default: return 'Unknown';
        }
    }
}
?>
