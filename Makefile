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
