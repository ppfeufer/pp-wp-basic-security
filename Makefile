# Change these variables to match your environment
plugin_name = pp-wp-basic-security

pot:
	./vendor/bin/wp i18n make-pot \
		. \
		l10n/$(plugin_name).pot \
		--slug=$(plugin_name) \
		--domain=$(plugin_name) \
		--include="/"

clear-transient:
	./vendor/bin/wp transient delete \
		--all \
		--path=/mnt/sda1/Development/PHP/Sources/WordPress

libraries:
	./vendor/bin/php-scoper \
		add-prefix \
		vendor/yahnis-elsts/plugin-update-checker/ \
		--prefix WordPress\\Ppfeufer\\Plugin\\WpBasicSecurity \
		--output-dir ./Sources/Libs/YahnisElsts/PluginUpdateChecker && \
	composer \
		dump-autoload \
		--working-dir Sources/Libs/YahnisElsts/PluginUpdateChecker/ \
		--classmap-authoritative
