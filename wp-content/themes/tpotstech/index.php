<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, maximum-scale=2, viewport-fit=cover"
    />
    <title>Alumni</title>

    <link
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"
      rel="stylesheet"
    />

    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet"
    />

    <link
      rel="stylesheet"
      href="https://www.liverpool.ac.uk/rb/latest/assets/redbrick.css"
    />
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/liverpool-custom.css" />
     <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css" />
    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>
    <main class="alumni-page">
    <?php
        $image_id = get_post_meta(get_the_ID(), 'banner_image', true);

        $banner_image = wp_get_attachment_image_url($image_id, 'full');
        $banner_title = get_post_meta(get_the_ID(),'banner_title',true);
        $description = get_post_meta(get_the_ID(),'description',true);

        ?>
      <div class="rb-block-cover rb-backdrop rb-block-cover--py-0 bg-rb--color--charcoal rb-custom-career-section">
        <div class="rb-backdrop__inner">
          <picture class="rb-picture rb-backdrop__picture">
            <img
              src="<?php echo $banner_image; ?>"
              class="rb-picture__image"
              alt="Lead Innovation. Inspire Global Learning."
            />
          </picture>
          <div class="rb-block-container bg-rb--color--primary text-white">
            <div class="rb-backdrop__heading">
              <hgroup class="rb-lockupgroup">
                <h1 class="rb-lockup alumni-lockup text-white">
                 <?php echo wp_kses_post($banner_title); ?>
                </h1>

                <p class="rb-lockup text-rb--font-size--xl normal-case">
                  <?php echo wp_kses_post($description); ?>
                </p>
              </hgroup>
            </div>
          </div>
        </div>
      </div>
       <?php
         $intro_title       = get_post_meta(get_the_ID(),'intro_title',true);
        $intro_subtitle    = get_post_meta(get_the_ID(),'intro_subtitle',true);
        $intro_description = get_post_meta(get_the_ID(),'intro_description',true);
        $image_id = get_post_meta(get_the_ID(), 'intro_image', true);

        $intro_image = wp_get_attachment_image_url($image_id, 'full');
        //$intro_image       = get_post_meta(get_the_ID(),'intro_image',true);
        $intro_btn_text    = get_post_meta(get_the_ID(),'intro_btn_text',true);
        $intro_btn_url     = get_post_meta(get_the_ID(),'intro_btn_url',true);
        $intro_btn_target  = get_post_meta(get_the_ID(),'intro_btn_target',true);

        ?>

      <section class="rb-block-cover alumni-about rb-block-cover--pt-0">
        <nav class="rb-breadcrumbs rb-block-container" aria-label="Breadcrumbs">
          <ol class="rb-breadcrumbs__list">
            <li class="rb-breadcrumbs__list__home">
              <a href="<?php echo home_url(); ?>" aria-label="University homepage">home</a>
            </li>
            <li><?php the_title(); ?></li>
          </ol>
        </nav>
        <div class="rb-block-container">
          <div class="rb-top-level-page rb-content-flow">
            <header>
              <h2><?php echo esc_html($intro_title); ?></h2>

              <p class="rb-summary">
                <?php echo esc_html($intro_subtitle); ?>
                 </p>
            </header>
            <article
              class="rb-top-level-page__content"
            >
              <picture class="rb-picture">
                <img
                  src="<?php echo $intro_image; ?>"
                  class="rb-picture__image aspect-3/2"
                  loading="lazy"
                  alt="About the University of Liverpool Bengaluru"
                />
                 <!-- <?php
                if ($intro_image) {
                    echo wp_get_attachment_image(
                        $intro_image,
                        'full',
                        false,
                        array(
                            'class' => 'rb-picture__image aspect-3/2'
                        )
                    );
                }
                ?> -->
              </picture>
              <div class="rb-content-flow alumni-col-2">
                <p>
                  <?php echo esc_html($intro_description); ?>
                 
                </p>
                <a class="rb-button rb-button--secondary" href="<?php echo esc_url($intro_btn_url); ?>" <?php echo $intro_btn_target ? 'target="_blank" rel="noopener noreferrer"' : ''; ?>>
                 <?php echo esc_html($intro_btn_text); ?></a>
              </div>
            </article>
          </div>
        </div>
      </section>
      
      <?php


$selected_statistics = get_post_meta(get_the_ID(), 'selected_statistics', true);

if (!is_array($selected_statistics)) {
    $selected_statistics = array();
}

if (!empty($selected_statistics)) :
?>

<div class="rb-block-cover rb-block-cover--py-0 alumni-countr-box text-white bg-rb--color--blue <?php echo esc_attr($section_class); ?>">
    <div class="rb-block-container">


        <div class="rb-statisticgroup grid-cols-auto">

            <?php foreach ($selected_statistics as $stat_id) :

                $stat_post = get_post($stat_id);

                if (!$stat_post || $stat_post->post_status !== 'publish') {
                    continue;
                }

                $number = get_post_meta($stat_id, 'statistics_number', true);
                $label  = get_post_meta($stat_id, 'statistics_label', true);

                if (!$number) {
                    continue;
                }
            ?>

                <div class="rb-statistic">
                    <figure class="rb-statistic__inner">
                        <div class="rb-statistic__content rb-content-flow">
                            <div class="rb-statistic__title">
                                <?php echo esc_html($number); ?>
                            </div>
                        </div>
                        <?php if ($label) : ?>
                            <figcaption><?php echo esc_html($label); ?></figcaption>
                        <?php endif; ?>
                    </figure>
                </div>

            <?php endforeach; ?>

        </div>

    </div>
</div>

<?php endif; ?>
<?php
          $benefit_title = get_post_meta($post->ID,'benefits_title',true);
          $benefit_description = get_post_meta($post->ID,'benefits_description',true);
      ?>
      <section class="rb-block-cover">
        <div class="rb-block-container">
            <h2><?php echo esc_html($benefit_title); ?></h2>
            <div class="rb-content-flow">
              <p class="rb-summary"><?php echo esc_html($benefit_description); ?></p>
            </div>

            <?php
                  $benefits = get_post_meta(get_the_ID(), 'benefits_items', true);

                  if (!empty($benefits) && is_array($benefits)) :

                      $count = 0;

                      foreach ($benefits as $item) :

                          // Open a new <ul> every 3 items
                          if ($count % 3 == 0) {
                              echo '<ul class="rb-link-grid alumni-link-grid">';
                          }

                          $icon = !empty($item['icon']) ? wp_get_attachment_url($item['icon']) : '';
                          ?>

                          <li>

                              <div class="alumni-link-icon">

                                  <?php if ($icon) : ?>
                                      <img src="<?php echo esc_url($icon); ?>"
                                          alt="<?php echo esc_attr($item['title']); ?>"
                                          loading="lazy">
                                  <?php endif; ?>

                              </div>

                              <div>

                                  <?php if (!empty($item['button_url'])) : ?>

                                      <a href="<?php echo esc_url($item['button_url']); ?>"
                                        <?php echo !empty($item['target']) ? 'target="_blank" rel="noopener noreferrer"' : ''; ?>>

                                          <?php echo esc_html($item['title']); ?>

                                      </a>

                                  <?php else : ?>

                                      <span><?php echo esc_html($item['title']); ?></span>

                                  <?php endif; ?>

                              </div>

                              <p>
                                  <?php echo esc_html($item['details']); ?>
                              </p>

                          </li>

                          <?php

                          $count++;

                          // Close the <ul> after every 3 items
                          if ($count % 3 == 0) {
                              echo '</ul>';
                          }

                      endforeach;

                      // Close the last <ul> if it wasn't closed
                      if ($count % 3 != 0) {
                          echo '</ul>';
                      }

                  endif;
                  ?>

          
        </div>
      </section>
      <?php
// Get the selected CTA IDs for this page (from the meta box we built earlier)
$selected_ctas = get_post_meta(get_the_ID(), 'selected_cta', true);

if (!is_array($selected_ctas)) {
    $selected_ctas = array();
}

if (!empty($selected_ctas)) :

    foreach ($selected_ctas as $cta_id) :

        $cta_post = get_post($cta_id);

        if (!$cta_post || $cta_post->post_status !== 'publish') {
            continue;
        }

        $title        = get_the_title($cta_id);
        $description  = get_the_excerpt($cta_id) ?: wp_trim_words($cta_post->post_content, 30);
        $thumbnail_id = get_post_thumbnail_id($cta_id);
        $icon_svg     = $thumbnail_id ? wp_get_attachment_image_url($thumbnail_id, 'full') : '';

        // Button fields from meta box
        $button_text = get_post_meta($cta_id, 'cta_button_text', true);
        $button_link = get_post_meta($cta_id, 'cta_button_url', true);
         $cta_button_target  = get_post_meta($cta_id,'cta_button_target',true);

       
        ?>
        <section class="rb-block-cover alumni-singup-banner">
        <section class="alumni-signup-banner rb-banner">
            <div class="rb-block-container bg-rb--color--yellow">
                <div class="rb-banner__inner">

                    <?php if ($icon_svg) : ?>
                        <rb-icon class="rb-icon rb-banner__icon">
                            <img src="<?php echo esc_url($icon_svg); ?>" alt="<?php echo esc_attr($title); ?>">
                        </rb-icon>
                    <?php else : ?>
                        <rb-icon class="rb-icon rb-banner__icon" hx-get="/media/livacuk/redbrick/icons/laptop.svg" hx-trigger="load">
                            <!-- fallback default icon -->
                        </rb-icon>
                    <?php endif; ?>

                    <div class="rb-banner__content">
                        <h2 class="rb-banner__title text-rb--color--primary"><?php echo esc_html($title); ?></h2>
                        <p class="rb-banner__text text-rb--color--primary"><?php echo esc_html($description); ?></p>
                    </div>

                    <footer class="rb-banner__footer">
                        <a href="<?php echo esc_url($button_link); ?>" <?php echo $cta_button_target ? 'target="_blank" rel="noopener noreferrer"' : ''; ?> class="rb-button rb-button--primary rb-button--icon" data-icon="download">
                            <?php echo esc_html($button_text); ?>
                        </a>
                    </footer>

                </div>
            </div>
        </section>
        </section>
        <?php
    endforeach;

      endif;
      ?>
     

      <section class="program-cards-container alumni-cards rb-block-cover bg-rb--color--mist rb-block-cover-sec1 common-slider-container">
        <div class="rb-block-container">
            <h2>Success snapshots</h2>
            <div class="rb-cardgroup grid-cols-auto">
              <!-- Card 1 -->
              <section class="rb-card bg-white">
                  <a href="#">
                  </a>
                  <div class="rb-card__inner">
                    <a href="#">
                        <picture class="rb-picture rb-card__header">
                          <img src="<?php echo get_template_directory_uri(); ?>/img/M-1.jpg" title="Accounting and Finance BSc" alt="" loading="lazy">
                        </picture>
                    </a>
                    <div class="rb-card__content">
                      <h2 class="rb-card__title">
                        <a href="javascript:void(0);">Lorem ipsum</a>
                      </h2>
                      <h3 class="rb-card__subtitle">Programme name</h3>
                      Minim sit in commodo aliquip dolore deserunt fugiat voluptate et
                      culpa et aliquip irure sit.
                    </div>
                  </div>
              </section>
              <!-- Card 1 -->
              <section class="rb-card bg-white">
                  <a href="#">
                  </a>
                  <div class="rb-card__inner">
                    <a href="#">
                        <picture class="rb-picture rb-card__header">
                          <img src="<?php echo get_template_directory_uri(); ?>/img/M-2.jpg" title="Biomedical Sciences BSc" alt="" loading="lazy">
                        </picture>
                    </a>
                    <div class="rb-card__content">
                      <h2 class="rb-card__title">
                        <a href="javascript:void(0);">Lorem ipsum</a>
                      </h2>
                      <h3 class="rb-card__subtitle">Programme name</h3>
                      Minim sit in commodo aliquip dolore deserunt fugiat voluptate et
                      culpa et aliquip irure sit.
                    </div>
                  </div>
              </section>
              <!-- Card 1 -->
              <section class="rb-card bg-white">
                  <a href="#">
                  </a>
                  <div class="rb-card__inner">
                    <a href="#">
                        <picture class="rb-picture rb-card__header">
                          <img src="<?php echo get_template_directory_uri(); ?>/img/M-3.jpg" title="Business Management BA" alt="" loading="lazy">
                        </picture>
                    </a>
                    <div class="rb-card__content">
                      <h2 class="rb-card__title">
                        <a href="javascript:void(0);">Lorem ipsum</a>
                      </h2>
                      <h3 class="rb-card__subtitle">Programme name</h3>
                      Minim sit in commodo aliquip dolore deserunt fugiat voluptate et
                      culpa et aliquip irure sit.
                    </div>
                  </div>
              </section>
            </div>
        </div>

        <div class="rb-block-container alumni-videos-box">
            <h2>Voices of our alumni</h2>
            <div class="rb-cardgroup grid-cols-auto">
              <!-- Card 1 -->
              <section
                class="rb-card bg-white alumni-video-card"
                data-video="ZUX3ghkeDP8"
                data-title="Video Title"
              >
                <div class="rb-card__inner">
                  <picture class="rb-picture rb-card__picture alumni-video-thumb">
                    <img
                      src="http://img.youtube.com/vi/ZUX3ghkeDP8/maxresdefault.jpg"
                      alt=""
                      loading="lazy"
                      class="rb-picture__image aspect-3/2"
                    />
    
                    <img
                      src="<?php echo get_template_directory_uri(); ?>/img/YouTube_play_button_icon.png"
                      alt="Play Video"
                      loading="lazy"
                      class="video-play-icon"
                    />
                  </picture>
    
                  <div class="rb-card__content">
                    <h2 class="rb-card__title">
                      <a href="javascript:void(0);">Lorem ipsum</a>
                    </h2>
                    <h3 class="rb-card__subtitle">Programme name</h3>
                    Minim sit in commodo aliquip dolore deserunt fugiat voluptate et
                    culpa et aliquip irure sit.
                  </div>
                </div>
              </section>

              <section
                class="rb-card bg-white alumni-video-card"
                data-video="ZUX3ghkeDP8"
                data-title="Video Title"
              >
                <div class="rb-card__inner">
                  <picture class="rb-picture rb-card__picture alumni-video-thumb">
                    <img
                      src="http://img.youtube.com/vi/ZUX3ghkeDP8/maxresdefault.jpg"
                      alt=""
                      loading="lazy"
                      class="rb-picture__image aspect-3/2"
                    />
    
                    <img
                      src="<?php echo get_template_directory_uri(); ?>/img/YouTube_play_button_icon.png"
                      alt="Play Video"
                      loading="lazy"
                      class="video-play-icon"
                    />
                  </picture>
    
                  <div class="rb-card__content">
                    <h2 class="rb-card__title">
                      <a href="javascript:void(0);">Lorem ipsum</a>
                    </h2>
                    <h3 class="rb-card__subtitle">Programme name</h3>
                    Minim sit in commodo aliquip dolore deserunt fugiat voluptate et
                    culpa et aliquip irure sit.
                  </div>
                </div>
              </section>

              <section
                class="rb-card bg-white alumni-video-card"
                data-video="ZUX3ghkeDP8"
                data-title="Video Title"
              >
                <div class="rb-card__inner">
                  <picture class="rb-picture rb-card__picture alumni-video-thumb">
                    <img
                      src="http://img.youtube.com/vi/ZUX3ghkeDP8/maxresdefault.jpg"
                      alt=""
                      loading="lazy"
                      class="rb-picture__image aspect-3/2"
                    />
    
                    <img
                      src="<?php echo get_template_directory_uri(); ?>/img/YouTube_play_button_icon.png"
                      alt="Play Video"
                      loading="lazy"
                      class="video-play-icon"
                    />
                  </picture>
    
                  <div class="rb-card__content">
                    <h2 class="rb-card__title">
                      <a href="javascript:void(0);">Lorem ipsum</a>
                    </h2>
                    <h3 class="rb-card__subtitle">Programme name</h3>
                    Minim sit in commodo aliquip dolore deserunt fugiat voluptate et
                    culpa et aliquip irure sit.
                  </div>
                </div>
              </section>
            </div>
        </div>
      </section>

      <dialog
        class="rb-dialog rb-dialog--dismissable alumni-yt-video-dialog"
        id="alumniYtVideo_dialog"
        popover="auto"
        role="dialog"
        aria-labelledby="alumniYtVideo_dialog__title"
      >
        <div class="rb-dialog__inner">
          <header>
            <div id="alumniYtVideo_dialog__title" class="rb-dialog__title">
              Voices of our alumni
            </div>
            <button
              data-icon="close"
              class="rb-button rb-button--borderless rb-button--icon rb-button--icon--before"
              popovertarget="alumniYtVideo_dialog"
              popovertargetaction="hide"
              autofocus=""
            >
              Close
            </button>
          </header>
          <section class="rb-dialog__content rb-content-flow">
            <figure class="rb-video">
              <iframe
                src=""
                class="rb-video__iframe aspect-video"
                id="alumniYtVideoIframe"
                title=""
              ></iframe>
            </figure>
          </section>
        </div>
      </dialog>
      <?php
      $section_image = get_post_meta($post->ID,'academic_image', true);
      $section_title = get_post_meta($post->ID, 'academic_title', true);
      $section_description = get_post_meta($post->ID, 'academic_description', true);
      $button_text = get_post_meta($post->ID, 'academic_button_text', true);
      $button_url = get_post_meta($post->ID, 'academic_button_url', true);
      $button_target = get_post_meta($post->ID, 'academic_button_target', true);
    ?>
      <section class="rb-block-cover bg-white">
        <div class="rb-block-container">
          <div class="rb-top-level-page rb-content-flow up-news-alumni">
            <article>
              <picture class="rb-picture">
                <img
                  src="<?php echo get_template_directory_uri(); ?>/img/XL.jpg"
                  class="rb-picture__image aspect-3/2"
                  loading="lazy"
                  alt="Current vacancies"
                />
              </picture>
              <div class="rb-content-flow alumni-col-2">
                <header>
                  <h2>Lorem ipsum dolor sit amet consectetur.</h2>

                  <p class="rb-summary">
                    Lorem ipsum dolor sit amet consectetur. Pharetra placerat ornare dui sit et adipiscing.
                  </p>
                </header>
                <p><strong>Lorem ipsum dolor sit amet consectetur.</strong></p>
                <p>Lorem ipsum dolor sit amet consectetur. Pharetra placerat ornare dui sit et adipisc  dolor sit amet consectetur. Pharetra placerat ornare dui sit et adipiscing.</p>
                <p><strong>Lorem ipsum dolor sit amet consectetur.</strong></p>
                <p>Lorem ipsum dolor sit amet consectetur. Pharetra placerat ornare dui sit et adipisc  dolor sit amet consectetur. Pharetra placerat ornare dui sit et adipiscing.</p>
                <button class="uol-gallery-mode-btn uol-network-btn">
                  Lorem ipsum
                </button>
              </div>
              
            </article>
          </div>
        </div>
      </section>

      <div class="rb-block-cover bg-rb--color--light rb-news-homepage">
        <div class="rb-block-container">
            <h2>Latest news</h2>
            <div class="rb-cardgroup sm:grid-cols-2">
              <section class="rb-card bg-white rb-card--overlay-link rb-news-homepage--main rb-card--horizontal rb-card">
                  <div class="rb-card__inner">
                    <picture class="rb-picture  rb-card__header">
                        <img class="rb-picture__image" src="<?php echo get_template_directory_uri(); ?>/img/S-Square.jpg" alt="" loading="lazy">
                    </picture>
                    <div class="rb-card__content">
                        <div class="rb-card__meta">26 November 2025</div>
                        <h3 class="rb-card__title">
                          <a href="#">Nominate for the 2026 Alumni Awards: Hannah Merchant on why it matters</a>
                        </h3>
                        <p class="rb-card__text">
                          Hannah Merchant (BA Hons English Literature 2022) was recognised at the 2025 University of Liverpool Alumni Awards for her outstanding commitment to equity, inclusion and international impact.
                        </p>
                    </div>
                  </div>
              </section>
              <section class="rb-card bg-white rb-card--overlay-link rb-card__content--centered rb-card">
                  <div class="rb-card__inner">
                    <div class="rb-card__content">
                        <div class="rb-card__meta">18 November 2025</div>
                        <h3 class="rb-card__title">
                          <a href="#">Careers and alumni support for graduates</a>
                        </h3>
                    </div>
                  </div>
              </section>
              <section class="rb-card bg-white rb-card--overlay-link rb-card__content--centered rb-card">
                  <div class="rb-card__inner">
                    <div class="rb-card__content">
                        <div class="rb-card__meta">22 November 2025</div>
                        <h3 class="rb-card__title">
                          <a href="#">Top 5 benefits of being a #LivUniGrad</a>
                        </h3>
                    </div>
                  </div>
              </section>
              <section class="rb-card bg-white rb-card--overlay-link rb-card__content--centered rb-card">
                  <div class="rb-card__inner">
                    <div class="rb-card__content">
                        <div class="rb-card__meta">17 November 2025</div>
                        <h3 class="rb-card__title">
                          <a href="#">Sir Simon Rattle returns to Liverpool for performance at The Tung Auditorium</a>
                        </h3>
                    </div>
                  </div>
              </section>
            </div>
        </div>
      </div>

      <section class="rb-block-cover bottom-section">
        <div class="rb-block-container">
            <ul class="rb-link-grid">
              <li>
                  <div>
                    <a href="#">Join now</a>
                  </div>
                  <p>Lorem ipsum dolor sit amet consectetur. Nibh purus cras arcu accumsan felis. Rhoncus massa elementum viverra quam blandit egestas eu et. Massa viverra facilisi faucibus sit viverra.</p>
              </li>
              <li>
                  <div>
                    <a href="#">Contact us</a>
                  </div>
                  <p>Lorem ipsum dolor sit amet consectetur. Nibh purus cras arcu accumsan felis. Rhoncus massa elementum viverra quam blandit egestas eu et. Massa viverra facilisi faucibus sit viverra.</p>
              </li>
              <li>
                  <div>
                    <a href="#">How to apply</a>
                  </div>
                  <p>Lorem ipsum dolor sit amet consectetur. Nibh purus cras arcu accumsan felis. Rhoncus massa elementum viverra quam blandit egestas eu et. Massa viverra facilisi faucibus sit viverra.</p>
              </li>
            </ul>
        </div>
      </section>

      <script>
        document.addEventListener("DOMContentLoaded", function () {
          const dialog = document.querySelector("#alumniYtVideo_dialog");
          const iframe = document.querySelector("#alumniYtVideoIframe");
        
          document.querySelectorAll(".alumni-video-card").forEach((card) => {
            card.addEventListener("click", function () {
              const videoId = this.dataset.video;
              const videoTitle = this.dataset.title;
        
              if (!videoId) return;
        
              const embedUrl = `https://www.youtube.com/embed/${videoId}?rel=0&showinfo=0`;
        
              iframe.src = embedUrl;
              iframe.title = videoTitle || "Alumni Video";
        
              dialog.showPopover();
            });
          });
        
          dialog.addEventListener("toggle", function (event) {
            if (event.newState === "closed") {
              iframe.src = "";
            }
          });
        });
      </script>
    </main>

    <!-- End New footer section -->
    <script src="<?php echo get_template_directory_uri(); ?>/jquery.min.js"></script>
    <?php wp_footer(); ?>
  </body>
</html>
