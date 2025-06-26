<?php namespace ProcessWire; 
  // @ _header.php 
  $typeWebPage = "WebPage";
  $typeWebSite = "WebSite";
  $homeHTTPUrl = pages(1)->httpUrl();
?>
<script type="application/ld+json">{
  "@context": "https://schema.org",
  "@graph": [
    <?php
      $faqs = page('faq');
      if (page("template") == "page-faq" && count($faqs)) { ?>
    {
      "@type": "FAQPage",
      "@id": "<?= $pagehttpUrl ?>#faq",
      "isPartOf": {
        "@id": "<?= $pagehttpUrl ?>"
      },
      "mainEntity": [
      <?php
        $i = 0;
        foreach($faqs as $faq) { 
          $i++;
          $comma = $i < count($faqs) ? ',' : '';
      ?>
        {
          "@type": "Question",
          "name": "<?= $faq->question ?>",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "<p><?= $faq->answer ?></p>"
          }
        }<?= $comma ?>
      <?php } ?>
      ]
    },
    <?php } ?>
    <?php if (page("template") == "page-blog" || page("template") == "page-destination" || page("template") == "page-story") { ?>
    {
      "@type": "Article",
      "@id": "<?= $pagehttpUrl ?>#article",
      "isPartOf": {
        "@id": "<?= $pagehttpUrl ?>"
      },
      "author": {
        "@type": "Organization",
        "@id": "<?= $homeHTTPUrl ?>#organization",
        "name": "<?= $legalName ?>"
      },
      "headline": "<?= page('text_longtitle|title') ?>",
      "datePublished": "<?= $datePublished ?>",
      "dateModified": "<?= $dateModified ?>",
      "mainEntityOfPage": {
        "@id": "<?= $pagehttpUrl ?>"
      },
      "publisher": {
        "@id": "<?= $homeHTTPUrl ?>#organization",
        "name": "<?= $legalName ?>"
      },
      "image": {
        "@id": "<?= $pagehttpUrl ?>#primaryimage"
      },
      "thumbnailUrl": "<?= $pagePrimaryImageURL ?>",
      "keywords": [
        "Content SEO",
        "Google Analytics",
        "Mobile SEO",
        "Security",
        "Site Speed",
        "Site structure",
        "Technical SEO",
        "WordPress",
        "Yoast SEO"
      ],
      "inLanguage": "<?= $locale ?>",
      "potentialAction": [
        {
          "@type": "CommentAction",
          "name": "Comment",
          "target": [
            "<?= $pagehttpUrl ?>#respond"
          ]
        }
      ],
      "copyrightYear": "<?= date('Y') ?>",
      "copyrightHolder": {
        "@id": "<?= $homeHTTPUrl ?>#organization"
      }
    },
    <?php } ?> 
    {
      "@type": "<?= $typeWebPage ?>",
      "@id": "<?= $pagehttpUrl ?>",
      "url": "<?= $pagehttpUrl ?>",
      "name": "<?= $pageMetaTitle ?>",
      "isPartOf": {
        "@id": "<?= $homeHTTPUrl ?>#website"
      },
      "about": {
        "@id": "<?= $homeHTTPUrl ?>#organization"
      },
      "primaryImageOfPage": {
        "@id": "<?= $pagehttpUrl ?>#primaryimage"
      },
      "image": {
        "@id": "<?= $pagehttpUrl ?>#primaryimage"
      },
      "thumbnailUrl": "<?= $pagePrimaryImageURL ?>",
      "datePublished": "<?= $datePublished ?>",
      "dateModified": "<?= $dateModified ?>",
      "description": "<?= $siteDescription ?>",
      "breadcrumb": {
        "@id": "<?= $pagehttpUrl ?>#breadcrumb"
      },
      "inLanguage": "<?= $locale ?>",
      "potentialAction": [
        {
          "@type": "ReadAction",
          "target": [
            "<?= $pagehttpUrl ?>"
          ]
        }
      ]
    },
    {
      "@type": "ImageObject",
      "inLanguage": "<?= $locale ?>",
      "@id": "<?= $pagehttpUrl ?>#primaryimage",
      "url": "<?= $pagePrimaryImageURL ?>",
      "contentUrl": "<?= $pagePrimaryImageURL ?>"
    },
    {
      "@type": "BreadcrumbList",
      "@id": "<?= $pagehttpUrl ?>#breadcrumb",
      "itemListElement": [
      <?php 
        $i = 0;
        $pageBrdcrmbs = $page->parents()->append($page);
        foreach($pageBrdcrmbs as $parent) { 
          $i++;
          $comma = $i < count($pageBrdcrmbs) ? ',' : '';
      ?>
        {
          "@type": "ListItem",
          "position": <?= $i ?>,
          "name": "<?= $parent->title() ?>"
        }<?= $comma ?>
      <?php } ?>
      ]
    },
    {
      "@type": "<?= $typeWebSite ?>",
      "@id": "<?= $homeHTTPUrl ?>#website",
      "url": "<?= $homeHTTPUrl ?>",
      "name": "<?= $legalName ?>",
      "description": "<?= $siteDescription ?>",
      "publisher": {
        "@id": "<?= $homeHTTPUrl ?>#organization"
      },
      "potentialAction": [
        {
          "@type": "SearchAction",
          "target": {
            "@type": "EntryPoint",
            "urlTemplate": "<?= $homeHTTPUrl ?>search/?q={search_term_string}"
          },
          "query-input": "required name=search_term_string"
        }
      ],
      "inLanguage": "<?= $locale ?>",
      "copyrightHolder": {
        "@id": "<?= $homeHTTPUrl ?>#organization"
      }
    },
    {
      "@type": [
        "Organization",
        "Brand"
      ],
      "@id": "<?= $homeHTTPUrl ?>#organization",
      "name": "<?= $legalName ?>",
      "url": "<?= $homeHTTPUrl ?>",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "<?= $streetAddress ?>",
        "addressLocality": "<?= $addressLocality ?>",
        "addressRegion": "<?= $addressRegion ?>",
        "addressCountry": "<?= $addressCountry ?>",
        "postalCode": "<?= $postalCode ?>"
      },
      "telephone": "<?= $telephone ?>",
      "email": "<?= $email ?>",
      "logo": {
        "@type": "ImageObject",
        "inLanguage": "<?= $locale ?>",
        "@id": "<?= $homeHTTPUrl ?>#/schema/logo/image/",
        "url": "<?= $siteLogoUrl ?>",
        "contentUrl": "<?= $siteLogoUrl ?>",
        "caption": "<?= $siteName ?>"
      },
      "image": {
        "@id": "<?= $homeHTTPUrl ?>#/schema/logo/image/"
      },
      <?php if ($socials) {
        $socials = fieldExplode($socials); 
      ?> 
      "sameAs": [
      <?php
        $i = 0;
        foreach ($socials as $key => $social) {
          $i++;
          $comma = $i < count($socials) ? ',' : '';
          echo '"'.$social.'"'.$comma;
        } 
      ?>
      ],
      <?php } ?>
      <?php if ($founderName) { ?>
      "founder": {
        "@type": "Person",
        "name": "<?= $founderName ?>",
        "url": "<?= $homeHTTPUrl ?>about",
        "sameAs": "<?= $homeHTTPUrl ?>about"
      },
      <?php } ?>
      <?php if ($slogan) { ?>
      "slogan": "<?= $slogan ?>",
      <?php } ?>
      "description": "<?= $siteDescription ?>",
      "legalName": "<?= $legalName ?>"
    }
  ]
}</script>