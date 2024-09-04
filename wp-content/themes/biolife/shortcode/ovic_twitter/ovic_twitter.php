<?php
if (!defined('ABSPATH')) {
    die('-1');
}

/**
 * Shortcode attributes
 * @var $atts
 * Shortcode class
 * @var $this "Shortcode_Ovic_Twitter"
 * @version 1.0.0
 */
class Shortcode_Ovic_Twitter extends Ovic_Addon_Shortcode
{
    /**
     * Shortcode name.
     *
     * @var  string
     */
    public $shortcode = 'ovic_twitter';
    public $default   = array(
        'user_name' => '',
        'limit'     => '5',
    );

    public function content($atts, $content = null)
    {
        $css_class = $this->main_class($atts, array(
            'ovic-twitter',
        ));

        // app credentials
        // (must be in this order)
        $app = array(
            'consumer_key'        => biolife_get_option('twitter_key'),
            'consumer_secret'     => biolife_get_option('twitter_secret'),
            'access_token'        => biolife_get_option('twitter_token'),
            'access_token_secret' => biolife_get_option('twitter_token_secret'),
        );

        ob_start();

        echo ' <div class="'.esc_attr($css_class).'">';

        if (!empty($atts['user_name'])) {

            require_once 'TwitterWP.php';

            // initiate your app
            $twitter = TwitterWP::start($app);

            if (!$twitter->user_exists($atts['user_name'])) {

                echo '<pre>'.esc_html__('User name do not exits', 'biolife').'</pre>';

            } else {

                $tweets = $twitter->get_tweets($atts['user_name'], $atts['limit']);

                if (!empty($tweets->errors)) {
                    echo "<pre>";
                    print_r($tweets->errors);
                    echo "</pre>";
                } else {
                    foreach ($tweets as $tweet):
                        $user_url = $tweet->user->url;
                        if (empty($user_url)) {
                            $user_url = 'https://twitter.com/'.$tweet->user->screen_name;
                        }
                        ?>
                        <div class="tweet">
                            <a class="tweet--info" href="<?php echo esc_url($user_url) ?>" target="_blank">
                                <span class="tweet--icon fa fa-twitter"></span>
                                <div class="tweet--author">
                                    <div class="tweet--name"><?php echo esc_html($tweet->user->name) ?></div>
                                    <div class="tweet--screen_name">
                                        @<?php echo esc_html($tweet->user->screen_name) ?>
                                    </div>
                                </div>
                            </a>
                            <div class="tweet--context">
                                <div class="tweet--text">
                                    <?php echo wp_trim_words($tweet->full_text, 30, '...'); ?>
                                </div>
                                <div class="tweet--source">
                                    <?php echo wp_specialchars_decode($tweet->source); ?>
                                </div>
                                <div class="tweet--time">
                                    <?php echo date("h:i A - M d, Y", strtotime($tweet->created_at)); ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach;
                }

            }

        } else {

            echo '<pre>'.esc_html__('User name do not exits', 'biolife').'</pre>';

        }

        echo '</div>';

        return ob_get_clean();
    }
}