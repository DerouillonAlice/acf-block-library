<?php

/**
 * Bloc : Hero
 * Section hero avec image de couverture et texte
 */

$title = trim((string) get_field('title')) ?: 'Titre du Hero';
$subtitle = trim((string) get_field('subtitle')) ?: '';
$description = trim((string) get_field('description')) ?: '';

$image = get_field('background_image');
$background_image_url = '';
if (is_array($image)) {
    $background_image_url = $image['url']; 
} elseif (is_numeric($image)) {
    $background_image_url = wp_get_attachment_image_url($image, 'full');
} elseif (is_string($image)) {
    $background_image_url = $image;
}

$background_color = get_field('background_color');

$button_text = trim((string) get_field('button_text')) ?: '';
$button_url = trim((string) get_field('button_url')) ?: '';
$button_target = get_field('button_target') ? '_blank' : '_self';
$button_color = get_field('button_color') ?: '';
?>
<section 
    class="hero-section" 
    <?php if ($background_image_url): ?>
        style="background-image: url('<?php echo esc_url($background_image_url); ?>');"
    <?php endif; ?>
>
    <?php if ($background_color): ?>
        <div class="hero-overlay" style="background-color: <?php echo esc_attr($background_color); ?>;"></div>
    <?php endif; ?>
    <div class="hero-content">
        <h1 class="hero-title"><?php echo esc_html($title); ?></h1>
        <?php if ($subtitle): ?>
            <p class="hero-subtitle"><?php echo esc_html($subtitle); ?></p>
        <?php endif; ?>
        <?php if ($description): ?>
            <div class="hero-description">
                <?php echo wp_kses_post(wpautop($description)); ?>
            </div>
        <?php endif; ?>
        <?php if ($button_text && $button_url): ?>
            <a 
                href="<?php echo esc_url($button_url); ?>" 
                target="<?php echo esc_attr($button_target); ?>" 
                class="hero-button" 
                style="<?php echo $button_color ? 'background-color: ' . esc_attr($button_color) . ';' : ''; ?> hover:background-opacity-90;"
            >
                <?php echo esc_html($button_text); ?>
            </a>
        <?php endif; ?>
    </div>
</section>