<?php
  remove_action(  'woocommerce_shop_loop_header',
    'woocommerce_product_taxonomy_archive_header',
    10);