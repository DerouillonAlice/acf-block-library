<?php
/**
 * Bloc : Vidéo (YouTube ou MP4) + Fancybox
 */

$source    = get_field('source') ?: 'youtube';
$title     = trim((string) get_field('title')) ?: 'Lire la vidéo';
$thumb_id  = get_field('thumbnail');
$icon_color = get_field('icon_color') ?: '#ffffff'; 


$href = '';
$data_type = '';
$yt_id = null;

if ($source === 'youtube') {
  $video_url = trim((string) get_field('video_url'));
  if (!$video_url) {
    echo '<p style="color:#b32d2e">⚠️ Renseignez une URL YouTube.</p>';
    return;
  }
  if (preg_match('~(?:youtube\.com/(?:watch\?v=|embed/)|youtu\.be/)([A-Za-z0-9_-]{6,})~', $video_url, $m)) {
    $yt_id = $m[1];
  } else {
    parse_str(parse_url($video_url, PHP_URL_QUERY) ?? '', $q);
    $yt_id = $q['v'] ?? null;
  }
  if (!$yt_id) {
    echo '<p style="color:#b32d2e">⚠️ URL YouTube non valide.</p>';
    return;
  }

  $href = 'https://www.youtube.com/watch?v=' . $yt_id;

} else {
  $file_url = trim((string) get_field('video_file'));
  if (!$file_url) {
    echo '<p style="color:#b32d2e">⚠️ Ajoutez un fichier vidéo (MP4/WebM).</p>';
    return;
  }
  $href = $file_url;
  $data_type = 'video'; 
}

// --- Miniature ---
$thumb_url = '';
$thumb_alt = esc_attr($title);

if ($thumb_id && is_numeric($thumb_id)) {
  $thumb_url = wp_get_attachment_image_url((int) $thumb_id, 'large');
  $thumb_alt = esc_attr(get_post_meta((int) $thumb_id, '_wp_attachment_image_alt', true) ?: $title);
} elseif ($source === 'youtube' && $yt_id) {
  $thumb_url = "https://i.ytimg.com/vi/{$yt_id}/maxresdefault.jpg";
}

$wrapper_attrs = function_exists('get_block_wrapper_attributes')
  ? get_block_wrapper_attributes(['class' => 'acf-video-fancybox'])
  : 'class="acf-video-fancybox"';
?>
<div <?php echo $wrapper_attrs; ?>>
  <a
    href="<?php echo esc_url($href); ?>"
    data-fancybox
    <?php if ($data_type) : ?> data-type="<?php echo esc_attr($data_type); ?>"<?php endif; ?>
    class="video-thumb"
    aria-label="<?php echo esc_attr($title); ?>"
    rel="noopener"
  >
    <?php if ($thumb_url): ?>
      <img
        src="<?php echo esc_url($thumb_url); ?>"
        alt="<?php echo $thumb_alt; ?>"
        loading="lazy"
        decoding="async"
        onerror="if(!this.dataset.fallback){ this.dataset.fallback=1; this.src=this.src.replace('maxresdefault','hqdefault'); }"
      >
    <?php else: ?>
      <div style="aspect-ratio:16/9;background:#111;display:grid;place-items:center;color:#fff;"><?php echo esc_html($title); ?></div>
    <?php endif; ?>

    <span class="video-play" aria-hidden="true">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="64" height="64" focusable="false" aria-hidden="true">
<circle cx="32" cy="32" r="30" fill="<?php echo esc_attr(get_field('icon_color') ?: 'rgba(0,0,0,0.6)'); ?>"/>
        <polygon points="25,18 48,32 25,46" fill="#fff"/>
      </svg>
    </span>
  </a>
</div>
