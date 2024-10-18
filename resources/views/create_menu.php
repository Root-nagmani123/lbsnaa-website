<div class="frm_row"> 
    <span class="label1">
        <label for="menucategory">Primary Link:</label>
        <span class="star">*</span>
    </span> 
    <span class="input1">
        <select name="menucategory" id="menucategory">
            <option value="0">It is Root Category</option>
            <?php echo buildMenuOptions($menus); ?>
        </select>
    </span>
</div>

<?php
function buildMenuOptions($menus, $parent_id = 0, $depth = 0) {
    $output = '';
    foreach ($menus as $menu) {
        if ($menu['parent_id'] == $parent_id) {
            $indent = str_repeat('&nbsp;&nbsp;&nbsp;', $depth);
            $output .= '<option value="'.$menu['id'].'">'.$indent.'--'.$menu['name'].'</option>';
            $output .= buildMenuOptions($menus, $menu['id'], $depth + 1);
        }
    }
    return $output;
}
?>
