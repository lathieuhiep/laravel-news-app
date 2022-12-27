<?php
namespace App\Helpers;

class Common {
    public static function renderMenusAdmin($menus): string
    {
        if ( !empty( $menus ) ) {
            foreach ( $menus as $menu) {
                $isParent = array_key_exists('children', $menu);

                if ( !$isParent ) :
                ?>
                    <a class="nav-link" href="<?php echo $menu['link']; ?>">
                        <?php if( array_key_exists('icon', $menu) ): ?>
                            <div class="sb-nav-link-icon">
                                <i class="{{ $menu['icon'] }}"></i>
                            </div>
                        <?php
                        endif;

                        echo $menu['title'];
                        ?>
                    </a>
                <?php
                else:
                    self::renderSubMenusAdmin($menu['children']);
                endif;
            }
        }

        return '';
    }

    public static function renderSubMenusAdmin($subMenu): string
    {}
}