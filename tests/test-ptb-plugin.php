<?php

/**
 * Unit tests to check so Page Tyep Builder is loaded correctly.
 *
 * @package PageTyepBuilder
 */

class WP_PTB_Plugin extends WP_UnitTestCase {

  /**
   * Test so Page Type Builder plugin is loaded correct.
   */

  public function test_plugin_activated () {
    $directory = basename(dirname(dirname(__FILE__)));
    $this->assertTrue(is_plugin_active($directory . '/ptb-loader.php'));
  }

  /**
   * The action `after_theme_setup` should have the `page_type_builder` hook
   * and should have a default priority of 10.
   */

  public function test_after_setup_theme_action () {
    $this->assertEquals(10, has_action('after_setup_theme', 'page_type_builder'));
  }

}