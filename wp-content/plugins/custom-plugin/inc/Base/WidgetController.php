<?php 
/**
 * @package  CustomPlugin
 */
namespace Inc\Base;

use Inc\Api\Widgets\MediaWidget;
use Inc\Base\BaseController;

/**
* 
*/
class WidgetController extends BaseController
{
    public function register()
    {
        if ( ! $this->activated( 'media_widget' ) ) return;

        $media_widget = new MediaWidget();
        $media_widget->register();
    }
}