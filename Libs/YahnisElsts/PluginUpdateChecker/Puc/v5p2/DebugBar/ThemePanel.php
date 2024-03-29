<?php

namespace WordPress\Ppfeufer\Plugin\WpBasicSecurity\Libs\YahnisElsts\PluginUpdateChecker\v5p2\DebugBar;

use WordPress\Ppfeufer\Plugin\WpBasicSecurity\Libs\YahnisElsts\PluginUpdateChecker\v5p2\Theme\UpdateChecker;

if ( !class_exists(ThemePanel::class, false) ):

	class ThemePanel extends Panel {
		/**
		 * @var UpdateChecker
		 */
		protected $updateChecker;

		protected function displayConfigHeader() {
			$this->row('Theme directory', htmlentities($this->updateChecker->directoryName));
			parent::displayConfigHeader();
		}

		protected function getUpdateFields() {
			return array_merge(parent::getUpdateFields(), array('details_url'));
		}
	}

endif;
