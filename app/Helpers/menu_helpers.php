<?php
// app/Helpers/menu_helpers.php
if (!function_exists('renderMenu')) {
    function renderMenu($menu, $indent = '', &$counter)
    {
        $output = '<tr>';
        $output .= '<td>' . $counter++ . '</td>'; // Use the counter for numbering
        $output .= '<td>' . $indent . htmlspecialchars($menu->menutitle) . '</td>';
        $output .= '<td>' . ($menu->parent_id ? htmlspecialchars(\App\Models\Admin\Menu::find($menu->parent_id)->menutitle) : 'Root Category') . '</td>';
        $output .= '<td>' . getMenuPosition($menu->txtpostion) . '</td>';
        $output .= '<td>
                <div class="d-flex justify-content-center align-items-center gap-2">
                    <a href="' . route('admin.menus.edit', $menu->id) . '" 
                        class="btn btn-success text-white btn-sm">
                        Edit
                    </a>
                    <form action="' . route('admin.menus.delete', $menu->id) . '" 
                          method="POST" 
                          class="m-0">
                        ' . csrf_field() . '
                        ' . method_field('DELETE') . '
                        <button type="submit" class="btn btn-primary text-white btn-sm" 
                                onclick="return confirm(\'Are you sure you want to delete?\')">
                            Delete
                        </button>
                    </form>
                </div>
            </td>';

        $output .= '<td><div class="form-check form-switch">
        <input class="form-check-input status-toggle" type="checkbox" role="switch" data-table="menus" 
        data-column="menu_status" data-id="' . $menu->id . '" ' . 
        ($menu->menu_status ? 'checked' : '') . 
         (in_array($menu->txtpostion, [4, 5]) ? ' disabled' : '') . '>
    </div></td>';
    
        $output .= '</tr>';

        // $counter++; // Increment the counter

        // Render child menus, passing the counter
        foreach ($menu->children as $child) {
            $output .= renderMenu($child, $indent . '--- ', $counter);
        }

        return $output;
    }
}


if (!function_exists('renderMicroMenu')) {
    function renderMicroMenu($menu, $indent = '', &$counter = 1)
    {
        $output = '<tr>';
        $output .= '<td>' . $counter . '</td>'; // Use the counter for numbering
        $output .= '<td>' . $indent . htmlspecialchars($menu->menutitle) . '</td>';
        $output .= '<td>' . ($menu->parent_id ? htmlspecialchars(\App\Models\Admin\Micro\MicroMenu::find($menu->parent_id)->menutitle) : 'Root Category') . '</td>';
        $output .= '<td>' . getMenuType($menu->texttype) . '</td>';
        $output .= '<td>' . getMenuPosition($menu->txtpostion) . '</td>';
        $output .= '<td>
        <div class="d-flex justify-content-center align-items-center gap-2">
            <a href="' . route('micromenus.edit', $menu->id) . '" 
                class="btn btn-success text-white btn-sm">
                Edit
            </a>
            <form action="' . route('micromenu.delete', $menu->id) . '" 
                  method="POST" 
                  class="m-0">
                ' . csrf_field() . '
                ' . method_field('DELETE') . '
                <button type="submit" class="btn btn-primary text-white btn-sm" 
                        onclick="return confirm(\'Are you sure you want to delete?\')">
                    Delete
                </button>
            </form>
        </div>
    </td>';
        $output .= '<td><div class="form-check form-switch">
            <input class="form-check-input status-toggle" type="checkbox" role="switch" data-table="micromenus" 
            data-column="menu_status" data-id="' . $menu->id . '" ' . ($menu->menu_status ? 'checked' : '') . '>
          </div></td>';
        $output .= '</tr>';

        $counter++; // Increment the counter

        // Render child menus, passing the counter
        foreach ($menu->children as $child) {
            $output .= renderMicroMenu($child, $indent . '--- ', $counter);
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

// if (!function_exists('renderMicroMenuItems')) {
//     function renderMicroMenuItems($parentId) {
//         $submenus = DB::table('micromenus')
//             ->where('menu_status', 1)
//             ->where('is_deleted', 0)
//             ->where('parent_id', $parentId)
//             ->get();

//         if ($submenus->isEmpty()) {
//             return '';
//         }

//         $output = '<ul class="dropdown-menu dropdown-menu-arrow dropdown-menu-end">';
//         foreach ($submenus as $submenu) {
//             $hasChildren = DB::table('micromenus')
//                 ->where('menu_status', 1)
//                 ->where('is_deleted', 0)
//                 ->where('parent_id', $submenu->id)
//                 ->exists();

//             $output .= '<li class="nav-item ' . ($hasChildren ? 'dropdown' : '') . '">';
//             $output .=
//                 '<a class="nav-link ' . ($hasChildren ? 'dropdown-toggle' : '') . '"
//                     href="' . ($submenu->menutitle == 'Research Center' ? '#' : route('user.navigationmenubyslug', $submenu->menu_slug)) . '" ' .
//                 ($hasChildren ? ' data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"' : '') . '>' .
//                 $submenu->menutitle .
//                 '</a>';

//             // Recursive call for child menus
//             if ($hasChildren) {
//                 $output .= renderMicroMenuItems($submenu->id);
//             }

//             $output .= '</li>';
//         }
//         $output .= '</ul>';

//         return $output;
//     }
// }

// if (!function_exists('renderMicroMenuItems')) {
//     function renderMicroMenuItems($parentId) {
//         $submenus = DB::table('micromenus')
//             ->where('menu_status', 1)
//             // ->where('is_deleted', 0)
//             ->where('parent_id', $parentId)
//             ->get();
//         // Debugging output to check submenus
//         if ($submenus->isEmpty()) {
//             return ''; // No submenus found, return empty
//         }

//         $output = '<ul class="dropdown-menu dropdown-menu-arrow dropdown-menu-end">';
//         foreach ($submenus as $submenu) {
//             // print_r($submenu);die;
//             $hasChildren = DB::table('micromenus')
//                 ->where('menu_status', 1)
//                 ->where('is_deleted', 0)
//                 ->where('parent_id', $submenu->id) 
//                 ->exists();

//             $output .= '<li class="nav-item ' . ($hasChildren ? 'dropdown' : '') . '">';
//             $output .=
//                 '<a class="nav-link ' . ($hasChildren ? 'dropdown-toggle' : '') . '"
//                     href="' . ($submenu->menutitle == 'Research Center' ? '#' : route('user.navigationmenubyslug', $submenu->menu_slug)) . '" ' .
//                 ($hasChildren ? ' data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"' : '') . '>' . 
//                 $submenu->menutitle . '</a>';

//             // Recursive call for child menus
//             if ($hasChildren) {
//                 $output .= renderMicroMenuItems($submenu->id);
//             }

//             $output .= '</li>';
//         }
//         $output .= '</ul>';

//         return $output;
//     }
// }

if (!function_exists('renderMicroMenuItems')) {
    function renderMicroMenuItems($parentId) {
        $submenus = DB::table('micromenus')
            ->where('menu_status', 1)
            ->where('is_deleted', 0)
            ->where('parent_id', $parentId)
            ->get();
        // Debugging output to check submenus
        if ($submenus->isEmpty()) {
            return ''; // No submenus found, return empty
        }

        $output = '<ul class="dropdown-menu dropdown-menu-arrow dropdown-menu-end">';
        foreach ($submenus as $submenu) {
            $hasChildren = DB::table('micromenus')
                ->where('menu_status', 1)
                ->where('is_deleted', 0)
                ->where('parent_id', $submenu->id)
                ->exists();

            $output .= '<li class="nav-item ' . ($hasChildren ? 'dropdown' : '') . '">';
            $output .=
                '<a class="nav-link ' . ($hasChildren ? 'dropdown-toggle' : '') . '"
                    href="' . ($submenu->menutitle == 'Research Center' ? '#' : route('user.navigationmenubyslug', $submenu->menu_slug)) . '" ' .
                ($hasChildren ? ' data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"' : '') . '>' . 
                $submenu->menutitle . '</a>';

            // Recursive call for child menus
            if ($hasChildren) {
                $output .= renderMicroMenuItems($submenu->id);
            }

            $output .= '</li>';
        }
        $output .= '</ul>';

        return $output;
    }
}


if (!function_exists('permisson_navigation')) {
    function permisson_navigation() {
        // return Auth::user();
        $user = Auth::user();
        if ($user->user_type != 1) { // Not a SuperAdmin
           return $modules = DB::table('modules as m')
            ->Join('user_permissions as up', function ($join) use ($user) {
                $join->on('m.id', '=', 'up.module_id')
                    ->where('up.user_id', $user->id)
                    ->where('up.is_allowed', 1); // Only allowed modules
            })
            ->select('m.id', 'm.parent', 'm.child', 'm.status','up.is_allowed')
            ->where('m.status', 1) // Only active modules
            ->get();
            }else{
               return $modules = DB::table('modules as m')
               ->select('m.id', 'm.parent', 'm.child', 'm.status')
                ->where('status', 1) // Only active modules
                ->get();
            }
    }
}





?>

