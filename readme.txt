=== Best Images slider ===
Contributors: Module Express
Donate link: http://beautiful-module.com/demo/best-images-slider-2/
Tags: image slider,gallery slider,banner slider,responsive banner slider,header banner slider,slideshow,header image slideshow,Best Images slider,Best gallery slider,best image slider
Requires at least: 3.5
Tested up to: 4.4
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A quick, easy way to add an Responsive header best image slider OR Responsive Best Images slider inside wordpress page OR Template. Also mobile touch Best Images slider

== Description ==

This plugin add a Responsive Best Images slider in your website. Also you can add Responsive Best Images slider page and mobile touch slider in to your wordpress website.

View [DEMO](http://beautiful-module.com/demo/best-images-slider-2/) for additional information.

= Installation help and support =
* Please check [Installation and Document](http://beautiful-module.com/documents/wordpress/Best-Images-slider.ver1.0.docx)  on our website.

The plugin adds a "Responsive Best Images slider" tab to your admin menu, which allows you to enter Image Title, Content, Link and image items just as you would regular posts.

To use this plugin just copy and past this code in to your header.php file or template file 
<code><div class="headerslider">
 <?php echo do_shortcode('[sp_best.images.slider]'); ?>
 </div></code>

You can also use this Best Images slider inside your page with following shortcode 
<code>[sp_best.images.slider] </code>

Display Best Images slider catagroies wise :
<code>[sp_best.images.slider cat_id="cat_id"]</code>
You can find this under  "Best Images slider-> Gallery Category".

= Complete shortcode is =
<code>[sp_best.images.slider height="300"
 slide_num="4" width="auto" animate_style="fade" 
 duration="3000" autoplay="true" autoplay_interval="3000"]</code>
 
Parameters are :

* **limit** : [sp_best.images.slider limit="-1"] (Limit define the number of images to be display at a time. By default set to "-1" ie all images. eg. if you want to display only 5 images then set limit to limit="5")
* **cat_id** : [sp_best.images.slider cat_id="2"] (Display Image slider catagroies wise.) 
* **width** : [sp_best.images.slider width="auto"] (Set the width of slider that you want to display, default is "auto"))
* **height** : [sp_best.images.slider height="450"] (Set the height of slider that you want to display, default is "450"))
* **animate_style** : [sp_best.images.slider animate_style="slide"] (Image slider effect. value is "slide" OR "fade")
* **duration** : [sp_best.images.slider duration="3000"] (Set slider speed)
* **autoplay** : [sp_best.images.slider autoplay="true"] (Set autoplay or not. value is "true" OR "false")
* **autoplay_interval** : [sp_best.images.slider autoplay="true" autoplay_interval="3000"] (Set autoplay interval)
* **slide_num** : [sp_best.images.slider slide_num="4"] (Set slider number that you want to display)

= Features include: =
* Mobile touch slide
* Responsive
* Shortcode <code>[sp_best.images.slider]</code>
* Php code for place image slider into your website header  <code><div class="headerslider"> <?php echo do_shortcode('[sp_best.images.slider]'); ?></div></code>
* Best images slider inside your page with following shortcode <code>[sp_best.images.slider] </code>
* Easy to configure
* Smoothly integrates into any theme
* CSS and JS file for custmization

== Installation ==

1. Upload the 'best-images-slider' folder to the '/wp-content/plugins/' directory.
2. Activate the 'Best Images slider' list plugin through the 'Plugins' menu in WordPress.
3. If you want to place Best images slider into your website header, please copy and paste following code in to your header.php file  <code><div class="headerslider"> <?php echo do_shortcode('[sp_best.images.slider limit="-1"]'); ?></div></code>
4. You can also display this Images slider inside your page with following shortcode <code>[sp_best.images.slider limit="-1"] </code>


== Frequently Asked Questions ==

= Are there shortcodes for Best images slider items? =

If you want to place Best images slider into your website header, please copy and paste following code in to your header.php file  <code><div class="headerslider"> <?php echo do_shortcode('[sp_best.images.slider limit="-1"]'); ?></div>  </code>

You can also display this Best images slider inside your page with following shortcode <code>[sp_best.images.slider limit="-1"] </code>



== Screenshots ==
1. Designs Views from admin side
2. Catagroies shortcode

== Changelog ==

= 1.0 =
Initial release