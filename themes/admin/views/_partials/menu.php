<ul class="nav nav-pills nav-stacked custom-nav">
<?php 
    if(count($modul)>0){
        foreach ($modul as $modules) {
            if($modules['module_link']!=''){
                echo '<li class="menu-list">
                        <a href="'.base_url($modules['module_link']).'">
                        <i class="'.$modules['module_icon'].'"></i> 
                        <span>'.$modules['module_name'].'</span>
                        </a>
                    </li>';
            }else{
                echo '<li class="menu-list">
                        <a href="javascript:;">
                        <i class="'.$modules['module_icon'].'"></i> 
                        <span>'.$modules['module_name'].'</span>
                        </a>
                        <ul class="sub-menu-list">';
                        if(isset($modules['menus'])){
                            foreach($modules['menus'] as $menus) {
                                echo '<li><a href="'.base_url($menus['menu_link']).'"><i class="'.$menus['menu_icon'].'"></i>'.$menus['menu_name'].'</a></li>';
                            }
                        }else{
                         echo '<li style="display:block;background-color:#fff;"><i class=" icon-warning-sign"></i> No Submenu</li>';
                        }
                echo '</ul></li>';
            }
        }
    }
?>
</ul>